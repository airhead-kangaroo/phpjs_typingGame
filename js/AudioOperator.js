class AudioOperator{
  constructor(audioSource){
    this.bgAudioSource = audioSource;
    this.bgAudio;
  }

  loadBgAudio(stageCount){
    this.bgAudio = new Audio();
    this.bgAudio.src = this.bgAudioSource[stageCount];
  }

  playBgAudio(){
    this.bgAudio.play();
  }

  stopBgAudio(){
    this.bgAudio.pause();
    this.bgAudio.currentTime = 0;
  }

  playAttackSE(){
    let attackSE = new Audio();
    attackSE.src = 'mp3/attack.mp3'
    attackSE.play();
  }

  playDamageSE(){
    let damageSE = new Audio();
    damageSE.src = 'mp3/damage.mp3';
    damageSE.play();
  }

}
