<?php
/**
*
* @brief Clase que contiene todo lo relacionado con la conexion a la Base de Datos, asi como
* diferentes metodos con los que insertar o consultar en la misma
*
* @author Rebeca Noya Fernández
*/

class BBDD
{

    public $pdo;
    /**
     * Constructor con el que se crea la conexión a la Base de Datos
     */
    public function __construct()
    {
        $host = 'mysql';
        $name = 'cosmetica';
        $user = 'root';
        $password = 'root';
        $this->pdo =  new PDO("mysql:host=$host;dbname=$name", $user, $password);
    }

    /**
     * Destructor con el que se finaliza la conexion a la Base de Datos
     */
    public function __destruct()
    {

        unset($this->pdo);
    }

    /**
     * Funcion que permite hacer consultas del tipo SELECT a la Base de Datos
     *
     * @param   String $sql  Cadena que contiene la consulta de la base de datos
     * @param   Array  $params  Conjunto que contiene los valores de los parametros de la consulta
     *
     * @return  []  Devuleve el resultado de la consulta
     */
    public function select($sql, $params = [])
    {

        try {

            $consulta = $this->pdo->prepare($sql);
            /**
             * Bucle foreach en el que se comprueba los tipos de los datos que
             * contiene el Array $param, siendo validos solos INT, BOOLEAN y STRING
             */
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
    /**
     * Funcion que permite hacer consultas del tipo INSERT INTO y UPDATE en la Base de Datos
     *
     * @param   String $sql  Cadena que contiene la consulta de la base de datos
     * @param   Array  $params  Conjunto que contiene los valores de los parametros de la consulta
     *
     * @return  []  Devuleve el resultado de la consulta
     */
    public function execute($sql, $params = [])
    {
        try {
            $consulta = $this->pdo->prepare($sql);
            /**
             * Bucle foreach en el que se comprueba los tipos de los datos que
             * contiene el Array $param, siendo validos solos INT, BOOLEAN y STRING
             */
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

    /**
     * Funcion que devuelve el último Id insertado en la BD
     *
     * @return  int  Devuelve el último Id insertado en la BD
     */
    public function lastId(){
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
    }
}
