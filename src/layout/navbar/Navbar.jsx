import { Link } from "react-router-dom";

export default function Navbar() {
  return (
    <nav style={{ background: "#222", color: "#fff", padding: "15px" }}>
      <h3>Mi Sitio</h3>
      <ul style={{ display: "flex", gap: "20px", listStyle: "none" }}>
        <li>
          <Link to="/">Inicio</Link>
        </li>
        <li>
          <Link to="/servicios">Servicios</Link>
        </li>
        <li>
          <Link to="/contacto">Contacto</Link>
        </li>
      </ul>
    </nav>
  );
}
