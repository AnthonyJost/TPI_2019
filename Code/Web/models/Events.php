<?php
class Events
{
    private $_idEvents;
    private $_title;
    private $_date;

    // Constructeur
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // Hydratation
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    // Setters
    public function setId($idEvents)
    {
        $idEvents = (int) $idEvents;

        if($idEvents > 0)
            $this->_idEvents = $idEvents;
    }

    public function setTitle($title)
    {
        if(is_string($title))
            $this->_title = $title;
    }

    public function setDate($date)
    {
        $this->_date = $date;
    }

    // Getters
    public function idEvents()
    {
        return $this->_idEvents;
    }

    public function title()
    {
        return $this->_title;
    }

    public function date()
    {
        return $this->_date;
    }
}