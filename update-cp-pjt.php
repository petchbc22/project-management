<?php
//insert.php

include 'appsystem/inc_config.php';
    $pjt_id  = $_POST["pjt_id"];
    $pj_id   = $_POST["pj_id"];

    $sql_pjt = "SELECT * FROM project_task WHERE pjt_id = '$pjt_id'  ";
    $pjt_query = mysqli_query($conn, $sql_pjt);
    $pjt_result = mysqli_fetch_array($pjt_query, MYSQLI_ASSOC);
    $res_pjt_complete = $pjt_result["pjt_complete"];

 if( $res_pjt_complete == 1 ){
    $sql_updatetask = "UPDATE project_task SET 
    pjt_colorstatus = '#28a745',
    pjt_complete = '2' 

    WHERE pjt_id = '".$pjt_id."' ";
    if (mysqli_query($conn, $sql_updatetask)){
        
        $sql1 = "SELECT * FROM project_task WHERE pj_id = $pj_id  ";
        $sql1_query = $conn->query($sql1);
        $sql1_count = $sql1_query->num_rows;
        // นับการตอบกลับของผู้ที่ได้รับงาน
        $sql2 = "SELECT * FROM project_task WHERE pj_id = $pj_id AND pjt_complete = 2  ";
        $sql2_query = $conn->query($sql2);
        $sql2_count = $sql2_query->num_rows;
        
        if($sql1_count == $sql2_count ){
            $sql = "UPDATE project SET pj_complete = '1' WHERE pj_id = '$pj_id'";
            $query = mysqli_query($conn, $sql);
           
        }
        echo 'Project Task Complete Approve By Manager';
    }
    else {
        echo 'uncompleted';
    }
 }else{
    $sql_updatetask = "UPDATE project_task SET 
    pjt_colorstatus = '#ffdd00',
    pjt_complete = '1' 
    WHERE pjt_id = '".$pjt_id."' ";
    if (mysqli_query($conn, $sql_updatetask)){
        echo 'Project Task Cancel By Manager';
    }
    else {
        echo 'uncompleted';
    }
 }

mysqli_close($conn);
?>