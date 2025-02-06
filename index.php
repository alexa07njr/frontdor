<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Poppins, Helvetica, sans-serif;
}

body{
    background-color: #ffffff;
}

.container {
    display: flex;
    height: 700px;
    width: 1000px;
    box-shadow: 0 0 20px rgba(14, 17, 183, 0.4);
    margin: auto;
    margin-top: 50px;
}


.info {
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    text-align: center;
    padding: 150px 50px;
    width: 50%;

}

.txt-1 {
    color: #ffffff43;
    text-transform: capitalize;
    font-size: 20px;
    margin-bottom: 25px;

}

.info h2 {
    color: #0632ad;
    text-transform: uppercase;
    font-size: 50px;
    margin-bottom: 25px;

}

.info hr {
    width: 55px;
    border: 4px solid #18b025;
    margin-left: 170px;
    margin-bottom: 25px;
}
.txt-2 {
    color: #fff;
    font-size: 18px;
}

.form {
    padding: 150px 100px;
    width: 50%;
    text-align: center;
    background-color: #e8f3fc;

}

.form h2 {
    color: #0632ad;
    font-size: 30px;
    margin-bottom: 25px;

}

.form p {
    font-size: 16px;
    color: #18b025;
    margin-bottom: 25px;

}

.inputs {
    display: flex;
    flex-direction: column;

}

.box {
    outline: none;
    border-color: #18b025;
    border-width: 0px 0px 0px 5px;
    border-style: solid;
    padding: 15px 35px;
    margin-bottom: 20px;
    background-color: #d1d1d1;
}

.inputs a {
    color: #0632ad;
    text-decoration: none;
    font-size: 15px;
    margin-bottom: 35px;

}

.submit {
    background-color: #0632ad;
    padding: 10px;
    border: 0;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    border-radius: 15px;
}

.imagenes {
    background-image: url(imagenes/Logo.png);
   height: 250px;
   background-repeat: no-repeat;
}

.container {
    display: flex;
    height: 700px;
    width: 1000px;
    box-shadow: 0 0 20px rgba(14, 17, 183, 0.4);
    margin: auto;
    margin-top: 50px;
}

.registrarse {
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    text-align: center;
    padding: 150px 150px;
    width: 50%;
}
    </style>
    <script>
        function iniciarSesion(event) {
            event.preventDefault(); 
            alert("Iniciando sesión...");
            window.location.href = "inicio_pr.php"; 
        }

        function registrarse(event) {
            event.preventDefault(); 
            alert("Redirigiendo a la página de registro...");
            window.location.href = "registro.php"; 
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="info">
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
                <input type="text" name="cedula" class="box" placeholder="Cédula" required>
                <input type="password" name="password" class="box" placeholder="Contraseña" required>
                <a href="recuperar_contra.php">¿Olvidaste tu contraseña?</a>

                <input type="submit" value="INICIAR SESIÓN" style="background-color: #0632ad; color: #fff; height: 30px; border-radius: 30px;">

                <br>

                <input type="button" value="REGISTRARSE" style="background-color: #0632ad; color: #fff; height: 30px; border-radius: 30px;" onclick="registrarse(event)">
            </div>
        </form>

    </div>

</body>

</html>
