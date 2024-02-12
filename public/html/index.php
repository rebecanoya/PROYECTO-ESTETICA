<?php

include '../../src/BBDD.php';
$BBDD = new BBDD();
$sql = "SELECT * from roles where id_rol=:id";
$param = ["id" =>  1];
$resultado = $BBDD->select($sql, $param);
var_dump($resultado);

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
            <img src="../img/banner.jpg" class="banner">
        </div>
    </main>


    <?php

    include "../../src/templates/footer.php"

    ?>
</body>

</html>