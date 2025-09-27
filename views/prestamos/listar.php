<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Préstamos</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📄 Préstamos Registrados</h5>
                <div>
                    <a href="index.php?action=crear_prestamo" class="btn btn-light btn-sm me-2">➕ Registrar</a>
                    <a href="index.php?action=exportar_prestamos_pdf" class="btn btn-light btn-sm" target="_blank">📤 Exportar</a>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($prestamos)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Libro</th>
                                <th>Estudiante</th>
                                <th>Fecha Préstamo</th>
                                <th>Fecha Devolución</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prestamos as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['id_prestamo']) ?></td>
                                <td><?= htmlspecialchars($p['titulo']) ?></td>
                                <td><?= htmlspecialchars($p['estudiante']) ?></td>
                                <td><?= htmlspecialchars($p['fecha_prestamo']) ?></td>
                                <td><?= htmlspecialchars($p['fecha_devolucion']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No hay préstamos registrados.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>