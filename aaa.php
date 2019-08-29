<?php
//insert.php

$config_set = "local";
if ($config_set == "local"){
    $config_server = "localhost";
    $config_database = "mydatabase";
    $config_username = "root";
    $config_password = "";
    $config_port = "" ;
}
$conn = new mysqli( $config_server, $config_username, $config_password, $config_database);
mysqli_set_charset( $conn, 'utf8');
mysqli_query($conn , "SET NAMES 'utf8';");
mysqli_query($conn , "SET CHARACTER SET 'utf8';");
mysqli_query($conn , "SET COLLATION_CONNECTION = 'utf8_general_ci';");

    $addname = $_POST["addname"];
    $addlname = $_POST["addlname"];
    $id   = $_POST["id"];
    $name   = $_POST["name"];
    $lname  = $_POST["lname"];


    if(in_array('', array_map('trim',$addname))) {
        for($count = 0; $count<count($id); $count++)
        {
         $id_clean = mysqli_real_escape_string($conn, $id[$count]);
         $name_clean = mysqli_real_escape_string($conn, $name[$count]);
         $lname_clean = mysqli_real_escape_string($conn, $lname[$count]);
         $strSQL = "UPDATE test_update SET name = '".$name_clean."', lname = '".$lname_clean."' WHERE id = '".$id_clean."' ";
         $adb = mysqli_multi_query($conn, $strSQL);
 
        }
        if($adb == TRUE){
            echo 'Completed update';
         }
        }
        else{
            for($count = 0; $count<count($id); $count++)
            {
             $id_clean = mysqli_real_escape_string($conn, $id[$count]);
             $name_clean = mysqli_real_escape_string($conn, $name[$count]);
             $lname_clean = mysqli_real_escape_string($conn, $lname[$count]);
             
             $strSQL = "UPDATE test_update SET name = '".$name_clean."', lname = '".$lname_clean."' WHERE id = '".$id_clean."' ";
             $adb = mysqli_multi_query($conn, $strSQL);
            }
            if($adb == TRUE)
            {
                for($count = 0; $count<count($addname); $count++)
                {
                 $addname_clean = mysqli_real_escape_string($conn, $addname[$count]);
                 $addlname_clean = mysqli_real_escape_string($conn, $addlname[$count]);

                 $sqls = "INSERT INTO test_update (pj_id,name,lname,status) 
                 VALUES ('2','".$addname_clean."','".$addlname_clean."','1')";
                 $adbs = mysqli_multi_query($conn, $sqls);
                
                }
                if($adbs == TRUE){
                    echo 'Completed update and insert';
                 }
            }
           else
           {
            echo 'Error';
           }
        }
    // if ($_POST["addname"] == "") {
      
    
mysqli_close($conn);
?>