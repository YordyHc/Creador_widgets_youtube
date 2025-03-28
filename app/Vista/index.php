<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/index.css">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_2.css">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_3.css">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/widget_4.css">
    <title>Gallery Youtube</title>
    <style>
    /* Estilos básicos */
    .muestras{
      margin: 20px;
      padding: 20px;
      border: 1px solid #ddd;
    }
  </style>
</head>
<body><br>
    <div class="ven_2 container-fluid rounded-4">
        <div class="opciones container border ">
            <div class="head_opcion container">
                <p>Seleccione una platilla</p>
            </div>
            <div class="opcion container border">
                <img src="https://placehold.co/150x150" class="img-fluid" alt="opcion_1">
                <p>galeria</p>
            </div>
            <div class="opcion container border" >
                <img src="https://placehold.co/150x150/aa0000/FFF" class="img-fluid" alt="opcion_2">
                <p>galeria</p>
            </div>
            <div class="opcion container">
                <img src="https://placehold.co/150x150/aacc00/FFF"  class="img-fluid" alt="opcion_3">
                <p>galeria</p>    
            </div>
            <div class="opcion container">
                <img src="https://placehold.co/150x150/ecac00/000" class="img-fluid" alt="opcion_4">    
                <p>galeria</p>
            </div>
            <button class="btn btn-primary" onclick="cargarWidget3()">Cargar Documento 3</button>
            <button class="btn btn-danger" onclick="cargarWidget4()">Cargar Documento 3</button>
        </div>
        <div class="muestras container border" id="muestras">

        </div>
    </div>
    <script>
        // Función para cargar el Documento 2
        function cargarWidget2() {
        fetch('app/Vista/widget_2.php')
            .then(response => response.text())
            .then(data => {
            // Insertar el HTML recibido en el contenedor con id 'muestras'
            document.getElementById('muestras').innerHTML = data;

            // Después de cargar el contenido, asignar los eventos a los botones del carrusel
            asignarEventosCarousel(); // Asigna los eventos ahora que el contenido está cargado
            });
        }

        // Función para cambiar a Documento 3 cuando se presiona el botón
        function cargarWidget3() {
            fetch('app/Vista/widget_3.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la carga del archivo');
                }
                return response.text();
            })
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
            fetch('app/Vista/widget_4.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la carga del archivo');
                }
                return response.text();
            })
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
        window.onload = cargarWidget2;
        </script>

  <script src="/creacion_widgets_youtube/script/widget_2.js"></script>
</body>
</html>