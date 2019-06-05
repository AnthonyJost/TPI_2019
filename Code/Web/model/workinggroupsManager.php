<?php

function getWorkinggroups($idEvent)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT workinggroups.idWorkinggroups, workinggroups.Title, Cost 
    FROM bdd_satisfevent.WorkingGroups_has_Events 
    INNER JOIN bdd_satisfevent.WorkingGroups 
    ON WorkingGroups_has_Events.WorkingGroups_idWorkingGroups = WorkingGroups.idWorkingGroups 
    WHERE workinggroups_has_events.Events_idEvents = ?');
    $request->execute(array($idEvent));
    $result = $request->fetchAll();
    return $result;
}

function addUserToWorkinggroup($idWG)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    INSERT INTO bdd_satisfevent.users_has_workinggroups 
    SET Users_idUsers = ?, WorkingGroups_idWorkingGroups = ?');
    $request->execute(array($_SESSION['logged']['idUsers'], $idWG));
}

function deleteUserFromWorkinggroups($idWG)
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    DELETE FROM bdd_satisfevent.users_has_workinggroups
    WHERE Users_idUsers = ? AND WorkingGroups_idWorkingGroups = ?');
    $request->execute(array($_SESSION['logged']['idUsers'], $idWG));
}
