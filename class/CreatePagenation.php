<?php

class CreatePagenation{
  private $_totalDataCount;
  private $_endPage;

  public function __construct(int $dataCount){
    $this->_totalDataCount = $dataCount;
    $this->_endPage = (int)floor(($this->_totalDataCount / 10));
  }

  public function isStartPage(int $page): string{
    if($page === 0){
      return "disabled";
    }else{
      return "";
    }
  }

  public function isEndPage(int $page): string{
    if($page === $this->_endPage){
      return "disabled";
    }else{
      return "";
    }
  }

  public function isActive(int $page, int $nowPage){
    if($page === $nowPage){
      return "active";
    }else{
      return "";
    }
  }

  public function getEndPage(){
    return $this->_endPage;
  }
}
