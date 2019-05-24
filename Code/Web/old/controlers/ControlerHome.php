<?php
require_once('views/View.php');
class ControlerHome
{
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->DisplayHome();
    }


    private function DisplayHome()
    {
        $this->_view = new View('Home');
        $this->_view->generate(array(null));
    }
}
