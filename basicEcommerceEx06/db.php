<?php
    $host = 'localhost';
    $username = 'root';
    $password = 'Goodman8*';
    $database = 'lifechoicesshop';

   $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// else{
//     echo "Connected Successfully";
?>