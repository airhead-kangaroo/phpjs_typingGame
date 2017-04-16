<?php

class UserInfo{
  protected $_userId;
  protected $_username;
  protected $_password;
  protected $_passwordConfirm;
  protected $_auth;
  protected $_hashPassword;

  public function setUserId($userId){
    $this->_userId = $userId;
  }

  public function setUsername($username){
    $this->_username = $username;
  }
  public function setPassword($password){
    $this->_password = $password;
  }
  public function setPasswordConfirm($password){
    $this->_passwordConfirm = $password;
  }
  public function setAuth($auth){
    $this->_auth = $auth;
  }

  public function setHashPassword($hashPassword){
    $this->_hashPassword = $hashPassword;
  }

  public function getUserId() {
    return $this->_userId;
  }
  public function getUsername(){
    return $this->_username;
  }
  public function getPassword(){
    return $this->_password;
  }
  public function getPasswordConfirm(){
    return $this->_passwordConfirm;
  }
  public function getAuth(){
    return $this->_auth;
  }
  public function getHashPassword(){
    return $this->_hashPassword;
  }

}
