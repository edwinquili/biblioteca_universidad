<?php
require_once 'controllers/LibrosController.php';
require_once 'controllers/EstudiantesController.php';
require_once 'controllers/PrestamosController.php';

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Enrutamiento que debe ejecutarse antes de imprimir HTML
switch ($action) {
    // Ajax debe salir inmediatamente
    case 'ajax_libros':
        (new LibrosController())->ajaxLibros();
        exit;

    // Acciones que no imprimen HTML directamente
    case 'crear':
        (new LibrosController())->crear();
        exit;
    case 'editar':
        (new LibrosController())->editar($id);
        exit;
    case 'eliminar':
        (new LibrosController())->eliminar($id);
        exit;
    case 'exportar_excel':
        (new LibrosController())->exportarExcel();
        exit;
    case 'exportar_prestamos_pdf':
        (new PrestamosController())->exportarPDF();
        exit;
    case 'exportar_estudiantes_word':
        (new EstudiantesController())->exportarWord();
        exit;
}

// Si no fue ninguna de las anteriores, continúa con HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión Biblioteca Universitaria</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <!-- Encabezado principal -->
    <header class="bg-primary text-white py-4 mb-3">
        <div class="container text-center">
            <h1 class="display-5">📚 Gestión Biblioteca Universitaria</h1>
            <p class="lead">Administra libros, estudiantes y préstamos de forma eficiente y profesional.</p>
        </div>
    </header>

    <!-- Navegación -->
    <nav class="bg-white border-bottom mb-4">
        <div class="container d-flex justify-content-center py-2">
            <a href="index.php?action=index" class="btn btn-outline-primary me-2">📘 Libros</a>
            <a href="index.php?action=listar_estudiantes" class="btn btn-outline-success me-2">🎓 Estudiantes</a>
            <a href="index.php?action=listar_prestamos" class="btn btn-outline-secondary">📄 Préstamos</a>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="container mb-5">
        <?php
        switch ($action) {
            case 'index':
                (new LibrosController())->index();
                break;
            case 'listar_estudiantes':
                (new EstudiantesController())->index();
                break;
            case 'crear_estudiante':
                (new EstudiantesController())->crear();
                break;
            case 'eliminar_estudiante':
                (new EstudiantesController())->eliminar($id);
                break;
            case 'listar_prestamos':
                (new PrestamosController())->index();
                break;
            case 'crear_prestamo':
                (new PrestamosController())->crear();
                break;
            default:
                echo "<div class='alert alert-danger text-center'>Acción no reconocida</div>";
                break;
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-1">📞 Contacto: biblioteca@universidad.edu.co | ☎️ +57 312 345 6789</p>
            <p class="mb-2">📍 Dirección: Calle 123 #45-67, Cali, Colombia</p>
            <div>
                <a href="#" class="btn btn-sm btn-outline-light me-2">🌐 Sitio Web</a>
                <a href="#" class="btn btn-sm btn-outline-light me-2">📘 Facebook</a>
                <a href="#" class="btn btn-sm btn-outline-light">🐦 Twitter</a>
            </div>
            <hr class="bg-white mt-3">
            <small>&copy; <?= date('Y') ?> Biblioteca Universitaria. Todos los derechos reservados.</small>
        </div>
    </footer>

</body>
</html>
?>
</body>
</html>