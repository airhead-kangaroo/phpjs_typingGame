$(function(){
  // 'use strict';

  const FINALSTAGENUMBER = 3;
  const COUNTDOWNSECOND = 5;
  const LIFEPOINT = 1000000;
  const STARTMESSAGE = 'Click to Start';
  const TIMELIMITSETTING = [10000,15000,20];

  let enemyBase;
  let enemy;
  let stageOperator;
  let judgement;
  let summon;
  let gameTimer;
  let stoper;
  let displayOperator;
  let hero;


  gameTimer = new GameTimer(COUNTDOWNSECOND);
  stageOperator = new StageOperator(FINALSTAGENUMBER);
  displayOperator = new DisplayOperator();
  hero = new Hero(LIFEPOINT);
  displayOperator.setHeaderMessage(STARTMESSAGE, stageOperator.getStageCount());
  judgement = new Judgement();
  enemyBase = new EnemyBase();

  window.addEventListener('click',() => {
    if(stageOperator.getFlag() === false){
      stageOperator.setFlag(true);
      stoper = gameTimer.countDownTimer(displayOperator, stageOperator.getStageCount());
      stoper.then(() => {
        summon = enemyBase.createEnemyByAjax(stageOperator.getStageCount());
        summon.then((enemyData) => {
          enemy = new Enemy(enemyBase.getEnemyCount(), enemyBase.getEnemyData());
          stageOperator.setStage(enemy.getEnemy());
          displayOperator.setTimelimit(TIMELIMITSETTING[stageOperator.getStageCount()]);
          displayOperator.setLifepoint(hero.getLifePoint());
          gameTimer.gameRemainTimer(displayOperator, TIMELIMITSETTING[stageOperator.getStageCount()]);
        });
      });
    }
  });

  window.addEventListener('keyup', (e) => {
    if(stageOperator.getFlag()){
      if(judgement.judge(e, enemy.getEnemyWeekPoint())){
        hero.attackEnemy(enemy);
        displayOperator.setScore(hero.getScore());
        if(enemy.getEnemyDamage() === enemy.getEnemyLife()){
          enemyBase.addEnemyCount();
          if(enemyBase.getEnemyCount() === enemyBase.getEnemyNumber()){
            stageOperator.addStageCount();
            if(stageOperator.getStageCount() === stageOperator.getLastOrder()){
              alert('finish');
              return;
            }else{
              stageOperator.clearStage();
              enemyBase.resetEnemyCount();
              gameTimer.gameTimerStop();
              displayOperator.setHeaderMessage(STARTMESSAGE, stageOperator.getStageCount());
              displayOperator.setTimelimit(TIMELIMITSETTING[stageOperator.getStageCount()]);
              window.removeEventListener('click',arguments.callee);
              stageOperator.setFlag(false);
            };
          }else{
            stageOperator.clearStage();
            enemy = new Enemy(enemyBase.getEnemyCount(), enemyBase.getEnemyData());
            stageOperator.setStage(enemy.getEnemy());
          };
        };
      }else{
        hero.getDamage();
        displayOperator.setLifepoint(hero.getLifePoint());
        if(hero.getLifePoint() === 0){
          displayOperator.setGameOverMessage();
          gameTimer.gameTimerStop();
          StageOperator.setGameOver();
        }
      };
    };
  });
});
