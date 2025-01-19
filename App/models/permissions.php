<?php
namespace Models;
use Core\Model;
class permissions extends Model{
    public $name = "permissions";
    public $uni = "id";
    public $fillable = [];
    public $schema = [
        "id" => "int",
        "permissions" => "json"
    ];
}