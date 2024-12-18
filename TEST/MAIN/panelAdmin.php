<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    include("login_register.php");
    exit();
}

if ($_SESSION['is_admin']!='si') {
    header("Location: index.html");
    exit();
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $canal_name = $_POST['canal_name'];
    $canal_type = $_POST['canal_type'];
    $canal_desc = $_POST['canal_description'];

    // Prepare and bind
    $stmt = $pdo->prepare("INSERT INTO canales (nombre,descripcion,amplitud) VALUES (?,?,?)");

    // Execute the statement
    if ($stmt->execute([$canal_name, $canal_desc, $canal_type])) {
        echo "New canal added successfully!";
        header("Location: panelAdmin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: panelAdmin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel de administrador</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    
    <link rel="icon" href="../SRC/Logo.png" type="image/png">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/formStyle.css">
</head>
<body>
    <?php require_once('../Componentes/header.php'); ?>
    <div class="container chatList">
        <div class="row chatDescription" id="chatAbstract1"></div>
    </div>

    <ul>
        <?php
            // Fetch canal descriptions from the database
            $query = "SELECT id, nombre, descripcion FROM canales"; // Adjust the query as necessary
            $result = $pdo->query($query);

            
            echo '<div class="canal-descriptions">';
            while ($row = $result->fetch()) {
                echo '<div class="canal">';
                echo '<h3>' . htmlspecialchars($row['nombre']) . '</h3>'; // Display canal name
                echo '<p>' . nl2br(htmlspecialchars($row['descripcion'])) . '</p>'; // Display canal description
                echo '</div>';
            }
            echo '</div>';
        ?>
    </ul>

    <h1>Añadir nuevo canal</h1>
    <form method="post" action="">
        <label for="canal_name">Canal Name:</label>
        <input type="text" id="canal_name" name="canal_name" required>
        <input type="text" id="canal_description" name="canal_description" required>
        <select id="canal-type-options" name="canal_type">
            <option value="publico">Público</option>
            <option value="privado">Privado</option>
        </select>
        <input type="submit" value="Add Canal">
    </form>
</body>
</html>