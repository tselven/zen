<?php
namespace App\Middleware;

class Auth{
    public function __invoke(){
        echo "Authentication Checked!";
    }
}