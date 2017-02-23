<?php

    // adding this in for added pdf functionalities
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.03' . DS . 'html2pdf.class.php');

    class AjaxController extends Controller {

        var $multiSlides = array( '3.2', '4.2', '4.5' );

        public function save_project_name(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /home');
            }
            else {

                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);

                if(isset($_GET['project']) && is_numeric($_GET['project'])) {
                    $project = (integer)$_GET['project'];


                    $Project = new Project;
                    $data = array('title' => $_GET['title']);
                    $q = $Project->update($data, $project);
                    //$q = true;
                    if(!$q){
                        $response = array('code' => 'danger', 'message' => 'Could not save this name.');
                    }
                    else {
                        $response = array('code' => 'success', 'message' => $data['title']);
                    }
                    echo json_encode($response);
                }
            }
        }

        public function getprojectslide(){
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /home');
            }
            else {

                $user = $Auth->getProfile();
                $this->user = $user;
                $this->set('user', $user);

                if(isset($_GET['project']) && is_numeric($_GET['project']) && isset($_GET['slide']) && !empty($_GET['slide']) ) {
                    $expl = explode('.', $_GET['slide']);
                    $project = (integer)$_GET['project'];
                    $slide = (integer)$expl[1];
                    $step = (integer)$expl[0];

                    $params = array(
                                'project' => $project,
                                'slide' => $slide,
                                'step' => $step
                                );

                    $Slide = new Slide;
                    $response = $Slide->find($params);

                    if(!empty($response)){
                        $response = $response[0];
                        $ret = array('code' => 'success',
                                     'answer' => nl2br($response->answer),
                                     'choice' => (is_null($response->choice) ? '' : $response->choice),
                                     'extra'=> (is_null($response->extra) ? '' : nl2br($response->extra)));

                        echo json_encode($ret);
                    }
                    else {
                        echo json_encode(array('code' => 'danger'));
                    }
                }
            }
        }

        public function save_answer(){
            $status = false;

            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $Auth = new Auth($url);
                $user = $Auth->getProfile();
                if(!$Auth->isLoggedIn()){
                    return false;
                }
                else {
                    $Slide = new Slide;

                    $id = filter_var($_POST['slide'], FILTER_SANITIZE_NUMBER_INT);
                    if(is_array($_POST['answer'])){
                        $answer = implode('##break## ', filter_var_array($_POST['answer'], FILTER_SANITIZE_SPECIAL_CHARS));
                    }
                    else {
                        $answer = filter_var($_POST['answer'], FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                    $slide = $Slide->find(array('idslides' => $id));
                    $slide = $slide[0];
                    //dbga($slide);

                    $update = $Slide->update(array('answer' => $answer), $slide->idslides );
                    if($update){
                        $response['code'] = 'success';
                        $response['icon'] = 'tick';
                        $response['message'] = '<strong>Awww yeah!</strong> The answer has been correctly updated.';
                    }
                    else {
                        $response['code'] = 'danger';
                        $response['icon'] = 'times';
                        $response['message'] = '<strong>Whooops!</strong> Something went wrong and your changes have not been saved.';
                    }
                    $status = $response;
                    echo json_encode($status);
                }
            }
            return $status;
        }

        /** allow navigation without loosing work **/
        public function continuity(){
          $status = false;
          if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $Auth = new Auth($url);
            $user = $Auth->getProfile();
            if(!$Auth->isLoggedIn()){
                return false;
            }
            else {
              $Slide = new Slide;
              $_SESSION['plan'][$_POST['current_slide']] = $_POST;

              $slide_position = explode('.', $_POST['current_slide']);

              $slide = array();
              $slide['project'] = $_SESSION['project'];
              $slide['step'] = $slide_position[0];
              $slide['slide'] = $slide_position[1];
              $slide['status'] = 2;
              $slide['choice'] = (!empty($_POST['choice']) ? $_POST['choice'] : null);
              $slide['extra'] = (!empty($_POST['extra']) ? $_POST['extra'] : null);

              if($_POST['current_slide'] == '1.3'){
                  // special slide with multiple answer boxes
                  $extra = filter_var($_POST['extra'], FILTER_SANITIZE_SPECIAL_CHARS);
                  $answer = ( $extra == '#pick-1' ? $_POST['a'] : $_POST['b'] );
                  $answer = implode('##break## ', $answer);
              }
              // do that for the other multifields too
              elseif(in_array($_POST['current_slide'], $this->multiSlides)){
                  $answer = implode('##break## ', $_POST['answer']);
              }
              //Parse Answers
              elseif(is_array($_POST['answer'])){
                  $answer = array_filter($_POST['answer']);

                  // implode checkboxes in step 4.2
                  if($slide['step'] == 4 && $slide['slide'] == 2){
                      $answer = implode(', ', $answer);
                  }
                  else {
                      $answer = $answer[0];
                  }
              }
              else {
                  $answer = $_POST['answer'];
              }

              /** Slide 4.1 has options instead of radios **/
              if($_POST['current_slide'] == '4.1'){
                  $options = array_keys($_POST['option']);
                  $slide['extra'] = implode(';', $options);
                  $answer = '';
                  $this->set('selection', $options);
              }

              $slide['answer'] = $answer;

              /** update slide **/
              $toUpdate = $Slide->find(array('step'   => $slide['step'],
                                             'slide'  => $slide['slide'],
                                             'project'=> $slide['project']
                                             ));


              if(!empty($toUpdate)){
                $Slide->update($slide, $toUpdate[0]->idslides);
              } else {
                /** new slide **/
                $r = $Slide->create($slide);
              }
            }
            $response['code'] = 'success';
            $status = $response;
            echo json_encode($status);
          }
          return $status;
        }


        public function save_slide(){
            $status = false;

            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $Auth = new Auth($url);
                $user = $Auth->getProfile();
                if(!$Auth->isLoggedIn() || $user->role != 'root' ){
                    header('Location: /home');

                }
                else {
                    $SlideList = new Slidelist;
                    $step = $_POST['step'];
                    $position = $_POST['position'];

                    $slide = $SlideList->find(array('step' => $step, 'position' => $position));
                    $slide = $slide[0];

                    $title = $_POST['title'];
                    $description = $_POST['description'];


                    $update = $SlideList->update(array('title' => $title, 'description' => $description), $slide->idslide_list );
                    if($update){
                        $response['code'] = 'success';
                        $response['icon'] = 'tick';
                        $response['message'] = '<strong>Awww yeah!</strong> The slide has been correctly updated.';
                    }
                    else {
                        $response['code'] = 'danger';
                        $response['icon'] = 'times';
                        $response['message'] = '<strong>Whooops!</strong> Something went wrong and your changes have not been saved.';
                    }
                    $status = $response;
                    echo json_encode($status);
                }
            }

            return $status;
        }

        public function save_page(){
            $status = false;

            if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $Auth = new Auth($url);
                $user = $Auth->getProfile();
                if(!$Auth->isLoggedIn() || $user->role != 'root' ){
                    header('Location: /home');

                }
                else {
                    $Page = new Page;

                    $title = $_POST['title'];
                    $contents = $_POST['contents'];
                    $url = $_POST['url'];
                    $id = (integer)$_POST['id'];

                    $update = $Page->update(array('title' => $title, 'contents' => $contents, 'url' => $url), $id );
                    if($update){
                        $response['code'] = 'success';
                        $response['icon'] = 'tick';
                        $response['message'] = '<strong>Awww yeah!</strong> The page has been correctly updated.';
                    }
                    else {
                        $response['code'] = 'danger';
                        $response['icon'] = 'times';
                        $response['message'] = '<strong>Whooops!</strong> Something went wrong and your changes have not been saved.';
                    }
                    $status = $response;
                    echo json_encode($status);
                }
            }

            return $status;
        }


        public function edit_profile($id = null){
          $Auth = new Auth($url);
          if(!$Auth->isLoggedIn()){
            header('Location: /user/login');
          }
          else {
            $User = new User;

            $user = $Auth->getProfile();
            $this->set('userRole', $user->role);
            $this->set('user', $user);
            $this->set('header', true);

            // check that user data incoming is the same data of current user
            if(
              $_SERVER['REQUEST_METHOD'] == 'POST'
              && !empty($_POST)
              && isset($_POST['user'])
              && filter_var($_POST['user'], FILTER_VALIDATE_INT)
            ){

              $id = filter_var($_POST['user'], FILTER_SANITIZE_NUMBER_INT);
              $SessionUser = $User->getUser($id);
              if($SessionUser->session === $_SESSION[APPNAME][SESSIONKEY]){
                // update the user credentials with the ones submitted by the user
                $data = $_POST;

                /** check for email uniqueness **/
                if(!$User->uniqueEmail($data['email'])) {
                  $response['code'] = 'danger';
                  $response['message'] = 'This email is already in our database.';
                }
                elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                  $response['code'] = 'danger';
                  $response['message'] = 'Please use a valid email. You could need it to recover your password.';
                }
                /** check for password identity **/
                elseif ($data['password'] !== $data['c_password']) {
                  $response['code'] = 'danger';
                  $response['message'] = 'The passwords do not match';
                }

                else {
                  unset($data['user']);
                  unset($data['c_password']);

                  $data['profile_type'] = 'regular';
                  $data['password'] = crypt($data['password'], '$1$'.SECRET);
                  $data['name'] = $data['email'];

                  $u = $User->update($data, $id);
                  if(!$u) {
                    $response['code'] = 'danger';
                    $response['message'] = 'Something went wrong. Please check the data and try again.';
                  }
                  else {
                    unset($_SESSION[APPNAME]['DISP']);
                    $response['code'] = 'success';
                    $response['message'] = 'Registration complete!';
                  }
                }

                $this->set('response', $response);
                echo json_encode($response);
              }
            }
          }
        }

        /** ajax login and project save **/
        public function login(){
          if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
            $response = array();

            $uput_email = $_POST['email'];
            $uput_password = $_POST['password'];

            if(empty($uput_email) || !filter_var($uput_email, FILTER_VALIDATE_EMAIL)){
              $response['danger'] = '<strong>Invalid/Empty email</strong>. Please input a valid email address.';
            }
            if(empty($uput_password)){
              $response['code'] = 'danger';
              $response['message'] = '<strong>Empty Password</strong>. Please input a password.';
            }
            if(!isset($response['code'])){
              // No errors, we can proceed and see if we can auth this guy here.
              $User = new User;
              $user = $User->find(array(
                            'email' => $uput_email,
                            'password' => crypt($uput_password, '$1$' . SECRET)
                          ));

              if(!empty($user)){
                $Auth = new Auth;
                $Auth->authorize($user[0]->idusers);

                setcookie('TSA-First-Time', 'no', time() + (60*60*24*365*5), '/');
                if(isset($_POST['prj']) && !empty($_POST['prj']) && filter_var($_POST['prj'], FILTER_VALIDATE_INT)){
                  $project = filter_var($_POST['prj'], FILTER_SANITIZE_NUMBER_INT);
                  $Project = new Project;
                  $Slides = new Slide;
                  // let's delete this junk, we don't need it
                  $Slides->clean($project);
                  // delete project
                  $Project->delete($project);
                }

                $response['code'] = 'success';
                $response['message'] = 'Logged in!';
              }
              else {
                $response['code'] = 'danger';
                $response['message'] = 'No correspondance found. Please check your credentials and try again.';

              }
            }
            echo json_encode($response);
          }
        }

        /** delete a whole project depending on the hash and the user **/
        public function delete_project(){
          $Auth = new Auth($url);
          if($Auth->isLoggedIn()){
            // get the hash
            $user = $Auth->getProfile();
            $hash = $_POST['project'];
            $ObjProject = new Project;
            $Project = $ObjProject->find(array('hash' => $hash));
            if($Project) {
              if($Project[0]->user == $user->id){
                // delete slides
                $Slides = new Slide;
                $Slides->clean($Project[0]->idprojects);
                // delete project
                $ObjProject->delete($Project[0]->idprojects);
                $response = array('code' => 200);
              }
            } else {
              $response = array('code' => 400);
            }
          }
          else {
            $response = array('code' => '0');
          }

          echo json_encode($response);
        }
  }
