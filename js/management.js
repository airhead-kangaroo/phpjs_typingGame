$(function(){
  'use strinct';

  const PANEL = 5
  const HREF = [
    'stageCreate.php',
    'stageEdit.php',
    'register.php',
    'userEdit.php',
    'setting.php'
  ]

  let panel = [];

  for(let i = 0; i < PANEL;i++){
    panel[i] = document.getElementById('panel' + i);
    panel[i].addEventListener('click', () => {
      location.href = HREF[i];
    })
    panel[i].addEventListener('mouseover', () => {
      panel[i].className = "managementPanel pushed";
    })
    panel[i].addEventListener('mouseout', () => {
      panel[i].className = "managementPanel";
    })
  }

});
