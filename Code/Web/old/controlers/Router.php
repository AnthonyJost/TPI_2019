<?php
require_once('views/View.php');

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try
        {
            //Chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });

            $url = array();

            // Le controleur est inclus selon l'action de l'utilisateur
            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controler = ucfirst(strtolower($url[0]));
                $controlerClass = "controler".$controler;
                $controlerFile = "controlers/".$controlerClass.".php";

                if(file_exists($controlerFile))
                {
                    require_once($controlerFile);
                    $this->_ctrl = new $controlerClass($url);
                }
                else
                    throw new Exception('Page introuvable');
            }
            else
            {
                require_once('controlers/controlerRegister.php');
                $this->_ctrl = new controlerRegister($url);
            }
        }
        // Gestion des erreurs
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}