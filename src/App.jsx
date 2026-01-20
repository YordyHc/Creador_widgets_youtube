import { Outlet } from "react-router-dom";
import Navbar from "./layout/navbar/Navbar";
import Footer from "./layout/footer/Footer";
import appConfig from "./assets/utils/appConfig";
import { peticionApi } from "./assets/utils/data";
import { useEffect, useState } from "react";

function App() {
  const [canal, setCanal] = useState(null);
  const [videos, setVideos] = useState(null);
  const [loading, setLoading] = useState(true);

  const urlCanal =
    appConfig.url.canal + appConfig.handle; /*"/pruebas/canal.json";*/

  useEffect(() => {
    async function cargarDatos() {
      try {
        // 1. cargar canal
        const canalData = await peticionApi(urlCanal);
        setCanal(canalData);

        // 2. cargar videos usando canal.idcanal
        const urlVideos =
          appConfig.url.videos + canalData.idcanal; /* "/pruebas/videos.json";*/
        const videosData = await peticionApi(urlVideos);
        setVideos(videosData);
      } catch (error) {
        console.error("Error:", error);
      } finally {
        setLoading(false);
      }
    }

    cargarDatos();
  }, []);

  if (loading) return <p>Cargando...</p>;

  return (
    <div className="page">
      <Navbar />
      <main style={{ marginTop: "60px" }}>
        <Outlet
          context={{
            canal,
            setCanal,
            videos,
            setVideos,
          }}
        />
      </main>
      <Footer />
    </div>
  );
}

export default App;
