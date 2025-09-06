<?php
require_once 'controllers/LibrosController.php';
require_once 'controllers/EstudiantesController.php';
require_once 'controllers/PrestamosController.php';

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión Biblioteca Universitaria</title>
    <style>
        nav {
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php?action=index">📘 Libros</a>
        <a href="index.php?action=listar_estudiantes">🎓 Estudiantes</a>
        <a href="index.php?action=listar_prestamos">📄 Préstamos</a>
    </nav>

<?php
// Enrutamiento
switch ($action) {
    // Libros
    case 'crear':
        (new LibrosController())->crear();
        break;
    case 'editar':
        (new LibrosController())->editar($id);
        break;
    case 'eliminar':
        (new LibrosController())->eliminar($id);
        break;
    case 'index':
        (new LibrosController())->index();
        break;

    // Estudiantes
    case 'listar_estudiantes':
        (new EstudiantesController())->index();
        break;
    case 'crear_estudiante':
        (new EstudiantesController())->crear();
        break;
    case 'eliminar_estudiante':
        (new EstudiantesController())->eliminar($id);
        break;

    // Préstamos
    case 'listar_prestamos':
        (new PrestamosController())->index();
        break;
    case 'crear_prestamo':
        (new PrestamosController())->crear();
        break;

    // Acción no reconocida
    default:
        echo "<h2>Acción no reconocida</h2>";
        break;
}
?>


</body>
</html>