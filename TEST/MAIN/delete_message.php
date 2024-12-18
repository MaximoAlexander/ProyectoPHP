<?php
session_start();
include 'db.php'; // Asegúrate de incluir tu conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM mensajes WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}