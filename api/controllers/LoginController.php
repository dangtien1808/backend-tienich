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
        $email = $this->dataFormat->postIndex("email");
        $password = $this->dataFormat->postIndex("password");
        $token = $this->dataFormat->postIndex("auth_token");

        // if($this->checkLogin($token)) {
        //     echo "not login";die;
        // }

        if(isset($email) && isset($password)) {
            $model = $this->model("Manage");
            $dataInput = array(
                "email" => $email,
                "password" => $password,
            );
            $info = $model->fetch($dataInput);
            if($info) {
                $token = $this->token->tokenRandom();
                $this->session->setSession('auth_token', $token);        
                $this->session->setSession('auth_info', $info);
                Logger::writeLog("manage_logs", array(
                    "manage_id" => $info["id"],
                    "create" => $info["create"],
                    "menu_control" => $this->control,
                    "menu_action" => $this->action,
                    "new_data" => null,
                    "old_data" => null
                ));
            }
            $result =  array(
                "status" => $this->status["status_200"],
                "message" => $this->status["message_200"],
                "loggin_success" => is_null($info)
            );
            
            echo json_encode($result);
        }
    }
}
?>