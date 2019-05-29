<?php

function getWorkinggroups()
{
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT workinggroups.idWorkinggroups, workinggroups.Title, Cost 
    FROM bdd_satisfevent.WorkingGroups_has_Events 
    INNER JOIN bdd_satisfevent.events 
    ON WorkingGroups_has_Events.Events_idEvents = events.idEvents 
    INNER JOIN bdd_satisfevent.WorkingGroups 
    ON WorkingGroups_has_Events.WorkingGroups_idWorkingGroups = WorkingGroups.idWorkingGroups 
    WHERE events.idEvents = ?');
    $request->execute(array($_GET['idEvents']));
    $result = $request->fetchAll();
    return $result;
}

