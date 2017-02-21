<?php
/** system root path and directory separator **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] );
/** system directories **/
define('DIR_UPLOADS', ROOT . DS . 'public' . DS . 'uploads');

/** Host **/
define('PROTOCOL', (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://'));
define('APP_HOST', $_SERVER['HTTP_HOST']);



/** date/time
 * w/out this PHP throws warnings all over the place.
 * Should be set to same timezone as MySQL server for consistency.
 * */
date_default_timezone_set('Europe/Rome');
