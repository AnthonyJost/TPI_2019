<?php

function registerNewAccount($FirstName, $LastName, $Email, $Psw, $Schools_idSchools){
    $result = false;

    $strSeparator = '\'';

    $Password = password_hash($Psw, PASSWORD_DEFAULT);

    $registerQuery = 'INSERT INTO users (`FirstName`, `LastName`, `Email`, `Password`, `Schools_idSchools`) VALUES (' .$strSeparator . $FirstName .$strSeparator . ',' .$strSeparator . $LastName .$strSeparator . ',' .$strSeparator . $Email .$strSeparator . ','.$strSeparator . $Password .$strSeparator. ','.$strSeparator . $Schools_idSchools .$strSeparator. ')';

    require_once 'model/Model.php';
    $queryResult = executeQueryInsert($registerQuery);
    if($queryResult){
        $result = $queryResult;
    }
    return $result;
}

function getUserType($Email){
    $result = 0;//we fix the result to 1 -> customer

    $strSeparator = '\'';

    $getUserTypeQuery = 'SELECT admin FROM users WHERE users.Email =' . $strSeparator . $Email . $strSeparator;

    require_once 'model/Model.php';
    $queryResult = executeQuerySelect($getUserTypeQuery);

    if (count($queryResult) == 1){
        $result = $queryResult[1]['admin'];
    }
    return $result;
}