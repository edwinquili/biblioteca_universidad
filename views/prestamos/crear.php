<h2>Registrar Préstamo</h2>
<form method="POST">
    <label>Libro:</label><br>
    <select name="id_libro" required>
        <?php foreach ($libros as $libro): ?>
            <option value="<?= $libro['id_libro'] ?>"><?= $libro['titulo'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Estudiante:</label><br>
    <select name="id_estudiante" required>
        <?php foreach ($estudiantes as $estudiante): ?>
            <option value="<?= $estudiante['id_estudiante'] ?>"><?= $estudiante['nombre'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fecha de Préstamo:</label><br>
    <input type="date" name="fecha_prestamo" required><br><br>

    <label>Fecha de Devolución:</label><br>
    <input type="date" name="fecha_devolucion" required><br><br>

    <input type="submit" value="Registrar">
</form>
<br>
<a href="index.php?action=listar_prestamos">Volver al listado</a>