<?php
require_once('views/View.php');
class ControlerLogin
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->DisplayLogin();
    }


    private function DisplayLogin()
    {
        $this->_view = new View('Login');
        $this->_view->generate(array(null));
    }
}
