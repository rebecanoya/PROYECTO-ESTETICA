<?php
include 'src/iniciarPHP.php';
// include 'correo_modelo.php';

// $correo = new Correo_modelo();

$allAvaliable = true;
$errorMsg;

$IVA = 1.21;

/**
 * Sincronizacion del carrito sesion con el carrito de la base de datos
 *
 */
if ($sesion->estaLoggeado()) {
    $sql = "SELECT IDProducto,Cantidad from carrito where IDUsuario=:id and Cantidad>0";
    $params = ["id" => $_SESSION["id"]];
    $productosBBDD = $BBDD->select($sql, $params);
    foreach ($productosBBDD as $key => $value) {

        $IDProductosBBDD[$value["IDProducto"]] = $value["Cantidad"];
    }

    foreach ($_SESSION["Carrito"] as $id => $value) {

        if (!isset($IDProductosBBDD[$id])) {

            $sql = "INSERT into carrito (IDUsuario, IDProducto, Cantidad) values (:id, :producto, :cantidad)";
            $params = ["cantidad" => $value, "id" => $_SESSION["id"], "producto" => $id];
            $BBDD->execute($sql, $params);
        } elseif ($IDProductosBBDD[$id] == 0) {

            $sql = "UPDATE carrito set Cantidad=:cantidad where IDUsuario=:id and IDProducto=:producto";
            $params = ["cantidad" => $value, "id" => $_SESSION["id"], "producto" => $id];
            $BBDD->execute($sql, $params);
        }
    }
} else {
    $errorMsg = "Es necesario iniciar la sesion.";
}
$productos = [];
$subtotal = 0;


// Cargar productos en la sesión si existen en el carrito
if (isset($_SESSION["Carrito"]) && count($_SESSION["Carrito"]) > 0) {
    $sql = "SELECT Nombre, Precio, ID, Stock FROM productos WHERE ID IN (" . implode(',', array_keys($_SESSION["Carrito"])) . ")";
    $productos = $BBDD->select($sql);

    foreach ($productos as $producto) {

        $idProducto = $producto["ID"];
        $stock = $producto["Stock"];
        $cantidadProducto = $_SESSION["Carrito"][$idProducto];

        if ($stock == 0 || $stock < $cantidadProducto) {
            $allAvaliable = false;
            $errorMsg = "Hay un error en la cesta.";
        }
    }
}

