<?php

    /** Set error reporting state
     * SYSTEM_STATUS can be 'production' or
     * development and is set in
     * /config/config.php
     * */
    function errorReporting() {
        
        if(SYSTEM_STATUS === 'development'){
            error_reporting(E_ALL ^ E_NOTICE);
            ini_set('display_errors', 'On');
        }
        elseif(SYSTEM_STATUS === 'production') {
            error_reporting(0);
            ini_set('display_errors', 'Off');
        }
    }
    
    
    
    /** route based instantiation of all needed objects
     * @ domain.com/controller/action/params
     * model is controller within model dir
     * with appended .model.php extension
     * controller is within controller dir
     * with appended .ctrl.php extension
     * views are managed by subdir
     * */
    
    
    function init(){
        
        global $url;    
    
        $a_url=array();
        $a_url=explode('/', $url);
        $controller=$a_url[0];
        
        array_shift($a_url);
            
        if(!empty($a_url)){
            $action=$a_url[0];
            array_shift($a_url);
            $qs=$a_url;
        }
        else {
            $action='index';
            $qs=array();
        }
        
        // manage defaults and routing 
        if(empty($controller)){
            $controller='page';
            $action='home';
        }
        elseif ($controller == 'page' && $action != 'index' ){
           $qs[] = $action;
           $action = 'index';
        }
        
        $controllerName=$controller;
        $controller=ucwords($controller);
        $model=rtrim($controller);
        $controller .= 'Controller';
        $dispatch = new $controller($model, $controllerName, $action);
        
        if((int)method_exists($controller, $action)){
            call_user_func_array(array($dispatch,$action),$qs);
        } else {
            new Error(502, 'Controller/Method <strong>'.$controller.'/'.$action.'</strong> Not Found. Program Shutdown. (main.php, 71)');
        }
        
        
    }
    
    /** autoload functions **/
    function autoloader($className){
        
        if(file_exists(ROOT . DS . 'lib' . DS . strtolower($className).'.class.php')){
            require_once(ROOT . DS . 'lib' . DS . strtolower($className).'.class.php');
        }
        elseif(file_exists(ROOT . DS . 'app' . DS . 'model' . DS . strtolower($className) . '.model.php')){
            require_once(ROOT . DS . 'app' . DS . 'model' . DS . strtolower($className) . '.model.php');
        }
        
        elseif(file_exists(ROOT .  DS . 'app' . DS . 'controller' . DS . strtolower($className).'.ctrl.php')){
            require_once(ROOT . DS . 'app' . DS . 'controller' . DS . strtolower($className).'.ctrl.php');   
        }
        
        else {
           new Error(501, 'Class <strong>'.ucfirst($className).'</strong> Not Found. Program Shutdown. (main.php, 92)');
           die();
        }
        
    }
    
    /** register autoloads **/
    spl_autoload_register('autoloader');

    /** Execute functions **/
    errorReporting();
    init();
    
    
   