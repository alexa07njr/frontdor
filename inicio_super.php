<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include 'conexion.php'; // Asegúrate de que el archivo conexion.php esté incluido

// Verificar si el usuario ha iniciado sesión y tiene el rol adecuado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    // Redirigir al inicio de sesión si no tiene permiso
    header("Location: login.php");
    exit();
}

// Recuperar datos del usuario desde la sesión
$nombre = $_SESSION['usuario']; // Nombre del usuario
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : "Sin definir"; // Cargo del usuario, si está disponible

// Manejar el formulario para agregar noticias
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_STRING);

    if ($titulo && $contenido) {
        // Preparar la consulta para insertar la noticia en la base de datos
        $stmt = $conn->prepare("INSERT INTO noticias (titulo, contenido) VALUES (?, ?)");
        $stmt->bind_param("ss", $titulo, $contenido);
        if ($stmt->execute()) {
            $mensaje = "Noticia agregada correctamente.";
        } else {
            $error = "Error al agregar la noticia.";
        }
        $stmt->close();
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

// Recuperar noticias existentes
$result = $conn->query("SELECT id, titulo, contenido, fecha_publicacion FROM noticias ORDER BY fecha_publicacion DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Menú y Novedades</title>
    <style>
        body {
            font-family: poppins, sans-serif;
            margin: 0;
            padding: 0;
        }

        .content h1 {
            text-align: center;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .menu-container {
            width: 250px;
            background-color: #9bf39b;
            color: #333;
            padding: 20px;
        }

        .profile {
            margin-bottom: 20px;
            text-align: center;
        }

        .profile img {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .menu-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 999;
        }

        .menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin-bottom: 5px;
        }

        .menu-toggle span:last-child {
            margin-bottom: 0;
        }

        .menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            padding: 10px 0;
        }

        footer {
            background-color: #18b025;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            clear: both; /* Para evitar que el contenido se superponga */
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .news {
            border: 1px solid #ccc;
            padding: 20px;
            height: calc(100% - 40px); /* Restamos el padding superior e inferior */
            overflow-y: auto; /* Para permitir desplazamiento si el contenido es largo */
        }

        .news-item {
            margin-bottom: 20px;
        }

        .news-item h2 {
            margin-top: 0;
        }

        .menu li.active {
            background-color: #18b025; /* Color de fondo azul para la página activa */
            color: #fff; /* Color de texto blanco para la página activa */
        }
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<body>

<div class="container">
    <div class="menu-container" id="menu">
        <div class="profile">
            <!-- Mostrar nombre y cargo del usuario -->
            <h3><?php echo htmlspecialchars($nombre); ?></h3>
            <p>Cargo: Supervisor</p>
        </div>
        <div class="menu">
            <ul>
                <li id="inicio"><a href="inicio_super.php"><i class="fas fa-home"></i> Inicio</a></li>
                <li id="plataforma"><a href="super.php"><i class="fas fa-cogs"></i> Plataforma</a></li>
                <li id="cerrar sesión"><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="content">
        <h1 style="color: #0632ad;">Gestión de Noticias</h1>

        <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>"; ?>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

        <form method="POST" action="" style="margin-bottom: 20px;">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="contenido">Contenido:</label>
            <textarea name="contenido" id="contenido" rows="4" required></textarea>

            <button type="submit">Agregar Noticia</button>
        </form>

        <div class="news">
            <h2>Noticias Publicadas</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="news-item">
                        <h2><?php echo htmlspecialchars($row['titulo']); ?></h2>
                        <p><?php echo htmlspecialchars($row['contenido']); ?></p>
                        <small>Publicado el: <?php echo $row['fecha_publicacion']; ?></small>
                    </div>
                    <hr>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay noticias disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("active");
    }

    // Obtener el nombre de la página actual (por ejemplo, "inicio")
    var currentPage = "inicio"; // Aquí debes reemplazar con el nombre de tu página actual

    // Agregar la clase "active" al elemento de menú correspondiente a la página actual
    document.getElementById(currentPage).classList.add("active");
</script>

<footer>
    <p>Creado por Alexa</p>
</footer>

</body>
</html>
