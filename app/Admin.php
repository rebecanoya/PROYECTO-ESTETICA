<?php
include 'src/iniciarPHP.php';

/**
 * Comprobamos que el usuario que intenta acceder a la pagina admin posee el rol de admin
 */
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== 1) {
    header("Location: index.php");
}
/**
 * Aqui, segun el tipo de formulario que se envie, realizaremos diferentes acciones 
 * como insertar o modificar prodcutos, lineas o usuarios
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /**
     * Si nos envian el formulario lineas insertaremos una nueva linea
     */
    if (isset($_POST["lineas"])) {
        if (!isset($_FILES["imagenFondo"])) {
            throw new Exception("Es necesario adjuntar una imagen");
        }
        if (!isset($_FILES["imagenLote"])) {
            throw new Exception("Es necesario adjuntar una imagen");
        }
        /**
         * Aqui hacemos una consulta preparada para insertar una nueva linea cuyos datos serán los obtenidos del formulario
         */
        try {
            $sql = "INSERT INTO lineas(Nombre, Color, Descripcion, Activo) VALUES (:nombre, :color, :descripcion, :activo)";
            $param = [
                "nombre" => $_POST["nombre"],
                "color" => substr($_POST["color"], 1),
                "descripcion" => $_POST["descripcion"],
                "activo" => $_POST["activoL"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            $idLinea = $BBDD->lastId();
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
            /**
             * Como cada producto tiene una imagen asociada, tenemos que comprobar que el archivo
             * que se nos pasa sea una imagen en formato PNG
             */
            $fileFondo = $_FILES["imagenFondo"]["name"];

            $url_tempFondo = $_FILES["imagenFondo"]["tmp_name"];

            $fileLote = $_FILES["imagenLote"]["name"];

            $url_tempLote = $_FILES["imagenLote"]["tmp_name"];

            /**
             * Ruta donde vamos a guardar la imagen
             */
            $url_insertFondo = "img/lineas";
            $url_insertLote = "img/lote";
            /**
             * Cada imagen debe de llevar el ID del producto por nombre, por tanto,
             * usamos el idProducto obtenido gracias a la funcion lastId para darle nombre
             */
            $url_targetFondo = str_replace('\\', '/', $url_insertFondo) . '/' . $idLinea . ".png";
            $url_targetLote = str_replace('\\', '/', $url_insertLote) . '/' . $idLinea . ".png";
            /**
             * Si no existiese la carpeta donde queremos guardar la imagen, lo creamos
             */
            if (!file_exists($url_insertFondo)) {
                mkdir($url_insertFondo, 0777, true);
            };
            if (!file_exists($url_insertLote)) {
                mkdir($url_insertLote, 0777, true);
            };
            /**
             * Por ultimo, si no conseguimos guardar la imagen informamos
             * actualizando la variable errorP
             */
            if (!move_uploaded_file($url_tempFondo, $url_targetFondo)) {
                $errorP = "Ha habido un error al cargar tu archivo.";
            }
            if (!move_uploaded_file($url_tempLote, $url_targetLote)) {
                $errorP = "Ha habido un error al cargar tu archivo.";
            }
            /**
             * Si nos envian el formulario lineasMod modificaremos la linea, cuyo id sea el selecionado gracias
             * a la funcion de Js llenarFormularioLineaCosmetica(), con los datos obtenidos del formulario
             */
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    } elseif (isset($_POST["lineasMod"])) {
        try {
            /**
             * Aqui hacemos una consulta preparada para modificar la linea con los datos obtenidos del formulario
             */
            $sql = "UPDATE lineas SET Nombre = :nombre, Color = :color,
            Descripcion = :descripcion, Activo = :activo WHERE lineas.ID = :id";
            $param = [
                "nombre" => $_POST["nombre"],
                "color" => substr($_POST["color"], 1),
                "descripcion" => $_POST["descripcion"],
                "activo" => $_POST["activoL"],
                "id" => $_POST["idL"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
            if (isset($_FILES)) {
                var_dump($_POST["idL"]);
                $imagenFondo = $_FILES['imagenFondo'];
                $imagenLote = $_FILES['imagenLote'];
                $fileFondo = $imagenFondo["name"];
                $fileLote = $imagenLote["name"];
                /**
                 * Ruta donde vamos a guardar la imagen
                 */
                $url_tempFondo = $imagenFondo["tmp_name"];
                $url_tempLote = $imagenLote["tmp_name"];
                /**
                 * Ruta donde vamos a guardar la imagen
                 */
                $url_insertFondo = "img/lineas";
                $url_insertLote = "img/lote";
                /**
                 * Cada imagen debe de llevar el ID del producto por nombre, por tanto,
                 * usamos el idProducto obtenido gracias a la funcion lastId para darle nombre
                 */
                $url_targetFondo = str_replace('\\', '/', $url_insertFondo) . '/' . $_POST["idL"] . ".png";
                $url_targetLote = str_replace('\\', '/', $url_insertLote) . '/' . $_POST["idL"] . ".png";
                /**
                 * Si no existiese la carpeta donde queremos guardar la imagen, lo creamos
                 */
                if (!file_exists($url_insertFondo)) {
                    mkdir($url_insertFondo, 0777, true);
                };
                if (!file_exists($url_insertLote)) {
                    mkdir($url_insertLote, 0777, true);
                };
                move_uploaded_file($url_tempFondo, $url_targetFondo);
                move_uploaded_file($url_tempLote, $url_targetLote);
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        /**
         * Si nos envian el formulario producto insertaremos un nuevo producto
         */
    } elseif (isset($_POST["producto"])) {
        try {
            if (!isset($_FILES["imagen"])) {
                throw new Exception("Es necesario adjuntar una imagen");
            }
            /**
             * Aqui hacemos una consulta preparada para insertar un nuevo producto cuyos datos serán los obtenidos del formulario
             */
            $sql = "INSERT INTO productos (Precio, Stock, Descripcion, ID_Linea, Nombre, Activo)
                VALUES (:precio, :stock, :descripcion, :ID_Linea, :Nombre, :Activo)";
            $param = [
                "precio" =>  $_POST["precio"],
                "stock" => $_POST["stock"],
                "descripcion" => $_POST["descripcion"],
                "ID_Linea" => $_POST["linea"],
                "Nombre" => $_POST["nombreProducto"],
                "Activo" => $_POST["activoP"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            $idProducto = $BBDD->lastId();
            var_dump($respuesta);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
            /**
             * Como cada producto tiene una imagen asociada, tenemos que comprobar que el archivo
             * que se nos pasa sea una imagen en formato PNG
             */
            $file = $_FILES["imagen"]["name"];

            $url_temp = $_FILES["imagen"]["tmp_name"];

            /**
             * Ruta donde vamos a guardar la imagen
             */
            $url_insert = "img/productos";
            /**
             * Cada imagen debe de llevar el ID del producto por nombre, por tanto,
             * usamos el idProducto obtenido gracias a la funcion lastId para darle nombre
             */
            $url_target = str_replace('\\', '/', $url_insert) . '/' . $idProducto . ".png";

            /**
             * Si no existiese la carpeta donde queremos guardar la imagen, lo creamos
             */
            if (!file_exists($url_insert)) {
                mkdir($url_insert, 0777, true);
            };
            /**
             * Por ultimo, si no conseguimos guardar la imagen informamos
             * actualizando la variable errorP
             */
            if (!move_uploaded_file($url_temp, $url_target)) {
                $errorP = "Ha habido un error al cargar tu archivo.";
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }
        /**
         * Si nos envian el formulario prodcutoMod modificaremos el producto, cuyo id sea el selecionado gracias
         * a la funcion de Js llenarFormularioProducto(), con los datos obtenidos del formulario
         */
    } elseif (isset($_POST["productoMod"])) {
        try {
            /**
             * Aqui hacemos una consulta preparada para modificar un producto con los datos obtenidos del formulario
             */
            $sql = "UPDATE productos SET Precio = :precio, Stock = :stock, Descripcion = :descripcion,
            ID_Linea = :linea, Nombre = :nombre, Activo = :activo WHERE productos.ID = :id";
            $param = [
                "precio" => $_POST["precio"],
                "stock" => $_POST["stock"],
                "descripcion" => $_POST["descripcion"],
                "linea" => $_POST["linea"],
                "nombre" => $_POST["nombreProducto"],
                "activo" => $_POST["activoP"],
                "id" => $_POST["idP"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
            /**
             * Como cada producto tiene una imagen asociada, si esta desea ser modificada, tenemos que comprobar que el archivo
             * que se nos pasa sea una imagen en formato PNG
             */
            if (isset($_FILES)) {
                $imagen = $_FILES['imagen'];
                $file = $imagen["name"];
                /**
                 * Ruta donde vamos a guardar la imagen
                 */
                $url_temp = $imagen["tmp_name"];
                /**
                 * Ruta donde vamos a guardar la imagen
                 */
                $url_insert = "img/productos";
                /**
                 * Cada imagen debe de llevar el ID del producto por nombre, por tanto,
                 * usamos el idProducto obtenido gracias a la funcion lastId para darle nombre
                 */
                $url_target = str_replace('\\', '/', $url_insert) . '/' . $_POST["idP"] . ".png";
                /**
                 * Si no existiese la carpeta donde queremos guardar la imagen, lo creamos
                 */
                if (!file_exists($url_insert)) {
                    mkdir($url_insert, 0777, true);
                };
                move_uploaded_file($url_temp, $url_target);
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        /**
         * Si nos envian el formulario usuario insertaremos un nuevo usuario
         */
    } elseif (isset($_POST["usuario"])) {
        try {
            /**
             * Comprobamos que el email introducido no existe ya en la base de datos
             */
            $sql = "SELECT email FROM usuarios";
            $checkEmail = $BBDD->select($sql);
            foreach ($checkEmail as $email) {
                if ($email["email"] == $_POST["email"]) {
                    $errorR = "Ya existe una cuenta con ese email";
                }
            }
            /**
             * Si el email no existe, hacemos una consulta preparada 
             * para insertar una nueva linea cuyos datos serán los obtenidos del formulario
             */
            if (!isset($errorR)) {
                $password = hash("sha512", $_POST["password"]);
                $passwordCheck = hash("sha512", $_POST["passwordCheck"]);
                /**
                 * Igual que en el Registro, las contraseñas deben de coincidir para poder
                 * insertar el usuario
                 */
                if ($password == $passwordCheck) {
                    $sql = "INSERT INTO usuarios(Email, Password, Rol, Activo) VALUES (:email, :password, :rol, :activo)";
                    $param = [
                        "email" =>  $_POST["email"],
                        "password" => $password,
                        "rol" => $_POST["rol"],
                        "activo" => $_POST["activoU"]
                    ];
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
        /**
         * Si nos envian el formulario usuarioMod modificaremos el usuario, cuyo id sea el selecionado gracias
         * a la funcion de Js llenarFormularioUsuario(), con los datos obtenidos del formulario
         */
    } elseif (isset($_POST["usuarioMod"])) {
        try {
            /**
             * Aqui hacemos una consulta preparada para modificar el prodcuto con los datos obtenidos del formulario
             */
            $sql = "UPDATE usuarios SET email = :email, rol = :rol, activo = :activo  WHERE usuarios.id = :id";
            $param = [
                "email" => $_POST["email"],
                "rol" => $_POST["rol"],
                "activo" => $_POST["activoU"],
                "id" => $_POST["idU"]
            ];
            $respuesta = $BBDD->execute($sql, $param);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
        /**
         * Si nos envian el formulario resetUsuario modificaremos el usuario, poniendo su contraseña
         * como un String vacio, cuyo id sea el selecionado gracias
         * a la funcion de Js llenarFormularioUsuario()
         */
    } elseif (isset($_POST["resetUsuario"])) {
        try {
            $sql = "UPDATE usuarios SET password = :password WHERE usuarios.id = :id";
            $param = ["password" => hash("sha512", ""), "id" => $_POST["id"]];
            $respuesta = $BBDD->execute($sql, $param);
            if ($respuesta[0]) {
                $errorR = $respuesta[1];
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
};


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aromusicoterapia - Administración</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>
        <a href="index.php" class="fa-solid fa-arrow-left iconButton"></a>
    </header>

    <main class="container">

        <h2 class="container text-center">Panel de administración</h2>

        <nav class="container text-center buttons">

            <button>Lineas</button>
            <button>Productos</button>
            <button>Usuarios</button>

        </nav>

        <section>
            <h2>Líneas Cosméticas</h2>
            <div id="lineaCosmeticaMessage"></div>
            <form id="lineaCosmeticaForm" method="post" enctype="multipart/form-data">
                <input type="hidden" id="idL" name="idL" value=0 class="form-control">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="color" id="color" name="color" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="activoL">Activo:</label>
                    <input id="activoL" type="radio" name="activoL" value="1" required>
                    Si
                    <input type="radio" name="activoL" value="2" required>
                    No
                    </label>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen Fondo:</label>
                    <input type="file" id="imagenFondo" name="imagenFondo" accept="image/png" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen Lote:</label>
                    <input type="file" id="imagenLote" name="imagenLote" accept="image/png" class="form-control-file">
                </div>
                <?php
                if (isset($errorR)) {
                    echo "<div>" . $errorR . "</div>";
                }
                ?>
                <button type="submit" id="lineasActionButton" name="lineas" class="btn btn-dark mb-3">Agregar</button>
                <button type="submit" id="lineasModButton" name="lineasMod" class="btn btn-dark mb-3" disabled>Modificar</button>
                <button type="button" id="limpiar" name="limpiar" class="btn btn-dark mb-3" onclick=limpiarFormularioLineas()>Limpiar</button>
            </form>
            <table id="lineasCosmeticas" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Descripcion</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from lineas";
                    $lineas = $BBDD->select($sql);
                    /**
                     * Rellenamos la tabla de las lineas con la información obtenida en la consulta anterior
                     */
                    foreach ($lineas as $linea) {
                        echo "<tr>";
                        echo "<td>" . $linea["ID"] . "</td>";
                        echo "<td>" . $linea["Nombre"] . "</td>";
                        echo "<td>" . $linea["Color"] . "</td>";
                        echo "<td>" . $linea["Descripcion"] . "</td>";
                        switch ($linea["Activo"]) {
                            case 1:
                                echo "<td>Si</td>";
                                break;
                            case 2:
                                echo "<td>No</td>";
                                break;
                        }
                        echo "<td>
                                <button onclick=llenarFormularioLineaCosmetica()>
                                    <i class='fas fa-pencil-alt'></i>
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
                <input type="hidden" id="idP" name="idP" value=0 class="form-control">
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
                        <?php
                        // Conexión a la base de datos
                        try {
                            $sql = "SELECT ID, Nombre from lineas";
                            $lineas = $BBDD->select($sql);
                            // Consulta para obtener los datos que se mostrarán en el select
                            // Iteramos sobre los resultados para crear los option del select
                            foreach ($lineas as $linea) {
                                echo "<option value='" . $linea["ID"] . "'>" . $linea["Nombre"] . "</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Error en la conexión o consulta: " . $e->getMessage();
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="activoP">Activo:</label>
                    <input id="activoP" type="radio" name="activoP" value="1" required>
                    Si
                    <input id="activoP" type="radio" name="activoP" value="2" required>
                    No
                    </label>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/png" class="form-control-file">
                </div>
                <button type="submit" id="productoActionButton" name="producto" class="btn btn-dark mb-3">Agregar</button>
                <button type="submit" id="productoModButton" name="productoMod" class="btn btn-dark mb-3" disabled>Modificar</button>
                <button type="button" id="limpiar" name="limpiar" class="btn btn-dark mb-3" onclick=limpiarFormularioProducto()>Limpiar</button>
            </form>
            <table id="tablaProductos" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Línea</th>
                        <th>Stock</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from productos";
                    $productos = $BBDD->select($sql);
                    /**
                     * Rellenamos la tabla de los productos con la información obtenida en la consulta anterior
                     */
                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto["ID"] . "</td>";
                        echo "<td>" . $producto["Nombre"] . "</td>";
                        echo "<td>" . $producto["Precio"] . "</td>";
                        echo "<td>" . $producto["Descripcion"] . "</td>";
                        echo "<td>" . $producto["ID_Linea"] . "</td>";
                        echo "<td>" . $producto["Stock"] . "</td>";
                        switch ($producto["Activo"]) {
                            case 1:
                                echo "<td>Si</td>";
                                break;
                            case 2:
                                echo "<td>No</td>";
                                break;
                        }
                        echo "<td>
                                <button onclick=llenarFormularioProducto()>
                                <i class='fas fa-pencil-alt'></i>
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
                <input type="hidden" id="idU" name="idU" value=0 class="form-control">
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
                    <input id="rol" type="radio" name="rol" value="1" required>
                    Administrador
                    <input type="radio" name="rol" value="2" required>
                    Alumno
                    <input type="radio" name="rol" value="3" required>
                    Cliente
                    </label>
                </div>
                <div class="form-group">
                    <label for="activo">Activo:</label>
                    <input id="activo" type="radio" name="activoU" value="1" required>
                    Si
                    <input id="activo" type="radio" name="activoU" value="2" required>
                    No

                    </label>
                </div>
                <?php
                if (isset($errorR)) {
                    echo "<div>" . $errorR . "</div>";
                }
                ?>
                <button type="submit" id="usuarioActionButton" name="usuario" class="btn btn-dark mb-3">Agregar</button>
                <button type="submit" id="usuarioModButton" name="usuarioMod" class="btn btn-dark mb-3" disabled>Modificar</button>
                <button type="submit" id="resetUsuario" name="resetUsuario" class="btn btn-dark mb-3" disabled>Resetear</button>
                <button type="button" id="limpiar" name="limpiar" class="btn btn-dark mb-3" onclick=limpiarFormularioUsuario()>Limpiar</button>
            </form>

            <table id="usuarios" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from usuarios";
                    $usuarios = $BBDD->select($sql);
                    /**
                     * Rellenamos la tabla de los productos con la información obtenida en la consulta anterior
                     */
                    foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>" . $usuario["ID"] . "</td>";
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
                        switch ($usuario["Activo"]) {
                            case 1:
                                echo "<td>Si</td>";
                                break;
                            case 2:
                                echo "<td>No</td>";
                                break;
                        }
                        echo "<td>
                                <button onclick=llenarFormularioProducto()>
                                    <i class='fas fa-pencil-alt'></i>
                                </button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

    </main>
    <script src="js/admin.js"></script>
    <script src="js/lineas.js"></script>
    <script src="js/usuarios.js"></script>
    <script src="js/productos.js"></script>
</body>

<script>
    const secciones = document.getElementsByTagName("section");
    const nav = document.getElementsByTagName("nav")[0].children;
    console.log(nav);
    for (let i = 0; i < nav.length; i++) {
        const element = nav[i];
        console.log(element);
        if (i == 0) {
            element.dataset.tituloSeleccionado = "true";
            secciones[i].dataset.seleccionado = "true";
        } else {

            element.dataset.tituloSeleccionado = "false";
            secciones[i].dataset.seleccionado = "false";

        }
        element.addEventListener("click", () => {
            if (element.dataset.tituloSeleccionado == "false") {
                for (let j = 0; j < nav.length; j++) {
                    if (i == j) {
                        element.dataset.tituloSeleccionado = "true";
                        secciones[i].dataset.seleccionado = "true";
                    } else {

                        nav[j].dataset.tituloSeleccionado = "false";
                        secciones[j].dataset.seleccionado = "false";

                    }
                }




            }

        });
    }
</script>

</html>