<?php
use Core\Controller;

if(!function_exists('hello')){
    function hello($name){
        return 'Hello '.$name;
    }
}

if(!function_exists('view')){
    function view($name){
        $parts = explode('.',$name);
        $path = implode('/',$parts);
        Controller::view($path);
    }
}