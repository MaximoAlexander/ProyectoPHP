<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['is_admin'] = $usuario['admin'];
        echo "Inicio de sesión exitoso!";
        header("Location: foro.php");
        exit();
    } else {
        echo "Credenciales incorrectas.";
        header("Location: login_register.php");
        exit();
    }
}
?>