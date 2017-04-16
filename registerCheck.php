<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();

$username = Utils::h($_POST['username']);
$password = Utils::h($_POST['password']);
$passwordConfirm = Utils::h($_POST['passwordConfirm']);
$auth = Utils::h($_POST['auth']);

$error = [];

$userInfo = new UserInfo();
$userInfo->setUsername($username);
$userInfo->setPassword($password);
$userInfo->setPasswordConfirm($passwordConfirm);
$userInfo->setAuth($auth);
$validator = new Validation($userInfo);

if(Utils::confirmToken($_SESSION['token'], $_POST['token'])){
  $error[] = "不正な設定変更を検知しました。設定は変更されていません。";
}

if($validator->confirmUsername()){
  $error[] = $validator->confirmUsername();
}
if($validator->confirmPassword()){
  $error[] = $validator->confirmPassword();
}
if($validator->confirmPasswordConfirm()){
  $error[] = $validator->confirmPasswordConfirm();
}
if($validator->confirmAuth()){
  $error[] = $validator->confirmAuth();
}

if(count($error) === 0){
  $userInfo->setHashPassword(password_hash($password, PASSWORD_DEFAULT));
  $DBoperator = new OperateDBData();
  try{
    $DBoperator->registerUserInfo($userInfo, new UserTable());
    header('Location: register.php?mode=done&username=' . $userInfo->getUsername() . '&auth=' . $userInfo->getAuth());
  }catch(Exception $e){
    if((int)$e->getCode() === 23000){
      $error[] = $userInfo->getUsername() . 'は既に登録されています。';
    }else{
      $error[] = $e->getMessage();
    }
  }
}
?>
  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>ユーザー登録エラー</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/indexpage.css" rel="stylesheet">
    </head>
    <body>
      <div class="container">
        <div class="formarea">
          <h3 class="page-header">ユーザー登録エラー</h3>
          <?php foreach($error as $errorStatement) : ?>
            <div class="alert alert-danger"><?= $errorStatement ?></div>
          <?php endforeach ?>
          <div class="btn btn-info"  onclick="clickLink()">戻る</div>
        </div>
      </div>
    </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/clickLink.js"></script>
    </body>
  </html>
