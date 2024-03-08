<?php

// include '../../src/BBDD.php';
// $BBDD = new BBDD();
// $sql = "SELECT * from roles where id_rol=:id";
// $param = ["id" =>  1];
// $resultado = $BBDD->select($sql, $param);
// var_dump($resultado);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Pagina inicial</title>
</head>

<body>

    <?php

    include "../../src/templates/header.php"

    ?>



    <main>
        <div class="containerBanner">
            <div class="linea">
                <h2>Descubre nuestra nueva</h2>
                <h1>LINEA REVITALIZANTE</h1>
                <button>¡DESCUBRELO!</button>
            </div>

            <img src="../img/banner.jpeg" class="banner">
        </div>
        <section class="bannerNegro">
            <p>hola</p>
        </section>
        <section class="lineas">
            <article>

                <img src="../img/banner.jpeg" class="banner">
                <div class="contenido">
                    <div class="informacion">
                        <h2>Linea Revitalizante</h2>
                        <p>Elaborada con precisión e infundida con los ingredientes revitalizantes más potentes de la naturaleza, esta gama de cuidado de la piel está diseñada para dar nueva vida a tu piel, revelando un cutis radiante y rejuvenecido.</p>
                    </div>
                    <div class="productos">
                        <div class="producto">

                            <img src="../img/lineaRevitalizante/aceite.png" alt="">
                            <p>Texto descripcion</p>
                            <div class="opciones">

                                <button class="compra" style="--colorFondo: pink;">Comprar</button>
                                <button class="muestra">Solicitar muestra</button>

                            </div>
                        </div>

                        <div class="producto">

                            <img src="../img/lineaRevitalizante/ambientador.png" alt="">
                            <p>Texto descripcion</p>
                            <div class="opciones">

                                <button class="compra">Comprar</button>
                                <button class="muestra">Solicitar muestra</button>

                            </div>
                        </div>

                        <div class="producto">

                            <img src="../img/lineaRevitalizante/colonia.png" alt="">
                            <p>Texto descripcion</p>
                            <div class="opciones">

                                <button class="compra">Comprar</button>
                                <button class="muestra">Solicitar muestra</button>

                            </div>
                        </div>

                        <div class="producto">

                            <img src="../img/lineaRevitalizante/exfoliante.png" alt="">
                            <p>Texto descripcion</p>
                            <div class="opciones">

                                <button class="compra">Comprar</button>
                                <button class="muestra">Solicitar muestra</button>

                            </div>
                        </div>

                        <div class="producto">

                            <img src="../img/lineaRevitalizante/sales.png" alt="">
                            <p>Texto descripcion</p>
                            <div class="opciones">

                                <button class="compra">Comprar</button>
                                <button class="muestra">Solicitar muestra</button>

                            </div>
                        </div>
                    </div>
                </div>

            </article>
            <article></article>
        </section>
    </main>


    <?php

    include "../../src/templates/footer.php"

    ?>
</body>

</html>