<?php

require("../db/UserController.php");


$mode = isset($_POST['mode']) ? $_POST['mode'] : null;

switch ($mode) {
    case 'register':

        $errors = [];

        //filter and Sanitize data
        $userEmail = filter_input(INPUT_POST, "userEmailAddress", FILTER_VALIDATE_EMAIL);
        $fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

        //Validate data
        if(!$userEmail){
            $errors["email"] = "Email is not valid";
        }

        if(!$fullname || strlen($fullname) < 3){
            $errors["fullname"] = "Name must be at least 3 characters";
        }

        if(!$password || strlen($password) < 6){
            $errors["password"] = "Password must be at least 6 characters";
        }

        if(! ($password === $confirmPassword)){
            $errors["confirmPassword"] = "Passwords must match";
        }



        if(count($errors) > 0){
            echo json_encode(["errors" => $errors]);
        }
        else
        {
            $registerData = ["fullname"=>$fullname, "email"=>$email, $password=>$password];


        }

        break;
    
    default:
        # code...
        break;
}

?>