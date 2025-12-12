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
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_4.css">
    <title>Widget Carrusel</title>
</head>
<body><br>
    <center><div class="carousel-container">
        <div class="carousel-wrapper">
            <?php 
            $chunkedVideos = array_chunk($videos, 8); // Dividir en grupos de 6 elementos por slide
            foreach ($chunkedVideos as $chunk): ?>
                <div class="carousel-slide">
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
        <div class="nav-buttons">
            <button id="prevBtn">❮</button>
            <button id="nextBtn">❯</button>
        </div>
    </div></center>
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
    <br>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slides = document.querySelectorAll(".carousel-slide");
            const totalSlides = slides.length;
            let currentIndex = 0;

            document.getElementById("nextBtn").addEventListener("click", () => {
                if (currentIndex < totalSlides - 1) {
                    currentIndex++; // Solo avanza si no está en el último slide
                    updateCarousel();
                }
            });

            document.getElementById("prevBtn").addEventListener("click", () => {
                if (currentIndex > 0) {
                    currentIndex--; // Solo retrocede si no está en el primer slide
                    updateCarousel();
                }
            });

            function updateCarousel() {
                const offset = -currentIndex * 100;
                document.querySelector(".carousel-wrapper").style.transform = `translateX(${offset}%)`;
            }
        });
    </script>
</body>
</html>
