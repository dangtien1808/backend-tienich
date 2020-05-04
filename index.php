<?php
require_once "config.php"; 

spl_autoload_register(function ($name) {
    if(is_file(PROJECT_PATH . "/" . "model/$name.php")) 
        include_once PROJECT_PATH . "/" . "model/$name.php";
    
    if(is_file(PROJECT_PATH . "/" . "library/$name.php")) 
        include_once PROJECT_PATH . "/" . "library/$name.php";
});

// $confirmedToken = false;
// if( isset($_SESSION['email']) && isset($_SESSION['token']) )
//     $confirmedToken = Token::verify($_SESSION['email'],$_SESSION['token']);

// if( !$confirmedToken )
// {
//     echo "chuyển hướng đến trang đăng nhập";
//     exit();
// }  

// routing
$control = DataFormat::getIndex('control') ? DataFormat::getIndex('control') : 'home';
DataFormat::formatInput($control,'string');
$action  = DataFormat::getIndex('action')  ? DataFormat::getIndex('action') : 'index';
DataFormat::formatInput($control,'string');

// lấy data cho trang thêm, sửa, danh sách
if($action !== 'index')
    include "temp/$control/$action.php";

// Xử lí view của controller
echo "trả về response cho client, lấy từ view temp/desktop/$control/$action và layout";

//
if(!is_file(PROJECT_PATH . "/" . "temp/desktop/$control/$action.php"))
{
    echo "Trang lỗi 404";
    return;
} 
    

// Kiểm tra quyền truy cập

//
include PROJECT_PATH . "/" ."temp/desktop/$control/$action.php";