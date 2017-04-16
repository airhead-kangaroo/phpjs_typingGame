<?php

require_once(dirname(__FILE__) . '/../AutoLoad.php');
new AutoLoad();

class UserTable extends DBConnect implements AccountOperate{

  public function fetchPassword(userInfo $userInfo):string {
    $sql = 'select password from user where username = :username';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':username', $userInfo->getUsername(), PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function fetchUserId(userInfo $userInfo):int {
    $sql = 'select id from user where username = :username';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':username', $userInfo->getUsername(), PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function fetchAuth(userInfo $userInfo):int {
    $sql = 'select auth from user where username = :username';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':username', $userInfo->getUsername(), PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function fetchUserDataByUsername(userInfo $userInfo) {
    $sql = 'select * from user where username = :username';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':username', $userInfo->getUsername(), PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchUserDataByUserId(userInfo $userInfo) {
    $sql = 'select * from user where id = :id';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':id', $userInfo->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function registerUserInfo(userInfo $userInfo){
    $sql = 'insert into user(username,password,auth) values(:username, :password, :auth)';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':username', $userInfo->getUsername(), PDO::PARAM_STR);
    $stmt->bindValue(':password', $userInfo->getHashPassword(), PDO::PARAM_STR);
    $stmt->bindValue(':auth', $userInfo->getAuth(), PDO::PARAM_INT);
    $stmt->execute();
  }

  public function getAllUserData(){
    $sql = 'select id,username,auth from user';
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function deleteUser($id){
    $sql = 'delete from user where id = :id';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }
}
