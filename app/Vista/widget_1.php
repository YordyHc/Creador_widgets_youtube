<?php
// Recibir los datos enviados a través de POST
$data = json_decode(file_get_contents('php://input'), true);

// Acceder a los datos enviados
$videos = $data['videos'];  // Los datos de los videos
$datos = $data['datos'];    // Los datos adicionales
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_1.css">
    <title>widget 1</title>
    <script>
        let videos = <?php echo $videos; ?>; 
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
                <p class="stats"><?= $datos[0]['suscriptores'] ?> Suscriptores • 11K Videos • 198 Vistas</p>
                <button class="subscribe-btn btn">
                    <i class="fa-brands fa-youtube"></i> Youtube 32M
                </button>
                <br><br><br>
            </div><br>
            <div class="gallery-container">
                <button class="gallery-nav-btn gallery-prev" onclick="prevPage()">❮</button>
                <div class="gallery"></div>
                <button class="gallery-nav-btn gallery-next" onclick="nextPage()">❯</button>
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