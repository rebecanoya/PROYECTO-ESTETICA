<?php

$host = 'mysql';
$name = 'sys';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener la versión de MySQL
    $query = "SELECT VERSION() AS version";
    $statement = $pdo->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $mysqlVersion = $row['version'];

    echo "La versión de MySQL es: $mysqlVersion";
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
