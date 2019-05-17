<?php
require_once('views/View.php');
class ControllerLogin
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->Login();
    }


    private function Login()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array(null));
    }
}
