<?php

$host = 'localhost'; 
$dbname = 'db_dor'; 
$username = 'root'; 
$password = ''; 
$port = 3307; 


$conn = new mysqli($host, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
