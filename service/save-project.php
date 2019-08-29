<?php
//insert.php
include '../appsystem/inc_config.php';
error_reporting(~E_NOTICE);
$pj_name            = $_POST["pj_name"];
$pj_duedate         = $_POST["pj_duedate"];
$pj_process_start   = $_POST["pj_process_start"];
$pj_customer        = $_POST["pj_customer"];
$task_name          = $_POST["task_name"];
$pt_id              = $_POST["pt_id"];
$task_duedate       = $_POST["task_duedate"];
$task_detail        = $_POST["task_detail"];

  $sql = "INSERT INTO project (tp_id,pj_process_title,pj_instructions,pj_customner,pj_process_start,pj_process_deadline,pj_dayofwork,color,pj_user_ceate,pj_complete,pj_status ) 
  VALUES ('0','".$pj_name."','0','$pj_customer','$pj_process_start','".$pj_duedate."','0','0','".$ss_acc_id."','0','N')";
 
 if (mysqli_query($conn, $sql)){
  $iLastID = mysqli_insert_id($conn);
   for($count = 0; $count<count($task_name); $count++)
   {
     $task_name_clean = mysqli_real_escape_string($conn, $task_name[$count]);
     $pt_id_clean = mysqli_real_escape_string($conn, $pt_id[$count]);
     $task_duedate_clean = mysqli_real_escape_string($conn, $task_duedate[$count]);
     $task_detail_clean = mysqli_real_escape_string($conn, $task_detail[$count]);

     $sql = "INSERT INTO project_task (pj_id,pt_id,pjt_title,pjt_description,pjt_colorstatus,pjt_complete,pjt_starteddate,pjt_duedate,pjt_status ) 
     VALUES ('".$iLastID."','".$pt_id_clean."','".$task_name_clean."','".$task_detail_clean."','#f75f5f','0','".$pj_process_start."','".$task_duedate_clean."','N')";
     $completed = mysqli_multi_query($conn, $sql);
   }
   if($completed == TRUE)
     {
      $cal_diffdate = "SELECT DATEDIFF(pj_process_deadline,pj_process_start) As DiffDate FROM project WHERE pj_id = '$iLastID' ";
      $cal_diffdate_query = mysqli_query($conn,$cal_diffdate);
      $cal_diffdate_result = mysqli_fetch_array($cal_diffdate_query,MYSQLI_ASSOC);
      $sum_date = $cal_diffdate_result["DiffDate"];

      $sql = "UPDATE project SET pj_dayofwork = '".$sum_date."' WHERE pj_id = '$iLastID' ";
      $query = mysqli_query($conn,$sql);
      if($query == TRUE){
        echo '1';      }
     }
   else
     {
       echo '0';
     }
 }
 else
 {
   echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
 }


mysqli_close($conn);
