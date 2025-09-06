<?php
require_once 'config/database.php';
class Estudiante {
    private $conn;
    private $tabla = "estudiantes";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar() {
        return $this->conn->query("SELECT * FROM $this->tabla")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $carrera, $email) {
        $stmt = $this->conn->prepare("INSERT INTO $this->tabla (nombre, carrera, email) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $carrera, $email]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->tabla WHERE id_estudiante = ?");
        return $stmt->execute([$id]);
    }
}
?><?php
require_once 'config/database.php'; 