<?php
namespace Core\Interfaces;

interface ModelInterface{
    public function __construct();
    public function insert(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function select($array);
    public function getAll();
    public function getOne($id);
    public function limit($num);
    public function where(array $data);
    public function offset();
    public function orderBy();
    public function groupBy();

}