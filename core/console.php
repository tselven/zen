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

    public function makeController($name)
    {
        // Define the folder path where the file will be created
        $dir = dirname(__DIR__);
        $folderPath = $dir."/controller";
        $conName = explode('.',$name)[0];
        echo $conName."/";
        if(str_contains('/',$conName)){
            $arr = explode('/',$conName);
            $conName = $arr[count($arr)-1];
            echo "Converted: ".$conName;
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
        $this->make($folderPath, $content,$name);
    }

    public function makeModel($name)
    {
        $dir = dirname(__DIR__);
        $folderPath = $dir."/models";
        $conName = explode('.',$name)[0];
        $content = <<<PHP
        <?php
        namespace Models;
        use Core\Model;
        class Events extends Model{
            
        }
        PHP;
        $this->make($folderPath, $content,$name);
    }

    public function migrate()
    {
    }

    public function make($path, $content,$name)
    {
        // Create the folder structure if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, 0777, true); // Recursive directory creation
        }

        // Specify the filename
        $filename = $path . "/" .$name;
        // Write the contents to the file
        $status = file_put_contents($filename, $content);
        if($status){
            return true; // Success
        }else{
            return false; // Failure
        }
    }
}
