<?php
// URL de las imágenes y descripciones
$imageUrl = "https://placehold.co/560x315/000000/FFF"; // URL de la imagen
$description = "Esta es una descripción de la imagen."; // Descripción de la imagen
$imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
$description2 = "Segunda descripción de la imagen";

// Crear un array para almacenar todas las respuestas
$responses = array();

// Ejecutar el ciclo 10 veces
for ($i = 0; $i < 10; $i++) {
    // Añadir primera respuesta
    $response = array(
        "image_url" => $imageUrl,
        "description" => $description
    );
    $responses[] = $response;

    // Añadir segunda respuesta
    $response = array(
        "image_url" => $imageUrl2,
        "description" => $description2
    );
    $responses[] = $response;
}

// Convertir el array en JSON
$videos = json_encode($responses);

// Decodificar el JSON para trabajar con él en PHP
$videosDecoded = json_decode($videos, true);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_2.css">
    <title>widget 2</title>
</head>
<body><br>
    <div class="ven_2 container-fluid border">
    <?php foreach ($videosDecoded as $video): ?>
        <div class='video-item container'>
            <img src="<?=$video['image_url']?>" class="img-fluid" alt='Imagen'>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>
