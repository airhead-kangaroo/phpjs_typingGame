<?php

require_once(dirname(__FILE__) . '/../AutoLoad.php');
new AutoLoad();

class SessionOperator{

  private $_userId;
  private $_loginStatus;
  private $_username;
  private $_auth;

  public function __construct(){
    session_start();
    session_regenerate_id(true);
  }

  public function regainSession(array $session = null){
    $this->_userId = Utils::h($session['userId']);
    $this->_loginStatus = Utils::h($session['loginStatus']);
    $this->_username = Utils::h($session['username']);
    $this->_auth = Utils::h($session['auth']);
  }

  public function setSession(userInfo $userInfo){
    $_SESSION['userId'] = $userInfo->getUserId();
    $_SESSION['username'] = $userInfo->getUsername();
    $_SESSION['auth'] = $userInfo->getAuth();
  }

  public function setLoginStatus(){
    $_SESSION['loginStatus'] = 'loggedIn';
  }

  public function sessionLogout(){
    $_SESSION = array();
    if(isset($_COOKIE[session_name()]) == TRUE){
      setcookie(session_name(),'',time()-42000,'/');
    }
    @session_destroy();
  }

  public function getUserId(){
    return $this->_userId;
  }
  public function getUsername(){
    return $this->_username;
  }
  public function getLoginStatus(){
    return $this->_loginStatus;
  }
  public function getAuth(){
    return (int)$this->_auth;
  }

 public function createToken(){
   $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
 }


}
