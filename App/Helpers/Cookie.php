<?php
namespace App\Helpers;

class Cookie{
  protected $props;
  public static function get($key){

  }

  public static function put($key,$value){
    $this->props[$key] = $value;
  }
}
?>
