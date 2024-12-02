<?php
session_start();


include 'conexion.php'; 


if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION['usuario']; 
$cargo = isset($_SESSION['cargo']) ? $_SESSION['cargo'] : "Sin definir"; 


$result = $conn->query("SELECT titulo, contenido, fecha_publicacion FROM noticias ORDER BY fecha_publicacion DESC");
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

    .menu {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .menu li {
        padding: 10px 0;
    }

    .content {
        flex-grow: 1;
        padding: 20px;
    }

    .news {
        border: 1px solid #ccc;
        padding: 20px;
        height: calc(100% - 40px); 
        overflow-y: auto; 
    }

    .news-item {
        margin-bottom: 20px;
    }

    .news-item h2 {
        margin-top: 0;
    }

    footer {
        background-color: #18b025;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        width: 100%;
    }
</style>
</head>
<body>

<div class="container">
    <div class="menu-container" id="menu">
        <div class="profile">
            <h3><?php echo htmlspecialchars($nombre); ?></h3>
            <p>Cargo: Conductor</p>
        </div>
        <div class="menu">
            <ul>
                <li id="inicio"><a href="#"><i class="fas fa-home"></i> Inicio</a></li>
                <li id="Plataforma"><a href="condu.php"><i class="fas fa-info-circle"></i> Plataforma</a></li>
                <li id="cerrar sesión"><a href="logout.php">Cerrar sesión</a>
            </ul>
        </div>
    </div>

<div class="content">
    <h1 style="color: #0632ad;">Noticias Importantes</h1>

    <div class="news">
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

<footer>
    <p>Creado por Alexa</p>
</footer>
</body>
</html>
