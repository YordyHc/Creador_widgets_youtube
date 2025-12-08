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
    </section>
  );
}
