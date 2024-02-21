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

        <article class="lineas">
            <section data-seleccionado="false" style="--fondoLineas: rgba(255, 0, 0, 0.150);">
                <button href="#desplegableLineas">

                    <h2>Linea Revitalizante</h2>
                    <img src="../img/geranio.png">
                </button>



            </section>
            <section data-seleccionado="false" style="--fondoLineas: rgba(13, 255, 0, 0.15);">
                <button href="#desplegableLineas">

                    <h2>Arbol de Te</h2>
                    <img src="../img/arboldete.png">

                </button>

            </section>
            <!-- <section data-seleccionado="false" style="--fondoLineas: rgba(255, 217, 0, 0.15);">
                <button href="#desplegableLineas">

                    <h2>Linea 3</h2>
                    <img src="../img/calendula.png">

                </button>

            </section>
            <section data-seleccionado="false" style="--fondoLineas: rgba(0, 26, 255, 0.15);">

                <button href="#desplegableLineas">

                    <h2>Linea 4</h2>
                    <img src="../img/juniper.png">

                </button>

            </section>
            <section data-seleccionado="false" style="--fondoLineas: rgba(204, 0, 255, 0.15);">
                <button href="#desplegableLineas">

                    <h2>Linea 5</h2>
                    <img src="../img/lavanda.png">

                </button>


            </section> -->
        </article>

        <!-- <article style="--fondoLineas: rgba(13, 255, 0, 0.15);" class="desplegadoLineas" id="#desplegableLineas">
            <section>
                <h1>LINEA ARBOL DE TE</h1>
                <div class="cuadroCompleto">
                    <div class="productos">

                        <img src="../img/calendula.png" alt="">

                    </div>
                    <div class="descripcion">El aceite esencial de Árbol del Té, conocido por su nombre en inglés tea
                        tree proviene de
                        Australia. Este aceite esencial se empezó a conocer a ﬁnales de 1700. Un oﬁcial de la marina
                        británica, James Cook, se interesó al llegar a Australia por cómo los aborígenes elaboraban toda
                        una serie de remedios con las hojas de este árbol. Con ella paliaban infecciones y trataban
                        numerosas enfermedades cutáneas. No fue hasta el siglo XX cuando se empezaron a... Más
                        información</div>
                </div>
            </section>
        </article> -->

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