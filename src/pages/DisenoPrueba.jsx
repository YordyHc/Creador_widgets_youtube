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

    const resultado = validarYExtraerCanalYoutube(urlCanal);

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
        <button className="boton btn" type="button">
          Crear widget
        </button>
      </div>
    </section>
  );
}
