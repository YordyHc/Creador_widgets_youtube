<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/creacion_widgets_youtube/style/index.css">
    <title>Gallery Youtube</title>
</head>
<body><br>
<center><h1 class="fw-bold">CREA TU PROPIA GALERIA DE YOUTUBE</h1></center><br>
<center><div class="todo">
    <div class="hdr">
        <center><h5>Creando widget</h5></center>
    </div>
    <div class="ven_2">
        <div class="opciones container p-3 mb-2 bg-dark text-white">
            <div class="head_opcion container">
                <p>Seleccione una plantilla</p>
            </div>
            <div class="input-container container" id="input-container"></div>
            <div class="opcion container" onclick="cargarWidget1()">
                <div class="cont_img borde_c" id="cont_1">
                    <img src="imagenes/img_widget_1.png" class="img-fluid" alt="opcion_1">
                </div>
                <p>Canal de Youtube</p>
            </div>
            <div class="opcion container" onclick="cargarWidget2()">
                <div class="cont_img" id="cont_2">
                    <img src="imagenes/img_widget_2.png" class="img-fluid" alt="opcion_2">
                </div>
                <p>Cuadricula</p>
            </div>
            <div class="opcion container" onclick="cargarWidget3()">
                <div class="cont_img" id="cont_3">
                    <img src="imagenes/img_widget_3.png" class="img-fluid" alt="opcion_3">
                </div>
                <p>Lista</p>    
            </div>
            <div class="opcion container" onclick="cargarWidget4()">
                <div class="cont_img" id="cont_4">
                    <img src="imagenes/img_widget_4.png" class="img-fluid" alt="opcion_4">
                </div>   
                <p>Galeria</p>
            </div>
            <div class="elegir container" id="elegir">
                <button id="btn-enbusca" class="btn btn-enbusca "onclick="pasarABuscar()">Continuar con esta plantilla</button>
            </div>
        </div>
        <div class="muestras container" id="muestras">
        </div>
    </div>
</div></center><br>
<div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h5><strong>WIDGET GENERADO<br>INSERTE EL SCRIPT EN SU PROYECTO</strong></h5><br>
            <pre id="modal-body"></pre><br>
            <div class="confirmationMessage" id="confirmationMessage">Copiado</div>
            <button class="btn btn-success btn-sm"id="copyButton" onclick="copiarTexto()">Copiar script</button>
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
            const btnSeleccionar = document.getElementById("btn-enbusca");
            btnSeleccionar.id = 'btn-selec';
            btnSeleccionar.innerText = "Generar Widget";
            btnSeleccionar.onclick = crearWidget;
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
            newInput.value = 'https://www.youtube.com/channel/UCsMzBY3X_RS6GhGBiHXW19A';  // Asignamos un valor predeterminado al input
            
            // Crear un salto de línea (<br>)
            const lineBreak = document.createElement('br');

            // Crear el botón
            const nbtn = document.createElement('button');
            nbtn.id = 'btn-probar';
            nbtn.classList.add('btn-probar', 'btn', 'btn-primary');
            nbtn.textContent = 'Comprobar';
            nbtn.onclick = probarUrlWidget;

            // Agregar el label, el input, el <br>, y el botón al contenedor de inputs
            inputContainer.appendChild(label);
            inputContainer.appendChild(newInput);
            inputContainer.appendChild(lineBreak);  // Esto agrega el <br> entre el input y el botón
            inputContainer.appendChild(nbtn);
        }
        function bordear(id) {
            // Obtener los elementos por su ID
            var tenia = document.querySelector(".borde_c");
            var tendra = document.getElementById(id);

            // Quitar la clase de borde celeste de cont_1 (si la tiene)
            // Agregar la clase de borde celeste a cont_2
            tendra.classList.add("borde_c");
            tenia.classList.remove("borde_c");
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
                if(widget != 1){
                    bordear("cont_1");
                }
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
                if(widget != 2){
                    bordear("cont_2");
                }
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
                if(widget != 3){
                    bordear("cont_3");
                }
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
                if(widget != 4){
                    bordear("cont_4");
                }
                widget = 4;
                carrusel4();
            })
            .catch(error => {
                console.error(error);
            });
        }

        window.onload = cargarWidget1;
        function probarUrlWidget() {
            // Obtener el valor del input
            const input = document.getElementById('userInput');
            const url = input.value;

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
                    urlcan: url,
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

        function crearWidget() {
            const input = document.getElementById('userInput');
            const url = input.value;

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

                var contenido = retornarScript("ywt" + String(widget), channelId, username);
                document.getElementById("modal-body").innerText = contenido;
                document.getElementById("modal").style.display = "flex";
                window.onclick = function(event) {
                var modal = document.getElementById("modal");
                if (event.target === modal) {
                cerrarModal();
            }
        }
            }else {
                console.log('La URL no es un canal de YouTube válido.');
            }
        }
        function copiarTexto() {
            var texto = document.getElementById("modal-body").textContent || document.getElementById("modal-body").innerText;
            
            // Crear un área de texto temporal para poder copiar
            var areaTexto = document.createElement("textarea");
            areaTexto.value = texto;
            document.body.appendChild(areaTexto);
            
            // Seleccionar y copiar el texto
            areaTexto.select();
            document.execCommand("copy");
            
            // Eliminar el área de texto temporal
            document.body.removeChild(areaTexto);

            // Mostrar mensaje de confirmación
            var confirmationMessage = document.getElementById("confirmationMessage");
            confirmationMessage.style.display = "block";

            // Ocultar el mensaje después de 2 segundos
            setTimeout(function() {
                confirmationMessage.style.display = "none";
            }, 2000);
        }
        function cerrarModal() {
            document.getElementById("modal").style.display = "none";
        }
        // Obtenemos el contenido
            //const btnSeleccionar = document.getElementById("btn-selec");
            //btnSeleccionar.innerText = contenido;

    </script>
  <script src="/creacion_widgets_youtube/script/asignarEventos.js"></script>
</body>
</html>