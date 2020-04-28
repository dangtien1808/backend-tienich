<?php
require_once "../config.php"; 

spl_autoload_register(function ($name) {

    if(is_file(PROJECT_PATH . "/" . "model/$name.php")) 
    	include_once PROJECT_PATH . "/" . "model/$name.php";
    
    if(is_file(PROJECT_PATH . "/" . "library/$name.php")) 
    	include_once PROJECT_PATH . "/" . "library/$name.php";

    if(is_file(PROJECT_PATH . "/api/controllers/$name.php")) 
    	include_once PROJECT_PATH . "/api/controllers/$name.php";

});

$control = null;
$action = 'index';
if(isset($_POST["control"])){
    $control = $_POST["control"];
}

if(isset($_POST["action"])){
    $action = $_POST["action"];
}
if(!is_null($control)){
    $page = new $control( $control, $action);
}
?>