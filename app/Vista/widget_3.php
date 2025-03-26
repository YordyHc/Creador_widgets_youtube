<?php
// URL de las imágenes y descripciones
$imageUrl = "https://placehold.co/560x315/000000/FFF";
$description = "Esta es una descripción de la imagen.";
$imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
$description2 = "Segunda descripción de la imagen.";
$imageUrl3 = "https://placehold.co/560x315/ffcc00/FFF";
$description3 = "Tercera descripción de la imagen.";

$responses = [];

for ($i = 0; $i < 9; $i++) {
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
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_3.css">
    <title>Lista Vertical</title>
</head>
<body>

<div class="con_1">
    <!-- Botón de "Anterior" (apunta hacia arriba) -->
    <button id="prevBtn" class="nav-button"> ꜛ </button>  

    <div class="lista" id="lista">
        <?php 
        $chunkedVideos = array_chunk($responses, 4); // Grupos de 4 filas
        foreach ($chunkedVideos as $index => $chunk): ?>
            <div class="video-group">
                <?php foreach ($chunk as $video): ?>
                    <div class="video-item">
                        <div class="miniatura">
                            <img src="<?=$video['image_url']?>" alt="Imagen">
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
    <button id="nextBtn" class="nav-button"> ˅ </button>  
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
