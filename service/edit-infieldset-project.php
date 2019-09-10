<?php
//insert.php
include '../appsystem/inc_config.php';
error_reporting(~E_NOTICE);
$ss_pj_id           = $_POST["ss_pj_id"];
$pj_name            = $_POST["pj_name"];
$pj_duedate         = $_POST["pj_duedate"];
$pj_process_start   = $_POST["pj_process_start"];
$pj_customer        = $_POST["pj_customer"];
$task_name          = $_POST["task_name"];
$tdf_id             = $_POST["tdf_id"];
$pt_id              = $_POST["pt_id"];
$task_duedate       = $_POST["task_duedate"];
$diffdate           = $_POST["diffdate"];
$task_detail        = $_POST["task_detail"];

  // เข้า for loop insert project task โดยจับจาก taskname 
   for($count = 0; $count<count($task_name); $count++)
   {
     $task_name_clean     = mysqli_real_escape_string($conn, $task_name[$count]);
     $pt_id_clean         = mysqli_real_escape_string($conn, $pt_id[$count]);
     $tdf_id_clean        = mysqli_real_escape_string($conn, $tdf_id[$count]);
     $task_duedate_clean  = mysqli_real_escape_string($conn, $task_duedate[$count]);
     $task_detail_clean   = mysqli_real_escape_string($conn, $task_detail[$count]);
     $diffdate_clean      = mysqli_real_escape_string($conn, $diffdate[$count]);

     $sql = "INSERT INTO project_task (pj_id,pt_id,tdf_id,pjt_title,pjt_description,pjt_colorstatus,pjt_complete,pjt_starteddate,pjt_duedate,pjt_dayofwork,pjt_status ) 
     VALUES ('".$ss_pj_id."','".$pt_id_clean."','".$tdf_id_clean."','".$task_name_clean."','".$task_detail_clean."','#f75f5f','0','".$pj_process_start."','".$task_duedate_clean."','".$diffdate_clean."','N')";
     $completed = mysqli_multi_query($conn, $sql);
   }
  //  ถ้า loop project task สำเร็จ 
   if($completed == TRUE)
     {
 

            echo '1';
     
     }
   else
     {
       echo '0';
     }



mysqli_close($conn);
