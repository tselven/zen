<?php

namespace Core;

use Closure;
use Config\Config;
use Core\Controller;
use Core\Media;
use Core\Authenticate;

class Router
{
    private $routes = [];
    private $dRoutes = [];
    private $status = false;

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
        return $this;
    }

    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
        return $this;
    }

    /**
     * Register a PUT route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
        return $this;
    }

    /**
     * Register a DELETE route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
        return $this;
    }

    /**
     * Middleware support (to be implemented).
     *
     * @param string $name
     */
    public function middleware($name)
    {
        try {
            if (!isset($_ENV['MIDDLEWARE'][$name])) {
                throw new \Exception("Middleware not found: {$name}");
            }
        
            $mid = $_ENV['MIDDLEWARE'][$name];
            echo $mid;
        } catch (\Exception $e) {
            Controller::error('Debug', [
                "errorMessage" => $e->getMessage(),
                "stackTrace"   => $e->getTraceAsString() // Use getMessage() to retrieve the exception message
            ]);
        }
        
    }

    /**
     * Handle the routing of incoming requests.
     *
     * @param string $uri
     * @param string $method
     */
    public function route($uri, $method)
    {
        //var_dump($this->routes[$method][$uri]);
        Authenticate::filter();

        // Remove query string from URI
        $uri = strtok($uri, '?');

        // Match regular routes
        if (isset($this->routes[$method][$uri])) {
            $this->status = true;
            $this->execute($this->routes[$method][$uri]);
            return;
        }

        // Match dynamic routes
        foreach ($this->dRoutes as $pattern => $controller) {
            if (preg_match($pattern, $uri, $matches)) {
                $this->status = true;
                $this->execute($controller, $matches);
                return;
            }
        }

        // Serve static files if they exist
        $public = Config::$root_path . "/public" . $uri;
        if (file_exists($public)) {
            $file = new Media();
            $file->serve($uri);
            $this->status = true;
            return;
        }

        // If no match is found, return a custom error response
        if (!$this->status) {
            throw new \Exception("Route Not Found");
        }
    }

    /**
     * Load routes from a PHP file.
     *
     * @param string $file
     */
    public function load($file)
    {
        $path = Config::$root_path . "/Routes/{$file}";
        if (file_exists($path)) {
            $router = $this;
            include $path;
        }
    }

    /**
     * Generate a slug from a string.
     *
     * @param string $string
     * @return string
     */
    public function generateSlug($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        return trim($string, '-');
    }

    /**
     * Execute the route action.
     *
     * @param string $controllerAction
     * @param array $params
     */
    private function execute($controllerAction, $params = [])
    {
        //var_dump($controllerAction);
        if($controllerAction instanceof Closure){
            return call_user_func($controllerAction);
        }
        if (str_contains($controllerAction, "#")) {
            // Serve a view directly
            $view = str_replace('#', '', $controllerAction);
            Controller::view($view);
        } elseif (str_contains($controllerAction, "@")) {
            // Execute a controller action
            list($controller, $action) = explode('@', $controllerAction);
            $controllerClass = $controller . "Controller";
            $controllerPath = Config::$root_path . "/App/Controller/" . $controllerClass . ".php";

            if (file_exists($controllerPath)) {
                include_once $controllerPath;

                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();
                    if (method_exists($controllerInstance, $action)) {
                        call_user_func_array([$controllerInstance, $action], $params);
                    } else {
                        Controller::error('Debug', [
                            "errorMessage" => "Method Not Found"
                        ]);
                    }
                } else {
                    throw new \Exception("Controller Class Not Found");
                }
            } else {
                    throw new \Exception("Controller File Not Found");
            }
        } else {
            throw new \Exception("Invalid Route Action");
        }
    }
}