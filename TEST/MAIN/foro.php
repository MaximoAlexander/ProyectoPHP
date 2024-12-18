<?php
session_start();

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    include("login_register.php");
    exit();
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contenido = $_POST['contenido'];
    $usuario_id = $_SESSION['user_id'];
    $imagen = $_FILES['imagen']['name'] ?? null;
    $video = $_POST['video'] ?? null;

    if ($imagen) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $imagen);
    }
    $stmt = $pdo->prepare("INSERT INTO mensajes (contenido, usuario_id, imagen, video) VALUES (?, ?, ?, ?)");
    $stmt->execute([$contenido, $usuario_id, $imagen, $video]);
    header("Location: foro.php");
    exit();
}

$stmt = $pdo->query("SELECT mensajes.*, usuarios.nombre FROM mensajes JOIN usuarios ON mensajes.usuario_id = usuarios.id ORDER BY fecha DESC LIMIT 7");
$mensajes = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SigmaxForo</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    
    <link rel="icon" href="../SRC/Logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/styles.css">
</head>

<body>
    <?php require_once('../Componentes/header.php'); ?>

    <div class="container mt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="index.html">Inicio</a>
            </li>
            <li class="nav-item" id="chatBt">
                <a class="nav-link" href="#post" style="background-color:#952F57;">Publicar</a>
            </li>
        </ul>

        <?php include '../Componentes/chat.php'; ?>

        <div class="mt-4" id="post">
            <h5>Publicar un nuevo mensaje</h5>
            <?php include_once('../Componentes/post.php'); ?>
        </div>
</div>
</body>

</html>