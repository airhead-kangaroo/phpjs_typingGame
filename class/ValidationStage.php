<?php

class ValidationStage{
  private $_post;
  private $_result = [];

  public function __construct(array $post = null){
    $this->_post = $post;
  }

  public function validate(){
    if($this->_post['enemy'] === ''){
      $this->_result[] = '単語が登録されていません';
    }
    if(!isset($this->_post['stage']) || $this->_post['stage'] === ''){
      $this->_result[] = 'ステージが選択されていません';
    }
    return $this->_result;
  }
}
