<?php

    class PageController extends Controller {

        public function __construct($model, $controller, $action){

            parent::__construct($model, $controller, $action);
            $Auth = new Auth($url);

            if($Auth->isLoggedIn()){
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
            }
            
        }

        public function index($url = null){
            $url = (is_null($url) ? 'homepage' : $url);
            $url = filter_var($url, FILTER_SANITIZE_URL);


        }

        public function research(){

        }

        public function six_rules(){ }

        public function home(){
            $url = 'homepage';
            $page = $this->Page->find(array('url' => $url));
            $js = array(
                '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.js'
            );
            $css = array(
                '//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.css'
            );
            $this->set('js', $js);
            $this->set('css', $css);
            $this->set('page', $page[0]->contents);
            $this->set('bodyClass', 'homepage');
        }

    }
