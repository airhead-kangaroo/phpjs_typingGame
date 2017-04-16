<?php
require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->gamemainCheck();

$userScoreTable = new UserScoreTable();
$userScoreObj = $userScoreTable->getUserScoreData($session->getUserId());

 ?>
 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>スコア記録</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/management.css" rel="stylesheet">
   </head>
   <body>
     <div class="namespace">
       <div class="nametag"><span id="name"><?= $session->getUsername() ?></span>さんログイン中</div>
       <div class="logout"><a href="logout.php">ログアウト</a>&emsp;<a href="gamemain.php">ゲーム再開</a></div></div>
     </div>
     <div class="container">
       <div class="formarea">
         <h3 class="page-header"><?= $session->getUsername() ?>さんのスコア記録</h3>
         <table class="table table-striped table-bordered table-hover">
           <thead>
             <tr>
               <th>スコア</th>
               <th>トータルポイント</th>
               <th>正確性</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach($userScoreObj as $data): ?>
               <tr>
                <td><?= $data->score ?></td>
                <td><?= $data->totalpoint ?></td>
                <td><?= $data->accurecy ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
         </table>

         <!-- <div class="text-center">
           <ul class="pagination">
             <li class=<?= $pagenationCreator->isStartPage($pageCount) ?> ><a href="stageEdit.php?page=0">&laquo;</a></li>
             <?php for($i=0;$i <= $endPage;$i++): ?>
               <li class=<?= $pagenationCreator->isActive($pageCount,$i) ?> ><a href=<?='"stageEdit.php?page=' . $i . '"' ?> > <?= ($i + 1) ?></a></li>
             <?php endfor ?>
             <li class=<?= $pagenationCreator->isEndPage($pageCount) ?> ><a href=<?='"stageEdit.php?page=' . $endPage . '"' ?>>&raquo</a></li>
           </ul>
         </div> -->
         <div class="btnArea">
         <div class="btn btn-info text-center"><a href="ManagementConsole.php">戻る</a></div>
       </div>
       </div>
     </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/stageEdit.js"></script>
   </body>
 </html>
