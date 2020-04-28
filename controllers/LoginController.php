<?php
class  LoginController extends BaseController
{
    function __construct ($control, $action)
    {
        // Thực hiện action
        parent::__construct($control, $action);
    }

    function index()
    {
        return $this->view("user/login");
    }
}
?>