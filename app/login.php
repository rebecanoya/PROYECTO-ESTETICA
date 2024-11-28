<?php
include 'src/iniciarPHP.php';
// include 'correo_modelo.php';
include 'verificacion.php';

if ($sesion->estaLoggeado()) {
    header("Location: index.php");
}

// if (mail("anderfdez0207@gmail.com", "Prueba de mail()", "Este es un correo de prueba.")) {
//     echo "Correo enviado correctamente.";
// } else {
//     echo "Error al enviar el correo.";
// }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <title>Pagina inicial</title>
</head>

<body>

    <?php
    include "src/templates/header.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["register"])) {
            $email = $_POST['email'];
            unset($errorR);
            $sameEmail = false;
            $password = hash("sha512", $_POST["password"]);
            $confirmPassword = hash("sha512", $_POST["confirmpassword"]);
            $sql = "SELECT Email, password FROM usuarios";
            $infoU = $BBDD->select($sql);

            foreach ($infoU as $info) {
                if ($info["Email"] == $email && $info["password"] !=  hash("sha512", "")) {
                    $sameEmail = true;
                    $errorR = "Ya existe una cuenta con este correo";
                }
            }

            if (hash_equals($password, $confirmPassword) && !$sameEmail) {
                // Generar el token de confirmación
                $confirmationToken = bin2hex(random_bytes(16));

                $sql = "INSERT INTO usuarios (Email, Password, Rol, Activo) 
                        VALUES (:email, :password, 3, 1)";
                $param = [
                    "email" => $email,
                    "password" => $password,
                ];
                $respuesta = $BBDD->execute($sql, $param);
                if (!$respuesta[0]) {
                    $errorR = $respuesta[1];
                }
                // Correo_modelo::enviar_correo($email, "Registro AroMusicoTerapia", "Gracias por registrarte en Aromusicoterapia");
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
        <div class="container">
            <h2>Iniciar Sesion</h2>
            <form action="" method="post">
                <div class="grupo-form">
                    <input type="email" name="email" id="email" placeholder="Correo electronico">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                </div>
                <button type="submit" name="login" class="login">Iniciar</button>
            </form>
            <?php
            if (isset($errorL)) {
                echo $errorL;
            }
            ?>
        </div>
    </main>



</body>

</html>