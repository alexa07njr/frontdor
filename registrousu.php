<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Verificar que los datos se envíen por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombres = $conn->real_escape_string($_POST['nombres']);
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $password = $conn->real_escape_string($_POST['password']);
    $rol = ($cargo === 'Supervisor') ? 1 : 2; // Asignar el rol según el cargo

    // Encriptar la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuario (cedula, nombres, contrasena, rol) 
            VALUES ('$cedula', '$nombres', '$passwordHash', $rol)";

    // Ejecutar la consulta y verificar si se insertaron los datos correctamente
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Registro exitoso');
            window.location.href = 'index.php'; // Redirigir a la página de inicio de sesión
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
