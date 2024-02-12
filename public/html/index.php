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

    <header>

        <div class="titulo">

            <h1>
                <a href="index.html"> Nombre Pagina</a>
            </h1>



        </div>

        <div class="icons">
            <a class="fa-solid fa-magnifying-glass iconButton"></a>
            <a class="fa-regular fa-user iconButton"></a>
            <a class="fa-solid fa-cart-shopping iconButton"></a>

        </div>
        <nav>

            <a href="QuienesSomos.html">¿QUIÉNES SOMOS?</a>
            <a href="NuestrosProductos.html">NUESTROS PRODUCTOS</a>

            <a href="Pedidos.html">PEDIDOS</a>
            <a href="Blog.html">BLOG</a>
            <a href="Contacto.html">CONTACTO</a>

        </nav>

    </header>



    <main>
        <div class="containerBanner">
            <img src="../img/banner.jpg" class="banner">
        </div>
    </main>


    <footer>

        <div class="chat">
            <a class="fa-solid fa-headset iconButton">
            </a>
        </div>

    </footer>
</body>

</html>