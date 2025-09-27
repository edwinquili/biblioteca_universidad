<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros Registrados</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📘 Libros Registrados</h5>
                <div>
                    <a href="index.php?action=crear" class="btn btn-light btn-sm me-2">➕ Agregar</a>
                    <a href="index.php?action=exportar_excel_libros" class="btn btn-light btn-sm" target="_blank">📤 Exportar</a>
                </div>
            </div>
            <div class="card-body">
                <div id="loader" class="text-center my-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Categoría</th>
                                <th>Año</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-libros">
                            <!-- Filas Ajax -->
                        </tbody>
                    </table>
                </div>

                <div id="paginacion-libros" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>

    <script>
        function cargarLibros(page = 1) {
            $('#loader').show();
            $.ajax({
                url: 'index.php?action=ajax_libros',
                method: 'POST',
                dataType: 'json',
                data: { page: page },
                success: function(response) {
                    $('#tabla-libros').html(response.html);
                    $('#paginacion-libros').html(response.pagination);
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar libros:", error);
                    $('#tabla-libros').html("<tr><td colspan='6' class='text-center text-danger'>No se pudo cargar la información.</td></tr>");
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        }

        $(document).ready(function() {
            cargarLibros();

            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                cargarLibros(page);
            });
        });
    </script>
</body>
</html>