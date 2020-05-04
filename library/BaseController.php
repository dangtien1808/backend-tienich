<?php
class  BaseController
{
    protected $token;
    protected $dataFormat;
    protected $session;
    protected $time;

    function __construct ($action)
    {
        $this->token = new Token();
        $this->dataFormat = new DataFormat();
        $this->session = new Session();
        $this->time = time();
        // Thực hiện action
        if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd method {$this->action} "; exit;}
    }
}