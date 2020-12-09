<?php

class animal
{
    private $name;

    // traditional setters and getters
    // public function setName($name)
    // {
    //     $this->name = $name;
    // }

    // public function getName()
    // {
    //     return $this->name;
    // }

    // // animal constructors
    // function __construct()
    // {
    //     // some code here
    // }

    //vs

    public function __construct($name)
    {
        $this->name = $name;
        echo $this->name;
    }
}

// $dog = new animal();
// $dog->setName("spot");
// echo $dog->getName();

// vs

$dog = new animal("spot");
