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
            $SlideList = new Slidelist;
            
            $this->set('title', 'Manage contents of the TSA');
            $this->set('pages', $Pages->findAll());
            $this->set('slides_en', $SlideList->getList('en'));
            $this->set('slides_es', $SlideList->getList('es'));
        }
        
        
        /** manage "static" pages **/
        public function page($page){
            /** load component css and js -> see /app/view/head.php & /app/view/foot.php **/
            $this->set('mdEditor', true);
            $css = array('/components/summernote/dist/summernote.css');
            $js = array('/components/summernote/dist/summernote.js'); // hacked version
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
        
        
        
        /** edit slide contents **/
        public function slide($step, $position, $language = 'en'){
            $this->set('mdEditor', true);
            $css = array('/components/summernote/dist/summernote.css');
            $js = array('/components/summernote/dist/summernote.js'); // hacked version
            $this->set('js', $js);
            $this->set('css', $css);
            $this->set('manage_language', $language);
            if(isset($_POST) && !empty($_POST)) {
                $slide = $SlideList->getSlide($step, $position, $language);
                $update = $SlideList->update($_POST, $slide->idslide_list, $language);
            }
            
            $SlideList = new Slidelist;
            $slide = $SlideList->getSlide($step, $position, $language);
            
            $this->set('slide', $slide);
        }
        
        
        /** manage user profiles **/
        public function user($user){
            
        }
    }
    