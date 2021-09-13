<?php

$conn = new PDO(   
            'mysql:host=localhost;dbname=notesapp;charset=utf8mb4',
            'root',
            '',
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false
            )
        );

?>