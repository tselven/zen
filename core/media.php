<?php

namespace Core;

use Config\Config;
use Core\Controller;

class Media
{
    protected $cont_type = "";
    protected $aud_type = [
        "mp3" => "audio/mpeg",
        "wav" => "audio/wav",
        "ogg" => "audio/ogg",
        "m4a" => "audio/m4a",
        "m4b" => "audio/m4b",
        "m4p" => "audio/m4p",
        "m4r" => "audio/m4r",
        "m4v" => "audio/m4v",
    ];
    protected $vid_type = [
        "mp4"   => "video/mp4",
        "webm"  => "video/webm",
        "ogg"   => "video/ogg",
        "3gp"   => "video/3gp",
        "3g2"   => "video/3g2",
        "3gpp"  => "video/3gpp",
        "3gpp2" => "video/3gpp2",
        "avi"   => "video/avi",
    ];

    /**
     * @var array $img_type list of supported image formats
     */
    protected $img_type = [
        "jpg"  => "image/jpeg",
        "jfif" => "image/jpeg",
        "png"  => "image/png",
        "gif"  => "image/gif",
        "svg"  => "image/svg+xml",
        "webp" => "image/webp",
        "avif" => "image/avif",
        "heic" => "image/heic",
        "heif" => "image/heif",
        "ico"  => "image/ico"
    ];

    protected $file_type = [
        "css"  => "text/css",
        "js"   => "application/javascript",
        "html" => "text/html",
        "php"  => "text/php",
        "txt"  => "text/plain",
        "json" => "application/json",
        "xml"  => "application/xml",
        "pdf"  => "application/pdf",
        "zip"  => "application/zip",
        "rar"  => "application/rar",
        "7z"   => "application/7z",
        "doc"  => "application/msword",
        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "xls"  => "application/vnd.ms-excel",
        "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "ppt"  => "application/vnd.ms-powerpoint",
    ];

    /**
     * @param string $file Name/ Path to the file.
     */
    function video(string $file)
    {
        $extension = substr($file, strrpos($file, '.') + 1);
        $ftype = $this->vid_type[$extension];
        $path = Config::$root_path . "/assets/videos/" . $file;
        header("Content-Type: $ftype");
        readfile($path);
    }
    function audio(string $file)
    {
        $extension = substr($file, strrpos($file, '.') + 1);
        $ftype = $this->aud_type[$extension];
        $path = Config::$root_path . "/assets/audios/" . $file;
        //echo $path;
        header("Content-Type: $ftype");
        readfile($path);
    }
    function image(string $file)
    {
        $extension = substr($file, strrpos($file, '.') + 1);
        $ftype = $this->img_type[$extension];
        $path = Config::$root_path . "/assets/images/" . $file;
        header("Content-Type: $ftype");
        readfile($path);
    }

    function file(string $file)
    {
        $extension = substr($file, strrpos($file, '.') + 1);
        $ftype = $this->file_type[$extension];
        $path = Config::$root_path . "/assets/files/" . $file;
        header("Content-Type: $ftype");
        readfile($path);
    }
    function serve(string $filename)
    {
        $extension = substr($filename, strrpos($filename, '.') + 1);
        if (isset($this->file_type[$extension])) {
            $cont_type = $this->file_type[$extension];
        } elseif (isset($this->img_type[$extension])) {
            $cont_type = $this->img_type[$extension];
        } elseif (isset($this->aud_type[$extension])) {
            $cont_type = $this->aud_type[$extension];
        } elseif (isset($this->vid_type[$extension])) {
            $cont_type = $this->vid_type[$extension];
        } else {
            //TODO: make this as a unknown type error.
            
            //echo "<h1 style='color:red'>Unknown extension</h1>";
            Controller::error('Debug',[
                "errorMessage" => "Un Supported Media File Extension"
            ]);
        }

        if (!empty($cont_type)) {
            header("Content-Type: {$cont_type}");
            $path = Config::$root_path . "/public" . "/" . $filename;
            readfile($path);
        }
    }
}
