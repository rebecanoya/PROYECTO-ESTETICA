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
                        <div class="container">
                            <div class="form-container">
                                <label for="cantidad">Cantidad:</label>
                                <button class="masmenos" onclick="decrementar(event)">-</button>
                                <input type="number" id="cantidad" value="0" readonly>
                                <button class="masmenos" onclick="incrementar(event)">+</button>
                            </div>
                        </div>
                        <button type="submit"class="comprar">Añadir al carrito</button>
                        <button type="submit" class="muestra">Solicitar muestra</button>

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


<script>
    function incrementar(event) {
        event.preventDefault();
        var cantidadInput = document.getElementById('cantidad');
        var cantidad = parseInt(cantidadInput.value, 10);
        cantidadInput.value = cantidad + 1;
    }

    function decrementar(event) {
        event.preventDefault();
        var cantidadInput = document.getElementById('cantidad');
        var cantidad = parseInt(cantidadInput.value, 10);
        if (cantidad > 0) {
        cantidadInput.value = cantidad - 1;
        }
    }
</script>
