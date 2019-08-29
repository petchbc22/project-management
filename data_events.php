<?php
	header('Content-Type: application/json');

  include 'appsystem/inc_config.php';


  if($ss_acc_permission == 0 || $ss_acc_permission == 1){
	$sql = "SELECT DISTINCT pjt_title AS title,  pjt_duedate AS start , CONCAT('show-task-detail.php?pjt_id=', pjt_id)  AS url , color FROM vw_assign_taskname WHERE pau_status = 'N' ";

	$query = mysqli_query($conn,$sql);
  $resultArray = array();
 
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		array_push($resultArray,$result);
	}
	mysqli_close($conn);

	echo json_encode($resultArray,JSON_PRETTY_PRINT);
  }
  else {
	$sql = "SELECT  pjt_title AS title,  pjt_duedate AS start , CONCAT('show-task-detail.php?pjt_id=', pjt_id)  AS url , color FROM vw_assign_taskname WHERE acc_id = '$ss_acc_id' AND pau_status = 'N' ";

	$query = mysqli_query($conn,$sql);
  $resultArray = array();
 
	while($result = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
		array_push($resultArray,$result);
	}
	mysqli_close($conn);

	echo json_encode($resultArray,JSON_PRETTY_PRINT);
  }

?>