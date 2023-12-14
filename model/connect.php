<?php

    function connectdb(){
        
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=website_footballkit", $username, $password);
    // set the PDO error mode to exception

    } catch(PDOException $e) {
  
    }
    return $conn;
    }

?>