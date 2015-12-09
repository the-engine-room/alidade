<?php

    class Template {
        
        protected $variables = array();
        protected $_controller;
        protected $_action;
        
        /** array to exclude certain routes (like csv exports or AJAX urls) **/
        private $exclude = array(); 
        
        function __construct($controller,$action) {
            $this->_controller = $controller;
            $this->_action = $action;
            
            // load ajax methods into exclude array
            $ajax = get_class_methods('AjaxController');
            $excludes = array();
            foreach($ajax as $i => $method){
                if(!in_array($method, array('__construct', 'index', 'set', '__destruct'))){
                    $excludes[] = $method;
                }
            }
            $this->exclude = $excludes;
            
            if($action == 'forbidden'){
                header('HTTP/1.0 403 Forbidden');
            }
            if($action == 'invalid'){
                header('HTTP/1.0 404 Not Found');
            }
        }
    
        /** Set Variables **/
        function set($name,$value) {
            $this->variables[$name] = $value;
        }
    
        /** Display Template **/
        function render() {
            
            
            extract($this->variables);
            if(!in_array($this->_action, $this->exclude) && $this->_controller !== 'rss'){
                /* Include Base Head @ view/head.php */
                include (ROOT . DS . 'app' . DS . 'view' . DS . 'head.php');
                if (file_exists(ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . 'header.php')) {
                    include (ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . 'header.php');
                } else {
                    include (ROOT . DS . 'app' . DS . 'view' . DS . 'header.php');
                }
        
                include (ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . $this->_action . '.php');		 
        
                if (file_exists(ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . 'footer.php')) {
                    include (ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . 'footer.php');
                } else {
                    include (ROOT . DS . 'app' . DS . 'view' . DS . 'footer.php');
                }
                /* Include Base Foot @ view/foot.php */
                include (ROOT . DS . 'app' . DS . 'view' . DS . 'foot.php');
            }
            elseif($this->_controller == 'rss'){
                /** Manage RSS Feeds (used for public site widgets/WordPress Implementations) **/
                include (ROOT . DS . 'app' . DS . 'view' . DS . 'feeds' . DS . $this->_action . '.php');		 
            }
            else {
                /** requested file should not include header and footer, might be different mime or AJAX content **/
                if(file_exists(ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . $this->_action . '.php')){
                    include (ROOT . DS . 'app' . DS . 'view' . DS . $this->_controller . DS . $this->_action . '.php');
                }
            }
        }
    }