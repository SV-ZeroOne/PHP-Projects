<?php

spl_autoload_register(function($class_name){
    include $class_name . 'php';
});

    $myVar1 = "Hello";
    echo $myVar1 . " Steve";
?>