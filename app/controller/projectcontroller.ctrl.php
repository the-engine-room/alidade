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
                }
                
                $position = explode('.', $cur);
                
                $step_no    = (int)$position[0];
                $slide_no   = (int)$position[1];
                
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
                dbga($_SESSION);
                if(isset($_POST) && !empty($_POST)){
                    $_SESSION['plan'][$_POST['current_slide']] = $_POST;
                    
                    // Save Slide to Slide content - Look for a Project Hash and, if Step == 1
                    if($_POST['current_slide'] == '1.1'){
                        
                        $ProjectHash = md5( $_SESSION[APPNAME]['USR'] . time() . $_SESSION[APPNAME][SESSIONKEY]);
                        
                        // create Project Data Array
                        //$this->Project->create($data);
                        
                        $_SESSION[APPNAME]['PRJ'] = $ProjectHash;
                        $data['user'] = $user->id;
                        $data['hash'] = $ProjectHash;
                        
                        $idproject = $this->Project->create($data);
                        $_SESSION['project'] = $idproject;
                        
                    }
                    else {
                        // find project starting from Hash    
                        
                    }
                    
                   // dbga($_SESSION);
                    
                    $slide_position = explode('.', $_POST['current_slide']);
                    $Slide = new Slide;
                    
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
                        $answer = $answer[0];
                    }
                    else {
                        $answer = $_POST['answer'];
                    }
                    $slide['answer'] = $answer;                    
                    $Slide->create($slide);
                }
                
               // dbga($_SESSION);
            }
        }
    }
    