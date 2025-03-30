<?php
include 'Model_funcion.php'; 

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

// Verificar si los datos se recibieron correctamente
if (isset($data['channelId']) || isset($data['username'])) {

    $channelId = isset($data['channelId']) ? $data['channelId'] : null;
    $username = isset($data['username']) ? $data['username'] : null;

    // Crear una instancia del modelo de YouTube
    $youtubeModel = new YouTubeModel();

    // Obtener los datos de los videos y el perfil
    $videos = $youtubeModel->get_dat_videos();
    $datos = $youtubeModel->get_profile();
    
    $response = [
        'videos' => json_decode($videos, true),  // Convertir a array si es necesario
        'perfil' => json_decode($datos, true)    // Convertir a array si es necesario
    ];

    // Enviar la respuesta combinada al front-end como JSON
    echo json_encode($response);

} else {
    // Responder con error si no se envió un ID o un nombre de usuario
    echo json_encode([
        'status' => 'error',
        'message' => 'No se proporcionaron datos válidos (ID de canal o nombre de usuario).'
    ]);
}
?>

