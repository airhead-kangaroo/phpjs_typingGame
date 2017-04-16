$(function(){
  'use strict'
  var flag = document.getElementById('flag').value
  if(flag * 1 === 0){
    $('#successInfo').fadeOut(3000)
  }else{
    $('#successInfo').hide();
  }
});
