import DisenoCard from "../../components/Home/DisenoCard";

export default function Home() {
  return (
    <section style={{ padding: "20px" }}>
      <div>
        <div>
          <button type="button">Youtube</button>
        </div>
        <div>
          <DisenoCard
            altimg="YouImg01"
            imagen="https://placehold.co/100x100/aabbee/aaFFFF/png"
          />
          <DisenoCard
            altimg="YouImg02"
            imagen="https://placehold.co/100x100/003456/aaFFFF/png"
          />
          <DisenoCard
            altimg="YouImg03"
            imagen="https://placehold.co/100x100/112233/aaFFFF/png"
          />
          <DisenoCard
            altimg="YouImg04"
            imagen="https://placehold.co/100x100/665655/aaFFFF/png"
          />
        </div>
        <div>
          <img
            src="https://placehold.co/1000x400/a1a2a3/ffffff?text=ACA+VA+EL+DISEÑO"
            alt="prueba"
          />
        </div>
        <div>
          <button type="button">Continuar con el diseño</button>
        </div>
      </div>
    </section>
  );
}
