<?php

// Cấu hình
require_once "config.php"; 

// auto load class
spl_autoload_register(function ($name) {

    //
    if(is_file(PROJECT_PATH . "/" . "model/$name.php")) 
    	include_once PROJECT_PATH . "/" . "model/$name.php";
    
    if(is_file(PROJECT_PATH . "/" . "library/$name.php")) 
    	include_once PROJECT_PATH . "/" . "library/$name.php";

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
    if(isset($controller) && isset($action)) {
        $page = new $controller( $controller, $action);
    }
} catch (Exception $e) {
	echo "<pre>";
	echo 'Caught Exception',  $e, "\n";
}
