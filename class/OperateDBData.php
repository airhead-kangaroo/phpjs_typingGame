<?php

require_once(dirname(__FILE__) . '/../AutoLoad.php');
new AutoLoad();

class OperateDBData {

  public function getPassword(userInfo $userInfo, AccountOperate $tableClass): string{
    return $tableClass->fetchPassword($userInfo);
  }

  public function getUserId(userInfo $userInfo, AccountOperate $tableClass): int{
    return $tableClass->fetchUserId($userInfo);
  }

  public function getAuth(userInfo $userInfo, AccountOperate $tableClass): int{
    return $tableClass->fetchUserAuth($userInfo);
  }

  public function getUserDataByUsername(userInfo $userInfo, AccountOperate $tableClass){
    return $tableClass->fetchUserDataByUsername($userInfo);
  }

  public function getUserDataByUserId(userInfo $userInfo, AccountOperate $tableClass){
    return $tableClass->fetchUserDataByUserId($userInfo);
  }

  public function registerUserInfo(userInfo $userInfo, AccountOperate $tableClass){
    $tableClass->registerUserInfo($userInfo);
  }
}
