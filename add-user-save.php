<?php
//insert.php
include 'appsystem/inc_config.php';
header('Content-Type: application/json');

 $acc_email      = $_POST["acc_email"];
 $acc_username   = $_POST["acc_username"];
 $acc_name       = $_POST["acc_name"];
 $acc_lastname   = $_POST["acc_lastname"];
 $acc_password   = $_POST["acc_password"];
 $acc_permission = $_POST["acc_permission"];

$strchecke = "SELECT * FROM account WHERE acc_email = '".trim($acc_email)."' ";
$strchecke_query = mysqli_query($conn,$strchecke);
$strchecke_result = mysqli_fetch_array($strchecke_query,MYSQLI_ASSOC);

if($strchecke_result){
    echo json_encode(array('status' => '2','message'=> 'Email Already exit!'));
    exit();
}
if($acc_email == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input email'));
    exit();
}
if($acc_username == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input Username !'));
    exit();
}
$strcheck = "SELECT * FROM account WHERE acc_username = '".trim($acc_username)."' ";
$strcheck_query = mysqli_query($conn,$strcheck);
$strcheck_result = mysqli_fetch_array($strcheck_query,MYSQLI_ASSOC);
 if($strcheck_result){
    echo json_encode(array('status' => '2','message'=> 'Username Already exit!'));
    exit();
 }
if($acc_name == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input Name !'));
    exit();
}
if($acc_lastname == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input Lastname !'));
    exit();
}
if($acc_password == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input Password !'));
    exit();
}
if($acc_permission == ""){
    echo json_encode(array('status' => '2','message'=> 'Please input Permission !'));
    exit();
}
else{
    $sql_add_user = "INSERT INTO account (acc_username,acc_email,acc_name,acc_lastname,acc_password,acc_img,acc_permission,acc_status ) 
    VALUES ('".$acc_username."','".$acc_email."','".$acc_name."','".$acc_lastname."','".$acc_password."','avatar.png','".$acc_permission."','1')";
    if (mysqli_query($conn, $sql_add_user)){
        echo json_encode(array('status' => '1','message'=> 'Add User Completed'));
    }
}


 
mysqli_close($conn);
?>