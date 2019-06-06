<?php

function getEvents()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events ORDER BY Date Desc');
    $request->execute(array());
    $result = $request->fetchAll();
    return $result;
}

function getEvent($idEvent)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT * FROM bdd_satisfevent.events WHERE idEvents = ?');
    $request->execute(array($idEvent));
    $result = $request->fetchAll();
    return $result[0];
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

function getEventByWorkingGroup($idWG)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('SELECT Events_idEvents FROM bdd_satisfevent.workinggroups_has_events WHERE Workinggroups_idWorkinggroups = ?');
    $request->execute(array($idWG));
    $result = $request->fetchAll();
    return $result[0];
}

function getUserWorkinggroups($user, $event)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
        SELECT * FROM users_has_workinggroups
        INNER JOIN workinggroups_has_events on workinggroups_has_events.workinggroups_idworkinggroups = users_has_workinggroups.workinggroups_idworkinggroups
		INNER JOIN workinggroups on workinggroups.idWorkingGroups = users_has_workinggroups.WorkingGroups_idWorkingGroups 
        WHERE users_has_workinggroups.users_idusers = ?
        AND workinggroups_has_events.Events_idEvents = ?'
    );
    $request->execute(array($user, $event));
    $result = $request->fetchAll();
    return $result;
}