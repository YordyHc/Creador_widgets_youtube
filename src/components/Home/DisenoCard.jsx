import React from "react"; // (Opcional en versiones nuevas de React)

function DisenoCard(props) {
  // 1. Lógica del componente (variables, funciones, hooks)
  const { altimg, imagen, descripcion } = props;

  // 2. Retorno del JSX (lo que se renderiza en pantalla)
  return (
    <div>
      <img src={imagen} alt={altimg} />
    </div>
  );
}

export default DisenoCard;
