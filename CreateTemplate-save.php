<?php
//insert.php
include 'appsystem/inc_config.php';
error_reporting(~E_NOTICE);
$task_title         = $_POST["task_title"];
$task_description   = $_POST["task_description"];
$tp_name            = $_POST["tp_name"];
$tp_title           = $_POST["tp_title"];
$tp_instruc         = $_POST["tp_instruc"];
$tp_description     = $_POST["tp_description"];
$template_editors   = $_POST["template_editors"];



// $errors = array_filter($errors);
if($tp_name == ""){
    echo 'กรุณากรอกชื่อเทมเพลส';
}
else if ($tp_title ==""){
    echo 'กรุณากรอกหัวข้อเทมเพลส';
}
else if($tp_instruc =="") {
  echo 'กรุณากรอกคำแนะนำ';
}
else if ($template_editors ==""){
  echo 'กรุณาเลือกผู้มีสิทธิ์แก้ไขเทมเพลส';
}

// else if($idx =""){
//   echo 'xxxx';
// }
else{
  $sql = "INSERT INTO template (tp_name,tp_title,tp_instruc,tp_description,tp_user_create,tp_datecreate,tp_status ) 
  VALUES ('".$tp_name."','".$tp_title."','".$tp_instruc."','".$tp_description."','".$ss_acc_id."',now(),'N')";
 
 if (mysqli_query($conn, $sql)){
  // Get lastid form table template
 
   $iLastID = mysqli_insert_id($conn);
   $count_template_editors = count($_POST["template_editors"]);
   for ($f = 0; $f<$count_template_editors; $f++)
   {
     $template_editors = $_POST["template_editors"][$f];
     $sql_command_add_fa = " INSERT INTO template_editors (tp_id ,acc_id,te_status) VALUES ($iLastID,$template_editors,'N')";
     $query = mysqli_query($conn,$sql_command_add_fa);
 
   }
   for($count = 0; $count<count($task_title); $count++)
   {
     $task_title_clean = mysqli_real_escape_string($conn, $task_title[$count]);
     $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
 
     $sql = "INSERT INTO task (tp_id,task_title,task_description,task_status ) 
     VALUES ('".$iLastID."','".$task_title_clean."','".$task_description_clean."','N')";
     $completed = mysqli_multi_query($conn, $sql);
   }
   if($completed == TRUE)
     {
       echo '1';
     }
   else
     {
       echo 'โปรดระบุ Task งาน';
     }
 }
 else
 {
   echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
 }
}

mysqli_close($conn);
?>