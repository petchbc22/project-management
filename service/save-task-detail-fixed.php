<?php
//insert.php
include '../appsystem/inc_config.php';
error_reporting(~E_NOTICE);
$pt_id_md            = $_POST["pt_id_md"];
$tdf_name_md         = $_POST["tdf_name_md"];
$tdf_element         = preg_replace('/\s+/', '_', $tdf_name_md);   
   for($count = 0; $count<count($tdf_name_md); $count++)
   {
     $pt_id_md_clean = mysqli_real_escape_string($conn, $pt_id_md[$count]);
     $tdf_name_md_clean = mysqli_real_escape_string($conn, $tdf_name_md[$count]);
     $tdf_element_clean = mysqli_real_escape_string($conn, $tdf_element[$count]);
    //  $task_detail_clean = mysqli_real_escape_string($conn, $task_detail[$count]);

     $sql = "INSERT INTO task_detail_fixed (pt_id,tdf_name,tdf_element ) 
     VALUES ('".$pt_id_md_clean."','".$tdf_name_md_clean."','".$tdf_element_clean."')";
     $completed = mysqli_multi_query($conn, $sql);
   }
   if($completed == TRUE)
     {
       echo '1';
     }
   else
     {
       echo '0';
     }

 


mysqli_close($conn);
?>