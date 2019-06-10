<?php
class LangController extends Controller {


  public function index($lang = 'en'){
    // Register referrer URL
    $referrer = $_SERVER["HTTP_REFERER"];
    setcookie('ALIDADE-LANG', $lang,  time() + 60 * 60 * 24 * 30, '/');
    header('Location: ' . $referrer);
  }

}
