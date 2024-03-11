<?php

class BBDD
{

    public $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $name = 'cosmetica';
        $user = 'root';
        $password = '';
        $this->pdo =  new PDO("mysql:host:=$host:3306;dbname=$name", $user, $password);
    }

    public function __destruct()
    {

        unset($this->pdo);
    }

    public function select($sql, $params = null)
    {
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute($params);
        $resultado = [];
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $fila;
        }
        unset($consulta);
        return $resultado;
    }
}
