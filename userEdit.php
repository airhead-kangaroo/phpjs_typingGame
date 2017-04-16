<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();
$userTable = new UserTable();
$userObj = $userTable->getAllUserData();
$count = 0;

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー編集</title>
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
        <h3 class="page-header">ユーザー編集</h3>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>ユーザーID</th>
              <th>ユーザー名</th>
              <th>権限</th>
              <th>操作パネル</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($userObj as $data): ?>
              <tr id=<?= '"tr' . $count . '"'?>>
               <td><?= $data->id ?></td>
               <td><?= $data->username ?></td>
               <td><?= Utils::authSelector($data->auth) ?></td>
               <td><span data-id=<?= $data->id ?> id=<?= '"delete' . $count . '"'?> class="glyphicon glyphicon-remove decolateGlyphicon"</span></td>
             </tr>
             <?php $count++ ?>
           <?php endforeach ?>
         </tbody>
        </table>
        <div class="btnArea">
        <div class="btn btn-info text-center" onclick="clickLink()">戻る</div>
        <input type="hidden" id="hidden" value=<?= $count ?> >
      </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/EditData.js"></script>
    <script src="js/clickLink.js"></script>
    <script>
    $(function(){
      'use strict'

      let ajaxHandler = new EditData('user');
      ajaxHandler.setDeleteButton();
    })
    </script>
  </body>
</html>
