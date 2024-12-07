<header>
    <?php
    /**
     * Comprobamos que esta logueado el usuario con un if y si lo esta y es administrador,
     * mostramos el icono que permite acceder a la pagina de administracion   
     */
    if ($sesion->estaLoggeado()) {
        if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2) {

    ?>
            <div class="iconAdmin">

                <a href="Admin.php" class="fa-solid fa-screwdriver-wrench iconButton"></a>

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

        <?php
        if (!$sesion->estaLoggeado()) {
        ?>
            <a href="login.php" class="fa-regular fa-user iconButton"></a>
        <?php
        }
        ?>


        <a href="Cesta.php" class=" fa-solid fa-cart-shopping iconButton">
            <?php
            $cantidad = 0;
            $carrito = $_SESSION["Carrito"];

            foreach ($carrito as $key => $value) {
                $cantidad += $value;
            }

            ?>
            <div class="cartCount" id="cartCount">
                <?php if ($cantidad > 0) {
                    echo $cantidad;
                }
                ?>
            </div>

        </a>
        <?php
        /**
         * Si esta el usuario logueado, mostramos el icono que permite cerrar la sesion
         */
        if ($sesion->estaLoggeado()) {

        ?>

            <a href="logOut.php" class="fa-solid fa-right-to-bracket iconButton"> </a>
        <?php } ?>


    </div>


    <nav>

        <a href="QuienesSomos.php">¿QUIÉNES SOMOS?</a>
        <a href="NuestrosProductos.php">NUESTROS PRODUCTOS</a>
        <a href="Blog.php">BLOG</a>
        <a href="Contacto.php">CONTACTO</a>

    </nav>



    <script src="js/audio.js">


    </script>
</header>