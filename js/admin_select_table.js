
function showDiv(e){

    var value = this.value,
        idTable = 'select-'+value,
        adForm = this.form,
        classeSelect = "select-table-show",
        tableDivs = adForm.getElementsByClassName("select-table");

  /* process all the divs with class = "select-table", 
     compare each id with the one we choose and when match,
     change the class for "select-table-show" css do the rest */

    for(var i = 0; i < tableDivs.length; i++){
      var elem = tableDivs[i];
      if(elem.id == idTable){
        elem.classList.add(classeSelect)
      }else{ 
        elem.classList.remove(classeSelect)
      }
    }
  }
  

// when a table is selected -> function showDiv
document.addEventListener('DOMContentLoaded',function(){
  var adForm = document.forms['adminForm'];
  adForm['table-select'].addEventListener('change',showDiv);
  });