<?php
namespace Config;
session_start();

/**
 * @category Configuration
 */
// Function to autoload classes from a directory and its subdirectories
function autoloadClasses($dir) {
    // Check if the directory exists
    if (!is_dir($dir)) {
        // Output an error message and return
        echo "Error: Directory '$dir' not found.\n";
        return;
    }

    // Get all files and directories under the specified directory
    $files = scandir($dir);

    // Iterate over each file/directory
    foreach ($files as $file) {
        // Skip current and parent directory links
        if ($file == '.' || $file == '..') continue;

        // Construct the full path
        $path = $dir . '/' . $file;

        // If the current item is a directory, recursively autoload from it
        if (is_dir($path)) {
            autoloadClasses($path);
        }
        // If the current item is a PHP file, include it
        elseif (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) == 'php') {
            include_once $path;
        }
    }
}
autoloadClasses(__DIR__.'\core');
autoloadClasses(__DIR__.'\models');
class Config
{
    public static $root_url;
    public static $root_path;
    public static function init()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        self::$root_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
        self::$root_path = $_SERVER['DOCUMENT_ROOT'];
    }
}
Config::init();
use Core\Helper;
Helper::load_env();

ini_set("SMTP",$_ENV['SMTP_HOST']);
ini_set("SMTP_PORT",$_ENV['SMTP_PORT']);
