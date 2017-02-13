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

              //dbga($_POST);

              if(isset($_POST['slide_update']) && !empty($_POST['slide_update'])){
                /** update slide **/



              } else {
                /** new slide **/

                $response['code'] = 'success';
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


    }
