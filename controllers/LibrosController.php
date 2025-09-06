<?php
require_once 'models/Libro.php';

class LibrosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Libro();
    }

    public function index() {
        $libros = $this->modelo->listar();
        include 'views/libros/listar.php';
    }

     public function crear() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelo->crear($_POST['titulo'], $_POST['id_autor'], $_POST['id_categoria'], $_POST['anio']);
        header("Location: index.php");
    } else {
        $autores = $this->modelo->obtenerAutores();
        $categorias = $this->modelo->obtenerCategorias();
        include 'views/libros/crear.php';
    }
    }
    
    public function editar($id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelo->actualizar($id, $_POST['titulo'], $_POST['id_autor'], $_POST['id_categoria'], $_POST['anio']);
        header("Location: index.php");
    } else {
        $libro = $this->modelo->obtener($id);
        $autores = $this->modelo->obtenerAutores();
        $categorias = $this->modelo->obtenerCategorias();
        include 'views/libros/editar.php';
    }
}

    public function eliminar($id) {
        $this->modelo->eliminar($id);
        header("Location: index.php");
    }
}
?>