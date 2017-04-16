<?php
require_once(dirname(__FILE__) . '/../config/DBconfig.php');

class DBConnect {

  protected $_db;

  public function __construct(){
      $this->_db = new PDO(DSN,DBUSER,DBPASSWORD);
      $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function __destruct(){
    unset($this->_db);
  }
}

 ?>
