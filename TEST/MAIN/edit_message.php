<?php
session_start();
include 'db.php'; // Asegúrate de incluir tu conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data ['id'];
    $contenido = $data['contenido'];

    $stmt = $pdo->prepare("UPDATE mensajes SET contenido = ? WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$contenido, $id, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}