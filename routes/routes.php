<?php

require_once '../db/config.php';
require("../db/UserController.php");
require("../db/NoteController.php");


$mode = isset($_POST['mode']) ? $_POST['mode'] : null;

switch ($mode) {
    case 'register':

        $errors = [];

        //filter and Sanitize data
        $userEmail = filter_input(INPUT_POST, "userEmailAddress", FILTER_VALIDATE_EMAIL);
        $fullName = filter_input(INPUT_POST, "fullName", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING);

        //Validate data
        if(!$userEmail){
            $errors["email"] = "Email is not valid";
        }

        if(!$fullName || strlen($fullName) < 3){
            $errors["fullName"] = "Name must be at least 3 characters";
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
            $newUser = new UserController;

            $registerSuccess = $newUser->register($conn, $userEmail, $fullName, $password);

            if($registerSuccess){
                echo json_encode(["success" => true]);
            }
            else
            {
                echo json_encode(["errors" => ["email" => "Email has been used!"]]);
            }

        }

        break;

    case "login":
        $errors = [];

        //filter and Sanitize data
        $userEmail = filter_input(INPUT_POST, "loginEmailAddress", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "loginPassword", FILTER_SANITIZE_STRING);

        //Validate data
        if(!$userEmail || !$password || strlen($password) < 6){
            $errors["login"] = "Email or password is incorrect";
        }

        if(count($errors) > 0){
            echo json_encode(["errors" => $errors]);
        }
        else
        {
            $newUser = new UserController;

            $loginSuccess = $newUser->login($conn, $userEmail, $password);

            if($loginSuccess){
                echo json_encode(["success" => true]);
            }
            else
            {
                $errors["login"] = "Invalid email or password";
                echo json_encode(["errors" => $errors]);
            }

        }

        break;

    case 'createNote':
        
        $errors = [];

        //filter and Sanitize data
        $title = filter_input(INPUT_POST, "noteTitle", FILTER_SANITIZE_STRING);
        $body = filter_input(INPUT_POST, "noteBody", FILTER_SANITIZE_STRING);
        $userId = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_STRING);;

        //Validate data
        if(!$title){
            $errors["title"] = "Title is not valid text";
        }

        if(!$title){
            $errors["body"] = "Body is not valid text";
        }




        if(count($errors) > 0){

            echo json_encode(["errors" => $errors]);

        }
        else
        {
            $newNote = new NoteController;

            $createSuccess = $newNote->create($conn, $title, $body, $userId);

            if($createSuccess){
                echo json_encode(["success" => true]);
            }
            else
            {
                echo json_encode(["errors" => ["note" => "Failed to create note!"]]);
            }

        }

        break;
    
    
    case 'updateNote':
        
        $errors = [];

        //filter and Sanitize data
        $title = filter_input(INPUT_POST, "noteTitle", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST, "noteid", FILTER_SANITIZE_NUMBER_INT);
        $body = filter_input(INPUT_POST, "noteBody", FILTER_SANITIZE_STRING);

        //Validate data
        if(!$title){
            $errors["title"] = "Title is not valid text";
        }

        if(!$title){
            $errors["body"] = "Body is not valid text";
        }




        if(count($errors) > 0){

            echo json_encode(["errors" => $errors]);

        }
        else
        {
            $newNote = new NoteController;

            $updateSuccess = $newNote->update($conn, $title, $body, $id);

            if($updateSuccess){
                echo json_encode(["success" => true]);
            }
            else
            {
                echo json_encode(["errors" => ["note" => "Failed to update note!"]]);
            }

        }

        break;
    
    default:
        # code...
        break;
}

?>