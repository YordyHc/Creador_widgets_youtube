<?php

// Incluir la clase de la base de datos
include_once '../Modelo/consultas.php';

class WidgetOperations {

    // Función para insertar datos en la tabla Widget
    public function insertWidget($codigo_wid, $id_canal) {
        // Definir la consulta SQL para insertar datos
        $query = "INSERT INTO Widget (codigo_wid, id_canal) VALUES (:param1, :param2)";
    
        // Crear instancia de DatabaseOperations
        $operation = new DatabaseOperations();
    
        // Ejecutar la consulta usando el método insert de DatabaseOperations
        $result = $operation->insert($query, $codigo_wid, $id_canal);
    
        // Devolver el resultado como JSON
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Widget insertado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar widget']);
        }
    }
    
    // Función para consultar el id_canal evaluando codigo_wid
    public function selectWidget($codigo_wid) {
        // Consulta SQL para obtener el id_canal evaluando codigo_wid
        $query = "SELECT id_canal FROM Widget WHERE codigo_wid = :param1";

        // Crear instancia de la clase DatabaseOperations
        $operation = new DatabaseOperations();

        // Obtener los resultados
        $results = $operation->select($query, $codigo_wid);

        // Retornar el resultado
        return $results;
    }
}

?>
