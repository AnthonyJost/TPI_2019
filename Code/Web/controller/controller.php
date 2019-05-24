<?php

function error(){

}

function register()
{
    require_once("model/dbConnector.php");
    require_once("model/usersManager.php");
    registerNewAccount($_POST['inputFirstName'], $_POST['inputLastName'], $_POST['inputEmail'], $_POST['inputPsw'], $_POST['inputSchool']);

    $to      = $_POST['inputEmail'];
    $subject = 'Sujet de test';
    $message = '<h1>Bonjour !</h1> Votre compte est créé.';
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
    if(empty($_POST['inputEmail']) || empty($_POST['inputPsw']))
    {
       header("Location:?action=error");
       exit();
    }

    //db request
    require_once("model/usersManager.php");
    $user = getUserByEmail($_POST['inputEmail']);
    if(empty($user['Email'])){
        header("Location:?action=login&error=Cet+utilisateur+n'existe+pas");
        exit();
    }

    //password comparison
    $Password = md5($_POST['inputPsw']);
    if($Password != $user['Password']){
        var_dump($Password);
        var_dump($user['Password']);
        exit();
        header("Location:?action=login&error=Le mot de passe est incorrect");
        exit();
    }

    //login successful
    $_SESSION['logged'] = $user;
}
