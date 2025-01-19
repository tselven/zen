<?php
use Core\Controller;
class HomeController extends Controller{
    function index(){
        return view('index');
    }
}