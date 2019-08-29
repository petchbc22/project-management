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
    <title>Template</title>
</head>
<?php 
    if (empty($_REQUEST["appaction"])) { $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }
    if (empty($_REQUEST["tp_id"])) { $tp_id = ""; } else { $tp_id = $_REQUEST["tp_id"]; }
    if (empty($_REQUEST["delete_template"])) { $appaction_delete = ""; } else { $appaction_delete = $_REQUEST["delete_template"]; }
    
    // if ($appaction == "add_home"){
    //     if (empty($_REQUEST['pj_process_title'])) { $pj_process_title = ""; } else { $pj_process_title = $_REQUEST["pj_process_title"]; }
    //     if (empty($_REQUEST['pj_process_start'])) { $pj_process_start = ""; } else { $pj_process_start = $_REQUEST["pj_process_start"]; }
    //     if (empty($_REQUEST['pj_process_deadline'])) { $pj_process_deadline = ""; } else { $pj_process_deadline = $_REQUEST["pj_process_deadline"]; }
    //     if (empty($_REQUEST['tp_id'])) { $tp_id = ""; } else { $tp_id = $_REQUEST["tp_id"]; }

    // $sql_command_addhome = " INSERT INTO project ( tp_id, pj_process_title,pj_process_start, pj_process_deadline,pj_user_ceate, pj_complete,pj_status) VALUES ('$tp_id','$pj_process_title','$pj_process_start','$pj_process_deadline','$ss_acc_id','0','N') ";
    // if (mysqli_query($conn, $sql_command_addhome)){
    //     $iLastID = mysqli_insert_id($conn);
    //     echo '<script>
    //     setTimeout(function() {
    //         swal({
    //             title: "Process starting !",
    //             type: "success"
    //         }).then(function() {
    //             window.location = "inprocess.php?pj_id='.$iLastID.'";
    //         });
    //     }, 300);
    // </script>';
    // }

    // }
    if ($appaction_delete == "delete_template"){
        $sql = "UPDATE template SET tp_status = 'D' WHERE tp_id = '$tp_id' ";
        if (mysqli_query($conn, $sql)){
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "Delete Template Success !",
                        type: "success"
                    }).then(function() {
                        window.location = "Template.php";
                    });
                }, 300);
            </script>';
        }
    }
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
    <!-- BODY -->
    <div class="wrapper_main">
        <!-- Head -->
        <header class="content-head box-one">
            <h3 class="text-f14">Processes Template</h3>
            <a class="btn btn-normal" href="CreateTemplate.php" style="margin-left: 16px" role="button">
                <i class="fas fa-plus"></i> Create Template
            </a>
        </header> 
       <?php 
            $sql_template = "SELECT * FROM template WHERE tp_status = 'N'";
            $sql_template_result = $conn->query($sql_template);
            $sql_template_count = $sql_template_result->num_rows;
       ?>
        <!-- Body -->
        <div class="content-body-OnlyContentHead">
            <ul class="template">
                <!-- Template แต่ละตัว -->
                <?php
                    while($template_result_query = mysqli_fetch_array($sql_template_result,MYSQLI_ASSOC)){
                    $tp_id          = $template_result_query["tp_id"];
                    $tp_name        = $template_result_query["tp_name"];
                    $tp_title       = $template_result_query["tp_title"];
                    $tp_user_create = $template_result_query["tp_user_create"];
                //    query task from tp_id
                    $query_img = "SELECT * FROM task WHERE tp_id = '$tp_id'";
                    $sql_img_query = mysqli_query($conn,$query_img);
                    $sql_img_count = $sql_img_query->num_rows;    
                ?>
                <li class="box-normal">
                    <a href="Intemplate.php?tp_id=<?php echo $tp_id ?>" style="text-decoration:none!important;">
                        <div class="box-normal-left" >
                            <div class="icon-medium-size-f20" style="background: #ccc;">
                                <i class="far fa-file-alt"></i>
                            </div>
                            <div class="template-text-box">
                                <h3 class="text-f14"><?php echo $tp_name; ?></h3>
                                <p class="text-sub">
                                    <span><?php echo $sql_img_count;?> tasks</span> • <span>4 running processes</span>
                                </p>
                            </div>
                        </div>
                    </a>
                        <div class="template-btn-set btn-set">
                            <button class="btn btn-green" data-toggle="modal" data-target="#Model-StartProcessbtn<?php echo $tp_id ?>">
                                Start process
                            </button>
                            <?php if($ss_acc_id == $tp_user_create ){ ?>
                            <a class="btn btn-icon-link" href="EditTemplate.php?tp_id=<?php echo $tp_id ?>" role="button">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button class="btn btn-icon-link" data-toggle="modal" data-target="#Model-Deletebtn<?php echo $tp_id ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <?php } ?>
                        </div>
                  
                </li>
                <!-- Modal ของปุ่ม startProcess -->
                <div class="modal fade" id="Model-StartProcessbtn<?php echo $tp_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-StartProcessbtn" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- ปุ่ม x -->
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- เนื้อหา -->
                            <form class="mt-2" id="myform1" action="Inprocess.php" method="POST" novalidate>
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
                                        <input type="text" name="pj_process_title" id="pj_process_title" class="form-control w-50" placeholder="project name " required >
                                        <div class="invalid-feedback">กรุณาระบุชื่อโปรเจค</div> 
                                    </div>
                                </div>
                                <input type="hidden" name="tp_id" value="<?php echo $tp_id ; ?>"/>
                                <!-- Process deadline -->
                                <div class="form-group row form-line">
                                    <label class="col-sm-3 col-form-label"><b>Process started</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" autocomplete="off" class="form-control pj_process_start w-50" id="pj_process_start" name="pj_process_start" data-timepicker="true" data-time-format='hh:ii:00' placeholder=" Date" required>
                                        <div class="invalid-feedback">กรุณาระบุวันที่เริ่มโปรเจค</div> 
                                    </div>
                                </div>
                                <div class="form-group row form-line">
                                    <label class="col-sm-3 col-form-label"><b>Process deadline</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" autocomplete="off" class="form-control pj_process_deadline w-50" id="pj_process_deadline" name="pj_process_deadline" data-timepicker="true" data-time-format='hh:ii:00' placeholder="Due Date" required >
                                        <div class="invalid-feedback">กรุณาระบุวันที่สิ้นสุดโปรเจค</div> 
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
                                
                                    <button class="btn btn-green" onclick="check_null();">
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
            

                <!-- Modal ของปุ่ม delete -->
                <div class="modal fade" id="Model-Deletebtn<?php echo $tp_id ?>" tabindex="-1" role="dialog" aria-labelledby="Model-Deletebtn" aria-hidden="true">
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
                                        <?php echo $tp_name; ?> deletion confirmation
                                    </h3>
                                    <p class="text-f12" style="margin-top:12px;">
                                        Are you sure you want to delete selected template?
                                    </p>
                                    <div style="margin-top:12px;">
                                        <a href="template.php?tp_id=<?php echo $tp_id; ?>&delete_template=delete_template"
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
            </ul>
        </div>
    </div>
    
    <!-- Script -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <!-- <script src="assets/js/main.js"></script> -->
    <script src="assets/js/select.js"></script>
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
    <script type="text/javascript">
        $(function(){
            $("#myform1").on("submit",function(){
                var form = $(this)[0];
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');         
            });     
        });
</script>
</body>
</html>