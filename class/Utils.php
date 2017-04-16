<?php

class Utils{

  public static function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
  }

  public static function hh(array $array){
    $returnArray = [];
    foreach($array as $key => $data){
      $returnArray[$key] = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    return $returnArray;
  }

  public static function stageSelector(int $stage = null){
    switch ($stage) {
      case 0:
        return '初級';
      case 1:
        return '中級';
      case 2:
        return '上級';
    }
  }

  public static function authSelector(int $auth = null){
    switch ($auth) {
      case 1:
        return 'ユーザー';
      case 2:
        return '管理者';
    }
  }

  public static function confirmToken(string $sessionToken, string $postToken){
    if(isset($sessionToken) && isset($postToken) && $sessionToken === $postToken){
      return false;
    }else{
      return true;
    }
  }
}
