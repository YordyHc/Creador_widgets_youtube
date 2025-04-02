<?php
include 'Model_funcion.php'; 
include '../Control/consultas_control.php';
header('Content-Type: application/json');

// Obtener los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Función para validar la URL de YouTube
function validarCanalYoutube($url) {
    // Expresión regular para validar la URL de un canal de YouTube
    $pattern = '/^https?:\/\/(www\.)?youtube\.com\/(channel\/([a-zA-Z0-9_-]+)|c\/([a-zA-Z0-9_-]+)|user\/([a-zA-Z0-9_-]+)|@([a-zA-Z0-9_]+))$/';
    
    if (preg_match($pattern, $url, $match)) {
        $channelId = '';
        $username = '';

        // Revisar las posibles posiciones de los valores en la expresión regular
        if (!empty($match[3])) {
            $channelId = $match[3]; // Canal con ID (channel/)
        } elseif (!empty($match[4])) {
            $channelId = $match[4]; // Canal con ID (c/)
        } elseif (!empty($match[5])) {
            $username = $match[5]; // Canal con nombre de usuario (user/)
        } elseif (!empty($match[6])) {
            $username = $match[6]; // Canal con nombre de usuario (@)
        }

        return [
            'valid' => true,
            'channelId' => $channelId,
            'username' => $username
        ];
    } else {
        return [
            'valid' => false,
            'message' => 'La URL no es un canal de YouTube válido.'
        ];
    }
}

// Verificar si se recibieron datos
if (isset($data['url'])) {
    // Caso 1: Si llega una URL, se valida y extrae el channelId o username
    $url = $data['url'];

    // Validar la URL del canal de YouTube
    $validation = validarCanalYoutube($url);
    if (!$validation['valid']) {
        echo json_encode([
            'status' => 'error',
            'message' => $validation['message']
        ]);
        exit;
    }

    $channelId = $validation['channelId'];
    $username = $validation['username'];

}elseif($data['channelId'] != "" && $data['username'] != ""){
    $consul = new WidgetOperations();

    $channelId = $consul->selectWidget($data['username'])[0]['id_canal'];

} elseif (isset($data['channelId']) || isset($data['username'])) {
    // Caso 2: Si llega el channelId o username directamente
    $channelId = isset($data['channelId']) ? $data['channelId'] : null;
    $username = isset($data['username']) ? $data['username'] : null;

} else {
    // Si no llega ni URL, ni channelId, ni username
    echo json_encode([
        'status' => 'error',
        'message' => 'No se proporcionaron datos válidos (URL, ID de canal o nombre de usuario).'
    ]);
    exit;
}

// Si se proporcionó channelId o username, crear el modelo de YouTube
if ($channelId) {
    $youtubeModel = new YouTubeModel($channelId); // Asumiendo que el modelo puede manejar un username.
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se pudo determinar el canal de YouTube.'
    ]);
    exit;
}

// Obtener los datos de los videos y el perfil
$videos = $youtubeModel->get_dat_videos();
$datos = $youtubeModel->get_profile();

$response = [
    'videos' => json_decode($videos, true),  // Convertir a array si es necesario
    'perfil' => json_decode($datos, true)    // Convertir a array si es necesario
];

// Enviar la respuesta combinada al front-end como JSON
echo json_encode($response);
?>
