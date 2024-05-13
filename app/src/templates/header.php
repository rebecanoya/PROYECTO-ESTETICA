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
        <a class="fa-solid fa-magnifying-glass iconButton"></a>
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


</header>
<script>
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    let cookies = document.cookie;
    const mensajeAparecido = cookies.match("aceptarCookies=true");
    const estaLoggeado = cookies.match("token=");

    if (!estaLoggeado && !mensajeAparecido) {
        alert("Es necesario el uso de cookies para el funcionamiento de esta página");
        setCookie("aceptarCookies", "true", 7);


    }
</script>