import { useState } from "react";

export default function DisenoPrueba() {
  const [canal, setCanal] = useState("");

  return (
    <section style={{ padding: "20px" }}>
      <div>
        <div>
          <label htmlFor="canal">Ingrese Link del canal:</label>
          <input
            id="canal"
            type="text"
            value={canal}
            onChange={(e) => setCanal(e.target.value)}
          />
        </div>
        <div>
          <button type="button">Comprobar</button>
        </div>
      </div>
      <div>
        <img
          src="https://placehold.co/1000x400/bbccdd/112233?text=ACA+VA+EL+DISEÑO"
          alt="prueba"
        />
      </div>
      <div>
        <button type="button">Crear widget</button>
      </div>
      <div className="modal">
        <div className="modal-content">
          <span className="close" onclick="cerrarModal()">
            &times;
          </span>
          <h5>
            <strong>WIDGET GENERADO INSERTE EL SCRIPT EN SU PROYECTO</strong>
          </h5>
          <pre id="modal-body">aqui va el script del en un modal</pre>
          <div className="confirmationMessage" id="confirmationMessage">
            Copiado
          </div>
          <button
            className="btn btn-success btn-sm"
            id="copyButton"
            onclick="copiarTexto()"
          >
            Copiar script
          </button>
        </div>
      </div>
    </section>
  );
}
