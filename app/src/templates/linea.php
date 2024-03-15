<article>

    <img src="../img/lineas/<?php echo $IDLinea ?>.png" class="banner">
    <div class="contenido">
        <div class="informacion">
            <h2>Linea <?php echo $nombreLinea ?></h2>
            <p><?php echo $descripcionLinea ?></p>
        </div>
        <div class="productos">

            <?php

            $sql = "SELECT ID,Nombre,Descripcion,Precio from productos where ID_Linea=:id and Activo = 1 limit 5";
            $param = ["id" =>  $IDLinea];
            $productos = $BBDD->select($sql, $param);
            foreach ($productos as $producto) {

                $IDProducto = $producto["ID"];
                $nombreProducto = $producto["Nombre"];
                $descripcionProducto = $producto["Descripcion"];
                $precioProducto = $producto["Precio"];
                include("../../src/templates/producto.php");
            }

            ?>


        </div>
    </div>

</article>