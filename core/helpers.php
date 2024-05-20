<?php
namespace Core;
use Config\Config;

class Helper{
    function view($name){
        header("Content-Type: text/html; charset=UTF-8");
        $page = include "./views/{$name}View.php";
        return $page;
    }
    public static function route($path){
        echo Config::$root_url.$path;
    }
    public static function url($path){
        return Config::$root_url.$path;
    }
    public static function reduceParagraph($paragraph) {
        $words = explode(' ', $paragraph);
        $reduced = implode(' ', array_slice($words, 0, 20))." ...";
        return $reduced;
    }
    public static function load_env($file_path = '.env') {
        $env_vars = [];
        if (file_exists($file_path)) {
            $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') !== 0) {
                    list($key, $value) = explode('=', $line, 2);
                    $env_vars[trim($key)] = trim($value);
                }
            }
            // Merge loaded variables with $_ENV
            $_ENV = array_merge($_ENV, $env_vars);
        } else {
            return '.env file not found.';
        }
        return $env_vars;
    }

}