// ----- PAGE :: Profile ----- //
//Tab General Setting
//ส่วนการอัพภาพแล้ว มีการแสดงภาพ
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picUpload')
                .attr('src', e.target.result)
                .css('display','block');
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById("defualtAvatarUpload").style.display = "none";
        document.getElementById("up-img").style.display = "none";
        document.getElementById("change-clear-photo").style.display = "block";
    }   
}
$('#ClearPhoto').click(function(){
    $('#picUpload').css('display','none');
    $('#defualtAvatarUpload').css('display','block');
    $('#up-img').css('display','block');
    $('#change-clear-photo').css('display','none');
})


// Tab Notification ***มีปัญหาเรื่องการ check
$('#Check-all').click(function(){
    $('input:checkbox,input:radio').attr('checked',true);
})
$('#Uncheck-all').click(function(){
    $('input:checkbox,input:radio').attr('checked',false);
})


// Tab Password
// ค่าจากตัว input new pass
var password = document.getElementById("new-pass");
// ค่าจาก form 
var styleNewPass = document.getElementById("box-newPass");

// เช็คค่าภายใน input new-pass
password.onkeyup = function(){
    // ถ้าpass น้อยกว่า 8 input new pass border is red และ message ใต้ newpass จะแสดง
    if(password.value.length <= 0){
        styleNewPass.classList.add("password-error");
        document.getElementById("message-newPass").style.display = "none";
        document.getElementById("message-required").style.display = "block";
    }
    else if(password.value.length > 0 && password.value.length < 8){
        styleNewPass.classList.add("password-error");
        document.getElementById("message-newPass").style.display = "block";
        document.getElementById("message-required").style.display = "none";
    }else{
        styleNewPass.classList.remove("password-error");
        document.getElementById("message-newPass").style.display = "none";
        document.getElementById("message-required").style.display = "none";
    }
}

// เช็คค่าภายใน input Re-pass
var repassword = document.getElementById("re-pass");
var styleRePass = document.getElementById("box-rePass");
repassword.onkeyup = function(){
    if(repassword.value.length >= 0 && repassword.value.length < 8){
        styleRePass.classList.add("password-error");
        document.getElementById("message-shouldMatch").style.display = "block";
        document.getElementById("changepassword").disabled = true;
        document.getElementById("changepassword").classList.add("btn-unclick");
        document.getElementById("changepassword").classList.remove("btn-green");

    //กรณีที่pass มากกว่า 8 
    }else if(repassword.value.length >= 8){
        //พาสตรงกัน ปุ่มจะใช้งานได้
        if(repassword.value == password.value){
            styleRePass.classList.remove("password-error");
            document.getElementById("message-shouldMatch").style.display = "none";
            //สิ่งที่เปลี่ยนแปลง disable หาย เปลี่ยนจาก unclick => start
            document.getElementById("changepassword").disabled = false;
            document.getElementById("changepassword").classList.remove("btn-unclick");
            document.getElementById("changepassword").classList.add("btn-green");
        //พาสไม่ตรงปุ่มใช้งานไม่ได้
        }else{
            styleRePass.classList.add("password-error");
            document.getElementById("message-shouldMatch").style.display = "block";
            document.getElementById("changepassword").disabled = true;
            document.getElementById("changepassword").classList.add("btn-unclick");
            document.getElementById("changepassword").classList.remove("btn-start");
        }
    }
}


