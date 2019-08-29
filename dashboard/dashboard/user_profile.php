<!-- Modal -->
<form class="form-horizontal form-label-left"  enctype="multipart/form-data"  id="form_profile" name="form_profile" method="post" >

<div id="Modal_Profile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Profile</h4>
      </div>
      <div class="modal-body">
        <!-- <div class="item form-group">
             <center><img src="../pic/member/<?= $session_member_pic ?>" width="160px" height="200px"></center>
         </div> -->

         <div class="form-group">
           <label for="member_firstname" class="form-control-label">ชื่อ</label>
           <input type="text" class="form-control" name="member_firstname" id="member_firstname" value="<?= $session_member_firstname ?>" >
         </div>

         <div class="form-group">
           <label for="member_lastname" class="form-control-label">นามสกุล</label>
           <input type="text" class="form-control" name="member_lastname" id="member_lastname" value="<?= $session_member_lastname ?>" >
         </div>

         <div class="form-group">
           <label for="member_email" class="form-control-label">E-mail</label>
           <input type="text" class="form-control" name="member_email" id="member_email" value="<?= $session_member_email ?>" >
         </div>

         <div class="form-group">
           <label for="member_password" class="form-control-label">Password</label>
           <input type="password" class="form-control" name="member_password" id="member_password" value="<?= $session_member_password ?>" >
         </div>

         <div class="form-group">
           <label for="member_confirm_password" class="form-control-label">ยืนยัน Password</label>
           <input type="password" class="form-control" name="member_confirm_password" id="member_confirm_password" value="<?= $session_member_password ?>" >
         </div>
         <!-- <div class="form-group">
           <label for="member_pic" class="form-control-label">เลือกไฟล์เพื่อเปลี่ยนภาพ</label>
           <input type="file" class="form-control" name="member_pic" id="member_pic" value="<?= $session_member_pic ?>" >
         </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id = "appaction"  name = "appaction" value="profile" >Send</button>

      </div>
    </div>

  </div>
</div>
</form>
<script>
var password = document.getElementById("member_password")
  , confirm_password = document.getElementById("member_confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("กรุณากรอก Password ให้ตรงกัน");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
