<?php
// URL de las imágenes y descripciones
$imageUrl = "https://placehold.co/560x315/aa0000/FFF";
$description = "Esta es una descripción de la imagen.";
$imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
$description2 = "Segunda descripción de la imagen.";
$imageUrl3 = "https://placehold.co/560x315/ffcc00/FFF";
$description3 = "Tercera descripción de la imagen.";

$responses = [];

for ($i = 0; $i < 6; $i++) {  // 6 elementos en total por slide
    $responses[] = ["image_url" => $imageUrl, "description" => $description];
    $responses[] = ["image_url" => $imageUrl2, "description" => $description2];
    $responses[] = ["image_url" => $imageUrl3, "description" => $description3];
}

// Convertir a JSON para manejar con JS
$videos = json_encode($responses);
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
            $chunkedVideos = array_chunk($responses, 8); // Dividir en grupos de 6 elementos por slide
            foreach ($chunkedVideos as $chunk): ?>
                <div class="carousel-slide">
                    <?php foreach ($chunk as $video): ?>
                        <div class="video-item">
                            <img src="<?=$video['image_url']?>" alt="Imagen">
                            <div class="descripcion">
                                <p><?=$video['description']?></p>
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
