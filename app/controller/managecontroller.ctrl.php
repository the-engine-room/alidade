<?php

    class ManageController extends Controller {
        
        public function __construct($model, $controller, $action){
            parent::__construct($model, $controller, $action);
            $Auth = new Auth($url);
            if(!$Auth->isLoggedIn()){
                header('Location: /user/login');
            }
            else {                
                $user = $Auth->getProfile();
                if($user->role != 'root'){
                    header('Location: /user/forbidden');
                }   
            }
            
        }
        
        /** list of slides **/
        public function slides(){
            $this->set('title', 'Manage Slides');
            $SlideList = new Slidelist;
            $this->set('slides', $SlideList->getList());
        }
        
        /** edit slide contents **/
        public function slide($step, $position){
            $this->set('js', array('/components/bootstrap-wysiwyg/external/jquery.hotkeys.js', '/components/bootstrap-wysiwyg/bootstrap-wysiwyg.js'));
            $SlideList = new Slidelist;
            $slide = $SlideList->getSlide($step, $position);
            
            $this->set('slide', $slide);
        }
        
        public function add(){}
        
        
    }
    