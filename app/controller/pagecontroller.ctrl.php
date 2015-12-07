<?php
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'Parsedown.php');
    require_once(ROOT . DS . 'lib' . DS . 'vendor' . DS . 'ParsedownExtra.php');
    
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
            $Parser = new ParsedownExtra;
            $url = (is_null($url) ? 'homepage' : $url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            
            $page = $this->Page->find(array('url' => $url));
            
            $this->set('page', $Parser->text($page[0]->contents));
        }
        
        public function home(){
            $Parser = new ParsedownExtra;
            $url = 'homepage';
            $page = $this->Page->find(array('url' => $url));
            $this->set('page', $Parser->text($page[0]->contents));
        }
        
    }