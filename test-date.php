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
    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="w-50 p-2">
                    Start Date : <input type="text" name="dateStart"  value="" class="form-control dateStart" autocomplete="off"/> 
                End Date : <input type="text" name="dateEnd"  value="" class="form-control dateEnd" autocomplete="off"/> 
                    </div>
                    
                   
                    <div class="w-50 p-2">
                    <!-- next Start Date : <input type="text" name="dateStart"  value="" class="form-control nextdateStart" autocomplete="off"/>  -->
                next End Date : <input type="text" name="dateEnd"  value="" id="nextdateEnd" class="form-control nextdateEnd" autocomplete="off"/> 
                    </div>
             
                </div>
                next End Date : <input type="text" name="dateEnd"  value="" id="snextdateEnd" class="form-control snextdateEnd" autocomplete="off"/> 
                <button id="clonedate" value="clone">clone</button>
            </div>
        </div>
    </div>
   
   

   
    </div>

    <!-- Javascript -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
 
    <script src="assets/js/jquery.validate.js"></script>
    <script src="assets/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="assets/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/fieldstep.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript">

            var startDateTextBox    = $('.dateStart');
            var endDateTextBox      = $('.dateEnd');
  
            $(function() {           
            // loop datepicker 
            $(".nextdateEnd" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat : 'yy-mm-dd',
                minDate: setMinDate(),
            });
            // loop datepicker 
            $(".snextdateEnd" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat : 'yy-mm-dd',
                minDate: setMinDate(),
            });
        });
        // ดึงค่า start project เป็น default
        function setMinDate() {
        var string = $(".dateStart").val();
        return new Date(string);
        }
        // เมื่อคลิก ทำการดึง val() ของ start project ออกมา
        $( "#clonedate" ).click(function() {
            // loop
            $('#nextdateEnd').datepicker('option', {
                minDate: setMinDate(),
            });
            $('#snextdateEnd').datepicker('option', {
                minDate: setMinDate(),
            });
        });


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

// ///////////////////////////////////////////////

    


</script>
</body>

</html>