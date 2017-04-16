<?php

require_once(__DIR__ . '/../AutoLoad.php');
new AutoLoad();

class UserScoreTable extends DBConnect{

  function insertUserScore(UserScore $userScore){
    $sql = 'insert into userscore(userid,score,totalpoint,accurecy) values(:userid, :score, :totalpoint, :accurecy)';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindParam(':userid', $userScore->getUserId(), PDO::PARAM_INT);
    $stmt->bindParam(':score', $userScore->getScore(), PDO::PARAM_INT);
    $stmt->bindParam(':totalpoint', $userScore->getTotalPoint(), PDO::PARAM_INT);
    $stmt->bindParam(':accurecy', $userScore->getAccuracy(), PDO::PARAM_STR);
    $stmt->execute();
  }

  function getUserScoreData($userId){
    $sql = "select score, totalpoint, accurecy from userscore where userid = :userid order by totalpoint desc";
    $stmt = $this->_db->prepare($sql);
    $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
}
