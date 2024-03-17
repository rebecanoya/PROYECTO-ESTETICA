<article>

    <img src="../img/lineas/<?php echo $IDLinea ?>.png" class="banner">
    <div class="contenido">
        <div class="informacion">
            <h2>Linea <?php echo $nombreLinea ?></h2>
            <p><?php echo $descripcionLinea ?></p>
        </div>
        <div class="productos">

            <?php
            /**
             * Aqui hacemos una consulta de los productos, limitandolo a 5, de cada linea
             */
            $sql = "SELECT ID,Nombre,Descripcion,Precio from productos where ID_Linea=:id and Activo = 1 limit 5";
            $param = ["id" =>  $IDLinea];
            $productos = $BBDD->select($sql, $param);
            /**
             * Y con este bucle foreach recorremos el array $productos que obtenemos del return del metodo select
             * de la clase BBDD y usamos sus datos junto con el template de producto.php ara mostrar 5 productos
             * de cada linea en el index
             * @var [type]
             */
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