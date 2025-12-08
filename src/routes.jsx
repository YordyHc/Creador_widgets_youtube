import { createBrowserRouter } from "react-router-dom";
import App from "./App";
import Home from "./pages/home/Home";
import DisenoPrueba from "./pages/DisenoPrueba";
/*import Servicios from "./pages/Servicios";
import Contacto from "./pages/Contacto";*/

const router = createBrowserRouter([
  {
    path: "/", // ruta base
    element: <App />,
    children: [
      { index: true, element: <Home /> }, // 🔹 usar index para la ruta por defecto
      /*
      { path: "servicios", element: <Servicios /> },
      { path: "contacto", element: <Contacto /> },
      */
    ],
  },
]);

export default router;
