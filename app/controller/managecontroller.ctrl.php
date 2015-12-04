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
                $this->set('userRole', $user->role);
                if($user->role != 'root'){
                    header('Location: /user/forbidden');
                }   
            }
            
        }
        
        public function index() {
            $Pages = new Page;
            
            $this->set('title', 'Manage contents of the TSA');
            $this->set('pages', $Pages->findAll());
        }
        
        public function page($page){
            /** load component css and js -> see /app/view/head.php & /app/view/foot.php **/
            $this->set('mdEditor', true);
            $css = array('/components/bootstrap-markdown/css/bootstrap-markdown.min.css');
            $js = array('/components/bootstrap-markdown/js/bootstrap-markdown.js', '/components/markdown/lib/markdown.js');
            $this->set('js', $js);
            $this->set('css', $css);
            
            $Pages = new Page;
            
            if(strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                /** save data **/
                $data = array();
                $data['title'] = $_POST['title'];
                $data['url'] = $_POST['url'];
                $data['contents'] = $_POST['contents'];
                $id = $_POST['page'];
                $update = $Pages->update($data, $id);
                if($update){
                    $response['success'] = 'Page contents updated';
                }
                else{
                    $response['danger'] = 'Could not update the page.';
                }
                $this->set('response', $response);
            }
            
            $this->set('page', $Pages->findOne($page));
            
            
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
    