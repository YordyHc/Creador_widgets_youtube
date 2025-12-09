import React, { useState } from "react";
import { Link } from "react-router-dom";
import DisenoCard from "../../components/Home/DisenoCard";

export default function Home() {
  const [activeIndex, setActiveIndex] = useState(0); // El primero inicia activo

  return (
    <section>
      <div className="home mt-5 mb-5 container">
        <div className="redes">
          <div className="red-social">
            <button className="red-boton btn" type="button">
              Youtube
            </button>
          </div>
        </div>
        <div className="disenos">
          {[
            {
              altimg: "YouImg01",
              imagen: "imgs/MiniDesingYou/img_widget_1.png",
            },
            {
              altimg: "YouImg02",
              imagen: "imgs/MiniDesingYou/img_widget_2.png",
            },
            {
              altimg: "YouImg03",
              imagen: "imgs/MiniDesingYou/img_widget_3.png",
            },
            {
              altimg: "YouImg04",
              imagen: "imgs/MiniDesingYou/img_widget_4.png",
            },
          ].map((item, index) => (
            <DisenoCard
              key={index}
              altimg={item.altimg}
              imagen={item.imagen}
              isActive={activeIndex === index} // ← se activa si coincide
              onClick={() => setActiveIndex(index)} // ← al hacer click cambia el activo
            />
          ))}
        </div>
        <div className="muestra">
          <img
            src="https://placehold.co/1000x400/a1a2a3/ffffff?text=ACA+VA+EL+DISEÑO"
            alt="prueba"
          />
        </div>
        <div className="continuar">
          <Link className="boton btn" to="/Prueba">
            Continuar con el diseño
          </Link>
        </div>
      </div>
    </section>
  );
}
