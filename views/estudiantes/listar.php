<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes Registrados</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">🎓 Estudiantes Registrados</h5>
                <div>
                    <a href="index.php?action=crear_estudiante" class="btn btn-light btn-sm me-2">➕ Agregar</a>
                    <a href="index.php?action=exportar_estudiantes_word" class="btn btn-light btn-sm" target="_blank">📤 Exportar</a>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($estudiantes)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Carrera</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($estudiantes as $e): ?>
                            <tr>
                                <td><?= htmlspecialchars($e['id_estudiante']) ?></td>
                                <td><?= htmlspecialchars($e['nombre']) ?></td>
                                <td><?= htmlspecialchars($e['carrera']) ?></td>
                                <td><?= htmlspecialchars($e['email']) ?></td>
                                <td>
                                    <a href="index.php?action=eliminar_estudiante&id=<?= $e['id_estudiante'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este estudiante?')">🗑️ Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No hay estudiantes registrados.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>