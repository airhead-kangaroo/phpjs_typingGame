<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->gamemainCheck();
$settingTable = new SettingTable();
$settingDataObj = $settingTable->getAllData();
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
  </head>
  <body>
    <div class="namespace">
      <div class="nametag"><span id="name"><?= $session->getUsername() ?></span>さんログイン中</div>
      <div class="logout"><a href="logout.php">ログアウト</a>&emsp;<a href="yourscore.php">スコア記録</a></div>
    </div>
    <div class="container">
      <div class="mainContainer">
        <div class="alert alert-info mainPanel" id="messagePanel">
          <span id="message"><span>
        </div>
        <div class="gameSpace" id="gameSpace"></div>
        <div class="scoreSpace">
          score:<span id = "score">000</span> ; lifepoint:<span id="lifepoint">000</span> ;timelimite:<span id="timelimit">000</span>
        </div>
        <input type="hidden" id="hidden1" value=<?= $session->getUserId() ?>>
        <input type="hidden" id="stage1sec" value=<?= $settingDataObj->stage1sec ?>>
        <input type="hidden" id="stage2sec" value=<?= $settingDataObj->stage2sec ?>>
        <input type="hidden" id="stage3sec" value=<?= $settingDataObj->stage3sec ?>>
        <input type="hidden" id="countdownsec" value=<?= $settingDataObj->countdownsec ?>>
        <input type="hidden" id="startmessage" value=<?= '"' . $settingDataObj->startmessage . '"'?>>
        <input type="hidden" id="stage1bgm" value=<?= $settingDataObj->stage1bgm ?>>
        <input type="hidden" id="stage2bgm" value=<?= $settingDataObj->stage2bgm ?>>
        <input type="hidden" id="stage3bgm" value=<?= $settingDataObj->stage3bgm ?>>
        <input type="hidden" id="lifepointdata" value=<?= $settingDataObj->lifepoint ?>>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/InitialSetting.js"></script>
    <script src="js/StageOperator.js"></script>
    <script src="js/EnemyBase.js"></script>
    <script src="js/Enemy.js"></script>
    <script src="js/GameTimer.js"></script>
    <script src="js/DisplayOperator.js"></script>
    <script src="js/Hero.js"></script>
    <script src="js/AudioOperator.js"></script>
    <script src="js/GameOperator.js"></script>
    <script src="js/default.js"></script>

  </body>
</html>
