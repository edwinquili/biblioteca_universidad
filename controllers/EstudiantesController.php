<?php
require_once 'models/Estudiante.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class EstudiantesController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Estudiante();
    }

    public function index()
    {
        $estudiantes = $this->modelo->listar();
        include 'views/estudiantes/listar.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear($_POST['nombre'], $_POST['carrera'], $_POST['email']);
            header("Location: index.php?action=listar_estudiantes");
        } else {
            include 'views/estudiantes/crear.php';
        }
    }

    public function eliminar($id)
    {
        $this->modelo->eliminar($id);
        header("Location: index.php?action=listar_estudiantes");
    }

    public function exportarWord()
    {
        if (ob_get_contents()) ob_end_clean();
        require_once __DIR__ . '/../vendor/autoload.php';
        $estudiantes = $this->modelo->listar();

        $word = new PhpWord();
        $section = $word->addSection();
        $section->addTitle('Informe de Estudiantes Registrados', 1);

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80
        ]);

        $table->addRow();
        $table->addCell(2000)->addText('ID');
        $table->addCell(4000)->addText('Nombre');
        $table->addCell(4000)->addText('Carrera');
        $table->addCell(4000)->addText('Email');

        foreach ($estudiantes as $e) {
            $table->addRow();
            $table->addCell(2000)->addText($e['id_estudiante']);
            $table->addCell(4000)->addText($e['nombre']);
            $table->addCell(4000)->addText($e['carrera']);
            $table->addCell(4000)->addText($e['email']);
        }

        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Disposition: attachment; filename=estudiantes.docx");
        header("Cache-Control: max-age=0");

        $objWriter = IOFactory::createWriter($word, 'Word2007');
        $objWriter->save("php://output");
        exit;
    }
}
