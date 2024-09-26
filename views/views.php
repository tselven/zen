<?php
use Config\Config;
function route($uri){
    echo Config::$root_url.$uri;
}

function url($path){
    return Config::$root_url.$path;
}


?>