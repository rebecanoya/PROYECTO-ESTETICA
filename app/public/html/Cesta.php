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
if (count($_SESSION["Carrito"])) {
    
    $sql = "SELECT Nombre,Precio,ID from productos where ID in (" . implode(',', array_keys($_SESSION["Carrito"])) . ")";
    $productos = $BBDD->select($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["Carrito"])) {
        echo "<h2>GHola";
        $sql = "INSERT INTO pedidos (IDCliente, Precio, DNI_Cliente) values (:usuario, :precio, :dni)";
        $params = ["usuario" => $_SESSION["id"], "precio" => $subtotal, "dni" => $_POST["DNI"]];
        $BBDD->execute($sql, $params);

        $pedidoId = $BBDD->lastId();

        foreach ($_SESSION["Carrito"] as $id => $value) {
                $sql = "INSERT INTO detalles_pedido (IDPedido, IDProducto, Cantidad) values (:pedidoId, :producto, :cantidad)";
                $params = ["cantidad" => $value, "pedidoId" => $pedidoId, "producto" => $id];
                $BBDD->execute($sql, $params);
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
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Cesta | Aromusicoterapia</title>
    <style>
        .datospedido {
            display: none;
        }
    </style>
</head>

<body>

    <?php
    include "../../src/templates/header.php";

    ?>


    <main>
    <form action="" method="post">
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
                        <?php
                        $subtotal = 0;
                        foreach ($productos as $producto) {

                            $idProducto = $producto["ID"];
                            $nombreProducto = $producto["Nombre"];
                            $precioProducto = $producto["Precio"];
                            $cantidadProducto = $_SESSION["Carrito"][$idProducto];
                            $subtotalProducto = $precioProducto * $cantidadProducto;
                            $subtotal += $subtotalProducto;

                        ?>

                            <div class="product-info">
                                <span class="product-img">
                                    <img src="../img/productos/<?php echo $idProducto ?>.png" width="100px" alt="">
                                </span>
                                <span class="product-name"><?php echo $nombreProducto ?></span>
                                <span class="product-price"><?php echo $precioProducto ?>€</span>
                                <div class="form-container">
                                    <div class="cantidad">
                                        <button class="menos" onclick="actualizarCarrito(event,-1,<?php echo $idProducto ?>,'reducir')">-</button>
                                        <input type="number" id="<?php echo $idProducto ?>" name="cantidad" value="<?php echo $cantidadProducto ?>">
                                        <button class="mas" onclick="actualizarCarrito(event,1,<?php echo $idProducto ?>,'add')">+</button>
                                    </div>
                                </div>
                                <span class="product-subtotal" id="precio<?php echo $idProducto ?>" data-precioBase="<?php echo $precioProducto ?>"><?php echo $subtotalProducto ?>€</span>
                                <i class="fa-solid fa-trash-can iconButton" onclick=" eliminarProducto(<?php echo $idProducto ?>); "></i>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="summary">
    <div class="total">
        <h2>Resumen de Compra</h2>
        <p id="subtotal">Subtotal <?php echo $subtotal ?>€</p>
        <p id="subtotalImpuestos">Total incluyendo impuestos <?php echo $subtotal ?>€</p>
    </div>

    <div class="opciones">
        <!-- Se evita el comportamiento por defecto de submit con type="button" -->
        <button id="pedidoBtn" class="checkout-btn" type="button">Realizar pedido</button>
        <a href="../html/NuestrosProductos.php" class="volverCompra">Seguir Comprando</a>
    </div>
</div>

<!-- Formulario para los datos del pedido -->
<div class="datospedido">
    <h2>Introduzca sus datos para completar el pedido</h2>
    <form id="datosPedidoForm" action="" method="post">
        <div class="grupo-form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Apellido" required>
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" class="form-control" placeholder="DNI" required>
        </div>
        <!-- El botón de tramitar sí envía el formulario POST al servidor -->
        <button type="submit" name="register" class="register">Tramitar pedido</button>
    </form>
</div>

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

        let elementoPrecioProductos = document.getElementsByClassName("product-subtotal");
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