<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">➕ Nuevo Libro</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_autor" class="form-label">Autor</label>
                        <select name="id_autor" id="id_autor" class="form-select" required>
                            <?php foreach ($autores as $autor): ?>
                                <option value="<?= $autor['id_autor'] ?>"><?= htmlspecialchars($autor['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select name="id_categoria" id="id_categoria" class="form-select" required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria'] ?>"><?= htmlspecialchars($categoria['nombre_categoria']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="anio" class="form-label">Año de Publicación</label>
                        <input type="number" name="anio" id="anio" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?action=index" class="btn btn-secondary">← Volver al listado</a>
                        <button type="submit" class="btn btn-primary">💾 Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>