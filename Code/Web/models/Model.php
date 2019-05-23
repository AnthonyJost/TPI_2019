<?php

abstract class Model
{
    private static $_BDD;

    //Instancie la connexion à la BDD
    private static function setBDD()
    {
        self::$_BDD = new PDO('mysql:host=localhost;dbname=BDD_SatisfEvent;charset=utf8','root', 'Chau55ette5!');
        self::$_BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Récupère la connexion à la BDD
    protected function getBDD()
    {
        if(self::$_BDD == null)
            self::setBDD();
        return self::$_BDD;
    }

    protected function getAllEvents($table, $obj)
    {
        $var = [];
        $req = $this->getBDD()->prepare('SELECT * FROM ' .$table. ' ORDER BY Date desc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getAllSchools($table, $obj)
    {
        $var = [];
        $req = $this->getBDD()->prepare('SELECT * FROM ' .$table. ' ORDER BY Name asc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function executeQuerySelect($query){
        $queryResult = null;

        $dbConnexion = $this->getBDD();//open database connexion
        if ($dbConnexion != null)
        {
            $statement = $dbConnexion->prepare($query);//prepare query
            $statement->execute();//execute query
            $queryResult = $statement->fetchAll();//prepare result for client
        }
        $dbConnexion = null;//close database connexion
        return $queryResult;
    }

    function executeQueryInsert($query){
        $queryResult = null;

        $dbConnexion = $this->getBDD();//open database connexion
        if ($dbConnexion != null)
        {
            $statement = $dbConnexion->prepare($query);//prepare query
            $queryResult = $statement->execute();//execute query
        }
        $dbConnexion = null;//close database connexion
        return $queryResult;
    }
}