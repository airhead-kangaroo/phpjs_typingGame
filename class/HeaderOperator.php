<?php
class HeaderOperator{

  private $_auth;

  public function __construct(int $auth){
      $this->_auth = $auth;
  }

  public function loginCheck(){
    switch ($this->_auth) {
      case 1:
      header('Location: gamemain.php');
      exit();
      case 2:
      header('Location: ManagementConsole.php');
      exit();
    }
  }

  public function gamemainCheck(){
    switch ($this->_auth) {
      case 1:
      break;
      case 2:
      header('Location: ManagementConsole.php');
      exit();
      default :
      header('Location: index.php');
    }
  }

  public function managementCheck(){
    switch ($this->_auth) {
      case 1:
      header('Location: gamemain.php');
      exit();
      case 2:
      break;
      default :
      header('Location: index.php');
    }
  }
}
