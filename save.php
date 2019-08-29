<?php 
	header('Content-Type: application/json');
	session_start();
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "vlog_management";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset( $conn, 'utf8');
	mysqli_query($conn , "SET NAMES 'utf8';");
	mysqli_query($conn , "SET CHARACTER SET 'utf8';");
    mysqli_query($conn , "SET COLLATION_CONNECTION = 'utf8_general_ci';");
    
    $pjt_id             = $_POST["pjt_id"];
    $pjt_description    = $_POST["pjt_description"];
    $pjt_starteddate    = $_POST["pjt_starteddate"];
    $pjt_duedate        = $_POST["pjt_duedate"];

    $sql = "UPDATE project_task SET pjt_description = '$pjt_description' ,pjt_starteddate = '$pjt_starteddate' ,pjt_duedate = '$pjt_duedate'
    WHERE pjt_id = '$pjt_id' ";
    $query = mysqli_query($conn,$sql);
    // $sql = "UPDATE project_task SET 
    // pjt_description = '".$_POST["pjt_description"]."' ,
    // pjt_starteddate = '".$_POST["pjt_starteddate"]."' ,
    // pjt_duedate = '".$_POST["pjt_duedate"]."' ,
    // WHERE pjt_id = '157' ";
    // $query = mysqli_query($conn,$sql);

    if($query) {
        $count = count($_POST["project_assign_user"]);
        for ($f = 0; $f<$count; $f++)
           {
               $fa_name = $_POST["project_assign_user"][$f];
               $sql_command_add_fa = " INSERT INTO project_assign_user ( pjt_id,acc_id ) VALUES ('$pjt_id','$fa_name')";
               $query = mysqli_query($conn,$sql_command_add_fa);
               if ($query) {
                   echo json_encode(array('status' => '1','message'=> 'สำเร็จ'));
               }
           }
    }

  

        
?>