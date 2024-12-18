<form action="../MAIN/foro.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <textarea class="form-control" name="contenido" rows="3" required placeholder="Escribe tu mensaje..."></textarea>
    </div>
    <div class="buttons" style="display: flex; padding-bottom: 1%;">
        <div class="g-3">
            <div class="input-group">
                <input type="file" name="imagen" id="imagen" style="display: none;" onchange="updateImageLabel(this)">
                <button type="button" class="btn btn-outline-secondary" onclick="document.getElementById('imagen').click();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="g-3" style="padding-left: 1%;">
            <div class="input-group">
                <input type="text" name="video" id="video" class="form-control" placeholder="https://www.youtube.com/watch?v=..." style="display: none;">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleVideoInput();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-link-45deg" viewBox="0 0 16 16">
                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
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