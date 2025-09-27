<?php
require_once 'models/Prestamo.php';

class PrestamosController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Prestamo();
    }

    public function index()
    {
        $prestamos = $this->modelo->listar();
        include 'views/prestamos/listar.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear($_POST['id_libro'], $_POST['id_estudiante'], $_POST['fecha_prestamo'], $_POST['fecha_devolucion']);
            header("Location: index.php?action=listar_prestamos");
        } else {
            $libros = $this->modelo->obtenerLibros();
            $estudiantes = $this->modelo->obtenerEstudiantes();
            include 'views/prestamos/crear.php';
        }
    }

   public function exportarPDF() {
    if (ob_get_contents()) ob_end_clean();
    require_once __DIR__ . '/../fpdf/fpdf.php';
    $prestamos = $this->modelo->listarConDetalles();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,mb_convert_encoding('Informe de Préstamos Registrados', 'ISO-8859-1', 'UTF-8'),0,1,'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,10,'ID',1);
    $pdf->Cell(72,10,'Libro',1);
    $pdf->Cell(30,10,'Estudiante',1);
    $pdf->Cell(35,10,mb_convert_encoding('Fecha Préstamo', 'ISO-8859-1', 'UTF-8'),1);
    $pdf->Cell(35,10,mb_convert_encoding('Fecha Devolución', 'ISO-8859-1', 'UTF-8'),1);
    $pdf->Ln();

    $pdf->SetFont('Arial','',10);
    foreach ($prestamos as $p) {
        $pdf->Cell(10,10,$p['id_prestamo'],1);
        $pdf->Cell(72,10,mb_convert_encoding($p['titulo'], 'ISO-8859-1', 'UTF-8'),1);
        $pdf->Cell(30,10,mb_convert_encoding($p['estudiante'], 'ISO-8859-1', 'UTF-8'),1);
        $pdf->Cell(35,10,$p['fecha_prestamo'],1);
        $pdf->Cell(35,10,$p['fecha_devolucion'],1);
        $pdf->Ln();
    }

    $pdf->Output();
    exit;
}

}
