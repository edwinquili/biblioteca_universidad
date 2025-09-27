<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

 <header class="bg-primary text-white py-4 mb-3">
        <div class="container text-center">
            <h1 class="display-5">📚 Gestión Biblioteca Universitaria</h1>
            <p class="lead">Administra libros, estudiantes y préstamos de forma eficiente y profesional.</p>
        </div>
    </header>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-header bg-primary text-white text-center">
            <h5>🔐 Iniciar Sesión</h5>
        </div>
        <div class="card-body">
            <form action="validar_login.php" method="POST">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>
            <div class="text-center mt-3">
                <a href="registro.php">¿No tienes cuenta? Regístrate</a>
            </div>
        </div>
    </div>
    <div class="container text-center mt-3">
        <p class="mb-0">&copy; 2024 Biblioteca Universitaria. Todos los derechos reservados.</p>
</div>
</body>
</html>
    