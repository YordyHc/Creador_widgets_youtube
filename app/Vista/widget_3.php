<?php
// Recibir los datos enviados a través de POST
$data = json_decode(file_get_contents('php://input'), true);

// Si los datos son correctos, se puede acceder a la variable 'videos'
$videos = $data['videos'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Lista Vertical</title>
</head>
<body>

<div class="con_1">
    <!-- Botón de "Anterior" (apunta hacia arriba) -->
    <button id="prevBtn" class="nav-button"><i class="fa-solid fa-chevron-up"></i></button>  

    <div class="lista" id="lista">
        <?php 
        $chunkedVideos = array_chunk($videos, 4); // Grupos de 4 filas
        foreach ($chunkedVideos as $index => $chunk): ?>
            <div class="video-group">
                <?php foreach ($chunk as $video): ?>
                    <div class="video-item">
                        <div class="miniatura">
                            <img src="<?=$video['thumbnail']?>" alt="Imagen">
                        </div>
                        <div class="descripcion">
                            <p><?=$video['description']?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botón de "Siguiente" (apunta hacia abajo) -->
    <button id="nextBtn" class="nav-button"><i class="fa-solid fa-chevron-down"></i></button>  
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let index = 0;
        const lista = document.getElementById("lista");
        const groups = document.querySelectorAll(".video-group");
        const totalGroups = groups.length;

        function updateVisibility() {
            groups.forEach((group, i) => {
                group.style.display = i === index ? "block" : "none";
            });
        }

        document.getElementById("nextBtn").addEventListener("click", function() {
            if (index < totalGroups - 1) {
                index++;
                updateVisibility();
            }
        });

        document.getElementById("prevBtn").addEventListener("click", function() {
            if (index > 0) {
                index--;
                updateVisibility();
            }
        });

        updateVisibility(); // Mostrar la primera lista al cargar
    });
</script>

</body>
</html>
