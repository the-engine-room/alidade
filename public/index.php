<?php
    session_start();
    $url =  (isset($_GET['url']) ? $_GET['url'] : null);
    $urlPieces = (isset($_GET['url']) ? explode('/', $_GET['url']) : array());
    
  
    require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
    require_once(ROOT . DS . 'config' . DS . 'local.php');
    require_once(ROOT . DS . 'config' . DS . 'definitions.php');
    require_once(ROOT . DS . 'lib' . DS . 'functions.php');
    require_once(ROOT . DS . 'lib' . DS . 'main.php');
    
    
    