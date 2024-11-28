<?php
function sendConfirmationEmail($userEmail, $confirmationToken) {
    $to = $userEmail;
    $subject = "Confirma tu cuenta";
    $message = "
        <html>
        <head>
        <title>Confirma tu cuenta</title>
        </head>
        <body>
        <h1>Bienvenido, a Aromusicoterapia</h1>
        <p>Gracias por registrarte. Por favor, confirma tu cuenta haciendo clic en el enlace a continuación:</p>
        <a href='http://aromusicoterapia.iesteis.gal/confirmarCuenta.php?token=$confirmationToken'>Confirma tu cuenta</a>
        <p>Si no solicitaste este registro, ignora este correo.</p>
        </body>
        </html>
    ";
    $headers = "MIME-Version: 1.0" . "\r\n"; 
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@aromusicoterapia.iesteis.gal" . "\r\n";
    return mail($to, $subject, $message, $headers);
}
?>
