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
}
