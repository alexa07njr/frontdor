<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $password = $_POST['password'];

    // Verificar las credenciales en la tabla 'usuario'
    $sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $usuario['contrasena'])) {
            // Guardar datos en la sesión
            $_SESSION['usuario'] = $usuario['nombres']; // Nombre del usuario
            $_SESSION['rol'] = $usuario['rol'];         // Rol del usuario
            $_SESSION['id_usuario'] = $usuario['id_usu']; // ID del usuario
            $_SESSION['cedula'] = $usuario['cedula'];   // Cédula del usuario

            // Redirigir según el rol del usuario
            if ($usuario['rol'] == 1) {
                header("Location: inicio_super.php");
            } elseif ($usuario['rol'] == 2) {
                header("Location: inicio_pr.php");
            } else {
                echo "<script>
                    alert('Rol no reconocido');
                    window.history.back();
                </script>";
            }
            exit();
        } else {
            echo "<script>
                alert('Contraseña incorrecta');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Cédula no encontrada');
            window.history.back();
        </script>";
    }
}

$conn->close();
?>
