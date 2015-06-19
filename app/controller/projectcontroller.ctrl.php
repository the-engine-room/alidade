<?php

    class Projectcontroller extends Controller {
        
        public function start(){
            
            $Step = new Step;
            
            $step = $Step->find(array('position' => 1));
            
            $this->set('step', $step[0]);
            
        }
        
        /** urls are in the form of /project/slide/1.2 **/
        
        public function slide($cur){
        
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
            
            
            $nextSlide = $slideIndex['fullIndex'][array_search($cur, $slideIndex['fullIndex']) + 1];
            $this->set('nextSlide', $nextSlide);
            $this->set('currentSlide', $cur);
            
            $this->set('slide', $slide[0]);
        }
        
    }
    