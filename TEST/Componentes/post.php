<form action="../MAIN/foro.php?cForum="<?php echo $currentForum; ?> method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <textarea class="form-control" name="contenido" rows="3" required placeholder="Escribe tu mensaje..."></textarea>
    </div>
    <div class="buttons" style="display: flex; padding-bottom: 1%;">
        <div class="g-3">
            <div class="input-group">
                <input type="file" name="imagen" id="imagen" style="display: none;" onchange="updateImageLabel(this)">
                <input type="hidden" name="canalObj" value="<?php echo $currentForum; ?>">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('imagen').click();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Publicar</button>
</form>

<script>
    function updateImageLabel(input) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
        }
    }

    function toggleVideoInput() {
        const videoInput = document.getElementById('video');
        videoInput.style.display = videoInput.style.display === 'none' ? 'block' : 'none';
    }
</script>