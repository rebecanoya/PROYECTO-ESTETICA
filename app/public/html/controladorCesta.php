/**
* controlador peticion POST de la cesta
*/
<?php
include '../../src/iniciarPHP.php';
// obtener datos de POST enviados
$input = file_get_contents('php://input');
$data = json_decode($input, true);
// comprobar que estan los datos necesarios
if (isset($data) && isset($data["id"]) && isset($data["cantidad"]) && isset($data["accion"])) {
    $id = $data["id"];
    $accion = $data["accion"];
    $cantidad = $data["cantidad"];
    // comprobar que los valores sean numericos
    if (is_numeric($id) && is_numeric($cantidad)) {
        $cantidadCarrito = 0;
        // cargar el objeto del carrito que está en la cuenta de usuario
        if (isset($_SESSION["Carrito"][$id])) {
            $cantidadCarrito = $_SESSION["Carrito"][$id];
        }
        // ejecutar accion segun el valor enviado 
        if ($accion == "add") {
            $cantidadProducto = $cantidadCarrito + $cantidad;
        } elseif ($accion == "muestra") {
            $cantidadProducto = $cantidadCarrito + 1;
        } elseif ($accion == "reducir") {
            $cantidadProducto = $cantidadCarrito - $cantidad;
        }
        // si la accion es eliminar o no hay productos, eliminamos el producto del carrito sesion
        if ($accion == "eliminar" || $cantidadProducto < 0) {
            $cantidadProducto = 0;
            unset($_SESSION["Carrito"][$id]);
        }
        // si esta establecida cantidad de producto
        if (isset($cantidadProducto)) {
            // actualizamos el valor del carrito sesion
            if ($cantidadProducto > 0) {
                $_SESSION["Carrito"][$id] = $cantidadProducto;
            }
            // si esta iniciada la sesion, guardar en la base de datos
            if ($sesion->estaLoggeado()) {
                // comprobar que el producto exista y este activo
                $sql = "SELECT * from productos where IDProducto=:producto and Activo = 1;";
                $params = ["producto" => $id];
                $select = $BBDD->select($sql, $params);
                if (count($select) == 0 || !$select[0] === false) {
                    return;
                }
                // comprobar si el producto esta en el carrito de la bbdd 
                $sql = "SELECT * from carrito where IDUsuario=:id and IDProducto=:producto";
                $params = ["id" => $_SESSION["id"], "producto" => $id];
                $select = $BBDD->select($sql, $params);
                if ($select[0] === false) {
                    return;
                }
                // insertar el producto si no existe o actualizar si existe
                if (count($select) == 0) {
                    $sql = "INSERT into carrito (IDUsuario, IDProducto, Cantidad) values (:id, :producto, :cantidad)";
                    $params = ["cantidad" => $cantidadProducto, "id" => $_SESSION["id"], "producto" => $id];
                    $BBDD->execute($sql, $params);
                } else {
                    $sql = "UPDATE carrito set Cantidad=:cantidad where IDUsuario=:id and IDProducto=:producto";
                    $params = ["cantidad" => $cantidadProducto, "id" => $_SESSION["id"], "producto" => $id];
                    $BBDD->execute($sql, $params);
                }
            }
        }
    }
}
