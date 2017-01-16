<?php

    // adding this in for added pdf functionalities
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'html2pdf_v4.03' . DS . 'html2pdf.class.php');
    
    class AjaxController extends Controller {
        
        
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
                    $answer = filter_var($_POST['answer'], FILTER_SANITIZE_SPECIAL_CHARS);
                    
                    
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