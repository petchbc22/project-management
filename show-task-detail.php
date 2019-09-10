<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/form.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/selectize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>
    <script src="assets/js/sweetalert2@8.js"></script>


    <title>inprocess task</title>
</head>

<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
include 'appsystem/inc_config.php';
$pjt_id = $_GET["pjt_id"];
if (empty($_REQUEST["appaction"])) { $appaction = "";} else { $appaction = $_REQUEST["appaction"];}
if (empty($_REQUEST["delete_comment"])) { $delete_comment = "";} else { $delete_comment = $_REQUEST["delete_comment"];}
// action insert comment
if ($appaction == "add_comment") {

    if (empty($_REQUEST['bc_detail'])) {$bc_detail = "";} else {$bc_detail = $_REQUEST["bc_detail"];}
    if (empty($_REQUEST['pjt_id'])) {$pjt_id = "";} else {$pjt_id = $_REQUEST["pjt_id"];}
    if (empty($_REQUEST['filUpload'])) {$filUpload = "";} else {$filUpload = $_REQUEST["filUpload"];}

    if ($_FILES["filUpload"]["tmp_name"] != "") {
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Ymdhis");
        $numrand = (mt_rand());
        $type = strrchr($_FILES['filUpload']['name'], ".");
        $path = "myfile/";

        $newname = $date . $numrand . $type;
        $path_copy = $path . $newname;
        $path_link = "assets/img/" . $newname;
        if (move_uploaded_file($_FILES["filUpload"]["tmp_name"], $path_copy)) {
            $sql_board = "INSERT INTO board_comments ( pjt_id, acc_id, bc_detail, bc_files, bc_datetime, bc_status ) VALUES ('$pjt_id', '$ss_acc_id', '$bc_detail', '$newname', now(), 'N') ";
            if (mysqli_query($conn, $sql_board)) {
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "เพิ่มคอมเม้นต์และไฟล์แนบสำเร็จ !",
                            type: "success"
                        }).then(function() {
                            window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
                        });
                    }, 300);
                    </script>';
            }
        }
    } else {
        $sql_board = " INSERT INTO board_comments ( pjt_id, acc_id, bc_detail, bc_files, bc_datetime, bc_status ) 
            VALUES ('$pjt_id', '$ss_acc_id', '$bc_detail', '0', now(), 'N') ";
        if (mysqli_query($conn, $sql_board)) {
            echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "เพิ่มคอมเม้นต์สำเร็จ !",
                                type: "success"
                            }).then(function() {
                                window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
                            });
                        }, 300);
                        </script>';
        }
    }
}
// action delete comment
if ($delete_comment == "delete_comment") {

    if (empty($_REQUEST['bc_id'])) {$bc_id = "";} else {$bc_id = $_REQUEST["bc_id"];}
    if (empty($_REQUEST['pjt_id'])) {$pjt_id = "";} else {$pjt_id = $_REQUEST["pjt_id"];}

    $sql = "UPDATE board_comments SET bc_status = 'D' WHERE bc_id = '$bc_id' ";
    if (mysqli_query($conn, $sql)) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "ลบคอมเม้นต์สำเร็จ !",
                    type: "success"
                }).then(function() {
                    window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
                });
            }, 300);
            </script>';
    }
}
//   displayprofile
$SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'  ";
$SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
$SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);
$acc_name = $SQL_PROFILE_RESULT["acc_name"];
$acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
$acc_img  = $SQL_PROFILE_RESULT["acc_img"];
// display project 
$SQL_task = "SELECT * FROM project_task WHERE pjt_id = '$pjt_id'  ";
$SQL_task_QUERY = mysqli_query($conn, $SQL_task);
$SQL_task_RESULT = mysqli_fetch_array($SQL_task_QUERY, MYSQLI_ASSOC);
$pj_id           = $SQL_task_RESULT["pj_id"];
$pjt_title       = $SQL_task_RESULT["pjt_title"];
$pjt_starteddate = $SQL_task_RESULT["pjt_starteddate"];
$pjt_duedate     = $SQL_task_RESULT["pjt_duedate"];
$pjt_description = $SQL_task_RESULT["pjt_description"];
$pjt_complete   = $SQL_task_RESULT["pjt_complete"];

