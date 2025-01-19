<?php
namespace Models;
use Core\Model;
class migrations extends Model{
    public $name = "migrations";
    public $uni = "id";
    public $fillable = [];
    public $block = [];
    public $schema = [
        "id" => "int",
        "migration" => "varchar",
        "batch" => "int",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
        "deleted" => "boolean"
    ];
}