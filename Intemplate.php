<?php 
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
//   displayprofile
$tp_id = $_GET["tp_id"];
$SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'";
$SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
$SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);

$acc_name = $SQL_PROFILE_RESULT["acc_name"];
$acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
$acc_img  = $SQL_PROFILE_RESULT["acc_img"];

// display data template
$SQL_template = "SELECT * FROM template WHERE tp_id = '$tp_id'";
$SQL_template_QUERY = mysqli_query($conn,$SQL_template); 
$SQL_template_RESULT = mysqli_fetch_array($SQL_template_QUERY,MYSQLI_ASSOC);
$tp_id_tp       = $SQL_template_RESULT["tp_id"];
$tp_name        = $SQL_template_RESULT["tp_name"];
$tp_user_create = $SQL_template_RESULT["tp_user_create"];
$tp_datecreate  = $SQL_template_RESULT["tp_datecreate"];
$tp_title       = $SQL_template_RESULT["tp_title"];
$tp_instruc     = $SQL_template_RESULT["tp_instruc"];
$tp_description = $SQL_template_RESULT["tp_description"];

$SQL_Profile_tp = "SELECT * FROM account WHERE acc_id = '$tp_user_create'";
$SQL_PROFILE_tp_QUERY = mysqli_query($conn,$SQL_Profile_tp);
$SQL_PROFILE_tp_RESULT = mysqli_fetch_array($SQL_PROFILE_tp_QUERY,MYSQLI_ASSOC);
$tp_name_create = $SQL_PROFILE_tp_RESULT["acc_name"];
$tp_lname_create = $SQL_PROFILE_tp_RESULT["acc_lastname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/sweetalert.css"> 
    <script src="assets/js/sweetalert2@8.js"></script>
    <title>In Template</title>
</head>
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
    </nav>  <!-- BODY -->
    <div class="wrapper_main" style="position: relative">
        <!-- Head Template Title -->
        <header class="head-title-h64 box-normal">
            <div class="box-flex-Templatetitle">
                <div>
                    <div class="icon-medium-size-f20" style="color:#222; background: #ccc; margin-right: 12px;">
                        <i class="far fa-file-alt"></i>
                    </div>
                </div>
                <div>
                    <p class="text-sub-mini">TEMPLATE</p>
                    <h1 class="text-f21"><?php echo $tp_name; ?></h1>
                </div>
            </div>
            <div class="btn-setleft" id="mobileSizeBtnHeader">
                <button class="btn btn-green" data-toggle="modal"  data-target="#Model-StartProcessbtn">
                    Start process
                </button>
              
            </div>
            <!-- Modal of btn-startProcess -->
            <div class="modal fade" id="Model-StartProcessbtn" tabindex="-1" role="dialog" aria-labelledby="Model-StartProcessbtn" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- ปุ่ม x -->
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- เนื้อหา -->
                            <form class="mt-2" action="Inprocess.php" method="POST">
                                <div class="box-one">
                                    <div class="icon-small-size" style="background: #ccc; margin-right: 8px">
                                        <i class="far fa-file-alt"></i>
                                    </div>
                                    <h3 class="text-f16"><?php echo $tp_name; ?></h3>
                                </div>
                                <!-- Process Title -->
                                <div class="form-group row form-line">
                                    <label class="col-sm-3 col-form-label"><b>Process title</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pj_process_title" id="pj_process_title" class="form-control w-50" placeholder="project name ">
                                    </div>
                                </div>
                                <input type="hidden" name="tp_id" value="<?php echo $tp_id ; ?>"/>
                                <!-- Process deadline -->
                                <div class="form-group row form-line">
                                    <label class="col-sm-3 col-form-label"><b>Process started</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" autocomplete="off" class="form-control pj_process_start w-50" id="pj_process_start" name="pj_process_start" data-timepicker="true" data-time-format='hh:ii:00' placeholder=" Date">
                                    </div>
                                </div>
                                <div class="form-group row form-line">
                                    <label class="col-sm-3 col-form-label"><b>Process deadline</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" autocomplete="off" class="form-control pj_process_deadline w-50" id="pj_process_deadline" name="pj_process_deadline" data-timepicker="true" data-time-format='hh:ii:00' placeholder="Due Date">
                                    </div>
                                </div>
                                        
                                <!-- Instructor และ เนื้อหาของแต่ละsection -->
                                <div class="modal-section container">
                                    <!-- Process instrustor -->   
                                    <div class="form-line">
                                        Process deadline Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt accusamus minus quaerat obcaecati quas explicabo sit tenetur beatae quos sapiente, amet, eaque optio perferendis ipsum repudiandae, praesentium alias aspernatur debitis!
                                    </div>
                                    <!-- ส่วนของ Section แต่ละอัน -->
                                  
                                </div>
                                <!-- ปุ่มส่วนท้าย -->
                                <div class="form-model-template-button">
                                
                                    <button class="btn btn-green" type="submit">
                                        Start process
                                    </button>
                                    <button class="btn btn-normal" data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            <!-- Modal of btn-delete -->
            <div class="modal fade" id="Model-Deletebtn" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- ปุ่ม x -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- เนื้อหา -->
                        <div class="mt-2" style="display: flex;">
                            <div style="margin-right:24px;">
                                <i class="fas fa-exclamation-triangle" style="color: #F7DB31; font-size: 35px"></i>
                            </div>
                            <div>
                                <h3 class="text-f15">
                                    Template deletion confirmation
                                </h3>
                                <p class="text-f12" style="margin-top:12px;">
                                    Are you sure you want to delete selected template?
                                </p>
                                <div style="margin-top:12px;">
                                    <button class="btn btn-delete" style="margin-right:5px;">
                                        Delete
                                    </button>
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
        </header>
        <div class="createContentBox">
            <!-- Head -->
            <?php 
                $sql_template = "SELECT * FROM task WHERE tp_id ='$tp_id'";
                $sql_template_result = $conn->query($sql_template);
                $sql_template_count = $sql_template_result->num_rows;
            ?>
            <header class="content-head btn-setright tab-active box-left-right" id="head-bengin">
                <div class="box-left">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="btn btn-normal active" id="pills-Items-tab" data-toggle="pill" href="#pills-Items" role="tab" aria-controls="pills-Items" aria-selected="true">
                                <i class="fas fa-list"></i> <?php echo $sql_template_count; ?> <span class="tabHead-InTem">Items</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-normal" id="pills-Properties-tab" data-toggle="pill" href="#pills-Properties" role="tab" aria-controls="pills-Properties" aria-selected="false">
                                <i class="fas fa-cog"></i> <span class="tabHead-InTem">Properties</span>
                            </a>
                        </li>
                    </ul>
                </div>   
                <div class="box-right">
                    <div class="box-one box-UserCreate">
                        <div class="img-small box-right-img" style="background: #B8E17D;">
                            <p>O</p>
                        </div>
                        <div>
                            <p class="text-sub">Created on <?php echo $tp_datecreate ;?></p>
                            <p class="text-sub">by <span style="color:#222"><?php echo $tp_name_create.' '.$tp_lname_create; ?></span></p>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-normal" id="LeftSide-List" onclick="openRightSide()">
                            List
                        </button>
                        <button class="btn btn-normal" id="RightSide-Detail" onclick="openLeftSide()">
                            Details
                        </button>
                    </div>
                </div>        
            </header> 
        
            <!-- Body -->
            <div class="content-body-headTitle64" >
                <div id="pills-tabContent" class="tab-content">
                    <!-- Tab :: Item -->
                    <div class="tab-pane fade show active" id="pills-Items" role="tabpanel" aria-labelledby="pills-Items-tab">
                        <div class="box-two-side">
                            <!-- ซ้าย -->
                            <div class="box-left-side box-scroll" id="LeftSideBox-List" style="border-top: 1px solid#e1ebef;">
                                <div class="tab">
                                    <!-- process -->
                                    <button class="tablinks tab-button active" onclick="openItem(event, 'ProcessStart')" id="defaultOpen">
                                        <div class="icon-medium-size-f16" style="color:#a3a3a3b2 ;background: #d6f7d3; margin-right: 12px;">
                                            <i class="fas fa-play" style="color:#a3a3a3b2"></i>
                                        </div>
                                        <div class="text-f14" style="color: #222; align-self: center;">
                                            Process start task
                                        </div>
                                    </button>
                                    <!-- task -->
                                    <?php 
                                        while($template_result_query = mysqli_fetch_array($sql_template_result,MYSQLI_ASSOC)){
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
                                                <h4 class="text-f14" style="color: #222"><?php echo $task_title ;?></h4>
                                                <p class="text-f12" style="color: #222; margin-top:4px;">No assignees</p>
                                            </div>
                                        </div>
                                    </button>
                                    <?php } ?>
                             
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
                                                    <!-- Process title -->
                                                    <div class="file-box mt-3">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-heading text-success"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Process title</div>
                                                                <div class="text-sub"><?php echo $tp_title; ?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Process instructions -->
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-info-circle text-orange"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Process instructions</div>
                                                                <div class="text-sub"><?php echo $tp_instruc; ?></div>
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
                                <!-- Task -->
                                <?php 
                                    $sql_template_r = "SELECT * FROM task WHERE tp_id ='$tp_id'";
                                    $sql_template_result_r = $conn->query($sql_template_r);
                                    $sql_template_count_r = $sql_template_result_r->num_rows;
                                ?>
                                <?php 
                                    while($template_result_query_r = mysqli_fetch_array($sql_template_result_r,MYSQLI_ASSOC)){
                                        $task_id           = $template_result_query_r["task_id"];
                                        $task_title         = $template_result_query_r["task_title"];
                                        $task_description   = $template_result_query_r["task_description"];
                                ?>
                                <div id="task<?php echo $task_id; ?>" class="tabcontent">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-Task" role="tabpanel" aria-labelledby="v-pills-Task-tab">
                                            <!-- Header new task -->
                                            <header class="btn-setright">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="btn btn-normal active" id="pills-ProcessDetail-task-tab" data-toggle="pill" href="#pills-ProcessDetail-task" role="tab" aria-controls="pills-ProcessDetail-task" aria-selected="true">
                                                            <span>Task details</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </header>
                                            <div class="tab-content" id="pills-tabContent">
                                                <!-- task DETAIL -->
                                                <div class="tab-pane fade show active" id="pills-ProcessDetail-task" role="tabpanel" aria-labelledby="pills-ProcessDetail-task-tab">
                                                    <!-- Task title -->
                                                    <div class="file-box mt-3">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-heading text-success"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Task title</div>
                                                                <div class="text-sub"><?php echo $task_title; ?></div>
                                                            </div>
                                                            <div class="file-text-date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="file-box mt-2">
                                                        <div class="icon-medium-size-f20" style="background-color: #f5f5f5; color: #2e9df0; margin: 0 12px;">
                                                            <i class="fas fa-info-circle text-orange"></i>
                                                        </div>
                                                        <div class="file-text">
                                                            <div>
                                                                <div class="text-f14">Description</div>
                                                                <div class="text-sub"><?php if($task_description ==""){echo 'ไม่ได้ระบุ';}else{ echo $task_description;} ?></div>
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
                            </div>
                        </div>
                    </div>

                    <!-- Tab :: Properties -->
                    <div class="tab-pane fade" id="pills-Properties" role="tabpanel" aria-labelledby="pills-Properties-tab">
                        <div style="border: 1px solid #e1ebef; padding: 16px;">
                            <div class="properties-box">  
                                <label for="Template editors">Template editors</label>
                                <div class="properties-content">
                                    <div class="img-small" style="background: #B8E17D; margin-right: 4px;">
                                        <p>O</p>
                                    </div>
                                    <span><?php echo $tp_name_create.' '.$tp_lname_create; ?> </span>
                                </div> 
                            </div>
                            <div class="properties-box">  
                                <label for="Template editors">Description</label>
                                <div class="properties-content">
                                    <span><?php echo $tp_description; ?></span>
                                </div> 
                            </div>
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
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/form.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script type="text/javascript">
       $('.pj_process_start').datepicker({
            language: 'en',
            minDate: new Date() 
        })
        $('.pj_process_deadline').datepicker({
            language: 'en',
            minDate: new Date() 
        })
    </script>  
</body>
</html>