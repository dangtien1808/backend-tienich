<?php
class  BaseController
{
    function __construct ($action)
    {
        // Thực hiện action
        if (method_exists($this,$action))
			$this->$action();
		else {echo "Chua xd method {$this->action} "; exit;}
    }
}