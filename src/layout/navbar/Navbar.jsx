import { useEffect, useState } from "react";
import { Link } from "react-router-dom";

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const onScroll = () => {
      setScrolled(window.scrollY > 10);
    };

    window.addEventListener("scroll", onScroll);

    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <header className={scrolled ? "scrolled" : ""}>
      <div className="container px-5">
        <Link to="/" className="navbar-brand fw-bold">
          <img
            src="/imgs/logos/widsyord_titulo.png"
            className="img-fluid widsyord-titulo"
            alt="titulo"
          />
        </Link>
      </div>
    </header>
  );
}
