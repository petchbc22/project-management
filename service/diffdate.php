<?php
//insert.php
include '../appsystem/inc_config.php';



      


          $sql_pre_collapse = "SELECT DATEDIFF(pjt_duedate,pjt_starteddate) As DiffDate FROM project_task WHERE pj_id = 72 " ;
          $sql_pre_collapse_result = $conn->query($sql_pre_collapse);
          $sql_pre_collapse_count = $sql_pre_collapse_result->num_rows;
          while($sql_pre_collapse_result_query = mysqli_fetch_array($sql_pre_collapse_result,MYSQLI_ASSOC)){
         
            $sum_date_task = $sql_pre_collapse_result_query["DiffDate"];
            echo $sum_date_task ; 
          }
       
mysqli_close($conn);
