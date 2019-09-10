<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>Create Template</title>
    <style>
    .swal-title{
        font-size:19px;
    }
    </style>
</head>
<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include 'appsystem/inc_config.php';
    //   displayprofile
    $tp_id = $_GET["tp_id"];

    if (empty($_REQUEST["delete_task"])) { $delete_task = ""; } else { $delete_task = $_REQUEST["delete_task"]; }
    if (empty($_REQUEST["task_id"])) { $task_id = ""; } else { $task_id = $_REQUEST["task_id"]; }
    if (empty($_REQUEST["tp_id"])) { $tp_id = ""; } else { $tp_id = $_REQUEST["tp_id"]; }
    if ($delete_task == "deletetask"){
        $sql = "UPDATE task SET task_status='D' WHERE task_id='$task_id'";
        $query = mysqli_query($conn,$sql);
        if ($query == TRUE) {
            $message = 'Delete Task Completed ';
            $tp_id = $_GET["tp_id"];
            echo '<script>
        
            setTimeout(function() {
                swal({
                    title: "Delete Templated Task Completed",
                    type: "success"
                }).then(function() {
                    window.location = "EditTemplate.php?tp_id='.$tp_id.'";
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

    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'";
    $SQL_PROFILE_QUERY = mysqli_query($conn, $SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY, MYSQLI_ASSOC);

    $acc_name = $SQL_PROFILE_RESULT["acc_name"];
    $acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_img  = $SQL_PROFILE_RESULT["acc_img"];

    // display data template
    $SQL_template = "SELECT * FROM template WHERE tp_id = '$tp_id'";
    $SQL_template_QUERY = mysqli_query($conn, $SQL_template);
    $SQL_template_RESULT = mysqli_fetch_array($SQL_template_QUERY, MYSQLI_ASSOC);
    $tp_id_tp       = $SQL_template_RESULT["tp_id"];
    $tp_name        = $SQL_template_RESULT["tp_name"];
    $tp_user_create = $SQL_template_RESULT["tp_user_create"];
    $tp_datecreate  = $SQL_template_RESULT["tp_datecreate"];
    $tp_title       = $SQL_template_RESULT["tp_title"];
    $tp_instruc     = $SQL_template_RESULT["tp_instruc"];
    $tp_description = $SQL_template_RESULT["tp_description"];

    $SQL_Profile_tp = "SELECT * FROM account WHERE acc_id = '$tp_user_create'";
    $SQL_PROFILE_tp_QUERY = mysqli_query($conn, $SQL_Profile_tp);
    $SQL_PROFILE_tp_RESULT = mysqli_fetch_array($SQL_PROFILE_tp_QUERY, MYSQLI_ASSOC);
    $tp_name_create = $SQL_PROFILE_tp_RESULT["acc_name"];
    $tp_lname_create = $SQL_PROFILE_tp_RESULT["acc_lastname"];

    $sql_template = "SELECT * FROM task WHERE tp_id ='$tp_id' AND task_status ='N'";
    $sql_template_result = $conn->query($sql_template);
    $sql_template_count = $sql_template_result->num_rows;
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
    </nav>   <!-- BODY -->
    <div class="wrapper_main">
        <!-- Head Template Title -->
        <header class="head-title-h64 box-normal">
            <div class="box-flex-Templatetitle">
                <div>
                    <!-- ****ขาดกล่องเลือกภาพ icon ที่จะใช้-->
                    <div class="icon-select">
                        <i class="far fa-images"></i>
                    </div>
                </div>
                <div style="width: 80%">
                    <input class="form-control form-control-sm input-Title" id="tp_name" name="tp_name" type="text" value="<?php echo $tp_name; ?>">
                    <p class="text-error" id="inputTitle-required"></p>
                </div>
            </div>
            <div class="btn-setleft">
                <button class="btn btn-green" id="save">
                    Save Template
                </button>
                <a href="Template.php" class="ml-0">
                    <button class="btn btn-normal">
                        Cancel
                    </button>
                </a>
            </div>
        </header>
        <input type="hidden" id="tp_id_post" name="tp_id_post" value="<?php echo $tp_id;?>">
        <!-- Head -->
        <header class="content-head box-normal btn-setright tab-active">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <!-- Tab : ITEM -->
                <li class="nav-item">
                    <a class="btn btn-normal active" id="pills-Items-tab" href="#pills-Items" data-toggle="pill" href="#pills-Items" role="tab" aria-controls="pills-Items" aria-selected="true">
                        <i class="fas fa-list"></i> <?php echo $sql_template_count; ?> <span class="tabHead-CreateTem">Items</span>
                    </a>
                </li>
            </ul>
            <div>
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
            <div id="pills-tabContent" class="tab-content">
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
                                    <button class="tablinks tab-button box-normal taskdefault js-test" onclick="openItem(event, 'task')">
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
                                    <!-- Task -->
                                    <?php
                                    $i = 1 ;
                                    while ($template_result_query = mysqli_fetch_array($sql_template_result, MYSQLI_ASSOC)) {
                                        $task_id            = $template_result_query["task_id"];
                                        $task_title         = $template_result_query["task_title"];
                                        $task_description   = $template_result_query["task_description"];
                                        ?>
                                        <button class="tablinks tab-button box-normal" onclick="openItem(event, 'task<?php echo $task_id; ?>')">
                                            <div class="box-one">
                                                <div class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i class="far fa-square"></i>
                                                </div>
                                                <div class="text-left">
                                                    <h4 class="text-f14 replac_text_aready<?php echo $i ;?>" style="color: #222"><?php echo $task_title; ?></h4>
                                                    <p class="text-f12" style="color: #222; margin-top:4px;">No assignees</p>
                                                </div>
                                            </div>
                                            <div class="icon-btn ml-3" data-toggle="modal" data-target="#Model-Deletebtn<?php echo $task_id ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </button>
                                        <div class="modal fade" id="Model-Deletebtn<?php echo $task_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
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
                                                                    Are you sure you want to delete Template Task : <label class="text-danger"><?php echo $task_title; ?></label> ?
                                                                </p>
                                                                <div style="margin-top:12px;">
                                                                    <a href="EditTemplate.php?task_id=<?php echo $task_id; ?>&delete_task=deletetask&tp_id=<?php echo $tp_id;?>"
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
                                    <?php $i++; } ?>
                                </div>

                                <!-- Add item btn (item สุดท้าย)-->
                                <div class="tab-div justify-content-center">
                                    <!-- ****ยังกดเพิ่ม item ประเภท task ไม่ได้ -->
                                    <button class="btn btn-icon-add" onclick="addTaskedit()">
                                        <div class="add-icon" style="border-radius: 12px;">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="add-text text-f14">
                                            Task
                                        </div>
                                    </button>
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
                                                <form>
                                                    <!-- Process title -->
                                                    <div class="form-group row form-line" id="Processtitle">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Process title</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" type="text" id="tp_title" name="tp_title" value="<?php echo $tp_title; ?>">
                                                            <p class="text-error" id="ProcesstitleRequired">Text is required</p>
                                                        </div>
                                                    </div>
                                                    <!-- Process instructions -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Process instructions</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="tp_instruc" name="tp_instruc" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"><?php echo $tp_instruc; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Template editors</label>
                                                        <div class="col-sm-9">
                                                            <?php 
                                                                $sql_user = "SELECT * FROM account WHERE acc_status = '1'";
                                                                $sql_user_result = $conn->query($sql_user);
                                                                $sql_user_count = $sql_user_result->num_rows;
                                                                
                                                                $sql_check = " SELECT acc_id FROM template_editors WHERE tp_id = '$tp_id' AND te_status ='N'";
                                                                $sql_check_command = $conn->query($sql_check);
                                                                $sql_check_count = $sql_check_command->numrows;
                                                                while($objcheck = mysqli_fetch_array($sql_check_command,MYSQLI_ASSOC)){
                                                                $arr_check[]=$objcheck["acc_id"];
                                                                }
                                                            ?>
                                                            <select class="chosen-select" data-placeholder="Select users or groups who can work on this task" id="template_editors" name="template_editors[]" multiple="multiple">
                                                            <option value=""></option>
                                                                <?php 
                                                                    while($sql_user_result_query = mysqli_fetch_array($sql_user_result,MYSQLI_ASSOC)){
                                                                        $user_id  = $sql_user_result_query["acc_id"];
                                                                        $user_name = $sql_user_result_query["acc_name"];
                                                                        $user_lname = $sql_user_result_query["acc_lastname"];
                                                                ?>
                                                                    <option value="<?php echo $user_id; ?>" <?php if(in_array($sql_user_result_query["acc_id"],$arr_check)){ echo 'selected'; }?>><?php echo $user_name.' '.$user_lname?></option>
                                                                <?php } ?>
                                                        
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="tp_description" name="tp_description" style="font-size: 12px;" maxlength=150  rows="3" placeholder="Describe this template riefly. This text will appear under template's title in a list"><?php echo $tp_description;?></textarea>
                                                            <span class="text-sub">Maximum of 150 characters</span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Task -->
                            <?php
                            $sql_template_r = "SELECT * FROM task WHERE tp_id ='$tp_id'";
                            $sql_template_result_r = $conn->query($sql_template_r);
                            $sql_template_count_r = $sql_template_result_r->num_rows;
                            ?>
                            <?php
                            $i = 1 ;
                            while ($template_result_query_r = mysqli_fetch_array($sql_template_result_r, MYSQLI_ASSOC)) {
                                $task_id           = $template_result_query_r["task_id"];
                                $task_title         = $template_result_query_r["task_title"];
                                $task_description   = $template_result_query_r["task_description"];
                                ?>
                                <div id="task<?php echo $task_id; ?>" class="tabcontent">
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
                                            <input type="hidden" id="task_id_post" name="task_id_post[]" value="<?php echo $task_id; ?>">
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task" role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Task title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-control-sm main_replac_text<?php echo $i; ?>" type="text" id="task_title" name="task_title[]" value="<?php echo $task_title;?>">
                                                            <p class="text-error" id="TasktitleRequired">Text is required</p>
                                                        </div>
                                                    </div>


                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="task_description" name="task_description[]" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"><?php echo $task_description; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++; } ?>
                            <div id="task" class="tabcontent">
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
                                                        <input class="form-control form-control-sm inputvalidate" type="text" id="task_title_adds" name="task_title_adds" >
                                                        <p class="text-error">Text is required</p>
                                                    </div>
                                                </div>
                                                <!-- Descri -->
                                                <div class="form-group row form-line">
                                                    <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea style="font-size: 12px;" class="form-control" id="task_description_adds" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"></textarea>
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
                <?php
                $sql_sl_memb = " SELECT * FROM account WHERE acc_status = 1";
                $sql_sl_memb_result = $conn->query($sql_sl_memb);
                $sl_memb_count = $sql_sl_memb_result->num_rows;


                $sql_check = " SELECT acc_id FROM template_editors WHERE tp_id = '$tp_id'";
                $sql_check_command = $conn->query($sql_check);
                $sql_check_count = $sql_check_command->numrows;
                while ($objcheck = mysqli_fetch_array($sql_check_command, MYSQLI_ASSOC)) {
                    $arr_check[] = $objcheck["acc_id"];
                }
                ?>
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
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/form.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/radio.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>
    <script src="assets/js/loop_onchange.js"></script>
    <script>
      $(document).ready(function(){
          $("#save").click(function(){
              
              var tp_id_post            = $("#tp_id_post").val(); // id tp_id
              var tp_name               = $("#tp_name").val(); // name of project
              var tp_title              = $("#tp_title").val();
              var tp_instruc            = $("#tp_instruc").val();
              var tp_description        = $("#tp_description").val();
              var task_title_adds       = $("#task_title_adds").val();
              var template_editors       = $("#template_editors").val();
              // variable for array update sql 
              var task_id_post          = [];
              var task_title            = [];
              var task_description      = [];
              // variable for array insert sql 
              var task_title_add        = []; //  get value for check value isset in save_project_add_task.php 
              var task_description_add  = [];
           

              $(":input[name='task_id_post[]']").each(function() {
                task_id_post.push($( this ).val());
              }); 
              $(":input[name='task_title[]']").each(function() {
                task_title.push($( this ).val());
              }); 
              $(":input[name='task_description[]']").each(function() {
                task_description.push($( this ).val());
              }); 
              // 
              $(":input[name='task_title_add[]']").each(function() {
                task_title_add.push($( this ).val());
              }); 
              $(":input[name='task_description_add[]']").each(function() {
                task_description_add.push($( this ).val());
              }); 
        
              console.log(task_title_adds);
              $.ajax({
                  url:"edit_template_add_task.php",
                  method:"POST",
                  data:{
                      tp_id_post:tp_id_post,
                      tp_name:tp_name,
                      tp_title:tp_title,
                      tp_instruc:tp_instruc,
                      tp_description:tp_description,
                      task_title_adds:task_title_adds,
                      task_id_post:task_id_post,
                      task_title:task_title,
                      task_description:task_description,
                      task_title_add:task_title_add,
                      task_description_add:task_description_add,
                      template_editors:template_editors

                  },
                  success:function(data){
                      // alert (data) ;
                      setTimeout(function() {
                          swal({
                              title: (data),
                              type: "success"
                          }).then(function() {
                              window.location = "EditTemplate.php?tp_id=<?php echo $tp_id;?>";
                          });
                      }, 300);
                         
                  }
              });
          });
      });
  </script>
</body>
</html>