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
    include "../../src/templates/header.php";

    /**
     * Registro de usuario con contraseña hasheada
     *
     */
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["register"])) {
            unset($errorR);
            $sameEmail = false;
            $password = hash("sha512", $_POST["password"]);
            $confirmPassword = hash("sha512", $_POST["confirmpassword"]);
            $sql = "SELECT Email, password from usuarios";
            $infoU = $BBDD->select($sql);
            foreach($infoU as $info){
                if ($info["Email"] == $_POST["email"] && $info["password"] !=  hash("sha512", "")) {
                    $sameEmail = true;
                    $errorR = "Ya existe una cuenta con este correo";
                }
            }
            // Comprobar que ambas contraseñas son iguales
            if (hash_equals($password, $confirmPassword) && !$sameEmail) {
                $sql = "INSERT INTO usuarios(Email, Password, Rol) VALUES (:email, :password, "3")";
                $param = ["email" =>  $_POST["email"], "password" => $password];
                $respuesta = $BBDD->execute($sql, $param);
                if ($respuesta[0]) {
                    $errorR = $respuesta[1];
                }
                $sesion->login($_POST["email"], $_POST["password"]);
                header("Location: index.php");
            }
        } elseif (isset($_POST["login"])) {
            if ($sesion->login($_POST["email"], $_POST["password"])) {
                header("Location: index.php");
            } else {
                $errorL = "No se pudo iniciar sesion";
            }
        }
    }
    ?>
    <main>
        <div class="container">

            <div class="sesion">
                <h2>Cliente nuevo</h2>
                <p>Para continuar con un proceso de compra debes registrarte.</p>
                <button id="mostrarFormulario">Crear cuenta</button>
                <?php
                    if (isset($errorR)) {
                        echo "<br>" . $errorR;
                    }
                ?>
            </div>
                

            <div class="sesion">
                <h2>Iniciar Sesion</h2>
                <form action="" method="post">
                    <div class="datos">
                        <input type="email" name="email" id="email" placeholder="correo electronico o usuario">
                        <input type="password" name="password" id="password" placeholder="contraseña">
                    </div>
                    <button type="submit" name="login" class="login">Iniciar</button>
                </form>
                <?php 
                if (isset($errorL)) {
                    echo $errorL;
                }
                ?>
                <!-- <a href="">¿Olvidaste tu contraseña?</a> -->
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
                
                <button type="submit" name="register" class="register">Crear cuenta</button>
            </form>
            
        </div>
    </main>

    <script>
        document.getElementById('mostrarFormulario').addEventListener('click', function() {
            document.querySelector('.registrarse').style.display = 'block';
        });
    </script>



</body>

</html>