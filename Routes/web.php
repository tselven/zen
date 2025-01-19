<?php

$router->get('/', 'Home@index');
$router->get('/about', 'Page#about');
$router->get('/admin','Admin@index');
$router->post('/contact', 'Contact@send');
$router->put('/profile', 'User@update');
$router->get('/account', function(){
    return view('index');
});