<?php

class First
{
    public $id = 21;
    public $name = 'John Doe';
    protected $somethingProtected = 'Protected Property not accessible outside class';

    public function saySomething()
    {
        echo 'Something';
    }
}

class Second extends First
{
    public function getProtected()
    {
        echo $this->somethingProtected;
    }
}

$second = new Second;
echo $second->name;
$second->saySomething();
//Below will result in an error as you cant access a protected variable outside of the class.
//$second->somethingProtected;
$second->getProtected();
?>