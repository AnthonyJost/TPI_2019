<?php

function error(){

}

function register()
{
    require_once("model/dbConnector.php");
    require_once("model/usersManager.php");
    verifyPassword($_POST['inputPsw']);
    registerNewAccount($_POST['inputFirstName'], $_POST['inputLastName'], $_POST['inputEmail'], $_POST['inputPsw'], $_POST['inputSchool']);

    $to      = $_POST['inputEmail'];
    $subject = 'Sujet de test';
    $message = '<h1>Bonjour !</h1> Votre compte a bien été créé.';
    $headers = 'From: anthony.jost@cpnv.ch' . "\r\n" .
        'Reply-To: anthony.jost@cpnv.ch' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    $userType = getUserType($userEmailAddress);
    $_SESSION['userType'] = $userType;
}

function logout(){
    unset($_SESSION['logged']);
    header("Location:?action=home");
    exit();
}

function login()
{
    //entry test
    if (empty($_POST['inputEmail']) || empty($_POST['inputPsw'])) {
        header("Location:?action=error");
        exit();
    }

    //db request
    require_once("model/usersManager.php");
    $user = getUserByEmail($_POST['inputEmail']);
    if (empty($user['Email'])) {
        header("Location:?action=login&error=Cet+utilisateur+n'existe+pas");
        exit();
    }

    //password comparison
    $Password = md5($_POST['inputPsw']);
    if ($Password != $user['Password']) {
        header("Location:?action=login&error=Le mot de passe est incorrect");
        exit();
    }

    //login successful
    $_SESSION['logged'] = $user;
}

function verifyPassword($verifyPassword)
{
    if(strlen($verifyPassword) < 8){
       header("Location:?action=register&error=Le mot de passe est trop court");
       exit();
    }

    /*if(!preg_match('/(.*[-\da-zA-z+!?*%&\/()[\]\\\#=_<>]).{8,}/', $verifyPassword)){
        header("Location:?action=register&error=Le mot de passe ne correspond pas aux critères");
        exit();
    }*/
    //preg_match('/(.*[-\da-zA-z+!?*%&\/()[\]\\\#=_<>]).{8,}/', $input_line, $output_array);

}

function deleteUser()
{
    require_once("model/usersManager.php");
    removeUser($_GET['idUsers']);
}

function updateEvent($values)
{
    require_once("model/eventsManager.php");
    modifyEvent($values);
}

function registerEvents()
{
    require_once("model/eventsManager.php");
    getEventTitle($_GET['idEvents']);
    require_once("model/workinggroupManager.php");
    getWorkinggroup();
}
