<?php
/** Application Name **/
define( 'APPNAME',  'Tool Selection Platform'); 
define( 'APPKEY',   'km0IsAtH1nGH3R3#');  // should be a random string

/** Secret! **/
define( 'SECRET',   strrev(md5(APPKEY)));

/** system status: can be development or production **/
define( 'SYSTEM_STATUS', 'development');

/** system root path and directory separator **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] );
/** system directories **/
define('DIR_UPLOADS', ROOT . DS . 'public' . DS . 'uploads');

/** session keys **/
define('SESSIONKEY', md5(APPKEY));
define('SESSIONNAME', md5(APPKEY . SESSIONKEY));
define('SESSIONSALT', strrev(SESSIONKEY));

/** date/time 
 * w/out this PHP throws warnings all over the place.
 * Should be set to same timezone as MySQL server for consistency.
 * */
date_default_timezone_set('Europe/Rome');
