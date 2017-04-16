class GameOperator{
  constructor(GAMECOMPONENT){
    this.stageOperator = new StageOperator(GAMECOMPONENT.FINALSTAGENUMBER);
    this.displayOperator = new DisplayOperator(GAMECOMPONENT.STARTMESSAGE);
    this.audioOperator = new AudioOperator(GAMECOMPONENT.AUDIOSOURCE);
    this.hero = new Hero(GAMECOMPONENT.LIFEPOINT, this.userId);
    this.enemyBase = new EnemyBase();
    this.startMessage = GAMECOMPONENT.STARTMESSAGE;
    this.timeLimitSetting = GAMECOMPONENT.TIMELIMITSETTING;
    this.finalStageNumber = GAMECOMPONENT.FINALSTAGENUMBER;
    this.userId = document.getElementById('hidden1').value;
    this.enemyCount = 0;
    this.stageCount = 0;
    this.startFlag = 0;
    this.totalPoint = 0;
    this.accuracy;

  }

  initialView(gameTimer){
    this.displayOperator.setHeaderMessage(this.startMessage,this.stageCount);
    this.displayOperator.setTimeLimit(this.timeLimitSetting[this.stageCount] + gameTimer.getRemainTime())
    this.displayOperator.setLifepoint(this.hero.getLifePoint());
  }

  loadBgAudio(){
    this.audioOperator.loadBgAudio(this.stageCount);
  }

  summonEnemy(){
    let summon = this.enemyBase.createEnemyByAjax(this.stageCount);
    return summon;
  }

  getEnemyCount(){
    return this.enemyCount;
  }

  resetEnemyCount(){
    this.enemyCount = 0;
  }

  addEnemyCount(){
    this.enemyCount++;
  }

  getEnemyNumber(){
    return this.enemyBase.getEnemyNumber();
  }

  getStageCount(){
    return this.stageCount;
  }

  getFlag(){
    return this.startFlag;
  }

  getLastOrder(){
    return this.finalStageNumber;
  }

  setGameOver(){
    setTimeout(() =>{
      location.href = "gamemain.php"
    },3000);
  }

  getEnemyData(){
    return this.enemyBase.getEnemyData();
  }

  getTimeLimitSetting(){
    return this.timeLimitSetting[this.stageCount];
  }

  setTimeLimit(gameRemainTime){
    this.displayOperator.setTimeLimit(gameRemainTime);
  }

  initStarge(enemy){
    this.stageOperator.setStage(enemy.getEnemy());
    this.audioOperator.playBgAudio();
    this.startFlag = 1;
  }

  judge(e, enemy){
    return String.fromCharCode(e.keyCode) === enemy.toUpperCase();
  }

  attackEnemy(enemy){
    this.hero.attackEnemy(enemy);
    this.audioOperator.playAttackSE();
    this.displayOperator.setScore(this.hero.getScore());
  }

  heroAttacked(gameTimer){
    this.hero.getDamage();
    this.displayOperator.setLifepoint(this.hero.getLifePoint());
    this.audioOperator.playDamageSE();
    if(this.hero.getLifePoint() === 0 ){
      this.heroDied(gameTimer);
    }
  }

  nextStage(){
    this.stageCount++;
    this.audioOperator.stopBgAudio();
    if(this.stageCount === this.finalStageNumber){
      this.endingOperation();
    }else{
      this.stageOperator.clearStage();
      this.enemyCount = 0;
      this.displayOperator.setHeaderMessage(this.startMessage,this.stageCount);
      this.displayOperator.setTimeLimit(this.timeLimitSetting[this.stageCount]);
      this.startFlag = 0;
    }
  }

  nextEnemy(enemy){
    this.stageOperator.clearStage();
    this.stageOperator.setStage(enemy.getEnemy());
  }

  heroDied(gameTimer){
    this.displayOperator.setGameOverMessage();
    gameTimer.gameTimerStop();
    this.audioOperator.stopBgAudio();
    this.startFlag = 2;
    this.setGameOver();
  }

  timeOverSetting(){
    this.displayOperator.setTimeOverMessage();
    this.audioOperator.stopBgAudio()
    if(this.stageCount === this.finalStageNumber - 1){
      this.endingOperation()
    }else{
      setTimeout(()=>{
        this.nextStage(0);
      },3000)
    }
  }

  endingOperation(){
    this.startFlag = 2;
    this.totalPoint = this.hero.getScore() * this.hero.getLifePoint();
    this.accuracy = this.accuracyCalc() ;
    this.displayOperator.setEndingMessage(this.totalPoint, this.accuracy);
    setTimeout(() =>{
      this.sendAjax();
    },5000);
  }

  accuracyCalc(){
    if(this.hero.getMisteken() * 1 === 0){
      return 100;
    }else{
      let betaData = 100 - ((this.hero.getMisteken() / this.hero.getScore()) * 100) ;
      return Math.round(betaData * 100) / 100
    }
  }

  sendAjax(){
    $.post('_ajax.php', {
      score: this.hero.getScore(),
      totalpoint: this.totalPoint,
      accuracy: this.accuracy,
      userid: this.userId
    }).done(() =>{
      location.href = "yourscore.php"
    })
  }

}
