document.addEventListener("DOMContentLoaded", function () {
  // Buscar todos los elementos con clase 'elfsight-app-'
  const widgetContainers = document.querySelectorAll('[class^="yordwid-"]');

  widgetContainers.forEach(function (container) {
    const widgetId = container.className.match(/yordwid-([a-f0-9\-]+)/)[1];

    // Llamada para obtener los datos del widget (simulada aquí)
    loadWidgetData(widgetId, container);
  });
});

// Simulación de la solicitud para cargar datos del widget
// Función que simula cargar datos del widget
function loadWidgetData(widgetId, container) {
  // Cargar los estilos de Bootstrap si no están presentes
  addBootstrapStyles();

  // Simulando los datos que se obtendrían de una API
  const pruebadat = {
    id: widgetId,
    title: "Hola, prueba",
    description: "esta es la descripcion perraco",
  };

  // Llamar a la función que maneja la renderización del widget
  renderWidget(pruebadat, container);

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      // Llamar a la función que maneja la renderización del widget
      renderWidget(data, container);
    })
    .catch((error) => {
      console.error("Error al cargar el widget:", error);
    });
}

// Función para renderizar el widget dentro del contenedor
function renderWidget(data, container) {
  // Crear el HTML del widget con los datos recibidos
  const widgetHTML = `
      <div class="cont_1 container border">
          <h3>${data.title}</h3>
          <p>${data.description}</p>
          <button class="btn btn-primary" onclick="alert('¡Botón del widget presionado!')">Interactuar</button>
      </div>
  `;

  // Insertar el widget HTML en el contenedor
  container.innerHTML = widgetHTML;

  // Agregar interacciones al widget después de que se haya renderizado
  addWidgetInteractions();
}

// Función para agregar interacciones al widget
function addWidgetInteractions() {
  // Esperamos que el botón del widget esté presente en el DOM
  const button = document.querySelector(".cont_1 button");

  // Si el botón existe, agregarle un evento de clic
  if (button) {
    button.addEventListener("click", function () {
      alert("¡El widget ha sido interactuado!");
    });
  }
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
