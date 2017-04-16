<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();
$settingTable = new SettingTable();
$flag = 1;
if($_SERVER['REQUEST_METHOD'] === 'GET'){
  $session->createToken();
  $settingDataObj = $settingTable->getAllData();
  if(isset($_GET['flag']) && (int)$_GET['flag'] === 0){
    $flag = 0;
  }
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(Utils::confirmToken($_SESSION['token'], $_POST['token'])){
    $error = "不正な設定変更を検知しました。設定は変更されていません。";
  }else{
    $cleanPost = Utils::hh($_POST);
    $settingTable->updateData($cleanPost);
    header('Location:setting.php?flag=0');
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理ページ</title>
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
        <div class="alert alert-info" id="successInfo">設定を更新しました。</div>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif ?>
        <h3 class="page-header">ステージ作成</h3>
        <form method="post" action="">
          <h4>ステージ制限時間</h4>
          <div class="form-group">
            <label for="timeLimit01">ステージ１</label>
            <input type="number" id="timeLimit01" name="timeLimit01" class="form-control inputNumber" value=<?= $settingDataObj->stage1sec ?> required>
          </div>
          <div class="form-group">
            <label for="timeLimit02">ステージ２</label>
            <input type="number" id="timeLimit02" name="timeLimit02" class="form-control inputNumber" value=<?= $settingDataObj->stage2sec ?> required>
          </div>
          <div class="form-group">
            <label for="timeLimit03">ステージ３</label>
            <input type="number" id="timeLimit03" name="timeLimit03" class="form-control inputNumber" value=<?= $settingDataObj->stage3sec ?> required>
          </div>
          <div class="form-group">
            <label for="countdownSec">カウントダウン秒数</label>
            <input type="number" id="countdownSec" name="countdownSec" class="form-control inputNumber" value=<?= $settingDataObj->countdownsec ?> required>
          </div>
          <div class="form-group">
            <label for="startMessage">スタートメッセージ</label>
            <input type="text" id="startMessage" name="startMessage" class="form-control" value=<?= '"' . $settingDataObj->startmessage . '"'?> required>
          </div>
          <div class="form-group">
            <label for="lifepoint">ライフポイント</label>
            <input type="number" id="lifepoint" name="lifepoint" class="form-control inputNumber" value=<?= $settingDataObj->lifepoint ?> required>
          </div>
          <br>
          <h4>バックグラウンドミュージック</h4>
          <div class="form-group">
            <label for="BGmusic1">ステージ１</label>
            <input type="text" id="BGmusic1" name="BGmusic1" class="form-control" value=<?= $settingDataObj->stage1bgm ?> required>
          </div>
          <div class="form-group">
            <label for="BGmusic2">ステージ２</label>
            <input type="text" id="BGmusic2" name="BGmusic2" class="form-control" value=<?= $settingDataObj->stage2bgm ?> required>
          </div>
          <div class="form-group">
            <label for="BGmusic1">ステージ３</label>
            <input type="text" id="BGmusic3" name="BGmusic3" class="form-control" value=<?= $settingDataObj->stage3bgm ?> required>
          </div>
          <input type="submit" class="btn btn-info buttonMargin" value="更新">
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
