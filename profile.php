<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include 'appsystem/inc_config.php';

            
    

    //   displayprofile
    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'";
    $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);

    $acc_username = $SQL_PROFILE_RESULT["acc_username"];
    $acc_name = $SQL_PROFILE_RESULT["acc_name"];
    $acc_password = $SQL_PROFILE_RESULT["acc_password"];
    $acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_email = $SQL_PROFILE_RESULT["acc_email"];
    $acc_img  = $SQL_PROFILE_RESULT["acc_img"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>Profile</title>
</head>
<body>
<?php 
    if (empty($_REQUEST["appaction"])) { $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }
        
    if ($appaction == "edituser"){
    if (empty($_REQUEST['acc_username'])) { $acc_username = ""; } else { $acc_username = $_REQUEST["acc_username"]; }
    if (empty($_REQUEST['acc_email'])) { $acc_email = ""; } else { $acc_email = $_REQUEST["acc_email"]; }
    if (empty($_REQUEST['acc_name'])) { $acc_name = ""; } else { $acc_name = $_REQUEST["acc_name"]; }
    if (empty($_REQUEST['acc_lastname'])) { $acc_lastname = ""; } else { $acc_lastname = $_REQUEST["acc_lastname"]; }
    if (empty($_REQUEST['acc_img'])) { $acc_img = ""; } else { $acc_img = $_REQUEST["acc_img"]; }
            // @unlink("myfile/".$_POST["hdnOldFile"]);
            $sql = "UPDATE account SET 
                acc_username    = '$acc_username' ,
                acc_email       = '$acc_email' ,
                acc_name        = '$acc_name',
                acc_lastname    = '$acc_lastname'
                WHERE acc_id = '$ss_acc_id' ";
                $query = mysqli_query($conn,$sql);
                if ($query == TRUE) {
                    $message = 'สำเร็จ ';
                    echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "แก้ไขข้อมูลส่วนตัวสำเร็จ !",
                            type: "success"
                        }).then(function() {
                            window.location = "process.php";
                        });
                    }, 300);
                </script>';   
                }
                else {
                    echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "แก้ไขข้อมูลส่วนตัวไม่สำเร็จ !",
                            type: "success"
                        }).then(function() {
                            window.location = "process.php";
                        });
                    }, 300);
                </script>';  
                }
                // ถ้ารูปไม่เท่ากับค่าว่าง ให้เข้าเงื่อนไขอัพรูป
                if($_FILES["filUpload"]["name"] != "")
                {
                        // ฟังค์ชั่นเวลา 
                    date_default_timezone_set('Asia/Bangkok');
                    // ตั้งเป็นเวลา ปี เดือน วัน ชั่วโมง นาที วินาที
                    $date = date("Ymdhis");	
                    // สุ่มเลข
                    $numrand = (mt_rand());
                    // ตั้งตัวแปร ที่รับ ไฟล์จาก input มา
                    $type = strrchr($_FILES['filUpload']['name'],".");
                    // โฟล์เดอร์เก็บภาพ
                    $path="assets/img/"; 
                    // ตั้งชื่อใหม่
                    $newname = $date.$numrand.$type;
                    $path_copy=$path.$newname;
                    $path_link="assets/img/".$newname;
                    if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],$path_copy))
                    {

                        //*** ลบรูปเก่าทิ้ง ***//			
                        // @unlink("assets/img/".$_POST["hdnOldFile"]);
                        
                        //*** เพิ่มรูปใหม่ลงไป ***//
                        $sql = "UPDATE account SET 
                        acc_username    = '$acc_username' ,
                        acc_email        = '$acc_email' ,
                        acc_name         = '$acc_name',
                        acc_lastname    = '$acc_lastname',
                        acc_img          = '$newname'
                        WHERE acc_id = '$ss_acc_id' ";
                        $query = mysqli_query($conn,$sql);		

                        if ($query == TRUE) {
                            $message = 'สำเร็จ ';
                            echo '<script>
                            setTimeout(function() {
                                swal({
                                    title: "แก้ไขข้อมูลส่วนตัวสำเร็จ !",
                                    type: "success"
                                }).then(function() {
                                    window.location = "process.php";
                                });
                            }, 300);
                        </script>';   
                        }
                        else {
                            echo '<script>
                            setTimeout(function() {
                                swal({
                                    title: "แก้ไขข้อมูลส่วนตัวไม่สำเร็จ !",
                                    type: "success"
                                }).then(function() {
                                    window.location = "process.php";
                                });
                            }, 300);
                        </script>';   
                        }

                    }
                }
    }
    if ($appaction == "editpassword"){
        if (empty($_REQUEST['acc_password'])) { $acc_password = ""; } else { $acc_password = $_REQUEST["acc_password"]; }
            $sql = "UPDATE account SET 
            acc_password    = '$acc_password' WHERE acc_id = '$ss_acc_id' ";
            $query = mysqli_query($conn,$sql);
            if ($query == TRUE) {
                $message = 'สำเร็จ ';
                echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขรหัสผ่านสำเร็จ !",
                        type: "success"
                    }).then(function() {
                        window.location = "process.php";
                    });
                }, 300);
            </script>';   
            }
            else {
                echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขรหัสผ่านไม่สำเร็จ !",
                        type: "success"
                    }).then(function() {
                        window.location = "process.php";
                    });
                }, 300);
            </script>';  
            }         
    }
