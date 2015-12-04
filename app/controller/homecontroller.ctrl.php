<?php

    class HomeController extends Controller {
        
        public function __construct($model, $controller, $action){
            
            parent::__construct($model, $controller, $action);
            $Auth = new Auth($url);
            
            if($Auth->isLoggedIn()){
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
               
            }
        }
        public function choosing_the_right_technology_tool() {
        
        }
    }
    