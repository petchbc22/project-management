<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
</head>
<body>
<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

$config_set = "local";
if ($config_set == "local"){
    $config_server = "localhost";
    $config_database = "vlog_management";
    $config_username = "root";
    $config_password = "";
    $config_port = "" ;
}

$conn = new mysqli( $config_server, $config_username, $config_password, $config_database);
mysqli_set_charset( $conn, 'utf8');
mysqli_query($conn , "SET NAMES 'utf8';");
mysqli_query($conn , "SET CHARACTER SET 'utf8';");
mysqli_query($conn , "SET COLLATION_CONNECTION = 'utf8_general_ci';");

// Check connection
if ($conn->connect_error) {
    die("Connection failed : ");
}


  if (empty($_REQUEST["appaction"])) { $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }

  if ($appaction == "systemlogin"){
    if (empty($_REQUEST['acc_username'])) { $acc_username = ""; } else { $acc_username = $_REQUEST["acc_username"]; }
    if (empty($_REQUEST['acc_password'])) { $acc_password = ""; } else { $acc_password = $_REQUEST["acc_password"]; }

    $sql_login = " SELECT * FROM account WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND acc_status = '1'";

    $data_result = $conn->query($sql_login);
    $data_count = $data_result->num_rows;
    if ($data_count == 1 ) {
        if ($data_result){
            $result_rs = mysqli_fetch_assoc($data_result);
            $acc_id = $result_rs["acc_id"];
            $acc_username= $result_rs["acc_username"];
            $acc_password= $result_rs["acc_password"];
            $acc_permission = $result_rs["acc_permission"];
            // save logfile
            $activity = "เข้าสู่ระบบ";
            $sql = "INSERT INTO logfile (user,activity,time) VALUES ";
            $sql .= "('$acc_id','{$activity}',now())";
            $result = $conn->query($sql);

            }
            $_SESSION["acc_id"] = $acc_id;
            $_SESSION["acc_username"] = $acc_username;
            $_SESSION["acc_password"] = $acc_password;
            $_SESSION["acc_permission"] = $acc_permission;
            mysqli_close($conn);
            // echo $member_id.' '.$member_email;
      
                header("Location:process.php");
            
            // else if ($member_permission == 1 && $approve == 0 ) {
            // session_destroy();  
            // echo '<script>
            //     setTimeout(function() {
            //         swal({
            //             title: "กรุณายืนยันตัวตนก่อน!",
            //             text: "กรุณาตรวจสอบอีเมลของท่าน !",
            //             type: "success"
            //         }).then(function() {
            //             window.location = "index.php";
            //         });
            //     }, 300);
            // </script>';           
            // }
    }
    else {
        session_destroy(); 
        // echo '<script>Swal.fire("ไม่พบชื่อผู้ใช้งานในระบบ")</script>';  
        echo '<script>
        setTimeout(function() {
            swal({
                title: "ไม่พบชื่อผู้ใช้งานในระบบ !",
                text: "กรุณาตรวจสอบ Username และ Password",
                type: "warning"
            });
        }, 300);
        </script>'; 
    }
 }
 ?>
    <div id="login-box">
        <div class="mg-t-30">
            <div>
                <img class="logo" src="assets/img/LOGO-02.png" alt="logo">
            </div>
            <form style="d-flex justify-content-center" method="post" action="Login.php">
                <div id="form-style" class="shadow-sm">
                    <div class="form-group">
                        <label for="acc_username">Username</label>
                        <input type="text" class="form-control" id="acc_username" name="acc_username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="acc_password">Password</label>
                        <input type="password" class="form-control" id="acc_password" name="acc_password" placeholder="Password" required>
                    </div>
                    <?php
                        print "  <input type=\"hidden\" name=\"appaction\" id=\"appaction\" value=\"systemlogin\">";
                    ?>
                    <div class="form-group mb-0 text-center py-2">
                        <button type="submit" class="btn btn-primary w-75" name="loginbtn" id="loginbtn">Log in</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
   
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>

</body>
</html>