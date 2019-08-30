<?php
//insert.php
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
   //  for update main information project
   $pj_id_post                = $_POST["pj_id_post"];
   $pj_process_title          = $_POST["pj_process_title"];
   $pj_process_start          = $_POST["pj_process_start"];
   $pj_process_deadline       = $_POST["pj_process_deadline"];
   $pj_diff_date              = $_POST["pj_diff_date"];
   $pj_instructions           = $_POST["pj_instructions"];
   $project_main_assign_user  = $_POST["project_main_assign_user"];
   $color                     = $_POST["color"];
   //  for update old task
   $pjt_id_post               = $_POST["pjt_id_post"];
   $task_title                = $_POST["task_title"];
   $task_description          = $_POST["task_description"];
   $pjt_starteddate           = $_POST["pjt_starteddate"];
   $pjt_duedate               = $_POST["pjt_duedate"];
   $pjt_diff_date             = $_POST["pjt_diff_date"];
   //  get value for check value isset in save_project_add_task.php 
   $task_title_adds           = $_POST["task_title_adds"];
   //  for new task
   $task_title_add            = $_POST["task_title_add"];
   $task_description_add      = $_POST["task_description_add"];
   $pjt_starteddate_add       = $_POST["pjt_starteddate_add"];
   $pjt_duedate_add           = $_POST["pjt_duedate_add"];

   if(empty($task_title_adds)) {

      $sql_update_fst_info = "UPDATE project SET 
      pj_process_title     = '".$pj_process_title."' ,
      pj_instructions      = '".$pj_instructions."' ,
      pj_process_start     = '".$pj_process_start."' ,
      pj_process_deadline  = '".$pj_process_deadline."' ,
      pj_dayofwork         = '".$pj_diff_date."' ,
      color                = '".$color."' ,
      pj_complete          = '0',
      pj_status            = 'N'
      WHERE pj_id = '".$pj_id_post."' ";

      if (mysqli_query($conn, $sql_update_fst_info)){

         for($count = 0; $count<count($pjt_id_post); $count++)
         {
            $pjt_id_post_post_clean = mysqli_real_escape_string($conn, $pjt_id_post[$count]);
            $task_title_clean       = mysqli_real_escape_string($conn, $task_title[$count]);
            $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
            $pjt_starteddate_clean  = mysqli_real_escape_string($conn, $pjt_starteddate[$count]);
            $pjt_duedate_clean      = mysqli_real_escape_string($conn, $pjt_duedate[$count]);
            $pjt_diff_date_clean    = mysqli_real_escape_string($conn, $pjt_diff_date[$count]);
            $sql_update_old_task = "UPDATE project_task SET 
               pjt_title       = '".$task_title_clean."', 
               pjt_description = '".$task_description_clean."',
               pjt_starteddate = '".$pj_process_start."',
               pjt_duedate     = '".$pjt_duedate_clean."',
               pjt_dayofwork   = '".$pjt_diff_date_clean."'
               WHERE pjt_id = '".$pjt_id_post_post_clean."' ";
            $complete_update = mysqli_multi_query($conn, $sql_update_old_task);
         }
         if ($complete_update == TRUE){
            $sql_reset = "UPDATE project_main_assign_user SET pmau_status = 'D' WHERE pj_id = '".$pj_id_post."' ";
            if(mysqli_query($conn, $sql_reset)) {

               $count_project_main_assign_user = count($_POST["project_main_assign_user"]);
               for ($f = 0; $f<$count_project_main_assign_user; $f++)
               {
                  $project_main_assign_user = $_POST["project_main_assign_user"][$f];
                  $sql_command_add_fa = " INSERT INTO project_main_assign_user (pj_id ,acc_id,pmau_status) VALUES ($pj_id_post,$project_main_assign_user,'N')";
                  $querys = mysqli_query($conn,$sql_command_add_fa);
            
               }
            }
            if ($querys == TRUE){
               echo 'Update Project Completed';
            }
         }
      }
   }
   else{
      $sql_update_fst_info = "UPDATE project SET 
      pj_process_title     = '".$pj_process_title."' ,
      pj_instructions      = '".$pj_instructions."' ,
      pj_process_start     = '".$pj_process_start."' ,
      pj_process_deadline  = '".$pj_process_deadline."' ,
      color                = '".$color."' ,
      pj_complete          = '0',
      pj_status            = 'N'
      WHERE pj_id = '".$pj_id_post."' ";

      if (mysqli_query($conn, $sql_update_fst_info)){
        // loop for update task
         for($count = 0; $count<count($pjt_id_post); $count++)
         {
            $pjt_id_post_post_clean = mysqli_real_escape_string($conn, $pjt_id_post[$count]);
            $task_title_clean       = mysqli_real_escape_string($conn, $task_title[$count]);
            $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
            // $pjt_starteddate_clean  = mysqli_real_escape_string($conn, $pjt_starteddate[$count]);
            $pjt_duedate_clean      = mysqli_real_escape_string($conn, $pjt_duedate[$count]);
            
            $sql_update_old_task = "UPDATE project_task SET 
               pjt_title       = '".$task_title_clean."', 
               pjt_description = '".$task_description_clean."',
               pjt_starteddate = '".$pj_process_start."',
               pjt_duedate     = '".$pjt_duedate_clean."'
               WHERE pjt_id = '".$pjt_id_post_post_clean."' ";
            $complete_update = mysqli_multi_query($conn, $sql_update_old_task);
         }
         if($complete_update == TRUE){
            for($countinsert = 0; $countinsert<count($task_title_add); $countinsert++)
            {
            
             $task_title_add_clean         = mysqli_real_escape_string($conn, $task_title_add[$countinsert]);
             $task_description_add_clean   = mysqli_real_escape_string($conn, $task_description_add[$countinsert]);
             $pjt_starteddate_add_clean    = mysqli_real_escape_string($conn, $pjt_starteddate_add[$countinsert]);
             $pjt_duedate_add_clean        = mysqli_real_escape_string($conn, $pjt_duedate_add[$countinsert]);
        
             $query = "INSERT INTO project_task(pj_id,pjt_title, pjt_description,pjt_complete,pjt_starteddate,pjt_duedate,pjt_status) 
             VALUES('".$pj_id_post."','".$task_title_add_clean."','".$task_description_add_clean."','0','".$pjt_starteddate_add_clean."','".$pjt_duedate_add_clean."','N')"; 
             $adb = mysqli_multi_query($conn, $query);
             }
             if($adb == TRUE){
               $sql_reset = "UPDATE project_main_assign_user SET pmau_status = 'D' WHERE pj_id = '".$pj_id_post."' ";
               if(mysqli_query($conn, $sql_reset)) {
   
                  $count_project_main_assign_user = count($_POST["project_main_assign_user"]);
                  for ($f = 0; $f<$count_project_main_assign_user; $f++)
                  {
                     $project_main_assign_user = $_POST["project_main_assign_user"][$f];
                     $sql_command_add_fa = " INSERT INTO project_main_assign_user (pj_id ,acc_id,pmau_status) VALUES ($pj_id_post,$project_main_assign_user,'N')";
                     $querys = mysqli_query($conn,$sql_command_add_fa);
               
                  }
               }
               if ($querys == TRUE){
                  echo 'Update and add new Task Project Completed';
               }
               //  echo 'Update and add new Task Project Completed';
             }
         }
          // loop for insert Newtask
   
        
      }
   }
mysqli_close($conn);
?>