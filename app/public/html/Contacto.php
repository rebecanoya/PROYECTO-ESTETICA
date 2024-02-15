<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/contacto.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Contacto</title>
</head>

<body>
    <?php

    include "../../src/templates/header.php"

    ?>
    <main>

        <div class="nombreIes">IES EJEMPLO</div>

        <article class="info">
            <section class="mapa">
                <div class="direccion">
                    <img src="../img/ejemploMaps.jpg" alt="mapa">
                </div>
            </section>
            <section class="datos">
                <div class="telf"><i class="fa-solid fa-phone"></i>
                    <p>935 702 340</p>
                </div>
                <div class="email"><i class="fa-solid fa-envelope"></i>
                    <p>correo@ejemplo.com</p>
                </div>
                <div class="web"><i class="fa-solid fa-globe"></i><a href="#">webejemplo.es</a></div>
            </section>
        </article>
    </main>
    <?php

    include "../../src/templates/footer.php"

    ?>

</body>

</html>