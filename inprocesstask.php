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
    <link rel="stylesheet" href="assets/css/jquery-ui.css" rel="stylesheet">
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>inprocess task</title>
</head>
<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('error_reporting', E_ALL);

    $pjt_id = $_GET["pjt_id"];
    include 'appsystem/inc_config.php';

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
                                    window.location = "inprocesstask.php?pjt_id=' . $pjt_id . '";
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
                        window.location = "inprocesstask.php?pjt_id=' . $pjt_id . '";
                    });
                }, 300);
                </script>';
        }
    }
    //   displayprofile
    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'  ";
    $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
    $acc_name = $SQL_PROFILE_RESULT["acc_name"];
    $acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_img  = $SQL_PROFILE_RESULT["acc_img"];
    // display project 
    $SQL_task = "SELECT * FROM project_task WHERE pjt_id = '$pjt_id'  ";
    $SQL_task_QUERY = mysqli_query($conn,$SQL_task);
    $SQL_task_RESULT = mysqli_fetch_array($SQL_task_QUERY,MYSQLI_ASSOC);
    $pj_id           = $SQL_task_RESULT["pj_id"];
    $pjt_title       = $SQL_task_RESULT["pjt_title"];
    $pjt_starteddate = $SQL_task_RESULT["pjt_starteddate"];
    $pjt_duedate     = $SQL_task_RESULT["pjt_duedate"];
    $pjt_description = $SQL_task_RESULT["pjt_description"];

    $SQL_project = "SELECT * FROM project WHERE pj_id = '$pj_id' AND pj_status ='N' ";
    $SQL_project_QUERY = mysqli_query($conn,$SQL_project);
    $SQL_project_RESULT = mysqli_fetch_array($SQL_project_QUERY,MYSQLI_ASSOC);
    $pj_process_title = $SQL_project_RESULT["pj_process_title"];
    $pj_instructions = $SQL_project_RESULT["pj_instructions"];
    $tp_id = $SQL_project_RESULT["tp_id"];
    $pj_user_ceate = $SQL_project_RESULT["pj_user_ceate"];
    $pj_process_deadline = $SQL_project_RESULT["pj_process_deadline"];
    $pj_process_start = $SQL_project_RESULT["pj_process_start"];
    $pj_process_complete = $SQL_project_RESULT["pj_complete"];
     
    $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'  ";
    $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
    $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
    $pj_user_ceate_name = $SQL_acc_creat_RESULT["acc_name"];
    $pj_user_ceate_lname = $SQL_acc_creat_RESULT["acc_lastname"];
    $pj_user_ceate_img = $SQL_acc_creat_RESULT["acc_img"];
    // display template
    $SQL_task = "SELECT * FROM project_task WHERE pjt_id = '$pjt_id'  ";
    $SQL_task_QUERY = mysqli_query($conn,$SQL_task);
    $SQL_task_RESULT = mysqli_fetch_array($SQL_task_QUERY,MYSQLI_ASSOC);
    $pjt_title = $SQL_task_RESULT["pjt_title"];
    $pjt_complete = $SQL_task_RESULT["pjt_complete"];
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
                <div class="pr-2 py-2">
                    <?php 
                        if($pjt_complete == 0) {
                    ?>
                    <button class="btn-check-app" id="curtainInput">
                        <i class="far fa-check-circle cts-app" data-toggle="tooltip" data-placement="bottom" title="Click to Approve this Process Task"></i>
                    </button>
                    <?php } else { ?>
                    <button  style="width: 30px;height: 30px;background-color: white;border: 0px solid gainsboro;outline:none;" id="curtainInput">
                        <i class="fas fa-times-circle cts-cancel" data-toggle="tooltip" data-placement="bottom" title="Click to Cancel this Process Task"></i>
                    </button>
                    <?php } ?>
                </div>
                <div style="width: 80%">
                    <a href="Inprocess.php" class="link-intamplate"><p class="text-sub">New process started by <?php echo $pj_user_ceate_name.' '.$pj_user_ceate_lname.' on '.$pjt_starteddate ?></p></a>
                    <h1 class="text-f21">Task Name : <?php echo $pjt_title;?></h1>
                   
                </div>
            </div>
            <div class="btn-setleft">
                <a href="processdisplay.php?pj_id=<?php echo $pj_id;?>" class="not_underline">
                    <button class="btn btn-green-bd">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </a>
                <button class="btn btn-save" id="save">
                    <i class="fas fa-save"></i>
                </button>
                
            </div>
        </header>
        <div class="content-body-headTitle90 box-inprocess">
            <!-- ซ้าย -->
            <div class="box-inprocess-left" id="LeftSide-item">
                <!-- เนื้อหา -->
                <div class="content-body-bodyTitle90 pt-3">
                    <div style="overflow-y:auto;" class="h-100">
                        <div class="d-flex">
                            <div class="w-15 m-auto justify-content-start">
                                <label class="text-f14">Assignment</label> 
                            </div>
                            <div class="w-5 m-auto ">
                                :
                            </div>
                            <div class="w-75"> 
                                <?php 
                                     $sql_user = "SELECT * FROM project_main_assign_user WHERE pj_id = '$pj_id' AND pmau_status = 'N' ";
                                     $sql_user_result = $conn->query($sql_user);
                                     $sql_user_count = $sql_user_result->num_rows;
                                    //  $sql_user = "SELECT * FROM account WHERE acc_status = '1'";
                                    //  $sql_user_result = $conn->query($sql_user);
                                    //  $sql_user_count = $sql_user_result->num_rows;
                                     
                                     $sql_check = " SELECT acc_id FROM project_assign_user WHERE pjt_id = '$pjt_id' AND pau_status ='N'";
                                     $sql_check_command = $conn->query($sql_check);
                                     $sql_check_count = $sql_check_command->numrows;
                                     while($objcheck = mysqli_fetch_array($sql_check_command,MYSQLI_ASSOC)){
                                       $arr_check[]=$objcheck["acc_id"];
                             
                             
                                     }
                                ?>
                                <select data-placeholder="Select User to Assign Task" class="form-control chosen-select" id="project_assign_user" name="project_assign_user[]" multiple="multiple">
                                    <option value=""></option>
                                    <?php 
                                        while($sql_user_result_query = mysqli_fetch_array($sql_user_result,MYSQLI_ASSOC)){
                                            $pj_id  = $sql_user_result_query["pj_id"];
                                            $acc_id = $sql_user_result_query["acc_id"];

                                            $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                            $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
                                            $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
                                            $acc_id         = $SQL_PROFILE_RESULT["acc_id"];
                                            $acc_name       = $SQL_PROFILE_RESULT["acc_name"];
                                            $acc_lastname   = $SQL_PROFILE_RESULT["acc_lastname"];
                                            $acc_img        = $SQL_PROFILE_RESULT["acc_img"];

                                       
                                    ?>
                                        <option value="<?php echo $acc_id; ?>" <?php if(in_array($sql_user_result_query["acc_id"],$arr_check)){ echo 'selected'; }?>><?php echo $acc_name.' '.$acc_lastname?></option>
                                    <?php } ?>
                             
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="pjt_id" name="pjt_id" value="<?php echo $pjt_id ;?>">
                        <div class="d-flex pt-3">
                            <div class="w-15 m-auto justify-content-start">
                                <label class="text-f14">Description</label> 
                            </div>
                            <div class="w-5 m-auto ">
                                :
                            </div>
                            <div class="w-75"> 
                                <textarea id="pjt_description" name="pjt_description" cols="10" rows="2" class="form-control text-f14"><?php echo $pjt_description;?></textarea>
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-control-sm date-pic" autocomplete="off" data-timepicker="true" data-time-format="hh:ii:00" placeholder=" Date" value="<?php echo $pjt_starteddate;?>" id="pjt_starteddate" name="pjt_starteddate">           
                        <div class="d-flex pt-3">
                            <div class="w-15 m-auto justify-content-start">
                                <label class="text-f14">Due Date</label> 
                            </div>
                            <div class="w-5 m-auto ">
                                :
                            </div>
                            <div class="w-75"> 
                                <input type="text" class="form-control form-control-sm date-pic" autocomplete="off" data-timepicker="true" data-time-format="hh:ii:00" placeholder=" Date" value="<?php echo $pjt_duedate;?>" id="pjt_duedate" name="pjt_duedate">      
                            </div>
                        </div>
                        <div class="d-flex pt-3">
                            <div class="w-15 m-auto justify-content-start">
                                <label class="text-f14">Status Project</label> 
                            </div>
                            <div class="w-5 m-auto ">
                                :
                            </div>
                            <div class="w-75"> 
                                <p type="text" class="text-f14" autocomplete="off"><?php if($pjt_complete == 0){ echo 'Incompleted';}else{ echo 'Completed';}?></p>    
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
                                    // $pathKB         = filesize($path) / 1024;
                                    // $pathKB_fm      = number_format($pathKB, 2);

                                    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                    $SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
                                    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);
                                    $name_cm        = $SQL_PROFILE_RESULT["acc_name"];
                                    $lname_cm       = $SQL_PROFILE_RESULT["acc_lastname"];
                                    $img_cm         = $SQL_PROFILE_RESULT["acc_img"];

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

    
    <!-- Script -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
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
    <script src="assets/js/jquery-ui.min.js"></script>
    <script>
        $('#pjt_duedate').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: ("<?php echo $pjt_starteddate;?>"),

        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#save").click(function() {
                var pjt_id              = $('#pjt_id').val();
                var pjt_description     = $('#pjt_description').val();
                var pjt_starteddate     = $('#pjt_starteddate').val();
                var pjt_duedate         = $('#pjt_duedate').val();
                var project_assign_user = $('#project_assign_user').val();
                console.log(pjt_id);
                $.ajax({
                    url: "save_task.php",
                    type: "POST",
                    data:{  pjt_id:pjt_id,
                            pjt_description:pjt_description,
                            pjt_starteddate:pjt_starteddate,
                            pjt_duedate:pjt_duedate,
                            project_assign_user:project_assign_user
                        },                   
                        success: function(data) {
                            if(data == 1){
                                setTimeout(function() {
                                    swal({
                                        title: ("แก้ไข Project Task สำเร็จ"),
                                        type: "success"
                                    }).then(function() {
                                        window.location = "inprocesstask.php?pjt_id=<?php echo $pjt_id;?>";
                                    });
                                }, 300);
                            }
                            else{
                                setTimeout(function() {
                                    swal({
                                        title: ("แก้ไข Project Task สำเร็จ"),
                                        type: "success"
                                    }).then(function() {
                                        window.location = "inprocesstask.php?pjt_id=<?php echo $pjt_id;?>";
                                    });
                                }, 300);
                            }
                       
                    }
                });
            });
        });
        $(document).ready(function() {
            $("#curtainInput").click(function() {
                var pjt_complete    = '1';
                var pjt_id          = $('#pjt_id').val();
             
                console.log(pjt_complete,pjt_id);
                $.ajax({
                    url: "update-cp-pjt.php",
                    type: "POST",
                    data: {
                        pjt_complete: pjt_complete,
                        pjt_id:pjt_id
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