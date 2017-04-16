class StageOperator{
  constructor(lastOrder){
    this.gameSpace = document.getElementById('gameSpace');
  }

  setStage(enemy){
    for(let i = 0;i<enemy.length;i++){
      let newpanel = document.createElement('div')
      let newpanelFr = document.createElement('div')
      let newpanelBk = document.createElement('div')
      newpanel.className = 'enemyPanel';
      newpanelFr.className = 'enemyPanelFr';
      newpanelBk.className = 'enemyPanelBk';
      newpanel.id = 'enemyPanel' + i;
      newpanelFr.innerHTML = enemy[i];
      newpanelBk.innerHTML = '*';
      newpanel.appendChild(newpanelFr);
      newpanel.appendChild(newpanelBk);
      this.gameSpace.appendChild(newpanel);
    }
  }

  clearStage(){
    while(this.gameSpace.firstChild){
      this.gameSpace.removeChild(this.gameSpace.firstChild)
    }
  }
}