?>
    <!-- MENU -->
    <nav class="navbar navbar-expand navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="process.php">
            <i class="fas fa-home"></i>
        </a>
        <?php include 'component/text-nav.php';?>
        <div class="p-2">
            <img class="rounded-circle" src="assets/img/<?php echo $acc_img; ?>" width="30" height="30" alt="Avatar">
            <span id="dropdown-username" style="margin-left: 8px"><?php echo $acc_name . ' ' . $acc_lastname ?></span>
        </div>

        <?php
        $sql_noti = "SELECT * FROM project_assign_user WHERE pau_reply = '0' AND acc_id = '$ss_acc_id' AND pau_status ='N' ";
        $sql_acc_noti_result = $conn->query($sql_noti);
        $sql_acc_noti_count = $sql_acc_noti_result->num_rows;
        ?>
        <div class="dropdown mr-2">
            <a class="p-2 dropdown-toggle" href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($sql_acc_noti_count == 0) { ?>
                    <i class="fas fa-bell f-18 "> </i>
                <?php } else { ?>
                    <i class="fas fa-bell f-18 ">
                        <p class="noti-number"><?php echo $sql_acc_noti_count; ?></p>
                    </i>
                <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdowns">
                <?php
                while ($acc_result_noti = mysqli_fetch_array($sql_acc_noti_result, MYSQLI_ASSOC)) {
                    $task_id_name = $acc_result_noti["pjt_id"];


                    $SQL_Profile = "SELECT * FROM project_task WHERE pjt_id = '$task_id_name'  ";
                    $SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
                    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);
                    $pj_name = $SQL_PROFILE_RESULT["pjt_title"];
                    $pj_id_name = $SQL_PROFILE_RESULT["pj_id"];


                    $SQL_Profiles = "SELECT * FROM project WHERE pj_id = '$pj_id_name'  ";
                    $SQL_PROFILE_QUERYs = mysqli_query($conn, $SQL_Profiles);
                    $SQL_PROFILE_RESULTs = mysqli_fetch_array($SQL_PROFILE_QUERYs, MYSQLI_ASSOC);
                    $saaa = $SQL_PROFILE_RESULTs["pj_process_title"];
                    $bbb  = $SQL_PROFILE_RESULTs["pj_user_ceate"];
                    ?>

                    <a class="dropdown-item" href="show-task-detail.php?pjt_id=<?php echo $task_id_name; ?>">your task : <?php echo $pj_name; ?>
                        <p class="mb-0">from project : <?php echo $saaa; ?></p>
                        <p class="mb-0">assign by : <?php echo $bbb; ?></p>
                       

                        <div class="dropdown-divider"></div>
                    </a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                <div class="text-center"><a href="all-notification.php">All Notification</a> </div>

            </div>
        </div>
        <div class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sort-down mb-3"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="Profile.php">Profile Setting</a>
                <a class="dropdown-item" href="WebSetting.php">Web Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Sign Out</a>
            </div>
        </div>
    </nav>
    <!-- Body Part -->
    <div class="wrapper_main">
        <!-- ส่วนหัว -->
        <!-- เก็บหัวข้อ Tab -->
        <header class="content-head profile box-one">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="btn btn-normal <?php if($a != "1"){ echo 'active'; } ?> " id="pills-GeneralSettings-tab" data-toggle="pill" href="#pills-GeneralSettings" role="tab" aria-controls="pills-GeneralSettings" aria-selected="true">
                        <i class="far fa-user"></i> <span>General Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-normal" id="pills-Notifications-tab" data-toggle="pill" href="#pills-Notifications" role="tab" aria-controls="pills-Notifications" aria-selected="false">
                        <i class="far fa-bell"></i> <span>Notifications</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-normal <?php if($a == "1"){ echo 'active'; }?>" id="pills-Password-tab" data-toggle="pill" href="#pills-Password" role="tab" aria-controls="pills-Password" aria-selected="false">
                        <i class="fas fa-lock"></i> <span>Password</span>
                    </a>
                </li>
            </ul>
        </header>

        <!-- ส่วนตัว -->
        <div class="content-body-profile">
            <div id="pills-tabContent" class="tab-content">
                <!-- General Set -->
                <form action="profile.php" method="post" class="tab-pane fade <?php if($a != "1"){ echo 'show active'; } ?>" id="pills-GeneralSettings" role="tabpanel" aria-labelledby="pills-GeneralSettings-tab" enctype="multipart/form-data">
                    <!-- รูป -->
                    <div class="d-flex">
                        <div class="avatar-uploads">
                            <div class="avatar-edit">
                                <input type='file' id="filUpload" name="filUpload" accept=".png, .jpg, .jpeg" />
                                <label for="filUpload"></label>
                            </div>
                            <div class="avatar-previews">
                                <div id="imagePreview" style="background-image: url(assets/img/<?php echo $acc_img; ?>);">
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 w-300 align-items-center d-flex justify-content-center">Profile photos must be JPGs or PNGs up to 5MB</div>
                    </div>
                    <!-- Form -->
                    <!-- Form :: Firstname -->
                    <div class="profile-GeneralSet-form" class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                            <label  for="acc_username">Username</label>
                        </div>
                        <div>
                            <input class="form-control form-control-sm" type="text" name="acc_username" value="<?php echo $acc_username ;?>">
                        </div>
                    </div>
                    <!-- form :: Lastname -->
                    <div class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                            <label  for="acc_name">Name</label>
                        </div>
                        <div>
                            <input class="form-control form-control-sm" type="text" name="acc_name" value="<?php echo $acc_name ;?>">
                        </div>
                    </div>
                    <div class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                            <label  for="acc_name">Lastname</label>
                        </div>
                        <div>
                            <input class="form-control form-control-sm" type="text" name="acc_lastname" value="<?php echo $acc_lastname ;?>">
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                            <label for="acc_email">Email</label>
                        </div>
                        <div>
                            <input class="form-control form-control-sm" type="email" name="acc_email" value="<?php echo $acc_email ;?>">
                        </div>
                    </div>
                    <!-- Time Zone -->
                    <!-- ยังไม่ได้ใส่ข้อมูลลงไป -->

                    <!-- Member of กลุ่มที่อยู่-->
                    <div class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                            <label for="MemberOf">Member of:</label>
                        </div>
                        <div>
                            <label style="margin: 6px 0 0 0" for="Last name" >
                                Accounting, HR, IT, Managers, Marketing, Sales
                            </label>
                        </div>
                    </div>
                    <!-- Check box :: Show help tooltips -->
                  
                    <!-- ปุ่ม save change -->
                    <div class="profile-GeneralSet-form">
                        <div class="profile-GeneralSet-form-label">
                        </div>
                        <div>
                        <?php
                            print "  <input type=\"hidden\" name=\"appaction\" id=\"appaction\" value=\"edituser\">";
                        ?>
                            <button class="btn btn-green" type="submit">
                                <span>Save Change</span>
                            </botton>
                        </div>
                    </div>
                </form>
                <!-- Notification -->
                <div class="tab-pane fade" id="pills-Notifications" role="tabpanel" aria-labelledby="pills-Notifications-tab">
                    <p style="margin-bottom: 0">
                        Select when we should send notifications to your e–mail address (<span><b><?php echo $acc_email?></b></span>)
                        <!-- ****** ปัญหา 1. ปุ่ม check all กับ Uncheck มีปัญหาคือ ถ้าไปยุ่งกับcheckboxตัวใดตัวนึง มันจะไม่สนใจตัวที่เรายุ่งอีกเลย-->
                        <a id="Check-all">Check all</a> • <a id="Uncheck-all">Uncheck all</a>
                        <!-- ****** ปัญหา 2. status save auto เวลาที่ check หรือ Uncheck มันจะขึ้นมาแปปนึง แล้วหายไป -->
                        <!-- <span>saved!!</span> -->
                    </p>
                    <!-- รายการสำหรับ checkทั้งหมด -->
                    <div class="container-fluid list-check">
                        <div class="row">
                            <!-- ข้างซ้าย -->
                            <div class="col-6 list-check-box">
                                <!-- check list -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck0">
                                    <label class="custom-control-label" for="customCheck0">New available tasks</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">You got new tasks</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">New comment from someone on your task</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label" for="customCheck4">Someone mentioned you in comment</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck5">
                                    <label class="custom-control-label" for="customCheck5">Task is deleted</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label" for="customCheck6">Task is completed</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                    <label class="custom-control-label" for="customCheck7">Completed task is reopened</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck8">
                                    <label class="custom-control-label" for="customCheck8">Your task was reopened by someone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck9">
                                    <label class="custom-control-label" for="customCheck9">Your task is completed by someone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck10">
                                    <label class="custom-control-label" for="customCheck10">Some tasks are not available to anyone</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck11">
                                    <label class="custom-control-label" for="customCheck11">Some tasks unassigned in your process</label>
                                </div>
                            </div>
                            <!-- ข้างขวา -->
                            <div class="col-6 list-check-box">
                                <!-- check list -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck12">
                                    <label class="custom-control-label" for="customCheck12">Some processes are not managed by anyones</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck13">
                                    <label class="custom-control-label" for="customCheck13">Your process is deleted</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck14">
                                    <label class="custom-control-label" for="customCheck14">Your process is completed</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck15">
                                    <label class="custom-control-label" for="customCheck15">Your process is rejected</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck16">
                                    <label class="custom-control-label" for="customCheck16">Your tasks were assigned</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck17">
                                    <label class="custom-control-label" for="customCheck17">New process started</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck18">
                                    <label class="custom-control-label" for="customCheck18">New comment from someone in your process</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck19">
                                    <label class="custom-control-label" for="customCheck19">You started new process</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck20">
                                    <label class="custom-control-label" for="customCheck21">Your tasks are due today</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck21">
                                    <label class="custom-control-label" for="customCheck21">Some templates are not managed by anyone</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <form action="profile.php" method="post" class="tab-pane fade <?php if($a == "1"){ echo 'show active'; }?>" id="pills-Password" role="tabpanel" aria-labelledby="pills-Password-tab">
                    <!-- Form :: New password -->
                    <div class="profile-password-form">
                        <div class="profile-password-form-label">
                            <div>
                                <label for="Newpassword">Old password</label>
                            </div>
                        </div>
                        <div>
                            <div id="box-newPass">
                                <input id="new-pass" class="form-control form-control-sm" name="acc_oldpassword" type="text" value="<?php echo $acc_password ;?>" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- Form :: New password -->
                    <div class="profile-password-form">
                        <div class="profile-password-form-label">
                            <div>
                                <label for="Newpassword">New password</label>
                            </div>
                        </div>
                        <div>
                            <div id="box-newPass">
                                <input id="new-pass" class="form-control form-control-sm" name="acc_password" type="text">
                                <!-- จะแสดงขึ้นมาหาก pass ที่ใส่ไม่ตรงกับที่กำหนด -->
                                <span id="message-newPass" class="error-text">Minimum of 8 characters</span>
                                <span id="message-required" class="error-text">Required</span>
                            </div>
                        </div>
                    </div>
                    <!-- form :: Repeat new password -->
                    <div class="profile-password-form">
                        <div class="profile-password-form-label">
                            <div>
                                <label for="Repeatnewpassword">Repeat new password</label>
                            </div>
                        </div>
                        <div>
                            <div id="box-rePass">
                                <input id="re-pass" class="form-control form-control-sm" name="acc_Conpassword" type="text">
                                <!-- จะแสดงขึ้นมาหาก pass ที่ใส่ไม่ตรงกับที่กำหนด -->
                                <span id="message-shouldMatch" class="error-text">Passwords should match</span>
                            </div>
                        </div>
                    </div>
                    <!-- form :: ปุ่ม  Change password-->
                    <div class="profile-password-form">
                        <div class="profile-password-form-label">
                        </div>
                        <?php
                            print "  <input type=\"hidden\" name=\"appaction\" id=\"appaction\" value=\"editpassword\">";
                        ?>
                        <div>
                            <button id="changepassword" class="btn btn-unclick" type="submit" disabled>
                                <span>Change password</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/js/event.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#filUpload").change(function() {
            readURL(this);
        });
    </script>
</body>
</html>
