<?php

class BBDD
{

    public $pdo;

    public function __construct()
    {
        $host = 'mysql';
        $name = 'cosmetica';
        $user = 'root';
        $password = 'root';
        $this->pdo =  new PDO("mysql:host=$host;dbname=$name", $user, $password);
    }

    public function __destruct()
    {

        unset($this->pdo);
    }

    public function select($sql, $params = [])
    {

        try {

            $consulta = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $type = PDO::PARAM_NULL;
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } elseif (is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } elseif (is_string($value)) {
                    $type = PDO::PARAM_STR;
                }
                $value = trim($value);
                $value = stripcslashes($value);
                $value = htmlspecialchars($value);
                $consulta->bindValue($key, $value, $type);
            }
            $consulta->execute();
            $resultado = [];
            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $resultado[] = $fila;
            }
            unset($consulta);
            return $resultado;
        } catch (Exception $th) {
            return [false, "Ocurrio un error", $th->getMessage()];
        }
    }

    public function execute($sql, $params = [])
    {
        try {
            $consulta = $this->pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $type = PDO::PARAM_NULL;
                if (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } elseif (is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } elseif (is_string($value)) {
                    $type = PDO::PARAM_STR;
                }
                $value = trim($value);
                $value = stripcslashes($value);
                $value = htmlspecialchars($value);
                $consulta->bindValue($key, $value, $type);
            }

            $consulta->execute();
            if (!$consulta) {
                return [false, "No se pudo crear el usuario"];
            }
            unset($consulta);
            return [true, $this->pdo->lastInsertId()];
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                return [false, "Ya existe una cuenta con este Email"];
            }
        } catch (Exception $th) {
            return [false, "Mecachis, ccurrio un error", $th->getMessage()];
        }
    }
}
