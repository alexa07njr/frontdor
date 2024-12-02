<?php
session_start();


include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        
        if (password_verify($password, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['nombres']; 
            $_SESSION['rol'] = $usuario['rol'];       
            $_SESSION['id_usuario'] = $usuario['id_usu']; 
            $_SESSION['cedula'] = $usuario['cedula'];  

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
