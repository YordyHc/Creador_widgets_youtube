import React from "react";

function DisenoCard({ altimg, imagen, isActive, onClick }) {
  return (
    <div
      className={`cont-img ${isActive ? "active" : ""}`} // Clase activa
      onClick={onClick}
      style={{ cursor: "pointer" }}
    >
      <img src={imagen} alt={altimg} />
    </div>
  );
}

export default DisenoCard;
