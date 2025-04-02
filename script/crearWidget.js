document.addEventListener("DOMContentLoaded", function () {
  // Buscar el primer elemento con clase que empieza con 'yordwid-ywt'
  const container = document.querySelector('[class^="yordwid-ywt"]');

  if (container) {
    const className = container.className;

    // Usamos una expresión regular para extraer tanto la parte estática como la parte dinámica
    const match = className.match(/(yordwid-ywt\d+)-([a-f0-9\-]+)/);

    if (match) {
      const prefix = match[1]; // Esto es 'yordwid-ywt2' (o 'yordwid-ywt' + el número)
      const widgetId = match[2]; // Esto es el valor dinámico que sigue al 'yordwid-ywt2-'
      // Llamada para obtener los datos del widget (simulada aquí)
      loadWidgetData(prefix, widgetId);
    }
  }
});

// Simulación de la solicitud para cargar datos del widget
// Función que simula cargar datos del widget
function loadWidgetData(prefijo, widgetId) {
  // Cargar los estilos de Bootstrap si no están presentes
  addBootstrapStyles();

  // Lógica para recuperar id de canal o username (no implementada en este fragmento)
  // channelId = recuperarIdCanal(); // Ejemplo de cómo podrías obtener el channelId

  const data = {
    channelId: prefijo,
    username: widgetId,
  };

  // Realizar la solicitud AJAX
  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "../creacion_widgets_youtube/app/Modelo/procesar_url.php",
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onload = function () {
    if (xhr.status === 200) {
      try {
        // Verificar si la respuesta es JSON válida
        const response = JSON.parse(xhr.responseText);

        // Comprobar si la respuesta tiene un status de error
        if (response.status && response.status === "error") {
          console.error("Error desde el servidor:", response.message);
        } else {
          console.log("Respuesta recibida del servidor:", response);
          // Acceder a los datos correctamente
          if (prefijo == "yordwid-ywt1") {
            cargarWidget1(
              prefijo + "-" + widgetId,
              response.perfil,
              response.videos
            );
          } else if (prefijo == "yordwid-ywt2") {
            cargarWidget2(prefijo + "-" + widgetId, response.videos);
          } else if (prefijo == "yordwid-ywt3") {
            cargarWidget3(prefijo + "-" + widgetId, response.videos);
          } else if (prefijo == "yordwid-ywt4") {
            cargarWidget4(prefijo + "-" + widgetId, response.videos);
          }
        }
      } catch (e) {
        console.error("Error al parsear la respuesta JSON:", e);
        console.error("Respuesta del servidor:", xhr.responseText); // Muestra la respuesta completa para depuración
      }
    } else {
      console.error("Error al procesar la solicitud. Estado HTTP:", xhr.status);
    }
  };

  // Enviar la solicitud con los datos en formato JSON
  xhr.send(JSON.stringify(data));
}

function cargarWidget1(idWidget, perfildt, videosdt) {
  fetch("../creacion_widgets_youtube/app/Vista/widget_1.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      videos: videosdt, // Enviar videosData
      datos: perfildt, // Enviar datosData
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector(`.${idWidget}`).innerHTML = data;
      widget1();
      initializeModal();
    })
    .catch((error) => {
      console.error(error);
    });
}
// Función para renderizar el widget dentro del contenedor
function cargarWidget2(idWidget, videosdt) {
  fetch("../creacion_widgets_youtube/app/Vista/widget_2.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ videos: videosdt }), // Envía los datos de videos en el cuerpo de la solicitud
  })
    .then((response) => response.text())
    .then((data) => {
      // Asegúrate de usar el nombre correcto de la clase
      document.querySelector(`.${idWidget}`).innerHTML = data;
      asignarEventosCarousel();
    })
    .catch((error) => {
      console.error("Error al cargar el widget:", error);
    });
}

function cargarWidget3(idWidget, videosdt) {
  fetch("../creacion_widgets_youtube/app/Vista/widget_3.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ videos: videosdt }),
  })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector(`.${idWidget}`).innerHTML = data;
      agregarEventos();
    })
    .catch((error) => {
      console.error(error);
    });
}

function cargarWidget4(idWidget, videosdt) {
  fetch("../creacion_widgets_youtube/app/Vista/widget_4.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ videos: videosdt }),
  })
    .then((response) => response.text())
    .then((data) => {
      document.querySelector(`.${idWidget}`).innerHTML = data;
      carrusel4();
    })
    .catch((error) => {
      console.error(error);
    });
}
// Función para agregar los estilos de Bootstrap al <head> si no están presentes
function addBootstrapStyles() {
  // Verificar si Bootstrap ya ha sido cargado
  if (
    !document.querySelector(
      'link[href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"]'
    )
  ) {
    // Crear el elemento <link> para cargar el CSS de Bootstrap
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.href =
      "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";

    // Agregar el <link> al <head> del documento
    document.head.appendChild(link);
  }

  // Verificar si el script de Bootstrap ya ha sido cargado
  if (
    !document.querySelector(
      'script[src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"]'
    )
  ) {
    // Crear el elemento <script> para cargar el JS de Bootstrap
    const script = document.createElement("script");
    script.src =
      "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js";
    script.type = "text/javascript";

    // Agregar el <script> al final del body (mejor para rendimiento)
    document.body.appendChild(script);
  }
}

