<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/producto.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php

    include "../../src/templates/header.php"

    ?>

    <div class="container">
        <div class="product-grid">
            <div class="product-image">
                <img src="../img/productos/1.png" alt="Producto">
            </div>
            <div class="product-details">
                <h2>Nombre del Producto</h2>
                <p>Descripción del producto...</p>
                <form>
                    <label for="quantity">Cantidad:</label>
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                    <button type="submit">Añadir al carrito</button>
                    <button type="submit">Solicitar muestra</button>

                </form>
            </div>
        </div>
    </div>




</body>

</html>