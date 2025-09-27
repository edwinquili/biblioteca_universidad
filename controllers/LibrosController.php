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

    public function ajaxLibros()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $libros = $this->modelo->listarPaginado($limit, $offset);
        $total = $this->modelo->contarTotal();
        $totalPages = ceil($total / $limit);

        // Generar HTML de filas
        $html = '';
        foreach ($libros as $libro) {
            $id = htmlspecialchars($libro['id_libro']);
            $titulo = htmlspecialchars($libro['titulo']);
            $autor = htmlspecialchars($libro['autor']);
            $categoria = htmlspecialchars($libro['categoria']);
            $anio = htmlspecialchars($libro['anio_publicacion']);

            $html .= "<tr>
            <td>$id</td>
            <td>$titulo</td>
            <td>$autor</td>
            <td>$categoria</td>
            <td>$anio</td>
            <td>
                <a href='index.php?action=editar&id=$id'>Editar</a> |
                <a href='index.php?action=eliminar&id=$id' onclick='return confirm(\"¿Eliminar este libro?\")'>Eliminar</a>
            </td>
        </tr>";
        }

        // Generar botones de paginación
        $pagination = $this->generarBotones($totalPages, $page);

        // Devolver como JSON
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'html' => $html,
            'pagination' => $pagination
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    private function generarBotones($totalPages, $currentPage)

    
    {
        
        $html = '<nav aria-label="Paginación de libros">';
        $html .= '<ul class="pagination justify-content-center" style="margin-top: 20px;">';

        // Flecha izquierda
        if ($currentPage > 1) {
            $prev = $currentPage - 1;
            $html .= "<li class='page-item'>
                    <a class='page-link' href='#' data-page='$prev' aria-label='Anterior'>
                        <span aria-hidden='true'>&laquo;</span>
                    </a>
                  </li>";
        } else {
            $html .= "<li class='page-item disabled'>
                    <span class='page-link' aria-hidden='true'>&laquo;</span>
                  </li>";
        }

        // Números de página
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i === $currentPage) ? 'active' : '';
            $html .= "<li class='page-item $active'>
                    <a class='page-link' href='#' data-page='$i'>$i</a>
                  </li>";
        }

        // Flecha derecha
        if ($currentPage < $totalPages) {
            $next = $currentPage + 1;
            $html .= "<li class='page-item'>
                    <a class='page-link' href='#' data-page='$next' aria-label='Siguiente'>
                        <span aria-hidden='true'>&raquo;</span>
                    </a>
                  </li>";
        } else {
            $html .= "<li class='page-item disabled'>
                    <span class='page-link' aria-hidden='true'>&raquo;</span>
                  </li>";
        }

        $html .= '</ul></nav>';
        return $html;
    }
}
