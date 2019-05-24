<?php
require_once('views/View.php');
class ControlerRegister
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->DisplayRegister();

    }


    private function DisplayRegister()
    {
        $this->_registerManager = new RegisterManager;
        $register = $this->_registerManager->getSchools();

        $this->_view = new View('Register');
        $this->_view->generate(array('schools' => $register));
    }

    function register($registerRequest){
        //variable set
        if (isset($registerRequest['inputFirstName']) && isset($registerRequest['inputLastName']) && isset($registerRequest['inputEmail']) && isset($registerRequest['inputPassword']) && isset($registerRequest['inputPasswordRepeat']) && isset($registerRequest['inputSchool'])) {

            //extract register parameters
            $FirstName = $registerRequest['inputFirstName'];
            $LastName = $registerRequest['inputLastName'];
            $Email = $registerRequest['inputEmail'];
            $Psw = $registerRequest['inputPassword'];
            $PasswordRepeat = $registerRequest['inputPasswordRepeat'];
            $Schools_idSchools = $registerRequest['inputSchool'];

            if ($Psw == $PasswordRepeat){
                require_once "model/usersManager.php";
                if (registerNewAccount($FirstName, $LastName, $Email, $Psw, $Schools_idSchools)){
                    createSession($Email);
                    $_GET['registerError'] = false;
                    $_GET['action'] = "Home";
                    require "view/view".$_GET['action'].".php";
                }
            }else{
                $_GET['registerError'] = true;
                $_GET['action'] = "Register";
                require "view/view".$_GET['action'].".php";
            }
        }else{
            $_GET['action'] = "Register";
            require "view/view".$_GET['action'].".php";
        }
    }

    function createSession($Email){
        $_SESSION['Email'] = $Email;
        //set user type in Session
        $userType = getUserType($Email);
        $_SESSION['userType'] = $userType;
    }

}
