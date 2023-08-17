<?php

require_once "../app/config/config.php";
require_once "../app/classes/User.php";

$user = new User();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"));
    $username = $requestData->username;

    if($user->checkUser($username)){
        $response = true;
    }else{
        $response = false;
    }

    echo json_encode($response);

}


?>