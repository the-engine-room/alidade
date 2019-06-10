<?php
    session_start();
    $url =  (isset($_GET['url']) ? $_GET['url'] : null);
    $urlPieces = (isset($_GET['url']) ? explode('/', $_GET['url']) : array());

    /** Set/Get Cookies for language selection **/
    global $lang;
    if(isset($_COOKIE['ALIDADE-LANG']) && !empty($_COOKIE['ALIDADE-LANG'])){
      // If we have the cookie, set the language to the user selection
      $lang = $_COOKIE['ALIDADE-LANG'];
    }
    else {
      // If we do not, set the cookie to english and set the language to en
      setcookie('ALIDADE-LANG', 'en',  time() + 60 * 60 * 24 * 30, '/');
      $lang = 'en';
    }

    require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
    require_once(ROOT . DS . 'config' . DS . 'local.php');
    require_once(ROOT . DS . 'config' . DS . 'definitions.php');
    require_once(ROOT . DS . 'lib' . DS . 'functions.php');
    /** Add include for language lib **/
    require_once(ROOT . DS . 'lang' . DS . $lang . '.php');
    /** Run the App **/
    require_once(ROOT . DS . 'lib' . DS . 'main.php');
