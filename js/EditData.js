class EditData{
  constructor(type){
    this.type = type;
    this.count = document.getElementById('hidden').value;
    if(type === 'stage'){
      this.hidden = document.getElementById('hiddenId');
      this.enemy = document.getElementById('enemy');
      this.stage = document.getElementById('stage');
      this.btn = document.getElementById('sendEdit')
    }
  }

  setDeleteButton(){
    for(let i=0;i < this.count;i++){
      let deleteButton = document.getElementById('delete' + i);
      let deleteButtonId = deleteButton.getAttribute('data-id');
      deleteButton.addEventListener('click', () => {
        if(confirm('削除してもよろしいですか？')){
          $.post('_editAjax.php',{
            type:this.type,
            id: deleteButtonId,
            mode: 'delete'
          }).done(()=>{
            $('#tr' + i).fadeOut(1000);
          })
        }
      })
    }
  }

  setEditButton(){
    $('#form').hide();
    for(let i=0; i< this.count; i++){
      let editButton = document.getElementById('edit' + i);
      let editButtonId = editButton.getAttribute('data-id');
      editButton.addEventListener('click', () => {
        $.post('_editAjax.php', {
          type:this.type,
          id:editButtonId,
          mode:'edit'
        }).done((data) =>{
          $('#form').fadeIn(1000);
          this.hidden.value = data.id;
          this.enemy.value = data.enemy;
          this.stage.value = data.stage;
        })
      })
    }
  }

  setEditSendButton(){
    this.btn.addEventListener('click', ()=>{
      if(this.enemy.value == ""){
        alert("単語を入力してください");
      }else if(this.stage.value == ""){
        alert("ステージを選択してください");
      }else{
        $('#form').fadeOut(1000);
        $.post('_editAjax.php', {
          type:this.type,
          mode:'editsave',
          id:this.hidden.value,
          enemy:this.enemy.value,
          stage:this.stage.value
        });
        setTimeout(() => {
          location.href = "stageEdit.php";
        }, 2000);
      }
    });
  }
}
