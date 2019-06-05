<?php

session_start();
require_once "controller/controller.php";

//global $view;
$view = "home";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            $view ='home';
            break;
        case 'displayEvents' :
            ShowEvents();
            $view ='events';
            break;
        case 'registerEvents' :
            choiceEvent();
            break;
        case 'unregisterWorkinggroups' :
            unregisterWorkinggroups();
            ShowEvents();
            $view ='events';
            break;
        case 'displayUsers' :
            showUsers();
            $view ='users';
            break;
        case 'eventsManagement' :
            ShowEvents();
            $view = 'eventsManagement';
            break;
        case 'modifyEvent' :
            eventModifier();
            $view = 'modifyEvent';
            break;
        case 'updateEvent' :
            updateEvent($_POST);
            ShowEvents();
            $view = 'eventsManagement';
            break;
        case 'registerWorkinggroups' :
            registerWorkinggroup();
            ShowEvents();
            $view = 'events';
            break;
        case 'login' :
            $view ='login';
            break;
        case 'loginValidation';
            login();
            $view ='home';
            break;
        case 'logout' :
            logout();
            $view ='home';
            break;
        case 'register' :
            displayRegister();
            $view ='register';
            break;
        case 'registerValidation' :
            register();
            $view ='registerValidation';
            break;
        case 'admin' :
            $view ='admin';
            break;
        case 'deleteUser' :
            deleteUser();
            showUsers();
            $view ='users';
            break;
        default :
            error();
            $view ='error';
    }
}
else {
    $view = 'home';
}

if(!file_exists("views/$view.php")){
    $view = 'error';
}

$title = $view;
ob_start();
require "views/$view.php";
$content = ob_get_clean();

require "views/template.php";