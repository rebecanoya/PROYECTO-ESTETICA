<footer>
    <script type="text/javascript" src="../js/chat.js"></script>

    <div class="logo">
        <img src="../img/favicon.svg" alt="Logo">
    </div>
    <div class="footer-columns">
        <div class="footer-column">
            <h3>Aromusicoterapia</h3>
            <ul>
                <li>Productos cosméticos en Vigo (Por ahora)</li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Nuestra Web</h3>
            <ul>
                <li><a href="NuestrosProductos.php">Nuestros Productos</a></li>
                <li><a href="QuienesSomos.php">Quiénes Somos</a></li>
                <li><a href="Blog.php">Blog</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3><a href="Contacto.php">Contacto</a></h3>
            <ul>
                <li>Teléfono: 886120464</li>
                <li>ies.teis@edu.xunta.es</li>
            </ul>
        </div>
    </div>



</footer>

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