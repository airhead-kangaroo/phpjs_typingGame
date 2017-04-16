class Hero{
  constructor(lifePoint){
    this.score = 0;
    this.lifePoint = lifePoint;
    this.mistaken = 0;
  }

  addScore(){
    this.score++;
  }

  getScore(){
    return this.score;
  }

  getDamage(){
    this.lifePoint--;
    this.mistaken++;
  }

  attackEnemy(enemy){
    let enemyPanel = document.getElementById('enemyPanel' + enemy.damage);
    enemyPanel.className = "enemyPanel flip";
    enemy.hitEnemy();
    this.addScore();
  }

  getLifePoint(){
    return this.lifePoint;
  }

  getMisteken(){
    return this.mistaken;
  }
}
