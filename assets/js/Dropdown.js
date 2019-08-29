/* ---- สำหรับ dropdwon id = dropdtn กับ dropdown-contentSection ---- */
//Dropdown Section Dataform Start Process
function StartProcessDropdown() {
    document.getElementById("DropdownSection1").classList.toggle("show");
}
function ChooseVisibility(number){
    var element = document.getElementById("yourchoice");
    if(number == 1){
        element.classList= "far fa-eye-slash";
    }else if(number == 2){
        element.classList= "fas fa-pen";
    }else if(number == 3){
        element.classList= "fas fa-star-of-life";
    }
}

//Dropdown Section Dataform Task
function TaskDropdown() {
    document.getElementById("DropdownSectionTask").classList.toggle("show");
}
function ChooseVisibilityTask(number){
    var element = document.getElementById("yourchoiceTask");
    if(number == 1){
        element.classList = "far fa-eye-slash";
    }else if(number == 2){
        element.classList= "far fa-eye";
    }else if(number == 3){
        element.classList= "fas fa-pen";
    }else if(number == 4){
        element.classList= "fas fa-star-of-life";
    }
}

//Dropdown Section Dataform Approval
function ApprovalDropdown() {
    document.getElementById("DropdownSectionApproval").classList.toggle("show");
}
function ChooseVisibilityApproval(number){
    var element = document.getElementById("yourchoiceApproval");
    if(number == 1){
        element.classList= "far fa-eye-slash";
    }else if(number == 2){
        element.classList= "far fa-eye";
    }else if(number == 3){
        element.classList= "fas fa-pen";
    }else if(number == 4){
        element.classList= "fas fa-star-of-life";
    }
}

//Dropdown Dataform 
function DataformDropdown() {
    document.getElementById("DropdownDataform").classList.toggle("show");
}
function ChooseDataform(number){
    var element = document.getElementById("yourchoiceDataform");
    if(number == 1){
        element.classList= "fas fa-list";
    }else if(number == 2){
        element.classList= "fas fa-table";
    }
}

// สำหรับ Dropdown ทั้งหมด
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-contentSection");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
}
