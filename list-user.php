<!-- Template -->
<?php 
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
   //   displayprofile
   $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'  ";
   $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
   $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
   $acc_name = $SQL_PROFILE_RESULT["acc_name"];
   $acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
   $acc_img  = $SQL_PROFILE_RESULT["acc_img"];
   $search_user = $_GET["search_user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>List Account User</title>
</head>
<?php 
    if (empty($_REQUEST["appaction"])) { $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }
    if (empty($_REQUEST["acc_id"])) { $acc_id = ""; } else { $acc_id = $_REQUEST["acc_id"]; }
    if (empty($_REQUEST["delete_user"])) { $appaction_delete = ""; } else { $appaction_delete = $_REQUEST["delete_user"]; }
    if (empty($_REQUEST["edituser"])) { $edituser = ""; } else { $edituser = $_REQUEST["edituser"]; }
    if ($edituser == "edituser"){
        if (empty($_REQUEST['acc_id'])) { $acc_id = ""; } else { $acc_id = $_REQUEST["acc_id"]; }
        if (empty($_REQUEST['acc_username'])) { $acc_username = ""; } else { $acc_username = $_REQUEST["acc_username"]; }
        if (empty($_REQUEST['acc_email'])) { $acc_email = ""; } else { $acc_email = $_REQUEST["acc_email"]; }
        if (empty($_REQUEST['acc_name'])) { $acc_name = ""; } else { $acc_name = $_REQUEST["acc_name"]; }
        if (empty($_REQUEST['acc_lastname'])) { $acc_lastname = ""; } else { $acc_lastname = $_REQUEST["acc_lastname"]; }
        if (empty($_REQUEST['acc_img'])) { $acc_img = ""; } else { $acc_img = $_REQUEST["acc_img"]; }
        if (empty($_REQUEST['acc_permission'])) { $acc_permission = ""; } else { $acc_permission = $_REQUEST["acc_permission"]; }
                // @unlink("myfile/".$_POST["hdnOldFile"]);
                $sql = "UPDATE account SET 
                    acc_username    = '$acc_username' ,
                    acc_email       = '$acc_email' ,
                    acc_name        = '$acc_name',
                    acc_lastname    = '$acc_lastname',
                    acc_permission  = '$acc_permission'
                    WHERE acc_id = '$acc_id' ";
                    $query = mysqli_query($conn,$sql);
                    if ($query == TRUE) {
                        $message = 'สำเร็จ ';
                        echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "แก้ไขข้อมูลสำเร็จ !",
                                type: "success"
                            }).then(function() {
                                window.location = "list-user.php";
                            });
                        }, 300);
                    </script>';   
                    }
                    else {
                        echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "แก้ไขข้อมูลสำเร็จ !",
                                type: "success"
                            }).then(function() {
                                window.location = "list-user.php";
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
                            acc_img          = '$newname',
                            acc_permission  = '$acc_permission'
                            WHERE acc_id = '$acc_id' ";
                            $query = mysqli_query($conn,$sql);		
    
                            if ($query == TRUE) {
                                $message = 'สำเร็จ ';
                                echo '<script>
                                setTimeout(function() {
                                    swal({
                                        title: "แก้ไขข้อมูลสำเร็จ !",
                                        type: "success"
                                    }).then(function() {
                                        window.location = "list-user.php";
                                    });
                                }, 300);
                            </script>';   
                            }
                            else {
                                echo '<script>
                                setTimeout(function() {
                                    swal({
                                        title: "แก้ไขข้อมูลสำเร็จ !",
                                        type: "success"
                                    }).then(function() {
                                        window.location = "list-user.php";
                                    });
                                }, 300);
                            </script>';   
                            }
    
                        }
                    }
        }
    if ($appaction_delete == "delete_user"){
        $sql = "UPDATE account SET acc_status = '0' WHERE acc_id = '$acc_id' ";
        if (mysqli_query($conn, $sql)){
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "Delete User Success !",
                        type: "success"
                    }).then(function() {
                        window.location = "list-user.php";
                    });
                }, 300);
            </script>';
        }
    }

