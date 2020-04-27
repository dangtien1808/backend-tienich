<?php
/**
 * User Configuration
 */

/*============================ Server Config ====================================*/
// authencation of database
define('DB_SERVERNAME', "localhost"); //
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "demo");

define('BASE_URL',"");
define('PROJECT_PATH',dirname(__FILE__));

if( !isset($_SESSION) ) session_start();
/*============================ Error Config ====================================*/
error_reporting(E_ALL);

/*============================ Error Config ====================================*/

