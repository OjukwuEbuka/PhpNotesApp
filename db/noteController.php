<?php

    class NoteController {
       
        public function __construct()
        {
        }

        public function create($conn, $title, $body, $userId) {

            $sql = "INSERT INTO notes (title, body, userId) VALUES (:title, :body, :userId)";

            try {
                
                $statement = $conn->prepare($sql);

                $statement->bindParam(':title', $title);
                $statement->bindParam(':body', $body);
                $statement->bindParam(':userId', $userId);

                $statement->execute();
                return true;

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }
            
        }
        
        
        public function update($conn, $title, $body, $id) {

            $sql = "UPDATE notes set title=:title,  body=:body where id=:id";

            try {
                
                $statement = $conn->prepare($sql);

                $statement->bindParam(':title', $title);
                $statement->bindParam(':body', $body);
                $statement->bindParam(':id', $id);

                $statement->execute();
                return true;

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }
            
        }


        public function select($conn, $title, $body, $id) {

            $sql = "SELECT * FROM notes";

            try {
                
                $statement = $conn->prepare($sql);
                $result = $statement->execute();
                
                if($result){
                
                    return $statement->fetchAll();
                }

            } catch (PDOException $e) {

                echo $e->getMessage();
                return false;

            }
            
        }


        public function delete($conn, $id) {

            $sql = "DELETE FROM notes WHERE id = ?";

            try {

                $statement = $conn->prepare($sql);
                $statement->bindParam(1, $id, PDO::PARAM_INT);
                $statement->execute();
                
                return true;

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }

    }

?>