<?php

session_start();
require_once "controller/controller.php";

$view = "home";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            $view ='home';
            break;
        case 'displayEvents' :
            $view ='events';
            break;
        case 'displayUsers' :
            $view ='users';
            break;
        case 'login' :
            $view ='login';
            break;
        case 'loginValidation';
            $view ='home';
            login();
            break;
        case 'logout' :
            $view ='home';
            logout();
            break;
        case 'register' :
            $view ='register';
            break;
        case 'registerValidation' :
            $view ='registerValidation';
            register();
            break;
        case 'admin' :
            $view ='admin';
            admin();
            break;
        default :
            $view ='error';
            error();
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