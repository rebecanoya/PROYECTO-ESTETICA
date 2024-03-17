<?php
include '../../src/iniciarPHP.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/np.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Nuestros Productos | Aromusicoterapia</title>
</head>

<body>

    <?php

    include "../../src/templates/header.php"

    ?>



    <main>

        <h2>Lineas</h2>

        <article class="lineas">


            <?php

            $sql = "SELECT * from lineas Where Activo = 1";
            $lineas = $BBDD->select($sql);
            foreach ($lineas as $linea) {

                $nombreLinea = $linea["Nombre"];
                $colorLinea = $linea["Color"];
                $IDLinea = $linea["ID"];
                $descripcionLinea = $linea["Descripcion"];

            ?>

                <button class="botonLinea" data-seleccionado="false" data-idLinea="<?php echo $IDLinea ?>" style="background: url(../img/lineas/<?php echo $IDLinea ?>.png);">

                    <h2>Linea <?php echo $nombreLinea ?></h2>
                    <img src="../img/lote/<?php echo $IDLinea ?>.png" alt="">




                </button>
            <?php



            }

            ?>

        </article>



        <h2>Todos los productos</h2>


        <article class="productos">


            <?php
            $sql = "SELECT ID,Nombre,Descripcion,Precio,ID_Linea,(select Color from lineas as l where l.ID=ID_Linea) as Color from productos where Activo = 1 order by Nombre";
            $productos = $BBDD->select($sql);

            foreach ($productos as $producto) {
                $colorLinea = $producto["Color"];
                $IDProducto = $producto["ID"];
                $nombreProducto = $producto["Nombre"];
                $descripcionProducto = $producto["Descripcion"];
                $precioProducto = $producto["Precio"];
                $IDLinea = $producto["ID_Linea"];
                include("../../src/templates/producto.php");
            }
            ?>





        </article>

    </main>

    <?php
    include "../../src/templates/footer.php"
    ?>

</body>

<script src="../js/enlaceProductos.js"> </script>


<script>
    const lineas = document.getElementsByClassName("botonLinea");

    for (const linea of lineas) {

        linea.addEventListener("click", () => {

            if (linea.dataset.seleccionado == "true") {

                linea.dataset.seleccionado = false;
                for (const producto of productos) {

                    producto.dataset.activo = true;

                }
            } else {

                for (const linea2 of lineas) {
                    linea2.dataset.seleccionado = false;

                }
                linea.dataset.seleccionado = true;

                for (const producto of productos) {

                    producto.dataset.activo = false;

                    if (producto.dataset.idlinea == linea.dataset.idlinea) {

                        producto.dataset.activo = true;


                    } else {

                        producto.dataset.activo = false;

                    }
                }

            }



        });

    }
</script>



</html>