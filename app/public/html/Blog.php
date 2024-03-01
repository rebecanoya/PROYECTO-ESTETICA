<?php

include '../../src/BBDD.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/blog.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Blog</title>
</head>

<body>

    <?php

    include "../../src/templates/header.php"

    ?>



    <main>
        <article style="--fondoEntrada: rgba(78, 87, 77, 0.15);" class="entradaBlog" id="#entradaBlog">
            <section>
                <?php
                    $BBDD = new BBDD();
                    $sql = "SELECT titulo from blog order by fecha desc limit 1";
                    // $param = ["titulo" =>  1];
                    $resultado = $BBDD->select($sql);
                    $resultado = $resultado[0];
                    $titulo = $resultado["titulo"];
                    echo "<div>". $titulo ."</div>";
                ?>
                <div class="entradaCompleta">
                    <img src="../img/imagenEjemploBlog.jpg">
                    <?php
                    $BBDD = new BBDD();
                    $sql = "SELECT entrada from blog order by fecha desc limit 1";
                    // $param = ["titulo" =>  1];
                    $resultado = $BBDD->select($sql);
                    $resultado = $resultado[0];
                    $entrada = $resultado["entrada"];
                    echo "<div class=entrada>". $entrada ."</div>";
                    ?>
                </div>
            </section>
        </article>
    </main>


    <aside id="menuLateral">
        <input type="text" placeholder="Buscar...">
        <?php
            $BBDD = new BBDD();
            $sql = "SELECT titulo from blog order by fecha asc";
            // $param = ["titulo" =>  "Primera Entrada"];
            $resultado = $BBDD->select($sql);
            for ($i=0; $i < count($resultado); $i++) { 
                $fila = $resultado[$i];
                echo "<div class=enlace-entrada>". $fila["titulo"] . "</div>";
            }
        ?>
    </aside>


    <?php

    include "../../src/templates/footer.php"

    ?>
</body>

</html>