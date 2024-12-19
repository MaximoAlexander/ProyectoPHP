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
    $canal_id = $_POST['canalObj'];
    $usuario_id = $_SESSION['user_id'];
    $imagen = $_FILES['imagen']['name'] ?? null;
    $video = $_POST['video'] ?? null;

    if ($imagen) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $imagen);
    }
    $stmt = $pdo->prepare("INSERT INTO mensajes (contenido, canal_id, usuario_id, imagen, video) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$contenido, $canal_id, $usuario_id, $imagen, $video]);
    header("Location: foro.php");
    exit();
}

$currentForum = $_GET['cForum'];
if (!isset($currentForum)){
    header("Location: foro.php?cForum=1");
    exit();    
}

$preparedQuery = "SELECT mensajes.*, usuarios.nombre FROM mensajes JOIN usuarios ON mensajes.usuario_id = usuarios.id AND mensajes.canal_id=" . $currentForum . " ORDER BY fecha DESC LIMIT 7";
$stmt = $pdo->query($preparedQuery);
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
    <style>
        .current {
            font-color: red;
        }

    </style>
</head>

<body>
    <?php require_once('../Componentes/header.php'); ?>

    <div class="container mt-3">
        <ul class="nav nav-tabs">
            <?php            
                
            $statementB = $pdo->prepare("SELECT id, nombre FROM canales where amplitud='publico'");
            $statementB->execute();
            $canalesB = $statementB->fetchAll();
            
            foreach($canalesB as $canalI):
            ?>
                <li class="nav-item">
                    <a class="nav-link active <?php
                        if ($canalI['id'] == $currentForum) {
                            echo "current";
                        }
                    ?>" href="foro.php?cForum=<?php echo $canalI['id']; ?>"><?php echo $canalI['nombre']?></a>
                </li>
            <?php endforeach;?>
        </ul>

        <?php include '../Componentes/chat.php'; ?>

        <div class="mt-4" id="post">
            <h5>Publicar un nuevo mensaje</h5>
            <?php include_once('../Componentes/post.php'); ?>
        </div>
</div>


<script>
    function deleteMessage(canalId) {
        if (confirm("Are you sure you want to delete this message?")) {
            fetch(`changeCanal.php?id=${canalId}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('message-' + messageId).parentElement.remove();
                } else {
                    alert("Error deleting the message.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>
</body>

</html>