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

async function loadWidgetData(prefijo, widgetId) {
  try {
    /* =========================
       1️⃣ Obtener id_canal
    ========================== */
    const resWidget = await fetch(
      `http://127.0.0.1:8000/api/youtube/Widget-widsyord/?Id_Widget=${widgetId}`
    );

    if (!resWidget.ok) throw new Error("Error API Widget");

    const widgetData = await resWidget.json();
    const { id_canal } = widgetData;

    if (!id_canal) throw new Error("id_canal no recibido");

    /* =========================
       2️⃣ Info del canal
    ========================== */
    const resChannel = await fetch(
      `http://127.0.0.1:8000/api/youtube/youtube/channel-info/?forHandle=${id_canal}`
    );

    if (!resChannel.ok) throw new Error("Error API Channel Info");

    const channelInfo = await resChannel.json();

    /* =========================
       3️⃣ Videos del canal
    ========================== */
    const resVideos = await fetch(
      `http://127.0.0.1:8000/api/youtube/youtube/videos-info/?channelId=${id_canal}`
    );

    if (!resVideos.ok) throw new Error("Error API Videos");

    const videosInfo = await resVideos.json();

    /* =========================
       4️⃣ Evaluar prefijo y cargar widget
    ========================== */
    const widgetContainerId = `${prefijo}-${widgetId}`;

    if (prefijo === "yordwid-ywt1") {
      cargarWidget1(widgetContainerId, channelInfo, videosInfo);
    } else if (prefijo === "yordwid-ywt2") {
      cargarWidget2(widgetContainerId, channelInfo, videosInfo);
    } else if (prefijo === "yordwid-ywt3") {
      cargarWidget3(widgetContainerId, channelInfo, videosInfo);
    } else if (prefijo === "yordwid-ywt4") {
      cargarWidget4(widgetContainerId, channelInfo, videosInfo);
    } else {
      console.warn("Prefijo no reconocido:", prefijo);
    }
  } catch (error) {
    console.error("Error en loadWidgetData:", error);
  }
}

function cargarWidget1(idWidget, datos, videos) {
  const container = document.querySelector(`.${idWidget}`);

  if (!container) {
    console.error("Contenedor no encontrado:", idWidget);
    return;
  }

  // Crear iframe
  const iframe = document.createElement("iframe");
  iframe.src = "../plantillas/pages/widget_1.html";
  iframe.width = "100%";
  iframe.height = "500";
  iframe.style.border = "none";
  iframe.loading = "lazy";

  // Cuando el HTML esté listo, enviar datos
  iframe.onload = () => {
    iframe.contentWindow.postMessage(
      {
        datos: datos,
        videos: videos.videos, // 🔥 SOLO EL ARRAY
      },
      "*"
    );
  };

  // Limpiar y montar
  container.innerHTML = "";
  container.appendChild(iframe);
}

function cargarWidget2(idWidget, datos, videos) {
  const container = document.querySelector(`.${idWidget}`);

  if (!container) {
    console.error("Contenedor no encontrado:", idWidget);
    return;
  }

  const iframe = document.createElement("iframe");
  iframe.src = "../plantillas/pages/widget_2.html";
  iframe.width = "100%";
  iframe.height = "500";
  iframe.style.border = "none";
  iframe.loading = "lazy";

  iframe.onload = () => {
    iframe.contentWindow.postMessage(
      {
        datos: datos,
        videos: videos.videos, // 🔥 SOLO EL ARRAY
      },
      "*"
    );
  };

  container.innerHTML = "";
  container.appendChild(iframe);
}

function cargarWidget2(idWidget, datos, videos) {
  const container = document.querySelector(`.${idWidget}`);

  if (!container) {
    console.error("Contenedor no encontrado:", idWidget);
    return;
  }

  const iframe = document.createElement("iframe");
  iframe.src = "../plantillas/pages/widget_2.html";
  iframe.width = "100%";
  iframe.height = "500";
  iframe.style.border = "none";
  iframe.loading = "lazy";

  iframe.onload = () => {
    iframe.contentWindow.postMessage(
      {
        datos: datos,
        videos: videos.videos, // 🔥 SOLO EL ARRAY
      },
      "*"
    );
  };

  container.innerHTML = "";
  container.appendChild(iframe);
}

function cargarWidget3(idWidget, datos, videos) {
  const container = document.querySelector(`.${idWidget}`);

  if (!container) {
    console.error("Contenedor no encontrado:", idWidget);
    return;
  }

  const iframe = document.createElement("iframe");
  iframe.src = "../plantillas/pages/widget_3.html";
  iframe.width = "100%";
  iframe.height = "500";
  iframe.style.border = "none";
  iframe.loading = "lazy";

  iframe.onload = () => {
    iframe.contentWindow.postMessage(
      {
        datos: datos,
        videos: videos.videos, // 🔥 SOLO EL ARRAY
      },
      "*"
    );
  };

  container.innerHTML = "";
  container.appendChild(iframe);
}

function cargarWidget4(idWidget, datos, videos) {
  const container = document.querySelector(`.${idWidget}`);

  if (!container) {
    console.error("Contenedor no encontrado:", idWidget);
    return;
  }

  const iframe = document.createElement("iframe");
  iframe.src = "../plantillas/pages/widget_4.html";
  iframe.width = "100%";
  iframe.height = "500";
  iframe.style.border = "none";
  iframe.loading = "lazy";

  iframe.onload = () => {
    iframe.contentWindow.postMessage(
      {
        datos: datos,
        videos: videos.videos, // 🔥 SOLO EL ARRAY
      },
      "*"
    );
  };

  container.innerHTML = "";
  container.appendChild(iframe);
}
