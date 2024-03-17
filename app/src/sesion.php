

<?php
class Sesion
{




    public function __construct()

    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $issetSesion = isset($_SESSION["token"]);
        $issetCookie = isset($_COOKIE["token"]);
        if ($this->estaLoggeado()) {

            if ($issetSesion && $issetCookie) {
                if ($issetSesion != $issetCookie) {
                    $this->logout();
                }
            } else {
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
            $sql = "SELECT * from usuarios where Email=:email and Password=:password and Activo = 1";
            $param = ["email" =>  $email, "password" => hash("sha512", $password)];
            $usuarioLogin = $BBDD->select($sql, $param);
            var_dump($usuarioLogin);
            if (count($usuarioLogin) == 0 || !$usuarioLogin[0]) {
                return false;
            }
            $sql = "SELECT IDProducto,Cantidad from carrito where IDUsuario=:id and Cantidad>0";
            $param = ["id" => $usuarioLogin[0]["ID"]];
            $carrito = $BBDD->select($sql, $param);
            if (!isset($_SESSION["usuario"])) {

                foreach ($carrito as $producto) {
                    if (!isset($_SESSION["Carrito"][$producto["IDProducto"]])) {
                        $_SESSION["Carrito"][$producto["IDProducto"]] = 0;
                    }
                    $_SESSION["Carrito"][$producto["IDProducto"]] += $producto["Cantidad"];
                }
            }

            $_SESSION["usuario"] = $usuarioLogin[0]["Email"];
            $_SESSION["rol"] = $usuarioLogin[0]["rol"];
            $_SESSION["id"] = $usuarioLogin[0]["ID"];


            $_SESSION["token"] = bin2hex(random_bytes(32));
            setcookie("token", $_SESSION["token"], time() + 900, "/");
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION["usuario"]);
        unset($_SESSION["token"]);
        setcookie("token", "", 1, "/");
        unset($_SESSION["rol"]);
        unset($_SESSION["Carrito"]);
        unset($_SESSION["id"]);
    }

    public function estaLoggeado()
    {

        return isset($_SESSION["usuario"]);
    }
}
