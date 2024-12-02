<?php
// Iniciar sesión
session_start();
include 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($new_password !== $confirm_password) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        // Verificar si la cédula existe
        $sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Encriptar la nueva contraseña
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $update_sql = "UPDATE usuario SET contrasena = '$hashed_password' WHERE cedula = '$cedula'";
            if ($conn->query($update_sql) === TRUE) {
                $mensaje = "Contraseña actualizada con éxito.";
            } else {
                $mensaje = "Error al actualizar la contraseña.";
            }
        } else {
            $mensaje = "La cédula no existe.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="info">
            <img src="imagenes/Logo.png" alt="Logo de la empresa" class="logo">
            <h2>Recuperar Contraseña</h2>
        </div>

        <form class="form" method="POST" action="">
            <div class="inputs">
                <?php if ($mensaje): ?>
                    <p class="error" style="color: red;"><?php echo $mensaje; ?></p>
                <?php endif; ?>

                <label for="cedula">Cédula:</label>
                <input type="text" name="cedula" class="box" placeholder="Cédula" required>

                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" name="new_password" class="box" placeholder="Nueva Contraseña" required>

                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" name="confirm_password" class="box" placeholder="Confirmar Contraseña" required>

                <input type="submit" value="Actualizar Contraseña" style="background-color: #0632ad; color: #fff; height: 30px; border-radius: 30px;">
                <a href="index.php" style="display: block; text-align: center; margin-top: 10px;">Volver al inicio</a>
            </div>
        </form>
    </div>
</body>
</html>
