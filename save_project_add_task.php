<?php
include 'appsystem/inc_config.php';
error_reporting(~E_NOTICE);

$tp_id_post                = $_POST["tp_id_post"];
$pj_process_title          = $_POST["pj_process_title"];
$pj_process_start          = $_POST["pj_process_start"];
$pj_process_deadline       = $_POST["pj_process_deadline"];
$project_main_assign_user  = $_POST["project_main_assign_user"];
$pj_instructions           = $_POST["pj_instructions"];
$color                     = $_POST["color"];
$task_title                = $_POST["task_title"];
$task_description          = $_POST["task_description"];
$pjt_starteddate           = $_POST["pjt_starteddate"];
$pjt_duedate               = $_POST["pjt_duedate"];


if ($pj_process_title ==""){
   echo 'กรุณาระบุชื่อโปรเจค';
}
else if($pj_process_start =="") {
 echo 'กรุณาระบุวันที่เริ่มโปรเจค';
}
else if ($pj_process_deadline ==""){
 echo 'กรุณาระบุวันที่สิ้นสุดโปรเจค';
}
else if($project_main_assign_user =="") {
 echo 'กรุณาระบุผู้มีส่วนเกี่ยวข้องในโปรเจค';
}
else if($pj_instructions =="") {
   echo 'กรุณาระบุคำแนะนำโปรเจค';
  }
else{
   $sql = "INSERT INTO project (tp_id,pj_process_title,pj_instructions,pj_process_start,pj_process_deadline,color,pj_user_ceate,pj_complete,pj_status ) 
   VALUES ('" . $tp_id_post . "','" . $pj_process_title . "','" . $pj_instructions . "','" . $pj_process_start . "','" . $pj_process_deadline . "','" . $color . "','" . $ss_acc_id . "','0','N')";

   if (mysqli_query($conn, $sql)) {

   $iLastID = mysqli_insert_id($conn);

   $count_project_main_assign_user = count($_POST["project_main_assign_user"]);
   for ($f = 0; $f<$count_project_main_assign_user; $f++)
   {
      $project_main_assign_user = $_POST["project_main_assign_user"][$f];
      $sql_command_add_fa = " INSERT INTO project_main_assign_user (pj_id ,acc_id,pmau_status) VALUES ($iLastID,$project_main_assign_user,'N')";
      $querys = mysqli_query($conn,$sql_command_add_fa);

   }
   // loop insert project task
   for ($count = 0; $count < count($task_title); $count++) {

      $task_title_clean = mysqli_real_escape_string($conn, $task_title[$count]);
      $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
      $pjt_starteddate_clean = mysqli_real_escape_string($conn, $pjt_starteddate[$count]);
      $pjt_duedate_clean     = mysqli_real_escape_string($conn, $pjt_duedate[$count]);

      $query = "INSERT INTO project_task(pj_id,pjt_title, pjt_description,pjt_complete,pjt_starteddate,pjt_duedate,pjt_status) 
      VALUES('" . $iLastID . "','" . $task_title_clean . "','" . $task_description_clean . "','0','" . $pjt_starteddate_clean . "','" . $pjt_duedate_clean . "','N')";
      $adb = mysqli_multi_query($conn, $query);
   }
   if ($adb == TRUE) {
      
         echo '1';
      } else {
         echo 'Error';
      }
   }
   else {
   echo json_encode(array('status' => '0', 'message' => 'Error insert data!'));
   }
   mysqli_close($conn);

}
