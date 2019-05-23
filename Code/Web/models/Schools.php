<?php
class Schools
{
    private $_idSchools;
    private $_name;

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
    public function setIdSchools($idSchools)
    {
        $idSchools = (int) $idSchools;

        if($idSchools > 0)
            $this->_idSchools = $idSchools;
    }

    public function setName($name)
    {
        if(is_string($name))
            $this->_name = $name;
    }

    // Getters
    public function idSchools()
    {
        return $this->_idSchools;
    }

    public function name()
    {
        return $this->_name;
    }
}