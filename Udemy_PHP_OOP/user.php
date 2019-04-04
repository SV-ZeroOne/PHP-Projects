<?php

class User
{
    //if you leave out the public on the function it defaults to public

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct()
    {
        //Used to configure classes on instantiation.
        echo 'Constructor Called';
    }

    public function register()
    {
        echo 'User Registered';
    }

    public function login($username, $password)
    {
        $this->username = $username;
        $this->$password = $password;
        $this->auth_user($username, $password);
    }

    public function __destruct()
    {
        //Used when object is no longer in use.
        //Useful for closing database connections.
        echo 'Destructor Called';
    }

    public function auth_user()
    {
        echo $this->$username . ' is authenticated';
    }
}

$user = new User;
//$user->register();
$user->login("Steve", "Pass1234")
?>