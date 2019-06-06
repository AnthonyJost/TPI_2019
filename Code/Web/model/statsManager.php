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

    $material = [];
    $data = [];
    while ($row = $request->fetch(PDO::FETCH_ASSOC)){
        //[ind, count]
        array_push($material, $row['Material']);
        array_push($data, $row['Material']);
    }

}
