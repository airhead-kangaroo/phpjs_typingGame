$(function(){
  'use strict';

  let initialSetting = new InitialSetting();

  const GAMECOMPONENT = {
    FINALSTAGENUMBER : 3,
    COUNTDOWNSECOND : initialSetting.getCountdownsec() * 1,
    LIFEPOINT : initialSetting.getLifepoint() * 1,
    STARTMESSAGE : initialSetting.getStartmessage(),
    TIMELIMITSETTING : [
      initialSetting.getStage1sec() * 1,
      initialSetting.getStage2sec() * 1,
      initialSetting.getStage3sec() * 1
    ],
    AUDIOSOURCE : [
      initialSetting.getStage1bgm(),
      initialSetting.getStage2bgm(),
      initialSetting.getStage3bgm()
    ]
  }

  let gameOperator;
  let enemy;
  let summon;
  let gameTimer;
  let stoper;

  gameOperator = new GameOperator(GAMECOMPONENT);
  gameTimer = new GameTimer(GAMECOMPONENT.COUNTDOWNSECOND,GAMECOMPONENT.TIMELIMITSETTING);

  gameOperator.initialView(gameTimer);

  window.addEventListener('click',() => {
    if(gameOperator.getFlag() === 0){
      gameOperator.loadBgAudio();
      stoper = gameTimer.countDownTimer(gameOperator.displayOperator, gameOperator.getStageCount());
      stoper.then(() => {
        summon = gameOperator.summonEnemy();
        summon.then(() => {
          enemy = new Enemy(gameOperator.getEnemyCount(), gameOperator.getEnemyData());
          gameOperator.initStarge(enemy);
          gameTimer.gameRemainTimer(gameOperator);
        });
      });
    }
  });

  window.addEventListener('keyup', (e) => {
    if(gameOperator.getFlag() === 1){
      if(gameOperator.judge(e, enemy.getEnemyWeekPoint())){
        gameOperator.attackEnemy(enemy);
        if(enemy.getEnemyDamage() === enemy.getEnemyLife()){
          gameOperator.addEnemyCount();
          if(gameOperator.getEnemyCount() === gameOperator.getEnemyNumber()){
            gameOperator.nextStage();
            gameTimer.gameTimerStop();
          }else{
            enemy = new Enemy(gameOperator.getEnemyCount(), gameOperator.getEnemyData());
            gameOperator.nextEnemy(enemy);
          };
        };
      }else{
        gameOperator.heroAttacked(gameTimer);
      };
    }
  });
});
