<?php

// Get all the event's into the DB
function getEvents()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events ORDER BY Date Desc');
    $request->execute(array());
    $result = $request->fetchAll();
    return $result;
}

// Get a particular event based on its id
function getEvent($idEvent)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events WHERE idEvents = ?');
    $request->execute(array($idEvent));
    $result = $request->fetchAll();
    return $result[0];
}

// Modify the event previously selected
function modifyEvent($values)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('UPDATE bdd_satisfevent.events SET Title = ?, Date = ? WHERE idEvents = ?');
    $request->execute(array($values['Title'], $values['Date'], $values['idEvents']));
}

// Get an event based on its working groups
function getEventByWorkingGroup($idWG)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT Events_idEvents FROM bdd_satisfevent.workinggroups_has_events WHERE Workinggroups_idWorkinggroups = ?');
    $request->execute(array($idWG));
    $result = $request->fetchAll();
    return $result[0];
}

