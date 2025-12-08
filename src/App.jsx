import { Outlet } from "react-router-dom";
import Navbar from "./layout/navbar/Navbar";
import Footer from "./layout/footer/Footer";

function App() {
  return (
    <>
      <Navbar />
      <main style={{ marginTop: "60px" }}>
        <Outlet /> {/* Aquí se cargan las páginas */}
      </main>
      <Footer />
    </>
  );
}

export default App;
