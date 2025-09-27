<!DOCTYPE html>
<html>
<head>
    <title>Listado de Préstamos</title>
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
    <h2>📄 Préstamos Registrados</h2>
    <a href="index.php?action=crear_prestamo" class="btn">Registrar nuevo préstamo</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Libro</th>
            <th>Estudiante</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
        </tr>
        <?php foreach ($prestamos as $p): ?>
        <tr>
            <td><?= $p['id_prestamo'] ?></td>
            <td><?= $p['titulo'] ?></td>
            <td><?= $p['estudiante'] ?></td>
            <td><?= $p['fecha_prestamo'] ?></td>
            <td><?= $p['fecha_devolucion'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php?action=exportar_prestamos_pdf" class="btn" target="_blank">Exportar a PDF</a>
</div>
</body>
</html>