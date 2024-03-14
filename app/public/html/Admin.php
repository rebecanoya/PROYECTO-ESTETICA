<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aromusicoterapia - Administración</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <main class="container">
        <section>
            <h2>Líneas Cosméticas</h2>
            <div id="lineaCosmeticaMessage"></div>
            <form id="lineaCosmeticaForm">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="musica">Música:</label>
                    <input type="text" id="musica" name="musica" class="form-control" required>
                </div>
                <button type="submit" id="actionButton" class="btn btn-primary">Agregar</button>
            </form>
        </section>

        <section>
            <table id="lineasCosmeticas" class="table table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Música</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Productos</h2>
            <div id="productoMessage"></div>
            <form id="productoForm">
                <div class="form-group">
                    <label for="nombreProducto">Nombre:</label>
                    <input type="text" id="nombreProducto" name="nombreProducto" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="linea">Línea:</label>
                    <select id="linea" name="linea" class="form-control" required>
                        <option value="1">Línea 1</option>
                        <option value="2">Línea 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control-file">
                </div>
                <button type="submit" id="productoActionButton" class="btn btn-primary">Agregar</button>
            </form>
        </section>

        <section class="table-container">
            <table id="productos" class="table table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Línea</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Usuarios</h2>
            <div id="usuarioMessage"></div>
            <form id="usuarioForm">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" id="usuarioActionButton" class="btn btn-primary">Agregar</button>
            </form>
        </section>

        <section>
            <table id="usuarios" class="table table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Correo</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>

    </main>
    <script src="../js/admin.js"></script>
    <script src="../js/lineas.js"></script>
    <script src="../js/usuarios.js"></script>
    <script src="../js/productos.js"></script>
</body>

</html>
