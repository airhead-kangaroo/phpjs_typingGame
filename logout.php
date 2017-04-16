<?php
require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$sessionOperator = new SessionOperator();

$sessionOperator->sessionLogout();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログアウト</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/indexpage.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="formarea">
        <h3 class="page-header">ログアウト</h3>
          <div class="alert alert-info">ログアウトしました</div>
        <div class="btn btn-info" onclick="clickLinkToIndex()">戻る</div>
      </div>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/clickLink.js"></script>
  </body>
</html>
