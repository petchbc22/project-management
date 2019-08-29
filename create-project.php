<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <script src="assets/js/sweetalert2@8.js"></script>
    <link rel="stylesheet" href="assets/css/jquery-ui.css" rel="stylesheet">
</head>
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

<body id="create-project">
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
    <div class="wrapper_main">
        <!-- ส่วนหัว -->
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="collapse navbar-collapse my-2 my-md-0 justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if($ss_acc_permission == 0 || $ss_acc_permission == 1){ ?>
                    <li class="nav-item mt-0 mt-md-1">
                        <button class="btn btn-normal" data-toggle="modal" data-target="#Model-add-task">
                            <i class="fas fa-plus"></i><span id="Btnstartprocess-text"> Add Default Task</span>
                        </button>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <div class="top-content">
            <div class="container">
                <div class="row justify-content-center ">
                    <div class="col-lg-10 form-box">
                        <form role="form" action="show.php" method="post"
                            class="text-center p-4 text-center p-4 shadow-sm p-3 mb-5 bg-white rounded" id="myform">
                            <h3>ระบุข้อมูล Production ที่คุณต้องการ</h3>
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line w-16" data-number-of-steps="3"></div>
                                </div>
                                <div class="f1-step info active">
                                    <div class="f1-step-icon"><i class="fas fa-file-invoice"></i></div>
                                    <p>Create Project</p>
                                </div>
                                <div class="f1-step pre-pro">
                                    <div class="f1-step-icon"><i class="fas fa-file-contract"></i></div>
                                    <p>Pre-Production</p>
                                </div>
                                <div class="f1-step pro">
                                    <div class="f1-step-icon"><i class="fas fa-file-video"></i></div>
                                    <p>Production</p>
                                </div>
                                <div class="f1-step post-pro">
                                    <div class="f1-step-icon"><i class="fas fa-film"></i></div>
                                    <p>Post Production</p>
                                </div>
                            </div>
                            <fieldset id="info" class="">
                                <div class="form-group text-left">
                                    <label class="pt-2">Name Project</label>
                                    <input type="text" class="form-control bd-rd30" id="pj_name" name="pj_name"
                                        placeholder="Name Project">
                                </div>
                                <div class="form-group text-left">
                                    <label class="pt-2">Name Customer</label>
                                    <input type="text" class="form-control bd-rd30" id="pj_customer" name="pj_customer"
                                        placeholder="Name Customer">
                                </div>
                                <div class="form-group text-left">
                                    <label class="pt-2">Start Date</label>
                                    <input type="text" autocomplete="off"
                                        class="dateStart form-control form-control-sm w-100 bd-rd30 h-38"
                                        id="pj_process_start" name="pj_process_start" placeholder="Start date">
                                </div>
                                <div class="form-group text-left">
                                    <label class="pt-2">Due Date</label>
                                    <input type="text" autocomplete="off"
                                        class="dateEnd form-control form-control-sm w-100 bd-rd30 h-38"
                                        id="pj_duedate" name="pj_duedate" placeholder="Due date">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-orn w-100px next">Next</button>
                                </div>
                            </fieldset>
                            <fieldset id="pre_production" class="">
                                <div class="form-group text-left">
                                    <?php 
                                    $sql_pre = "SELECT * FROM  task_detail_fixed WHERE pt_id = '1' ";
                                    $sql_pre_result = $conn->query($sql_pre);
                                    $sql_pre_count = $sql_pre_result->num_rows;
                                    while($sql_pre_result_query = mysqli_fetch_array($sql_pre_result,MYSQLI_ASSOC)){
                                        $tdf_id            = $sql_pre_result_query["tdf_id"];
                                        $tdf_name          = $sql_pre_result_query["tdf_name"];
                                        $tdf_element       = $sql_pre_result_query["tdf_element"];
                                ?>
                                    <div class="inputGroup">
                                        <input id="<?php echo $tdf_element; ?>" name="<?php echo $tdf_element; ?>"
                                            type="checkbox" value="<?php echo $tdf_id ;?>"/>
                                        <label for="<?php echo $tdf_element; ?>"><?php echo $tdf_name; ?></label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-orn w-100px previous">Previous</button>
                                    <button type="button" class="btn btn-orn w-100px next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset id="production" class="">
                                <div class="form-group">
                                    <?php 
                                    $sql_pro = "SELECT * FROM  task_detail_fixed WHERE pt_id = '2' ";
                                    $sql_pro_result = $conn->query($sql_pro);
                                    $sql_pro_count = $sql_pro_result->num_rows;
                                    while($sql_pro_result_query = mysqli_fetch_array($sql_pro_result,MYSQLI_ASSOC)){
                                        $tdf_name          = $sql_pro_result_query["tdf_name"];
                                        $tdf_element       = $sql_pro_result_query["tdf_element"];
                                ?>
                                    <div class="inputGroup">
                                        <input id="<?php echo $tdf_element; ?>" name="<?php echo $tdf_element; ?>"
                                            type="checkbox" />
                                        <label for="<?php echo $tdf_element; ?>"><?php echo $tdf_name; ?></label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-orn w-100px previous">Previous</button>
                                    <button type="button" class="btn btn-orn w-100px next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset id="post_production" class="">
                                <div class="form-group">
                                    <?php 
                                        $sql_post = "SELECT * FROM  task_detail_fixed WHERE pt_id = '3' ";
                                        $sql_post_result = $conn->query($sql_post);
                                        $sql_post_count = $sql_post_result->num_rows;
                                        while($sql_post_result_query = mysqli_fetch_array($sql_post_result,MYSQLI_ASSOC)){
                                            $tdf_name          = $sql_post_result_query["tdf_name"];
                                            $tdf_element       = $sql_post_result_query["tdf_element"];
                                    ?>
                                    <div class="inputGroup">
                                        <input id="<?php echo $tdf_element; ?>" name="<?php echo $tdf_element; ?>"
                                            type="checkbox" />
                                        <label for="<?php echo $tdf_element; ?>"><?php echo $tdf_name; ?></label>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-orn w-100px previous">Previous</button>
                                    <button type="button" class="btn btn-orn w-100px" id="submit-val"
                                        data-toggle="modal" data-target="#exampleModal">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- pre prodution -->

                                        <label class="w-100 text-left font-weight-bold">Info Project</label>
                                        <div
                                            class="form-group text-left border-gainsboro padding-custom-for-header-cls">
                                            <div class="d-flex">
                                                <div class="w-40">
                                                    <label for="exampleInputEmail1 mb-0">Project Name</label>
                                                </div>
                                                <div class="w-10">:</div>
                                                <div class="w-50 pr-2 pb-2">
                                                    <input type="text" class="form-control-sm name_project_val w-100"
                                                        name="pj_name" id="pj_name" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="w-40">
                                                    <label for=" mb-0">Customer Name</label>
                                                </div>
                                                <div class="w-10">:</div>
                                                <div class="w-50 pr-2 pb-2">
                                                    <input type="text" class="form-control-sm pj_customer_val w-100"
                                                        name="pj_customer" id="pj_customer" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="w-40">
                                                    <label for="exampleInputEmail1 mb-0">Start Date</label>
                                                </div>
                                                <div class="w-10">:</div>
                                                <div class="w-50 pr-2">
                                                    <input type="text" class="form-control-sm pj_process_start_val  w-100"
                                                        name="pj_process_start" id="pj_process_start" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="w-40">
                                                    <label for="exampleInputEmail1 mb-0">Due Date</label>
                                                </div>
                                                <div class="w-10">:</div>
                                                <div class="w-50 pr-2">
                                                    <input type="text" class="form-control-sm due_date_val  w-100"
                                                        name="pj_duedate" id="pj_duedate" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="w-100 text-left font-weight-bold">Pre Production</label>
                                        <div class="form-group text-left border-gainsboro">
                                            <?php 
                                                $sql_pre_collapse = "SELECT * FROM  task_detail_fixed WHERE pt_id = '1' ";
                                                $sql_pre_collapse_result = $conn->query($sql_pre_collapse);
                                                $sql_pre_collapse_count = $sql_pre_collapse_result->num_rows;
                                                while($sql_pre_collapse_result_query = mysqli_fetch_array($sql_pre_collapse_result,MYSQLI_ASSOC)){
                                                    $tdf_name          = $sql_pre_collapse_result_query["tdf_name"];
                                                    $tdf_element       = $sql_pre_collapse_result_query["tdf_element"];
                                            ?>
                                            <div class="padding-custom-for-header-cls bg-gainsboro margin-custom-for-header-cls"
                                                data-toggle="collapse" data-target="#<?php echo $tdf_element; ?>_cls"
                                                id="main_<?php echo $tdf_element; ?>">
                                                <div class="d-flex">
                                                    <div class="w-40">
                                                        <label
                                                            for="exampleInputEmail1 mb-0"><?php echo $tdf_name; ?></label>
                                                    </div>
                                                    <div class="w-10">:</div>
                                                    <div class="w-50">
                                                        <p class="<?php echo $tdf_element.'_val'; ?> mb-0"><i
                                                                class="fas fa-exclamation text-danger"></i></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="<?php echo $tdf_element; ?>_cls" class="collapse cls">
                                                <input type="hidden" id="js_task_name">
                                                <input type="hidden" id="js_pt_id" value="1">
                                                <label class="w-100 text-left">Dead Line</label>
                                                <input type="text" autocomplete="off"
                                                    class="dateEnd_<?php echo $tdf_element;?> form-control form-control-sm w-100 bd-rd30"
                                                    placeholder="Due date" name="task_duedatex">
                                                <label class="w-100 text-left">Detail</label>
                                                <textarea cols="30" rows="10" class="form-control"
                                                    id="js_task_detail"></textarea>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <!-- production -->
                                        <label class="w-100 text-left font-weight-bold">Production</label>
                                        <div class="form-group text-left border-gainsboro">
                                            <?php 
                                                $sql_pre_collapse = "SELECT * FROM  task_detail_fixed WHERE pt_id = '2' ";
                                                $sql_pre_collapse_result = $conn->query($sql_pre_collapse);
                                                $sql_pre_collapse_count = $sql_pre_collapse_result->num_rows;
                                                while($sql_pre_collapse_result_query = mysqli_fetch_array($sql_pre_collapse_result,MYSQLI_ASSOC)){
                                                    $tdf_name          = $sql_pre_collapse_result_query["tdf_name"];
                                                    $tdf_element       = $sql_pre_collapse_result_query["tdf_element"];
                                            ?>
                                            <div class="padding-custom-for-header-cls bg-gainsboro margin-custom-for-header-cls"
                                                data-toggle="collapse" data-target="#<?php echo $tdf_element; ?>_cls"
                                                id="main_<?php echo $tdf_element; ?>">
                                                <div class="d-flex">
                                                    <div class="w-40">
                                                        <label
                                                            for="exampleInputEmail1 mb-0"><?php echo $tdf_name; ?></label>
                                                    </div>
                                                    <div class="w-10">:</div>
                                                    <div class="w-50">
                                                        <p class="<?php echo $tdf_element.'_val'; ?> mb-0"><i
                                                                class="fas fa-times text-danger"></i></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="<?php echo $tdf_element; ?>_cls" class="collapse cls">
                                                <input type="hidden" id="js_task_name">
                                                <input type="hidden" id="js_pt_id" value="2">
                                                <label class="w-100 text-left">Dead Line</label>
                                                <!-- <input type="date" class="form-control" id="js_task_duedate"> -->
                                                <input type="text" autocomplete="off"
                                                    class="dateEnd_<?php echo $tdf_element;?> form-control form-control-sm w-100 bd-rd30"
                                                     placeholder="Due date" name="task_duedatex">
                                                <label class="w-100 text-left">Detail</label>
                                                <textarea cols="30" rows="10" class="form-control"
                                                    id="js_task_detail"></textarea>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <!-- post production -->
                                        <label class="w-100 text-left font-weight-bold">Post Production</label>
                                        <div class="form-group text-left border-gainsboro">
                                            <?php 
                                                $sql_pre_collapse = "SELECT * FROM  task_detail_fixed WHERE pt_id = '3' ";
                                                $sql_pre_collapse_result = $conn->query($sql_pre_collapse);
                                                $sql_pre_collapse_count = $sql_pre_collapse_result->num_rows;
                                                while($sql_pre_collapse_result_query = mysqli_fetch_array($sql_pre_collapse_result,MYSQLI_ASSOC)){
                                                    $tdf_name          = $sql_pre_collapse_result_query["tdf_name"];
                                                    $tdf_element       = $sql_pre_collapse_result_query["tdf_element"];
                                            ?>
                                            <div class="padding-custom-for-header-cls bg-gainsboro margin-custom-for-header-cls"
                                                data-toggle="collapse" data-target="#<?php echo $tdf_element; ?>_cls"
                                                id="main_<?php echo $tdf_element; ?>">
                                                <div class="d-flex">
                                                    <div class="w-40">
                                                        <label
                                                            for="exampleInputEmail1 mb-0"><?php echo $tdf_name; ?></label>
                                                    </div>
                                                    <div class="w-10">:</div>
                                                    <div class="w-50">
                                                        <p class="<?php echo $tdf_element.'_val'; ?> mb-0"><i
                                                                class="fas fa-times text-danger"></i></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="<?php echo $tdf_element; ?>_cls" class="collapse cls">
                                                <input type="hidden" id="js_task_name">
                                                <input type="hidden" id="js_pt_id" value="3">
                                                <label class="w-100 text-left">Dead Line</label>
                                                <!-- <input type="date" class="form-control" id="js_task_duedate"> -->
                                                <input type="text" autocomplete="off"
                                                    class="dateEnd_<?php echo $tdf_element; ?> form-control form-control-sm w-100 bd-rd30"
                                                     placeholder="Due date" name="task_duedatex">
                                                <label class="w-100 text-left">Detail</label>
                                                <textarea cols="30" rows="10" class="form-control"
                                                    id="js_task_detail"></textarea>
                                            </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="save-ajax">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- modal delete user -->
        <div class="modal fade" id="Model-add-task" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <!-- ปุ่ม x -->
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <!-- เนื้อหา -->
                        <div class="mt-2" style="display: flex;">
                            <div class="w-100">
                                <h3 class="text-f15 font-weight-bold text-center">
                                    <?php echo $tp_name; ?> Add task and type task fixed
                                </h3>
                                <div style="margin-top:12px;">
                                    <form id="form-type-save" class="wrapper">
                                        <div class="bd-element-clone">
                                            <div class="element pb-2 dpn">
                                                <div class="form-group">
                                                    <label class="text-f14">Type of task</label>
                                                    <select class="form-control" id="pt_id_md" name="pt_id_md[]">
                                                        <option selected="true" disabled="disabled">Choose type Task
                                                        </option>
                                                        <?php 
                                                            $sql_typetask = "SELECT * FROM  production_type";
                                                            $sql_typetask_result = $conn->query($sql_typetask);
                                                            $sql_typetask_count = $sql_typetask_result->num_rows;
                                                            while($sql_typetask_result_query = mysqli_fetch_array($sql_typetask_result,MYSQLI_ASSOC)){
                                                                $pt_id                  = $sql_typetask_result_query["pt_id"];
                                                                $production_type_name   = $sql_typetask_result_query["production_type_name"];
                                                        ?>

                                                        <option value="<?php echo $pt_id;?>">
                                                            <?php echo $production_type_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-f14" id>Name of Task</label>
                                                    <input type="text" class="form-control" id="tdf_name_md"
                                                        name="tdf_name_md[]" placeholder="name of task">
                                                </div>
                                                <hr class="mb-0 w-50">
                                            </div>
                                            <div class="element pb-2">
                                                <div class="form-group">
                                                    <label class="text-f14">Type of task</label>
                                                    <select class="form-control" id="pt_id_md" name="pt_id_md[]">
                                                        <option selected="true" disabled="disabled">Choose type Task
                                                        </option>
                                                        <?php 
                                                            $sql_typetask = "SELECT * FROM  production_type";
                                                            $sql_typetask_result = $conn->query($sql_typetask);
                                                            $sql_typetask_count = $sql_typetask_result->num_rows;
                                                            while($sql_typetask_result_query = mysqli_fetch_array($sql_typetask_result,MYSQLI_ASSOC)){
                                                                $pt_id                  = $sql_typetask_result_query["pt_id"];
                                                                $production_type_name   = $sql_typetask_result_query["production_type_name"];
                                                        ?>

                                                        <option value="<?php echo $pt_id;?>">
                                                            <?php echo $production_type_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="text-f14" id>Name of Task</label>
                                                    <input type="text" class="form-control" id="tdf_name_md"
                                                        name="tdf_name_md[]" placeholder="name of task">
                                                </div>
                                                <hr class="mb-0 w-50">
                                            </div>
                                            <div class="results"></div>
                                        </div>
                                        <div class="buttons">
                                        </div>
                                        <div class="text-center pt-3">
                                            <button class="btn btn-blue clone" type="button">clone</button>
                                            <button class="btn btn-orn remove" type="button">remove</button>
                                            <button class="btn btn-green" style="margin-right:5px;" type="button"
                                                id="save-type">
                                                Save
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
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/retina-1.1.0.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="assets/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/fieldstep.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    
    <script type="text/javascript">
    $('#top-navbar-1').on('shown.bs.collapse', function() {
        $.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function() {
        $.backstretch("resize");
    });
    $('#save-ajax').click(function() {

        var pj_name = $('#pj_name').val();
        var pj_duedate = $('#pj_duedate').val();
        var pj_customer = $("#pj_customer").val();
        var pj_process_start = $("#pj_process_start").val(); 
        var task_name = [];
        var pt_id = [];
        var task_duedate = [];
        var task_detail = [];

        $(":input[name='pt_id[]']").each(function() {
            pt_id.push($(this).val());
        });
        $(":input[name='task_name[]']").each(function() {
            task_name.push($(this).val());
        });
        $(":input[name='task_duedate[]']").each(function() {
            task_duedate.push($(this).val());
        });
        $(":input[name='task_detail[]']").each(function() {
            task_detail.push($(this).val());
        });
        $.ajax({
            url: "service/save-project.php",
            method: "POST",
            data: {
                pj_name: pj_name,
                pj_customer:pj_customer,
                pj_process_start:pj_process_start,
                pj_duedate: pj_duedate,
                task_name: task_name,
                pt_id: pt_id,
                task_duedate: task_duedate,
                task_detail: task_detail
            },
            success: function(data) {
                // ขื่อเืท
                if (data == 1) {
                    setTimeout(function() {
                        swal({
                            title: "เพิ่มโปรเจคสำเร็จ !",
                            type: "success"
                        }).then(function() {
                            window.location = "process.php";
                        });
                    }, 300);
                } else {
                    alert(data);
                }
            }
        });
    });
    if ($("#create-project").length) {
        $('.navbar-nav').children().eq(1).addClass("active");
    }
    $('.wrapper').on('click', '.remove', function() {
        $('.remove').closest('.wrapper').find('.element').not(':first').last().remove();
    });
    $('.wrapper').on('click', '.clone', function() {
        $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results');
        $(".results").children().removeClass("dpn");
    });
    $("#save-type").click(function() {
        // change attr เพื่อไม่ให้มันลง ajax
        $('.wrapper').children().eq(0).children().eq(0).children().eq(0).children().eq(1).attr("id", "");
        $('.wrapper').children().eq(0).children().eq(0).children().eq(0).children().eq(1).attr("name", "");
        $('.wrapper').children().eq(0).children().eq(0).children().eq(1).children().eq(1).attr("id", "");
        $('.wrapper').children().eq(0).children().eq(0).children().eq(1).children().eq(1).attr("name", "");
        var pt_id_md = [];
        var tdf_name_md = [];
        $(":input[name='pt_id_md[]']").each(function() {
            pt_id_md.push($(this).val());
        });
        $(":input[name='tdf_name_md[]']").each(function() {
            tdf_name_md.push($(this).val());
        });
        $.ajax({
            url: "service/save-task-detail-fixed.php",
            method: "POST",
            data: {
                pt_id_md: pt_id_md,
                tdf_name_md: tdf_name_md
            },
            success: function(data) {
                if (data == 1) {
                    setTimeout(function() {
                        swal({
                            title: "เพิ่มงานสำเร็จ !",
                            type: "success"
                        });
                    }, 300);
                } else {
                    alert(data);
                }
            }
        });
    });
        // ตัวแปรจาก fieldset แรก กำหนด วันเริ่มและเสร็จของโปรเจค
        var startDateTextBox    = $('.dateStart');
        var endDateTextBox      = $('.dateEnd');
        $(function() {           
        // loop datepicker 
            <?php
                $sql_datepicker_js = "SELECT * FROM  task_detail_fixed";
                $sql_datepicker_js_result = $conn->query($sql_datepicker_js);
                while ($sql_datepicker_js_query = mysqli_fetch_array($sql_datepicker_js_result,MYSQLI_ASSOC)) {
                    $tdf_name       = $sql_datepicker_js_query["tdf_name"];
                    $tdf_element    = $sql_datepicker_js_query["tdf_element"]; 
            ?>
            $(".dateEnd_<?php echo $tdf_element;?>" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat : 'yy-mm-dd',
                minDate: setMinDate(),
            });
            <?php } ?>
        });
        // ดึงค่า start project เป็น default
        function setMinDate() {
        var string = $(".dateStart").val();
        return new Date(string);
        }
    $('#submit-val').click(function() {
        // ก้อนนี้ รัน duedate ของ task ให้ยึดค่าตามวันเริ่มโปรเจค
        <?php
            $sql_pre_class_js = "SELECT * FROM  task_detail_fixed";
            $sql_pre_class_js_result = $conn->query($sql_pre_class_js);
            while ($sql_pre_class_js_result_query = mysqli_fetch_array($sql_pre_class_js_result,MYSQLI_ASSOC)) {
                $tdf_name       = $sql_pre_class_js_result_query["tdf_name"];
                $tdf_element    = $sql_pre_class_js_result_query["tdf_element"]; 
        ?>
        $('.dateEnd_<?php echo $tdf_element;?>').datepicker('option', {
            minDate: setMinDate(),
        });
        <?php } ?>
        // for project info
        var name_project = $('#pj_name').val();
        var due_date = $('#pj_duedate').val();
        var pj_process_start = $("#pj_process_start").val();
        var pj_customer = $("#pj_customer").val();
        $('.name_project_val').val(name_project);
        $('.due_date_val').val(due_date); 
        $('.pj_process_start_val').val(pj_process_start); 
        $('.pj_customer_val').val(pj_customer); 
            <?php
                $sql_pre_collapse_js = "SELECT * FROM  task_detail_fixed";
                $sql_pre_collapse_js_result = $conn->query($sql_pre_collapse_js);
                while ($sql_pre_collapse_js_result_query = mysqli_fetch_array($sql_pre_collapse_js_result,MYSQLI_ASSOC)) {
                    $tdf_name = $sql_pre_collapse_js_result_query["tdf_name"];
                    $tdf_element = $sql_pre_collapse_js_result_query["tdf_element"]; 
            ?>
            // loop ตัวเมนู checkbox ให้แสดงผลใน modal
            if ($('#<?php echo $tdf_element;?>').prop("checked") == true) {
                $("#main_<?php echo $tdf_element;?>").removeClass('d-none');
                // เตรียมส่งค่าเข้า ajax ไป insert sql
                $("#<?php echo $tdf_element;?>_cls #js_pt_id").attr('id', 'pt_id');
                $("#<?php echo $tdf_element;?>_cls #pt_id").attr('name', 'pt_id[]');
                // task_name 
                $("#<?php echo $tdf_element;?>_cls #js_task_name").attr('id', 'task_name');
                $("#<?php echo $tdf_element;?>_cls #task_name").attr('name', 'task_name[]');
                $("#<?php echo $tdf_element;?>_cls #task_name").val('<?php echo $tdf_name;?>');
                // task_duedate
                $("#<?php echo $tdf_element;?>_cls #js_task_duedate").attr('id', 'task_duedate');
                $("#<?php echo $tdf_element;?>_cls .dateEnd_<?php echo $tdf_element;?>").attr('name', 'task_duedate[]');
                // task_detail
                $("#<?php echo $tdf_element;?>_cls #js_task_detail").attr('id', 'task_detail');
                $("#<?php echo $tdf_element;?>_cls #task_detail").attr('name', 'task_detail[]');

            }
            if ($('#<?php echo $tdf_element;?>').prop("checked") == false) {
                $("#main_<?php echo $tdf_element;?>").addClass('d-none');
                // hide cls if expand 
                $("#<?php echo $tdf_element;?>_cls").removeClass("show");
                // taskname
                $("#<?php echo $tdf_element;?>_cls #task_name").attr('id', 'js_task_name');
                $("#<?php echo $tdf_element;?>_cls #js_task_name").attr('name', 'js_task_name');
                // ptid
                $("#<?php echo $tdf_element;?>_cls #pt_id").attr('id', 'js_pt_id');
                $("#<?php echo $tdf_element;?>_cls #js_pt_id").attr('name', 'js_pt_id');
                // taskduedate
                $("#<?php echo $tdf_element;?>_cls #task_duedate").attr('id', 'js_task_duedate');
                $("#<?php echo $tdf_element;?>_cls .dateEnd_<?php echo $tdf_element;?>").attr('name', 'js_task_duedate');
                // taskdetail
                $("#<?php echo $tdf_element;?>_cls #task_detail").attr('id', 'js_task_detail');
                $("#<?php echo $tdf_element;?>_cls #js_task_detail").attr('name', 'js_task_detail');
            } 
            <?php } ?>
    });
    // function การตั้งค่าให้ วันสิ้นสุด ไม่สามารถเลือกวันก่อนวันเริ่มต้นได้ 
        startDateTextBox.datepicker({ 
            dateFormat: 'yy-mm-dd',
            onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datepicker('getDate');
                    var testEndDate = endDateTextBox.datepicker('getDate');
                    if (testStartDate > testEndDate)
                        endDateTextBox.datepicker('setDate', testStartDate);
                }
                else {
                    endDateTextBox.val(dateText);
                }
            },
            onSelect: function (selectedDateTime){
                endDateTextBox.datepicker('option', 'minDate', startDateTextBox.datepicker('getDate') );
            }
        });
        endDateTextBox.datepicker({ 
            dateFormat: 'yy-mm-dd',
            onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                    var testStartDate = startDateTextBox.datepicker('getDate');
                    var testEndDate = endDateTextBox.datepicker('getDate');
                    if (testStartDate > testEndDate)
                        startDateTextBox.datepicker('setDate', testEndDate);
                }
                else {
                    startDateTextBox.val(dateText);
                }
            },
            onSelect: function (selectedDateTime){
                startDateTextBox.datepicker('option', 'maxDate', endDateTextBox.datepicker('getDate') );
            }
        });
    </script>
  
    <script>
    //  function เช็ค ถ้ากรอกไม่ครบจะขึ้น x กรอกครบจะขึ้น check 
    $(function() { 
        <?php
        $sql_pre_collapse_vlmd = "SELECT * FROM  task_detail_fixed";
        $sql_pre_collapse_vlmd_result = $conn -> query($sql_pre_collapse_vlmd);
        while ($sql_pre_collapse_vlmd_result_query = mysqli_fetch_array($sql_pre_collapse_vlmd_result,MYSQLI_ASSOC)) {
            $tdf_name = $sql_pre_collapse_vlmd_result_query["tdf_name"];
            $tdf_element = $sql_pre_collapse_vlmd_result_query["tdf_element"]; 
            ?>
            $('#<?php echo $tdf_element;?>_cls').change(function() {
                if ($('#<?php echo $tdf_element;?>_cls').children().eq(3).val() != "" && $(
                        '#<?php echo $tdf_element;?>_cls').children().eq(5).val() != "") {
                    $(".<?php echo $tdf_element;?>_val").html(
                        "<i class='fas fa-check text-success'></i>");
                } else {
                    $(".<?php echo $tdf_element;?>_val").html(
                        "<i class='fas fa-exclamation text-danger'></i>");
                }
            }); 
            <?php 
                } 
            ?>
    });
    </script>
</body>

</html>