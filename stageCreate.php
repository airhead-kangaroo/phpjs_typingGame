<?php
require_once(__DIR__ . '/AutoLoad.php');
new AutoLoad();

$session = new SessionOperator();
$session->regainSession($_SESSION);
$headerOperator = new HeaderOperator($session->getAuth());
$headerOperator->managementCheck();
$flag = 1;

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['enemy'])){
  $cleanGet = [];
  $cleanGet = Utils::hh($_GET);
  $flag = 0;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $cleanPost = [];
  $errorResult = [];
  $cleanPost = Utils::hh($_POST);
  $validator = new ValidationStage($cleanPost);
  $errorResult = $validator->validate();
  if(Utils::confirmToken($_SESSION['token'], $_POST['token'])){
    $errorResult[] = '不正な設定変更を検知しました。設定は変更されていません。';
  }
  if(count($errorResult) === 0){
    $stageTable = new StageTable();
    try{
      $stageTable->insert($cleanPost);
      header('Location:stageCreate.php?enemy=' . $cleanPost['enemy'] . '&stage=' . $cleanPost['stage']);
    }catch(Exception $e){
      if((int)$e->getCode() === 23000){
        $errorResult[] = $cleanPost['enemy'] . 'は既に登録されています。';
      }else{
        $errorResult[] = $e->getMessage();
      }
    }
  }
}
$session->createToken();
 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>ステージ作成</title>
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
         <?php
         if(isset($errorResult) && count($errorResult) > 0):
           foreach($errorResult as $error):
             ?>
             <div class="alert alert-danger"><?= $error ?></div>
           <?php endforeach ?>
         <?php endif ?>
         <div class="alert alert-info" id="successInfo"><?=$cleanGet['enemy'] . 'を' . Utils::stageSelector($cleanGet['stage']) .'に登録しました' ?></div>
         <h3 class="page-header">ステージ作成</h3>
         <form action="" method="post">
           <div class="form-group">
             <label for="enemy">単語</label>
             <input type="text" id="enemy" class="form-control" name="enemy" placeholder="単語">
           </div>
           <div class="form-group">
             <p>ステージを選択してください</p>
             <label class="radio-inline"><input type="radio" name="stage" value="0">初級</label>
             <label class="radio-inline"><input type="radio" name="stage" value="1">中級</label>
             <label class="radio-inline"><input type="radio" name="stage" value="2">上級</label>
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
    </script>
   </body>
 </html>