?>
<body>
<?php 
    // loop all user  
        if($search_user != ""){
            // $sql_acc = "SELECT * FROM account WHERE acc_status = '1'";
            $sqlsearch = "SELECT * FROM vw_account where acc_email like '%$search_user%' or acc_name like '%$search_user%' or acc_lastname like '%$search_user%' or permission_name like '%$search_user%' AND acc_status = 1 ";
            $sql_acc_result = $conn->query($sqlsearch);
            $sql_acc_count = $sql_acc_result->num_rows;
        }
        else {
            $sql_acc = "SELECT * FROM account WHERE acc_status = '1'";
            $sql_acc_result = $conn->query($sql_acc);
            $sql_acc_count = $sql_acc_result->num_rows;
        }
      
    // loop super admin
        $sql_acc_spadmin = "SELECT * FROM account WHERE acc_status = '1' AND acc_permission = '0' ";
        $sql_acc_spadmin_result = $conn->query($sql_acc_spadmin);
        $sql_acc_spadmin_count = $sql_acc_spadmin_result->num_rows;

    // loop admin
        $sql_acc_admin = "SELECT * FROM account WHERE acc_status = '1' AND acc_permission = '1' ";
        $sql_acc_admin_result = $conn->query($sql_acc_admin);
        $sql_acc_admin_count = $sql_acc_admin_result->num_rows;
    // loop staff
        $sql_acc_staff = "SELECT * FROM account WHERE acc_status = '1' AND acc_permission = '2' ";
        $sql_acc_staff_result = $conn->query($sql_acc_staff);
        $sql_acc_staff_count = $sql_acc_staff_result->num_rows;
