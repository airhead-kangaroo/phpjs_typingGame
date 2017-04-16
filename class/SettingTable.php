<?php

class SettingTable extends DBConnect{

  public function getAllData(){
    $sql = 'select * from setting';
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function updateData(array $post){
    $sql = 'update setting set stage1sec = :stage1sec, stage2sec = :stage2sec, stage3sec = :stage3sec, countdownsec = :countdownsec, startmessage = :startmessage, stage1bgm = :stage1bgm, stage2bgm = :stage2bgm, stage3bgm = :stage3bgm, lifepoint = :lifepoint where id = 1';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindParam('stage1sec', $post['timeLimit01'], PDO::PARAM_INT);
    $stmt->bindParam('stage2sec', $post['timeLimit02'], PDO::PARAM_INT);
    $stmt->bindParam('stage3sec', $post['timeLimit03'], PDO::PARAM_INT);
    $stmt->bindParam('countdownsec', $post['countdownSec'], PDO::PARAM_INT);
    $stmt->bindParam('startmessage', $post['startMessage'], PDO::PARAM_STR);
    $stmt->bindParam('stage1bgm', $post['BGmusic1'], PDO::PARAM_STR);
    $stmt->bindParam('stage2bgm', $post['BGmusic2'], PDO::PARAM_STR);
    $stmt->bindParam('stage3bgm', $post['BGmusic3'], PDO::PARAM_STR);
    $stmt->bindParam('lifepoint', $post['lifepoint'], PDO::PARAM_INT);
    $stmt->execute();
  }
}
