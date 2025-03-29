<?php
// URL de las imágenes y descripciones
/*$idvid = "12546398";
$imageUrl = "https://placehold.co/560x315/000000/FFF";
$description = "Esta es una descripción de la imagen.";
$duracion = "14:23";
$titulo = "HOY SE COME";
$fecha = "12/02/2022";
$vistas = 18888;
$likes = 12;
$coment = 25;
$idvid2 = "4546398";
$imageUrl2 = "https://placehold.co/560x315/00cc00/FFF";
$description2 = "Segunda descripción de la imagen.";
$duracion2 = "10:57";
$titulo2 = "NUNVCA MAAASS";
$fecha2 = "08/02/2021";
$vistas2 = 18;
$likes2 = 1;
$coment2 = 10;
$idvid3 = "78046398";
$imageUrl3 = "https://placehold.co/560x315/bbcc00/FFF";
$description3 = "Tercera descripción de la imagen.";
$duracion3 = "07:15";
$titulo3 = "UN DIA MAS";
$fecha3 = "22/05/2018";
$vistas3 = 1758;
$likes3 = 25;
$coment3 = 27;

$responses = [];

$datosper = [];
$idcan = "125483325";
$nombre = "YORDICIIITO";
$img_per = "https://placehold.co/560x560/bb05aa/FFF";
$subs = 152;
$canvid = 12;
$canvis = 10002;
$portada ="https://placehold.co/1060x560/5522aa/FFF";
$datosper[] = ["id_canal" => $idcan, "nom_can" => $nombre, "img_perfil" => $img_per, "suscriptores" => $subs, "cant_videos" => $canvid, "cant_vistas" => $canvis, "img_portada" => $portada];
// Convertir a JSON para manejar con JS
for ($i = 0; $i < 6; $i++) {
    $responses[] = ["thumbnail" => $imageUrl, "description" => $description, "id" => $idvid, "duration" => $duracion, "title" => $titulo, "publishedAt" => $fecha, "views" => $vistas, "likes" => $likes, "comments" => $coment];
    $responses[] = ["thumbnail" => $imageUrl2, "description" => $description2, "id" => $idvid2, "duration" => $duracion2, "title" => $titulo2, "publishedAt" => $fecha2, "views" => $vistas2, "likes" => $likes2, "comments" => $coment2];
    $responses[] = ["thumbnail" => $imageUrl3, "description" => $description3, "id" => $idvid3, "duration" => $duracion3, "title" => $titulo3, "publishedAt" => $fecha3, "views" => $vistas3, "likes" => $likes3, "comments" => $coment3];
    $responses[] = ["thumbnail" => $imageUrl2, "description" => $description2, "id" => $idvid2, "duration" => $duracion2, "title" => $titulo2, "publishedAt" => $fecha2, "views" => $vistas2, "likes" => $likes2, "comments" => $coment2];
}
$datos = $datosper;
$videos = $responses;*/
// Recibir los datos enviados a través de POST
$data = json_decode(file_get_contents('php://input'), true);

// Acceder a los datos enviados
$videos = $data['videos'];  // Los datos de los videos
$datos = $data['datos'];  
$chunkedVideos = array_chunk($videos, 3); // Divide los videos en grupos de 3
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_1.css">
    <title>widget 1</title>
