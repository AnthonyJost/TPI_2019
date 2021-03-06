<?php

// Insert the user info into the DB
function registerNewAccount($FirstName, $LastName, $Email, $Psw, $idSchools){

    $Password = md5($Psw);

    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('INSERT INTO bdd_satisfevent.users (`FirstName`, `LastName`, `Email`, `Password`, `Schools_idSchools`) VALUES(?, ?, ?, ?, ?)');
    $request->execute(array($FirstName, $LastName, $Email, $Password, $idSchools));
}

// Get the schools to insert them into a dropdown list
function getSchools()
{
    $schoolsQuery = 'SELECT * FROM Schools';

    require_once 'model/dbConnector.php';
    $schoolsResults = executeQuerySelect($schoolsQuery);

    return $schoolsResults;
}

// Get the user info based on his email
function getUserByEmail($Email)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM users WHERE `Email` = ?');
    $request->execute(array($Email));
    $result = $request->fetchAll();
    return $result[0];
}

// Get all the users on the DB
function getUsers()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT idUsers, FirstName, LastName, Email, Admin, `Name` FROM bdd_satisfevent.users INNER JOIN bdd_satisfevent.schools ON users.Schools_idSchools = schools.idSchools');
    $request->execute(array());
    $result = $request->fetchAll();
    return $result;
}

// Remove an user from the DB
function removeUser($idUser)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('DELETE FROM bdd_satisfevent.users WHERE idUsers = ?');
    //var_dump($idUser);
    $request->execute(array($idUser));
}