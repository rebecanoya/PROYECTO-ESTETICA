<?php
include '../../src/iniciarPHP.php';
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
}
$productos = [];
$subtotal = 0;

// Cargar productos en la sesión si existen en el carrito
if (isset($_SESSION["Carrito"]) && count($_SESSION["Carrito"]) > 0) {
    $sql = "SELECT Nombre, Precio, ID FROM productos WHERE ID IN (" . implode(',', array_keys($_SESSION["Carrito"])) . ")";
    $productos = $BBDD->select($sql);
}

foreach ($productos as $producto) {
    $idProducto = $producto["ID"];
    $nombreProducto = $producto["Nombre"];
    $precioProducto = $producto["Precio"];
    $cantidadProducto = $_SESSION["Carrito"][$idProducto];
    $subtotalProducto = $precioProducto * $cantidadProducto;

}

// Verificar envío del formulario "Tramitar Pedido"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tramitarPedido']) && isset($_SESSION["Carrito"]) && !empty($_SESSION["Carrito"])) {
    echo "Procesando pedido...";

    // Insertar el pedido en la tabla `pedidos`
    $sql = "INSERT INTO pedidos (ID_Cliente, Precio) VALUES (:usuario, :precio)";
    $params = ["usuario" => $_SESSION["id"], "precio" => $subtotal];
    var_dump($subtotal);    
    // Ejecutar y verificar la inserción    
    if ($BBDD->execute($sql, $params)) {
        $pedidoId = $BBDD->lastId();
        echo "Pedido creado con ID: " . $pedidoId;

        // Insertar los detalles del pedido en `detalles_pedido`
        foreach ($_SESSION["Carrito"] as $id => $value) {
            $sql = "INSERT INTO detalles_pedido (IDPedido, IDProducto, Cantidad) VALUES (:pedidoId, :producto, :cantidad)";
            $params = ["cantidad" => $value, "pedidoId" => $pedidoId, "producto" => $id];
            $BBDD->execute($sql, $params);
        }

        // Limpieza del carrito y confirmación
        unset($_SESSION["Carrito"]);
        echo "<script>alert('Pedido tramitado correctamente');</script>";
    } else {
        echo "Error al procesar el pedido";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/cesta.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Cesta | Aromusicoterapia</title>
</head>
<body>

<?php include "../../src/templates/header.php"; ?>

<main>
    <form id="pedidoForm" action="" method="post">
        <div class="container">
            <div class="products">
                <h2>Productos</h2>
                <div class="product">
                    <div class="product-titles">
                        <span class="title">Foto</span>
                        <span class="title">Producto</span>
                        <span class="title">Precio</span>
                        <span class="title">Cantidad</span>
                        <span class="title">Subtotal</span>
                    </div>
                    <?php foreach ($productos as $producto): 
                        $idProducto = $producto["ID"];
                        $nombreProducto = $producto["Nombre"];
                        $precioProducto = $producto["Precio"];
                        $cantidadProducto = $_SESSION["Carrito"][$idProducto];
                        $subtotalProducto = $precioProducto * $cantidadProducto;
                        $subtotal += $subtotalProducto;
                    ?>
                        <div class="product-info">
                            <span class="product-img"><img src="../img/productos/<?php echo $idProducto ?>.png" width="100px" alt=""></span>
                            <span class="product-name"><?php echo $nombreProducto ?></span>
                            <span class="product-price"><?php echo $precioProducto ?>€</span>
                            <div class="form-container">
                                <div class="cantidad">
                                    <button type="button" class="menos" onclick="actualizarCarrito(event,-1,<?php echo $idProducto ?>,'reducir')">-</button>
                                    <input type="number" id="<?php echo $idProducto ?>" name="cantidad[<?php echo $idProducto ?>]" value="<?php echo $cantidadProducto ?>">
                                    <button type="button" class="mas" onclick="actualizarCarrito(event,1,<?php echo $idProducto ?>,'add')">+</button>
                                </div>
                            </div>
                            <span class="product-subtotal" id="precio<?php echo $idProducto ?>" data-precioBase="<?php echo $precioProducto ?>"><?php echo $subtotalProducto ?>€</span>
                            <i class="fa-solid fa-trash-can iconButton" onclick="eliminarProducto(<?php echo $idProducto ?>);"></i>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="summary">
                <div class="total">
                    <h2>Resumen de Compra</h2>
                    <p id="subtotal">Subtotal <?php echo $subtotal ?>€</p>
                    <p id="subtotalImpuestos">Total incluyendo impuestos <?php echo $subtotal ?>€</p>
                </div>
                <div class="opciones">
                    <!-- Botón específico para "Tramitar Pedido" -->
                    <button type="submit" name="tramitarPedido" class="button-tramitar-pedido">Tramitar Pedido</button>
                    <a href="../html/NuestrosProductos.php" class="volverCompra">Seguir Comprando</a>
                </div>
            </div>
        </div>
    </form>
</main>

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

<script src="../js/peticionCarrito.js"></script>
<script src="../js/botonesCantProd.js"></script>
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
    function actualizarCarrito(event, cantidad, id, accion) {

        if (actualizarCantidad(event, cantidad, id)) {

            peticionCarrito(id, Math.abs(cantidad), accion);
            actualizarPrecio(id);
            actualizarSubtotal();

        }



    }

    const subtotal = document.getElementById("subtotal");
    const subtotalImpuestos = document.getElementById("subtotalImpuestos");

    /**
     * Actualizar precio de producto
     *
     * @param   id    id del producto
     *
     */
    function actualizarPrecio(id) {

        let elementoPrecio = document.getElementById("precio" + id);
        let elementoCantidad = document.getElementById(id);
        elementoPrecio.innerHTML = (elementoPrecio.dataset.preciobase * elementoCantidad.value) + '€';
    }

    /**
     * Actualizar subtotal
     *
     */
    function actualizarSubtotal() {

        let elementoPrecioProductos = document.getElementsByClassName("total");
        let suma = 0;
        for (const elementoPrecioProducto of elementoPrecioProductos) {
            let innerHTML = elementoPrecioProducto.innerHTML;
            suma += parseInt(innerHTML.substring(0, innerHTML.length));

        }

        subtotal.innerHTML = `Subtotal ${suma}€`;
        subtotalImpuestos.innerHTML = `Subtotal ${suma}€`;

    }

    /**
     * Peticion para eliminar un producto
     *
     * @param   id        id del producto
     *
     */
    function eliminarProducto(id) {

        peticionCarrito(id, 0, 'eliminar');
        location.reload();

    }

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