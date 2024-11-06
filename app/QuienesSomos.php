<?php

include 'src/iniciarPHP.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/quienessomos.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Contacto | Aromusicoterapia</title>
</head>

<body>
    <?php

    include "src/templates/header.php"

    ?>

    <main>


        <article class="info">
            <section class="descripcion">
                <div class="quienes">
                    <h2>QUIENES SOMOS?</h2>
                    <p class="quien">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium.
                        Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis,
                        est quam labore numquam, quasi laudantium.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium.
                        Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis,
                        est quam labore numquam, quasi laudantium.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium.
                        Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis,
                        est quam labore numquam, quasi laudantium.
                    </p>
                </div>
                <div class="imagenes">
                    <img class="img" src="img/imagenEjemploBlog.jpg" alt="img1">
                </div>
            </section>
            <section class="datos">
                <div class="container">
                    <div class="button-container">
                        <button class="button" onclick="cambiarTexto(Mision)">Mision</button>
                        <button class="button" onclick="cambiarTexto(Vision)">Vision</button>
                        <button class="button" onclick="cambiarTexto(Valores)">Valores</button>
                    </div>
                    <div id="textoCambiante" class="text-container">
                        Texto ejemplo Inicial
                    </div>
                </div>
            </section>
        </article>
    </main>

    <?php

    include "src/templates/footer.php"

    ?>

</body>

</html>

<script>
    const Mision = "Texto de ejemplo mision";
    const Vision = "Texto de ejemplo vision";
    const Valores = "Texto de ejemplo valores";


    function cambiarTexto(nuevoTexto) {
        document.getElementById("textoCambiante").innerText = nuevoTexto;
    }
</script>