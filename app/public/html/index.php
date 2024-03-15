<?php

include '../../src/iniciarPHP.php';
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
                <a class="button" href="#lineas">¡DESCUBRELO!</a>
            </div>

            <img src="../img/banner.jpg" class="banner">
        </div>
        <section class="bannerNegro">
            <div class="container">
                <div class="textos">

                    <h2>¿Necesitas que te asesoremos?</h2>
                    <p>Nuestro equipo de expertos en belleza está aquí para asesorarte y ayudarte a encontrar los productos adecuados para tus necesidades específicas</p>

                </div>
                <a class="button">Contactanos</a>
            </div>
            <img src="../img/llamada.jpg" alt="" width="500px">


        </section>
        <section class="lineas" id="lineas">

            <?php

            $sql = "SELECT * from lineas where Activo = 1";
            $lineas = $BBDD->select($sql);
            foreach ($lineas as $linea) {

                $nombreLinea = $linea["Nombre"];
                $colorLinea = $linea["Color"];
                $IDLinea = $linea["ID"];
                $descripcionLinea = $linea["Descripcion"];
                include("../../src/templates/linea.php");
            }

            ?>
        </section>
    </main>


    <?php

    include "../../src/templates/footer.php";

    ?>
</body>
<?php
include "../../src/templates/ScriptEnlaceProductos.php";

?>

</html>