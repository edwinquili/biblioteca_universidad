<!DOCTYPE html>
<html>
<head>
    <title>Estudiantes Registrados</title>
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
    <h2>🎓 Estudiantes Registrados</h2>
    <a href="index.php?action=crear_estudiante" class="btn">Agregar estudiante</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($estudiantes as $e): ?>
        <tr>
            <td><?= $e['id_estudiante'] ?></td>
            <td><?= $e['nombre'] ?></td>
            <td><?= $e['carrera'] ?></td>
            <td><?= $e['email'] ?></td>
            <td>
                <a href="index.php?action=eliminar_estudiante&id=<?= $e['id_estudiante'] ?>" onclick="return confirm('¿Eliminar este estudiante?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php?action=exportar_estudiantes_word" class="btn" target="_blank">Exportar a Word</a>
</div>
</body>
</html>