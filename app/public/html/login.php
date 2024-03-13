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
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Pagina inicial</title>
</head>

<body>

    <?php

    include "../../src/templates/header.php"

    ?>

    <body>

        <main>
            <div class="container">

                <div class="sesion">
                    <h2>Cliente nuevo</h2>
                    <p>Para continuar con un proceso de compra debes registrarte.</p>
                    <button>Crear cuenta</button>

                </div>
                <div class="sesion">
                    <h2>Iniciar Sesion</h2>
                    <form action="sign">
                        <div class="datos">

                            <input type="email" name="email" id="email" placeholder="correo electronico o usuario">
                            <input type="password" name="password" id="password" placeholder="contraseña">

                        </div>

                        <button>Iniciar</button>
                    </form>

                    <a href="">¿Olvidaste tu contraseña?</a>


                </div>


            </div>

            <div class="registrarse">
                <h2>Regístrate</h2>
                <form action="create">

                    <div class="grupo-form">

                        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                        <input type="text" name="apellidos" id="nombre" placeholder="Apellidos">
                        <input type="date" name="nacimiento" id="nacimiento" placeholder="Fecha de nacimiento">


                    </div>

                    <div class="genero">

                        <input type="radio" id="genero-mujer" name="genero" value="mujer">
                        <label for="genero-mujer">Mujer</label><br>

                        <input type="radio" id="genero-hombre" name="genero" value="hombre">
                        <label for="genero-hombre">Hombre</label><br>

                        <input type="radio" id="genero-otro" name="genero" value="otro">
                        <label for="genero-otro">Otro</label><br>

                    </div>

                    <div class="grupo-form">
                        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="Telefono">
                        <input type="email" name="correo" id="correo" placeholder="Email">
                        <input type="password" name="password" id="password" placeholder="Contraseña">
                        <input type="password" name="password" id="password" placeholder="Repetir contraseña">
                    </div>

                    <button type="submit">Crear cuenta</button>

                </form>
            </div>
        </main>

        <?php

        include "../../src/templates/footer.php"

        ?>

    </body>

</html>