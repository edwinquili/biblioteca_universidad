<!DOCTYPE html>
<html>
<head>
    <title>Editar Libro</title>
</head>
<body>
    <h1>Editar Libro</h1>
    <form method="POST">
        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= $libro['titulo'] ?>" required><br><br>

        <label>Autor:</label><br>
        <select name="id_autor" required>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['id_autor'] ?>" <?= $autor['id_autor'] == $libro['id_autor'] ? 'selected' : '' ?>>
                    <?= $autor['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Categoría:</label><br>
        <select name="id_categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id_categoria'] ?>" <?= $categoria['id_categoria'] == $libro['id_categoria'] ? 'selected' : '' ?>>
                    <?= $categoria['nombre_categoria'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Año de Publicación:</label><br>
        <input type="number" name="anio" value="<?= $libro['anio_publicacion'] ?>" required><br><br>

        <input type="submit" value="Actualizar">
    </form>
    <br>
    <a href="index.php">Volver al listado</a>
</body>
</html>