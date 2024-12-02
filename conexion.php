<?php
// Configuración de la base de datos
$host = 'localhost'; // Servidor (en local es localhost)
$dbname = 'db_dor'; // Nombre de tu base de datos
$username = 'root'; // Usuario de MySQL
$password = ''; // Contraseña de MySQL (vacía en local)
$port = 3307; // Puerto que estás utilizando para MySQL

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>