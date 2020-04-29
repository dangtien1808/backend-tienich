<?php
/**
 * User Configuration
 */

/*============================ Server Config ====================================*/
// authencation of database
define('DB_SERVERNAME', "localhost"); //
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "tienich");

define('BASE_URL',"");
define('PROJECT_PATH',dirname(__FILE__));

define("SALT_TOKEN", "asdasd");
define("KEY_TOKEN", "asdasd");

define("ALGO_TOKEN", "HS256");
define("MAX_AGE_TOKEN", 3600);

define("MAX_AGE_SESSION", 3600);


if( !isset($_SESSION) ) session_start();
/*============================ Error Config ====================================*/
error_reporting(E_ALL);

/*============================ Error Config ====================================*/

