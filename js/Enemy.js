class Enemy{
  constructor(enemyCount, enemyBase){
      this.enemy = enemyBase[enemyCount];
      this.damage = 0;
      this.life = enemyBase[enemyCount].length;
  }

  getEnemy(){
    return this.enemy;
  }

  hitEnemy(){
    this.damage++;
  }

  getEnemyDamage(){
    return this.damage;
  }

  getEnemyLife(){
    return this.life;
  }

  getEnemyWeekPoint(){
    return this.enemy[this.damage];
  }
}
