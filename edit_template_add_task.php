<?php
//insert.php
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
   //  for update main information project
    $tp_id_post            = $_POST["tp_id_post"];
    $tp_name               = $_POST["tp_name"];
    $tp_title              = $_POST["tp_title"];
    $tp_instruc            = $_POST["tp_instruc"];
    $tp_description        = $_POST["tp_description"];
    $task_title_adds       = $_POST["task_title_adds"];

    $task_id_post          = $_POST["task_id_post"];
    $task_title            = $_POST["task_title"];
    $task_description      = $_POST["task_description"];
    $task_title_add        = $_POST["task_title_add"];
    $task_description_add  = $_POST["task_description_add"];
    $template_editors      = $_POST["template_editors"];

   if(empty($task_title_adds)) {

      $sql_update_fst_info = "UPDATE template SET 
      tp_name           = '".$tp_name."' ,
      tp_title          = '".$tp_title."' ,
      tp_instruc        = '".$tp_instruc."' ,
      tp_description    = '".$tp_description."' 
      WHERE tp_id = '".$tp_id_post."' ";

      if (mysqli_query($conn, $sql_update_fst_info)){

         $sql_re_status = "UPDATE template_editors SET te_status = 'D' WHERE tp_id = '$tp_id_post'";

         if (mysqli_query($conn, $sql_re_status)){

            $count_template_editors = count($_POST["template_editors"]);
            for ($f = 0; $f<$count_template_editors; $f++)
            {
              $template_editors = $_POST["template_editors"][$f];
              $sql_command_add_fa = " INSERT INTO template_editors (tp_id ,acc_id,te_status) VALUES ($tp_id_post,$template_editors,'N')";
              $query = mysqli_query($conn,$sql_command_add_fa);
          
            }

            for($count = 0; $count<count($task_id_post); $count++)
            {
               $task_id_post_clean     = mysqli_real_escape_string($conn, $task_id_post[$count]);
               $task_title_clean       = mysqli_real_escape_string($conn, $task_title[$count]);
               $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
               
               $sql_update_old_task = "UPDATE task SET 
                  task_title       = '".$task_title_clean."', 
                  task_description = '".$task_description_clean."'
                  WHERE task_id = '".$task_id_post_clean."' ";
               $complete_update = mysqli_multi_query($conn, $sql_update_old_task);
            }

           
         }
         if ($complete_update == TRUE){
            echo 'Update Project Completed';
         }
      }
   }
   else{
        $sql_update_fst_info = "UPDATE template SET 
        tp_name           = '".$tp_name."' ,
        tp_title          = '".$tp_title."' ,
        tp_instruc        = '".$tp_instruc."' ,
        tp_description    = '".$tp_description."' 
        WHERE tp_id = '".$tp_id_post."' ";

        if (mysqli_query($conn, $sql_update_fst_info)){

            $sql_re_status = "UPDATE template_editors SET te_status = 'D' WHERE tp_id = '$tp_id_post'";
            
            if (mysqli_query($conn, $sql_re_status)){
               // loop for edit user template
               $count_template_editors = count($_POST["template_editors"]);
               for ($f = 0; $f<$count_template_editors; $f++)
               {
                 $template_editors = $_POST["template_editors"][$f];
                 $sql_command_add_fa = " INSERT INTO template_editors (tp_id ,acc_id,te_status) VALUES ($tp_id_post,$template_editors,'N')";
                 $af = mysqli_query($conn,$sql_command_add_fa);
             
               }
               // loop for update task
               for($count = 0; $count<count($task_id_post); $count++)
               {
                  $task_id_post_clean = mysqli_real_escape_string($conn, $task_id_post[$count]);
                  $task_title_clean       = mysqli_real_escape_string($conn, $task_title[$count]);
                  $task_description_clean = mysqli_real_escape_string($conn, $task_description[$count]);
                  
                  $sql_update_old_task = "UPDATE task SET 
                     task_title       = '".$task_title_clean."', 
                     task_description = '".$task_description_clean."'
                     WHERE task_id = '".$task_id_post_clean."' ";
                  $complete_update = mysqli_multi_query($conn, $sql_update_old_task);
               }
               if($complete_update == TRUE){
                  for($countinsert = 0; $countinsert<count($task_title_add); $countinsert++)
                  {
                  
                  $task_title_add_clean         = mysqli_real_escape_string($conn, $task_title_add[$countinsert]);
                  $task_description_add_clean   = mysqli_real_escape_string($conn, $task_description_add[$countinsert]);
               
                  $query = "INSERT INTO task(tp_id,task_title,task_description,task_status) 
                  VALUES('".$tp_id_post."','".$task_title_add_clean."','".$task_description_add_clean."','N')"; 
                  $adb = mysqli_multi_query($conn, $query);
                  }
                  if($adb == TRUE){
                     echo 'Update and add new Task Project Completed';
                  }
               } 
            }
        }
   }
mysqli_close($conn);
?>