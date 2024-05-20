<?php

namespace Core;

use Config\Config;

class Media
{
    private $aud_type = [
        "mp3" => "audio/mpeg",
        "wav" => "audio/wav",
        "ogg" => "audio/ogg",
        "m4a" => "audio/m4a",
        "m4b" => "audio/m4b",
        "m4p" => "audio/m4p",
        "m4r" => "audio/m4r",
        "m4v" => "audio/m4v",
    ];
    private $vid_type = [
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
    private $img_type = [
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

    private $file_type = [
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

    function file(string $file){
        $extension = substr($file, strrpos($file, '.') + 1);
        $ftype = $this->file_type[$extension];
        $path = Config::$root_path . "/assets/files/" . $file;
        header("Content-Type: $ftype");
        readfile($path);
    }
}
