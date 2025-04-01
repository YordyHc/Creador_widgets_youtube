// Elimina el evento DOMContentLoaded
// No es necesario usar 'DOMContentLoaded' aquí ya que los eventos deben asignarse después de cargar el contenido dinámico

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

// Función global playvideoFromData
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

// Llamar a esta función cada vez que cargues el contenido dinámico

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

function generarUUID() {
  // Función para generar un UUID con el mismo patrón: 8-4-4-4-12
  return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
    var r = (Math.random() * 16) | 0,
      v = c === "x" ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}

function retornarScript(numwid) {
  // Generar un UUID aleatorio
  const uuid = generarUUID();

  // Crear la cadena de salida con el formato solicitado
  const widgetHTML = `<div class="yordwid-${numwid}-${uuid}"></div>
<script src="/creacion_widgets_youtube/script/crearWidget.js"></script>`;

  // Retornar la cadena HTML
  return widgetHTML;
  //console.log(widgetHTML);
}
