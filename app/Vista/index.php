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
            <div class="input-container container" id="input-container"></div>
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
            <div class="elegir container border" id="elegir">
                <button class="btn btn-enbusca "onclick="pasarABuscar()">Continuar con esta plantilla</button>
            </div>
        </div>
        <div class="muestras container border" id="muestras">
        </div>
    </div>
    <script>
        var widget = 1;
        // Función que se ejecuta cuando se presiona el botón
        function pasarABuscar() {
            // Cambiar el texto en el div con clase 'head_opcion'
            const headOpcion = document.querySelector('.head_opcion p');
            headOpcion.textContent = "Fuente";

            // Eliminar todos los div con la clase 'opcion'
            const opciones = document.querySelectorAll('.opcion');
            opciones.forEach(opcion => {
                opcion.remove();
            });
            const btnCont = document.querySelector('.btn-enbusca');
            btnCont.remove();
            // Crear una nueva caja de texto (input) y un label
            const inputContainer = document.getElementById('input-container');
            const elecont = document.getElementById('elegir');
            // Crear el label
            const label = document.createElement('label');
            label.textContent = 'Ingresa URL de canal de YouTube';
            label.setAttribute('for', 'userInput');  // Asegura que el label se asocie con el input

            // Crear un nuevo input
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.id = 'userInput';  // Asignamos un id al input
            newInput.classList.add('form-control');
            newInput.placeholder = 'URL';
            newInput.value = 'https://www.youtube.com/channel/UCdcF7At6z9uYbuPZiIYNkYQ';  // Asignamos un valor predeterminado al input
            
            const nbtn = document.createElement('button');
            nbtn.id = 'btn-probar';
            nbtn.classList.add('btn-probar', 'btn', 'btn-primary');
            nbtn.textContent = 'Probar';
            nbtn.onclick = probarUrlWidget;

            const btnSeleccionar = document.createElement('button');
            btnSeleccionar.id = 'btn-selec';
            btnSeleccionar.classList.add('btn-selec', 'btn');
            btnSeleccionar.textContent = 'Crear Widget';
            btnSeleccionar.onclick = crearWidget;


            // Agregar el label y el input al contenedor de inputs
            inputContainer.appendChild(label);
            inputContainer.appendChild(newInput);
            inputContainer.appendChild(nbtn);
            elecont.appendChild(btnSeleccionar);
        }

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
                widget = 1;
                widget1(); 
                initializeModal();
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
                widget = 2;
                asignarEventosCarousel();
            }).catch(error => {
                console.error(error);
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
                widget = 3;
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
                widget = 4;
                carrusel4();
            })
            .catch(error => {
                console.error(error);
            });
        }

        // Cargar inicialmente el Documento 2 al cargar la página
        window.onload = cargarWidget1;
        function probarUrlWidget() {
            // Obtener el valor del input
            const input = document.getElementById('userInput');
            const url = input.value;

            // Mostrar el valor ingresado en la consola
            console.log('Valor ingresado en el input:', url);

            // Validar si la URL es un canal de YouTube
            const youtubePattern = /^https?:\/\/(www\.)?youtube\.com\/(channel\/([a-zA-Z0-9_-]+)|c\/([a-zA-Z0-9_-]+)|user\/([a-zA-Z0-9_-]+)|@([a-zA-Z0-9_]+))$/;
            const match = url.match(youtubePattern);
            
            if (url && match) {
                console.log('La URL es un canal de YouTube válido:', url);

                // Extraer el ID del canal o el nombre de usuario dependiendo de la URL
                let channelId = '';
                let username = '';

                // Revisar las posibles posiciones de los valores en la expresión regular
                if (match[3]) {
                    channelId = match[3]; // Canal con ID (channel/)
                } else if (match[4]) {
                    channelId = match[4]; // Canal con ID (c/)
                } else if (match[5]) {
                    username = match[5]; // Canal con nombre de usuario (user/)
                } else if (match[6]) {
                    username = match[6]; // Canal con nombre de usuario (@)
                }

                // Preparar los datos para la solicitud AJAX
                const data = {
                    channelId: channelId,
                    username: username
                };

                // Realizar la solicitud AJAX
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'app/Modelo/procesar_url.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        try {
                            // Verificar si la respuesta es JSON válida
                            const response = JSON.parse(xhr.responseText);

                            // Comprobar si la respuesta tiene un status de error
                            if (response.status && response.status === 'error') {
                                console.error('Error desde el servidor:', response.message);
                            } else {

                                console.log('Si hay respuesta de servidor'/*, response*/);
                                // Acceder a los datos correctamente
                                datosData = response.perfil; // Datos del perfil
                                videosData = response.videos; // Datos de los videos
                                if (widget == 1) {
                                    console.log('actualizar widget 1');
                                    cargarWidget1();
                                } else if (widget == 2) {
                                    cargarWidget2();
                                } else if (widget == 3) {
                                    cargarWidget3();
                                } else if (widget == 4) {
                                    cargarWidget4();
                                }
                            }
                        } catch (e) {
                            console.error('Error al parsear la respuesta JSON:', e);
                            console.error('Respuesta del servidor:', xhr.responseText); // Muestra la respuesta completa para depuración
                        }
                    } else {
                        console.error('Error al procesar la solicitud. Estado HTTP:', xhr.status);
                    }
                };

                xhr.onerror = function () {
                    console.error('Error de red o problema con la solicitud AJAX');
                };
                xhr.send(JSON.stringify(data));
            } else {
                console.log('La URL no es un canal de YouTube válido.');
                // Aquí también puedes agregar un mensaje de error visible al usuario si lo deseas.
            }
        }

        function crearWidget(){
            //logica para mpostrar el script
            console.log(retornarScript("ywt" + String(widget)));
        }
    </script>

  <script src="/creacion_widgets_youtube/script/asignarEventos.js"></script>
</body>
</html>