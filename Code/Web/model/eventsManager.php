<?php

function getEvents()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events ORDER BY Date Asc');
    $request->execute(array());
    $result = $request->fetchAll();
    return $result;
}

function getModifyEvent()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events WHERE idEvents = ?');
    $request->execute(array($_GET["idEvents"]));
    $result = $request->fetchAll();
    return $result[0];
}

function modifyEvent($values)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('UPDATE bdd_satisfevent.events SET Title = ?, Date = ? WHERE idEvents = ?');
    $request->execute(array($values['Title'], $values['Date'], $values['idEvents']));
}

function getEventTitle()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT Title FROM bdd_satisfevent.events WHERE idEvents = ?');
    $request->execute(array($_GET['idEvents']));
    $result = $request->fetchAll();
    return $result[0];
}