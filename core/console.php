<?php

namespace Core;

class Console
{
    public static function log($message)
    {
        echo $message . "\n";
    }

    public static function run($command)
    {
    }

    /**
     * Create a new Controller by given name or path.
     * paths must relative to controller folder.
     * controllers only can created within controller folder
     * @param string $name - name / path of the controller
     * 
     */
    public function makeController($name)
    {
        // Define the folder path where the file will be created
        $dir = dirname(__DIR__);
        $folderPath = $dir . "/App/controller";
        $conName = explode('.', $name)[0];
        echo $conName . "/";
        if (str_contains('/', $conName)) {
            $arr = explode('/', $conName);
            $conName = $arr[count($arr) - 1];
            echo "Converted: " . $conName;
        }
        $content = <<<PHP
            <?php
            use Core\Controller;
            class {$conName} extends Controller{
                function index(){
                    \$this->view('{$conName}/index');
                }
            }
        PHP;
        $this->make($folderPath, $content, $name);
    }
    /**
     * Create a new model by given name or path.
     * paths must relative to model folder.
     * models only can created within model folder
     * @param string $name - name / path of the model
     * 
     */
    public function makeModel($name)
    {
        $dir = dirname(__DIR__);
        $folderPath = $dir . "/App/models";
        $conName = explode('.', $name)[0];
        $content = <<<PHP
        <?php
        namespace Models;
        use Core\Model;
        class {$conName} extends Model{
            public \$name = "$conName";
            public \$uni = "id";
            public \$fillable = [];
            public \$schema = [];
        }
        PHP;
        $this->make($folderPath, $content, $name);
    }

    public function migrate()
    {
    }
    /**
     * Create a new file in the given folder
     *
     * @param string $path - path to the file creation directory
     * @param string $content - content want to put in file
     * @param string $name - name of file
     *
     * @return bool - true if file creation is successful, false otherwise
     */
    public function make($path, $content, $name)
    {
        // Create the folder structure if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, 0777, true); // Recursive directory creation
        }

        // Specify the filename
        $filename = $path . "/" . $name;

        // Write the contents to the file
        $status = file_put_contents($filename, $content);

        // Return true if file creation is successful, false otherwise
        if ($status) {
            return true; // Success
        } else {
            return false; // Failure
        }
    }
}
