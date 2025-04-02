<?php
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
                <img src="<?= isset($datos[0]) ? $datos[0]['img_portada'] : (isset($datos['img_portada']) ? $datos['img_portada'] : 'No se encontró la imagen de portada.');?>" class="rounded-top"alt="Banner">
            </div><br><br>
            <div class="profile"><br><br><br><br><br>
                <img src="<?=isset($datos[0]) ? $datos[0]['img_perfil'] : (isset($datos['img_perfil']) ? $datos['img_perfil'] : 'No se encontró la imagen de perfil.');?>"  alt="Perfil">
                <h2><a href="https://www.youtube.com/channel/<?=isset($datos[0]) ? $datos[0]['id_canal'] : (isset($datos['id_canal']) ? $datos['id_canal'] : 'No se encontró id');?>"><?= isset($datos[0]) ? $datos[0]['nom_can'] : (isset($datos['nom_can']) ? $datos['nom_can'] : 'No se encontró nombre'); ?></a></h2><br><br>
                <p class="stats"><?= isset($datos[0]) ? $datos[0]['suscriptores'] : (isset($datos['suscriptores']) ? $datos['suscriptores'] : 'No se encontro subs');?> Suscriptores • 
                <?=isset($datos[0]) ? $datos[0]['cant_videos'] : (isset($datos['cant_videos']) ? $datos['cant_videos'] : 'No se encontro videos');?> Videos • 
                <?=isset($datos[0]) ? $datos[0]['cant_vistas'] : (isset($datos['cant_vistas']) ? $datos['cant_vistas'] : 'No se encontro vistas');?> Vistas</p>
                <button class="subscribe-btn btn">
                    <i class="fa-brands fa-youtube"></i> Youtube 32M
                </button>
                <br><br><br>
            </div><br>
            <center><div class="gallery-container">
                <button class="gallery-nav-btn btn gallery-prev">❮</button><!--onclick="prevPage()"-->
                <div class="gallery">
                    <?php foreach ($chunkedVideos as $chunk): ?>
                        <div class="carousel-slide">
                            <?php foreach ($chunk as $video): ?>
                                <div class="video container" 
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
                                        <p class="video-title"><strong><?= htmlspecialchars($video['title'], ENT_QUOTES, 'UTF-8')?></strong></p>
                                        <p class="video-info"><?=$video['publishedAt']?></p><br><br>
                                        <p class="video-info"><?=$video['views']?> vistas • <?=$video['likes']?> likes • <?=$video['comments']?> comentarios</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="gallery-nav-btn btn gallery-next">❯</button><!--onclick="nextPage()"-->
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