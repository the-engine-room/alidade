<?php

    class Projectcontroller extends Controller {
        
        public function start(){
            
            $Step = new Step;
            
            $step = $Step->find(array('position' => 1));
            
            $this->set('step', $step[0]);
            
        }
        
        /** urls are in the form of /project/slide/1.2 **/
        
        public function slide($cur){
            
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            
            else {
                
               
                
                $user = $Auth->getProfile();
                $this->set('user', $user);
              
                if(!isset($_SESSION['plan']) || $cur === '1.1'){
                    $_SESSION['plan'] = array();
                    $_SESSION['project'] = null;
                }
                
                $position = explode('.', $cur);
                
                $step_no    = (int)$position[0];
                $slide_no   = (int)$position[1];
                
                $Slide = new Slide;
                $Slidelist = new Slidelist;
                $slidelist = $Slidelist->getList();
                
                $slideIndex = array();
                foreach($slidelist as $s){
                    $slideIndex[$s->step][] = $s->position;
                    $slideIndex['fullIndex'][] = $s->step . '.' . $s->position;
                }
                
                
                $this->set('step_number', $step_no);
                $this->set('slide_number', $slide_no);
                $this->set('slidelist', $slidelist);
                $this->set('slideindex', $slideIndex);
                
                $slide = $Slidelist->find(array(
                                            'position'  =>  $slide_no,
                                            'step'      =>  $step_no
                                            ));
                
                $nextSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex'], true) + 1];
                
                /*
                echo $cur; 
                echo array_search($cur, $slideIndex['fullIndex']) + 1;
                dbga($slideIndex);
                */
                
                $this->set('nextSlide', $nextSlide);
                $this->set('currentSlide', $cur);
                
                $this->set('slide', $slide[0]);
               
                //check if we have a hash for a project
                
                
                if($_GET['p']){
                    $hash = $_GET['p'];
                    $project = $this->Project->find(array('hash' => $hash));
                    
                    if(!empty($project) && is_object($project[0])) {
                        $_SESSION['project'] = $project[0]->idprojects;
                    }
                    
                    $slidecontent = $Slide->find(array(
                                                       'project'    => $project[0]->idprojects,
                                                       'step'       => $step_no,
                                                       'slide'      => $slide_no,
                                                       ));
                    //$slidecontent[0]->full_project = $project[0];
                    if($slidecontent){ 
                        $this->set('original', $slidecontent);
                    }
                }
               
                if(isset($_POST) && !empty($_POST)){
                    $_SESSION['plan'][$_POST['current_slide']] = $_POST;
                    
                    // Save Slide to Slide content - Look for a Project Hash and, if Step == 1
                    
                    if($_POST['current_slide'] === '1.1' && !isset($_POST['project'])){
                        
                        $ProjectHash = md5( $_SESSION[APPNAME]['USR'] . time() . $_SESSION[APPNAME][SESSIONKEY]);
                        
                        $data['user'] = $user->id;
                        $data['hash'] = $ProjectHash;
                        
                        $idproject = $this->Project->create($data);
                        $_SESSION['project'] = $idproject;
                    }
                    
                    $slide_position = explode('.', $_POST['current_slide']);
                    
                    
                    $slide = array();
                    $slide['project'] = $_SESSION['project'];
                    $slide['step'] = $slide_position[0];
                    $slide['slide'] = $slide_position[1];
                    $slide['status'] = 2;
                    $slide['choice'] = (!empty($_POST['choice']) ? $_POST['choice'] : null);
                    $slide['extra'] = (!empty($_POST['extra']) ? $_POST['extra'] : null);
                    
                    //Parse Answers
                    if(is_array($_POST['answer'])){
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
                    $slide['answer'] = $answer;
                    
                    // creating or updating ?
                    if(isset($_POST['slide_update']) && !empty($_POST['slide_update'])){
                        $toUpdate = $Slide->find(array('step'   => $slide['step'],
                                                       'slide'  => $slide['slide'],
                                                       'project'=> $slide['project']
                                                       ));
                        
                        
                        
                        $Slide->update($slide, $toUpdate[0]->idslides);
                        header('Location: /user/projects/?cd=2');
                    }
                    else {
                        // check if we are skipping stuff
                        /*if($slide['step'] == 1 && $slide['position'] == 11 && (isset($_GET['skipped']))){
                            $slide['answer'] == 
                        }*/
                        
                        $r = $Slide->create($slide);
                        // Check values in the choice @ the end of Step 3
                        if($slide['step'] == 3 && $slide['slide'] == 7 ) {
                            $choice = $_POST['choice'];
                            if(!in_array('no', $choice)){
                                header('Location: /project/slide/4.10');
                            }
                        }
                    }
                    
                }
            }
        }
    }
    