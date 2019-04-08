<?php

//Cannot instantiate an abstract class you need to extend it.
abstract class Animal
{
    public $name;
    public $colour;

    public function describe()
    {
        return $this->name. ' is ' .$this->color;
    }

    abstract public function makeSound();
}

class Duck extends Animal
{
    public function describe()
    {
        return parent::describe();
    }

    public function makeSound(){
        return 'Quack';
    }
}

$animal = new Duck();
$animal->name = 'Ben';
$animal->color = 'Yellow';
echo $animal->makeSound();

?>