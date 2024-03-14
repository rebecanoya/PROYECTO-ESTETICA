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
    <style>
        .registrarse {
            display: none;
        }
    </style>
</head>

<body>

    <?php
    include "../../src/templates/header.php"
    ?>

    <main>
        <div class="container">

            <div class="sesion">
                <h2>Cliente nuevo</h2>
                <p>Para continuar con un proceso de compra debes registrarte.</p>
                <button id="mostrarFormulario">Crear cuenta</button>
            </div>

            <div class="sesion">
                <h2>Iniciar Sesion</h2>
                <form action="" method="post">
                    <div class="datos">
                        <input type="email" name="email" id="email" placeholder="correo electronico o usuario">
                        <input type="password" name="password" id="password" placeholder="contraseña">
                    </div>
                    <button type="submit" class="login">Iniciar</button>
                </form>
                <a href="">¿Olvidaste tu contraseña?</a>
            </div>

        </div>

        <div class="registrarse">
            <h2>Regístrate</h2>
            <form action="" method="post">
                <div class="grupo-form">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                    <input type="password" name="confirmpassword" id="password" placeholder="Repetir contraseña">
                </div>
                <button type="submit" class="register">Crear cuenta</button>
            </form>
        </div>
    </main>

    <?php
    include "../../src/templates/footer.php"
    ?>

    <script>
        document.getElementById('mostrarFormulario').addEventListener('click', function() {
            document.querySelector('.registrarse').style.display = 'block';
        });
    </script>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["register"])) {
                $password = hash("sha512",$_POST["password"]);
                $confirmPassword = hash("sha512",$_POST["confirmpassword"]);
                if (hash_equals($password, $confirmPassword)) {
                    $sql = "INSERT INTO Usuarios(Email, Password, Rol) VALUES (:email, :password, 2)";
                    $param = [":email" =>  $_POST["email"], "password" => $password];
                    $BBDD -> execute($sql, $param);
                }
            } elseif (isset($_POST["login"])) {
                $password = hash("sha512",$_POST["password"]);
                $sesion -> login($_POST["email"], $password);
            }
        }    
    ?>

</body>

</html>
