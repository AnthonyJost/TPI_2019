<?php
require_once('views/View.php');
class ControllerRegister
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->Register();
    }


    private function Register()
    {
        $this->_view = new View('Register');
        $this->_view->generate(array(null));
    }
}
