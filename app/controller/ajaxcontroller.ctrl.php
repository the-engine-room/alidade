<?php

    class AjaxController extends Controller {
        
        /** this class exposes JSON objects  **/
        
        
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
        
        
    }