</head>
<body>
<div class="container-fluid ">
        <div class="container-fluid">
            <div class="header-container" >
                <img src="<?= $datos[0]['img_portada'] ?>" class="rounded-top"alt="Banner">
            </div><br><br>
            <div class="profile"><br><br><br><br><br>
                <img src="<?= $datos[0]['img_perfil']?>"  alt="Perfil">
                <h2><a href="https://www.youtube.com/channel/<?= $datos[0]['id_canal']?>"><?= $datos[0]['nom_can'] ?></a></h2><br><br>
                <p class="stats"><?= $datos[0]['suscriptores'] ?> Suscriptores • 11K Videos • 200 Vistas</p>
                <button class="subscribe-btn btn">
                    <i class="fa-brands fa-youtube"></i> Youtube 32M
                </button>
                <br><br><br>
            </div><br>
            <center><div class="gallery-container">
                <button class="gallery-nav-btn btn gallery-prev" onclick="prevPage()">❮</button>
                <div class="gallery">
                    <?php foreach ($chunkedVideos as $chunk): ?>
                        <div class="carousel-slide">
                            <?php foreach ($chunk as $video): ?>
                                <div class="video" 
                                    data-video-id="<?= htmlspecialchars($video['id'], ENT_QUOTES, 'UTF-8') ?>" 
                                    data-video-title="<?= htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8') ?>" 
                                    data-video-views="<?= htmlspecialchars($video['views'], ENT_QUOTES, 'UTF-8') ?>"
                                    onclick="playvideoFromData(this)">
                                    <div class="miniatura">
                                        <img src="<?=$video["thumbnail"]?>" alt="Miniatura 3" class="thumbnail">
                                        <button class="play-button"></button>
                                        <span class="video-duration"><?=$video['duration']?></span>
                                    </div>
                                    <div class="texto">
                                        <p class="video-title"><strong><?=$video['title']?></strong></p>
                                        <p class="video-info"><?=$video['publishedAt']?></p><br><br>
                                        <p class="video-info"><?=$video['views']?> vistas • <?=$video['likes']?> likes • <?=$video['comments']?> comentarios</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="gallery-nav-btn btn gallery-next" onclick="nextPage()">❯</button>
            </div></center><br><br><br>
            <div class="controls">
                <div class="pagination"></div>
            </div>
        </div>
        <br><br>
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
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".carousel-slide");
    const totalSlides = slides.length;
    const itemsPerPage = 1; // Un slide por página
    let currentIndex = 0;
    const paginationContainer = document.querySelector(".pagination");

    // Generar los botones de paginación
    const totalPages = Math.ceil(totalSlides / itemsPerPage);
    for (let i = 0; i < totalPages; i++) {
        const pageButton = document.createElement("button");
        pageButton.textContent = i + 1;
        pageButton.classList.add("pagination-btn");
        pageButton.addEventListener("click", () => goToPage(i));
        paginationContainer.appendChild(pageButton);
    }

    // Navegar a una página específica
    function goToPage(pageIndex) {
        currentIndex = pageIndex;
        updateCarousel();
        updatePagination();
    }

    // Función para actualizar la vista del carrusel
    function updateCarousel() {
        const gallery = document.querySelector(".gallery");
        const offset = -currentIndex * 100; // Desplazamiento por cada slide
        gallery.style.transform = `translateX(${offset}%)`;
    }

    // Actualizar los estilos de los botones de paginación
    function updatePagination() {
        const pageButtons = document.querySelectorAll(".pagination-btn");
        pageButtons.forEach((button, index) => {
            if (index === currentIndex) {
                button.classList.add("active"); // Resaltar el botón activo
            } else {
                button.classList.remove("active");
            }
        });
    }

    // Configurar los botones de siguiente y anterior
    document.querySelector(".gallery-next").addEventListener("click", () => {
        if (currentIndex < totalSlides - 1) {
            currentIndex++; // Avanza al siguiente slide
            updateCarousel();
            updatePagination();
        }
    });

    document.querySelector(".gallery-prev").addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--; // Retrocede al slide anterior
            updateCarousel();
            updatePagination();
        }
    });

    // Inicializa la paginación
    updatePagination();
});

</script>

    <script>
        var modal = document.getElementById("myModal");
        var closeBtn = document.getElementsByClassName("close")[0];
        var videoFrame = document.getElementById("videoFrame");

        function playvideo(id_video, titulo, vista) {
            modal.style.display = "flex"; 
            videoFrame.src = "https://www.youtube.com/embed/" + id_video + "?si=bAtHCHmwT3C25Gry&autoplay=1&rel=0";
            document.getElementById("modal_titulo").innerText = titulo;
            document.getElementById("md_views").innerText = vista+' vistas';
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
            videoFrame.src = ""; 
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                videoFrame.src = ""; 
            }
        }
    </script>
</body>
</html>