<?php
include '../../src/iniciarPHP.php';

if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["lineas"])) {
        try {
            $sql = "INSERT INTO lineas (ID_Musica, Nombre, Color, Descripcion) 
                VALUES (:musica, :nombre, :color, :descripcion)";
            $param = [
                "musica" =>  $_POST["musica"], "nombre" => $_POST["nombre"],
                "color" => $_POST["color"], "descripcion" => $_POST["descripcion"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    } elseif (isset($_POST["producto"])) {
        try {
            $sql = "INSERT INTO productos (Precio, Stock, Descripcion, ID_Linea, Nombre)
                VALUES (:precio, :stock, :descripcion, :ID_Linea, :Nombre)";
            $param = [
                "precio" =>  $_POST["precio"], "stock" => $_POST["stock"],
                "descripcion" => $_POST["descripcion"], "ID_Linea" => $_POST["linea"], "Nombre" => $_POST["nombreProducto"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            $idProducto = $BBDD->lastId();
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
            $file = $_FILES["imagen"]["name"];

            $url_temp = $_FILES["imagen"]["tmp_name"];

            $url_insert = "../img/productos";

            $url_target = str_replace('\\', '/', $url_insert) . '/' . $idProducto . ".png";

            if (!file_exists($url_insert)) {
                mkdir($url_insert, 0777, true);
            };

            if (move_uploaded_file($url_temp, $url_target)) {
                echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    } elseif (isset($_POST["usuario"])) {
        try {
            $sql = "SELECT email FROM usuarios";
            $checkEmail = $BBDD->select($sql);
            foreach($checkEmail as $email){
                if ($email["email"] == $_POST["email"])  {
                    $errorR = "Ya existe una cuenta con ese email";
                }
            }
            if (!isset($errorR)) {
                $password = hash("sha512", $_POST["password"]);
                $passwordCheck = hash("sha512", $_POST["passwordCheck"]);
                if ($password == $passwordCheck) {                
                    $sql = "INSERT INTO usuarios(Email, Password, Rol) VALUES (:email, :password, :rol)";
                    $param = ["email" =>  $_POST["email"], "password" => $password, "rol" => $_POST["rol"]];
                    $respuesta = $BBDD->execute($sql, $param);
                    if ($respuesta[0]) {
                        $errorR = $respuesta[1];
                    }
                } else {
                    $errorR = "Las contraseñas no coinciden";
                }                
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
};


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
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
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
                    <input type="color" id="color" name="color" class="form-control" required>
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
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from lineas";
                    $lineas = $BBDD->select($sql);
                    foreach ($lineas as $linea) {
                        echo "<tr>";
                        echo "<td>" . $linea["Nombre"] . "</td>";
                        echo "<td>" . $linea["Color"] . "</td>";
                        echo "<td>" . $linea["ID_Musica"] . "</td>";
                        echo "<td>" . $linea["Descripcion"] . "</td>";
                        echo "<td>
                                <button onclick=llenarFormularioLineaCosmetica()>
                                    <i class=fas fa-pencil-alt></i>
                                </button>
                                <button onclick=updateProducto>
                                    <i class=fas fa-trash-alt></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Productos</h2>
            <div id="productoMessage"></div>
            <form id="productoForm" method="post" enctype="multipart/form-data">
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
                    <textarea id="descripcionP" name="descripcion" class="form-control" required></textarea>
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
                    <input type="file" id="imagen" name="imagen" accept="image/png" class="form-control-file">
                </div>
                <button type="submit" id="productoActionButton" name="producto" class="btn btn-primary">Agregar</button>
            </form>
        </section>

        <section class="table-container">
            <table id="tablaProductos" class="table table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Línea</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from productos";
                    $productos = $BBDD->select($sql);
                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto["Nombre"] . "</td>";
                        echo "<td>" . $producto["Precio"] . "</td>";
                        echo "<td>" . $producto["Descripcion"] . "</td>";
                        echo "<td>" . $producto["ID_Linea"] . "</td>";
                        echo "<td>" . $producto["Stock"] . "</td>";
                        // echo "<td>" . $producto["Img"] . "</td>";
                        echo "<td>
                                <button onclick=llenarFormularioProducto()>
                                    <i class=fas fa-pencil-alt></i>
                                </button>
                                <button @click=handleDelete>
                                    <i class=fas fa-trash-alt></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
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
                    <label for="contrasena">Repite la contraseña:</label>
                    <input type="password" id="passwordCheck" name="passwordCheck" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <input type="radio" name="rol" value="1" required>
                    Administrador
                    <input type="radio" name="rol" value="2" required>
                    Alumno
                    </label>
                </div>
                <?php
                    if (isset($errorR)) {
                        echo "<div>" . $errorR . "</div>";
                    }
                ?>
                <button type="submit" id="usuarioActionButton" name="usuario" class="btn btn-primary">Agregar</button>
            </form>
        </section>

        <section>
            <table id="usuarios" class="table table-bordered table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from usuarios";
                    $usuarios = $BBDD->select($sql);
                    foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>" . $usuario["Email"] . "</td>";
                        switch ($usuario["rol"]) {
                            case 1:
                                echo "<td>Admin</td>";
                                break;
                            case 2:
                                echo "<td>Alumno</td>";
                                break;
                            case 3:
                                echo "<td>Cliente</td>";
                                break;
                        }
                        echo "<td>
                                <button onclick=llenarFormularioUsuario()>
                                    <i class=fas fa-pencil-alt></i>
                                </button>
                                <button @click=handleDelete>
                                    <i class=fas fa-trash-alt></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
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

