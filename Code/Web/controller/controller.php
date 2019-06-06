<?php
/*
 * Events related section start
 */

// Get all events in order to display them
function showEvents(){
    global $events;
    require_once 'model/eventsManager.php';
    $events = getEvents();
}

// Get the infos of the event the admin wants to modify
function eventModifier(){
    global $modifyEvent;
    require_once "model/eventsManager.php";
    $modifyEvent = getModifyEvent();
}

// Send the new data to the database in order to update the event
function updateEvent($values){
    global $events;
    require_once("model/eventsManager.php");
    $events = modifyEvent($values);
}

// Get the title of the selected event and all the working groups contains in it
function registerEvents(){
    require_once("model/eventsManager.php");
    getEventTitle($_GET['idEvents']);
    require_once("model/workinggroupsManager.php");
    getWorkinggroups($_GET['idEvents']);
}

// Function which determine the correct action to do based on the event date and the user inscription
function choiceEvent(){
    global $event, $workingGroups, $registeredWG, $formSent;
    require_once 'model/eventsManager.php';
    require_once("model/workinggroupsManager.php");

    // Get event info
    $event = getEvent($_GET['idEvents']);

    // Verify if the user is already registered in a working group of the event
    $userWorkinggroups = getUserWorkinggroups($_SESSION['logged']['idUsers'], $_GET['idEvents']);
    $workingGroups = getWorkinggroups($event["idEvents"]);
    $eventDate = strtotime($event["Date"]);
    $currentDate = time();
    if($eventDate <= $currentDate){ // Past event
        if(count($userWorkinggroups) == 0){ // User is not register to a working group
            echo "evenement passé";
            // Redirection
            return;
        }
        $wGId = getWGId($_SESSION['logged']['idUsers'], $_GET['idEvents']);
        $formSent = isformSent($_SESSION['logged']['idUsers'], $_GET['idEvents'], $wGId);
        if(count($formSent) == 0){
            $GLOBALS['view'] = "satisform";
            // Redirection
            return;
        }
        echo "Formulaire déjà rempli";
        return;
    }

    // Prepare ids
    $registeredWG = array();
    foreach($userWorkinggroups as $uwg){ // uwg means User Working Group
        array_push($registeredWG, $uwg["WorkingGroups_idWorkingGroups"]);
    }
    $GLOBALS['view'] ='registerEvents';
}
/*
 * Events related section end
 */

/*
 * Users related section start
 */

// Verify that all the infos entered are correct, store them on the database and send an email to inform the user he is registered
function register(){
    require_once("model/dbConnector.php");
    require_once("model/usersManager.php");

    // Function call
    verifyPassword($_POST['inputPsw']);
    registerNewAccount($_POST['inputFirstName'], $_POST['inputLastName'], $_POST['inputEmail'], $_POST['inputPsw'], $_POST['inputSchool']);

    // Email function
    $to      = $_POST['inputEmail'];
    $subject = 'Sujet de test';
    $message = '<h1>Bonjour !</h1> Votre compte a bien été créé.';
    $headers = 'From: anthony.jost@cpnv.ch' . "\r\n" .
        'Reply-To: anthony.jost@cpnv.ch' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}

// Delete the user based on the user id selected
function deleteUser(){
    require_once("model/usersManager.php");
    removeUser($_GET['idUsers']);
}

// Get all users on the database to display them for the admin
function showUsers(){
    global $users;
    require_once "model/usersManager.php";
    $users = getUsers();
}

// Get all schools on the database in order to use them on the register form
function displayRegister(){
    global $schools;
    require_once "model/usersManager.php";
    $schools = getSchools();
}
/*
 * Users related section end
 */

/*
 * Working groups related section start
 */

// Add the user to a working group
function registerWorkinggroup(){
    global $event;
    require_once("model/eventsManager.php");

    // Get all the working groups related to the event the user click on
    $event = getEventByWorkingGroup($_GET['idWorkinggroups']);
    $isRegisterPossible = getUserWorkinggroups($_SESSION['logged']['idUsers'], $event['Events_idEvents']);

    // Verify if the user is not already registered in a working group which is a member of the event selected
    if(count($isRegisterPossible) == 0){
        require_once 'model/workinggroupsManager.php';

        // Add the user to the working group
        addUserToWorkinggroup($_GET['idWorkinggroups']);
        return;
    }
    echo "Vous ne pouvez pas vous inscrire à deux ateliers concernant le même événement";
}

// Call the function which will remove the user form the working group he was part of
function unregisterWorkinggroups(){
    require_once 'model/workinggroupsManager.php';
    deleteUserFromWorkinggroups($_GET['idWorkinggroups']);
}

// Call the function which will enter the form data into the database
function sendForm(){
    require_once 'model/workinggroupsManager.php';
    dataForm($_POST['Material'], $_POST['Activity'], $_POST['Place'], $_POST['Hours'], $_POST['Satisfaction'], $_POST['Suggestion']);
    $idStat = getStatId();
    userHasStat($idStat);
    wGHasStats($_POST['idWorkinggroups'], $idStat);
}
/*
 * Working groups related section end
 */

/*
 * Session related section start
 */

// Create a session based on the user email address
function createSession($userEmailAddress){
    $_SESSION['userEmailAddress'] = $userEmailAddress;
    // The userType variable define if the admin menu has to be displayed
    $userType = getUserType($userEmailAddress);
    $_SESSION['userType'] = $userType;
}

// Unset the session and redirect the user to the homepage
function logout(){
    unset($_SESSION['logged']);
    header("Location:?action=home");
    exit();
}

// Verify the data entered by the user in order to log him in
function login(){
    // Entry test
    if (empty($_POST['inputEmail']) || empty($_POST['inputPsw'])){
        header("Location:?action=error");
        exit();
    }

    // Db request
    require_once("model/usersManager.php");
    $user = getUserByEmail($_POST['inputEmail']);

    // Verify that the user exists
    if (empty($user['Email'])){
        header("Location:?action=login&error=Cet+utilisateur+n'existe+pas");
        exit();
    }

    // Password comparison
    $Password = md5($_POST['inputPsw']);
    if ($Password != $user['Password']){
        header("Location:?action=login&error=Le mot de passe est incorrect");
        exit();
    }
    // Login successful
    $_SESSION['logged'] = $user;
}
/*
 * Session related section end
 */

/*
 * Miscellaneous section start
 */
function error(){

}

function showStats(){
    require_once 'model/statsManager.php';
    getStats();
}

// Verify the password respect criteria
function verifyPassword($verifyPassword){
    // Length criterion
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
/*
 * Miscellaneous section end
 */