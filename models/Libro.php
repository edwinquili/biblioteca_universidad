<?php
require_once 'config/database.php';

class Libro {
    private $conn;
    private $tabla = "libros";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

   public function listar() {
    $query = "SELECT 
                libros.id_libro,
                libros.titulo,
                autores.nombre AS nombre_autor,
                categorias.nombre_categoria AS nombre_categoria,
                libros.anio_publicacion
              FROM libros
              JOIN autores ON libros.id_autor = autores.id_autor
              JOIN categorias ON libros.id_categoria = categorias.id_categoria";
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
    public function obtener($id) {
        $query = "SELECT * FROM $this->tabla WHERE id_libro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($titulo, $id_autor, $id_categoria, $anio) {
        $query = "INSERT INTO $this->tabla (titulo, id_autor, id_categoria, anio_publicacion) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$titulo, $id_autor, $id_categoria, $anio]);
    }

    public function actualizar($id, $titulo, $id_autor, $id_categoria, $anio) {
        $query = "UPDATE $this->tabla SET titulo = ?, id_autor = ?, id_categoria = ?, anio_publicacion = ? 
                  WHERE id_libro = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$titulo, $id_autor, $id_categoria, $anio, $id]);
    }

    public function eliminar($id) {
        $query = "DELETE FROM $this->tabla WHERE id_libro = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function obtenerAutores() {
    $query = "SELECT id_autor, nombre FROM autores";
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCategorias() {
    $query = "SELECT id_categoria, nombre_categoria FROM categorias";
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?><?php
require_once 'config/database.php';