function widget1() {
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

  // Funcionalidad para el botón "next" (siguiente)
  document.querySelector(".gallery-next").addEventListener("click", () => {
    if (currentIndex < totalSlides - 1) {
      currentIndex++; // Avanza al siguiente slide
      updateCarousel();
      updatePagination();
    }
  });

  // Funcionalidad para el botón "prev" (anterior)
  document.querySelector(".gallery-prev").addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--; // Retrocede al slide anterior
      updateCarousel();
      updatePagination();
    }
  });
}

function playvideoFromData(videoElement) {
  var modal = document.getElementById("myModal");
  var videoFrame = document.getElementById("videoFrame");
  var videoId = videoElement.getAttribute("data-video-id");
  var videoTitle = videoElement.getAttribute("data-video-title");
  var videoViews = videoElement.getAttribute("data-video-views");

  // Mostrar el modal
  modal.style.display = "flex";
  videoFrame.src =
    "https://www.youtube.com/embed/" +
    videoId +
    "?si=bAtHCHmwT3C25Gry&autoplay=1&rel=0";
  document.getElementById("modal_titulo").innerText = videoTitle;
  document.getElementById("md_views").innerText = videoViews + " vistas";
}

// Función para inicializar el modal y los eventos
function initializeModal() {
  var modal = document.getElementById("myModal");
  var closeBtn = document.getElementsByClassName("close")[0];
  var videoFrame = document.getElementById("videoFrame");

  // Cerrar el modal
  closeBtn.onclick = function () {
    modal.style.display = "none";
    videoFrame.src = ""; // Detener el video
  };

  // Cerrar el modal si se hace clic fuera del modal
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
      videoFrame.src = ""; // Detener el video
    }
  };

  // Asocia la función `playvideoFromData` a cada video cargado en el contenido dinámico
  var videoElements = document.querySelectorAll(".video-item"); // Asegúrate de que el selector sea correcto
  videoElements.forEach(function (videoElement) {
    // Asociar el evento de clic con la función
    videoElement.onclick = function () {
      playvideoFromData(videoElement);
    };
  });
}

function asignarEventosCarousel() {
  let currentIndex = 0;
  const slides = document.querySelectorAll(".carousel-slide");
  const totalSlides = slides.length;

  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");

  if (nextBtn && prevBtn) {
    nextBtn.addEventListener("click", () => {
      if (currentIndex < totalSlides - 1) {
        currentIndex++; // Solo avanza si no está en el último slide
        updateCarousel();
      }
    });

    prevBtn.addEventListener("click", () => {
      if (currentIndex > 0) {
        currentIndex--; // Solo retrocede si no está en el primer slide
        updateCarousel();
      }
    });
  }

  function updateCarousel() {
    const offset = -currentIndex * 100;
    document.querySelector(
      ".carousel-wrapper"
    ).style.transform = `translateX(${offset}%)`;
  }
  initializeModal();
}

function agregarEventos() {
  let index = 0;
  const lista = document.getElementById("lista");
  const groups = document.querySelectorAll(".video-group");
  const totalGroups = groups.length;

  function updateVisibility() {
    groups.forEach((group, i) => {
      group.style.display = i === index ? "block" : "none";
    });
  }

  document.getElementById("nextBtn").addEventListener("click", function () {
    if (index < totalGroups - 1) {
      index++;
      updateVisibility();
    }
  });

  document.getElementById("prevBtn").addEventListener("click", function () {
    if (index > 0) {
      index--;
      updateVisibility();
    }
  });
  updateVisibility(); // Mostrar la primera lista al cargar
  initializeModal();
}

function carrusel4() {
  const slides = document.querySelectorAll(".carousel-slide");
  const totalSlides = slides.length;
  let currentIndex = 0;

  document.getElementById("nextBtn").addEventListener("click", () => {
    if (currentIndex < totalSlides - 1) {
      currentIndex++; // Solo avanza si no está en el último slide
      updateCarousel();
    }
  });

  document.getElementById("prevBtn").addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--; // Solo retrocede si no está en el primer slide
      updateCarousel();
    }
  });

  function updateCarousel() {
    const offset = -currentIndex * 100;
    document.querySelector(
      ".carousel-wrapper"
    ).style.transform = `translateX(${offset}%)`;
  }
  initializeModal();
}
