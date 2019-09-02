<?php
    error_reporting (E_ALL ^ E_NOTICE);
    include 'appsystem/inc_config.php';
    $selectddl = "";
    //   displayprofile
    $SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'";
    $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
    $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
    $acc_name       = $SQL_PROFILE_RESULT["acc_name"];
    $acc_lastname   = $SQL_PROFILE_RESULT["acc_lastname"];
    $acc_img        = $SQL_PROFILE_RESULT["acc_img"];
    $search_process = $_GET["search-process"];
 
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        
    <title>Processes</title>
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
            <span id="dropdown-username" style="margin-left: 8px"><?php echo $acc_name.' '.$acc_lastname ?></span>
        </div>

        <?php 
          $sql_noti = "SELECT * FROM project_assign_user WHERE pau_reply = '0' AND acc_id = '$ss_acc_id' AND pau_status ='N' ";
          $sql_acc_noti_result = $conn->query($sql_noti);
          $sql_acc_noti_count = $sql_acc_noti_result->num_rows;
        ?>
        <div class="dropdown mr-2">
            <a class="p-2 dropdown-toggle" href="#" id="navbarDropdowns" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php if($sql_acc_noti_count == 0){?>
                <i class="fas fa-bell f-18 "> </i>
                <?php } else { ?>
                <i class="fas fa-bell f-18 ">
                    <p class="noti-number"><?php echo $sql_acc_noti_count; ?></p>
                </i>
                <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdowns">
                <?php 
                    while($acc_result_noti = mysqli_fetch_array($sql_acc_noti_result,MYSQLI_ASSOC)){
                        $task_id_name = $acc_result_noti["pjt_id"];
                    

                        $SQL_Profile = "SELECT * FROM project_task WHERE pjt_id = '$task_id_name'  ";
                        $SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
                        $SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
                        $pj_name = $SQL_PROFILE_RESULT["pjt_title"];
                        $pj_id_name = $SQL_PROFILE_RESULT["pj_id"];


                        $SQL_Profiles = "SELECT * FROM project WHERE pj_id = '$pj_id_name'  ";
                        $SQL_PROFILE_QUERYs = mysqli_query($conn,$SQL_Profiles);
                        $SQL_PROFILE_RESULTs = mysqli_fetch_array($SQL_PROFILE_QUERYs,MYSQLI_ASSOC);
                        $saaa = $SQL_PROFILE_RESULTs["pj_process_title"];
                        $bbb  = $SQL_PROFILE_RESULTs["pj_user_ceate"];
                ?>

                <a class="dropdown-item" href="show-task-detail.php?pjt_id=<?php echo $task_id_name;?>">your task :
                    <?php echo $pj_name; ?>
                    <p class="mb-0">from project : <?php echo $saaa;?></p>
                    <p class="mb-0">assign by : <?php echo $bbb;?></p>
                    <div class="pt-2 d-flex">
                        <!-- <button class="btn btn-icon-link icon-edit mr-2" data-toggle="tooltip" data-placement="right" title="Click to Visit ProcessTask">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-icon-link icon-btn mr-2" data-toggle="tooltip" data-placement="right" title="Click to Reply to request ">
                            <i class="fas fa-check"></i>
                        </button> -->

                    </div>

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
    <div class="wrapper_main">
        <!-- ส่วนหัว -->
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="collapse navbar-collapse my-2 my-md-0 justify-content-end" id="navbarSupportedContent">
       
                <ul class="navbar-nav mr-auto">
                  
                    <?php if($ss_acc_permission == 0 || $ss_acc_permission == 1){?>
                    <li class="nav-item mt-0 mt-md-1">
                        <a  href="create-project.php">
                            <button class="btn btn-normal" role="button">
                                <i class="fas fa-play"></i><span id="Btnstartprocess-text"> Start process</span>
                            </button>
                        </a>
                    </li>
                <?php } ?>
                </ul>
                <form class="form-inline my-2 my-md-0" method="GET" action="process.php">
                    <input type="text" class="form-control form-control-sm mr-sm-2" name="search-process"
                        placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>

        <?php 
        //   select project all uncompleted
            if($search_process == ""){
                $sql_project_complete = "SELECT * FROM project WHERE pj_complete = 1 AND pj_status = 'N'";
            }
            else{
                $sql_project_complete = "SELECT * FROM project WHERE pj_process_title like '%$search_process%' AND pj_complete = 1 AND pj_status = 'N'";
            }
    
            $sql_project_complete_result = $conn->query($sql_project_complete);
            $sql_project_complete_count = $sql_project_complete_result->num_rows;
        
        ?>
        <div class="content-body-OnlyContentHead" style="margin-top:8px;">
            <div id="boxA">
                <?php if($ss_acc_permission == 0 || $ss_acc_permission == 1){?>
                <div class="process-title">Recently completed processes</div>
                <ul class="process">
                    <?php if($sql_project_complete_count == 0 ) { ?>
                    <p class="text-center py-3 mb-0 text-sub">not project competed</p>
                    <?php } else { ?>
                    <?php 
                    while($project_complete_result_query = mysqli_fetch_array($sql_project_complete_result,MYSQLI_ASSOC)){
                        $tp_id                  = $project_complete_result_query["tp_id"];
                        $pj_id                  = $project_complete_result_query["pj_id"];
                        $pj_process_title       = $project_complete_result_query["pj_process_title"];
                        $pj_process_start       = $project_complete_result_query["pj_process_start"];
                        $pj_process_deadline    = $project_complete_result_query["pj_process_deadline"];
                        $firstCharacter         = $pj_process_title[0];

                ?>
                    <li class="box-normal" >
                        <a class="box-normal-left" href="processdisplay.php?pj_id=<?php echo $pj_id ;?>" style="text-decoration:none!important;color:cadetblue;">
                            <div class="img-medium" style="background: #B8E17D">
                                <p><?php echo $firstCharacter; ?></p>
                            </div>
                            <div class="process-text-box">
                                <h3 class="text-f14">Project Name : <?php echo $pj_process_title; ?></h3>
                                <p class="text-sub"><span class="text-green">Completed </span> 20 hours ago</p>
                            </div>
                        </a>
                        <div class="dateBox-process">
                            <div class="img-small" style="background: #B8E17D;">
                                <p>O</p>
                            </div>
                        </div>
                    </li>
                    <?php } } ?>
                </ul>

                <?php 
                  
                     if($search_process == ""){
                        $sql_project = "SELECT * FROM project WHERE pj_complete = 0 AND pj_status = 'N'";
                     }
                     else{
                        $sql_project = "SELECT * FROM project WHERE pj_process_title like '%$search_process%' and pj_complete = 0 AND pj_status = 'N'";
                     }
                    $sql_project_result = $conn->query($sql_project);
                    $sql_project_count = $sql_project_result->num_rows;
                        
                ?>
                <div class="process-title">Project Name ( <?php echo $sql_project_count; ?> )</div>
                <ul class="process">
                    <?php if($sql_project_count == 0 ) { ?>
                    <p class="text-center py-3 mb-0 text-sub">Result of Process not Found.</p>
                    <?php 
                    } else {
                        while($project_result_query = mysqli_fetch_array($sql_project_result,MYSQLI_ASSOC)){
                        $tp_id                  = $project_result_query["tp_id"];
                        $pj_id                  = $project_result_query["pj_id"];
                        $pj_process_title       = $project_result_query["pj_process_title"];
                        $pj_process_start       = $project_result_query["pj_process_start"];
                        $pj_process_deadline    = $project_result_query["pj_process_deadline"];
                        $pj_user_ceate          = $project_result_query["pj_user_ceate"];
                        $firstCharacter         = $pj_process_title[0];

                        $SQL_TP = "SELECT * FROM template WHERE tp_id = '$tp_id'";
                        $SQL_TP_QUERY = mysqli_query($conn,$SQL_TP);
                        $SQL_TP_RESULT = mysqli_fetch_array($SQL_TP_QUERY,MYSQLI_ASSOC);
                        $tp_name = $SQL_TP_RESULT["tp_name"];

                        $SQL_task = "SELECT * FROM project_task WHERE pj_id = '$pj_id' AND pjt_status = 'N' ";
                        $SQL_TASK_QUERY = mysqli_query($conn,$SQL_task);
                        $sql_task_count = $SQL_TASK_QUERY->num_rows;
                        $SQL_TASK_RESULT = mysqli_fetch_array($SQL_TASK_QUERY,MYSQLI_ASSOC);    
                        // $task_title = $SQL_TASK_RESULT["task_title"];
                        $SQL_pf = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'";
                        $sql_pf_query = mysqli_query($conn,$SQL_pf);
                        $sql_pf_result = $sql_pf_query->num_rows;
                        $sql_pf_result_list = mysqli_fetch_array($sql_pf_query,MYSQLI_ASSOC);  
                        $sql_list_name  = $sql_pf_result_list["acc_name"];
                        $sql_list_lname  = $sql_pf_result_list["acc_lastname"];
                    ?>
                    <li class="box-normal border-gainsboro"  data-toggle="collapse" data-target="#demo<?php echo $pj_id;?>" style="background-color: #f8f9fa!important;">
                        <div class="box-normal-left" href="#"
                            style="text-decoration:none!important;color:cadetblue;">
                            <div class="img-medium" style="background: brown">
                                <i class="fas fa-tasks m-auto text-white"></i>
                            </div>
                            <div class="process-text-box">
                                <a href="processdisplay.php?pj_id=<?php echo $pj_id;?>"><h3 class="text-f14"><?php echo $pj_process_title; ?></h3></a>
                                <p class="text-sub">Created By : <?php echo $sql_list_name.' '.$sql_list_lname; ?></p>
                                <div style="display: flex;">
                                    <div class="progress" style="height: 5px; margin:8px 12px 0 0; flex:3;">
                                        <div class="progress-bar late-process" role="progressbar" style="width: 100%;background-color:<?php if($pj_complete == 0){echo 'gray';}else{echo'red';} ?>"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="text-sub"><span><?php echo $sql_task_count ;?></span> task</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right dateBox-process">
                            <p class="text-sub">Started : <?php echo $pj_process_start ;?></p>
                            <p class="text-sub">Due : <?php echo $pj_process_deadline ;?></p>
                        </div>
                    </li>
                    <!-- <div style="height: 1px;width: 80%;background-color: gainsboro;margin: auto;margin: 10px auto;"></div> -->
                    <div id="demo<?php echo $pj_id;?>" class="collapse show" style="border-bottom: 1px solid gainsboro;margin-bottom: 10px;">
                        <ul class="process in_cls p-0">
                            <?php 
                                if($search_process == ""){
                                    $sql_task_cls = "SELECT * FROM project_task WHERE  pjt_status = 'N' AND pj_id = '$pj_id' ";
                                }
                                else{
                                    $sql_task_cls = "SELECT * FROM project_task WHERE pjt_title like '%$search_process%'  AND pjt_status = 'N'";
                                }
                                $sql_task_cls_result = $conn->query($sql_task_cls);
                                $sql_task_cls_count = $sql_task_cls_result->num_rows;
                                while($sql_task_cls_result_query = mysqli_fetch_array($sql_task_cls_result,MYSQLI_ASSOC)){
                                    $pjt_id           =    $sql_task_cls_result_query["pjt_id"];
                                    $pjt_title        =    $sql_task_cls_result_query["pjt_title"];
                                    $pjt_starteddate  =    $sql_task_cls_result_query["pjt_starteddate"];
                                    $pjt_duedate      =    $sql_task_cls_result_query["pjt_duedate"];
                                    $firstCharacter         = $pjt_title[0];
                            ?>
                            <li class="box-normal pl-50">
                                <a class="box-normal-left py-2" href="show-task-detail.php?pjt_id=<?php echo $pjt_id; ?>"
                                    style="text-decoration:none!important;color:cadetblue;">
                                    <div class="img-medium" style="background: #00a02b">
                                        <p><?php echo $firstCharacter;?></p>
                                    </div>
                                    <div class="process-text-box">
                                        <h3 class="text-f14">Task Name : <?php echo $pjt_title; ?></h3>
                                        <div style="display: flex;width: 300px;">
                                            <div class="progress" style="height: 5px; margin:8px 12px 0 0; flex:3;">
                                                <div class="progress-bar late-process" role="progressbar" style="width: 100%;background-color:<?php if($pj_complete == 0){echo 'gray';}else{echo'red';} ?>"
                                                    aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-right dateBox-process">
                                    <p class="text-sub">Started : <?php echo $pjt_starteddate ;?></p>
                                    <p class="text-sub">Due : <?php echo $pjt_duedate ;?></p>
                               
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php }} ?>
                </ul>
                <?php }  
                ?>
                <?php if($ss_acc_permission == 2 ){

                    if($search_process == ""){
                        $sql_user_show_pj = "SELECT * FROM vw_for_search WHERE acc_id = $ss_acc_id AND pau_status = 'N' GROUP BY pj_id";
                    } else {
                        $sql_user_show_pj = "SELECT * FROM vw_for_search WHERE pj_process_title like '%$search_process%' and pj_complete = 0 AND pau_status = 'N' GROUP BY pj_id";
                    }
                        $sql_user_show_pj_result = $conn->query($sql_user_show_pj);
                        $sql_user_show_pj_count = $sql_user_show_pj_result->num_rows;
                    

                ?>
                <div class="process-title">Project Name ( <?php echo $sql_user_show_pj_count; ?> )</div>
                <ul class="process">
                    <?php if($sql_user_show_pj_count == 0 ) { ?>
                    <p class="text-center py-3 mb-0 text-sub">Result of Process not Found.</p>
                    <?php 
                    } else {
                        while($sql_user_show_pj_result_query = mysqli_fetch_array($sql_user_show_pj_result,MYSQLI_ASSOC)){
                            $pj_id              = $sql_user_show_pj_result_query["pj_id"];
                            $pj_process_title   = $sql_user_show_pj_result_query["pj_process_title"];

                            $SQL_TP = "SELECT * FROM project WHERE pj_id = '$pj_id'";
                            $SQL_TP_QUERY = mysqli_query($conn,$SQL_TP);
                            $SQL_TP_RESULT = mysqli_fetch_array($SQL_TP_QUERY,MYSQLI_ASSOC);
                            $pj_process_start       = $SQL_TP_RESULT["pj_process_start"];
                            $pj_process_deadline    = $SQL_TP_RESULT["pj_process_deadline"];
                            $pj_user_ceate          = $SQL_TP_RESULT["pj_user_ceate"];

                            $SQL_acc = "SELECT * FROM account WHERE acc_id = '$pj_user_ceate'";
                            $SQL_acc_QUERY = mysqli_query($conn,$SQL_acc);
                            $SQL_acc_RESULT = mysqli_fetch_array($SQL_acc_QUERY,MYSQLI_ASSOC);
                            $acc_name       = $SQL_acc_RESULT["acc_name"];
                            $acc_lname      = $SQL_acc_RESULT["acc_lastname"];
                 
                    ?>
                    <li class="box-normal border-gainsboro"  data-toggle="collapse" data-target="#demo<?php echo $pj_id;?>" style="background-color: #f8f9fa!important;">
                        <div class="box-normal-left" href="#"
                            style="text-decoration:none!important;color:cadetblue;">
                            <div class="img-medium" style="background: brown">
                                <i class="fas fa-tasks m-auto text-white"></i>
                            </div>
                            <div class="process-text-box">
                                <a href="processdisplay.php?pj_id=<?php echo $pj_id;?>"><h3 class="text-f14"><?php echo $pj_process_title; ?></h3></a>
                                <p class="text-sub">Created By : <?php echo $acc_name.' '.$acc_lname; ?></p>
                         
                            </div>
                          
                        </div>
                        
                        <div class="text-right dateBox-process">
                            <p class="text-sub">Started : <?php echo $pj_process_start ;?></p>
                            <p class="text-sub">Due : <?php echo $pj_process_deadline ;?></p>
                        </div>
                        
                    </li>
                    <!-- <div style="height: 1px;width: 80%;background-color: gainsboro;margin: auto;margin: 10px auto;"></div> -->
                    <div id="demo<?php echo $pj_id;?>" class="collapse show" style="border-bottom: 1px solid gainsboro;margin-bottom: 10px;">
                        <ul class="process in_cls p-0">
                            <?php 
                                     $sql_user_show_pjt = "SELECT * FROM vw_assign_taskname WHERE pj_id = $pj_id AND pau_status = 'N' AND acc_id = $ss_acc_id";
                                     $sql_user_show_pjt_result = $conn->query($sql_user_show_pjt);
                                     $sql_user_show_pjt_count = $sql_user_show_pjt_result->num_rows;
                                     while($sql_user_show_pjt_result_query = mysqli_fetch_array($sql_user_show_pjt_result,MYSQLI_ASSOC)){
                                        $pjt_id             = $sql_user_show_pjt_result_query["pjt_id"];
                                        $pjt_title          = $sql_user_show_pjt_result_query["pjt_title"];
                                        $pjt_starteddate    = $sql_user_show_pjt_result_query["pjt_starteddate"];
                                        $pjt_duedate        = $sql_user_show_pjt_result_query["pjt_duedate"];
                            ?>
                            <li class="box-normal pl-50">
                                <a class="box-normal-left py-2" href="show-task-detail.php?pjt_id=<?php echo $pjt_id; ?>"
                                    style="text-decoration:none!important;color:cadetblue;">
                                    <div class="img-medium" style="background: #00a02b">
                                        <p><?php echo $firstCharacter;?></p>
                                    </div>
                                    <div class="process-text-box">
                                        <h3 class="text-f14">Task Name : <?php echo $pjt_title; ?></h3>
                                    </div>
                                </a>
                                <div class="text-right dateBox-process">
                                    <p class="text-sub">Started : <?php echo $pjt_starteddate ;?></p>
                                    <p class="text-sub">Due : <?php echo $pjt_duedate ;?></p>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php }} } ?>
                </ul>
                   
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script src="assets/js/select.js"></script> -->
    <script src="assets/js/Dropdown.js"></script>
    <script>src="node_modules/air-datepicker/dist/js/datepicker.min.js"</script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/js/checkbox.js"></script>
    <script src="assets/js/fieldstep.js"></script>
    <script src="assets/js/validatemodal.js"></script>
    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>

</html>