<?php
// Incluir la clase de conexión a la base de datos
include_once 'conexion.php';

class DatabaseOperations {
    // Método para obtener la conexión a la base de datos
    private function getConnection() {
        $database = new Database();
        return $database->getConnection();
    }

    // Método para insertar datos, recibe los parámetros individualmente
    public function insert($query, $param1, $param2) {
        try {
            $conn = $this->getConnection(); // Obtener la conexión
            $stmt = $conn->prepare($query); // Preparar la consulta
    
            // Enlazar los parámetros individualmente
            $stmt->bindParam(':param1', $param1);
            $stmt->bindParam(':param2', $param2);
    
            // Ejecutar la consulta
            return $stmt->execute(); // Si se ejecuta correctamente, devolver true
        } catch (PDOException $e) {
            echo "Error al insertar: " . $e->getMessage();
            return false; // En caso de error, devolver false
        }
    }
    

    // Método para obtener datos, recibe los parámetros individualmente
    public function select($query, $param1) {
        try {
            $conn = $this->getConnection(); // Obtener la conexión
            $stmt = $conn->prepare($query); // Preparar la consulta

            // Enlazar los parámetros individualmente
            $stmt->bindValue(':param1', $param1);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al consultar: ". $e->getMessage();
            return false;
        }
    }
}
?>

