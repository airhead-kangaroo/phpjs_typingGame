$(function(){
  'use strict';

  const FINALSTAGENUMBER = 3;
  const COUNTDOWNSECOND = 5;
  const LIFEPOINT = 10;
  const STARTMESSAGE = 'Click to Start';
  const TIMELIMITSETTING = [110,15,20];
  const AUDIOSOURCE = [
    'mp3/lovelyMoundOfCherryBlossoms.mp3',
    'mp3/gensokyoPastAndPresent.mp3',
    'mp3/septetteForTheDeadPrinces.mp3'
  ];

  let enemyBase;
  let enemy;
  let stageOperator;
  let judgement;
  let summon;
  let gameTimer;
  let stoper;
  let displayOperator;
  let hero;
  let audioOperator;


  gameTimer = new GameTimer(COUNTDOWNSECOND,TIMELIMITSETTING);
  stageOperator = new StageOperator(FINALSTAGENUMBER);
  displayOperator = new DisplayOperator(STARTMESSAGE);
  audioOperator = new AudioOperator(AUDIOSOURCE);
  hero = new Hero(LIFEPOINT);
  displayOperator.setHeaderMessage(STARTMESSAGE, stageOperator.getStageCount());
  judgement = new Judgement();
  enemyBase = new EnemyBase();
  displayOperator.setTimelimit(TIMELIMITSETTING[stageOperator.getStageCount()] + gameTimer.getRemainTime());
  displayOperator.setLifepoint(hero.getLifePoint());

  window.addEventListener('click',() => {
    if(stageOperator.getFlag() === false){
      audioOperator.loadBgAudio(stageOperator.getStageCount());
      stoper = gameTimer.countDownTimer(displayOperator, stageOperator.getStageCount());
      stoper.then(() => {
        summon = enemyBase.createEnemyByAjax(stageOperator.getStageCount());
        summon.then((enemyData) => {
          enemy = new Enemy(enemyBase.getEnemyCount(), enemyBase.getEnemyData());
          stageOperator.setStage(enemy.getEnemy());
          gameTimer.gameRemainTimer(displayOperator, audioOperator,stageOperator,enemyBase,TIMELIMITSETTING[stageOperator.getStageCount()]);
          audioOperator.playBgAudio();
          stageOperator.setFlag(true);
        });
      });
    }
  });

  window.addEventListener('keyup', (e) => {
    if(stageOperator.getFlag()){
      if(judgement.judge(e, enemy.getEnemyWeekPoint())){
        hero.attackEnemy(enemy);
        audioOperator.playAttackSE();
        displayOperator.setScore(hero.getScore());
        if(enemy.getEnemyDamage() === enemy.getEnemyLife()){
          enemyBase.addEnemyCount();
          if(enemyBase.getEnemyCount() === enemyBase.getEnemyNumber()){
            stageOperator.addStageCount();
            if(stageOperator.getStageCount() === stageOperator.getLastOrder()){
              judgement.finalJudge(displayOperator);
              alert(judgement.getTotalPoint());
              return;
            }else{
              stageOperator.clearStage();
              enemyBase.resetEnemyCount();
              gameTimer.gameTimerStop();
              displayOperator.setHeaderMessage(STARTMESSAGE, stageOperator.getStageCount());
              displayOperator.setTimelimit(TIMELIMITSETTING[stageOperator.getStageCount()] + gameTimer.getRemainTime());
              audioOperator.stopBgAudio();
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
        audioOperator.playDamageSE();
        if(hero.getLifePoint() === 0){
          displayOperator.setGameOverMessage();
          gameTimer.gameTimerStop();
          StageOperator.setGameOver();
          audioOperator.stopBgAudio();
        }
      };
    };
  });
});
