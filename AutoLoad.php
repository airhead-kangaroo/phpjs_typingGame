<?php

class AutoLoad{

  public function __construct(){
    if(strpos(dirname(__FILE__), 'class')){
      spl_autoload_register(array($this,'requireFile'));
    }else{
      spl_autoload_register(array($this,'requireFile'));
    }
  }

  private function requireFile($class){
    require_once (__DIR__ . '/class/' . $class . '.php');
  }

  private function requireFileFromClass($class){
    require_once (__DIR__ . '/' . $class . '.php');
  }
}
