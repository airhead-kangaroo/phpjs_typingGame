<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$type = Utils::h($_POST['type']);
$id = Utils::h($_POST['id']);
$mode = Utils::h($_POST['mode']);

if($type === 'stage'){
  $stageTable = new StageTable();
  if($mode === 'delete'){
    $stageTable->deleteById($id);
  }else if($mode === 'edit'){
    $enemyData = $stageTable->getDataById($id);
    header('Content-Type:application/json; charset=utf-8');
    echo json_encode($enemyData);
  }else if($mode === 'editsave'){
    $enemy = Utils::h($_POST['enemy']);
    $stage = Utils::h($_POST['stage']);
    $stageTable->updateTable($id,$enemy,$stage);
  }
}else if($type === 'user'){
  $userTable = new UserTable();
  if($mode === 'delete'){
    $userTable->deleteUser($id);
  }

}
