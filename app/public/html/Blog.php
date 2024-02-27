<?php

// include '../../src/BBDD.php';
// $BBDD = new BBDD();
// $sql = "SELECT titulo from blog order by fecha desc";
// $param = ["titulo" =>  1];
// $resultado = $BBDD->select($sql, $param);
// var_dump($resultado);
// no funciona

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

                ?>
                <h1>Titulo Entrada</h1>
                <div class="entradaCompleta">
                    <img src="../img/imagenEjemploBlog.jpg">
                    <?php
                        
                    ?>
                    <div class="entrada">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quos alias sequi harum voluptates similique impedit tempore, voluptatem mollitia explicabo,
                        rerum autem ea officiis consequuntur ratione. Accusamus tempora explicabo architecto vitae.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quos alias sequi harum voluptates similique impedit tempore, voluptatem mollitia explicabo,
                        rerum autem ea officiis consequuntur ratione. Accusamus tempora explicabo architecto vitae.
                    </div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Quos alias sequi harum voluptates similique impedit tempore, voluptatem mollitia explicabo,
                    rerum autem ea officiis consequuntur ratione. Accusamus tempora explicabo architecto vitae.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Quos alias sequi harum voluptates similique impedit tempore, voluptatem mollitia explicabo,
                    rerum autem ea officiis consequuntur ratione. Accusamus tempora explicabo architecto vitae.
                </div>
            </section>
        </article>
    </main>


    <aside id="menuLateral">
        <input type="text" placeholder="Buscar...">
        <div class="enlace-entrada">Entrada 1</div>
        <div class="enlace-entrada">Entrada 2</div>
        <!-- Puedes agregar más enlaces según sea necesario -->
    </aside>


    <?php

    include "../../src/templates/footer.php"

    ?>
</body>

</html>