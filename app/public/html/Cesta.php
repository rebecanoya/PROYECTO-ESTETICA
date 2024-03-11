<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/cesta.css">

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
                <div class="product">
                    <div class="product-titles">
                        <span class="title">Producto</span>
                        <span class="title">Precio</span>
                        <span class="title">Cantidad</span>
                        <span class="title">Subtotal</span>
                    </div>
                    <div class="product-info">
                        <span class="product-name">Producto 1</span>
                        <span class="product-price">$10</span>
                        <span class="product-quantity">1</span>
                        <span class="product-subtotal">$10</span>
                    </div>
                    <div class="product-actions">
                        <button class="remove-btn">Eliminar</button>
                    </div>
                </div>
                <!-- More products can be added here -->
            </div>
            <div class="summary">
                <h2>Resumen de Compra</h2>
                <div class="total">
                    Total: $45
                </div>
                <button class="checkout-btn">Comprar</button>
                <button class="continue-shopping-btn">Seguir Comprando</button>
            </div>
        </div>


    </main>

</body>

</html>