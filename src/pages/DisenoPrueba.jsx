import { useState } from "react";
import { useOutletContext, useLocation } from "react-router-dom";
import {
  peticionApi,
  validarYExtraerCanalYoutube,
  resolverAHandle,
} from "../assets/utils/data";

export default function DisenoPrueba() {
  const [urlCanal, setUrlCanal] = useState("");
  const [iframeKey, setIframeKey] = useState(0);
  const [loading, setLoading] = useState(false);

  const { canal, setCanal, videos, setVideos } = useOutletContext();
  const location = useLocation();
  const activeIndex = location.state?.activeIndex ?? 0;

  const widgetPages = [
    "/plantillas/pages/widget_1.html",
    "/plantillas/pages/widget_2.html",
    "/plantillas/pages/widget_3.html",
    "/plantillas/pages/widget_4.html",
  ];

  // 🔍 Orquestador principal
  const procesarCanal = async () => {
    if (!urlCanal) return;

    const resultado = urlCanal;

    if (!resultado.channelId && !resultado.username && !resultado.handle) {
      alert("La URL no es válida");
      return;
    }

    setLoading(true);

    try {
      let canalFinal = resultado.handle;

      // Resolver los casos que no sean @canal
      if (!canalFinal) {
        canalFinal = await resolverAHandle({
          channelId: resultado.channelId,
          username: resultado.username,
        });
      }

      // Cargar datos
      const canalData = await peticionApi(canalFinal);
      setCanal(canalData);

      const urlVideos = "/pruebas/videos_2.json";
      const videosData = await peticionApi(urlVideos);
      setVideos(videosData);

      setIframeKey((prev) => prev + 1);
    } catch (error) {
      console.error("Error cargando datos:", error);
    } finally {
      setLoading(false);
    }
  };

  const [mostrarModal, setMostrarModal] = useState(false);
  const [modalMensaje, setModalMensaje] = useState("");
  const [modalLoading, setModalLoading] = useState(false);

  const cerrarModal = () => {
    setMostrarModal(false);
  };

  const copiarTexto = () => {
    // tu lógica actual
  };

  const crearWidget = async () => {
    if (!canal?.idcanal) {
      alert("Primero debes cargar un canal válido");
      return;
    }

    setMostrarModal(true);
    setModalLoading(true);
    setModalMensaje("");

    try {
      const data = await peticionApi(
        "http://127.0.0.1:8000/api/youtube/widsyord/",
        "POST",
        {
          id_canal: canal.idcanal, // 👈 AQUÍ
        }
      );

      setModalMensaje(data.codigo_wid);
    } catch (error) {
      setModalMensaje("Error al generar el widget");
    } finally {
      setModalLoading(false);
    }
  };

  return (
    <section className="cont-prueba mt-5 mb-5 container">
      <div className="canal-input mb-4">
        <div className="lb-in">
          <label htmlFor="canal">Ingrese Link del canal:</label>
          <input
            className="caja"
            id="canal"
            type="text"
            value={urlCanal}
            onChange={(e) => setUrlCanal(e.target.value)}
          />
        </div>

        <div>
          <button
            className="boton btn"
            type="button"
            onClick={procesarCanal}
            disabled={loading}
          >
            {loading ? "Comprobando..." : "Comprobar"}
          </button>
        </div>
      </div>

      <div className="muestra">
        <iframe
          key={`${activeIndex}-${iframeKey}`}
          src={widgetPages[activeIndex]}
          style={{ width: "100%", height: "100vh", border: "none" }}
          title={`Widget_${activeIndex + 1}`}
          onLoad={(e) => {
            e.target.contentWindow.postMessage(
              { datos: canal, videos: videos?.videos },
              "*"
            );
          }}
        />
      </div>

      <div className="crear">
        <button className="boton btn" type="button" onClick={crearWidget}>
          Crear widget
        </button>
      </div>

      {mostrarModal && (
        <div className="modal" onClick={cerrarModal}>
          <div className="modal-content" onClick={(e) => e.stopPropagation()}>
            <span className="close" onClick={cerrarModal}>
              &times;
            </span>

            <h5>
              <strong>
                WIDGET GENERADO
                <br />
                INSERTE EL SCRIPT EN SU PROYECTO
              </strong>
            </h5>

            <br />
            <pre id="modal-body">
              {modalLoading
                ? "Generando widget..."
                : `<div class="yordwid-${
                    activeIndex + 1
                  }-${modalMensaje}"></div>
<script src="/creacion_widgets_youtube/script/crearWidget.js"></script>`}
            </pre>

            <br />
            <div className="confirmationMessage" id="confirmationMessage">
              Copiado
            </div>

            <button
              className="btn btn-success btn-sm"
              id="copyButton"
              onClick={copiarTexto}
              disabled={modalLoading}
            >
              Copiar script
            </button>
          </div>
        </div>
      )}
    </section>
  );
}
