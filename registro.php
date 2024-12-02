<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: poppins, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(14, 17, 183, 0.4);
            text-align: center; /* Alineación centrada */
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px; /* Tamaño del logo */
            height: auto;
        }
        .h2 {
            color: #0632ad; /* Cambiado a azul */
        }

        input[type="text"], input[type="password"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-bottom: 15px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #0632ad; /* Cambiado a azul */
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0a59cf; /* Color más oscuro al pasar el cursor */
        }
        .confirmation {
            display: none;
            margin-top: 20px;
            background-color: #dff0d8; /* Color de fondo */
            padding: 10px;
            border-radius: 5px;
        }
        .confirmation p {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .confirmation a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0632ad;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .confirmation a:hover {
            background-color: #0a59cf;
        }
        .error {
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: left;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="imagenes/Logo.png" alt="Logo de la empresa">
        </div>
        <h2>Registro de Usuario</h2>
        <form id="registrationForm" action="registrousu.php" method="POST">
            <input type="text" name="nombres" placeholder="Nombre Completo" required>
            

            <!-- Validación del correo electrónico  -->
            <input type="text" name="cedula" placeholder="Cédula" required>
            <select name="cargo" required>
                <option value="" disabled selected>Selecciona tu cargo</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Conductor">Conductor</option>
            </select>

            <!-- Contraseña con requisitos -->
            <input type="password" name="password" class="box" placeholder="Contraseña" required 
                   minlength="8" 
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                   title="La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial (@, $, !, %, etc.)">

            <!-- Confirmación de la contraseña -->
            <input type="password" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required 
                   oninput="checkPasswordMatch()">
            <span id="passwordError" class="error"></span>

            <!-- Aceptar términos y condiciones -->
            <input type="checkbox" id="terminos_condiciones" required>
            <label for="terminos_condiciones">Acepto los términos y condiciones</label>

            <input type="submit" value="Registrar">
            
            <div class="confirmation" id="confirmationMessage">
                <p>¡Registro exitoso!</p>
                <a href="index.php">Iniciar Sesión</a>
            </div>
        </form>
    </div>

    <script>
        function showConfirmation() {
            var confirmationMessage = document.getElementById('confirmationMessage');
            confirmationMessage.style.display = 'block';
            return false; // Evitar que el formulario se envíe realmente
        }

        // Función para verificar si las contraseñas coinciden
        function checkPasswordMatch() {
            var password = document.querySelector('input[name="password"]');
            var confirmPassword = document.querySelector('input[name="confirmar_contraseña"]');
            var errorSpan = document.getElementById('passwordError');

            if (password.value !== confirmPassword.value) {
                errorSpan.textContent = "Las contraseñas no coinciden";
            } else {
                errorSpan.textContent = "";
            }
        }
    </script>
</body>
</html>
