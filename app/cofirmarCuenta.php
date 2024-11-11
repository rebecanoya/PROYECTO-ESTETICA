<?php
include 'src/iniciarPHP.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM usuarios WHERE confirmation_token = :token";
    $stmt = $BBDD->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && !$user['confirmed']) {
        // Confirmar la cuenta del usuario
        $sql = "UPDATE usuarios SET confirmed = TRUE, confirmation_token = NULL WHERE id = :user_id";
        $stmt = $BBDD->prepare($sql);
        $stmt->bindParam(':user_id', $user['id']);
        $stmt->execute();

        echo "¡Tu cuenta ha sido confirmada con éxito!";
    } else {
        echo "Token inválido o cuenta ya confirmada.";
    }
} else {
    echo "Token de confirmación no proporcionado.";
}
?>