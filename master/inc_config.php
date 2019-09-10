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
  $ss_acc_id = $_SESSION["acc_id"];
  $ss_acc_username = $_SESSION["acc_username"];
  $ss_acc_password = $_SESSION["acc_password"];
  $ss_acc_permission = $_SESSION["acc_permission"];

  if (  $ss_acc_id == ""   or   $ss_acc_username == "" or $ss_acc_password == "" ) {
      mysqli_close($conn);
          
      $message = 'กรุณาเข้าสู่ระบบก่อน !!';
      echo "<SCRIPT type='text/javascript'> //not showing me this
      alert('$message');
      window.location.replace(\"login.php\");
      </SCRIPT>";
      exit();
      }
?>
