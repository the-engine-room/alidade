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
        
        
    }