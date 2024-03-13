<?php
include '../../src/iniciarPHP.php';
$sesion->login('rebeca@teis.com', 'admin');
// var_dump($_SESSION);

$sql = "SELECT Nombre,Precio,ID from productos where ID in (" . implode(',', array_keys($_SESSION["Carrito"])) . ")";
// var_dump($sql);

$productos = $BBDD->select($sql);


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


    <title>Document</title>
</head>

<body>

    <?php
    include "../../src/templates/header.php";

    ?>


    <main>

        <div class="container">
            <div class="products">
                <h2>Productos</h2>
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
                    <div class="product">
                        <div class="product-titles">
                            <span class="title">Foto</span>
                            <span class="title">Producto</span>
                            <span class="title">Precio</span>
                            <span class="title">Cantidad</span>
                            <span class="title">Subtotal</span>
                        </div>
                        <div class="product-info">
                            <span class="product-img">
                                <img src="../img/productos/<?php echo $idProducto ?>.png" width="100px" alt="">
                            </span>
                            <span class="product-name"><?php echo $nombreProducto ?></span>
                            <span class="product-price"><?php echo $precioProducto ?>€</span>
                            <span class="product-quantity"><?php echo $cantidadProducto ?></span>
                            <span class="product-subtotal"><?php echo $subtotalProducto ?>€</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="summary">
                <h2>Resumen de Compra</h2>
                <div class="total">
                    <p>Subtotal <?php echo $subtotal ?> €</p>
                    <p>Total incluyendo impuestos <?php echo $subtotal ?> €</p>

                </div>
                <div class="opciones">
                    <button class="checkout-btn">Realizar pedido</button>
                    <a href="./index.php" class="volverCompra">Seguir Comprando</a>
                </div>
            </div>
        </div>


    </main>

</body>

</html>