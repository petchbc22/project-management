<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <link rel="stylesheet" href="assets/css/jquery-ui.css" rel="stylesheet">
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
    if ($delete_task == "deletetask"){
        $sql = "UPDATE project_task SET pjt_status='D' WHERE pjt_id='$pjt_id'";
        $query = mysqli_query($conn,$sql);
        if ($query == TRUE) {
            $message = 'Delete Task Completed ';
            $pj_id = $_GET["pj_id"];
            echo '<script>
            setTimeout(function() { 
                swal({
                    title: "Delete Task Completed",
                    type: "success"
                }).then(function() {
                    window.location = "edit-project.php?pj_id='.$pj_id.'";
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
                  window.location = "edit-project.php?pj_id='.$pj_id.'";
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
    $color                  = $SQL_project_RESULT["color"];
    $tp_id                  = $SQL_project_RESULT["tp_id"];
    $pj_user_ceate          = $SQL_project_RESULT["pj_user_ceate"];
    $pj_process_start       = $SQL_project_RESULT["pj_process_start"];
    $pj_process_deadline    = $SQL_project_RESULT["pj_process_deadline"];
    $pj_dayofwork           = $SQL_project_RESULT["pj_dayofwork"];
    // display template
    $SQL_template = "SELECT * FROM template WHERE tp_id = '$tp_id'  ";
    $SQL_template_QUERY = mysqli_query($conn,$SQL_template);
    $SQL_template_RESULT = mysqli_fetch_array($SQL_template_QUERY,MYSQLI_ASSOC);
    $tp_id      = $SQL_template_RESULT["tp_id"];
    $tp_name    = $SQL_template_RESULT["tp_name"];
    // display account from pj_user_ceate
    $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'  ";
    $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
    $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
    $pj_user_ceate_name     = $SQL_acc_creat_RESULT["acc_name"];
    $pj_user_ceate_lname    = $SQL_acc_creat_RESULT["acc_lastname"];

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
                    <p class="text-sub">Started using template <a href="Intemplate.php?tp_id=<?php echo $tp_id ;?>" class="link-intamplate"><?php echo $tp_name; ?></a></p>
                    <input type="hidden" name="pj_id_post" id="pj_id_post" value="<?php echo $pj_id;?>">
                    <input class="form-control form-control-sm input-Title" id="pj_process_title" name="pj_process_title" type="text" placeholder="Enter Template Title" onkeyup="titleTemplate()" value="<?php echo $pj_process_title;?>">
                    <input name="pj_id" id="pj_id" value="<?php echo $pj_id; ?>" type="hidden">
                    <p class="text-error" id="inputTitle-required"></p>
                </div>
            </div>
            <div class="btn-setleft">
                <button class="btn btn-green" id="save">
                    Update Project
                </button>
            </div>
        </header>
        <div class="createContentBox">
            <!-- Head -->
            <header class="content-head box-normal btn-setright tab-active">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <!-- Tab : ITEM -->
                    <li class="nav-item">
                        <a class="btn btn-normal active" id="pills-Items-tab" href="#pills-Items" 
                        data-toggle="pill" role="tab" aria-controls="pills-Items" aria-selected="true">
                            <i class="fas fa-list"></i> 3 <span class="tabHead-CreateTem">Items</span>
                        </a>
                    </li>
                    <!-- Tab : PROPERTIES -->
                    <li class="nav-item">
                        <a class="btn btn-normal" id="pills-Properties-tab" href="#pills-Properties"
                        data-toggle="pill" role="tab" aria-controls="pills-Properties" aria-selected="false">
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
                    <div class="tab-pane fade show active" id="pills-Items" role="tabpanel" aria-labelledby="pills-Items-tab">
                        <div class="box-two-side">
                            <!-- ซ้าย -->
                            <div class="box-left-side box-scroll" id="LeftSideBox-List" style="border-top: 1px solid#e1ebef;">
                                <div class="tab">
                                    <div class="list-itemTab">
                                        <!-- Process start task-->
                                        <button class="tablinks tab-button box-one" onclick="openItem(event, 'ProcessStart')" id="defaultOpen">                                       
                                            <div class="icon-medium-size-f16" style="color:#a3a3a3b2 ;background: #d6f7d3; margin-right: 12px;">
                                                <i class="fas fa-play" style="color:#a3a3a3b2"></i>
                                            </div>
                                            <div class="text-f14" style="color: #222;">
                                                Process start task
                                            </div>
                                        </button>
                                        <!-- Task dafault ไม่แสดง-->
                                        <?php 
                                            $sql_task_show = "SELECT * FROM project_task WHERE pj_id ='$pj_id' AND pjt_status ='N'";
                                            $sql_task_show_result = $conn->query($sql_task_show);
                                            $sql_task_show_count = $sql_task_show_result->num_rows;
                                        ?>
                                        <?php 
                                            while($task_show_result_query = mysqli_fetch_array($sql_task_show_result,MYSQLI_ASSOC)){
                                                $pjt_id             = $task_show_result_query["pjt_id"];
                                                $pjt_title          = $task_show_result_query["pjt_title"];
                                                $pjt_description    = $task_show_result_query["pjt_description"];
                                  
                                        ?>
                                        <button class="tablinks tab-button box-normal" onclick="openItem(event, 'task<?php echo $pjt_id;?>')">
                                            <div class="box-one" id="task0">
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i id="task-i" class="far fa-square"></i>
                                                </div>
                                                <div class="text-left">
                                                    <h4 class="text-f14" style="color: #959595"><?php echo $pjt_title;?></h4>
                                                    <p class="text-sub" style="margin-top:4px;">No assignees</p>
                                                </div>
                                            </div>
                                            <div class="icon-btn" data-toggle="modal" data-target="#Model-DeleteTask<?php echo $pjt_id ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </button>
                                        <!-- modal deleted -->
                                        <div class="modal fade" id="Model-DeleteTask<?php echo $pjt_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-DeleteTask" aria-hidden="true">
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
                                                                    deletion confirmation
                                                                </h3>
                                                                <p class="text-f12" style="margin-top:12px;">
                                                                    Are you sure you want to delete Task : <label class="text-danger"><?php echo $pjt_title; ?></label> ?
                                                                </p>
                                                                <div style="margin-top:12px;">
                                                                    <a href="edit-project.php?pjt_id=<?php echo $pjt_id; ?>&delete_task=deletetask&pj_id=<?php echo $pj_id;?>"
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
                                        <?php } ?>
                                        <button class="tablinks tab-button box-normal taskdefault" onclick="openItem(event, 'task<?php echo $task_ids;?>')">
                                            <div class="box-one" id="task0">
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
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
                                    <!-- Add item btn (item สุดท้าย)-->
                                    <div class="tab-div justify-content-center">
                                        <a href="edit-fieldset-project.php?pj_id=<?php echo $pj_id;?>" class="link-noEffect">
                                            <button class="btn btn-icon-add">
                                                <div class="add-icon" style="border-radius: 12px;">
                                                    <i class="fas fa-edit"></i>
                                                </div>
                                                <div class="add-text text-f14">
                                                    edit task in fieldset
                                                </div>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- ขวา -->
                            <div class="box-right-side box-scroll" id="RightSideBox-Detail" style="border-top: 1px solid#e1ebef;">
                                <!-- Process Start -->
                                <div id="ProcessStart" class="tabcontent">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <!-- Process start task -->
                                        <div class="tab-pane fade show active" id="v-pills-start" role="tabpanel" aria-labelledby="v-pills-start-tab">
                                            <!-- Header of Process start task -->
                                            <header class="btn-setright">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="btn btn-normal active" id="pills-ProcessDetail-tab" data-toggle="pill" href="#pills-ProcessDetail" role="tab" aria-controls="pills-ProcessDetail" aria-selected="true">
                                                            <span>Process details</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </header>
                                            <!-- เนื้อหาแต่ละ tab -->
                                            <div class="tab-content" id="pills-tabContent">
                                                <!-- Process Detail -->
                                                <div class="tab-pane fade show active" id="pills-ProcessDetail" role="tabpanel" aria-labelledby="pills-ProcessDetail-tab">
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Started Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" autocomplete="off" class="datepicker-set-start form-control form-control-sm pj_process_start w-100" id="pj_process_start" name="pj_process_start" placeholder=" Date" value="<?php echo $pj_process_start; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" autocomplete="off" class="datepicker-set-end form-control form-control-sm pj_process_deadline w-100" id="pj_process_deadline" name="pj_process_deadline" placeholder="Due Date"  value="<?php echo $pj_process_deadline; ?>">  
                                                        </div>
                                                    </div>
                                                 
                                                    <input type="hidden" id="pj_diff_date" name="pj_diff_date">
                                                   
                                                    <!-- Process instructions -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Process instructions</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="pj_instructions" name="pj_instructions" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"><?php echo $pj_instructions;?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Assignment User</label>
                                                        <div class="col-sm-9">
                                                            <select class="chosen-select" data-placeholder="Select users or groups who can work on this task" id="project_main_assign_user" name="project_main_assign_user[]" multiple>
                                                                <option value=""></option>
                                                                <optgroup label="USER">
                                                                <?php 
                                                                    // $sql_user = "SELECT * FROM project_main_assign_user WHERE pj_id = '$pj_id' AND pmau_status = 'N' ";
                                                                    // $sql_user_result = $conn->query($sql_user);
                                                                    // $sql_user_count = $sql_user_result->num_rows;
                                                                     $sql_user = "SELECT * FROM account WHERE acc_status = '1'";
                                                                     $sql_user_result = $conn->query($sql_user);
                                                                     $sql_user_count = $sql_user_result->num_rows;
                                                                    
                                                                    $sql_check = " SELECT acc_id FROM project_main_assign_user WHERE pj_id = '$pj_id' AND pmau_status ='N'";
                                                                    $sql_check_command = $conn->query($sql_check);
                                                                    $sql_check_count = $sql_check_command->numrows;
                                                                    while($objcheck = mysqli_fetch_array($sql_check_command,MYSQLI_ASSOC)){
                                                                        $arr_check[]=$objcheck["acc_id"];
                                                            
                                                            
                                                                    }
                                                                ?>
                                                                <?php 
                                                                    while($mb_result_query = mysqli_fetch_array($sql_user_result,MYSQLI_ASSOC)){
                                                                        // $pj_id  = $mb_result_query["pj_id"];
                                                                        $acc_id = $mb_result_query["acc_id"];
                            
                                                                        $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$acc_id'  ";
                                                                        $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
                                                                        $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
                                                                        $acc_id         = $SQL_PROFILE_RESULT["acc_id"];
                                                                        $acc_name       = $SQL_PROFILE_RESULT["acc_name"];
                                                                        $acc_lastname   = $SQL_PROFILE_RESULT["acc_lastname"];
                                                                        $acc_img        = $SQL_PROFILE_RESULT["acc_img"];
                            
                                                                ?>
                                                                    <option value="<?php echo $acc_id ;?>" <?php if(in_array($mb_result_query["acc_id"],$arr_check)){ echo 'selected'; }?> ><?php echo $acc_name.' '.$acc_lastname?></option>
                                                                <?php } ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Color of Project</label>
                                                        <div class="col-sm-9">
                                                            <input type="color" class="form-control" id="color" name="color"  value="<?php echo $color; ?>">
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
                                    $tdf_id            = $template_result_query_r["tdf_id"];
                                    $pjt_title         = $template_result_query_r["pjt_title"];
                                    $pjt_description   = $template_result_query_r["pjt_description"];
                                    $pjt_starteddate   = $template_result_query_r["pjt_starteddate"];
                                    $pjt_duedate       = $template_result_query_r["pjt_duedate"];
                                ?>
                                <div id="task<?php echo $pjt_id;?>" class="tabcontent">
                                    <input type="hidden" id="pjt_id_post" name="pjt_id_post[]" value="<?php echo $pjt_id; ?>">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active tab-Header" id="v-pills-Task" role="tabpanel" aria-labelledby="v-pills-Task-tab">
                                            <!-- Header new task -->
                                            <header class="btn-setright">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="btn btn-normal active listST" id="pills-ProcessDetail-task-tab" data-toggle="pill" href="#pills-ProcessDetail-task" role="tab" aria-controls="pills-ProcessDetail-task" aria-selected="true">
                                                            <span>Task<span class="headerMobile-point">...</span> <span class="headerMobile-text">details</span></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </header>
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task" role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Task title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-control-sm inputvalidate" type="text" id="task_title" name="task_title[]" value="<?php echo $pjt_title ;?>" disabled>
                                                            <p class="text-error">Text is required</p>
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="task_description" name="task_description[]" rows="5" ><?php echo $pjt_description; ?></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Due date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due date</label>
                                                        <div class="col-sm-9">
                                                            <input class="pjt_duedate<?php echo $tdf_id;?> form-control form-control-sm  w-100" id="pjt_duedate" type="text" name="pjt_duedate[]"  value="<?php echo $pjt_duedate;?>"/>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="pjt_diff_date<?php echo $tdf_id;?>" id="pjt_diff_date" name="pjt_diff_date[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
             
                           
 
                            </div>
                        </div>
                    </div>
               
                    <!-- Tab :: Properties -->
                    <div class="tab-pane fade" id="pills-Properties" role="tabpanel" aria-labelledby="pills-Properties-tab">
                        <div style="border: 1px solid #e1ebef; padding: 16px;">
                            <div class="properties-box">  
                                <label>Process managers</label>
                                <div class="properties-content">
                                    <div class="img-small" style="background: #B8E17D; margin-right: 4px;">
                                        <p>J</p>
                                    </div>
                                    <span><?php echo $pj_user_ceate_name.' '.$pj_user_ceate_lname; ?></span>
                                </div> 
                            </div>
                            <div class="properties-box">  
                                <label>Process starter</label>
                                <div class="properties-content">
                                    <div class="img-small" style="background: #B8E17D; margin-right: 4px;">
                                        <p>J</p>
                                    </div>
                                    <span>Johny</span>
                                </div> 
                            </div>
                      
                        </div>
                    </div>
                    <input type="hidden" id="hdnCount" name="hdnCount">
          
                </div>
            </div>
        </div>
    </div> 

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script> 
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>    
    <script src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $("#pj_process_start").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: new Date(),
        
            onSelect: function(dateStr) 
            {         
                $("#pj_process_deadline").val(dateStr);
                $("#pj_process_deadline").datepicker("option",{ minDate: new Date(dateStr)})
                // loop tdf number 
                <?php 
                    $sql_loop_tdf = "SELECT * FROM  project_task WHERE pj_id = $pj_id";
                    $sql_loop_tdf_result = $conn->query($sql_loop_tdf);
                    while ($sql_loop_tdf_query = mysqli_fetch_array($sql_loop_tdf_result,MYSQLI_ASSOC)) {
                    $tdf_id       = $sql_loop_tdf_query["tdf_id"];
                ?>
                $(".pjt_duedate<?php echo $tdf_id;?>").datepicker("option",{ minDate: new Date(dateStr)})
                <?php } ?>
            }
        });

        $('#pj_process_deadline').datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: new Date(),
            onSelect: function(dateStr) {
                toDate = new Date(dateStr);
                    // Converts date objects to appropriate strings
                    fromDate = ConvertDateToShortDateString(fromDate);
                    toDate = ConvertDateToShortDateString(toDate);
            }
        });
        // loop set datepicker 
        <?php 
            $sql_loop_dpk = "SELECT * FROM  project_task WHERE pj_id = $pj_id";
            $sql_loop_dpk_result = $conn->query($sql_loop_dpk);
            while ($sql_loop_dpk_query = mysqli_fetch_array($sql_loop_dpk_result,MYSQLI_ASSOC)) {
            $tdf_id       = $sql_loop_dpk_query["tdf_id"];
        ?>
        $(".pjt_duedate<?php echo $tdf_id;?>").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: new Date(),
            onSelect: function(dateStr) {
                toDate = new Date(dateStr);
                    // Converts date objects to appropriate strings
                    fromDate = ConvertDateToShortDateString(fromDate);
                    toDate = ConvertDateToShortDateString(toDate);
            }
        });
        <?php } ?>
        
        $(document).ready(function(){
            $("#save").click(function(){
                // for project 
                var start = $("#pj_process_start").datepicker("getDate");
                var end = $("#pj_process_deadline").datepicker("getDate");
                var days = (end - start) / (1000 * 60 * 60 * 24);
                $("#pj_diff_date").val(days);
                // for task is array 
                <?php
                    $sql_diff_js = "SELECT * FROM  project_task WHERE pj_id = $pj_id";
                    $sql_diff_js_result = $conn->query($sql_diff_js);
                    while ($sql_diff_js_query = mysqli_fetch_array($sql_diff_js_result,MYSQLI_ASSOC)) {
                        $tdf_id       = $sql_diff_js_query["tdf_id"];
               
                ?>
                var start_<?php echo $tdf_id ;?> = $("#pj_process_start").datepicker("getDate");
                var end_<?php echo $tdf_id ;?> = $(".pjt_duedate<?php echo $tdf_id; ?>").datepicker("getDate");
                var day_<?php echo $tdf_id ;?> = (end_<?php echo $tdf_id ;?> - start_<?php echo $tdf_id ;?>) / (1000 * 60 * 60 * 24);
                $(".pjt_diff_date<?php echo $tdf_id ;?>").val(day_<?php echo $tdf_id ;?>);
                <?php } ?>
                
                var pj_id_post               = $("#pj_id_post").val(); // id tp_id
                var pj_process_title         = $("#pj_process_title").val(); // name of project
                var pj_process_start         = $("#pj_process_start").val();
                var pj_process_deadline      = $("#pj_process_deadline").val();
                var pj_instructions          = $("#pj_instructions").val();
                var project_main_assign_user = $("#project_main_assign_user").val();
                var color                    = $("#color").val();
                var pj_diff_date             = $("#pj_diff_date").val();
                // 
                var task_title_adds          = $("#task_title_adds").val();
                // variable for array update sql 
                var pjt_id_post              = [];
                var task_title               = [];
                var task_description         = [];
                var pjt_starteddate          = [];
                var pjt_duedate              = [];
                var pjt_diff_date            = [];
                // variable for array insert sql 
                var task_title_add           = []; //  get value for check value isset in save_project_add_task.php 
                var task_description_add     = [];
                var pjt_starteddate_add      = [];
                var pjt_duedate_add          = [];

                $(":input[name='pjt_id_post[]']").each(function() {
                    pjt_id_post.push($( this ).val());
                }); 
                $(":input[name='task_title[]']").each(function() {
                    task_title.push($( this ).val());
                }); 
                $(":input[name='task_description[]']").each(function() {
                    task_description.push($( this ).val());
                }); 
                $(":input[name='pjt_starteddate[]']").each(function() {
                    pjt_starteddate.push($( this ).val());
                }); 
                $(":input[name='pjt_duedate[]']").each(function() {
                    pjt_duedate.push($( this ).val());
                }); 
                $(":input[name='pjt_diff_date[]']").each(function() {
                    pjt_diff_date.push($( this ).val());
                }); 
                // 
                $(":input[name='task_title_add[]']").each(function() {
                    task_title_add.push($( this ).val());
                }); 
                $(":input[name='task_description_add[]']").each(function() {
                    task_description_add.push($( this ).val());
                }); 
                $(":input[name='pjt_starteddate_add[]']").each(function() {
                    pjt_starteddate_add.push($( this ).val());
                }); 
                $(":input[name='pjt_duedate_add[]']").each(function() {
                    pjt_duedate_add.push($( this ).val());
                }); 
                console.log(task_title_adds);
                $.ajax({
                    url:"edit_project_add_task.php",
                    method:"POST",
                    data:{
                        pj_id_post:pj_id_post,
                        pj_process_title:pj_process_title,
                        pj_process_start:pj_process_start,
                        pj_process_deadline:pj_process_deadline,
                        pj_diff_date:pj_diff_date,
                        pj_instructions:pj_instructions,
                        project_main_assign_user:project_main_assign_user,
                        color:color,
                        pjt_id_post:pjt_id_post,
                        task_title:task_title,
                        task_description:task_description,
                        pjt_starteddate:pjt_starteddate,
                        pjt_duedate:pjt_duedate,
                        pjt_diff_date:pjt_diff_date,
                        task_title_adds:task_title_adds,  //get value for check value isset in save_project_add_task.php 
                        task_title_add:task_title_add,
                        task_description_add:task_description_add,
                        pjt_starteddate_add:pjt_starteddate_add,
                        pjt_duedate_add:pjt_duedate_add
                    },
                    success:function(data){
                        // alert (data) ;
                        setTimeout(function() {
                            swal({
                                title: (data),
                                type: "success"
                            }).then(function() {
                                window.location = "edit-project.php?pj_id=<?php echo $pj_id;?>";
                            });
                        }, 300);
                           
                    }
                });
            });
        });
    </script>
</body>
</html>