$SQL_project = "SELECT * FROM project WHERE pj_id = '$pj_id' AND pj_status ='N' ";
$SQL_project_QUERY = mysqli_query($conn, $SQL_project);
$SQL_project_RESULT = mysqli_fetch_array($SQL_project_QUERY, MYSQLI_ASSOC);
$pj_process_title = $SQL_project_RESULT["pj_process_title"];
$pj_instructions = $SQL_project_RESULT["pj_instructions"];
$tp_id = $SQL_project_RESULT["tp_id"];
$pj_user_ceate = $SQL_project_RESULT["pj_user_ceate"];
$pj_process_deadline = $SQL_project_RESULT["pj_process_deadline"];
$pj_process_start = $SQL_project_RESULT["pj_process_start"];
$pj_process_complete = $SQL_project_RESULT["pj_complete"];

$SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'  ";
$SQL_acc_create_QUERY = mysqli_query($conn, $SQL_acc_create);
$SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY, MYSQLI_ASSOC);
$pj_user_ceate_name = $SQL_acc_creat_RESULT["acc_name"];
$pj_user_ceate_lname = $SQL_acc_creat_RESULT["acc_lastname"];
$pj_user_ceate_img = $SQL_acc_creat_RESULT["acc_img"];


$SQL_pau = "SELECT * FROM project_assign_user WHERE pjt_id = '$pjt_id' AND acc_id = '$ss_acc_id' ";
$SQL_pau_QUERY = mysqli_query($conn, $SQL_pau);
$SQL_pau_RESULT = mysqli_fetch_array($SQL_pau_QUERY, MYSQLI_ASSOC);
$pau_reply = $SQL_pau_RESULT["pau_reply"];
?>
<?php

if (empty($_REQUEST["appaction"])) {$appaction = "";} else {$appaction = $_REQUEST["appaction"];}
if (empty($_REQUEST["pjt_id"])) {$pjt_id = "";} else {$pjt_id = $_REQUEST["pjt_id"];}
if (empty($_REQUEST["comfirm_pjt"])) {$comfirm_pjt = "";} else {$comfirm_pjt = $_REQUEST["comfirm_pjt"];}

