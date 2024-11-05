<?php

/**
 * Controlador LOGOUT peticion POST
 */
include 'src/sesion.php';

$sesion = new Sesion();

$sesion->logout();

header("Location: index.php");
