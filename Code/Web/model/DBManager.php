<?php

abstract class Model
{
    private static $_BDD;

    private static function setBDD()
    {
        self::$_BDD = new PDO('mysql:host=localhost;dbname=BDD_SatisfEvent;charset=utf8','root', 'Chau55ette5!');
        self::$_BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBDD()
    {
        if(self::$_BDD == null)
            self::setBDD();
        return self::$_BDD;
    }
}