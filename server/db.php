<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "discuss";

    try{
        $conn = new mysqli($host, $username, $password, $database);
        $conn->query("SET time_zone = '+05:30'");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    catch(mysqli_sql_exception $e){
        die("Connection failed: " . $e->getMessage());
    }
?>