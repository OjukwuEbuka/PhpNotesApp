<?php

    class UserController {
       
        public function __construct()
        {
        }

        public function register($conn, $userEmail, $fullName, $password) {

            $sql = "INSERT INTO users (email, fullName, password) VALUES (:email, :fullName, :password)";
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            try {
                
                $statement = $conn->prepare($sql);

                $statement->bindParam(':email', $userEmail);
                $statement->bindParam(':fullName', $fullName);
                $statement->bindParam(':password', $passwordHash);

                $statement->execute();
                return true;

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }
            
        }

        public function login($conn, $email, $password) {

            $sql = "SELECT * FROM users WHERE email = :email";

            try {

                $statement = $conn->prepare($sql);
                $statement->bindValue(':email', $email);
                $result = $statement->execute();
                
                if($result && $statement->rowCount() == 1){

                    if($row = $statement->fetch()){
                        
                        $id = $row["id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        $fullName = $row["fullname"];

                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            $_SESSION["fullName"] = $fullName;                            
                            
                            // Redirect user to welcome page
                            // header("location: welcome.php");
                            return true;

                        } else{
                            return false;
                        }

                    }

                }
                else
                {
                    return false;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }

        }

    }

?>