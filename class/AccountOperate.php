<?php

interface AccountOperate{
  public function fetchPassword(UserInfo $userinfo);
  public function fetchUserId(UserInfo $userinfo);
  public function fetchAuth(UserInfo $userinfo);
  public function fetchUserDataByUsername(UserInfo $userinfo);
  public function fetchUserDataByUserId(UserInfo $userinfo);
  public function registerUserInfo(UserInfo $userInfo);
}
