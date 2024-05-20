<?php

namespace Core;
use Core\Interfaces\ModelInterface;

class Model
{
    public $name;
    public $uni;
    public $query;

    /**
     * Return all rows in the database
     * @return array Data rows in the database
     */
    function getAll()
    {
        $this->query = "SELECT * FROM $this->name";
        return $this->get();
    }
    function getOne($id)
    {
        $this->query = "SELECT * FROM {$this->name} WHERE {$this->uni} LIKE '%{$id}%'";
        return $this->get();
    }
    function delete($id)
    {
        $this->query = "DELETE FROM {$this->name} WHERE {$this->uni}='{$id}'";
        $this->run();
    }


    function insert(array $data){
        $this->query = "INSERT INTO {$this->name} ($) values (?)";
        $temp = null;
        $keys = null;
        foreach($data as $key => $value){
            $temp .= "'{$value}',";
            $keys .= "{$key},";
        }
        $values = trim($temp,",");
        $this->query = str_replace("?",$values,$this->query);
        $keys = trim($keys,",");
        $this->query = str_replace("$",$keys,$this->query);
        //echo $this->query;
        $this->run();
    }
    function update(array $data,$id){
        $this->query = "UPDATE {$this->name} SET ? WHERE {$this->uni} = '{$id}'";
        $temp = null;
        foreach($data as $key => $value){
            $temp .= "{$key} = '{$value}'";
        }
        $this->query = str_replace("?",$temp,$this->query);
        $this->run();
    }
    function select($columns)
    {
        $this->query = "SELECT $columns FROM " . $this->name;
        return $this;
    }

    /**
     * Order by column
     * @param string $column Name of column
     * @param string $order Ascending or Descending [Default: ascending]
     * @return $this DB object
     */
    function order($column, $order = "")
    {
        $this->query .= " ORDER BY $column";
        return $this;
    }

    /**
     * filter & select data by column
     */
    function where($where)
    {
        $this->query .= " WHERE $where";
        return $this;
    }

    /**
     * Limit the number of rows to be returned
     * @param int $num number of rows
     */
    function limit($num){
        $this->query .= " LIMIT $num";
        return $this;
    }
    /**
     * To perform the filtering / pagination
     * @param number $limit number of rows to be returned
     * @param number $offset number of rows to skip from beginning.
     * @return object $this This object use for method chaining
     */
    function paginate($limit,$offset){
        $this->query = " LIMIT $limit OFFSET $offset";
        return $this;
    }

    function getClosest($long,$lat,$distance = 10)
    {
        $this->query = "SELECT 
        *,
        (6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($long)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance
    FROM 
        {$this->name}
    HAVING 
        distance <= $distance
    ORDER BY 
        distance;";

        return $this->get();
    }
    

    function getCols(){
        $this->query = "SHOW COLUMNS FROM {$this->name}";
        $res = $this->get();
        foreach ($res as $r){
            $data[] = $r['Field'];
        }
        return $data;
    }

    /**
     * Execute the query.
     */
    function run():bool{
        $con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
        $result = mysqli_query($con, $this->query);
        if ($result) {
            return true;
        } else {
            return mysqli_error($con);
        }
        mysqli_close($con);
    }

    /**
     * Execute the query and return the result
     */
    function get(){
        $con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
        $res = mysqli_query($con, $this->query);
        if ($res) {
            if(mysqli_num_rows($res)){
                while ($row = mysqli_fetch_assoc($res)) {
                    $data[] = $row;
                }
                return $data;
            }
            else{
                return "No results found";
            }
           
        } else {
            echo mysqli_error($con);
        }
        mysqli_close($con);
    }
}
