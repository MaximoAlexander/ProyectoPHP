<div class="chat-container"> 
    <?php foreach ($mensajes as $mensaje): ?> 
        <div class="chat-bubble"> 
            <img alt="User  avatar" class="avatar" height="50px" src="../SRC/OIP.jpeg" width="50px"/> 
            <div class="chat-content"> 
                <strong><?php echo htmlspecialchars($mensaje['nombre']); ?>:</strong> 
                <p id="mensaje-<?php echo $mensaje['id']; ?>"><?php echo nl2br(htmlspecialchars($mensaje['contenido'])); ?></p> 
                <?php if ($mensaje['imagen']): ?> 
                    <img src="../uploads/<?php echo htmlspecialchars($mensaje['imagen']); ?>" alt="Imagen" style ="width: 100px; border-radius:5%"> 
                <?php endif; ?> 
                <?php if ($mensaje['video']): ?> 
                    <iframe width="200" height="100" src="<?php echo htmlspecialchars($mensaje['video']); ?>" frameborder="0" allowfullscreen></iframe> 
                <?php endif; ?> 
                <p><em><?php echo $mensaje['fecha']; ?></em></p> 

                <?php if ($mensaje['usuario_id'] == $_SESSION['user_id']): ?> 
                    <button onclick="showEditField(<?php echo $mensaje['id']; ?>)" style="background-color: blue; color: white;"> 
                        <i class="fas fa-edit"></i> 
                    </button> 
                    <button onclick="deleteMessage(<?php echo $mensaje['id']; ?>)" style="background-color: red; color: white;"> 
                        <i class="fas fa-trash"></i> 
                    </button> 
                <?php endif; ?> 
                <div id="edit-field-<?php echo $mensaje['id']; ?>" style="display:none;"> 
                    <textarea id="edit-text-<?php echo $mensaje['id']; ?>" rows="2"><?php echo htmlspecialchars($mensaje['contenido']); ?></textarea> 
                    <button onclick="saveEdit(<?php echo $mensaje['id']; ?>)">Guardar</button> 
                </div> 
            </div> 
        </div> 
    <?php endforeach; ?> 
</div> 

<script> 
function showEditField(messageId) { 
    const editField = document.getElementById('edit-field-' + messageId); 
    editField.style.display = editField.style.display === 'none' ? 'block' : 'none'; 
} 

function deleteMessage(messageId) { 
    fetch(`../MAIN/delete_message.php?id=${messageId}`, { 
        method: 'DELETE' 
    }) 
    .then(response => { 
        if (response.ok) { 
            document.getElementById('mensaje-' + messageId).parentElement.parentElement.remove(); 
        } else { 
            alert("Error al borrar el mensaje."); 
        } 
    }) 
    .catch(error => { 
        console.error('Error:', error); 
    }); 
} 

function saveEdit(messageId) { 
    const newContent = document.getElementById('edit-text-' + messageId).value; 
    fetch(`../MAIN/edit_message.php`, { 
        method: 'POST', 
        headers: { 
            'Content-Type': 'application/json' 
        }, 
        body: JSON.stringify({ 
            id: messageId, 
            contenido: newContent 
        }) 
    }) 
    .then(response => { 
        if (response.ok) { 
            document.getElementById('mensaje-' + messageId).innerHTML = nl2br(htmlspecialchars(newContent)); 
            showEditField(messageId); // Ocultar el campo de edición
        } else { 
            alert("Error al editar el mensaje."); 
        } 
    }) 
    .catch(error => { 
        console.error('Error:', error); 
    }); 
    location.reload();
} 
</script>