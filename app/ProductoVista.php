<?php

/**
 * Crea la vista para mostrar un producto
 */
include 'src/iniciarPHP.php';
$pedirBBDD = false;
$cargar = false;
$producto;
// Comprobamos que se envio un id y sea un numero
if (isset($_GET) && isset($_GET["id"])) {
    $id = $_GET["id"];
    if (is_numeric($id)) {
        $pedirBBDD = true;
    }
}

// Obtener datos del producto
if ($pedirBBDD) {
    $sql = "SELECT * from productos where id = :id and Activo=1";
    $param = ["id" =>  $id];
    $producto = $BBDD->select($sql, $param);

    if ($producto) {
        $cargar = true;
        $producto = $producto[0];
        $sql = "SELECT Color from lineas where id = :id and Activo=1";
        $param = ["id" =>  $producto["ID_Linea"]];
        $color = $BBDD->select($sql, $param)[0]["Color"];
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
    <link rel="stylesheet" href="css/producto.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title><?php
            if ($cargar) {
                echo $producto["Nombre"];
            } else {
                echo "No se encontró";
            }
            ?> | Aromusicoterapia</title>
</head>

<body>
    <?php include "src/templates/header.php"; ?>
    <main>
        <?php if ($cargar) { ?>
            <div class="main-container">
                <div class="container-main">
                    <div class="product-image">
                        <img src="img/productos/<?php echo $producto["ID"] ?>.png" alt="Producto">
                    </div>
                    <div class="product-details">
                        <div class="product-text">
                            <h2><?php echo $producto["Nombre"] ?></h2>
                            <p class="descripcion"><?php echo $producto["Descripcion"] ?></p>
                            <p class="precio"><?php echo $producto["Precio"] ?>€ / Unidad</p>
                        </div>
                        <div class="product-buttons">
                            <div class="container">
                                <div class="form-container">
                                    <div class="cantidad">
                                        <button class="menos" onclick="actualizarCantidad(event,-1,<?php echo $id ?>)">-</button>
                                        <input type="number" id="<?php echo $id ?>" name="cantidad" value="1">
                                        <button class="mas" onclick="actualizarCantidad(event,1,<?php echo $id ?>)">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="botonesProd">
                                <button type="submit" style="background-color:<?php echo "#" . $color; ?>" class="comprar" id="comprar">Añadir al carrito</button>
                                <button type="submit" class="muestra" id="muestra">Solicitar muestra</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else { ?> No se encontró. <?php } ?>

    </main>

    <?php

    include "src/templates/footer.php";

    ?>
</body>

</html>



<script src="js/peticionCarrito.js"></script>
<script src="js/botonesCantProd.js"></script>

<script>
    const cantidad = document.getElementById('<?php echo $id ?>');
    /**
     * Creacion evento para el boton de compra
     */
    document.getElementById("comprar").addEventListener("click", () => {
        if (!isNaN(cantidad.value) && cantidad.value > 0) {
            peticionCarrito(<?php echo $id; ?>, cantidad.value, "add");
        }


    });
    /**
     * Creacion evento para el boton de muestra
     */
    document.getElementById("muestra").addEventListener("click", () => {
        peticionCarrito(<?php echo $id; ?>, 1, "muestra");



    });
</script>