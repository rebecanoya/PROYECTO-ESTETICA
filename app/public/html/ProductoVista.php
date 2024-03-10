<?php

include '../../src/BBDD.php';
$BBDD = new BBDD();
$pedirBBDD = false;
$cargar = false;
$producto;


if (isset($_GET) && isset($_GET["id"])) {
    $id = $_GET["id"];
    if (is_numeric($id)) {
        $pedirBBDD = true;
    }
}

if ($pedirBBDD) {
    $sql = "SELECT * from productos where id = :id";
    $param = ["id" =>  $id];
    $producto = $BBDD->select($sql, $param);

    if ($producto) {
        $cargar = true;
        $producto = $producto[0];
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
    <link rel="stylesheet" href="../css/producto.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php

    include "../../src/templates/header.php";
    if ($cargar) {



    ?>

        <div class="container">
            <div class="product-grid">
                <div class="product-image">
                    <img src="../img/productos/<?php echo $producto["ID"] ?>.png" alt="Producto">
                </div>
                <div class="product-details">
                    <h2><?php echo $producto["Nombre"] ?></h2>
                    <p><?php echo $producto["Descripcion"] ?></p>
                    <form>
                        <label for="quantity">Cantidad:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1">
                        <button type="submit">Añadir al carrito</button>
                        <button type="submit">Solicitar muestra</button>

                    </form>
                </div>
            </div>
        </div>

    <?php
    } else {





    ?>
        <div>No se encontró</div>
    <?php
    }
    ?>




</body>

</html>