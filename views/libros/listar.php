<!DOCTYPE html>
<html>
<head>
    <title>Libros Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin-bottom: 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📘 Libros Registrados</h2>
    <a href="index.php?action=crear" class="btn">Agregar nuevo libro</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Categoría</th>
            <th>Año</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?= $libro['id_libro'] ?></td>
            <td><?= $libro['titulo'] ?></td>
            <td><?= $libro['nombre_autor'] ?></td>
            <td><?= $libro['nombre_categoria'] ?></td>
            <td><?= $libro['anio_publicacion'] ?></td>
            <td>
                <a href="index.php?action=editar&id=<?= $libro['id_libro'] ?>">Editar</a> |
                <a href="index.php?action=eliminar&id=<?= $libro['id_libro'] ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>