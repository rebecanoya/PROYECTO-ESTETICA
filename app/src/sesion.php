<?php

/**
 *
 * @brief Clase que controla la sesion de usuarios
 * @author Rebeca Noya Fernández
 */
class Sesion
{


    /**
     * constructor de la sesion
     *
     */
    public function __construct()
    {
        // iniciar sesion si no hay sesion iniciada
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        // verificacion hijack 
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

        // crear carrito
        if (!isset($_SESSION["Carrito"])) {
            $_SESSION["Carrito"] = [];
        }
    }
    /**
     * login de sesion
     *
     * @param   string  $email     email usuario
     * @param   string  $password  contraseña usuario
     *
     * @return  bool               verdadero si te loggeas
     */
    public function login(string $email, string $password): bool
    {

        try {
            // seleccionamos usuario con email y contraseña
            $BBDD = new BBDD();
            $sql = "SELECT * from usuarios where Email=:email and Password=:password and Activo = 1";
            $param = ["email" =>  $email, "password" => hash("sha512", $password)];
            $usuarioLogin = $BBDD->select($sql, $param);
            // si hay un error o no se encuentra el usuario salimos
            if (count($usuarioLogin) == 0 || !$usuarioLogin[0]) {
                return false;
            }
            // seleccionamos el carrito del usuario 
            $sql = "SELECT IDProducto,Cantidad from carrito where IDUsuario=:id and Cantidad>0";
            $param = ["id" => $usuarioLogin[0]["ID"]];
            $carrito = $BBDD->select($sql, $param);
            // fusionar carrito de sesion y de bbdd
            if (!isset($_SESSION["usuario"])) {

                foreach ($carrito as $producto) {
                    if (!isset($_SESSION["Carrito"][$producto["IDProducto"]])) {
                        $_SESSION["Carrito"][$producto["IDProducto"]] = 0;
                    }
                    $_SESSION["Carrito"][$producto["IDProducto"]] += $producto["Cantidad"];
                }
            }
            // iniciar variables de sesion
            $_SESSION["usuario"] = $usuarioLogin[0]["Email"];
            $_SESSION["rol"] = $usuarioLogin[0]["rol"];
            $_SESSION["id"] = $usuarioLogin[0]["ID"];

            // iniciar token de sesion
            $_SESSION["token"] = bin2hex(random_bytes(32));
            setcookie("token", $_SESSION["token"], time() + 900, "/");
            return true;
        } catch (Exception $th) {
            return false;
        }
    }

    /**
     * cerrar sesion eliminando las variables de sesion
     *
     */
    public function logout(): void
    {
        unset($_SESSION["usuario"]);
        unset($_SESSION["token"]);
        setcookie("token", "", 1, "/");
        unset($_SESSION["rol"]);
        unset($_SESSION["Carrito"]);
        unset($_SESSION["id"]);
    }

    /**
     * comprobar si esta loggeado
     *
     * @return  bool    verdadero si el usuario esta loggeado
     */
    public function estaLoggeado(): bool
    {

        return isset($_SESSION["usuario"]);
    }
}
