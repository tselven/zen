<?php
use Core\Controller;
class HomeController extends Controller{
    function index(){
        $this->view('index');
    }
}