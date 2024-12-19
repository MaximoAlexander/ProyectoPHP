
<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the canal ID and updated data from the POST request
    $canal_id = isset($_POST['id']) ? $_POST['id'] : '1';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    // Validate the data
    if (empty($canal_id) || empty($nombre) || empty($descripcion)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Prepare the SQL statement to update the canal
    $stmt = $pdo->prepare("UPDATE canales SET nombre = ?, descripcion = ? WHERE id = ?");

    // Execute the statement
    if ($stmt->execute([$nombre, $descripcion, $canal_id])) {
        echo json_encode(['status' => 'success', 'message' => 'Canal updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating canal: ' . $stmt->error]);
    }

} else {
}
header("Location: edit_canal.php");
?>