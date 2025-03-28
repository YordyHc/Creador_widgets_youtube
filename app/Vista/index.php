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
$datos = json_encode($datosper);
$videos = json_encode($responses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/index.css">
    <title>Gallery Youtube</title>
</head>
<body><br>
    <div class="ven_2 container-fluid border">
        <div class="opciones container border ">
            <div class="head_opcion container">
                <p>Seleccione una platilla</p>
            </div>
            <div class="opcion container border" onclick="cargarWidget1()">
                <img src="https://placehold.co/150x150" class="img-fluid" alt="opcion_1">
                <p>galeria</p>
            </div>
            <div class="opcion container border" onclick="cargarWidget2()">
                <img src="https://placehold.co/150x150/aa0000/FFF" class="img-fluid" alt="opcion_2">
                <p>galeria</p>
            </div>
            <div class="opcion container" onclick="cargarWidget3()">
                <img src="https://placehold.co/150x150/aacc00/FFF"  class="img-fluid" alt="opcion_3">
                <p>galeria</p>    
            </div>
            <div class="opcion container" onclick="cargarWidget4()">
                <img src="https://placehold.co/150x150/ecac00/000" class="img-fluid" alt="opcion_4">    
                <p>galeria</p>
            </div>
        </div>
        <div class="muestras container border" id="muestras">
        </div>
    </div>
    <script>
        var datosData = <?php echo $datos; ?>;
        var videosData = <?php echo $videos; ?>;

        function cargarWidget1() {
            fetch('app/Vista/widget_1.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    videos: videosData,  // Enviar videosData
                    datos: datosData      // Enviar datosData
                })
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('muestras').innerHTML = data;
                // Volver a asociar los eventos después de cargar el nuevo contenido
                cargarvideos(); 
            })
            .catch(error => {
                console.error(error);
            });
        }
        function cargarWidget2() {
            fetch('app/Vista/widget_2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ videos: videosData }) // Envía los datos de videos en el cuerpo de la solicitud
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('muestras').innerHTML = data;
                asignarEventosCarousel();
            });
        }

        // Función para cambiar a Documento 3 cuando se presiona el botón
        function cargarWidget3() {
            fetch('app/Vista/widget_3.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({videos: videosData})
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('muestras').innerHTML = data;
                // Volver a asociar los eventos después de cargar el nuevo contenido
                agregarEventos();
            })
            .catch(error => {
                console.error(error);
            });
        }

        function cargarWidget4() {
            fetch('app/Vista/widget_4.php',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({videos: videosData})
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('muestras').innerHTML = data;
                // Volver a asociar los eventos después de cargar el nuevo contenido
                carrusel4();
            })
            .catch(error => {
                console.error(error);
            });
        }

        // Cargar inicialmente el Documento 2 al cargar la página
        window.onload = cargarWidget1;
        </script>

  <script src="/creacion_widgets_youtube/script/widget_2.js"></script>
</body>
</html>