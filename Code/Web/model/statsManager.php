<?php
function getStats($idWG)
{
    require_once('model/dbConnector.php');
    $connexion = openDBConnexion();
    $request = $connexion->prepare('
    SELECT Material, Activity, Place, Hours, Satisfaction
    FROM bdd_satisfevent.workinggroups_has_statistics
    INNER JOIN statistics ON statistics.idStatistics = statistics_idStatistics
    WHERE WorkingGroups_idWorkingGroups = ?');
    $request->execute(array($idWG));

    $statsName = ["Material", "Activity", "Place", "Hours", "Satisfaction"];

    global $stats;
    $stats = [];
    while ($row = $request->fetch(PDO::FETCH_ASSOC)) {
        foreach ($statsName as $statName){
            if(!isset($stats[$statName])){
                $stats[$statName] = [];
            }
            if (!isset($stats[$statName][$row[$statName]])) {
                $stats[$statName][$row[$statName]] = 0;
            }
            $stats[$statName][$row[$statName]]++;
        }
    }
}
