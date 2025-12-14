export async function peticionApi(url, method = "GET") {
  try {
    const response = await fetch(url, {
      method,
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      throw new Error(`Error en la petición: ${response.status}`);
    }

    return response.json();
  } catch (error) {
    console.error("Error:", error);
    throw error;
  }
}

export function validarYExtraerCanalYoutube(url) {
  const pattern =
    /^https?:\/\/(www\.)?youtube\.com\/(channel\/([a-zA-Z0-9_-]+)|c\/([a-zA-Z0-9_-]+)|user\/([a-zA-Z0-9_-]+)|@([a-zA-Z0-9_]+))$/;

  const match = url.match(pattern);

  if (!match) {
    return { error: "La URL no es un canal de YouTube válido" };
  }

  let channelId = "";
  let username = "";
  let handle = "";

  if (match[3]) channelId = match[3]; // /channel/UCxxxx
  else if (match[4]) channelId = match[4]; // /c/Nombre
  else if (match[5]) username = match[5]; // /user/Nombre
  else if (match[6]) handle = match[6]; // /@canal

  return { channelId, username, handle };
}

export async function resolverAHandle({ channelId, username }) {
  // Aquí llamarías a tu backend o a YouTube API
  // Mock
  return "@canal_resuelto";
}
