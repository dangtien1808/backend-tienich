<?php

// Cấu hình
require_once "config.php"; 

// auto load class
spl_autoload_register(function ($name) {

    //
    if(is_file(PROJECT_PATH . "/" . "models/$name.php")) 
    	include_once PROJECT_PATH . "/" . "models/$name.php";
    
    if(is_file(PROJECT_PATH . "/" . "libs/$name.php")) 
    	include_once PROJECT_PATH . "/" . "libs/$name.php";

    if(is_file(PROJECT_PATH . "/" . "controllers/$name.php")) 
    	include_once PROJECT_PATH . "/" . "controllers/$name.php";

});
// Lấy controller và action
$controller = isset($_GET["controller"]) ? $_GET["controller"] : NULL;
$action     = isset($_GET["action"]) ? $_GET["action"] : NULL;

// Xác thực tài khoản
// $account = new Login();
// $authenticated = $account->authenticate($action);

// // Only render login page if no authenticated
// if (!$authenticated) {
// 	exit();
// }

try {
    $page = new $controller($action);
} catch (Exception $e) {
	echo "<pre>";
	echo 'Caught Exception',  $e, "\n";
}
