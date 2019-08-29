//Link ต่างๆ
// Tab ตัวหลัก
function openItem(evt, itemName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(itemName).style.display = "block";
    evt.currentTarget.className += " active";
}
  
// Tab ให้ตัวเริ่มต้นแสดงผล :: Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

//หน้า Template li คลิกเพื่อเข้าไปในหน้า intemplate
function pageRedirect() {
  window.location.href = "Intemplate.html";
}  
//หน้า Process li เปลี่ยนหน้า
function pageProcess() {
  window.location.href = "Inprocess.html";
}  
//ปุ่ม Back
function gobackprocess(){
  window.history.back();
}

// หน้าInprocess ภายใน list Inprocess
//inprocess li :: task
function inprocesstask(){
  window.location.href = "inprocessTask.html";
}
//inprocess li :: approval
function inprocessapproval(){
  window.location.href = "inprocessApproval.html";
}

//inprocess li :: group
function inprocessgroup(){
  window.location.href = "inprocessGroup.html";
}








