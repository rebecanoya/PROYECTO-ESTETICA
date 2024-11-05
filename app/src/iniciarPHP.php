<?php

/**
 * Aqui incluimos los dos archivos de BBDD y sesion para crear dos nuevas clases,
 * una de BBDD y otra de sesion
 */
include 'src/BBDD.php';
include 'src/sesion.php';
$BBDD = new BBDD();

$sesion = new Sesion();
