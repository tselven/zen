<?php
namespace Models;
use Core\Model;
class users extends Model{
    public $uni = "ID";
    public $name = "users";
    public $fillable = ["username", "password", "name", "email","type"];
    public $schema = [
        "name" => "varchar(25)",
        "type" => "varchar(10)",
        "username" => "varchar(25)",
        "password" => "varchar(15)",
        "email" => "varchar(30)",
        "created_at" => "datetime",
        "last_updated" => "datetime"
    ];
}