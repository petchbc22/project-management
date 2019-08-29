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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>In Process</title>
</head>
<?php 
    error_reporting (E_ALL ^ E_NOTICE);
    include 'appsystem/inc_config.php';
    // get value from modal start process 
    $pj_id = $_GET["pj_id"];
    $tp_id_post = $_POST["tp_id"];
    $pj_process_start_post = $_POST["pj_process_start"];
    $pj_process_deadline_post = $_POST["pj_process_deadline"];
    // $pj_instructions = $_POST["pj_instructions"];
    // $pj_process_start_post = $_POST["pj_process_start"];
    // $pj_process_deadline_post = $_POST["pj_process_deadline"];
    //   displayprofile
    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'  ";
    $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
    $acc_name = $SQL_PROFILE_RESULT["acc_name"];
    $acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_img  = $SQL_PROFILE_RESULT["acc_img"];
    // display project 
    $SQL_project = "SELECT * FROM project WHERE pj_id = '$pj_id' AND pj_status ='N' ";
    $SQL_project_QUERY = mysqli_query($conn,$SQL_project);
    $SQL_project_RESULT = mysqli_fetch_array($SQL_project_QUERY,MYSQLI_ASSOC);
    $pj_process_title = $SQL_project_RESULT["pj_process_title"];
    $pj_instructions = $SQL_project_RESULT["pj_instructions"];
    $tp_id = $SQL_project_RESULT["tp_id"];
    $pj_user_ceate = $SQL_project_RESULT["pj_user_ceate"];
    $pj_process_deadline = $SQL_project_RESULT["pj_process_deadline"];
    // display template
    $SQL_template = "SELECT * FROM template WHERE tp_id = '$tp_id_post'  ";
    $SQL_template_QUERY = mysqli_query($conn,$SQL_template);
    $SQL_template_RESULT = mysqli_fetch_array($SQL_template_QUERY,MYSQLI_ASSOC);
    $tp_name        = $SQL_template_RESULT["tp_name"];
    $tp_user_create = $SQL_template_RESULT["tp_user_create"];

    $SQL_acc_creates = "SELECT * FROM account WHERE acc_id = '$tp_user_create'  ";
    $SQL_acc_create_QUERYs = mysqli_query($conn,$SQL_acc_creates);
    $SQL_acc_creat_RESULTs = mysqli_fetch_array($SQL_acc_create_QUERYs,MYSQLI_ASSOC);
    $pj_user_ceate_names = $SQL_acc_creat_RESULTs["acc_name"];
    $pj_user_ceate_lnames = $SQL_acc_creat_RESULTs["acc_lastname"];
    // display account from pj_user_ceate
    $SQL_acc_create = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'  ";
    $SQL_acc_create_QUERY = mysqli_query($conn,$SQL_acc_create);
    $SQL_acc_creat_RESULT = mysqli_fetch_array($SQL_acc_create_QUERY,MYSQLI_ASSOC);
    $pj_user_ceate_name = $SQL_acc_creat_RESULT["acc_name"];
    $pj_user_ceate_lname = $SQL_acc_creat_RESULT["acc_lastname"];

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
                    <p class="text-sub">Started using template <a href="Intemplate.html" class="link-intamplate"><?php echo $tp_name; ?></a></p>
                    <input type="hidden" name="tp_id_post" id="tp_id_post" value="<?php echo $tp_id_post;?>">
                    <input class="form-control form-control-sm input-Title" id="pj_process_title" name="pj_process_title" type="text" placeholder="Enter Template Title" onkeyup="titleTemplate()" value="<?php echo $_POST["pj_process_title"];?>">
                    <input name="pj_id" id="pj_id" value="<?php echo $pj_id; ?>" type="hidden">
                    <p class="text-error" id="inputTitle-required"></p>
                </div>
            </div>
            <div class="btn-setleft">
                <button class="btn btn-green" id="save">
                    save project
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
                                            $sql_task_show = "SELECT * FROM task WHERE tp_id ='$tp_id_post'";
                                            $sql_task_show_result = $conn->query($sql_task_show);
                                            $sql_task_show_count = $sql_task_show_result->num_rows;
                                        ?>
                                        <?php 
                                            $i = 1 ;
                                            while($task_show_result_query = mysqli_fetch_array($sql_task_show_result,MYSQLI_ASSOC)){
                                                $task_id            = $task_show_result_query["task_id"];
                                                $task_title         = $task_show_result_query["task_title"];
                                                $task_description   = $task_show_result_query["task_description"];
                                        ?>
                                        <button class="tablinks tab-button box-normal" onclick="openItem(event, 'task<?php echo $task_id;?>')">
                                            <div class="box-one" id="task0">
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i id="task-i" class="far fa-square"></i>
                                                </div>
                                                <div class="text-left">
                                                    <h4 class="text-f14 replac_text_aready<?php echo $i;?>" style="color: #959595"><?php echo $task_title;?></h4>
                                                    <p class="text-sub" style="margin-top:4px;">No assignees</p>
                                                </div>
                                            </div>
                                         
                                            <div class="icon-btn" onclick="deleteItem(this,'task<?php echo $task_id;?>')">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </button>
                                        <?php $i++ ; } ?>
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
                                        <!-- Approval ไม่แสดง-->
                                        <button class="tablinks tab-button box-normal approvaldefault" onclick="openItem(event, 'approval')">
                                            <div class="box-one">
                                                <div id="approval-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; border-radius: 20px; margin-right: 12px;">
                                                    <i id="approval-i" class="fas fa-check"></i>
                                                </div>
                                                <div class="text-left">
                                                    <h4 class="text-f14" style="color: #959595">New task</h4>
                                                    <p class="text-sub" style="margin-top:4px;">No assignees</p>
                                                </div>
                                            </div>
                                            <div class="icon-btn" onclick="deleteItem(this,'approval')">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                        </button>
                                        <!-- Group ไม่แสดง-->
                                        <button class="tablinks tab-button box-normal groupdefault" onclick="openItem(event, 'group')">
                                            <div class="box-one">
                                                <i class="fas fa-folder" style="font-size: 38px; color:#E8E8E8; margin-right: 12px;"></i>
                                                <div class="text-left">
                                                    <h4 class="text-f14" style="color: #959595">New Group</h4>
                                                </div>
                                            </div>
                                            <div class="link-ingroup" onclick="intogroup()">
                                                2 items
                                            </div>
                                        </button>
                                    </div>
                                    <!-- Add item btn (item สุดท้าย)-->
                                    <div class="tab-div justify-content-center">
                                        <button class="btn btn-icon-add" onclick="addTask()">
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
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Started Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" autocomplete="off" class="datepicker-set form-control form-control-sm pj_process_start w-100" id="pj_process_start" name="pj_process_start" data-timepicker="true" data-time-format='hh:ii:00' placeholder=" Date" value="<?php echo $pj_process_start_post;?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due Date</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" autocomplete="off" class="datepicker-set form-control form-control-sm pj_process_deadline w-100" id="pj_process_deadline" name="pj_process_deadline" data-timepicker="true" data-time-format='hh:ii:00' placeholder="Due Date" value="<?php echo $pj_process_deadline_post;?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Assignment User</label>
                                                        <div class="col-sm-9">
                                                            <select class="chosen-select" data-placeholder="Select users or groups who can work on this task" id="project_main_assign_user" name="project_main_assign_user[]" multiple>
                                                                <option value=""></option>
                                                                <optgroup label="USER">
                                                                <?php 
                                                                    $sql_sl_memb = " SELECT * FROM account WHERE acc_status = 1";
                                                                    $sql_sl_memb_result = $conn->query($sql_sl_memb);
                                                                    $sl_memb_count = $sql_sl_memb_result->num_rows;

                                                                ?>
                                                                <?php 
                                                                  
                                                                    while($mb_result_query = mysqli_fetch_array($sql_sl_memb_result,MYSQLI_ASSOC)){
                                                                    $acc_id = $mb_result_query["acc_id"];   
                                                                    $acc_name = $mb_result_query["acc_name"];     
                                                                    $acc_lastname = $mb_result_query["acc_lastname"];
                                                                ?>
                                                                    <option value="<?php echo $acc_id ;?>"><?php echo $acc_name.' '.$acc_lastname?></option>
                                                                <?php } ?>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- Process instructions -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Process instructions</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="pj_instructions" name="pj_instructions" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"><?php echo $pj_instructions;?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Color of Project</label>
                                                        <div class="col-sm-9">
                                                            <input type="color" class="form-control" id="color" name="color"  list="">
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
                                    $sql_template_r = "SELECT * FROM task WHERE tp_id ='$tp_id_post'";
                                    $sql_template_result_r = $conn->query($sql_template_r);
                                    $sql_template_count_r = $sql_template_result_r->num_rows;
                                ?>
                                <?php 
                                    $i = 1 ;
                                    while($template_result_query_r = mysqli_fetch_array($sql_template_result_r,MYSQLI_ASSOC)){
                                    $task_id           = $template_result_query_r["task_id"];
                                    $task_title         = $template_result_query_r["task_title"];
                                    $task_description   = $template_result_query_r["task_description"];
                                ?>
                                <div id="task<?php echo $task_id;?>" class="tabcontent">
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
                                            <?php 
                                                $sql_sl_memb = " SELECT * FROM account WHERE acc_status = 1";
                                                $sql_sl_memb_result = $conn->query($sql_sl_memb);
                                                $sl_memb_count = $sql_sl_memb_result->num_rows;

                                            ?>
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task" role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Task title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-control-sm main_replac_text<?php echo $i;?>" type="text" id="task_title" name="task_title[]" value="<?php echo $task_title ;?>">
                                                            <p class="text-error">Text is required</p>
                                                        </div>
                                                    </div>
                                            
                                                   
                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="task_description" name="task_description[]" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"><?php echo $task_description; ?></textarea>
                                                        </div>
                                                    </div>
                                                      <!-- started date -->
                                                      <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Started date</label>
                                                        <div class="col-sm-9">
                                                            <input class="datepicker-set form-control form-control-sm  w-100" id="pjt_starteddate" type="text" name="pjt_starteddate[]" data-language="en" placeholder="Set started date" data-timepicker="true" data-time-format='hh:ii:00' value="<?php echo $pj_process_deadline;?>"/>
                                                        </div>
                                                    </div>
                                                    <!-- Due date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due date</label>
                                                        <div class="col-sm-9">
                                                            <input class="datepicker-set form-control form-control-sm  w-100" id="pjt_duedate" type="text" name="pjt_duedate[]" data-language="en" placeholder="Set due date" data-timepicker="true" data-time-format='hh:ii:00' value="<?php echo $pj_process_deadline;?>"/>
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
                                            <?php 
                                                $sql_sl_memb = " SELECT * FROM account WHERE acc_status = 1";
                                                $sql_sl_memb_result = $conn->query($sql_sl_memb);
                                                $sl_memb_count = $sql_sl_memb_result->num_rows;

                                            ?>
                                            <div class="tab-content tab-body" id="pills-tabContent">
                                                <!-- Task DETAIL -->
                                                <div class="tab-pane fade show active ST" id="pills-ProcessDetail-task" role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Task title</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control form-control-sm inputvalidate" type="text" id="task_titles" >
                                                            <p class="text-error">Text is required</p>
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="task_descriptions" name="task_description" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- started date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Started date</label>
                                                        <div class="col-sm-9">
                                                            <input class="datepicker-set form-control form-control-sm  w-100" id="pjt_starteddates" type="text" name="pjt_starteddate" data-language="en" placeholder="Set started date" data-timepicker="true" data-time-format='hh:ii:00'/>
                                                        </div>
                                                    </div>
                                                    <!-- Due date -->
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Due date</label>
                                                        <div class="col-sm-9">
                                                            <input class="datepicker-set form-control form-control-sm  w-100" id="pjt_duedates" type="text" name="pjt_duedate" data-language="en" placeholder="Set due date" data-timepicker="true" data-time-format='hh:ii:00'/>
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
                    <div class="tab-pane fade" id="pills-Properties" role="tabpanel" aria-labelledby="pills-Properties-tab">
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
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>
    <script src="assets/js/loop_onchange.js"></script>                                    
    <script type="text/javascript">
        $('.datepicker-set').datepicker({
            language: 'en',
            minDate: new Date() 
        })
    </script>
    <script>
        $(document).ready(function(){
            $("#save").click(function(){
                var tp_id_post                  = $("#tp_id_post").val(); // id tp_id
                var pj_process_title            = $("#pj_process_title").val(); // name of project
                var pj_process_start            = $("#pj_process_start").val();
                var pj_process_deadline         = $("#pj_process_deadline").val();
                var project_main_assign_user    = $("#project_main_assign_user").val();
                var pj_instructions             = $("#pj_instructions").val();
                var color                       = $("#color").val();
                var task_title                  = [];
                var task_description            = [];
                var pjt_starteddate             = [];
                var pjt_duedate                 = [];
                console.log(project_main_assign_user);
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
                $.ajax({
                    url:"save_project_add_task.php",
                    method:"POST",
                    data:{
                        // project data
                        tp_id_post:tp_id_post,
                        pj_process_title:pj_process_title,
                        pj_process_start:pj_process_start,
                        pj_process_deadline:pj_process_deadline,
                        project_main_assign_user:project_main_assign_user,
                        pj_instructions:pj_instructions,
                        color:color,
                        // task project data
                        // template_editors:template_editors,
                        task_title:task_title,
                        task_description:task_description,
                        pjt_starteddate:pjt_starteddate,
                        pjt_duedate:pjt_duedate
                    },
                    success:function(data){
                        if (data == 1){
                            setTimeout(function() {
                            swal({
                                title: ('บันทึกโปรเจคสำเร็จ'),
                                type: "success"
                            }).then(function() {
                                window.location = "process.php";
                            });
                        }, 300);
                        }else{
                            setTimeout(function() {
                            swal({
                                title: (data),
                                type: "success"
                            });
                        }, 300);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>