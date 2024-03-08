<!-- <?php

        include '../../src/BBDD.php';
        $BBDD = new BBDD();

        ?> -->

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

            <?php

            $sql = "SELECT * from lineas";
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

</html>