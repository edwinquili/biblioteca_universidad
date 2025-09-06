
<?php
class Prestamo {
    private $conn;
    private $tabla = "prestamos";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar() {
        $query = "SELECT prestamos.id_prestamo, libros.titulo, estudiantes.nombre AS estudiante,
                  fecha_prestamo, fecha_devolucion
                  FROM prestamos
                  JOIN libros ON prestamos.id_libro = libros.id_libro
                  JOIN estudiantes ON prestamos.id_estudiante = estudiantes.id_estudiante";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($id_libro, $id_estudiante, $fecha_prestamo, $fecha_devolucion) {
        $stmt = $this->conn->prepare("INSERT INTO $this->tabla (id_libro, id_estudiante, fecha_prestamo, fecha_devolucion)
                                      VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_libro, $id_estudiante, $fecha_prestamo, $fecha_devolucion]);
    }

    public function obtenerLibros() {
    $query = "SELECT id_libro, titulo FROM libros";
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEstudiantes() {
    $query = "SELECT id_estudiante, nombre FROM estudiantes";
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?><?php
require_once 'config/database.php'; 