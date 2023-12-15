<?php

    function connectdb(){
        
    $servername = "footballkit-server.mysql.database.azure.com";
    $username = "rjrlcznktk";
    $password = "K4TB5OZ7SC6B4PF0$";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=footballkit-database", $username, $password);
    // set the PDO error mode to exception

    } catch(PDOException $e) {
  
    }
    return $conn;
    }

?>