<?php

include '../../src/iniciarPHP.php';
$input = file_get_contents('php://input');
$data = json_decode($input, true);
if (isset($data) && isset($data["id"]) && isset($data["cantidad"]) && isset($data["accion"])) {
    $id = $data["id"];
    $accion = $data["accion"];
    $cantidad = $data["cantidad"];
    if (is_numeric($id) && is_numeric($cantidad)) {
        $cantidadCarrito = 0;
        if (isset($_SESSION["Carrito"][$id])) {
            $cantidadCarrito = $_SESSION["Carrito"][$id];
        }
        if ($accion == "add") {
            $cantidadProducto = $cantidadCarrito + $cantidad;
        } elseif ($accion == "muestra") {
            $cantidadProducto = $cantidadCarrito + 1;
        } elseif ($accion == "reducir") {
            $cantidadProducto = $cantidadCarrito - $cantidad;
        }
        if ($accion == "eliminar" || $cantidadProducto < 0) {
            $cantidadProducto = 0;
        }
        if (isset($cantidadProducto)) {
            $_SESSION["Carrito"][$id] = $cantidadProducto;
            var_dump($_SESSION["Carrito"]);
            if ($sesion->estaLoggeado()) {
                $sql = "SELECT * from productos where IDProducto=:producto and Activo = 1;";
                $params = ["producto" => $id];
                $select = $BBDD->select($sql, $params);
                if (count($select) == 0) {
                    return;
                }
                $sql = "SELECT * from carrito where IDUsuario=:id and IDProducto=:producto";
                $params = ["id" => $_SESSION["id"], "producto" => $id];
                $select = $BBDD->select($sql, $params);
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
