//document.write("This is written from JavaScript");

function showDiv(e){

    var value = this.value,
        idTable = 'select-'+value,
        adForm = this.form,
        classeSelect = "select-table-show",
        tableDivs = adForm.getElementsByClassName("select-table");

    for(var i = 0; i < tableDivs.length; i++){
      var elem = tableDivs[i];
      if(elem.id == idTable){
        elem.classList.add(classeSelect)
      }else{ 
        elem.classList.remove(classeSelect)
      }
    }
  }
  //Quand le DOm est dispo
  document.addEventListener('DOMContentLoaded',function(){
    var adForm = document.forms['adminForm'];
    adForm['table-select'].addEventListener('change',showDiv);
  });