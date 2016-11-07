<?php

    class UserController extends Controller {        
        
        public function login(){
            
            $this->set('title', 'Login');
            
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                
                $response = array();
                
                $uput_email = $_POST['email'];
                $uput_password = $_POST['password'];
                
                if(empty($uput_email) || !filter_var($uput_email, FILTER_VALIDATE_EMAIL)){
                    $response['danger'] = '<strong>Invalid/Empty email</strong>. Please input a valid email address.';
                }
                if(empty($uput_password)){
                    $response['danger'] = '<strong>Empty Password</strong>. Please input a password.';
                }
                
                if(!isset($response['danger'])){
                    // No errors, we can proceed and see if we can auth this guy here.
                    
                    $user = $this->User->find(array(
                                                    'email' => $uput_email,
                                                    'password' => crypt($uput_password, '$1$' . SECRET)
                                                )
                                            );
                    
                    if(!empty($user)){
                        $Auth = new Auth;
                        if(!$Auth->isLoggedIn()){
                            
                            $pass = $Auth->authorize($user[0]->idusers);
                            
                        }
                        else {
                            $pass = true;
                        }
                        
                        if($pass == true){
                            if($_COOKIE['TSA-First-Time'] == 'no'){
                                header('Location: /user/projects');    
                            }
                            else {
                                setcookie('TSA-First-Time', 'no', time() + (60*60*24*365*5), '/');
                                header('Location: /project/start');
                            }
                            
                        }
                    }
                    else {
                        $response['danger'] = 'No correspondance found. Please check your credentials and try again.';
                        $this->set('response', $response);
                        //header('Location: /user/login');
                    }
                }
                else {
                    $this->set('response', $response);
                }
            }
        }
        
        /** password recovery **/
        public function recover(){
            $this->set('title', 'Lost Password');
            $response = null;
            if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
                /** Action of requesting a new password **/
                
                $email = trim(trim(trim($_POST['email'])));
                
                /** 1. Validate Email **/
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $valid = false;
                    $response['danger'] = 'Invalid email address. Please input a valid email address.';
                }
                else {
                    /** find email in user table **/
                    $userAccount = $this->User->find(array('email' => $email));
                    
                    if($userAccount){
                        $valid = true;
                    }
                    else {
                        $valid = false;
                        $response['danger'] = 'No user with that email address. Are you sure you used this email to register?';    
                    }
                }
                
                /** check for valid info **/
                if($valid){
                    /** 2. Generate 1-time token **/
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    if(!$token){
                        die('could not generate random token.');
                    }
                    /** 2.1 Associate token to account **/
                    $update = array('token' => $token);
                    $updated = $this->User->update($update, $userAccount[0]->idusers);
                    if(!$updated){
                        $response['danger'] = 'Could not save the recovery token, something was just wrong here.';
                    }
                    else {
                    /** 3. Send email with reset link (/user/reset?token=$token) **/
                        
                        $reset_link = $_SERVER['HTTP_HOST'].'/user/reset/'.$token;
                        
                        // email headers
                        $headers = "From: " . APPEMAIL . "\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        
                        $subject = APPNAME . ': Password recovery';
                        $message = '<html><body><h1>' . APPNAME . ' </h1><p>Someone requested a new password for this account.</p><p><strong>If this wasn\'t you, then do nothing.</strong></p><p>Otherwise please click on this link: <a href="//' . $reset_link . '">Password Reset</a>, Or copy and paste this URL: <span style="color: #339CE8">' . $reset_link . '</span></p><p>Thank you.</p></body></html>';
                        
                        $sender = mail($email, $subject, $message, $headers);
                        
                        if(!$sender){
                            $response['danger'] = 'Could not send email with reset instructions.';
                            // echo $message;
                        }
                        else {
                            $response['success'] = 'Email Sent! Please check your inbox and follow instrutions.';
                        }
                    }
                }
                
                /** 4. set feedback for user **/
                $this->set('response', $response);
            }
        }
        
        
        /** password reset form **/
        public function reset($token){
            $this->set('title', 'Reset your password');
            $this->set('token', $token);
            /** validate this request **/
            if($this->User->validateToken($token)){ 
                if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){
                    /** if we have post data, might as well save the request **/
                    $pwd = $_POST['pwd'];
                    $cpwd = $_POST['cpwd'];
                    
                    /** check for pwd corrispondence **/
                    if(empty($pwd) || empty($cpwd) || !($pwd === $cpwd)){
                        $response['danger'] = 'The password cannot be empty and must match with the confirmation field.';
                    } else { 
                    
                        /** get the user profile **/
                        $user = $this->User->find(array('token' => $token));
                        /** prepare data **/
                        $data = array(
                                      'password' => crypt($pwd, '$1$'.SECRET)
                                      );
                        
                        /** update user data **/ 
                        if(!$this->User->update($data, $user[0]->idusers)) {
                            $response['danger'] = 'Could not reset the password because of a technical issue.';
                        } else {
                            $response['success'] = 'Password correctly reset.<br /> Please <a href="/"><strong>click here</strong></a> and login.';
                        }
                    }
                    $this->set('response', $response);
                }
            } else {
                /** Invalid token, nonetheless, this page does not exist. **/
                header('Location: /user/invalid');
            }
        }
        
        /** redirect here if user has no permission to view content  - header set in /lib/template.class.php **/
        public function forbidden(){
            $this->set('title',  'Nope.');
        }

        
        /** redirect here if the request is invalid, basically a 404 - header set in /lib/template.class.php **/
        public function invalid(){
            $this->set('title', 'invalid');
        }
        
        
        /** User Projects Dashboard **/
        public function projects(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
                $this->set('user', $user);
                $Slidelist = new Slidelist;
                $Project = new Project;                
                $Slide = new Slide;
                
                $this->set('slideindex', $Slidelist->listed());
                
                
                $menu = array();
                $allSlides = $Slidelist->getList();
                foreach($allSlides as $slide){
                    $menu[$slide->indexer] = $slide->title;
                }
                $this->set('slideMenu', $menu);
                
                
                $projects = $Project->findUserProjects($user->id);
                
                foreach($projects as $k => $p){
                    $projectslideindex = array();
                    foreach($p['slides'] as $slides) {
                        $projectslideindex[] = $slides->step . '.' . $slides->slide;
                    }
                    $projects[$k]['slideindex'] = $projectslideindex;
                    
                    
                    $indexed = array();
                    $theProjectIndex = $Slide->projectSlideIndex($p['idprojects']);
                    
                    foreach($theProjectIndex as $i){
                        $indexed[] = $i->indexer;
                    }
                    
                    $projects[$k]['index'] = $indexed;
                }
                
                $this->set('projects', $projects);
                
                
                
            }
            
        }
        
        
        
        public function logout() {
            
            unset($_SESSION[APPNAME][SESSIONKEY]);
            session_destroy();
            
            header('Location: /');
            
        }
    
    
        /** new User Registration **/
        public function create() {
            $this->set('title', 'New User');
            
            $Auth = new Auth($url);
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
                $this->set('user', $user);
                $this->set('header', true);
                
                    
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
                        $error = array();
                        
                        // We got data! Elaborate.
                        $name   =       $_POST['name'];
                        $email  =       $_POST['email'];
                        $pwd    =       $_POST['password'];
                        $cpwd   =       $_POST['c_password'];
                        $role   =       $_POST['role'];
                        
                        // dbga($group);
                        
                        if(empty($name)){
                            $error['name'] = 'Please input a name.';
                        }
                        
                        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $error['email'] = 'Please input a <strong>valid</strong> email.';
                        }
                        
                        if(empty($pwd) || empty($cpwd) || !($pwd === $cpwd)){
                            $error['password'] = 'The password cannot be empty and must match with the confirmation field.';
                        }
                        
                        if(empty($error)) {
                           // No errors. We can proceed and create the User.
                            $data = array(  'name'     => $name,
                                            'email'    => $email,
                                            'password' => crypt($pwd, '$1$'.SECRET),
                                            'role'     => $role,
                                        );
                            $idUser = $this->User->create($data);
                            if($idUser){
                                
                                
                                $Session = new Session;
                                $Session->createSession($idUser);
                            
                                $response['success'] = 'User created correctly.';
                                // Login and proceed to project start! 
                                $Auth = new Auth;
                                $pass = $Auth->authorize($idUser);
                                
                                /** set first login cookie **/
                                setcookie('TSA-First-Time', 'no', time() + (60*60*24*365*5), '/');
                                header('Location: /project/start?reg');
                                
                                
                            }
                            else {
                                $response['danger'] = 'User could not be created';
                            }
                        }
                        else {
                            $response['danger'] = 'User could <strong>not</strong> be created. Please look at the reported errors, correct them, and try again.';
                            
                        }
                        
                        $this->set('response', $response);
                        $this->set('error', $error);
                        $this->set('originalData', $data);
                    }
                    
                
            
            
        }
        
    
        
        
        /** editing user profiles -> shoud only be accessible to Root **/
        public function edit($id){
            $this->set('title', 'Edit User');
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                
                $this->set('userRole', $user->role);
                $this->set('user', $user);
                $this->set('header', true);
                
                // Roots can edit users.
                if(hasRole($user, 'root')){ 
                    
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                        $data = $_POST;
                        
                        $u = $this->User->update($data, $id);
                        if(!$u) {
                            $response['danger'] = 'Something went wrong. Please check the data and try again.';
                        }
                        else {
                            $response['success'] = 'User updated!';
                        }
                        
                        $this->set('response', $response);
                    }
                    $userdata = $this->User->findOne($id);
                    $this->set('data', $userdata);
                }
            }
        }
    
    
        public function profile($id = null){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
                $this->set('user', $user);
                $this->set('header', true);
                $profile =  $this->User->profilePage($id);
                
                //load profile
                $this->set('profile', $profile);
                $this->set('title', $profile->name);
                
            }
        }
    
    

    
    }