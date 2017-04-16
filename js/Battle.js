class Battle{
  constructor(){
    this.gameSpace = document.getElementById('gameSpace');
  }

  attackEnemy(count){
    let enemyPanel = document.getElementById('enemyPanel' + count)
    enemyPanel.className = "enemyPanel flip";
    console.log(enemyCount);
  }

}
