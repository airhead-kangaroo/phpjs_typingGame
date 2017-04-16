class InitialSetting{
  constructor(){
    this.stage1sec = document.getElementById('stage1sec').value;
    this.stage2sec = document.getElementById('stage2sec').value;
    this.stage3sec = document.getElementById('stage3sec').value;
    this.startmessage = document.getElementById('startmessage').value;
    this.countdownsec = document.getElementById('countdownsec').value;
    this.stage1bgm = document.getElementById('stage1bgm').value;
    this.stage2bgm = document.getElementById('stage2bgm').value;
    this.stage3bgm = document.getElementById('stage3bgm').value;
    this.lifepoint = document.getElementById('lifepointdata').value;
    // this.stage1sec = JSON.parse(document.getElementById('stage1sec').value);
    // this.stage2sec = JSON.parse(document.getElementById('stage2sec').value);
    // this.stage3sec = JSON.parse(document.getElementById('stage3sec').value);
    // this.countdownsec = JSON.parse(document.getElementById('countdownsec').value);
    // this.stage1bgm = JSON.parse(document.getElementById('stage1bgm').value);
    // this.stage2bgm = JSON.parse(document.getElementById('stage2bgm').value);
    // this.stage3bgm = JSON.parse(document.getElementById('stage3bgm').value);
  }

  getStage1sec(){
    return this.stage1sec;
  }

  getStage2sec(){
    return this.stage2sec;
  }

  getStage3sec(){
    return this.stage3sec;
  }

  getStartmessage(){
    return this.startmessage;
  }

  getCountdownsec(){
    return this.countdownsec;
  }

  getStage1bgm(){
    return this.stage1bgm;
  }

  getStage2bgm(){
    return this.stage2bgm;
  }

  getStage3bgm(){
    return this.stage3bgm;
  }

  getLifepoint(){
    return this.lifepoint;
  }
}
