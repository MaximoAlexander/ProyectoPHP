<?php
session_start();
// Include database connection
include 'db.php';

// Fetch canal descriptions from the database
$canalId = $_GET['id']; // Get the canal ID from the URL
$query = "SELECT * FROM canales WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$canalId]);
$result = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Edit Canal</title>
</head>
<body>
    <div class="container">
        <h1>Edit Canal: <?php echo htmlspecialchars($result['nombre']); ?></h1>
        
        <form action="update_canal.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="nombre" value="<?php echo htmlspecialchars($result['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="descripcion" rows="5" required><?php echo htmlspecialchars($result['descripcion']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Canal</button>
        </form>

        <h2>Canal Messages</h2>
        <div class="chat-container">
            <?php
            // Fetch messages related to the canal
            $messageQuery = "SELECT * FROM mensajes WHERE canal_id = ?";
            $messageStmt = $pdo->prepare($messageQuery);
            $messageStmt->execute([$canalId]);
            $messages = $messageStmt->fetchAll();

            foreach ($messages as $message): ?>
                <div class="chat-bubble">
                    <strong><?php echo htmlspecialchars($message['usuario_id']); ?>:</strong>
                    <p id="message-<?php echo $message['id']; ?>"><?php echo nl2br(htmlspecialchars($message['contenido'])); ?></p>
                    <p><em><?php echo $message['fecha']; ?></em></p>
                    <button onclick="deleteMessage(<?php echo $message['id']; ?>)" class="btn btn-danger">Delete</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    function deleteMessage(messageId) {
        if (confirm("Are you sure you want to delete this message?")) {
            fetch(`adminDelete.php?id=${messageId}`, {
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