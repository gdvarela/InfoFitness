confirmdelete = function(){
  var btn1 = document.getElementById('delete');
  var modal = document.getElementById('deletemodal');
  var btn2 = document.getElementById('canceldelete');

  if(btn1){
    btn1.onclick = function(){
      modal.style.display = "block";
    };
  }

  if(btn2){
    btn2.onclick = function(){
      modal.style.display = "none";
    };
  }
};

window.onload = function(){
  confirmdelete();
};
