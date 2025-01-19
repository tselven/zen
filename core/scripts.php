<?php

namespace Core;

use Config\Config;

class Scripts
{
    public $args = null;
    protected $langs = [
        "py" => "python",
        "js" => "node",
        "java" => "java", 
        "go" => "go run"
    ];
    function run($script,$args = null)
    {
        $ext = explode(".",$script)[1];
        if (isset($this->langs[$ext])) {
            $lang = $this->langs[$ext];
            $path = Config::$root_path . "/App/scripts/" . $script;

            $res = exec("{$lang} {$path} {$this->args}");
            return $res;
        }
        else{
            Controller::error('500');
        }
    }
}
