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
                    <div class="video-item" 
                        data-video-id="<?= htmlspecialchars($video['id'], ENT_QUOTES, 'UTF-8') ?>" 
                        data-video-title="<?= htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8') ?>" 
                        data-video-views="<?= htmlspecialchars($video['views'], ENT_QUOTES, 'UTF-8') ?>"
                        onclick="playvideoFromData(this)">
                        <div class="miniatura">
                            <img src="<?=$video['thumbnail']?>" alt="Imagen">
                            <button class="play-button"></button>
                            <span class="video-duration"><?=$video['duration']?></span>
                        </div>
                        <div class="descripcion">
                            <div class="vd_titulo"><strong><?= $video['title']?></strong></div>
                            <div class="video-info"><?=$video['publishedAt']?></div>
                            <div class="vd-dscpn"><?=$video['description']?></div>
                            <div class="video-info"><?=$video['views']?> vistas • <?=$video['likes']?> likes • <?=$video['comments']?> comentarios</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Botón de "Siguiente" (apunta hacia abajo) -->
    <button id="nextBtn" class="nav-button"><i class="fa-solid fa-chevron-down"></i></button>  
</div>
<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>

                
                <div class="iframe-container">
                    <iframe id="videoFrame" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                
                <div class="modal-extra-content">
                    <p id="modal_titulo" style="font-size: 25px"></p>
                    <p id="md_views"></p>
                </div>
            </div>
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
