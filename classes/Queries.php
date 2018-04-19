<?php
class Queries
{
    private $dsn  = "mysql:dbname=projetphp;host=localhost;charset=utf8";
    private $username = "root";
    private $password = "";
    private $db;

    function __construct()
    {
        try {

            $this-> db = new PDO($this -> dsn, $this -> username, $this -> password);
            $this -> db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function __destruct()
    {
        unset($this -> db);
    }

    private function prepareProcedure($array) {
        foreach ($array as $key => $value) {
            $pdoKey = $key + 1;
            $stmt = $this -> db-> prepare("SET @p$pdoKey = ?;");
            $stmt-> bindParam(1,$value);
            $stmt-> execute();
        }
    }

    function insertUpdateMessage($values){
        self::prepareProcedure($values);
        $this -> db -> query("CALL INSERT_MESSAGE();"); //TODO METTRE LES PARAMS
    }

    function deleteMessage($id) {
        self::prepareProcedure($id);
        $this -> db -> query("CALL DELETE_MESSAGE();"); //TODO METTRE LES PARAMS
    }
}