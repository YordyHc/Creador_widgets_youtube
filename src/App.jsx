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

  const urlCanal = "/pruebas/canal.json";

  useEffect(() => {
    async function cargarDatos() {
      try {
        // 1. cargar canal
        const canalData = await peticionApi(urlCanal);
        setCanal(canalData);

        // 2. cargar videos usando canal.idcanal
        const urlVideos =
          "/pruebas/videos.json"; /*appConfig.url.videos + canalData.idcanal*/
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
        <Outlet context={{ canal, videos }} />
      </main>
      <Footer />
    </div>
  );
}

export default App;
