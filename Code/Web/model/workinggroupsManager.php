<?php
// Get the working groups of an event
function getWorkinggroups($idEvent){
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

// Add an user in a working group
function addUserToWorkinggroup($idWG){
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    INSERT INTO bdd_satisfevent.users_has_workinggroups 
    SET Users_idUsers = ?, WorkingGroups_idWorkingGroups = ?');
    $request->execute(array($_SESSION['logged']['idUsers'], $idWG));
}

// Remove an user from a working group
function deleteUserFromWorkinggroups($idWG){
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    DELETE FROM bdd_satisfevent.users_has_workinggroups
    WHERE Users_idUsers = ? AND WorkingGroups_idWorkingGroups = ?');
    $request->execute(array($_SESSION['logged']['idUsers'], $idWG));
}

// Insert the data of the satisfaction form
function dataForm($Material, $Activity, $Place, $Hours, $Satisfaction, $Suggestion){
    require_once 'model/dbConnector.php';
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    INSERT INTO bdd_satisfevent.statistics
    SET Material = ?, Activity = ?, Place = ?, Hours = ?, Satisfaction = ?, Suggestion = ?');
    $request->execute(array($Material, $Activity, $Place, $Hours, $Satisfaction, $Suggestion));
}

// Get the id of the most recent statistic entered
function getStatId(){
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT idStatistics FROM bdd_satisfevent.statistics
    ORDER BY idStatistics DESC LIMIT 1 ');
    $request->execute(array());
    $result = $request->fetchAll();
    return $result[0]['idStatistics'];
}

// Insert the references of the stats
function userHasStat($idStat){
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    INSERT INTO bdd_satisfevent.statistics_has_users
    SET users_idusers = ?, Statistics_idStatistics = ?');
    $request->execute(array($_SESSION['logged']['idUsers'], $idStat));
}

// Insert the references of the stats
function wGHasStats($idWG, $idStat){
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    INSERT INTO bdd_satisfevent.workinggroups_has_statistics
    SET WorkingGroups_idWorkingGroups = ?, Statistics_idStatistics = ?');
    $request->execute(array($idWG, $idStat));
}

// Get the working group id base on the user and the event
function getWGId($idUser, $idEvent){
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT WorkingGroups_has_Events.workinggroups_idWorkingGroups FROM bdd_satisfevent.WorkingGroups_has_Events
    INNER JOIN users_has_workinggroups ON users_has_workinggroups.workinggroups_idWorkingGroups = workinggroups_has_events.workinggroups_idWorkingGroups
    WHERE users_idUsers = ?
    AND events_idEvents = ?');
    $request->execute(array($idUser, $idEvent));
    $result = $request->fetchAll();
    return $result[0]['workinggroups_idWorkingGroups'];
}

// Verify if a form has already been sent for a working group
function isFormSent($idUser, $idEvent, $idWG){
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT workinggroups_has_statistics.statistics_idStatistics, users_idUsers, workinggroups_has_statistics.WorkingGroups_idWorkingGroups, Events_idEvents
    FROM bdd_satisfevent.workinggroups_has_statistics
    INNER JOIN statistics_has_users ON statistics_has_users.statistics_idStatistics = workinggroups_has_statistics.statistics_idStatistics
    INNER JOIN workinggroups_has_events ON workinggroups_has_events.WorkingGroups_idWorkingGroups = workinggroups_has_statistics.WorkingGroups_idWorkingGroups
    WHERE users_idUsers = ?
    AND workinggroups_has_statistics.WorkingGroups_idWorkingGroups = ?
    AND Events_idEvents = ?');
    $request->execute(array($idUser, $idWG, $idEvent));
    $result = $request->fetchAll();
    return $result;
}

// Get an user's working group
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