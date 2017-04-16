class EnemyBase {
  constructor(){
    this.enemyBase = [];
  }

  createEnemyByAjax(stageCount){
    return new Promise((resolve) =>{
      $.get("_ajax.php", {
        stage : stageCount
      }).done((enemyData) => {
        resolve();
        this.enemyBase = enemyData;
      })
    });
  }

  getEnemyNumber(){
    return this.enemyBase.length
  }

  getEnemyData(){
    return this.enemyBase;
  }
}
