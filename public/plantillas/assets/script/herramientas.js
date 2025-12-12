function redondeo(dato) {
  if (dato === undefined || dato === null || isNaN(dato)) {
    return "0.00";
  }
  if (dato >= 1_000_000_000) {
    let valor = dato / 1_000_000_000;
    let valorRedondeado = valor.toFixed(1);

    if (valorRedondeado.endsWith(".0")) {
      return Math.floor(valor) + "B";
    }
    return valorRedondeado + "B";
  } else if (dato >= 10000000) {
    return (dato / 1000000).toFixed(1) + "M";
  } else if (dato >= 1000000) {
    return (dato / 1000000).toFixed(2) + "M";
  } else if (dato >= 1000) {
    let valor = dato / 1000;
    let valorRedondeado = valor.toFixed(1);

    if (valorRedondeado.endsWith(".0")) {
      return Math.floor(valor) + "K";
    }
    return valorRedondeado + "K";
  } else {
    return dato.toString();
  }
}

function formatearFecha(fechaISO) {
  const fecha = new Date(fechaISO);
  const dia = fecha.getDate().toString().padStart(2, "0");
  const mes = (fecha.getMonth() + 1).toString().padStart(2, "0"); // ¡Meses inician desde 0!
  const anio = fecha.getFullYear();
  return `${dia}/${mes}/${anio}`;
}

function formatYouTubeDuration(duration) {
  const regex = /PT(\d+H)?(\d+M)?(\d+S)?/;
  const matches = duration.match(regex);

  const hours = matches[1] ? parseInt(matches[1].replace("H", "")) : 0;
  const minutes = matches[2] ? parseInt(matches[2].replace("M", "")) : 0;
  const seconds = matches[3] ? parseInt(matches[3].replace("S", "")) : 0;

  // Si hay horas, mostrar "h:mm:ss", si no, "mm:ss"
  if (hours > 0) {
    return `${hours}:${minutes.toString().padStart(2, "0")}:${seconds
      .toString()
      .padStart(2, "0")}`;
  } else {
    return `${minutes}:${seconds.toString().padStart(2, "0")}`;
  }
}
