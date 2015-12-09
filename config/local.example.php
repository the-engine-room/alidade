<?php

    /** Local Environment Setup **/

    /** system status: can be development or production **/
    define( 'SYSTEM_STATUS', 'production');

    /** Application Name **/
    define( 'APPNAME',  'Tool Selection Platform');
    
    /** PLEASE NOTE that this is used for encryption. It is important that it is changed. **/
    define( 'APPKEY',   'It is very important that you change this.');        // should be a random string. 
    
    /** Application Email **/
    define( 'APPEMAIL', 'your@email');
    
    /** Secret! **/
    define( 'SECRET',   strrev(md5(APPKEY)));

    /** session keys **/
    define('SESSIONKEY', md5(APPKEY));
    define('SESSIONNAME', md5(APPKEY . SESSIONKEY));
    define('SESSIONSALT', strrev(SESSIONKEY));

    /** Database connection params **/
    define('DBTYPE', 'mysql');      //PDO Driver
    define('DBUSER', 'user');       //User 
    define('DBPASS', 'password');   //Password
    define('DBNAME', 'database');   //Database name
    define('DBHOST', 'localhost');  //Database server ip/name
    
    