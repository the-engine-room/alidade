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
                            header('Location: /user/projects');
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
        
        
        public function all() {
            $this->set('title', 'Users');
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
                
                if(hasRole($user, 'Administrator')){
                    $userlist = $this->User->getUserList();
                    $this->set('userlist', $userlist);
                }
                else {
                    header('Location: /user/forbidden');
                }
            }
        }
        
        public function create() {
            $this->set('title', 'New User');
            
            $Auth = new Auth($url);
            
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
                        $groups  =       $_POST['groups'];
                        
                        // dbga($group);
                        
                        if(empty($name)){
                            $error['name'] = 'Please input a name.';
                        }
                        
                        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $error['email'] = 'Please input a <strong>valid</strong> email.';
                        }
                        
                        if(empty($pwd) || empty($cpwd) || !($pwd === $cpwd)){
                            $error['password'] = 'The password cannot be emtpy and must match with the confirmation field.';
                        }
                        
                        if(empty($error)) {
                           // No errors. We can proceed and create the User.
                            $data = array(  'name'     => $name,
                                            'email'    => $email,
                                            'password' => crypt($pwd, '$1$'.SECRET),
                                            'role'     => $role,
                                            //'group'    => $group
                                        );
                            $idUser = $this->User->create($data);
                            if($idUser){
                                
                                
                                $Session = new Session;
                                $Session->createSession($idUser);
                                
                                if(isset($_FILES) && !empty($_FILES)){
                                    $file = new File;
                                    $file->upload('profile', 'image', $idUser, TBL_USERS, false, true);    
                                }
                                
                            }
                            if($idUser){ 
                                $response['success'] = 'User created correctly.';
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
        
    
        public function edit($id){
            $this->set('title', 'Edit User');
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
                
                // Administrators can edit users.
                if(hasRole($user, 'Administrator')){ 
                    
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
                        $data = $_POST;
                        
                        $sent_groups = $data['groups'];
                        unset($data['groups']);
                        unset($data['profile']);
                        $u = $this->User->update($data, $id);
                        
                        $ug = new Usersgroups;
                        $ug->createUsersGroups($id, $sent_groups);
                        
                        
                        
                        if(isset($_FILES) && !empty($_FILES)){
                            $file = new File;
                            $file->upload('profile', 'image', $id, TBL_USERS, false, true);    
                        }
                                
                        if(!$u) {
                            $response['danger'] = 'Something went wrong. Please check the data and try again.';
                        }
                        else {
                            $response['success'] = 'User updated!';
                        }
                        
                        $this->set('response', $response);
                    }
                    
                    $Roles = new Role;
                    $Roles =$Roles->findAll();
                    
                    $Groups = new Group;
                    $Groups = $Groups->findAll();
                    
                    $this->set('roles', $Roles);
                    $this->set('groups', $Groups);
                    
                    $userdata = $this->User->findOne($id);
                    
                    $usergroups = array();
                    $ugroups = $this->User->getUserGroups($id);
                    foreach($ugroups as $g){
                        $usergroups[] = $g->group;
                    }
                    $userdata->groups = $usergroups;
                    $this->set('data', $userdata);
                    
                    
                }
            }
            
            
            
        }
        
        public function forbidden(){
            $this->set('title',  'Nope.');
        }

        
        public function profile($id = null){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $this->set('header', true);
                $profile =  $this->User->profilePage($id);
                
                //load profile
                $this->set('profile', $profile);
                $this->set('title', $profile->name);
                // Load statistics
                $Groups  = new Group;
                $Parties = new Party;
                $Devices = new Device;
                
                
                $this->set('devices', $Devices->ofThisUser($id));
                $this->set('parties', $Parties->ofThisUser($id));
                $this->set('groups',  $Groups->ofThisUser($id));
                
            }
        }
        
        public function projects(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {                
                $user = $Auth->getProfile();
                $this->set('user', $user);
                $Slidelist = new Slidelist;
                $Project = new Project;                
                
                $this->set('slideindex', $Slidelist->listed());
                $projects = $Project->findUserProjects($user->id);
                
                foreach($projects as $k => $p){
                    
                    $projectslideindex = array();
                    foreach($p['slides'] as $slides) {
                        $projectslideindex[] = $slides->step . '.' . $slides->slide;
                    }
                    $projects[$k]['slideindex'] = $projectslideindex;
                }
                
                $this->set('projects', $projects);
                
            }
            
        }
        
        
        public function logout() {
            
            unset($_SESSION[APPNAME][SESSIONKEY]);
            session_destroy();
            
            header('Location: /user/login');
            
        }
    }
    