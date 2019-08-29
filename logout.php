<?php
	include 'appsystem/inc_config.php';
	// save logfile
	$acc_id = $_SESSION["acc_id"];
	$activity = "ออกจากระบบ";
	$sql = "INSERT INTO logfile (user,activity,time) VALUES ";
	$sql .= "('$acc_id','{$activity}',now())";
	$result = $conn->query($sql);
	session_destroy();
	header("location:login.php");
?>