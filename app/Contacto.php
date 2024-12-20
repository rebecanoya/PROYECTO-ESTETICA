<?php

include 'src/iniciarPHP.php';
/**
 * Pagina donde se muestra la informacion de contacto de cada instituto
 *
 */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/contacto.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Contacto | Aromusicoterapia</title>
</head>

<body>
    <img src="img/banner.jpg" class="banner">
    <?php

    include "src/templates/header.php"

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
        <div class="general">
            <div class="nombreIes"><?php echo $nombreIES ?></div>

            <article>
                <section class="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2953.271006136013!2d-8.692645823401442!3d42.25138484195982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2f62e588cfce69%3A0x378485bfa6edd1be!2sIES%20de%20Teis!5e0!3m2!1ses!2ses!4v1710160565708!5m2!1ses!2ses" width="600" height="450" style="border:0; margin-bottom: 3em;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </section>
                <section class="datos">
                    <p><i class="fa-solid fa-phone"></i><?php echo $telefonoIES ?></p>

                    <a href="mailto:recipient@example.com"><i class="fa-solid fa-envelope"></i><?php echo $emailIES ?></a>

                    <a href="https://<?php echo $webIES ?>"><i class="fa-solid fa-globe"> </i>Web</a>
                </section>
            </article>
        </div>
    </main>

    <?php

    include "src/templates/footer.php"

    ?>
</body>

</html>