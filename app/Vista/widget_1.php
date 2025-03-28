<?php
// URL de las imágenes y descripciones
$idvid = "12546398";
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

for ($i = 0; $i < 25; $i++) {
    $responses[] = ["thumbnail" => $imageUrl, "description" => $description, "id" => $idvid, "duration" => $duracion, "title" => $titulo, "publishedAt" => $fecha, "views" => $vistas, "likes" => $likes, "comments" => $coment];
    $responses[] = ["thumbnail" => $imageUrl2, "description" => $description2, "id" => $idvid2, "duration" => $duracion2, "title" => $titulo2, "publishedAt" => $fecha2, "views" => $vistas2, "likes" => $likes2, "comments" => $coment2];
    $responses[] = ["thumbnail" => $imageUrl3, "description" => $description3, "id" => $idvid3, "duration" => $duracion3, "title" => $titulo3, "publishedAt" => $fecha3, "views" => $vistas3, "likes" => $likes3, "comments" => $coment3];
}

$datos = [];
$idcan = "125483325";
$nombre = "YORDUCIIITO";
$img_per = "https://placehold.co/560x560/bbaaaa/FFF";
$subs = 152;
$canvid = 12;
$canvis = 10002;
$portada ="https://placehold.co/1060x560/aa22aa/FFF";
$datos[] = ["id_canal" => $idcan, "nom_can" => $nombre, "img_perfil" => $img_per, "suscriptores" => $subs, "cant_videos" => $canvid, "cant_vistas" => $canvis, "img_portada" => $portada];
// Convertir a JSON para manejar con JS
$videos = json_encode($responses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <p class="stats"><?= $datos[0]['suscriptores'] ?> Suscriptores • 11K Videos • 188 Vistas</p>
                <button class="subscribe-btn btn">
                    <img src="youtube-icon.png" alt="YouTube"> Youtube 32M
                </button>
                <br><br><br>
            </div><br>
            <div class="gallery-container">
                <button class="gallery-nav-btn gallery-prev" onclick="prevPage()"><-</button>
                <div class="gallery"></div>
                <button class="gallery-nav-btn gallery-next" onclick="nextPage()">-></button>
            </div><br><br><br><br><br><br><br>
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
        let currentIndex = 0;
        const videosPerPage = 3;

        function renderVideos() {
            const gallery = document.querySelector('.gallery');
            gallery.innerHTML = '';
            for (let i = currentIndex; i < currentIndex + videosPerPage && i < videos.length; i++) {
                let id_vid = videos[i]["id"];
                let imagen = videos[i]["thumbnail"];
                let duracion = videos[i]["duration"];
                let titulo = videos[i]["title"];
                let fecha = videos[i]["publishedAt"];
                let vista = videos[i]["views"];
                let likes = videos[i]["likes"];
                let coment = videos[i]["comments"];
                
                gallery.innerHTML += `
                    <div class="video" onclick="playvideo(\'${id_vid}\',\'${titulo}\',\'${vista}\')">
                        <img src="${imagen}" alt="Miniatura 3" class="thumbnail">
                        <button class='play-button'></button>
                        <span class='video-duration'>${duracion}</span>
                        <p class="video-title"><strong>${titulo}</strong></p>
                        <p class="video-info">${fecha}</p><br><br>
                        <p class="video-info">${vista} vistas • ${likes} likes • ${coment} comentarios</p>
                    </div>`;
            }
            updatePagination();
        }

        function updatePagination() {
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';
            let totalPages = Math.ceil(videos.length / videosPerPage);
            for (let i = 0; i < totalPages; i++) {
                pagination.innerHTML += `<button class="${i * videosPerPage === currentIndex ? 'active' : ''}" onclick="goToPage(${i})">${i + 1}</button>`;
            }
        }

        function goToPage(page) {
            currentIndex = page * videosPerPage;
            renderVideos();
        }

        function nextPage() {
            if (currentIndex + videosPerPage < videos.length) {
                currentIndex += videosPerPage;
                renderVideos();
            }
        }

        function prevPage() {
            if (currentIndex - videosPerPage >= 0) {
                currentIndex -= videosPerPage;
                renderVideos();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderVideos();
        });

        function playVideo(videoId) {
            alert("Reproduciendo video: " + videoId);
            
        }
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