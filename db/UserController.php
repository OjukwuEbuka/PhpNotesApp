<?php
   require('../../config.php');

    class UserController {
       
        public function __construct()
        {
        }

        public function register($userEmail, $fullName, $password) {

            $sql = "INSERT INTO users (email, fullName, password) VALUES (:email, :fullName, :password)";
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            try {
                
                $statement = $conn->prepare($sql);

                $statement->bindParam(':email', $userEmail);
                $statement->bindParam(':fullName', $fullname);
                $statement->bindParam(':password', $passwordHash);

                $statement->execute();
                return true;

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }

            $conn = null;
        }

        public function login($email, $password) {

            $sql = "SELECT * FROM users WHERE email = :email";

            try {

                $statement = $conn->prepare($sql);
                $statement->bindValue(':email', $email);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result;

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }

            $conn = null;

        }

    }

?>