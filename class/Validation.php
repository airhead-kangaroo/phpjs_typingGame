<?php

require_once(dirname(__FILE__) . '/../config/config.php');

class Validation{

  private $_userInfo;

  public function __construct(UserInfo $userInfo){
    $this->_userInfo = $userInfo;
  }
    public function confirmUsername(){
      if($this->_userInfo->getUsername() === ""){
        return 'ユーザー名を入力してください';
      }else if(strlen($this->_userInfo->getUsername()) < USERNAMELENGTH){
        return 'ユーザー名の文字数は' . USERNAMELENGTH . '文字以上です';
      }else{
        return 0;
      }
    }

  public function confirmPassword(){
    if($this->_userInfo->getPassword() === ""){
      return 'パスワードが入力されていません';
    }else if(strlen($this->_userInfo->getPassword()) < PASSWORDLENGTH){
      return 'パスワードの長さは' . PASSWORDLENGTH . '文字以上です';
    }else{
      return 0;
    }
  }

  public function confirmPasswordConfirm(){
    if($this->_userInfo->getPassword() !== $this->_userInfo->getPasswordConfirm()){
      return 'パスワードが一致しません';
    }else{
      return 0;
    }
  }

  public function confirmAuth(){
    if($this->_userInfo->getAuth() === ''){
      return '権限が設定されていません';
    }else{
      return 0;
    }
  }

  public function verifyPassword(){
    if(password_verify($this->_userInfo->getPassword(), $this->_userInfo->getHashPassword()) === FALSE){
      return 'ユーザーIDかパスワードが間違っています';
    }else if($this->_userInfo->getHashPassword() === ""){
      return 'ユーザーIDかパスワードが間違っています';
    }else if(password_verify($this->_userInfo->getPassword(), $this->_userInfo->getHashPassword())){
      return 0;
    }else{
      return '認証に失敗しました';
    }
  }
}
