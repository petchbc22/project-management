<?php
	header('Content-Type: application/json');

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "mydatabase";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if ($_POST["ddl"] == 1) {
		$nowdate = date("d-m-y", mktime(0, 0, 0, 7, 26, 2017));
	}
	else {
		$nowdate = 0;
	}
	$sql = "INSERT INTO test_ajax (name ,lastname,ddl) 
		VALUES ('".$_POST["name"]."','".$_POST["lastname"]."','$nowdate')";
	$query = mysqli_query($conn,$sql);

	if($query) {
		echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
	}
	else
	{
		echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
	}

	mysqli_close($conn);
?>