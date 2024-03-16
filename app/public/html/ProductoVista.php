<?php

include '../../src/iniciarPHP.php';
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
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title><?php echo $producto["Nombre"] ?> | Aromusicoterapia</title>
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
                    <p class="descripcion"><?php echo $producto["Descripcion"] ?></p>
                    <form method="post" action="controladorCesta.php">
                        <div class="container">
                            <div class="form-container">
                                <div class="cantidadNumber">
                                    <button class="menos" onclick="decrementar(event)">-</button>
                                    <input type="number" id="cantidad" name="cantidad" value="1">
                                    <button class="mas" onclick="incrementar(event)">+</button>
                                </div>
                                <div class="comprarBtn">
                                    <button type="submit" class="comprar">Añadir al carrito</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="comprar" name="accion" value="add">Añadir al carrito</button>
                        <button type="submit" class="muestra" name="accion" value="muestra">Solicitar muestra</button>
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
        if (cantidad > 1) {
            cantidadInput.value = cantidad - 1;
        }
    }
</script>