<?php

class BBDD
{

    public $pdo;

    public function __construct()
    {
        $host = '';
        $name = 'BBDD';
        $user = 'root';
        $password = 'root';
        $this->pdo =  new PDO("mysql:host:=$host:3306;dbname=$name", $user, $password);
    }
}
