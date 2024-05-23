<?php
namespace Core;
use Config\Config;
class Scripts{
    public $args = null;
    protected $langs = [
        "py" => "python",
        "js" => "javascript",
        "java" => "java"
    ];
    function run($script){
        if(isset($this->langs[$script])){
            $lang = $this->langs[$script];
            $path = Config::$root_path."/scripts/".$script;
            echo $path;
            $res = exec("{$lang} {$path} {$this->args}");
            echo $res;
        }
    }
}