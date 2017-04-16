class DisplayOperator{
  constructor(startMessage){
    this.message = document.getElementById('message');
    this.timelimit = document.getElementById('timelimit');
    this.lifepoint = document.getElementById('lifepoint');
    this.score = document.getElementById('score');
    this.messagePanel = document.getElementById('messagePanel');
    this.startMessage = startMessage;
  }

  setHeaderMessage(message, stageCount){
      this.messagePanel.className = "alert alert-info mainPanel"
      this.message.innerHTML = 'Stage ' + (stageCount + 1 ) + "<br>" + message;
  }

  setScore(score){
    this.score.innerHTML = score;
  }

  setLifepoint(lifepoint){
    this.lifepoint.innerHTML = lifepoint;
  }

  setTimeLimit(timelimit){
    this.timelimit.innerHTML = timelimit;
  }

  setGameOverMessage(){
    this.messagePanel.className = "alert alert-danger mainPanel"
    this.message.innerHTML = 'You are so Dead!!';
  }

  setTimeOverMessage(){
    this.messagePanel.className = "alert alert-warning mainPanel"
    this.message.innerHTML = 'Time Over, Go to Next Stage!';
  }

  getScore(){
    return this.score.value;
  }

  getTimeLimit(){
    return this.timelimit.innnerHTML;
  }

  getLifePoint(){
    return this.lifepoint.value;
  }

  getStartMessage(){
    return this.startMessage;
  }

  setEndingMessage(totalPoint, accuracy){
    this.messagePanel.className = "alert alert-success mainPanel"
    this.message.innerHTML = 'Congratulations! Game Clear!! <br> トータルポイント : ' + totalPoint + ' 正確性 : ' + accuracy + '%';
  }
}
