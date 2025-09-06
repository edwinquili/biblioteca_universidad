<?php
require_once 'models/Prestamo.php';

class PrestamosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Prestamo();
    }

    public function index() {
        $prestamos = $this->modelo->listar();
        include 'views/prestamos/listar.php';
    }

    public function crear() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelo->crear($_POST['id_libro'], $_POST['id_estudiante'], $_POST['fecha_prestamo'], $_POST['fecha_devolucion']);
        header("Location: index.php?action=listar_prestamos");
    } else {
        $libros = $this->modelo->obtenerLibros();
        $estudiantes = $this->modelo->obtenerEstudiantes();
        include 'views/prestamos/crear.php';
    }
}
}