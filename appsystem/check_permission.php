<?php
if (  $ss_member_id == ""   or   $ss_member_email == "" or $ss_member_permission == "" ) {
mysqli_close($conn);
    
$message = 'กรุณาเข้าสู่ระบบก่อน !!';
echo "<SCRIPT type='text/javascript'> //not showing me this
alert('$message');
window.location.replace(\"index.php\");
</SCRIPT>";
 exit();
 }
 ?>