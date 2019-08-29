<?php include 'appsystem/inc_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Web Setting</title>
</head>
<body>
    <!-- 
        TAB :: User
        1.modal ปุ่ม add user เพิ่ม / ปุ่มถังขยะ ลบ
        TAB :: Group
        1.ปุ่มถังขยะ /ปุ่ม deletegroup ใช้ลบกลุ่ม
        2.modal ปุ่ม add user เพิ่ม / ปุ่มถังขยะ ลบ
    -->
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
    <!-- Body Part -->
    <div class="wrapper_main">
        <!-- ส่วนหัว -->
        <header class="content-head box-normal">           
            <ul class="nav nav-pills btn-setright" id="pills-tab" role="tablist">
                <!-- Users -->
                <li class="nav-item">
                    <a class="btn btn-normal active" id="pills-User-tab" data-toggle="pill" href="#pills-User" role="tab" aria-controls="pills-User" aria-selected="true">
                        <i class="far fa-user"></i> <span class="tabHead-webSet">Users</span>
                    </a>
                </li>
                <!-- Group -->
                <li class="nav-item">
                    <a class="btn btn-normal" id="pills-Group-tab" data-toggle="pill" href="#pills-Group" role="tab" aria-controls="pills-Group" aria-selected="false">
                        <i class="fas fa-users"></i> <span class="tabHead-webSet">Groups</span> 
                    </a>
                </li>
                <!-- Company -->
                <li class="nav-item">
                    <a class="btn btn-normal" id="pills-Company-tab" data-toggle="pill" href="#pills-Company" role="tab" aria-controls="pills-Company" aria-selected="false">
                        <i class="far fa-building"></i> <span class="tabHead-webSet">Company</span> 
                    </a>
                </li>
                <!-- Bussiness Calender -->
                <li class="nav-item">
                    <a class="btn btn-normal" id="pills-BussinessCalender-tab" data-toggle="pill" href="#pills-BussinessCalender" role="tab" aria-controls="pills-BussinessCalender" aria-selected="false">
                        <i class="far fa-calendar-alt"></i> <span class="tabHead-webSet">Bussiness Calender</span> 
                    </a>
                </li>
            </ul>
        </header> 
        
        <!-- ส่วนตัว -->
        <div class="content-body-OnlyContentHead-webSetting">
            <div class="tab-content h-100" id="pills-tabContent">
                <!-- Users -->
                <div class="tab-pane fade show active h-100" id="pills-User" role="tabpanel" aria-labelledby="pills-User-tab">
                    <div class="box-two-side">
                        <!-- ซ้าย -->
                        <div class="box-left-side webSet-mem" id="LeftSide-user" style="overflow-y: scroll; border-top: 1px solid#e1ebef;">
                            <div class="btn-setleft box-one" style="height: 64px;">
                                <select class="form-control-sm">
                                    <option>Active</option>
                                    <option>Disable</option>
                                </select>
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-inviteNewUser">
                                    <i class="fas fa-plus"></i> <span class="tabInnerConnet">Invite new users</span> 
                                </button>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-user1Tab" onclick="openUser()"
                                data-toggle="pill" href="#v-pills-user1" role="tab" aria-controls="v-pills-user1" aria-selected="true">
                                    <div class="box-one">
                                        <img class="img-medium" style="margin-right: 8px;" src="/assets/img/logo.jpg" alt="Avatar">
                                        <div>
                                            <h4 class="text-f14">User</h4>
                                            <p class="text-sub">Accounting, HR, IT, Managers, Marketing, Sales</p>
                                        </div>
                                    </div>  
                                </a>
                                <a class="nav-link" id="v-pills-user2Tab" onclick="openUser()"
                                data-toggle="pill" href="#v-pills-user2" role="tab" aria-controls="v-pills-user2" aria-selected="false">
                                    <div class="box-one">
                                        <img class="img-medium" style="margin-right: 8px;" src="/assets/img/logo.jpg" alt="Avatar">
                                        <div>
                                            <h4 class="text-f14">User 2</h4>
                                        </div>
                                    </div> 
                                </a>
                                <a class="nav-link" id="v-pills-user3Tab" onclick="openUser()"
                                data-toggle="pill" href="#v-pills-user3" role="tab" aria-controls="v-pills-user3" aria-selected="false">
                                    <div class="box-one">
                                        <img class="img-medium" style="margin-right: 8px;" src="/assets/img/logo.jpg" alt="Avatar">
                                        <div>
                                            <h4 class="text-f14">User 3</h4>
                                            <p class="text-sub">Accounting, HR, IT, Managers</p>
                                        </div>
                                    </div> 
                                </a>
                            </div>
                            <!-- Modal of btn-invite user for TAB :: User-->
                            <div class="modal fade" id="Model-inviteNewUser" tabindex="-1" role="dialog" aria-labelledby="Model-inviteNewUser" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- ปุ่ม x -->
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <!-- เนื้อหา -->
                                            <div class="mt-2">
                                                <div class="header-invite">
                                                    <h3>Invite users to your team</h3>
                                                </div>
                                                <ul class="container-fluid content-invite text-f12">
                                                    <li class="row w-100">
                                                        <div class="col-3">Email address</div>
                                                        <div class="col-3">Name</div>
                                                        <div class="col-6">Groups</div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm " id="input-email1" onkeyup="checkvalueModal(1)" />
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email2" onkeyup="checkvalueModal(1)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email3" onkeyup="checkvalueModal(1)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <!-- input user อันที่4ขึ้นไปจะมีปุ่มถังขยะ ลบ -->
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email4" onkeyup="checkvalueModal(1)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6" style="display:flex">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                            <div style="padding-left: 8px;">
                                                                <!-- ปุ่มลบ -->
                                                                <button class="btn btn-modelUser-delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-12">
                                                            <!-- ปุ่มadd input เพิ่ม -->
                                                            <button class="btn text-f14" style="color: #2e9df0;">
                                                                + Add another user
                                                            </button>  
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- ปุ่มส่วนท้าย -->
                                                <div class="mt-2">
                                                    <!-- จะใช้งานได้ก็ต่อเมื่อ มีuserใดuserหนึ่งกรอกข้อมูลครบทุกช่อง -->
                                                    <button class="btn btn-unclick send-inv" disabled>
                                                        Send invitation
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ขวา -->
                        <div class="box-right-side" id="RightSide-user" style="overflow-y: scroll; border-top: 1px solid#e1ebef;">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- user1 -->
                                <div class="tab-pane fade show active closeself" id="v-pills-user1" style="position: relative;" role="tabpanel" aria-labelledby="v-pills-user1Tab">
                                    <!-- ปุ่มกากบาท -->
                                    <button class="close" onclick="closeSelf()">
                                        <span>&times;</span>
                                    </button>
                                    <!-- profile -->
                                    <div style="display:flex">
                                        <img class="img-big" style="margin-right: 16px;" src="/assets/img/logo.jpg" alt="Avatar"/>
                                        <div>
                                            <div class="text-f21">John</div>
                                            <div class="text-sub">example@hotmail.com</div>
                                            <div class="btn-setright box-one" style="margin-top:8px;">
                                                <form method="GET" action="profile.php">
                                                    <input type=hidden name="1" value="1">
                                                    <button class="btn btn-normal" type="submit">
                                                        Change Password
                                                    </button>
                                                </form>
                                                <!-- ทำ disable -->
                                                <button class="btn btn-unclick" disabled>
                                                    Disable user
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group -->
                                    <div class="text-f12" style="margin-top:16px;">
                                        <span style="margin-bottom: 8px;" class="text-sub">John is a member of 6 groups <a href="#">Edit</a></span>
                                        <div class="box-one" style="margin-bottom: 8px;">
                                            <div class="icon-small-size" style="background: #E8E8E8; margin-right: 5px">
                                                <i class="fas fa-users" style="color: #959595"></i>
                                            </div>
                                            <span>Hr</span>
                                        </div>
                                        <div class="box-one" style="margin-bottom: 8px;">
                                            <div class="icon-small-size" style="background: #E8E8E8; margin-right: 5px">
                                                <i class="fas fa-users" style="color: #959595"></i>
                                            </div>
                                            <span>Sales</span>
                                        </div>
                                    </div>
                                    <!-- footer -->
                                    <div class="text-f12">
                                        <span><span class="text-sub">John has</span> Administrator role</span>
                                    </div>     
                                </div>
                                <!-- user2 -->
                                <div class="tab-pane fade closeself" id="v-pills-user2" role="tabpanel" aria-labelledby="v-pills-user2Tab">
                                    <!-- ปุ่มกากบาท -->
                                    <button class="close" onclick="closeSelf()">
                                        <span>&times;</span>
                                    </button>
                                    <!-- profile -->
                                    <div style="display:flex">
                                        <img class="img-big" style="margin-right: 16px;" src="/assets/img/logo.jpg" alt="Avatar">
                                        <div>
                                            <div class="text-f21">John</div>
                                            <div class="text-sub">example@hotmail.com</div>
                                            <div style="margin-top:8px;">
                                                <button class="btn btn-normal">
                                                    Change Password
                                                </button>
                                                <button class="btn btn-unclick" disabled>
                                                    Disable user
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group -->
                                    <div class="text-f12" style="margin-top:16px;">
                                        <span style="margin-bottom: 8px;" class="text-sub">Anna isn't a member of any group <a href="#">Add</a></span>
                                    </div>
                                    <!-- footer -->
                                    <div class="text-f12">
                                        <span><span class="text-sub">John has</span> Administrator role</span>
                                    </div> 
                                </div>
                                <!-- user3 -->
                                <div class="tab-pane fade closeself" id="v-pills-user3" role="tabpanel" aria-labelledby="v-pills-user3Tab">
                                    <!-- ปุ่มกากบาท -->
                                    <button class="close" onclick="closeSelf()">
                                        <span>&times;</span>
                                    </button>
                                    <!-- profile -->
                                    <div style="display:flex">
                                        <img class="img-big" style="margin-right: 16px;" src="/assets/img/logo.jpg" alt="Avatar">
                                        <div>
                                            <div class="text-f21">Kim</div>
                                            <div class="text-sub">example@hotmail.com</div>
                                            <div style="margin-top:8px;">
                                                <button class="btn btn-normal">
                                                    Change Password
                                                </button>
                                                <!-- ทำ disable -->
                                                <button class="btn btn-unclick" disabled>
                                                    Disable user
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- group -->
                                    <div class="text-f12" style="margin-top:16px;">
                                        <span style="margin-bottom: 8px;" class="text-sub">Kim is a member of 6 groups <a href="#">Edit</a></span>
                                        <div class="box-one" style="margin-bottom: 8px;">
                                            <div class="icon-small-size" style="background: #E8E8E8; margin-right: 5px">
                                                <i class="fas fa-users" style="color: #959595"></i>
                                            </div>
                                            <span>Hr</span>
                                        </div>
                                        <div class="box-one" style="margin-bottom: 8px;">
                                            <div class="icon-small-size" style="background: #E8E8E8; margin-right: 5px">
                                                <i class="fas fa-users" style="color: #959595"></i>
                                            </div>
                                            <span>Sales</span>
                                        </div>
                                    </div>
                                    <!-- footer -->
                                    <div class="text-f12">
                                        <span><span class="text-sub">Kim has</span> Member role</span>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Group -->
                <div class="tab-pane fade h-100" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">
                    <div class="box-two-side">
                        <!-- ซ้าย -->
                        <div class="box-left-side webSet-mem" id="LeftSide-group">
                            <div class="btn-setright box-one" style="height: 64px;">
                                <button class="btn btn-normal"> 
                                    <i class="fas fa-plus"></i> <span class="tabInnerConnet">Add new group</span> 
                                </button>
                                <button class="btn btn-green" data-toggle="modal" data-target="#Model-inviteNewUser-Group">
                                    <i class="fas fa-plus"></i> <span class="tabInnerConnet">Invite new users</span> 
                                </button>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <!-- HR -->
                                <a class="nav-link active box-normal" onclick="openGroup()"
                                id="v-pills-group1Tab" data-toggle="pill" href="#v-pills-group1" role="tab" aria-controls="v-pills-group1" aria-selected="true">
                                    <div class="box-normal-left">
                                        <div class="icon-medium-size-f20" style="color:#959595 ;background: #e8e8e8; margin-right: 12px;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="text">
                                            <h4 class="text-f14">HR</h4>
                                            <p class="text-sub">user</span></p>
                                        </div>
                                    </div>
                                    <div class="icon-btn">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>        
                                </a>
                                <!-- Sale -->
                                <a class="nav-link box-normal" onclick="openGroup()"
                                id="v-pills-group2Tab" data-toggle="pill" href="#v-pills-group2" role="tab" aria-controls="v-pills-group2" aria-selected="false">
                                    <div class="box-normal-left">
                                        <div class="icon-medium-size-f20" style="color:#959595 ;background: #e8e8e8; margin-right: 12px;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="text">
                                            <h4 class="text-f14">Sales</h4>
                                            <p class="text-sub">No users</span></p>
                                        </div>
                                    </div>
                                    <div class="icon-btn">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>     
                                </a>
                            </div>
                            <!-- Modal of btn-invite user for TAB :: Group-->
                            <div class="modal fade" id="Model-inviteNewUser-Group" tabindex="-1" role="dialog" aria-labelledby="Model-inviteNewUser-Group" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- ปุ่ม x -->
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <!-- เนื้อหา -->
                                            <div class="mt-2">
                                                <div class="header-invite">
                                                    <h3>Invite users to your team</h3>
                                                </div>
                                                <ul class="container-fluid content-invite text-f12">
                                                    <li class="row w-100">
                                                        <div class="col-3">Email address</div>
                                                        <div class="col-3">Name</div>
                                                        <div class="col-6">Groups</div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm " id="input-email5" onkeyup="checkvalueModal(2)" />
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email6" onkeyup="checkvalueModal(2)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email7" onkeyup="checkvalueModal(2)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <!-- input user อันที่4ขึ้นไปจะมีปุ่มถังขยะ ลบ -->
                                                    <li class="row w-100">
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm" id="input-email8" onkeyup="checkvalueModal(2)"/>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control-sm"/>
                                                        </div>
                                                        <!-- ปุ่มกากบาทมีปัญหา -->
                                                        <div class="col-6" style="display:flex">
                                                            <select data-placeholder="Start typing existing or a new group name" class="chosen-select" multiple>
                                                                <option value=""></option>
                                                                <option>HR</option>
                                                                <option>salse</option>
                                                                <option>marketing</option>
                                                            </select>
                                                            <div style="padding-left: 8px;">
                                                                <!-- ปุ่มลบ -->
                                                                <button class="btn btn-modelUser-delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="row w-100">
                                                        <div class="col-12">
                                                            <!-- ปุ่มadd input เพิ่ม -->
                                                            <button class="btn text-f14" style="color: #2e9df0;">
                                                                + Add another user
                                                            </button>  
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- ปุ่มส่วนท้าย -->
                                                <div class="mt-2">
                                                    <!-- จะใช้งานได้ก็ต่อเมื่อ มีuserใดuserหนึ่งกรอกข้อมูลครบทุกช่อง -->
                                                    <button class="btn btn-unclick send-invGroup" disabled>
                                                        Send invitation
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ขวา -->
                        <div class="box-right-side" id="RightSide-group" style="overflow-y: scroll; border-top: 1px solid#e1ebef;">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- group1 -->
                                <div class="tab-pane fade show active" id="v-pills-group1" role="tabpanel" aria-labelledby="v-pills-group1Tab">
                                    <!-- ปุ่มกากบาท -->
                                    <button class="close" onclick="closeSelf()">
                                        <span>&times;</span>
                                    </button>
                                    <!-- profile -->
                                    <div style="display:flex">
                                        <div class="icon-big-size-f20" style="color:#959595 ;background: #e8e8e8; margin-right: 16px">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <div class="text-f21" id="namegroup">HR</div>
                                            <input class="form-control form-control-sm" id="inputGroup" value=" " type="text" onkeyup="checknameGroup()"/>
                                            <p class="text-error" id="errorGroupName"></p>
                                            <div class="btn-setright" id="btnset-rename" style="margin-top:8px;">
                                                <button class="btn btn-normal" onclick="renameGroup()">
                                                    Rename group
                                                </button>
                                                <button class="btn btn-groupDelete">
                                                    Delete group
                                                </button>
                                            </div>
                                            <div id="btnset-SaveRename" style="margin-top:8px;">
                                                <button class="btn btn-unclick" id="Save-nameGroup" onclick="savenameGroup()" disabled>
                                                    Save name
                                                </button>
                                                <button class="btn btn-groupDelete" onclick="CancelrenameGroup()">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- group -->
                                    <div class="text-f12" style="margin-top:16px;">
                                        <span style="margin-bottom: 8px;" class="text-sub">This group includes 1 user <a href="#">Edit</a></span>
                                        <div class="box-one" style="margin: 8px 0;">
                                            <!-- รูปขนาดเล็ก -->
                                            <div class="img-small" style="background: #B8E17D; margin-right: 5px">
                                                <p>O</p>
                                            </div>
                                            <div class="text-f12">
                                                username
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <!-- group2 -->
                                <div class="tab-pane fade" id="v-pills-group2" role="tabpanel" aria-labelledby="v-pills-group2Tab">
                                    <!-- ปุ่มกากบาท -->
                                    <button class="close" onclick="closeSelf()">
                                        <span>&times;</span>
                                    </button>
                                    <!-- profile -->
                                    <div style="display:flex">
                                        <div class="icon-big-size-f20" style="color:#959595 ;background: #e8e8e8; margin-right: 16px">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <div class="text-f21">Name</div>
                                            <div style="margin-top:8px;">
                                                <button class="btn btn-normal">
                                                    Rename group
                                                </button>
                                                <button class="btn btn-groupDelete">
                                                    Delete group
                                                </button>
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- group -->
                                    <div class="text-f12" style="margin-top:16px;">
                                        <span style="margin-bottom: 8px;" class="text-sub">There are no users in this group <a href="#">Add</a></span>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Company -->
                <div class="tab-pane fade" id="pills-Company" role="tabpanel" aria-labelledby="pills-Company-tab">
                    <!-- รูป -->
                    <div style="display: flex">
                        <!-- ส่วนของรูปภาพ -->
                        <div style="margin-right: 12px">
                            <!-- กรณียังไม่อัพรูป  -->
                            <div id="defualtLogoUpload" class="defualt-logo-upload"></div>
                            <!-- กรณีที่อัพรูปแล้ว -->
                            <img id="logoUpload" class="logo-upload" src="#" alt="Avatar"/>
                        </div>
                        <!-- กล่องด้านข้างรูป avatar -->
                        <div class="logo-box">
                            <!-- ส่วนอัพโหลดภาพ -->
                            <!-- ถ้ายังไม่เคยอัพภาพ จะแสดงส่วนนี้ -->
                            <div id="up-logo">
                                <input type="file" name="photo" id="upload-photo" onchange="readURLlogo(this);" accept="image/*" />
                                <label for="upload-photo">Upload photo</label>
                            </div>
                            <!-- ส่วนเปลี่ยนภาพ และ ลบภาพ -->
                            <!-- กรณีเคยอัพรูปภาพแล้ว -->
                            <div id="change-clear-logo" class="change-logo">
                                <input type="file" name="photo" id="changephoto" onchange="readURLlogo(this);" accept="image/*" />
                                <label for="changephoto">Change photo</label>
                                <p id="Clearlogo" onclick="clear()">Clear photo</p>
                            </div>
                            <p class="text-sub">Profile photos must be JPGs or PNGs up to 5MB</p>
                        </div>
                    </div>
                    <!-- form :: Company name -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label for="Firstname">Company name</label>
                        </div>
                        <div>
                            <input type="text" class="form-control form-control-sm"/>
                        </div>
                    </div>      
                    <!-- Default currency -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>Default currency</label>
                        </div>
                        <div>
                            <select class="form-control form-control-sm">
                                <option>USD : Us Dollar</option>
                                <option>THB : Baht</option>
                            </select>
                        </div>
                    </div>
                    <!-- Additional currencies (optional) -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>Additional currencies (optional)</label>
                        </div>
                        <div>
                            <select data-placeholder="Start typing a currency..." class="chosen-select" multiple>
                                <option value=""></option>
                                <option>USD : Us Dollar</option>
                                <option>THB : Baht</option>
                            </select>
                        </div>
                    </div>
                    <!-- Time Zone -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>TimeZone</label>
                        </div>
                        <div>
                            <select class="form-control form-control-sm">
                                <option>Small select</option>
                            </select>
                        </div>
                    </div>
                    <!-- ปุ่ม save change -->
                    <div class="form-line">
                        <div style="margin-left: 150px;">
                            <button class="btn btn-green">
                                Save change
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Bussiness Calender -->
                <div class="tab-pane fade h-100" id="pills-BussinessCalender" style="overflow-y: auto;" role="tabpanel" aria-labelledby="pills-BussinessCalender-tab">
                    <!-- First day of the week -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>First day of the week</label>
                        </div>
                        <div>
                            <select class="form-control form-control-sm">
                                <option>Monday</option>
                                <option>Sunday</option>
                            </select>
                        </div>
                    </div>
                    <!-- Non-working weekdays -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>Non-working weekdays</label>
                        </div>
                        <div class="Non-working-day">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckMon">
                                <label class="custom-control-label" for="customCheckMon">Mon</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckTue">
                                <label class="custom-control-label" for="customCheckTue">Tue</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckWed">
                                <label class="custom-control-label" for="customCheckWed">Wed</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckThu">
                                <label class="custom-control-label" for="customCheckThu">Thu</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckFri">
                                <label class="custom-control-label" for="customCheckFri">Fri</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckSat">
                                <label class="custom-control-label" for="customCheckSat">Sat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheckSun">
                                <label class="custom-control-label" for="customCheckSun">Sun</label>
                            </div>
                        </div>
                    </div>
                    <!-- Holidays -->
                    <div class="form-line">
                        <div class="label-w150">
                            <label>Holidays</label>
                        </div>
                        <div>
                            <div class="holiday">
                                <h3 class="text-f14">This Year (2019)</h3>
                                <div class="text-sub">No holidays in 2019</div>
                                <a href="#" class="link-ingroup"><i class="fas fa-plus"></i> Add holiday</a>
                            </div>
                            <div class="holiday">
                                <h3 class="text-f14">Next Year (2020)</h3>
                                <div class="text-sub">No holidays in 2020</div>
                                <a href="#" class="link-ingroup"><i class="fas fa-plus"></i> Add holiday</a>
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
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/event.js"></script>
    <script src="assets/js/form.js"></script>

</body>
</html>