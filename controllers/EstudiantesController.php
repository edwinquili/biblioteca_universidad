<?php
require_once 'models/Estudiante.php';

class EstudiantesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Estudiante();
    }

    public function index() {
        $estudiantes = $this->modelo->listar();
        include 'views/estudiantes/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear($_POST['nombre'], $_POST['carrera'], $_POST['email']);
            header("Location: index.php?action=listar_estudiantes");
        } else {
            include 'views/estudiantes/crear.php';
        }
    }

    public function eliminar($id) {
        $this->modelo->eliminar($id);
        header("Location: index.php?action=listar_estudiantes");
    }
}