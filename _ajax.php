<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
$stage = Utils::h($_GET['stage']);
$stageTable = new StageTable();
$enemies = [];
$enemies = $stageTable->getStageData($stage);
shuffle($enemies);
if(count($enemies) > 150 ){
  array_splice($enemies, 150);
}

// $enemies = [
//   't',
//   't'
// ];

header('Content-Type: application/json; charset=utf-8');
echo json_encode($enemies);
exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $cleanpost = Utils::hh($_POST);
  $userScore = new UserScore($cleanpost);
  $userScoreTable = new UserScoreTable();
  $userScoreTable->insertUserScore($userScore);
  exit();
}

 ?>
