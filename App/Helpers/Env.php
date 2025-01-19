<?php

namespace App\Helpers;

class Env{

  private $props;
  public function get($key){
    if(isset($this->props[$key])){
      return $this->props[$key];
    }
    return "Error";
  }

  public function put($key,$value){
      $this->props[$key] = $value;
  }

}
