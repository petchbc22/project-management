<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>In Process</title>
</head>
<?php 
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
// get value from modal start process 
    $pj_id = $_GET["pj_id"];

    if (empty($_REQUEST["delete_task"])) { $delete_task = ""; } else { $delete_task = $_REQUEST["delete_task"]; }
    if (empty($_REQUEST["delete_project"])) { $delete_project = ""; } else { $delete_project = $_REQUEST["delete_project"]; }
    if (empty($_REQUEST["pjt_id"])) { $pjt_id = ""; } else { $pjt_id = $_REQUEST["pjt_id"]; }
    if (empty($_REQUEST["pj_id"])) { $pj_id = ""; } else { $pj_id = $_REQUEST["pj_id"]; }

    if ($delete_project == "delete_project"){
        $sql = "UPDATE project SET pj_status='D' WHERE pj_id='$pj_id'";
        $query = mysqli_query($conn,$sql);
        if ($query == TRUE) {
            $message = 'Delete Project Completed ';
            echo '<script>
        
            setTimeout(function() {
                swal({
                    title: "Delete Project Completed",
                    type: "success"
                }).then(function() {
                    window.location = "process.php";
                });
            }, 300);
            </script>'; 
        }
    }
    if ($delete_task == "deletetask"){
        $sql = "UPDATE project_task SET pjt_status='D' WHERE pjt_id='$pjt_id'";
        $query = mysqli_query($conn,$sql);
        if ($query == TRUE) {
            $message = 'Delete Task Completed ';
            $pj_id = $_GET["pj_id"];
          //   echo "<SCRIPT type='text/javascript'> //not showing me this
          //             alert('$message');
          //             window.location.replace(\"processdisplay.php?pj_id=$pj_id\");
          //         </SCRIPT>";
          // setTimeout(function() {
          //     swal({
          //         title: "Delete Task Completed",
          //         type: "success"
          //     });
          // }, 300);
          echo '<script>
     
          setTimeout(function() {
              swal({
                  title: "Delete Task Completed",
                  type: "success"
              }).then(function() {
                  window.location = "processdisplay.php?pj_id='.$pj_id.'";
              });
          }, 300);
          </script>'; 
        }
        else {
          echo '<script>
     
          setTimeout(function() {
              swal({
                  title: "Delete Task uncompleted",
                  type: "success"
              }).then(function() {
                  window.location = "processdisplay.php?pj_id='.$pj_id.'";
              });
          }, 300);
          </script>'; 
        }
    }
    //   displayprofile
    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'  ";
    $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
    $acc_name       = $SQL_PROFILE_RESULT["acc_name"];
    $acc_lastname   = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_img        = $SQL_PROFILE_RESULT["acc_img"];
    // display project 
    $SQL_project = "SELECT * FROM project WHERE pj_id = '$pj_id' AND pj_status ='N' ";
    $SQL_project_QUERY = mysqli_query($conn,$SQL_project);
    $SQL_project_RESULT = mysqli_fetch_array($SQL_project_QUERY,MYSQLI_ASSOC);

    $pj_process_title       = $SQL_project_RESULT["pj_process_title"];
    $pj_instructions        = $SQL_project_RESULT["pj_instructions"];
    $tp_id                  = $SQL_project_RESULT["tp_id"];
    $pj_user_ceate          = $SQL_project_RESULT["pj_user_ceate"];
    $pj_process_start       = $SQL_project_RESULT["pj_process_start"];
    $pj_process_deadline    = $SQL_project_RESULT["pj_process_deadline"];
    $pj_dayofwork           = $SQL_project_RESULT["pj_dayofwork"];

    // display template
    $SQL_template = "SELECT * FROM template WHERE tp_id = '$tp_id'  ";
    $SQL_template_QUERY = mysqli_query($conn,$SQL_template);
    $SQL_template_RESULT = mysqli_fetch_array($SQL_template_QUERY,MYSQLI_ASSOC);
    $tp_id          = $SQL_template_RESULT["tp_id"];
    $tp_name        = $SQL_template_RESULT["tp_name"];
    $tp_user_create = $SQL_template_RESULT["tp_user_create"];
    // display account from pj_user_ceate
    $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'  ";
    $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
    $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
    $pj_user_ceate_names     = $SQL_acc_creat_RESULT["acc_name"];
    $pj_user_ceate_lnames    = $SQL_acc_creat_RESULT["acc_lastname"];