// Verificar envío del formulario "Tramitar Pedido"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tramitarPedido']) && isset($_SESSION["Carrito"]) && !empty($_SESSION["Carrito"])) {
    if (!$sesion->estaLoggeado()) {
        header("Location: login.php");
        exit(); // Termina la ejecución después de la redirección
    }

    // Insertar el pedido en la tabla `pedidos`

    $subtotal = isset($_POST['subtotal']) ? floatval($_POST['subtotal']) : 0.0;
    $sql = "INSERT INTO pedidos (ID_Cliente, Precio) VALUES (:usuario, :precio)";

    $params = ["usuario" => $_SESSION["id"], "precio" => $subtotal];

    $BBDD->pdo->beginTransaction();

    $carrito = $_SESSION["Carrito"];

    try {
        // Ejecutar y verificar la inserción    
        if ($BBDD->execute($sql, $params)) {
            $pedidoId = $BBDD->lastId();
            // Insertar los detalles del pedido en `detalles_pedido`
            foreach ($_SESSION["Carrito"] as $id => $value) {
                $sql = "SELECT stock from productos where id = :id";
                $params = ["id" => $id];
                $stock = $BBDD->select($sql, $params)[0]["stock"];

                if ($stock === 0 || $stock < $value) {
                    throw new Exception("No hay stock disponible");
                }

                $sql = "UPDATE productos set stock = stock - :cantidad where id = :id";
                $params = ["id" => $id, "cantidad" => $value];
                $BBDD->execute($sql, $params);


                $sql = "INSERT INTO detalles_pedido (IDPedido, IDProducto, Cantidad) VALUES (:pedidoId, :producto, :cantidad)";
                $params = ["cantidad" => $value, "pedidoId" => $pedidoId, "producto" => $id];
                $BBDD->execute($sql, $params);

                // $correo->enviar_correo($email, "Registro AroMusicoTerapia", "Gracias por registrarte en Aromusicoterapia");

                unset($carrito[$id]); // Limpieza del carrito
            }

            $BBDD->pdo->commit();

            $_SESSION["Carrito"] = $carrito;

            header("Location: NuestrosProductos.php"); // Redirección
            exit(); // Termina la ejecución después de la redirección
        } else {
            $BBDD->pdo->rollBack();
            echo "Error al procesar el pedido";
        }
    } catch (\Throwable $th) {
        $BBDD->pdo->rollBack();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cesta.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>Cesta | Aromusicoterapia</title>
</head>

<body>

    <?php include "src/templates/header.php"; ?>

    <main>
        <form id="pedidoForm" action="" method="post">
            <div class="container">
                <div class="products">
                    <h2>Productos</h2>
                    <div class="product">
                        <div class="product-titles"
                            <?php if (!$allAvaliable) {
                                echo 'style = "--columns: 7;"';
                            } ?>>
                            <span class="title">Foto</span>
                            <span class="title">Producto</span>
                            <span class="title">Precio</span>
                            <span class="title">Cantidad</span>
                            <span class="title">Subtotal</span>
                            <span class="title"></span>
                            <?php
                            if (!$allAvaliable) {
                            ?>
                                <span class="title"></span>
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        $subtotal = 0;
                        foreach ($productos as $producto) {
                            $idProducto = $producto["ID"];
                            $nombreProducto = $producto["Nombre"];
                            $precioProducto = $producto["Precio"];
                            $stock = $producto["Stock"];
                            $cantidadProducto = $_SESSION["Carrito"][$idProducto];
                            $subtotalProducto = $precioProducto * $cantidadProducto;
                            if ($stock > 0) {
                                $subtotal += $subtotalProducto;
                            } else {
                                $cantidadProducto = 0;
                                $subtotalProducto = 0;
                            }

                        ?>
                            <div class="product-info"
                                <?php if (!$allAvaliable) {
                                    echo 'style = "--columns: 7;"';
                                } ?>>
                                <span class="product-img"><img src="img/productos/<?php echo $idProducto ?>.png" width="100px" alt=""></span>
                                <span class="product-name"><?php echo $nombreProducto ?></span>
                                <span class="product-price"><?php echo $precioProducto ?>€</span>
                                <div class="form-container">
                                    <?php
                                    if ($stock > 0) {
                                    ?>
                                        <div class="cantidad">
                                            <button type="button" class="menos" onclick="actualizarCarrito(event,-1,<?php echo $idProducto ?>,'reducir',true)">-</button>
                                            <input type="number" id="<?php echo $idProducto ?>" name="cantidad[<?php echo $idProducto ?>]" value="<?php echo $cantidadProducto ?>">
                                            <button type="button" class="mas" onclick="actualizarCarrito(event,1,<?php echo $idProducto ?>,'add',true)">+</button>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <span class="product-subtotal" id="precio<?php echo $idProducto ?>" data-precioBase="<?php echo $precioProducto ?>"><?php echo number_format($subtotalProducto, 2) ?>€</span>
                                <i class="fa-solid fa-trash-can iconButton" onclick="eliminarProducto(<?php echo $idProducto ?>);"></i>
                                <?php
                                if ($stock == 0) {
                                ?>
                                    Sin stock
                                <?php
                                } elseif ($stock < $cantidadProducto) {

                                ?>
                                    No hay suficiente stock.
                                <?php
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="summary">
                    <h2>Resumen de Compra</h2>
                    <div class="total">
                        <input type="hidden" name="subtotal" id="subtotalInput" value="<?php echo number_format($subtotal, 2); ?>">
                        <p id="subtotal">Subtotal <?php echo number_format($subtotal, 2); ?>€</p>
                        <p id="subtotalImpuestos">Total incluyendo impuestos <?php echo number_format($subtotal * $IVA, 2)  ?>€</p>
                    </div>
                    <div class="opciones">
                        <?php
                        if ($allAvaliable && !isset($errorMsg)) {
                        ?>
                            <button type="submit" name="tramitarPedido" class="button-tramitar-pedido">Tramitar Pedido</button>
                        <?php
                        } else {
                            echo $errorMsg;
                        }
                        ?>
                        <a href="NuestrosProductos.php" class="volverCompra">Seguir Comprando</a>
                    </div>
                </div>
            </div>
        </form>
    </main>+

</body>

</html>




<script>
    // Mostrar el div al hacer clic en "Realizar pedido"
    document.getElementById('pedidoBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Evitar el envío del formulario
        document.querySelector('.datospedido').style.display = 'block'; // Mostrar los datos del pedido
    });
</script>


</body>

<script src="js/peticionCarrito.js"></script>
<script src="js/botonesCantProd.js"></script>
<script>
    document.getElementById('pedidoBtn').addEventListener('click', function() {
        document.querySelector('.datospedido').style.display = 'block';
    });
    /**
     * Funcion general para actualizar el carrito
     *
     * @param   {object}    event       objeto evento
     * @param   {int}       cantidad    cantidad a incrementar
     * @param   {int}       id          id del producto
     * @param   {string}    accion      accion a realizar
     *
     */
    async function actualizarCarrito(event, cantidad, id, accion, reload = false) {
        var response = await peticionCarrito(id, Math.abs(cantidad), accion);

        if (!response[0]) {
            return;
        }

        if (actualizarCantidad(event, response[1], id)) {
            actualizarPrecio(id);
            actualizarSubtotal();
        }

        if (reload) {
            location.reload();
        }
    }

    function actualizarPrecio(id) {
        let elementoPrecio = document.getElementById("precio" + id);
        let elementoCantidad = document.getElementById(id);
        let precioBase = parseFloat(elementoPrecio.dataset.preciobase);
        elementoPrecio.innerHTML = (precioBase * elementoCantidad.value).toFixed(2) + '€';
    }

    function actualizarSubtotal() {
        let elementosPreciosProductos = document.getElementsByClassName("product-subtotal");
        let suma = 0;
        for (const elementoPrecioProducto of elementosPreciosProductos) {
            let precioTexto = elementoPrecioProducto.innerHTML.replace('€', '').trim();
            suma += parseFloat(precioTexto);
        }

        subtotal.innerHTML = `Subtotal ${suma.toFixed(2)}€`;
        subtotalImpuestos.innerHTML = `Total incluyendo impuestos ${(suma * <?php echo $IVA ?>).toFixed(2)}€`; // 21% de IVA
        document.getElementById('subtotalInput').value = suma.toFixed(2); // Actualiza el campo oculto
    }

    /**
     * Peticion para eliminar un producto
     *
     * @param   id        id del producto
     *
     */
    async function eliminarProducto(id) {
        await peticionCarrito(id, 0, 'eliminar');
        location.reload();
    }

    document.getElementsByClassName("product-subtotal").forEach(precio => {

    });

    document.getElementById("pedidoBtn").addEventListener("click", function() {
        // Crear una instancia del objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar la solicitud
        xhr.open("POST", "Cesta.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Definir lo que hacer en caso de éxito
        xhr.onload = function() {
            if (xhr.status === 200) {
                // La acción ha sido realizada, hacer algo con la respuesta si es necesario
                console.log(xhr.responseText);
            }
        };

        // Enviar la solicitud
        xhr.send("accion=realizar_accion");
    });
</script>
</script>

</html>