<?php
class Queries
{
    private $dsn  = "mysql:dbname=chatboot;host=localhost;charset=utf8";
    private $username = "root";
    private $password = "@ssassin1397";
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

    function insertUtilisateur($values) {
        self::prepareProcedure($values);
        $this -> db -> query("CALL INSERT_UTILISATEUR(@p1, @p2, @p3);");
    }

    function connexionUtilisateur($values)
    {
        self::prepareProcedure($values);
        $this -> db -> query("CALL UTILISATEUR_CONNEXION(@p1, @p2, @p3);");
        $result = $this -> db -> query("SELECT @p3 AS `ISOK`;");
        $row = $result -> fetch($this -> db::FETCH_ASSOC);
        $isOk = $row['ISOK'];
        return !is_null($isOk);
    }

    function getDonneesUtilisateur($values) {
        self::prepareProcedure($values);
        $this-> db ->query("CALL GETDONNEES_UTILISATEUR(@p1, @p2, @p3, @p4);");
        $result = $this -> db -> query("SELECT @p1 AS MAIL, @p3 AS UTILISATEUR_ID, @p4 AS SURNOM");
        return $result -> fetch($this -> db::FETCH_ASSOC);
    }

    function insertMessage($values){
        self::prepareProcedure($values);
        $this -> db -> query("CALL INSERT_MESSAGE(@p1, @p2, @p3);");
    }

    function updateMessage($values) {
        self::prepareProcedure($values);
        $this->db -> query("CALL UPDATE_MESSAGE(@p1, @p2, @p3);");
    }

    function deleteMessage($id) {
        self::prepareProcedure($id);
        $this -> db -> query("CALL DELETE_MESSAGE(@p1);");
    }
}