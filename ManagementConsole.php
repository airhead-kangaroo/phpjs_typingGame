<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();

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
         <h3 class="page-header">管理ページ</h3>
         <div class="panelarea">
           <div class="managementPanel" id="panel0">ステージ作成</div>
         </div>
         <div class="panelarea">
           <div class="managementPanel" id="panel1">ステージ編集</div>
         </div>
         <div class="panelarea">
           <div class="managementPanel" id="panel2">ユーザー登録</div>
         </div>
         <div class="panelarea">
           <div class="managementPanel" id="panel3">ユーザー編集</div>
         </div>
         <div class="panelarea">
           <div class="managementPanel" id="panel4">設定</div>
         </div>
         </div>
       </div>
     </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/management.js"></script>
   </body>
 </html>