?>

<body>
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
            <a class="p-2 dropdown-toggle" href="#" id="navbarDropdowns" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
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

                <a class="dropdown-item" href="show-task-detail.php?pjt_id=<?php echo $task_id_name; ?>">your task :
                    <?php echo $pj_name; ?>
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
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
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
    <!-- กรณี I  -->
    <div class="wrapper_main" style="position: relative">
        <header class="head-title-h90 box-normal">
            <div class="box-flex-Templatetitle">
                <div>
                    <div class="icon-medium-size-f20" style="color:#222; background: #ccc; margin-right: 12px;">
                        <i class="far fa-file-alt"></i>
                    </div>
                </div>
                <div style="width: 80%">
                    <p class="text-sub">Started using template <a href="Intemplate.php?tp_id=<?php echo $tp_id ;?>"
                            class="link-intamplate"><?php echo $tp_name; ?></a></p>
                    <input type="hidden" name="pj_id_post" id="pj_id_post" value="<?php echo $pj_id;?>">
                    <h3 class="text-f21"><?php echo $pj_process_title;?></h3>
                    <input name="pj_id" id="pj_id" value="<?php echo $pj_id; ?>" type="hidden">
                    <p class="text-error" id="inputTitle-required"></p>
                </div>
            </div>
            <?php if($ss_acc_id == $pj_user_ceate ) { ?>
            <div class="btn-setleft d-flex">
                <a href="edit-project.php?pj_id=<?php echo $pj_id;?>">
                    <div class="icon-edit mr-2">
                        <i class="fas fa-edit"></i>
                    </div>
                </a>
                <div class="icon-btn" data-toggle="modal" data-target="#Model-Deleteproject">
                    <i class="fas fa-trash-alt"></i>
                </div>
            </div>
            <?php } ?>
        </header>
        <?php 
            $sql_task_show = "SELECT * FROM project_task WHERE pj_id ='$pj_id' AND pjt_status ='N'";
            $sql_task_show_result = $conn->query($sql_task_show);
            $sql_task_show_count = $sql_task_show_result->num_rows;
        ?>
        <div class="createContentBox">
            <!-- Head -->
            <header class="content-head box-normal btn-setright tab-active">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- Tab : ITEM -->
                    <li class="nav-item">
                        <a class="btn btn-normal active" id="pills-Items-tab" href="#pills-Items" data-toggle="pill"
                            role="tab" aria-controls="pills-Items" aria-selected="true">
                            <i class="fas fa-list"></i> <?php echo $sql_task_show_count; ?> <span class="tabHead-CreateTem">Items</span>
                        </a>
                    </li>
                    <!-- Tab : PROPERTIES -->
                    <li class="nav-item">
                        <a class="btn btn-normal" id="pills-Properties-tab" href="#pills-Properties" data-toggle="pill"
                            role="tab" aria-controls="pills-Properties" aria-selected="false">
                            <i class="fas fa-cog"></i> <span class="tabHead-CreateTem">Properties</span>
                        </a>
                    </li>

                </ul>

                <div>
                    <!-- ปุ่มสำหรับ mobile size ใช้สลับเปลี่ยนแสดงระหว่างด้านซ้ายและขวา -->
                    <button class="btn btn-normal" id="LeftSide-List" onclick="openRightSide()">
                        List
                    </button>
                    <button class="btn btn-normal" id="RightSide-Detail" onclick="openLeftSide()">
                        Details
                    </button>
                </div>
            </header>
            <!-- Body -->

            <div class="content-body-headTitle64">
                <div class="tab-content" id="pills-tabContent">
                    <!-- Tab :: Item -->
                    <div class="tab-pane fade show active" id="pills-Items" role="tabpanel"
                        aria-labelledby="pills-Items-tab">
                        <div class="box-two-side">
                            <!-- ซ้าย -->
                            <div class="box-left-side box-scroll" id="LeftSideBox-List"
                                style="border-top: 1px solid#e1ebef;">
                                <div class="tab">
                                    <div class="list-itemTab">
                                        <!-- Process start task-->
                                        <button class="tablinks tab-button box-one"
                                            onclick="openItem(event, 'ProcessStart')" id="defaultOpen">
                                            <div class="icon-medium-size-f16"
                                                style="color:#a3a3a3b2 ;background: #d6f7d3; margin-right: 12px;">
                                                <i class="fas fa-play" style="color:#a3a3a3b2"></i>
                                            </div>
                                            <div class="text-f14" style="color: #222;">
                                                Process start task
                                            </div>
                                        </button>
                   
                                    
                                        <?php 
                                            while($task_show_result_query = mysqli_fetch_array($sql_task_show_result,MYSQLI_ASSOC)){
                                                $pjt_id       = $task_show_result_query["pjt_id"];
                                                $pj_id        = $task_show_result_query["pj_id"];   
                                                $pjt_title    = $task_show_result_query["pjt_title"];
                                                $pjt_duedate  = $task_show_result_query["pjt_duedate"];
                                                $pjt_complete = $task_show_result_query["pjt_complete"];
        
                                                $SQL_project = "SELECT * FROM project WHERE pj_id = '$pj_id' AND pj_status ='N' ";
                                                $SQL_project_QUERY = mysqli_query($conn,$SQL_project);
                                                $SQL_project_RESULT = mysqli_fetch_array($SQL_project_QUERY,MYSQLI_ASSOC);
                                                $pj_user_ceate = $SQL_project_RESULT["pj_user_ceate"];

                                                $SQL_custom = "SELECT * FROM vw_for_search WHERE pj_id = '$pj_id' AND pjt_id ='$pjt_id' AND acc_id = '$ss_acc_id' ";
                                                $SQL_custom_QUERY = mysqli_query($conn,$SQL_custom);
                                                $SQL_custom_RESULT = mysqli_fetch_array($SQL_custom_QUERY,MYSQLI_ASSOC);
                                                $queryacc_id = $SQL_custom_RESULT["acc_id"];

                         
                                        ?>
                                        <button class="tablinks tab-button box-normal"
                                            onclick="openItem(event, 'task<?php echo $pjt_id;?>')">
                                            <div class="box-one" id="task0">
                                                <?php if($pjt_complete == 0 ){?>
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i class="fas fa-times" id="task-i" style="color:red;"></i>
                                                </div>
                                                <?php } else if ($pjt_complete == 1) {  ?>
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #fff; background: #E8E8E8; margin-right: 12px;">
                                                    <i class="fas fa-hourglass-end" id="task-i" style="color:#c5c101;"></i>
                                                </div>
                                                <?php } else {  ?>
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #fff; background: #E8E8E8; margin-right: 12px;">
                                                    <i class="fas fa-check" id="task-i" style="color:green;"></i>
                                                </div>
                                                <?php } ?>
                                                <div class="text-left">
                                                    <?php if ($ss_acc_permission == 2){?>
                                                        <?php if($ss_acc_id == $queryacc_id) { ?>
                                                        <a href="show-task-detail.php?pjt_id=<?php echo $pjt_id;?>">
                                                            <h4 class="text-f14" style="color: #959595">
                                                                <?php echo $pjt_title;?></h4>
                                                        </a>
                                                        <?php } else {?>
                                                        <h4 class="text-f14" style="color: #959595"><?php echo $pjt_title;?>
                                                        </h4>
                                                        <?php }  ?>

                                                    <?php } else { ?>
                                                        <?php if($ss_acc_id == $pj_user_ceate) { ?>
                                                        <a href="inprocesstask.php?pjt_id=<?php echo $pjt_id;?>">
                                                            <h4 class="text-f14" style="color: #959595">
                                                                <?php echo $pjt_title;?></h4>
                                                        </a>
                                                        <?php } else {?>
                                                        <h4 class="text-f14" style="color: #959595"><?php echo $pjt_title;?>
                                                        </h4>
                                                        <?php } } ?>
                                                    <?php   
                                                        $sql_assign_user_lists = "SELECT * FROM project_assign_user WHERE pjt_id ='$pjt_id' AND pau_status ='N'";
                                                        $sql_assign_user_list_results = $conn->query($sql_assign_user_lists);
                                                        $sql_assign_user_list_counts = $sql_assign_user_list_results->num_rows;
                                                        if( $sql_assign_user_list_counts == 0){
                                                    ?>
                                                    <p class="text-sub" style="margin-top:4px;">No Assignment</p>
                                                    <?php } else { ?>
                                                    <p class="text-sub" style="margin-top:4px;"><?php echo $sql_assign_user_list_counts; ?> Person</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if($ss_acc_id == $pj_user_ceate) { ?>
                                            <div class="icon-btn" data-toggle="modal"
                                                data-target="#Model-DeleteTask<?php echo $pjt_id ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                            <?php } ?>
                                        </button>
                                        <!-- modal deleted -->
                                        <div class="modal fade" id="Model-DeleteTask<?php echo $pjt_id ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="Model-DeleteTask" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <!-- ปุ่ม x -->
                                                        <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <!-- เนื้อหา -->
                                                        <div class="mt-2" style="display: flex;">
                                                            <div
                                                                style="margin-right:24px; color: #F7DB31; font-size: 35px">
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            </div>
                                                            <div>
                                                                <h3 class="text-f15">
                                                                    deletion confirmation
                                                                </h3>
                                                                <p class="text-f12" style="margin-top:12px;">
                                                                    Are you sure you want to delete Task : <label
                                                                        class="text-danger"><?php echo $pjt_title; ?></label>
                                                                    ?
                                                                </p>
                                                                <div style="margin-top:12px;">
                                                                    <a href="processdisplay.php?pjt_id=<?php echo $pjt_id; ?>&delete_task=deletetask&pj_id=<?php echo $pj_id;?>"
                                                                        <button class="btn btn-delete"
                                                                        style="margin-right:5px;">
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
                                        <button class="tablinks tab-button box-normal taskdefault"
                                            onclick="openItem(event, 'task<?php echo $task_ids;?>')">
                                            <div class="box-one" id="task0">
                                                <div id="task-icon" class="icon-medium-size-f16"
                                                    style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i id="task-i" class="far fa-square"></i>
                                                </div>
                                                <div class="text-left">
                                                    <h4 class="text-f14" style="color: #959595">New task</h4>
                                                    <p class="text-sub" style="margin-top:4px;">No assignees</p>
                                                </div>
                                            </div>

                                            <div class="icon-btn" onclick="deleteItem(this,'task')">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- ขวา -->
                            <div class="box-right-side box-scroll" id="RightSideBox-Detail"
                                style="border-top: 1px solid#e1ebef;">
                                <!-- Process Start -->
                                <div id="ProcessStart" class="tabcontent">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <!-- Process start task -->
                                        <div class="tab-pane fade show active" id="v-pills-start" role="tabpanel"
                                            aria-labelledby="v-pills-start-tab">
                                            <!-- เนื้อหาแต่ละ tab -->
                                            <div class="tab-content" id="pills-tabContent">
                                                <!-- Process Detail -->
                                                <div class="tab-pane fade show active" id="pills-ProcessDetail"
                                                    role="tabpanel" aria-labelledby="pills-ProcessDetail-tab">
                                                    <div class="file-box">
                                                        <div class="icon-medium-size-f20"
                                                            style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-calendar-plus text-success"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Started Date Project</div>
                                                                <div class="text-sub text-f15"><?php echo $pj_process_start ;?>
                                                                </div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20"
                                                            style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-calendar-week text-danger"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Due Date Project</div>
                                                                <div class="text-sub text-f15">
                                                                    <?php echo $pj_process_deadline ;?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20"
                                                            style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-tasks"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Status Project</div>
                                                                <div class="text-sub text-f15">
                                                                    <?php if ($pj_process_complete == 0){echo 'Incompleted';}else{ echo 'Completed';}  ;?>
                                                                </div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20"
                                                            style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-users text-info"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">All responsible</div>
                                                                <!-- sql  SELECT DISTINCT acc_id FROM vw_project WHERE pj_id =64 -->
                                                                <?php 
                                                                $sql_querycountuser = "SELECT acc_id FROM project_main_assign_user WHERE pj_id ='$pj_id' AND pmau_status ='N'";
                                                                $sql_querycountuse_result = $conn->query($sql_querycountuser);
                                                                $sql_querycountuse_count = $sql_querycountuse_result->num_rows;
                                                                
                                                            ?>
                                                                <label class="text-sub text-f15">
                                                                    <?php echo $sql_querycountuse_count; ?> persons :
                                                                </label>
                                                                <?php 
                                                            while($project_result_querys = mysqli_fetch_array($sql_querycountuse_result,MYSQLI_ASSOC)){
                                                                $acc_id    = $project_result_querys["acc_id"];

                                                                $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                                                $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
                                                                $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
                                                                $pj_user_ceate_name     = $SQL_acc_creat_RESULT["acc_name"];
                                                                $pj_user_ceate_lname    = $SQL_acc_creat_RESULT["acc_lastname"];
                                                                $pj_user_ceate_img      = $SQL_acc_creat_RESULT["acc_img"];
                                                                
                                                        
                                                            ?>
                                                                <label
                                                                    class="text-sub text-f15"><?php echo $pj_user_ceate_name.' '.$pj_user_ceate_lname;?>
                                                                    , </label> <?php }?>
                                                                <div class="text-sub"></div>

                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-calendar-day text-warning"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Duration of Project</div>
                                                                <div class="text-sub text-f15">
                                                                    <?php echo $pj_dayofwork; ?> day
                                                                </div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fields visibility -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Task-->
                                <?php 
                                    $sql_template_r = "SELECT * FROM project_task WHERE pj_id ='$pj_id'";
                                    $sql_template_result_r = $conn->query($sql_template_r);
                                    $sql_template_count_r = $sql_template_result_r->num_rows;
                                ?>
                                <?php 
                                    while($template_result_query_r = mysqli_fetch_array($sql_template_result_r,MYSQLI_ASSOC)){
                                    $pjt_id            = $template_result_query_r["pjt_id"];
                                    $pjt_title         = $template_result_query_r["pjt_title"];
                                    $pjt_description   = $template_result_query_r["pjt_description"];
                                    $pjt_starteddate   = $template_result_query_r["pjt_starteddate"];
                                    $pjt_duedate       = $template_result_query_r["pjt_duedate"];
                                    $pjt_complete      = $template_result_query_r["pjt_complete"];
                                    $pjt_dayofwork     = $template_result_query_r["pjt_dayofwork"];  
                                ?>
                                <div id="task<?php echo $pjt_id;?>" class="tabcontent">
                                    <input type="hidden" id="pjt_id_post" name="pjt_id_post[]"
                                        value="<?php echo $pjt_id; ?>">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active tab-Header" id="v-pills-Task"
                                            role="tabpanel" aria-labelledby="v-pills-Task-tab">
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task"
                                                    role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="file-box">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-heading text-success"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Task title</div>
                                                                <div class="text-sub text-f15"><?php echo $pjt_title ;?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-info-circle text-warning"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Description</div>
                                                                <div class="text-sub text-f15"><?php echo $pjt_description ;?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                                    <!-- started date -->
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-calendar-day text-info"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Started date</div>
                                                                <div class="text-sub text-f15"><?php echo $pjt_starteddate ;?></div>
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
                                                                <div class="text-f14">Due date</div>
                                                                <div class="text-sub text-f15"><?php echo $pjt_duedate ;?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- dayof work -->
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-calendar-day text-warning"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Duration of Task</div>
                                                                <div class="text-sub text-f15"><?php echo $pjt_dayofwork ;?> day</div>
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
                                                                <div class="text-f14">Assignment User</div>
                                                                <div class="text-sub d-flex text-f15">
                                                                <?php if($sql_assign_user_list_count == 0){ ?>
                                                                    <p class="mb-0 pr-1">No Assignment</p>
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
                                                                <p class="mb-0 pr-1">
                                                                    <?php echo $pj_user_ceate_name.' '.$pj_user_ceate_lname;?>,
                                                                </p>
                                                                <?php } }?>
                                                                </div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <?php if($pjt_complete == 0){ ?>
                                                            <i class="fas fa-times text-danger"></i>
                                                            <?php } elseif($pjt_complete == 1) { ?>
                                                            <i class="fas fa-hourglass-end text-warning"></i>
                                                            <?php } else { ?>
                                                            <i class="fas fa-check-circle text-success"></i>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Status of Project Task</div>
                                                                <div class="text-sub text-f15"><?php if($pjt_complete == 1){echo'pending';}else if($pjt_complete == 2){echo'Completed';}else{echo'Waiting Accept from USER';}?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div id="task" class="tabcontent">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active tab-Header" id="v-pills-Task" role="tabpanel" aria-labelledby="v-pills-Task-tab">
                                            <!-- Header new task -->
                                            <header class="btn-setright">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="btn btn-normal active listST"
                                                            id="pills-ProcessDetail-task-tab" data-toggle="pill"
                                                            href="#pills-ProcessDetail-task" role="tab"
                                                            aria-controls="pills-ProcessDetail-task"
                                                            aria-selected="true">
                                                            <span>Task<span class="headerMobile-point">...</span> <span
                                                                    class="headerMobile-text">details</span></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </header>
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task"
                                                    role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Task title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-control-sm inputvalidate"
                                                                type="text" id="task_title_adds" name="task_title_adds">
                                                            <p class="text-error">Text is required</p>
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle"
                                                            class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control"
                                                                id="task_description_adds" rows="5"
                                                                placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- started date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Started date</label>
                                                        <div class="col-sm-9">
                                                            <input
                                                                class="datepicker-set form-control form-control-sm  w-100"
                                                                id="pjt_starteddate_adds" type="text" data-language="en"
                                                                placeholder="Set started date" data-timepicker="true"
                                                                data-time-format='hh:ii:00' />
                                                        </div>
                                                    </div>
                                                    <!-- Due date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due date</label>
                                                        <div class="col-sm-9">
                                                            <input
                                                                class="datepicker-set form-control form-control-sm  w-100"
                                                                id="pjt_duedate_adds" type="text" data-language="en"
                                                                placeholder="Set due date" data-timepicker="true"
                                                                data-time-format='hh:ii:00' />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab :: Properties -->
                    <div class="tab-pane fade" id="pills-Properties" role="tabpanel"
                        aria-labelledby="pills-Properties-tab">
                        <div style="border: 1px solid #e1ebef; padding: 16px;">
                            <div class="properties-box">
                                <label>Process managers</label>
                                <div class="properties-content">
                                    <div class="img-small" style="background: #B8E17D; margin-right: 4px;">
                                        <p>J</p>
                                    </div>
                                    <span><?php echo $pj_user_ceate_names.' '.$pj_user_ceate_lnames; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hdnCount" name="hdnCount">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Model-Deleteproject" tabindex="-1" role="dialog" aria-labelledby="Model-DeleteTask" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- ปุ่ม x -->
                    <button class="close" type="button" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- เนื้อหา -->
                    <div class="mt-2" style="display: flex;">
                        <div
                            style="margin-right:24px; color: #F7DB31; font-size: 35px">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h3 class="text-f15">
                                deletion confirmation
                            </h3>
                            <p class="text-f12" style="margin-top:12px;">Are you sure you want to delete Project : <label class="text-danger"><?php echo $pj_process_title; ?></label>?</p>
                            <div style="margin-top:12px;">
                                <a href="processdisplay.php?&pj_id=<?php echo $pj_id; ?>&delete_project=delete_project"
                                    <button class="btn btn-delete"
                                    style="margin-right:5px;">
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
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>
    <script type="text/javascript">
    $('.datepicker-set').datepicker({
        language: 'en',
        minDate: new Date()
    })
    </script>

</body>

</html>