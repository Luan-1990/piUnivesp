<?php

namespace classes;

class Database extends \PDO
{
//conexão com o DB
    private $conn;

    public function __construct ()
    {
        $this->conn = new \PDO("mysql:host=localhost; dbname=pi_univesp", "root", "");
    }
     private function setParams($statment, $parameters = array())
     {
        foreach ($parameters as $key => $value)
        {
            $this -> setParam($statment, $key, $value);
        }


     }

     private function setParam($statment, $key, $value)
     {
        $statment->bindParam($key, $value);
     }
    public function consulta ($rawQuery, $params = array())
    {
        $stmt = $this -> conn -> prepare($rawQuery);
        $this -> setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }
    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this-> consulta($rawQuery, $params);
        return $stmt -> fetchAll(\PDO::FETCH_ASSOC);
    }
}