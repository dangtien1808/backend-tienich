<?php
class Login extends BaseController
{
	function __construct($action)
	{
		// tải model
		$this->log = new ManageLogModel();
		$this->manage = new ManageModel();
		// không được bỏ qua dòng này
		parent::__construct($action);
	}

    function doLogin()
    {
    	$email = postIndex("email");
		$password = postIndex("password");
		if(isset($email) && isset($password)) {
            $dataInput = array(
                "email" => $email,
                "password" => $password,
            );
            $info = $this->manage->first($dataInput);
            if($info) {
                $token = $this->token->tokenRandom();
                $this->session->setSession("auth_token", $token, $this->time);        
                $this->session->setSession("auth_info", $info, $this->time);
				$this->log->insert(array(
                    "manage-id" => $info["id"],
                    "create" => $this->time,
                    "menu-control" => "login",
                    "menu-action" => null,
                    "new-data" => null,
                    "old-data" => null
				));
				$result =  array(
					"status" => 200,
					"token" => $token,
					"users" => $info
				);
				echo json_encode($result);
			}
			else {
				$result =  array(
					"status" => "2xx",
					"token" => null,
					"users" => null
				);
				echo json_encode($result);
			}
		}
    }
}