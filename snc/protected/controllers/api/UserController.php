<?php
// api/PesquisaController.php

class UserController extends WRestController{

    protected $_modelName = "UserMessage";

    public function actionCreate()
    {
        $user   = $_POST['user'];
        $device = $_POST['device'];

        $user   = json_decode($user);
        $device = json_decode($device);

        $userMessage = new UserMessage();
        $result = $userMessage->createfollow($user, $device);

        switch ($result) {
            case 3:
                echo "USERUPDATE";
                break;
            case 4:
                echo "USERCREATED";
                break;
            case 5:
                echo "USERERROR";
                break;
        }
    }
}
?>