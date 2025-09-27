<?php
require_once 'models/Libro.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LibrosController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Libro();
    }

    public function index()
    {
        $libros = $this->modelo->listar();
        include 'views/libros/listar.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear($_POST['titulo'], $_POST['id_autor'], $_POST['id_categoria'], $_POST['anio']);
            header("Location: index.php");
        } else {
            $autores = $this->modelo->obtenerAutores();
            $categorias = $this->modelo->obtenerCategorias();
            include 'views/libros/crear.php';
        }
    }

    public function editar($id)
    {
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

    public function eliminar($id)
    {
        $this->modelo->eliminar($id);
        header("Location: index.php");
    }

    public function exportarExcel()
    {
        if (ob_get_contents()) ob_end_clean();
        require_once __DIR__ . '/../vendor/autoload.php';
        $libros = $this->modelo->listarConDetalles();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Libros');

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Título');
        $sheet->setCellValue('C1', 'Autor');
        $sheet->setCellValue('D1', 'Categoría');
        $sheet->setCellValue('E1', 'Año');

        $fila = 2;
        foreach ($libros as $libro) {
            $sheet->setCellValue("A{$fila}", $libro['id_libro']);
            $sheet->setCellValue("B{$fila}", $libro['titulo']);
            $sheet->setCellValue("C{$fila}", $libro['autor']);
            $sheet->setCellValue("D{$fila}", $libro['categoria']);
            $sheet->setCellValue("E{$fila}", $libro['anio']);
            $fila++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="libros.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
