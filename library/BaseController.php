<?php
class  BaseController
{
    protected $status;
    protected $control;
    protected $action;

    function __construct ( $control, $action)
    {
        $this->status = include_once "../status.php"; 
        $this->control = $control;
        $this->action = $action;

        // Thực hiện action
        if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd method {$this->action} "; exit;}
    }
    public function view($view) {
        include_once PROJECT_PATH . "/temps/$view.php";
    }
}