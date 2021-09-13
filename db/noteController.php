<?php

    class NoteController {
       
        public function __construct()
        {
        }

        //Create a New Note
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
        
        //Update a Note
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

        //Select all of a users Notes
        public function select($conn, $userId) {

            $sql = "SELECT * FROM notes WHERE userId=:userId ORDER BY id DESC";

            try {
                
                $statement = $conn->prepare($sql);
                $statement->bindParam(':userId', $userId);
                $result = $statement->execute();
                
                if($result){
                
                    return $this->getQuery($statement);
                }

            } catch (PDOException $e) {

                echo $e->getMessage();
                // return false;

            }
            
        }

        //Delete a Note
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

        private function getQuery($qs){
            $qArr = [];
            while ($item = $qs->fetch(PDO::FETCH_ASSOC)) {
                $qArr[] = $item;
            }
            return $qArr;
        }

    }

?>