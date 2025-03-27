// Elimina el evento DOMContentLoaded
// No es necesario usar 'DOMContentLoaded' aquí ya que los eventos deben asignarse después de cargar el contenido dinámico

let currentIndex = 0;

function asignarEventosCarousel() {
  const slides = document.querySelectorAll(".carousel-slide");
  const totalSlides = slides.length;

  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");

  if (nextBtn && prevBtn) {
    nextBtn.addEventListener("click", () => {
      if (currentIndex < totalSlides - 1) {
        currentIndex++; // Solo avanza si no está en el último slide
        updateCarousel();
      }
    });

    prevBtn.addEventListener("click", () => {
      if (currentIndex > 0) {
        currentIndex--; // Solo retrocede si no está en el primer slide
        updateCarousel();
      }
    });
  }

  function updateCarousel() {
    const offset = -currentIndex * 100;
    document.querySelector(
      ".carousel-wrapper"
    ).style.transform = `translateX(${offset}%)`;
  }
}

// Llamar a esta función cada vez que cargues el contenido dinámico
