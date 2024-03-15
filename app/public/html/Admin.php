<?php
include '../../src/iniciarPHP.php';

if ($_SESSION["rol"] !== 1) {
    header("Location: index.php"); 
}

?>


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
            <form id="lineaCosmeticaForm" method="post">
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
                    <input type="number" id="musica" name="musica" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                </div>
                <?php 
                if (isset($errorR)) {
                        echo "<div>" . $errorR . "</div>";
                }
                ?>
                <button type="submit" id="actionButton" name="lineas" class="btn btn-primary">Agregar</button>
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
            <form id="productoForm" method="post">
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
                <button type="submit" id="productoActionButton" name="producto" class="btn btn-primary">Agregar</button>
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
            <form id="usuarioForm" method="post">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                        <input type="radio" name="rol" value="1" required>
                        Administrador
                        <input type="radio" name="rol" value="2" required>
                        Alumno
                    </label>
                </div>
                <button type="submit" id="usuarioActionButton" name="usuario" class="btn btn-primary">Agregar</button>
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

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["lineas"])) {
            try {
                $sql = "INSERT INTO lineas (ID_Musica, Nombre, Color, Descripcion) 
                VALUES (:musica, :nombre, :color, :descripcion)";
                $param = ["musica" =>  $_POST["musica"], "nombre" => $_POST["nombre"], 
                "color" => $_POST["color"], "descripcion" => $_POST["descripcion"]];               
                $respuesta = $BBDD -> execute($sql, $param);
                if ($respuesta[0]) {
                    $errorR = $respuesta[1];
                }       
            }catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
            }         
        } elseif (isset($_POST["producto"])) {
            try {
                $sql = "INSERT INTO productos (Precio, Stock, Descripcion, ID_Linea, Nombre)
                VALUES (:precio, :stock, :descripcion, :ID_Linea, :Nombre)";
                $param = ["precio" =>  $_POST["precio"], "stock" => $_POST["stock"],
                "descripcion" => $_POST["descripcion"], "ID_Linea" => $_POST["linea"], "Nombre" => $_POST["nombreProducto"]];               
                $respuesta = $BBDD -> execute($sql, $param);
                if ($respuesta[0]) {
                    $errorR = $respuesta[1];
                }       
            }catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
            } 
        } elseif (isset($_POST["usuario"])) {
            try {
                $password = hash("sha512",$_POST["password"]);
                $sql = "INSERT INTO usuarios(Email, Password, Rol) VALUES (:email, :password, :rol)";
                $param = ["email" =>  $_POST["email"], "password" => $password, "rol" => $_POST["rol"]];               
                $respuesta = $BBDD -> execute($sql, $param);
                if ($respuesta[0]) {
                    $errorR = $respuesta[1];
                }
            }catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
            } 
        }
    }; 


?>
