<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <script>
        function iniciarSesion(event) {
            event.preventDefault(); // Evita que el formulario se envíe por defecto
            // Aquí puedes agregar la lógica para iniciar sesión
            alert("Iniciando sesión...");
            window.location.href = "inicio_pr.php"; // Redirige a la página de inicio
        }

        function registrarse(event) {
            event.preventDefault(); // Evita que el formulario se envíe por defecto
            // Aquí puedes agregar la lógica para el registro
            alert("Redirigiendo a la página de registro...");
            window.location.href = "registro.php"; // Redirige a la página de registro
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="info">
            <!-- Agregar el logo de la empresa -->
            <img src="imagenes/Logo.png" alt="Logo de la empresa" class="logo">
            <h2>Bienvenido</h2>
            <hr>

            <p class="text-2">
                La calidad de nuestro trabajo en el mantenimiento de vehículos impacta directamente en la seguridad de
                quienes los utilizan. No podemos permitirnos errores.
            </p>
        </div>

        <form class="form" action="login.php" method="POST">
            <h2>Inicio de sesión</h2>
            <br>
            <div class="inputs">
                <!-- Validación del correo electrónico con dominio específico -->
                <input type="text" name="cedula" class="box" placeholder="Cédula" required>
                <input type="password" name="password" class="box" placeholder="Contraseña" required>
                <a href="recuperar_contra.php">¿Olvidaste tu contraseña?</a>


                <!-- Botón para iniciar sesión -->
                <input type="submit" value="INICIAR SESIÓN" style="background-color: #0632ad; color: #fff; height: 30px; border-radius: 30px;">

                <br>
                <!-- Botón para registrarse -->
                <input type="button" value="REGISTRARSE" style="background-color: #0632ad; color: #fff; height: 30px; border-radius: 30px;" onclick="registrarse(event)">
            </div>
        </form>

    </div>

</body>

</html>
