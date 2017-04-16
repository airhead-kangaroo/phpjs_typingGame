<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->loginCheck();

$username = Utils::h($_POST['username']);
$password = Utils::h($_POST['password']);

$error = [];

$userInfo = new UserInfo();
$userInfo->setUsername($username);
$userInfo->setPassword($password);
$fetchDB = new OperateDBData();
$userData = $fetchDB->getUserDataByUsername($userInfo, new UserTable());
$userInfo->setHashPassword($userData['password']);
$userInfo->setUserId($userData['id']);
$userInfo->setAuth($userData['auth']);
$validator = new Validation($userInfo);

//CSRFの疑いがある場合はtrueを返します。
if(Utils::confirmToken($_SESSION['token'], $_POST['token'])){
  $error[] = '不正なログインです';
}

if($validator->confirmUsername()){
  $error[] = $validator->confirmUsername();
}
if($validator->confirmPassword()){
  $error[] = $validator->confirmPassword();
}
if($validator->verifyPassword()){
  $error[] = $validator->verifyPassword();
}

if(count($error) === 0){
  $sessionOperator = new SessionOperator();
  $sessionOperator->setSession($userInfo);
  $sessionOperator->setLoginStatus();
  $headerOperator = new HeaderOperator($userInfo->getAuth());
  $headerOperator->loginCheck();
}else{
?>
  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>ログインエラー</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/indexpage.css" rel="stylesheet">
    </head>
    <body>
      <div class="container">
        <div class="formarea">
          <h3 class="page-header">ログインエラー</h3>
          <?php foreach($error as $errorStatement) : ?>
            <div class="alert alert-danger"><?= $errorStatement ?></div>
          <?php endforeach ?>
          <div class="btn btn-info" onclick="clickLinkToIndex()">戻る</div>
        </div>
      </div>
    </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/clickLink.js"></script>
    </body>
  </html>

<?php } ?>
