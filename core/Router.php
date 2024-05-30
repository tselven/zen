<?php

namespace Core;

use Config\Config;
use Core\Controller;
use Core\Media;

class Router
{
    public $getRoutes = array();
    public $postRoutes = array();
    public $putRoutes = array();
    public $deleteRoutes = array();
    public $routes = array();
    public $dRoutes = array();

    public static function get($uri, $controller)
    {
        $getRoutes[$uri] = $controller;
    }
    public static function post()
    {
    }
    public static function put()
    {
    }
    protected $status;
    /**
     * validate the request route uri and return the error message if not found or pass it to execute() method
     * @param string $uri URI of the request
     */
    function route($uri)
    {

        $public = Config::$root_path . "/public" . $uri;

        if (str_contains($uri, '?')) {
            $uri = explode('?', $uri)[0];
        }
        if (isset($this->routes[$uri])) {
            $str = $this->routes[$uri];
            $this->status = true;
            $this->execute($str);
        } elseif (file_exists($public)) {
            $file = new Media();
            $file->serve($uri);
            $this->status = true;
        } else {
            //check for dynamic routes.
            foreach ($this->dRoutes as $key => $value) {
                $split = explode('|', $key);
                $pip = $split[0];
                $argsR = intval($split[1]);
                $pref = str_replace($pip, '', $uri);
                $exp = explode('/', $pref);
                $argsO = intval(count($exp));
                if (str_contains($uri, $pip) && $argsR == $argsO) {
                    $this->status = true;
                    $data = $this->dRoutes[$key];
                    $this->execute($data);
                    break;
                }
            }
        }
        if ($this->status == false) {
            Controller::view('404');
        }
    }
    /**
     * Load routes
     * @param string $file name of the route file
     */
    public function load($file)
    {
        $path = "Routes/{$file}";
        $cont = file_get_contents($path);
        $info = json_decode($cont, true);
        foreach ($info as $key => $value) {
            if (str_contains($key, '|')) {
                $this->dRoutes[$key] = $value;
            } else {
                $this->routes[$key] = $value;
            }
        }
    }
    function generateSlug($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        $string = trim($string, '-');
        return $string;
    }
    /**
     * Performs route action
     * @param string $str URI
     */
    function execute($str)
    {
        if (str_contains($str, "#")) {
            $arg = str_replace('#', '', $str);
            Controller::view($arg);
        } elseif (str_contains($str, "@")) {
            $parts = explode('@', $str);
            $controller = $parts[0];
            $action = $parts[1];
            if (str_contains($str, '-')) {
                $split = explode('-', $str);
                $controller = explode('-', $controller)[1];
                $path = Config::$root_path . "/controller/" . $split[0] . "/" . $controller . "Controller.php";
            } else {
                $path = Config::$root_path . "/controller/" . $controller . "Controller.php";
            }
            if (file_exists($path)) {
                include $path;
                if (class_exists($controller . "Controller")) {
                    if (str_contains('/', $controller)) {
                        $parts = explode('/', $controller);
                        $last = count($parts) - 1;
                        $controller = $parts[$last] . "Controller";
                    } else {
                        $controller = $controller . "Controller";
                    }
                    $route = new $controller();
                    $route->$action();
                } else {
                    //echo "Error: class not found";
                    Controller::error('404');
                }
            } else {
                echo "Error: file not found";
                Controller::error('404');
            }
        }
    }
}
