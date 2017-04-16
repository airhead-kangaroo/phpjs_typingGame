<?php

require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();
if(isset($_GET['page'])){
  $pageCount = (int)Utils::h($_GET['page']);
}else{
  $pageCount = 0;
}

$stageTable = new StageTable();
$tableData = $stageTable->getTenData($pageCount);
$tableDataCount = $stageTable->getTotalDataCount();
$pagenationCreator = new CreatePagenation($tableDataCount);
$endPage = $pagenationCreator->getEndPage();
$count = 0;

 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>ステージ編集</title>
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
         <h3 class="page-header">ステージ編集</h3>
         <table class="table table-striped table-bordered table-hover">
           <thead>
             <tr>
               <th>単語</th>
               <th>ステージ</th>
               <th>操作パネル</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach($tableData as $data): ?>
               <tr id=<?= '"tr' . $count . '"'?>>
                <td><?= $data->enemy ?></td>
                <td><?= Utils::stageSelector($data->stage) ?></td>
                <td>
                  <div class="spandiv"><span data-id=<?= $data->id ?> id=<?= '"delete' . $count . '"'?> class="glyphicon glyphicon-remove decolateGlyphicon spanbutton"</span></div>&emsp;
                  <div class ="spandiv"><span data-id=<?= $data->id ?> id=<?= '"edit' . $count . '"'?> class="glyphicon glyphicon-pencil decolateGlyphicon spanbutton"</span></div>
                </td>
              </tr>
              <?php $count++ ?>
            <?php endforeach ?>
          </tbody>
         </table>
         <!-- <div class="formarea"> -->
         <form id="form">
           <fieldset>
             <legend>編集モード</legend>
             <div class="form-group">
               <label for="enemy">単語</label>
               <input type="text" class="form-control" id="enemy" name="enemy">
             </div>
             <div class="form-group">
               <label for="stage">ステージ</label>
               <select class="form-control selectbox" name="stage" id="stage">
                 <option value="0">初級</option>
                 <option value="1">中級</option>
                 <option value="2">上級</option>
               </select>
             </div>
             <input type="hidden" id="hiddenId">
             <div id="sendEdit" type="submit" class="btn btn-info">編集</div>
           </fieldset>
         </form>


         </div>

         <div class="text-center">
           <ul class="pagination">
             <li class=<?= $pagenationCreator->isStartPage($pageCount) ?> ><a href="stageEdit.php?page=0">&laquo;</a></li>
             <?php for($i=0;$i <= $endPage;$i++): ?>
               <li class=<?= $pagenationCreator->isActive($pageCount,$i) ?> ><a href=<?='"stageEdit.php?page=' . $i . '"' ?> > <?= ($i + 1) ?></a></li>
             <?php endfor ?>
             <li class=<?= $pagenationCreator->isEndPage($pageCount) ?> ><a href=<?='"stageEdit.php?page=' . $endPage . '"' ?>>&raquo</a></li>
           </ul>
         </div>
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

         let ajaxHandler = new EditData('stage');
         ajaxHandler.setDeleteButton();
         ajaxHandler.setEditButton();
         ajaxHandler.setEditSendButton();
       })
     </script>
   </body>
 </html>
