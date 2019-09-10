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
   $search_user = $_GET["search_user"];
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
    <title><?php echo $ss_acc_permission;?>List Account User</title>
</head>
<?php 
    if (empty($_REQUEST["appaction"])) { $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }
    if (empty($_REQUEST["tp_id"])) { $tp_id = ""; } else { $tp_id = $_REQUEST["tp_id"]; }
    if (empty($_REQUEST["delete_template"])) { $appaction_delete = ""; } else { $appaction_delete = $_REQUEST["delete_template"]; }
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
<?php 
        // loop noti unreply form project task
         $sql_noti = "SELECT * FROM project_assign_user WHERE pau_reply = '0' AND acc_id = '$ss_acc_id' AND pau_status ='N' ";
         $sql_acc_noti_result = $conn->query($sql_noti);
         $sql_acc_noti_count = $sql_acc_noti_result->num_rows;
        //  loop noti reply form project task
        $sql_noti_reply = "SELECT * FROM project_assign_user WHERE pau_reply = '1' AND acc_id = '$ss_acc_id' AND pau_status ='N' ";
        $sql_acc_noti_reply_result = $conn->query($sql_noti_reply);
        $sql_acc_noti_reply_count = $sql_acc_noti_reply_result->num_rows;
    
?>
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
    <div class="wrapper_main ">
        <header class="content-head box-one d-flex">
            <div class="col-6 pl-0">
                <h3 class="text-f14 mr-2">NOTIFICATIONS</h3>
            </div>
            <form class="form-group mb-0 col-6" action="list-user.php" method="GET">
                <div class="row justify-content-end">
                    <div class="col-md-4 pr-0">
                        <input type="text" class="form-control" name="search_user" placeholder="Search notifications">
                    </div>
                </div>
            </form>
        </header> 
        <div class="content-body-bodyTitle90" style="overflow-y:auto">
            <div id="pills-tabContent" class="tab-content" style="height: 100%;">
                <!-- all user -->
                <div class="content-head tab-pane fade show active" id="pills-alluser" role="tabpanel" aria-labelledby="pills-alluser-tab">
                    <ul class="template">
                        <?php 
                        while($acc_result_noti = mysqli_fetch_array($sql_acc_noti_result,MYSQLI_ASSOC)){
                            $task_id_name = $acc_result_noti["pjt_id"];
                        

                            $sql_pjt = "SELECT * FROM project_task WHERE pjt_id = '$task_id_name'  ";
                            $sql_pjt_query = mysqli_query($conn,$sql_pjt);
                            $sql_pjt_result = mysqli_fetch_array($sql_pjt_query,MYSQLI_ASSOC);
                            $pj_name    = $sql_pjt_result["pjt_title"];
                            $pj_id_name = $sql_pjt_result["pj_id"];


                            $sql_pj = "SELECT * FROM project WHERE pj_id = '$pj_id_name'  ";
                            $sql_pj_query = mysqli_query($conn,$sql_pj);
                            $sql_pj_result = mysqli_fetch_array($sql_pj_query,MYSQLI_ASSOC);
                            $pj_pj_tt = $sql_pj_result["pj_process_title"];
                            $pj_pj_us_n  = $sql_pj_result["pj_user_ceate"];

                            $sql_us_assi = "SELECT * FROM account WHERE acc_id = '$pj_pj_us_n'  ";
                            $sql_us_query = mysqli_query($conn,$sql_us_assi);
                            $sql_us_result = mysqli_fetch_array($sql_us_query,MYSQLI_ASSOC);
                            $acc_name = $sql_us_result["acc_name"];
                            $acc_lname = $sql_us_result["acc_lastname"];

                        ?>
                        <li class="box-normal">
                            <a href="show-task-detail.php?pjt_id=<?php echo $task_id_name?>" class="not_underline">
                                <div class="box-normal-left">
                                    <div class="icon-medium-size-f20" style="background: #ccc;">
                                        <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                    </div>
                                    <div class="template-text-box">
                                        <h3 class="text-f14 text-success">Your Task : <?php echo $pj_name ?> Form Project : <?php echo $pj_pj_tt ?> </h3>
                                        <p class="text-sub">
                                            <span>assigned by : <?php echo $acc_name.' '.$acc_lname ?> </span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li> 
                        <?php } ?>
                        
                    </ul>
                    <h3 class="text-f14 mr-2 pb-3">Before Notifications</h3>
                    <ul class="template">
                    <?php 
                        while($acc_result_reply_noti = mysqli_fetch_array($sql_acc_noti_reply_result,MYSQLI_ASSOC)){
                            $task_id_name = $acc_result_reply_noti["pjt_id"];
                        

                            $sql_pjt = "SELECT * FROM project_task WHERE pjt_id = '$task_id_name'  ";
                            $sql_pjt_query = mysqli_query($conn,$sql_pjt);
                            $sql_pjt_result = mysqli_fetch_array($sql_pjt_query,MYSQLI_ASSOC);
                            $pj_name    = $sql_pjt_result["pjt_title"];
                            $pj_id_name = $sql_pjt_result["pj_id"];


                            $sql_pj = "SELECT * FROM project WHERE pj_id = '$pj_id_name'  ";
                            $sql_pj_query = mysqli_query($conn,$sql_pj);
                            $sql_pj_result = mysqli_fetch_array($sql_pj_query,MYSQLI_ASSOC);
                            $pj_pj_tt = $sql_pj_result["pj_process_title"];
                            $pj_pj_us_n  = $sql_pj_result["pj_user_ceate"];

                            $sql_us_assi = "SELECT * FROM account WHERE acc_id = '$pj_pj_us_n'  ";
                            $sql_us_query = mysqli_query($conn,$sql_us_assi);
                            $sql_us_result = mysqli_fetch_array($sql_us_query,MYSQLI_ASSOC);
                            $acc_name = $sql_us_result["acc_name"];
                            $acc_lname = $sql_us_result["acc_lastname"];

                        ?>
                        <li class="box-normal">
                            <a href="show-task-detail.php?pjt_id=<?php echo $task_id_name?>" class="not_underline">
                                <div class="box-normal-left">
                                    <div class="icon-medium-size-f20" style="background: #ccc;">
                                        <img src="assets/img/<?php echo $acc_img;?>" alt="" width="40" class="ojb-fit">
                                    </div>
                                    <div class="template-text-box">
                                        <h3 class="text-f14 text-success">Your Task : <?php echo $pj_name ?> Form Project : <?php echo $pj_pj_tt ?> </h3>
                                        <p class="text-sub">
                                            <span>assigned by : <?php echo $acc_name.' '.$acc_lname ?> </span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li> 
                        <?php } ?>
                   
                        
                    </ul>
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
    <script src="assets/js/select.js"></script>
    <script>
        $(document).ready(function(){
            $('#save').click(function(){
                var acc_email      = $('#acc_email').val();
                var acc_username   = $('#acc_username').val();
                var acc_name       = $('#acc_name').val();
                var acc_lastname   = $('#acc_lastname').val();
                var acc_password   = $('#acc_password').val();
                var acc_permission = $('#acc_permission').val();
                console.log(acc_email,acc_username,acc_name,acc_lastname,acc_password,acc_permission);
                $.ajax({
                    url:"add-user-save.php",
                    method:"POST",
                    data:{  acc_email:acc_email,
                            acc_username:acc_username,
                            acc_name:acc_name,
                            acc_lastname:acc_lastname,
                            acc_password:acc_password,
                            acc_permission:acc_permission
                        },
                    success:function(result){
                        if(result.status == 1) // Success
                        {
                            setTimeout(function() {
                            swal({
                                title:  (result.message),
                                type: "success"
                            }).then(function() {
                                window.location = "list-user.php";
                            });
                        }, 300);
                        }
                        else // Err
                        {
                            setTimeout(function() {
                            swal({
                                title: (result.message),
                                type: "success"
                            })
                        }, 300);
                        }     
                    }
                });
            });
        });
    </script>
</body>
</html>