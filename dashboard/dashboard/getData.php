<?php

	$objConnect = mysql_connect("localhost","buzzbkkc","10klikes") or die(mysql_error());
	$objDB = mysql_select_db("buzzbkkc_pm");
	$strSQL = "SELECT * FROM pm_task WHERE R_STATUS_STAFF = 'NO' ORDER BY TASK_ID DESC LIMIT 0,1";
	$objQuery = mysql_query($strSQL) or die (mysql_error());
	$intNumField = mysql_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}

	mysql_close($objConnect);

	echo json_encode($resultArray);
?>
