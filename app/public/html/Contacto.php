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
    <link rel="stylesheet" href="../css/contacto.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Contacto</title>
</head>

<body>
    <?php

    include "../../src/templates/header.php"

    ?>
    <main>
            <?php
                $BBDD = new BBDD();
                $sql = "SELECT * from ies where id=1";
                $institutos = $BBDD->select($sql);
                foreach ($institutos as $instituto) {
                    $telefonoIES = $instituto["telf"];
                    $webIES = $instituto["web"];
                    $nombreIES = $instituto["nombre"];
                    $emailIES = $instituto["email"];
                }

            ?>
        <div class="nombreIes"><?php echo $nombreIES ?></div>

        <article class="info">
            <section class="mapa">
                <div class="direccion">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2953.2711920540664!2d-8.692645824074832!3d42.25138087120318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2f62e588cfce69%3A0x378485bfa6edd1be!2sIES%20de%20Teis!5e0!3m2!1ses!2ses!4v1708971321653!5m2!1ses!2ses" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
            <section class="datos">
                <div class="telf"><i class="fa-solid fa-phone"></i>
                    <p><?php echo $telefonoIES ?></p>
                </div>
                <div class="email"><i class="fa-solid fa-envelope"></i>
                    <p><?php echo $emailIES ?></p>
                </div>
                <div class="web"><i class="fa-solid fa-globe"></i><a href="https://<?php echo $webIES ?>">Web</a></div>
            </section>
        </article>
    </main>
    <?php

    include "../../src/templates/footer.php"

    ?>

</body>

</html>