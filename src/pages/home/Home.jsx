import DisenoCard from "../../components/Home/DisenoCard";

export default function Home() {
  return (
    <section>
      <div className="container">
        <div className="redes">
          <div className="red-social">
            <button className="btn" type="button">
              Youtube
            </button>
          </div>
        </div>
        <div>
          <DisenoCard
            altimg="YouImg01"
            imagen="imgs/MiniDesingYou/img_widget_1.png"
          />
          <DisenoCard
            altimg="YouImg02"
            imagen="imgs/MiniDesingYou/img_widget_2.png"
          />
          <DisenoCard
            altimg="YouImg03"
            imagen="imgs/MiniDesingYou/img_widget_3.png"
          />
          <DisenoCard
            altimg="YouImg04"
            imagen="imgs/MiniDesingYou/img_widget_4.png"
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
