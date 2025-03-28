<?php
// Recibir los datos enviados a través de POST
$data = json_decode(file_get_contents('php://input'), true);

// Si los datos son correctos, se puede acceder a la variable 'videos'
$videos = $data['videos'];  // Accedemos a los datos de los videos enviados

// Aquí procesamos los videos para mostrarlos en el carrusel
$chunkedVideos = array_chunk($videos, 16); // Divide en grupos de 16
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_2.css">
    <title>Widget Carrusel</title>
</head>
<body><br>
    <center>
        <div class="carousel-container">
            <div class="carousel-wrapper">
                <?php foreach ($chunkedVideos as $chunk): ?>
                    <div class="carousel-slide">
                        <?php foreach ($chunk as $video): ?>
                            <div class="video-item">
                                <img src="<?=$video['thumbnail']?>" alt="Imagen">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="nav-buttons">
                <button id="prevBtn">❮</button>
                <button id="nextBtn">❯</button>
            </div>
        </div>
    </center>
    <br>
</body>
</html>
