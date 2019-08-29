<?php
    include 'appsystem/inc_config.php';
	header('Content-Type: application/json');

// check ค่าชื่อซ้ำ
    $strSQL = "SELECT * FROM account WHERE Name = '".trim($_POST["InputUsername"])."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objQuery_result = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
// check ค่า อีเมลซ้ำ
	// $strSQLs = "SELECT * FROM customer WHERE Email = '".trim($_POST["Email"])."' ";
	// $objQuerys = mysqli_query($conn,$strSQLs);
	// $objQuery_results = mysqli_fetch_array($objQuerys,MYSQLI_ASSOC);
// ถ้า textbox ว่าง 
	if(trim($_POST["InputUsername"]) == "")
	{
		echo json_encode(array('status' => '4','message'=> 'กรุณากรอก USERNAME'));
		
	}
	else if ($objQuery_result){
		echo json_encode(array('status' => '1','message'=> 'กรุณากรอกรหัสผ่าน'));
	}
    // else if ($objQuery_results == TRUE){
	// 	echo json_encode(array('status' => '3','message'=> 'อีเมล '.$_POST["Email"].''.'ซ้ำ'));

	// }
	// else if ($objQuery_result ==TRUE){
	// 	echo json_encode(array('status' => '2','message'=> 'ชื่อผู้ใช้นี้ '.$_POST["name"].''.'ซ้ำ'));

	// }
	// else {
	// 	$sql = "INSERT INTO customer ( Name, Email, CountryCode) 
	// 	VALUES ('".$_POST["name"]."','".$_POST["Email"]."'
	// 	,'".$_POST["CountryCode"]."')";
	// $query = mysqli_query($conn,$sql);

	// if($query) {
    //     echo json_encode(array('status' => '1','message'=> $_POST["name"].''.'สำเร็จ'));
	// }
	else
	{
		echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
    }

	// }
   

	// mysqli_close($conn);
?>