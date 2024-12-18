<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (admin, nombre, email, password) VALUES ('no',?, ?, ?)");
    $stmt->execute([$nombre, $email, $password]);

    echo "Registro exitoso!";
    header("Location: login_register.php");
    exit();
}
?>