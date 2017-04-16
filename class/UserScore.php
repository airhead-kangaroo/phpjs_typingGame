<?php

require_once(__DIR__ . '/../AutoLoad.php');
new AutoLoad();

class UserScore{

  private $_userId;
  private $_score;
  private $_totalPoint;
  private $_accuracy;

  public function __construct(array $post){
    $this->_userId = $post['userid'];
    $this->_score = $post['score'];
    $this->_totalPoint = $post['totalpoint'];
    $this->_accuracy = $post['accuracy'];
  }

  public function getUserId(){
    return $this->_userId;
  }
  public function getScore(){
    return $this->_score;
  }
  public function getTotalPoint(){
    return $this->_totalPoint;
  }
  public function getAccuracy(){
    return $this->_accuracy;
  }
}
