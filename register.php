<?php
require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();
$session->createToken();
$flag = 1;

if(isset($_GET['mode']) && ($_GET['mode']) === 'done'){
  $cleanGet = Utils::hh($_GET);
  $flag = 0;
}

 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新規ユーザー登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/management.css" rel="stylesheet">
  </head>
  <body>
    <div class="namespace">
      <div class="nametag"><span id="name"><?= $session->getUsername() ?></span>さんログイン中</div>
      <div class="logout"><a href="logout.php">ログアウト</a></div>
    </div>
    <div class="container">
      <div class="formarea">
        <div class="alert alert-info" id="successInfo"><?=$cleanGet['username'] . 'さんを' . Utils::authSelector($cleanGet['auth']) . 'として登録しました' ?></div>
        <h3 class="page-header">新規ユーザー登録</h3>
        <form action="registerCheck.php" method="post">
          <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="ユーザー名">
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="パスワード">
          </div>
          <div class="form-group">
            <label for="passwordConfirm">パスワードを確認</label>
            <input type="password" id="passwordConfirm" class="form-control" name="passwordConfirm" placeholder="パスワードを確認">
          </div>
          <div class="form-group">
            <label for="auth">権限</label>
            <select id="auth" class="form-control shortform" name="auth" placeholder="ユーザー">
              <option value="1">ユーザー</option>
              <option value="2">管理者</option>
            </select>
          </div>
          <input type="submit" value="登録" class="btn btn-info buttonMargin">
          <div class="btn btn-info buttonMargin" onclick="clickLink()">戻る</div>
          <input type="hidden" id="flag" value=<?= '"' . $flag . '"' ?> >
          <input type="hidden" name="token" value=<?= '"' . $_SESSION['token'] . '"'?>>
        </form>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/registerConfirm.js"></script>
    <script src="js/clickLink.js"></script>
  </body>
</html>
