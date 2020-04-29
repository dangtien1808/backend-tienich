<?php

class  BaseController
{
    protected $status;
    protected $control;
    protected $action;
    protected $token;
    protected $dataFormat;
    protected $session;

    function __construct ( $control, $action)
    {
        $this->status = include_once PROJECT_PATH. "/status.php"; 
        $this->control = $control;
        $this->action = $action;
        $this->token = new Token();
        $this->dataFormat = new DataFormat;
        $this->session = new Session;

        // Thực hiện action
        if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd method {$this->action} "; exit;}
    }
    public function model($model) {
        $model = $model . "Model";
        return new $model;
    }
    public function view($view) {
        include_once PROJECT_PATH . "/temps/$view.php";
    }
    public function checkLogin ($token) {
        $auth_token = $this->session->getSession('auth_token');
        if (strcmp($auth_token, $token) == 0) {
            return true;
        }
        return false;
    }
}