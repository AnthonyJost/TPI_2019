<?php
require_once('views/View.php');
class ControllerEvents
{
    private $_eventsManager;
    private $_view;

    public function __construct($url)
    {
        if(isset($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->events();
    }


    private function events()
    {
        $this->_eventsManager = new EventsManager;
        $events = $this->_eventsManager->getEvents();

        $this->_view = new View('Events');
        $this->_view->generate(array('events' => $events));
    }
}