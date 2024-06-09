<header>
    <?php
    /**
     * Comprobamos que esta logueado el usuario con un if y si lo esta y es administrador,
     * mostramos el icono que permite acceder a la pagina de administracion   
     */
    if ($sesion->estaLoggeado()) {
        if ($_SESSION["rol"] == 1) {

    ?>
            <div class="iconAdmin">

                <a href="../../html/admin.php" class="fa-solid fa-screwdriver-wrench iconButton"></a>


            </div>

    <?php

        }
    }
    ?>

    <div class="titulo">

        <h1>
            <a href="index.php">Aromusicoterapia</a>
        </h1>



    </div>

    <div class="icons">
        <a id="audio" class="fa-solid fa-volume-xmark iconButton"></a>
        <a href="../../html/login.php" class="fa-regular fa-user iconButton"></a>
        <a href="../../html/Cesta.php" class=" fa-solid fa-cart-shopping iconButton"></a>
        <?php
        /**
         * Si esta el usuario logueado, mostramos el icono que permite cerrar la sesion
         */
        if ($sesion->estaLoggeado()) {

        ?>

            <a href="../../html/logOut.php" class="fa-solid fa-right-to-bracket iconButton"> </a>
        <?php } ?>


    </div>


    <nav>

        <a href="../../html/QuienesSomos.php">¿QUIÉNES SOMOS?</a>
        <a href="../../html/NuestrosProductos.php">NUESTROS PRODUCTOS</a>
        <a href="../../html/Blog.php">BLOG</a>
        <a href="../../html/Contacto.php">CONTACTO</a>

    </nav>



    <script src="../js/audio.js">


    </script>
</header>