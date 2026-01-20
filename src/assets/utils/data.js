// data.js
export async function peticionApi(url, method = "GET", body = null) {
  try {
    const options = {
      method,
      headers: {
        "Content-Type": "application/json",
      },
    };

    if (body) {
      options.body = JSON.stringify(body);
    }

    const response = await fetch(url, options);

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
    return null;
  }

  if (match[6]) {
    return `@${match[6]}`; // handle
  }

  return match[3] || match[4] || match[5];
}
