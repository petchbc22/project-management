<?php 
error_reporting (E_ALL ^ E_NOTICE);
include 'appsystem/inc_config.php';
//   displayprofile
$SQL_Profile = "SELECT * FROM account WHERE acc_id = '$ss_acc_id'";
$SQL_PROFILE_QUERY = mysqli_query($conn,$SQL_Profile);
$SQL_PROFILE_RESULT = mysqli_fetch_array($SQL_PROFILE_QUERY,MYSQLI_ASSOC);
$acc_name = $SQL_PROFILE_RESULT["acc_name"];
$acc_lastname = $SQL_PROFILE_RESULT["acc_lastname"];
$acc_img  = $SQL_PROFILE_RESULT["acc_img"];
?>
<!-- Template -->
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
</head>
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
    <!-- BODY -->
    <div class="wrapper_main">
        <!-- Head Template Title -->
        <header class="head-title-h64 box-normal">
            <div class="box-flex-Templatetitle">
                <div>
                    <div class="icon-select">
                        <i class="far fa-images"></i>
                    </div>
                </div>
                <!-- Template Title -->
                <div style="width: 80%">
                    <input class="form-control form-control-sm input-Title" id="tp_name" name="tp_name" type="text" placeholder="Enter Template Name" onkeyup="titleTemplate()">
                    <p class="text-error" id="inputTitle-required"></p>
                </div>
            </div>
            <div class="btn-setleft">
                <button class="btn btn-green" id="save">
                    Create template
                </button>
                <a href="Template.php" class="ml-0">
                    <button class="btn btn-normal">
                        Cancel
                    </button>
                </a>
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
                                        <button class="tablinks tab-button box-normal taskdefault" onclick="openItem(event, 'task')">
                                            <div class="box-one" id="task0">
                                                <div id="task-icon" class="icon-medium-size-f16" style="color: #A3A3A3; background: #E8E8E8; margin-right: 12px;">
                                                    <i id="task-i" class="far fa-square"></i>
                                                </div>
                                                <div class="text-left" id="test-replac">
                                                    <h4 class="text-f14 text-replace" style="color: #959595">New task</h4>
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
                                                    <form>
                                                        <!-- Process title -->
                                                        <div class="form-group row form-line">
                                                            <label class="col-sm-3 col-form-label">Process title</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm inputvalidate" id="tp_title" name="tp_title" type="text">
                                                                <p class="text-error">Text is required</p>
                                                            </div>
                                                        </div>
                                                        <!-- Process instructions -->
                                                        <div class="form-group row form-line">
                                                            <label class="col-sm-3 col-form-label">Process instructions</label>
                                                            <div class="col-sm-9">
                                                                <textarea style="font-size: 12px;" class="form-control" id="tp_instruc" name="tp_instruc" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"></textarea>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Template editors</label>
                                                        <div class="col-sm-9">
                                                            <select class="chosen-select" data-placeholder="Select users or groups who can work on this task" id="template_editors" name="template_editors[]" multiple>
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
                                                    <div class="form-group row form-line">
                                                        <label class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control" id="tp_description" name="tp_description" style="font-size: 12px;" maxlength=150  rows="3" placeholder="Describe this template riefly. This text will appear under template's title in a list"></textarea>
                                                            <span class="text-sub">Maximum of 150 characters</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Task-->
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
                                                            <input class="form-control form-control-sm " type="text" id="task_title" name="task_titles">
                                                            
                                                            <p class="text-error">Text is required</p>
                                                            <!-- <p class="text-replace">aaa</p> -->
                                                        </div>
                                                    </div>
                                                    <!-- Descri -->
                                                    <div class="form-group row form-line">
                                                        <label for="Processtitle" class="col-sm-3 col-form-label">Description</label>
                                                        <div class="col-sm-9">
                                                            <textarea style="font-size: 12px;" class="form-control" id="task_description" name="task_description[]" rows="5" placeholder="Provide detailed instructions on how to use this process (optional). Instructions will be available to all process participants"></textarea>
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
                    <input type="hidden" id="hdnCount" name="hdnCount">
                </div>
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
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/selectize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>
    <script>
  
    </script>
    <script>
        // โหลดlinkเข้ากลุ่ม
        function intogroup(){
            $('.createContentBox').load('intogroup.html');
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#save').click(function(){
                var tp_name             = $('#tp_name').val();
                var tp_title            = $('#tp_title').val();
                var tp_instruc          = $('#tp_instruc').val();
                var tp_description      = $('#tp_description').val();
                var template_editors    = $('#template_editors').val();
                var titletemplate       = $('#titletemplate').val();
                var task_title          = [];
                var task_description    = [];
                
            

                $(":input[name='task_title[]']").each(function() {
                    task_title.push($( this ).val());
                }); 
                $(":input[name='task_description[]']").each(function() {
                    task_description.push($( this ).val());
                }); 

                console.log(task_title);
                $.ajax({
                    url:"CreateTemplate-save.php",
                    method:"POST",
                    data:{task_title:task_title,
                            task_description:task_description,
                            titletemplate:titletemplate,
                            tp_name:tp_name,
                            tp_title:tp_title,
                            tp_instruc:tp_instruc,
                            tp_description:tp_description,
                            template_editors:template_editors
                        },
                    success:function(data){
                        // ขื่อเืท
                        if (data == 1){
                            setTimeout(function() {
                            swal({
                                title: ('บันทึกเทมเพลสสำเร็จ'),
                                type: "success"
                            }).then(function() {
                                window.location = "Template.php";
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