?>
    <!-- MENU -->
    <nav class="navbar navbar-expand navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="Process.php">
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
    <!-- BODY -->
    <div class="wrapper_main ">
        <header class="content-head box-one">
            <h3 class="text-f14 mr-2">USER PERMISSIONS</h3>
            <ul class="nav nav-pills mr-auto" id="pills-tab" role="tablist">
                <li class="nav-item mr-2">
                    <a class="btn btn-normal active" id="pills-alluser-tab" data-toggle="pill" href="#pills-alluser" role="tab" aria-controls="pills-alluser" aria-selected="true">
                        <span class="tab-inprocess">ALL USERS <?php echo '('.$sql_acc_count.')'?></span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="btn btn-normal" id="pills-superadmin-tab" data-toggle="pill" href="#pills-superadmin" role="tab" aria-controls="pills-superadmin" aria-selected="true">
                        <span class="tab-inprocess">SUPER ADMIN (<?php echo $sql_acc_spadmin_count; ?>)</span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="btn btn-normal" id="pills-admin-tab" data-toggle="pill" href="#pills-admin" role="tab" aria-controls="pills-admin" aria-selected="false">
                        <span class="tab-inprocess">ADMIN (<?php echo $sql_acc_admin_count; ?>)</span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="btn btn-normal" id="pills-staff-tab" data-toggle="pill" href="#pills-staff" role="tab" aria-controls="pills-staff" aria-selected="false">
                        <span class="tab-inprocess">STAFF (<?php echo $sql_acc_staff_count; ?>)</span>
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <button class="btn btn-icon-link icon-btn" data-toggle="modal" data-target="#Modal-adduser">
                        <i class="fas fa-plus"></i>
                    </button>
                </li>
            </ul>
            <form class="form-group mb-0" action="list-user.php" method="GET">
                <input type="text" class="form-control" name="search_user" placeholder="Search USER" value="<?php echo $search_user;?>">
            </form>
        </header> 
             
        <div class="content-body-bodyTitle90" style="overflow-y:auto">
            <div id="pills-tabContent" class="tab-content" style="height: 100%;">
                <!-- all user -->
                <div class="content-head tab-pane fade show active" id="pills-alluser" role="tabpanel" aria-labelledby="pills-alluser-tab">
                    <ul class="template">
                        <?php if($search_user == ""){?>
                        <li class="box-normal dpn">
                            Result <?php echo $sql_acc_count; ?> item 
                        </li>
                        <?php } else{ ?>
                            <p class="text-center py-3 mb-0 text-sub"> Result for <?php echo $search_user;?> is <?php echo $sql_acc_count; ?> item </p>
                        <?php }?>
                        <?php 
                            while($acc_result_query = mysqli_fetch_array($sql_acc_result,MYSQLI_ASSOC)){
                            $acc_id         = $acc_result_query["acc_id"];
                            $acc_username   = $acc_result_query["acc_username"];
                            $acc_email      = $acc_result_query["acc_email"];
                            $acc_name       = $acc_result_query["acc_name"];
                            $acc_lastname   = $acc_result_query["acc_lastname"];
                            $acc_img        = $acc_result_query["acc_img"];
                            $acc_permission = $acc_result_query["acc_permission"];
                        ?>
                        <li class="box-normal">
                            <div class="box-normal-left">
                                <div class="icon-medium-size-f20" style="background: #ccc;">
                                    <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                </div>
                                <div class="template-text-box">
                                    <h3 class="text-f14 text-success"><?php echo $acc_name.' '.$acc_lastname ?></h3>
                                    <p class="text-sub">
                                        <span><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></span> • <span><?php echo $acc_email; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="template-btn-set btn-set">
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-vw-profile<?php echo $acc_id;?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-icon-link icon-edit mr-2" data-toggle="modal" data-target="#Modal-edit-profile<?php echo $acc_id;?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <?php if($ss_acc_id != $acc_id ){ ?>
                                <button class="btn btn-icon-link icon-btn" data-toggle="modal" data-target="#Model-Deleteprofile<?php echo $acc_id ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <?php } ?>
                            </div>
                        </li> 
                        <!-- modal delete user -->
                        <div class="modal fade" id="Model-Deleteprofile<?php echo $acc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- ปุ่ม x -->
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <!-- เนื้อหา -->
                                        <div class="mt-2" style="display: flex;">
                                            <div style="margin-right:24px; color: #F7DB31; font-size: 35px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-f15">
                                                    <?php echo $tp_name; ?> deletion user confirmation
                                                </h3>
                                                <p class="text-f12" style="margin-top:12px;">
                                                    Are you sure you want to delete user : <span class="text-danger"><?php echo $acc_name.' '.$acc_lastname.' ' ?></span> ?
                                                </p>
                                                <div style="margin-top:12px;">
                                                    <a href="list-user.php?acc_id=<?php echo $acc_id; ?>&delete_user=delete_user"
                                                    <button class="btn btn-delete" style="margin-right:5px;">
                                                        Delete
                                                    </button>
                                                    </a>
                                                    <button class="btn btn-normal" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal view profile -->
                        <div class="modal fade" id="Model-vw-profile<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body">
                                        <div class="text-center py-1">
                                            <img src="assets/img/<?php echo $acc_img;?>" alt="" width="150" height="150" class="rounded-circle ojf-cover mb-3">
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_username; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_name.' '.$acc_lastname; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal edit profile -->
                        <div class="modal fade" id="Modal-edit-profile<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="acc_id" value="<?php echo $acc_id;?>">
                                        <div class="d-flex py-3 justify-content-center">
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
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_username" value="<?php echo $acc_username ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_name" value="<?php echo $acc_name ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">lastname</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_lastname" value="<?php echo $acc_lastname ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="email" name="acc_email" value="<?php echo $acc_email ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="acc_permission">
                                                    <!-- <option disabled selected value> -- select an permissions -- </option> -->
                                                    <option value="0" <?php if($acc_permission == 0){echo 'selected';}?>>Super Admin</option>
                                                    <option value="1" <?php if($acc_permission == 1){echo 'selected';}?>>Admin</option>
                                                    <option value="2" <?php if($acc_permission == 2){echo 'selected';}?>>Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center">
                                                <?php
                                                    print "  <input type=\"hidden\" name=\"edituser\" id=\"edituser\" value=\"edituser\">";
                                                ?>
                                                <button class="btn btn-green" type="submit"><span>Save Change</span></botton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </ul>
                </div>
                <!-- super admin -->
                <div class="content-head tab-pane fade" id="pills-superadmin" role="tabpanel" aria-labelledby="pills-superadmin-tab">
                    <ul class="template">
                        <?php 
                            while($acc_spadmin_result_query = mysqli_fetch_array($sql_acc_spadmin_result,MYSQLI_ASSOC)){
                            $acc_id         = $acc_spadmin_result_query["acc_id"];
                            $acc_username   = $acc_spadmin_result_query["acc_username"];
                            $acc_email      = $acc_spadmin_result_query["acc_email"];
                            $acc_name       = $acc_spadmin_result_query["acc_name"];
                            $acc_lastname   = $acc_spadmin_result_query["acc_lastname"];
                            $acc_img        = $acc_spadmin_result_query["acc_img"];
                            $acc_permission = $acc_spadmin_result_query["acc_permission"];
                        ?>
                        <li class="box-normal">
                            <div class="box-normal-left">
                                <div class="icon-medium-size-f20" style="background: #ccc;">
                                    <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                </div>
                                <div class="template-text-box">
                                    <h3 class="text-f14 text-success"><?php echo $acc_name.' '.$acc_lastname ?></h3>
                                    <p class="text-sub">
                                        <span><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></span> • <span><?php echo $acc_email; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="template-btn-set btn-set">
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-vw-profile-spam<?php echo $acc_id ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-icon-link icon-edit mr-2" data-toggle="modal" data-target="#Modal-edit-profile-spam<?php echo $acc_id ?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-icon-link icon-btn" data-toggle="modal" data-target="#Model-Deleteprofile-spam<?php echo $acc_id ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </li> 
                        <!-- modal delete -->
                        <div class="modal fade" id="Model-Deleteprofile-spam<?php echo $acc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- ปุ่ม x -->
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <!-- เนื้อหา -->
                                        <div class="mt-2" style="display: flex;">
                                            <div style="margin-right:24px; color: #F7DB31; font-size: 35px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-f15">
                                                    <?php echo $tp_name; ?> deletion user confirmation
                                                </h3>
                                                <p class="text-f12" style="margin-top:12px;">
                                                    Are you sure you want to delete user : <span class="text-danger"><?php echo $acc_name.' '.$acc_lastname.' ' ?></span> ?
                                                </p>
                                                <div style="margin-top:12px;">
                                                    <a href="list-user.php?acc_id=<?php echo $acc_id; ?>&delete_user=delete_user"
                                                    <button class="btn btn-delete" style="margin-right:5px;">
                                                        Delete
                                                    </button>
                                                    </a>
                                                    <button class="btn btn-normal" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal view profile -->
                        <div class="modal fade" id="Model-vw-profile-spam<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body">
                                        <div class="text-center py-1">
                                            <img src="assets/img/<?php echo $acc_img;?>" alt="" width="150" height="150" class="rounded-circle ojf-cover pb-3">
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_username; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_name.' '.$acc_lastname; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal edit profile -->
                        <div class="modal fade" id="Modal-edit-profile-spam<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="acc_id" value="<?php echo $acc_id;?>">
                                        <div class="d-flex py-3 justify-content-center">
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
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_username" value="<?php echo $acc_username ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_name" value="<?php echo $acc_name ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">lastname</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_lastname" value="<?php echo $acc_lastname ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="email" name="acc_email" value="<?php echo $acc_email ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="acc_permission">
                                                    <!-- <option disabled selected value> -- select an permissions -- </option> -->
                                                    <option value="0" <?php if($acc_permission == 0){echo 'selected';}?>>Super Admin</option>
                                                    <option value="1" <?php if($acc_permission == 1){echo 'selected';}?>>Admin</option>
                                                    <option value="2" <?php if($acc_permission == 2){echo 'selected';}?>>Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center">
                                                <?php
                                                    print "  <input type=\"hidden\" name=\"edituser\" id=\"edituser\" value=\"edituser\">";
                                                ?>
                                                <button class="btn btn-green" type="submit"><span>Save Change</span></botton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </ul>         
                </div>
                <!-- admin -->
                <div class="content-head tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">
                    <ul class="template">
                        <?php 
                            while($acc_admin_result_query = mysqli_fetch_array($sql_acc_admin_result,MYSQLI_ASSOC)){
                            $acc_id         = $acc_admin_result_query["acc_id"];
                            $acc_username   = $acc_admin_result_query["acc_username"];
                            $acc_email      = $acc_admin_result_query["acc_email"];
                            $acc_name       = $acc_admin_result_query["acc_name"];
                            $acc_lastname   = $acc_admin_result_query["acc_lastname"];
                            $acc_img        = $acc_admin_result_query["acc_img"];
                            $acc_permission = $acc_admin_result_query["acc_permission"];
                        ?>
                        <li class="box-normal">
                            <div class="box-normal-left">
                                <div class="icon-medium-size-f20" style="background: #ccc;">
                                    <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                </div>
                                <div class="template-text-box">
                                    <h3 class="text-f14 text-success"><?php echo $acc_name.' '.$acc_lastname ?></h3>
                                    <p class="text-sub">
                                        <span><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></span> • <span><?php echo $acc_email; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="template-btn-set btn-set">
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-vw-profile-admin<?php echo $acc_id;?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-icon-link icon-edit mr-2" data-toggle="modal" data-target="#Modal-edit-profile-admin<?php echo $acc_id;?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-icon-link icon-btn" data-toggle="modal" data-target="#Model-Deleteprofile-admin<?php echo $acc_id;?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </li> 
                        <div class="modal fade" id="Model-Deleteprofile-admin<?php echo $acc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- ปุ่ม x -->
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <!-- เนื้อหา -->
                                        <div class="mt-2" style="display: flex;">
                                            <div style="margin-right:24px; color: #F7DB31; font-size: 35px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-f15">
                                                    <?php echo $tp_name; ?> deletion user confirmation
                                                </h3>
                                                <p class="text-f12" style="margin-top:12px;">
                                                    Are you sure you want to delete user : <span class="text-danger"><?php echo $acc_name.' '.$acc_lastname.' ' ?></span> ?
                                                </p>
                                                <div style="margin-top:12px;">
                                                    <a href="list-user.php?acc_id=<?php echo $acc_id; ?>&delete_user=delete_user"
                                                    <button class="btn btn-delete" style="margin-right:5px;">
                                                        Delete
                                                    </button>
                                                    </a>
                                                    <button class="btn btn-normal" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             <!-- modal view profile -->
                             <div class="modal fade" id="Model-vw-profile-admin<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body">
                                        <div class="text-center py-1">
                                            <img src="assets/img/<?php echo $acc_img;?>" alt="" width="150" height="150" class="rounded-circle ojf-cover pb-3">
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_username; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_name.' '.$acc_lastname; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal edit profile -->
                        <div class="modal fade" id="Modal-edit-profile-admin<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="acc_id" value="<?php echo $acc_id;?>">
                                        <div class="d-flex py-3 justify-content-center">
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
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_username" value="<?php echo $acc_username ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_name" value="<?php echo $acc_name ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">lastname</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_lastname" value="<?php echo $acc_lastname ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="email" name="acc_email" value="<?php echo $acc_email ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="acc_permission">
                                                    <!-- <option disabled selected value> -- select an permissions -- </option> -->
                                                    <option value="0" <?php if($acc_permission == 0){echo 'selected';}?>>Super Admin</option>
                                                    <option value="1" <?php if($acc_permission == 1){echo 'selected';}?>>Admin</option>
                                                    <option value="2" <?php if($acc_permission == 2){echo 'selected';}?>>Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center">
                                                <?php
                                                    print "  <input type=\"hidden\" name=\"edituser\" id=\"edituser\" value=\"edituser\">";
                                                ?>
                                                <button class="btn btn-green" type="submit"><span>Save Change</span></botton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </ul>         
                </div>
                <!-- staff -->
                <div class="content-head tab-pane fade " id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
                    <ul class="template">
                        <?php 
                            while($acc_staff_result_query = mysqli_fetch_array($sql_acc_staff_result,MYSQLI_ASSOC)){
                            $acc_id         = $acc_staff_result_query["acc_id"];
                            $acc_username   = $acc_staff_result_query["acc_username"];
                            $acc_email      = $acc_staff_result_query["acc_email"];
                            $acc_name       = $acc_staff_result_query["acc_name"];
                            $acc_lastname   = $acc_staff_result_query["acc_lastname"];
                            $acc_img        = $acc_staff_result_query["acc_img"];
                            $acc_permission = $acc_staff_result_query["acc_permission"];
                        ?>
                        <li class="box-normal">
                            <div class="box-normal-left">
                                <div class="icon-medium-size-f20" style="background: #ccc;">
                                    <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                </div>
                                <div class="template-text-box">
                                    <h3 class="text-f14 text-success"><?php echo $acc_name.' '.$acc_lastname ?></h3>
                                    <p class="text-sub">
                                        <span><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></span> • <span><?php echo $acc_email; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="template-btn-set btn-set">
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-vw-profile-staff<?php echo $acc_id;?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-icon-link icon-edit mr-2" data-toggle="modal" data-target="#Modal-edit-profile-staff<?php echo $acc_id;?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-icon-link icon-btn" data-toggle="modal" data-target="#Model-Deleteprofile-staff<?php echo $acc_id;?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </li> 
                        <div class="modal fade" id="Model-Deleteprofile-staff<?php echo $acc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <!-- ปุ่ม x -->
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <!-- เนื้อหา -->
                                        <div class="mt-2" style="display: flex;">
                                            <div style="margin-right:24px; color: #F7DB31; font-size: 35px">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-f15">
                                                    <?php echo $tp_name; ?> deletion user confirmation
                                                </h3>
                                                <p class="text-f12" style="margin-top:12px;">
                                                    Are you sure you want to delete user : <span class="text-danger"><?php echo $acc_name.' '.$acc_lastname.' ' ?></span> ?
                                                </p>
                                                <div style="margin-top:12px;">
                                                    <a href="list-user.php?acc_id=<?php echo $acc_id; ?>&delete_user=delete_user"
                                                    <button class="btn btn-delete" style="margin-right:5px;">
                                                        Delete
                                                    </button>
                                                    </a>
                                                    <button class="btn btn-normal" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                             <!-- modal view profile -->
                             <div class="modal fade" id="Model-vw-profile-staff<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body">
                                        <div class="text-center py-1">
                                            <img src="assets/img/<?php echo $acc_img;?>" alt="" width="150" height="150" class="rounded-circle ojf-cover pb-3">
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_username; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_name.' '.$acc_lastname; ?></p> 
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php echo $acc_email; ?></p>
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <p class="text-sub text-f16"><?php if($acc_permission == 0 ){ echo 'SUPER ADMIN';}else if ($acc_permission == 1){ echo 'ADMIN';}else { echo 'STAFF';} ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- modal edit profile -->
                        <div class="modal fade" id="Modal-edit-profile-staff<?php echo $acc_id;?>" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ABOUT USER</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="modal-body" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="acc_id" value="<?php echo $acc_id;?>">
                                        <div class="d-flex py-3 justify-content-center">
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
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">username</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                               
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_username" value="<?php echo $acc_username ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">name</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_name" value="<?php echo $acc_name ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">lastname</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="text" name="acc_lastname" value="<?php echo $acc_lastname ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">email</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <input class="form-control form-control-sm" type="email" name="acc_email" value="<?php echo $acc_email ;?>">
                                            </div>
                                        </div>
                                        <div class="row py-1">
                                            <div class="col-4">
                                                <p class="text-f16">permissions</p> 
                                            </div>
                                            <div class="col-1">
                                                <p class="text-f16">:</p> 
                                            </div>
                                            <div class="col-7">
                                                <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="acc_permission">
                                                    <!-- <option disabled selected value> -- select an permissions -- </option> -->
                                                    <option value="0" <?php if($acc_permission == 0){echo 'selected';}?>>Super Admin</option>
                                                    <option value="1" <?php if($acc_permission == 1){echo 'selected';}?>>Admin</option>
                                                    <option value="2" <?php if($acc_permission == 2){echo 'selected';}?>>Staff</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col-12 text-center">
                                                <?php
                                                    print "  <input type=\"hidden\" name=\"edituser\" id=\"edituser\" value=\"edituser\">";
                                                ?>
                                                <button class="btn btn-green" type="submit"><span>Save Change</span></botton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </ul>   
                </div>
            </div>
        </div>
 <!-- modal add user -->
<div class="modal fade" id="Modal-adduser" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Created Account USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="acc_email" name="acc_email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">UserName</label>
                    <input type="text" class="form-control" id="acc_username" name="acc_username" placeholder="Enter UserName" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="acc_name" name="acc_name" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control" id="acc_lastname" name="acc_lastname" placeholder="Enter LastName" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="Password" class="form-control" id="acc_password" name="acc_password" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Permissions</label>
                    <select class="form-control" id="acc_permission" name="acc_permission" required>
                    <option disabled selected value> -- select an Permissions -- </option>
                    <option value="0">Super Admin</option>
                    <option value="1">Admin</option>
                    <option value="2">Staff</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Script -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/select.js"></script>
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
    <script>
        $(document).ready(function(){
            $('#save').click(function(){
                var acc_email      = $('#acc_email').val();
                var acc_username   = $('#acc_username').val();
                var acc_name       = $('#acc_name').val();
                var acc_lastname   = $('#acc_lastname').val();
                var acc_password   = $('#acc_password').val();
                var acc_permission = $('#acc_permission').val();
                console.log(acc_email,acc_username,acc_name,acc_lastname,acc_password,acc_permission);
                $.ajax({
                    url:"add-user-save.php",
                    method:"POST",
                    data:{  acc_email:acc_email,
                            acc_username:acc_username,
                            acc_name:acc_name,
                            acc_lastname:acc_lastname,
                            acc_password:acc_password,
                            acc_permission:acc_permission
                        },
                    success:function(result){
                        if(result.status == 1) // Success
                        {
                            setTimeout(function() {
                            swal({
                                title:  (result.message),
                                type: "success"
                            }).then(function() {
                                window.location = "list-user.php";
                            });
                        }, 300);
                        }
                        else // Err
                        {
                            setTimeout(function() {
                            swal({
                                title: (result.message),
                                type: "success"
                            })
                        }, 300);
                        }     
                    }
                });
            });
        });
    </script>
</body>
</html>