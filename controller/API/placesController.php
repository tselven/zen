<?php
use Core\Controller;
use Models\Place;
class PlacesController extends Controller{
    function GET(){
        $place = new Place();
        $data = $place->getAll();
        return $this->JSON($data);
    } 
}