<?php

function registerNewAccount($FirstName, $LastName, $Email, $Psw, $idSchools){

    $Password = md5($Psw);

    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('INSERT INTO bdd_satisfevent.users (`FirstName`, `LastName`, `Email`, `Password`, `Schools_idSchools`) VALUES(?, ?, ?, ?, ?)');
    $request->execute(array($FirstName, $LastName, $Email, $Password, $idSchools));
}

function getSchools()
{
    $schoolsQuery = 'SELECT * FROM Schools';

    require_once 'model/dbConnector.php';
    $schoolsResults = executeQuerySelect($schoolsQuery);

    return $schoolsResults;
}

function getUserByEmail($Email)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM users WHERE `Email` = ?');
    $request->execute(array($Email));
    $result = $request->fetchAll();
    return $result[0];
}