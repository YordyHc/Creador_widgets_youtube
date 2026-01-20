<?php
// Incluir las clases necesarias
include_once '../Control/consultas_control.php';
include_once 'Model_funcion.php';

// Verificar si los datos fueron enviados
if (isset($_POST['codigo_wid']) && isset($_POST['id_canal']) && isset($_POST['nom_user'])) {
    $codigo_wid = $_POST['codigo_wid'];
    $id_canal = $_POST['id_canal'];
    $name_user = $_POST['nom_user'];

    // Si id_canal está vacío y name_user no lo está, obtener el id_canal desde el modelo de YouTube
    if ($id_canal == "" && $name_user != "") {
        $model = new YouTubeModel($name_user);
        $id_canal = $model->obtenerIdCanalYoutube();
    }

    // Verificar si id_canal sigue vacío o si es inválido
    if ($id_canal == "") {
        echo json_encode(['status' => 'error', 'message' => 'El campo id_canal y nom_user no pueden estar vacíos al mismo tiempo.']);
        exit;
    }

    // Crear instancia de WidgetOperations
    $widgetOperations = new WidgetOperations();

    // Llamar a la función insertWidget para insertar en la base de datos
    try {
        $widgetOperations->insertWidget($codigo_wid, $id_canal);
        // Retornar una respuesta si la inserción es exitosa
        echo json_encode(['status' => 'success', 'message' => 'Widget insertado correctamente']);
    } catch (Exception $e) {
        // Manejo de errores en caso de fallo en la inserción
        echo json_encode(['status' => 'error', 'message' => 'Error al insertar el widget: ' . $e->getMessage()]);
    }

} else {
    // Si alguno de los parámetros no está presente
    echo json_encode(['status' => 'error', 'message' => 'Datos no válidos o incompletos']);
}
?>

