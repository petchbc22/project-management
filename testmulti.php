<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "vlog_management";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
	
		
            echo $sql = "INSERT INTO task (task_title,task_description) VALUES ('".$_POST["titletask$i"]."','".$_POST["Descriptiontask$i"]."')";
			echo $query = mysqli_query($conn,$sql);
		
		
	}

	echo "Record add successfully";
	mysqli_close($conn);
?>
</body>
</html>