<?php
include 'src/iniciarPHP.php';

$sql = "DELETE FROM usuarios WHERE confirmed = FALSE AND confirmation_token IS NOT NULL AND DATE_ADD(fecha_registro, INTERVAL 7 DAY) < NOW()";
$BBDD->execute($sql);

echo "Usuarios no confirmados eliminados con éxito.";
?>