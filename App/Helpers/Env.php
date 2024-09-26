<?php

namespace App\Helpers;

class Env{

  protected $props;
  public static function get($key){
    if(isset($this->props[$key]){
      return $this->props[$key];
    }
    return "Error";
  }

  public static function put($key,$value){
      $this->props[$key] = $value;
  }

}
