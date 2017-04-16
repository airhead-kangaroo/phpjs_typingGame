class GameTimer{
  constructor(countDownSecond,timeLimitSetting){
    this.countDownSecond = countDownSecond + 1;
    this.timeLimitSetting = timeLimitSetting;
    this.gameTimerId;
    this.gameRemainTime = 0;
  }

  countDownTimer(displayOperator, stageCount){
    return new Promise((resolve) => {
    let remainTime = this.countDownSecond;
    function countDown(){
    let timerId = setTimeout(function(){
      remainTime--;
      displayOperator.setHeaderMessage(remainTime, stageCount);
      if(remainTime === 0){
        displayOperator.setHeaderMessage('Go!', stageCount);
        clearTimeout(timerId);
        resolve();
        return;
        };
      countDown();
      }, 1000);
    }
    countDown();
  });
  }

  gameRemainTimer(gameOperator){
    this.gameRemainTime = gameOperator.getTimeLimitSetting();
    this.remainTimer(gameOperator);
  }

  remainTimer(gameOperator){
    this.gameTimerId = setTimeout(() => {
    this.gameRemainTime--;
    gameOperator.setTimeLimit(this.gameRemainTime);
    if(this.gameRemainTime === 0){
      gameOperator.timeOverSetting();
      this.gameTimerStop();
      return;
      };
      this.remainTimer(gameOperator);
    }, 1000);
    }


  gameTimerStop(){
    clearTimeout(this.gameTimerId);
  }

  getRemainTime(){
    return this.gameRemainTime;
  }
}
