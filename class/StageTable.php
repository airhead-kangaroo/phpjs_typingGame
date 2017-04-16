<?php
require_once(dirname(__FILE__) . '/../AutoLoad.php');
new AutoLoad();

class StageTable extends DBConnect{

  public function insert(array $post){
    $sql = 'insert into stage(enemy, stage) value(:enemy, :stage)';
    $stmt = $this->_db->prepare($sql);
    $stmt ->bindParam(':enemy', $post['enemy'], PDO::PARAM_STR);
    $stmt ->bindParam(':stage', $post['stage'], PDO::PARAM_INT);
    $stmt->execute();
  }

  public function getAll(){
    $sql = 'select * from stage order by stage';
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getTenData(int $offset = 0){
    $limitStart = $offset *= 10;
    $sql = 'select * from stage order by stage, id limit :limitStart ,10';
    $stmt = $this->_db->prepare($sql);
    $stmt->bindParam(':limitStart', $limitStart, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function deleteById(int $id){
    $sql = 'delete from stage where id = :id';
    $stmt = $this->_db->prepare($sql);
    $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
  }

  public function getTotalDataCount(){
    $sql = 'select count(*) from stage';
    $stmt = $this->_db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function getStageData(int $stage){
    $sql = 'select enemy from stage where stage = :stage';
    $stmt = $this->_db->prepare($sql);
    $stmt ->bindParam(':stage', $stage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
  }

  public function getDataById(int $id){
    $sql = 'select id,enemy,stage from stage where id = :id';
    $stmt = $this->_db->prepare($sql);
    $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function updateTable(int $id, string $enemy, int $stage){
    $sql = 'update stage set enemy = :enemy,stage = :stage where id = :id';
    $stmt = $this->_db->prepare($sql);
    $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt ->bindParam(':enemy', $enemy, PDO::PARAM_STR);
    $stmt ->bindParam(':stage', $stage, PDO::PARAM_INT);
    $stmt->execute();
  }
}
