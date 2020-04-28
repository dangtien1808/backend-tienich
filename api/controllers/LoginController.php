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
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $model = new Manage;
            $dataInput = array(
                "email" => $_POST["email"],
                "password" => $_POST["password"],
            );
            $info = $model->fetch($dataInput);
            if(!is_null($info)) {
                Logger::writeLog('manage_logs', array(
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
        // $model = new Manage;
        // $result = $model->fetchAll();
        // echo json_encode($result);
        // echo "<br/>";
        // $result1 = $model->fetchId(1);
        // echo json_encode($result1);

        // $generator = new Token;
        // $token = $generator->generate(32);
        // echo $token;
    }
}
?>