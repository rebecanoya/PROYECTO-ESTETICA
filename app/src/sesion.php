

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

    public function login($usuario, $password)
    {

        try {
            $BBDD = new BBDD();
            $sql = "SELECT * from usuarios";
            $param = ["usuario" =>  $usuario, "password" => hash("sha512", $password)];
            $usuarioLogin = $BBDD->select($sql, $param);
            if (!$usuarioLogin) {

                return false;
            }
            if ($usuario == $usuarioLogin[0]["Email"] && hash_equals($usuarioLogin[0]["Password"], hash("sha512", $password))) {
                $_SESSION["usuario"] = $usuarioLogin[0]["Email"];
                $_SESSION["token"] = bin2hex(random_bytes(32));
                setcookie("token", $_SESSION["token"], time() + 900, "/");
                return true;
            } else {
                return false;
            }
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
