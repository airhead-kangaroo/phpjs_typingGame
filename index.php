<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
if(isset($_SESSION['userId'])){
  $session->regainSession($_SESSION);
}

if($session->getLoginStatus() === 'loggedIn'){
  $headerOperator = new HeaderOperator($session->getAuth());
  $headerOperator->loginCheck();
}

$session->createToken();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログインページ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/indexpage.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="formarea">
        <h3 class="page-header">ログイン</h3>
        <form action="loginCheck.php" method="post">
          <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="ユーザー名">
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="パスワード">
          </div>
          <input type="submit" value="ログイン" class="btn btn-info">
          <input type="hidden" name="token" value= <?= '"' . $_SESSION['token'] . '"'?>>
        </form>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
