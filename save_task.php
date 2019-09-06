<?php
//insert.php
include 'appsystem/inc_config.php';

 $pjt_id                 = $_POST["pjt_id"];
 $pjt_description        = $_POST["pjt_description"];
 $pjt_starteddate        = $_POST["pjt_starteddate"];
 $pjt_duedate            = $_POST["pjt_duedate"];
 $project_assign_user    = $_POST["project_assign_user"];

 $sql_updatetask = "UPDATE project_task SET 
          pjt_description = '".$pjt_description."' ,
          pjt_starteddate = '".$pjt_starteddate."' ,
          pjt_duedate = '".$pjt_duedate."' 
          WHERE pjt_id = '".$pjt_id."' ";


 
if (mysqli_query($conn, $sql_updatetask)){

  $sql_del_olduser = "UPDATE project_assign_user SET pau_status = 'D' WHERE pjt_id = '".$pjt_id."' ";
  if (mysqli_query($conn, $sql_del_olduser)){
    $count_project_assign_user = count($_POST["project_assign_user"]);
    for ($f = 0; $f<$count_project_assign_user; $f++)
    {
      $project_assign_user = $_POST["project_assign_user"][$f];
      $sql_command_add_fa = " INSERT INTO project_assign_user (pjt_id ,acc_id,pau_status) VALUES ($pjt_id,$project_assign_user,'N')";
      $query = mysqli_query($conn,$sql_command_add_fa);
  
    }
    
   

    if($query == TRUE){
      echo 'Completed';
    }
  }
}
else
{
  echo 'completed';
}
mysqli_close($conn);

 
 
 
?>