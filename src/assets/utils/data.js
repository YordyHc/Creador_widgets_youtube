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
