<?php
class Database {
    private $host = 'bkvlwkwidrhiepbrjlho-mysql.services.clever-cloud.com'; // Cambia esto según tu configuración
    private $db_name = 'bkvlwkwidrhiepbrjlho'; // Nombre de tu base de datos
    private $username = 'uwehrzbuuxitkgml'; // Tu usuario de MySQL
    private $password = 'TDuc80KNBwpaGKxdHDYk'; // Tu contraseña de MySQL
    private $conn;

    // Método para establecer la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