if ($comfirm_pjt == "comfirm_pjt") {
    $sql = "UPDATE project_assign_user SET pau_reply = '1' WHERE pjt_id = '$pjt_id' AND acc_id ='$ss_acc_id' ";
    if (mysqli_query($conn, $sql)) {
        $sqlproject_task = "UPDATE project_task SET pjt_colorstatus = '#ffdd00' ,pjt_complete = '1' WHERE pjt_id = '$pjt_id'";
        if (mysqli_query($conn, $sqlproject_task)) {
            $sql1 = "SELECT * FROM project_assign_user WHERE pjt_id = $pjt_id  ";
            $sql1_query = $conn->query($sql1);
            $sql1_count = $sql1_query->num_rows;
            // นับการตอบกลับของผู้ที่ได้รับงาน
            $sql2 = "SELECT * FROM project_assign_user WHERE pjt_id = $pjt_id AND pau_reply = 1  ";
            $sql2_query = $conn->query($sql2);
            $sql2_count = $sql2_query->num_rows;
            if($sql1_count == $sql2_count){
                $sql = "UPDATE project_task SET pjt_complete = '1' WHERE pjt_id = '$pjt_id'";
                $query = mysqli_query($conn, $sql);
                    echo '<script>
                            setTimeout(function() {
                                swal({
                                    title: "Comfirm Project Task Success !",
                                    type: "success"
                                }).then(function() {
                                    window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
                                });
                            }, 300);
                        </script>';

            }else{
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "Comfirm Project Task Success !",
                            type: "success"
                        }).then(function() {
                            window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
                        });
                    }, 300);
                </script>';

            }
        // echo '<script>
        //         setTimeout(function() {
        //             swal({
        //                 title: "Comfirm Project Task Success !",
        //                 type: "success"
        //             }).then(function() {
        //                 window.location = "show-task-detail.php?pjt_id=' . $pjt_id . '";
        //             });
        //         }, 300);
        //     </script>';
        }   
    }
}
?>
<body>
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
    <!-- เนื้อหา -->
    <div class="wrapper_main" style="position: relative">
    
        <header class="head-title-h90 box-normal">
            <div class="box-flex-Templatetitle">
                <?php if($pj_user_ceate == $ss_acc_id){ 
                    if($pjt_complete == 1 || $pjt_complete == 2){ 
                    ?>

                <div class="pr-2 py-2">
                    <?php 
                        if($pjt_complete == 1 || $pjt_complete == 0) {
                    ?>
                    <button class="btn-check-app" id="curtainInput">
                        <input type="hidden" id="pj_id" value="<?php echo $pj_id;?>" name="<?php echo $pj_id;?>">
                        <i class="far fa-check-circle cts-app" data-toggle="tooltip" data-placement="bottom" title="Click to Approve this Process Task"></i>
                    </button>
                    <?php } else { ?>
                    <button  style="width: 30px;height: 30px;background-color: white;border: 0px solid gainsboro;outline:none;" id="curtainInput">
                        <i class="fas fa-times-circle cts-cancel" data-toggle="tooltip" data-placement="bottom" title="Click to Cancel this Process Task"></i>
                    </button>
                    <?php } ?>
                </div>
                <?php  }} ?>
                <div style="width: 80%">
                    <a href="#" class="link-intamplate">
                        <p class="text-sub">Process started by <?php echo $pj_user_ceate_name . ' ' . $pj_user_ceate_lname . ' When ' . $pjt_starteddate ?></p>
                    </a>
                    <h1 class="text-f21">Task Name : <?php echo $pjt_title; ?></h1>

                </div>
            </div>
            <div class="btn-setleft">

                <?php 
                    $SQL_task_assi = " SELECT * FROM project_assign_user WHERE pjt_id = $pjt_id AND acc_id = $ss_acc_id ";
                    $SQL_task_assi_query = mysqli_query($conn, $SQL_task_assi);
                    $SQL_task_assi_rs = mysqli_fetch_array($SQL_task_assi_query, MYSQLI_ASSOC);
                    $acc_id_assi = $SQL_task_assi_rs["acc_id"];
                    if($acc_id_assi == $ss_acc_id){ ?>
                        <?php if ($pau_reply == 0) { ?>
                        <button class="btn btn-normal" role="button" data-toggle="modal" data-target="#Model-confirm">
                            <i class="fas fa-check"></i><span id="Btnstartprocess-text"> Accept </span>
                        </button>
                        <?php  } else { ?>
                        <button class="btn" role="button" data-toggle="modal" data-target="#Model-confirm" disabled>
                            <i class="fas fa-check"></i><span id="Btnstartprocess-text"> Accept</span>
                        </button>
                <?php } 
                    } else { } 
                ?>  
                
            </div>
        </header>
        <div class="content-body-headTitle90 box-inprocess">
            <!-- ซ้าย -->
            <div class="box-inprocess-left" id="LeftSide-item">
                <!-- เนื้อหา -->
                <div class="content-body-bodyTitle90 pt-3">
                    <div style="overflow-y:auto;" class="h-100">
                        <div class="file-box">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <i class="fas fa-file-signature text-success"></i>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub text-f14">Project name</div>
                                    <div class="text-f16"><a href="processdisplay.php?pj_id=<?php echo $pj_id; ?>"><?php echo $pj_process_title; ?></a></div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                        <?php 
                            $sql_assign_user_list = "SELECT * FROM project_assign_user WHERE pjt_id ='$pjt_id' AND pau_status ='N'";
                            $sql_assign_user_list_result = $conn->query($sql_assign_user_list);
                            $sql_assign_user_list_count = $sql_assign_user_list_result->num_rows;
                        ?>
                        <div class="file-box mt-2">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <i class="fas fa-users text-secondary"></i>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub text-f14">Assignment User</div>
                                    <div class="d-flex">
                                    <?php if($sql_assign_user_list_count == 0){ ?>
                                        <p class="mb-0 pr-1 text-f16">No Assignment</p>
                                    <?php 
                                        } else {

                                        while($sql_assign_user_list_query = mysqli_fetch_array($sql_assign_user_list_result,MYSQLI_ASSOC)){
                                            $pau_id = $sql_assign_user_list_query["pau_id"];
                                            $acc_id = $sql_assign_user_list_query["acc_id"];

                                            $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$acc_id'";
                                            $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
                                            $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
                                            $pj_user_ceate_name = $SQL_acc_creat_RESULT["acc_name"];
                                            $pj_user_ceate_lname = $SQL_acc_creat_RESULT["acc_lastname"];
                                            $pj_user_ceate_img = $SQL_acc_creat_RESULT["acc_img"];
                                    ?>
                                    <p class="mb-0 pr-1 text-f16">
                                        <?php echo $pj_user_ceate_name.' '.$pj_user_ceate_lname;?>,
                                    </p>
                                    <?php } }?>
                                    </div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="pjt_id" name="pjt_id" value="<?php echo $pjt_id; ?>">
                        <div class="file-box mt-2">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <i class="fas fa-info-circle text-warning"></i>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub text-f14">Description</div>
                                    <div class="text-f16"><?php echo $pjt_description ;?></div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                        <div class="file-box mt-2">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <i class="fas fa-calendar-day text-info"></i>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub text-f14">Started date</div>
                                    <div class="text-f16"><?php echo $pjt_starteddate ;?></div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                        <!-- Due date -->
                        <div class="file-box mt-2">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <i class="fas fa-calendar-check text-danger"></i>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub text-f14">Due date</div>
                                    <div class="text-f16"><?php echo $pjt_duedate ;?></div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                        <div class="file-box mt-2">
                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                <?php if($pjt_complete == 0){ ?>
                                <i class="far fa-times-circle text-danger"></i>
                                <?php } else if ($pjt_complete == 1){?>
                                    <i class="fas fa-hourglass-end" id="task-i" style="color:#c5c101;"></i>
                                <?php }else { ?>
                                <i class="fas fa-check-circle text-success"></i>
                                <?php } ?>
                            </div>
                            <div class="file-text">
                                <div>
                                    <div class="text-sub  text-f14">Status of Project Task</div>
                                    <div class="text-f16"><?php if($pjt_complete == 0){echo'ยังไม่ได้รับการตอบกลับจากผู้ได้รับมอบหมาย';}else if($pjt_complete == 1){echo 'กำลังดำเนินการ';}else{echo'สำเร็จ';}?></div>
                                </div>
                                <div class="file-text-date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ขวา -->
            <?php
            $sql_comments = "SELECT * FROM board_comments WHERE pjt_id ='$pjt_id' AND bc_status = 'N'";
            $sql_comments_result = $conn->query($sql_comments);
            $sql_comments_count = $sql_comments_result->num_rows;

            $sql_comments_files = "SELECT * FROM board_comments WHERE NOT bc_files='0' AND pjt_id ='$pjt_id' AND bc_status = 'N'";
            $sql_comments_files_result = $conn->query($sql_comments_files);
            $sql_comments_files_count = $sql_comments_files_result->num_rows;
            ?>
            <div class="box-inprocess-right" id="RightSide-comment" style="border-left:1px solid #e1ebef; padding-left: 12px;">
                <header class="content-head-inprocess btn-setright tab-active">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="btn btn-normal active" id="pills-comment-tab" data-toggle="pill" href="#pills-comment" role="tab" aria-controls="pills-comment" aria-selected="true">
                                <i class="far fa-comment-dots"></i> <?php echo $sql_comments_count; ?> <span class="tab-inprocess">Comments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-normal" id="pills-file-tab" data-toggle="pill" href="#pills-file" role="tab" aria-controls="pills-file" aria-selected="false">
                                <i class="fas fa-paperclip"></i> <?php echo $sql_comments_files_count; ?> <span class="tab-inprocess">file</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-normal" id="pills-history-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-history" aria-selected="false">
                                <i class="fas fa-history"></i> <span class="tab-inprocess">History</span>
                            </a>
                        </li>
                    </ul>
                    <button class="close" id="btn-OpenComment" onclick="closeCommentSide()">
                        <span>&times;</span>
                    </button>
                </header>
                <div class="content-body-bodyTitle90">
                    <div id="pills-tabContent" class="tab-content" style="height: 100%;">
                        <!-- Comment -->
                        <div class="tab-pane fade show active h-100" id="pills-comment" role="tabpanel" aria-labelledby="pills-comment-tab">
                            <div class="comment-box">
                                <!-- Text -->
                                <?php
                                while ($sql_comments_result_query = mysqli_fetch_array($sql_comments_result, MYSQLI_ASSOC)) {
                                    $bc_id          = $sql_comments_result_query["bc_id"];
                                    $acc_id         = $sql_comments_result_query["acc_id"];
                                    $bc_detail      = $sql_comments_result_query["bc_detail"];
                                    $bc_datetime    = $sql_comments_result_query["bc_datetime"];
                                    $bc_files       = $sql_comments_result_query["bc_files"];
                                    // $path           = "myfile/$bc_files";
                                    // $pathKB         = filesize("myfile/$bc_files") / 1024;
                                    // $pathKB_fm      = number_format($pathKB, 2);

                                    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                    $SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
                                    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);
                                    $name_cm        = $SQL_PROFILE_RESULT["acc_name"];
                                    $lname_cm       = $SQL_PROFILE_RESULT["acc_lastname"];
                                    $img_cm         = $SQL_PROFILE_RESULT["acc_img"];

                                      // $pathKB         = filesize("myfile/$bc_files") / 1024;
                                    // $pathKB_fm      = number_format($pathKB, 2);
                                    ?>
                                    <?php if ($bc_files == 0) { ?>
                                        <div class="comment-box-custom">
                                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px 0 0;">
                                                <img src="assets/img/<?php echo $img_cm; ?>" width="40" height="40" alt="" class="rounded-circle">
                                            </div>
                                            <div class="file-text">
                                                <div>
                                                    <div class="text-f14"><?php echo $name_cm . ' ' . $lname_cm; ?><span class="text-sub pl-2"><?php echo $bc_datetime; ?></span></div>

                                                    <div class="text-detail f-16"><?php echo $bc_detail; ?></div>
                                                </div>
                                                <?php if ($acc_id == $ss_acc_id) { ?>
                                                    <div class="file-text-date">
                                                        <a href="#" class="pr-2 ct-icon">
                                                            <i class="fas fa-trash ct-icon" data-toggle="modal" data-target="#Model-Deletebtn<?php echo $bc_id ?>"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Modal ของปุ่ม delete -->
                                                    <div class="modal fade" id="Model-Deletebtn<?php echo $bc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
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
                                                                                <?php echo $tp_name; ?> delete Comment confirmation
                                                                            </h3>
                                                                            <p class="text-f12" style="margin-top:12px;">
                                                                                Are you sure you want to delete Comment?
                                                                            </p>
                                                                            <div style="margin-top:12px;">
                                                                                <a href="show-task-detail.php?bc_id=<?php echo $bc_id; ?>&delete_comment=delete_comment&pjt_id=<?php echo $pjt_id ?>" <button class="btn btn-delete" style="margin-right:5px;">
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
                                                <?php } ?>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div class="comment-box-custom">
                                            <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px 0 0;">
                                                <img src="assets/img/<?php echo $img_cm; ?>" width="40" height="40" alt="" class="rounded-circle">
                                            </div>
                                            <div class="file-text">
                                                <div>
                                                    <div class="text-f14"><?php echo $name_cm . ' ' . $lname_cm; ?><span class="text-sub pl-2"><?php echo $bc_datetime; ?></span></div>

                                                    <div class="text-detail f-16"><?php echo $bc_detail; ?></div>
                                                    <div class="comment-file">
                                                        <div>
                                                            <i class="far fa-file-alt"></i>
                                                        </div>
                                                        <div>
                                                            <div class="text-f14" style="color: #2e9df0;">
                                                                <a href="myfile/<?php echo $bc_files; ?>"><?php echo $bc_files; ?></a>
                                                            </div>
                                                            <div class="text-sub"><?php echo number_format(filesize("myfile/$bc_files") / 1024, 2); ?>KB</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($acc_id == $ss_acc_id) { ?>
                                                    <div class="file-text-date">
                                                        <a href="#" class="pr-2 ct-icon">
                                                            <i class="fas fa-trash ct-icon" data-toggle="modal" data-target="#Model-Deletebtn<?php echo $bc_id ?>"></i>
                                                        </a>
                                                    </div>
                                                    <!-- Modal ของปุ่ม delete -->
                                                    <div class="modal fade" id="Model-Deletebtn<?php echo $bc_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
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
                                                                                <?php echo $tp_name; ?> delete Comment confirmation
                                                                            </h3>
                                                                            <p class="text-f12" style="margin-top:12px;">
                                                                                Are you sure you want to delete Comment?
                                                                            </p>
                                                                            <div style="margin-top:12px;">
                                                                                <a href="show-task-detail.php?bc_id=<?php echo $bc_id; ?>&delete_comment=delete_comment&pjt_id=<?php echo $pjt_id ?>" <button class="btn btn-delete" style="margin-right:5px;">
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
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php }
                                }  ?>
                            </div>
                            <?php if ($pau_reply == 1) { ?>
                            <form class="comment-chat" action="#" method="post" enctype="multipart/form-data">
                                <div class="inner-chat">
                                    <div class="file-input-wrapper">
                                        <label for="filUpload" class="file-input-button">
                                            <i class="fas fa-paperclip"></i>
                                        </label>
                                        <input id="filUpload" name="filUpload" type="file" />
                                    </div>
                                    <input type="hidden" name="pjt_id" id="pjt_id" value="<?php echo $pjt_id ?>">
                                    <input placeholder="Enter a comment" name="bc_detail" id="bc_detail" />
                                    <?php
                                    print "  <input type=\"hidden\" name=\"appaction\" id=\"appaction\" value=\"add_comment\">";
                                    ?>
                                    <button class="btn" id="sendButton">Add</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                        <!-- File -->
                        <div class="tab-pane fade" id="pills-file" role="tabpanel" aria-labelledby="pills-file-tab">
                            <?php
                            while ($sql_comments_files_result_query = mysqli_fetch_array($sql_comments_files_result, MYSQLI_ASSOC)) {

                                $acc_id         = $sql_comments_files_result_query["acc_id"];
                                $bc_detail      = $sql_comments_files_result_query["bc_detail"];
                                $bc_datetime    = $sql_comments_files_result_query["bc_datetime"];
                                $bc_files       = $sql_comments_files_result_query["bc_files"];
                                $path           = "myfile/$bc_files";
                                $pathKB         = filesize($path) / 1024;
                                $pathKB_fm      = number_format($pathKB, 2);
                                $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                $SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
                                $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);
                                $name_cm        = $SQL_PROFILE_RESULT["acc_name"];
                                $lname_cm       = $SQL_PROFILE_RESULT["acc_lastname"];
                                $img_cm         = $SQL_PROFILE_RESULT["acc_img"];

                                ?>
                                <div class="file-box">
                                    <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <div class="file-text">
                                        <a href="myfile/<?php echo $bc_files; ?>">
                                            <div class="text-f14"><?php echo $bc_files; ?></div>

                                            <div class="text-sub"><?php echo $pathKB_fm; ?> KB</div>
                                        </a>
                                        <div class="file-text-date">
                                            <div>
                                                <div class="text-sub"><?php echo $bc_datetime; ?></div>
                                                <div class="text-sub text-right">by <?php echo $name_cm; ?></div>
                                            </div>
                                            <div class="img-small" style="background: #B8E17D; margin-left: 8px">
                                                <img src="assets/img/<?php echo $acc_img; ?>" class="rounded-circle" alt="" width="24" height="24">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- History -->
                        <div class="tab-pane fade " id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">
                            <ul class="history-box">
                                <!-- จุดสีมีหลายสีที่จะต้องแสดงสถานะต่างๆ เทา#e8e8e8 เขียว#4abc3b เหลือง#f9d83c -->
                                <li>
                                    <!-- วันที่ -->
                                    <span class="date">
                                        24 Apr 2019, 11:45 PM
                                    </span>
                                    <span>
                                        John started this process
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Model-confirm" tabindex="-1" role="dialog" aria-labelledby="Model-confirm" aria-hidden="true">
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
                                confirmation project task : <?php echo $pjt_title; ?>
                            </h3>
                            <p class="text-f12" style="margin-top:12px;">
                                Are you sure you want to confirmation selected project task?
                            </p>
                            <div style="margin-top:12px;">
                                <a href="show-task-detail.php?pjt_id=<?php echo $pjt_id; ?>&comfirm_pjt=comfirm_pjt" <button class="btn btn-delete" style="margin-right:5px;">
                                    Comfirm
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

    <!-- Script -->
    <script>
        $('.date-pic').datepicker({
            language: 'en',
            minDate: new Date()
        })
        $(function() {
            $('#sendButton').attr('disabled', true);
            $('#bc_detail').keyup(function() {
                if ($(this).val().length != 0)
                    $('#sendButton').attr('disabled', false);
                else
                    $('#sendButton').attr('disabled', true);
            })
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>
    <script>
        $(document).ready(function() {
            $("#save").click(function() {
                var pjt_id = $('#pjt_id').val();
                var pjt_description = $('#pjt_description').val();
                var pjt_starteddate = $('#pjt_starteddate').val();
                var pjt_duedate = $('#pjt_duedate').val();
                var project_assign_user = $('#project_assign_user').val();
                console.log(pjt_id);
                $.ajax({
                    url: "save_task.php",
                    type: "POST",
                    data: {
                        pjt_id: pjt_id,
                        pjt_description: pjt_description,
                        pjt_starteddate: pjt_starteddate,
                        pjt_duedate: pjt_duedate,
                        project_assign_user: project_assign_user
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                title: (data),
                                type: "success"
                            }).then(function() {
                                window.location = "show-task-detail.php?pjt_id=<?php echo $pjt_id; ?>";
                            });
                        }, 300);

                    }
                });
            });
        });
        $(document).ready(function() {
            $("#curtainInput").click(function() {
                var pjt_complete    = '1';
                var pj_id           = $('#pj_id').val();
                var pjt_id          = $('#pjt_id').val();
             
                console.log(pjt_complete,pjt_id);
                $.ajax({
                    url: "update-cp-pjt.php",
                    type: "POST",
                    data: {
                        pjt_complete: pjt_complete,
                        pjt_id:pjt_id,
                        pj_id:pj_id
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                title: (data),
                                type: "success"
                            }).then(function() {
                                window.location = "show-task-detail.php?pjt_id=<?php echo $pjt_id; ?>";
                            });
                        }, 300);

                    }
                });
            });
        });
    </script>
</body>

</html>