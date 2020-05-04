<!-- xử lí ajax request và trả về json -->
<?php
// Khởi động ứng dụng
require_once "../config.php"; 

spl_autoload_register(function ($name) {
    if(is_file(PROJECT_PATH . "/" . "model/$name.php")) 
    	include_once PROJECT_PATH . "/" . "model/$name.php";
    
    if(is_file(PROJECT_PATH . "/" . "library/$name.php")) 
    	include_once PROJECT_PATH . "/" . "library/$name.php";

    if(is_file(PROJECT_PATH . "/" . "api/control/$name.php")) 
    	include_once PROJECT_PATH . "/" . "api/control/$name.php";
});

// Xác thực
// $confirmedToken = true; 
// if( isset($_SESSION['email']) && isset($_SESSION['token']) )
//     $confirmedToken = Token::verify($_SESSION['email'],$_SESSION['token']);

// if( !$confirmedToken )
// {
//     echo "điều hướng đến trang đăng nhập";
//     exit();
// }     

// routing
$control = DataFormat::postIndex('control');
$action  = DataFormat::postIndex('action');

if( !($control && $action) )
{
    echo "trả về không tìm thấy request";
    exit();
}

// Xử lí API lấy của ajax.
try {
    
    $jsonData = new $control($action);


} catch (Exception $e) {
    echo "<pre>";
    echo 'Caught Exception',  $e, "\n";
}