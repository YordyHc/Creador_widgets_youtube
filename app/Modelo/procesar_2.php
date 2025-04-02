<?php
// Incluir las clases necesarias
include_once '../Control/consultas_control.php';

// Verificar si los datos fueron enviados
if (isset($_POST['codigo_wid']) && isset($_POST['id_canal'])) {
    $codigo_wid = $_POST['codigo_wid'];
    $id_canal = $_POST['id_canal'];

    // Crear instancia de WidgetOperations
    $widgetOperations = new WidgetOperations();

    // Llamar a la función insertWidget para insertar en la base de datos
    $widgetOperations->insertWidget($codigo_wid, $id_canal);

    // Retornar una respuesta si es necesario
    echo json_encode(['status' => 'success', 'message' => 'Widget insertado correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos no válidos']);
}
?>
