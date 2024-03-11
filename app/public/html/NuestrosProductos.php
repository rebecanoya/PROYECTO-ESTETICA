<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/np.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Pagina inicial</title>
</head>

<body>

    <?php

    include "../../src/templates/header.php"

    ?>



    <main>

        <h2>Lineas</h2>

        <article class="lineas">
            <section data-seleccionado="false">
                <img src="../img/lineas/1.png" alt="">
                <button href="#desplegableLineas">

                    <h2>Linea Revitalizante</h2>
                </button>



            </section>
            <section data-seleccionado="false" style="--fondoLineas: rgba(13, 255, 0, 0.15);">
                <button href="#desplegableLineas">

                    <h2>Linea Relajante</h2>
                    <img src="../img/arboldete.png">

                </button>

            </section>

        </article>

        <h2>Todos los productos</h2>


        <article class="productos">



            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>

            </div>
            <div class="producto">

                <img src="../img/calendula.png" alt="">
                <p>Texto descripcion</p>
                <div class="opciones">

                    <button class="compra">Comprar</button>
                    <button class="muestra">Solicitar muestra</button>

                </div>


            </div>
        </article>

    </main>

    <?php

    include "../../src/templates/footer.php"

    ?>
</body>

</html>