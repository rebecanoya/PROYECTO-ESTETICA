

<?php
class Sesion
{




    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION["token"]) && isset($_COOKIE["token"])) {
            if (($_SESSION["token"]) != ($_COOKIE["token"])) {

                $this->logout();
            }
        }

        if (!isset($_SESSION["Carrito"])) {
            $_SESSION["Carrito"] = [];
        }
    }

    public function login($email, $password)
    {

        try {
            $BBDD = new BBDD();
            $sql = "SELECT * from usuarios where Email=:email and Password=:password";
            $param = ["email" =>  $email, "password" => hash("sha512", $password)];
            $usuarioLogin = $BBDD->select($sql, $param);
            if (!$usuarioLogin) {

                return false;
            }
            $sql = "SELECT IDProducto,Cantidad from carrito where IDUsuario=:id";
            $param = ["id" => $usuarioLogin[0]["ID"]];
            $carrito = $BBDD->select($sql, $param);
            $_SESSION["usuario"] = $usuarioLogin[0]["Email"];

            if (isset($_SESSION["Carrito"])) {

                foreach ($carrito as $producto) {
                    if (!isset($_SESSION["Carrito"][$producto["IDProducto"]])) {
                        $_SESSION["Carrito"][$producto["IDProducto"]] = 0;
                    }
                    $_SESSION["Carrito"][$producto["IDProducto"]] += $producto["Cantidad"];
                }
            }

            $_SESSION["token"] = bin2hex(random_bytes(32));
            setcookie("token", $_SESSION["token"], time() + 900, "/");
            return true;
        } catch (\Throwable $th) {
        }
    }

    public function logout()
    {
        unset($_SESSION["usuario"]);
        unset($_SESSION["token"]);
        setcookie("token", "", time() - 1);
    }

    public function estaLoggeado()
    {

        return isset($_SESSION["usuario"]);
    }
}
