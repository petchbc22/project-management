
<?php

include("../appsystem/inc_config.php");
include("../appsystem/inc_checklogin.php");
include("../useronline.php");
$page_name = "project/timeline";

// if (empty($_REQUEST["pm_id"])){ $pm_id = ""; } else { $pm_id = $_REQUEST["pm_id"]; }
// if (empty($_REQUEST["appaction"])){ $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }
// if (empty($_REQUEST["ct_name"])){ $ct_name = ""; } else { $ct_name = $_REQUEST["ct_name"]; }
// if (empty($_REQUEST["ct_detail"])){ $ct_detail = ""; } else { $ct_detail = $_REQUEST["ct_detail"]; }
if (empty($_REQUEST["PM_TYPE_ID"])){ $ct_workline = ""; } else { $ct_workline = $_REQUEST["PM_TYPE_ID"]; }
if (empty($_REQUEST["TASK_DUEDATE"])){ $ct_duedate = ""; } else { $ct_duedate = $_REQUEST["TASK_DUEDATE"]; }
// if (empty($_REQUEST["ct_id"])){ $ct_id = ""; } else { $ct_id = $_REQUEST["ct_id"]; }
// if (empty($_REQUEST["appaction"])){ $appaction = ""; } else { $appaction = $_REQUEST["appaction"]; }

//  $pm_id = 10;
// if (empty($pm_id)) {
//   header('Location:index.php');
// }
$date_today =  date('Y-m-d');
$sql_customer = "SELECT COUNT(*),TASK_DUEDATE FROM vw_task_timeline  WHERE RECORD_STATUS = 'N' AND TASK_DUEDATE = '$date_today' AND USER_CREATE = '$session_member_id' AND TASK_DUEDATE IS NOT NULL GROUP BY TASK_DUEDATE ORDER BY TASK_DUEDATE ASC ";

$data_result_customer = $conn->query($sql_customer);
$data_count = $data_result_customer->num_rows;

if ($appaction == "add") {

  $sql_customer_task = " INSERT INTO pm_customer_task ( PROJECT_ID, CT_NAME, CT_DETAIL, CT_WORKLINE, CT_DUEDATE, USER_CREATE, DATETIME_CREATE ) VALUES ( $pm_id, '$ct_name', '$ct_detail', $ct_workline, '$ct_duedate', $session_member_id, '$datetime_now')  ";

  // echo "$sql_customer_task";
  if (mysqli_query($conn, $sql_customer_task)) {
      $process_update = "SUCCESS";
  } else {
      $process_update = "ERROR";
  }
   if ($process_update == "SUCCESS") {
    mysqli_close($conn);
    header("Refresh:0");
  }
}
  if ($appaction == "delete") {
    $sql_customer_task = " UPDATE pm_customer_task SET
    RECORD_STATUS = 'D'
    WHERE CT_ID = $ct_id ";

    // echo "$sql_customer_task";
    if (mysqli_query($conn, $sql_customer_task)) {
        $process_update = "SUCCESS";
    } else {
        $process_update = "ERROR";
    }
     if ($process_update == "SUCCESS") {
      mysqli_close($conn);
      header("Refresh:0");
    }
  }


  if ($session_member_type == 'A') {
  $sql_timeline = "SELECT * FROM vw_pm_task WHERE RECORD_STATUS = 'N' ORDER BY TASK_DUEDATE ";
} else if ($session_member_type == 'P') {
  $sql_timeline = "SELECT * FROM vw_pm_task WHERE RECORD_STATUS = 'N' ORDER BY TASK_DUEDATE ";

} else {

  $sql_timeline = "SELECT * FROM vw_pm_task_match_new WHERE RECORD_STATUS = 'N' AND MEMBER_ID = $session_member_id ORDER BY TASK_DUEDATE ";

}
  $data_result_timeline = $conn->query($sql_timeline);
  $data_count_timeline = $data_result_timeline->num_rows;
?>

<!DOCTYPE html>
<html lang="th">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Form</title>


        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



        <!-- Notification Code -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>

        <script>
          function getDataFromDb()
          {
            $.ajax({
              url: "getData.php" ,
              type: "POST",
              data: ''
          })
          .success(function(result) {
          var obj = jQuery.parseJSON(result);
            if(obj != '')
            {
                var messageid = null;
                var subject = null;
                $.each(obj, function(key, val) {
                    messageid = val["MessageID"] ;
                    subject = val["Subject"] ;
                });

                showPopup(messageid,subject);
            }

          });

          }

          if (window.webkitNotifications) {
          function requestingPopupPermission(callback) {
          window.webkitNotifications.requestPermission(callback);
          }

          function showPopup(messageid,subject) {
          if (window.webkitNotifications.checkPermission() > 0) {
          requestingPopupPermission(showPopup);
          } else {
          var mypicture = 'http://www.thaicreate.com/upload/icon-topic/communication.jpg';
          var titletext = 'You have new messages.';
          var bodytext = subject;
          var popup = window.webkitNotifications.createNotification(mypicture, titletext, bodytext);

          popup.show();

          jQuery(popup).css( 'cursor', 'pointer' );
          jQuery(popup).click(function(){
          window.location = "view.php?MessageID="+messageid;
          });

          setTimeout(function () {
          popup.cancel();
          }, '5000');
          }
          }
          } else {
          // alert('Your Browser Not SUPPORT \n Google Chrome Only');
          }

          setInterval(getDataFromDb, 10000);   // 1000 = 1 second

</script>
        <!-- Notification Code -->

        <!-- <button onclick="notifyMe()">Notify me!</button> -->

     <script>
        $(document).ready(function(){
            var date_input=$('input[name="task_duedate"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy-mm-dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
     </script>

     <!-- Open Calendar -->
     <!-- Calendar Error-->
     <link href='fullcalendar.css' rel='stylesheet'/>

     <link href='fullcalendar.print.css' rel='stylesheet' media='print' />

     <script src='jquery/jquery-1.10.2.js'></script>
     <script src='jquery/jquery-ui.custom.min.js'></script>
     <script src='fullcalendar.js'></script>

     <script>

      $(document).ready(function() {2

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /*  className color
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
        */

        /* initialize the external events
        -----------------------------------------------------------------*/
        $('#external-events div.external-event').each(function() {
          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          };

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject);
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          });
        });

        /* initialize the calendar
        -----------------------------------------------------------------*/
        var calendar =  $('#calendar').fullCalendar({
          header: {
            left: 'title',
                  center: 'agendaDay,agendaWeek,month',
                    // center: 'month',
            right: 'prev,next today'
          },
          editable: true,
          firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
          selectable: true,
          defaultView: 'month',

          axisFormat: 'h:mm',
          columnFormat: {
                     month: 'ddd',    // Mon
                     week: 'ddd d', // Mon 7
                     day: 'dddd M/d',  // Monday 9/7
                     agendaDay: 'dddd d'
                 },
                 titleFormat: {
                     month: 'MMMM yyyy', // September 2009
                     week: 'MMMM yyyy', // September 2009
                     day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                 },
          allDaySlot: false,
          selectHelper: true,
          select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
              calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }
            calendar.fullCalendar('unselect');
          },
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }
          },
          events: [
            <?php



              while ($row = $data_result_timeline->fetch_assoc()) {
                $ct_id = $row['TASK_ID'];
                $ct_name = $row['TASK_NAME'];
                $ct_detail = $row['TASK_DETAIL'];
                $ct_status = $row['TASK_STATUS'];
                $ct_duedate = $row['TASK_DUEDATE'];
                $ct_customer_id = $row['CUSTOMER_ID'];
                $ct_customer_name = $row['CUSTOMER_COMPANY_NAME'];
                $ct_customer_sub_name = $row['CUSTOMER_COMPANY_SUB_NAME'];
                $ct_project_id = $row['PROJECT_ID'];


                // $ct_project_id = $row['PROJECT_ID'];
                // $ct_file  = $row['TASK_FILE'];
                // $ct_workline = $row['TYPE_ID'];
                // $project_id = $row['PROJECT_ID'];
                // $project_name = $row['PROJECT_NAME'];
                // $member_name = $row['MEMBER_FIRSTNAME'];

                $datetime = new DateTime($ct_duedate);

                $select_date = $datetime->format('Y-m-d');

                $ct_duedate = explode('-', $select_date);
                $year = $ct_duedate[0];
                $month= $ct_duedate[1];
                $day  = $ct_duedate[2];

                $time = $datetime->format('H:i:s');
                $ct_time = explode(':', $time);
                $hour = $ct_time[0];
                $minute = $ct_time[1];
                $second  = $ct_time[2];

                if ($session_member_type == "A" | $session_member_type == "P") {
                  $sql_check_complete = "SELECT * FROM vw_pm_task_match_new WHERE RECORD_STATUS = 'N' AND TASK_ID = $ct_id ORDER BY TASK_DUEDATE ";
                  $data_result_check_complete = $conn->query($sql_check_complete);
                  $data_count_check_complete = $data_result_check_complete->num_rows;



                  $count_data_complete = 0;
                  while ($row_check_complete = $data_result_check_complete->fetch_assoc()) {
                    $status_task = $row_check_complete['TASK_STATUS'];

                    if ($status_task == "c") {
                      $count_data_complete++;
                    }
                  }
                  if ($data_count_check_complete == $count_data_complete) {
                    $ct_status = "c";
                  }
                }
                ?>
                {
                  id : 9,
                    title: '<?php echo   " [".$ct_customer_sub_name."] | ".$ct_name; ?> ',
                  start: new Date(<?php echo "$year, $month-1, $day, $hour, $minute"; ?>),
                  allDay: false,
                  <?php   if ($session_member_type == 'A' | $session_member_type == 'P'){?>
                  url:'http://www.vdomaker.com/project_management/project/project.php?id=<?php echo $ct_project_id;?>&cus_id=<?php echo $ct_customer_id;?>',
                <?php }?>
                  <?php if ($session_member_type == 'S'){?>
                  url: 'http://www.vdomaker.com/project_management/staff/staff.php?id=<?php echo $ct_project_id;?>',
                <?php } ?>
                  className: '<?php if($ct_status == 'f'){echo "warning";}else if($ct_status == ''){echo "chill";}else if($ct_status == 'c'){echo "success";}else if($ct_status == 'a'){echo "important";} ?>'
                },

              <?php }
              if ($session_member_type == 'A' | $session_member_type == 'P'){
              $sql_check_project = "SELECT * FROM vw_pm_project_detail WHERE RECORD_STATUS = 'N' ";
              $data_result_project = $conn->query($sql_check_project);
              $data_count_project = $data_result_project->num_rows;

              while ($row_check_project = $data_result_project->fetch_assoc()){
                $data_project_name = $row_check_project['PROJECT_NAME'];
                $data_project_duedate = $row_check_project['PROJECT_DUEDATE'];
                $data_project_customer = $row_check_project['CUSTOMER_ID'];
                $data_project_id = $row_check_project['PROJECT_ID'];

                $project_datetime = new DateTime($data_project_duedate);
                $select_date_project = $project_datetime->format('Y-m-d');

                $data_project_duedate = explode('-', $select_date_project);
                $select_year = $data_project_duedate[0];
                $select_month= $data_project_duedate[1];
                $select_day  = $data_project_duedate[2];

                $data_project_time = $project_datetime->format('H:i:s');
                $dt_time = explode(':', $data_project_time);
                $dt_hour = $dt_time[0];
                $dt_minute = $dt_time[1];
                $dt_second  = $dt_time[2];
                ?>
                {
                  id: 9,
                  title: '<?php echo " [FINAL] | ".$data_project_name; ?>',
                  start: new Date(<?php echo "$select_year, $select_month-1, $select_day, $dt_hour, $dt_minute"; ?>),
                  allDay: false,
                  // url:'http://www.vdomaker.com/project_management/project/project.php?id=<?php echo $data_project_id;?>&cus_id=<?php echo $data_project_customer;?>',
                  className: 'info'
                },
              <?php } ?>

              <?php } ?>


            // {
            //   title: 'All Day Event',
            //   start: new Date(y, m, 1)
            // },

            // {
            //   id: 999,
            //   title: 'Repeating Event',
            //   start: new Date(y, m, d+4, 16, 0),
            //   allDay: false,
            //   className: 'info'
            // },
            // {
            //   title: 'Meeting',
            //   start: new Date(y, m, d, 10, 30),
            //   allDay: false,
            //   className: 'important'
            // },
            // {
            //   title: 'Lunch',
            //   start: new Date(y, m, d, 12, 0),
            //   end: new Date(y, m, d, 14, 0),
            //   allDay: true,
            //   className: 'important'
            // },
            // {
            //   title: 'Birthday Party',
            //   start: new Date(y, m, d+1, 19, 0),
            //   end: new Date(y, m, d+1, 22, 30),
            //   allDay: false,
            // },
            // {
            //   title: 'Click for Google',
            //   start: new Date(y, m, 28),
            //   end: new Date(y, m, 29),
            //   url: '#',
            //   className: 'success'
            // }
          ],
        });
      });
     </script>
     <style>
      body {
        /*margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
        background-color: #DDDDDD;*/
        }

      #wrap {
        width: 1100px;
        margin: 0 auto;
        }

      #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
        }

      #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        }

      .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
        }

      #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
        }

      #external-events p input {
        margin: 0;
        vertical-align: middle;
        }

      #calendar {
     /* 		float: right; */
             margin: 0 auto;
        /*width: 900px;*/
        background-color: #FFFFFF;
          border-radius: 6px;
             box-shadow: 0 1px 2px #C3C3C3;
        }
     </style>
     <!-- Calendar Error Close-->
     <!-- close Calendar -->
    <!-- <?php include("cus_add.php"); ?> -->
    </head>
    <body class="nav-md">

        <div class="container body">
            <div class="main_container">

              <?php
              include("../design/inc_design_sidebar.php");
              ?>

              <div class="right_col" role="main">
                  <div class="">
                      <br>
                      <div class="clearfix"></div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
            <!-- Form2 -->

            <div class="x_panel">
                <div class="x_title">
                    <h2>Timeline Project</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <!-- <a class="btn btn-primary" href="#Modal_Cus" data-toggle="modal" style="width:100px;"><i class="fa fa-plus-square"></i> เพิ่มรายการ</a> -->
                <!-- Open Calendar -->
                <!-- <div class="col-lg-1">
                </div> -->
                <div class="col-lg-12">
                <div id='calendar' class="col-md-12 col-sm-12 col-xs-12 col-lg-12"></div>
              </div>


                <!-- Close Calendar -->
                <!-- <div class="x_content">
              <div class="clearfix"></div>
              <form class="form-horizontal form-label-left"  enctype="multipart/form-data"  id="form1" name="form1" method="post"   >

                <div id="timeline">
                  <div class="row timeline-movement timeline-movement-top">
                  <div class="timeline-badge timeline-future-movement">
                      <a href="#">
                          <span class="glyphicon glyphicon-plus"></span>
                      </a>
                  </div>
                  <div class="timeline-badge timeline-filter-movement">
                      <a href="#">
                          <span class="glyphicon glyphicon-time"></span>
                      </a>
                  </div>

              </div>
              <?php
              while ($row = $data_result_customer->fetch_assoc()) {
                $ct_duedate = $row['TASK_DUEDATE'];

                $date_format = date_create($ct_duedate);
                $date_month = strtoupper(date_format($date_format,"M"));
                $date_day = date_format($date_format,"d");
                ?>

                  <div class="timeline-badge">
                      <span class="timeline-balloon-date-day"><?php echo "$date_day";?></span>
                      <span class="timeline-balloon-date-month"><?php echo "$date_month"; ?></span>
                  </div>

                  <?php
                  $sql_timeline = "SELECT * FROM vw_task_timeline WHERE RECORD_STATUS = 'N' AND TASK_DUEDATE = ";
                  $sql_timeline .= '"'.$ct_duedate.'" ';

                  $data_result_timeline = $conn->query($sql_timeline);
                  $data_count_timeline = $data_result_timeline->num_rows;

                    while ($row = $data_result_timeline->fetch_assoc()) {
                      $ct_id = $row['TASK_ID'];
                      $ct_name = $row['TASK_NAME'];
                      $ct_detail = $row['TASK_DETAIL'];
                      $ct_status = $row['TASK_STATUS'];
                      $ct_duedate = $row['TASK_DUEDATE'];
                      $ct_file  = $row['TASK_FILE'];
                      $ct_workline = $row['TYPE_ID'];
                      $project_id = $row['PROJECT_ID'];
                      $project_name = $row['PROJECT_NAME'];
                      $member_name = $row['MEMBER_FIRSTNAME'];

                      if ($ct_workline == 1) {
                        $workline = "Staff";
                        $wk_class = "timeline-panel debits";
                        $wk_rl = "col-sm-offset-1 col-sm-11";
                        $wk_rl1 = "col-sm-offset-6 col-sm-6  timeline-item";

                      } else if($ct_workline == 2){
                        $workline = "Outsource";
                        $wk_class = "timeline-panel debits";
                        $wk_rl = "col-sm-offset-1 col-sm-11";
                        $wk_rl1 = "col-sm-offset-6 col-sm-6  timeline-item";
                      }else if($ct_workline == 3){
                        $workline = "Customer";
                        $wk_class = "timeline-panel debits";
                        $wk_rl = "col-sm-offset-1 col-sm-11";
                        $wk_rl1 = "col-sm-offset-6 col-sm-6  timeline-item";
                      }
                      else {
                        $workline = "Manager";
                        $wk_class = "timeline-panel credits";
                        $wk_rl = "col-sm-11";
                        $wk_rl1 = "col-sm-6  timeline-item";
                      }
                      ?>
                    <div class="row timeline-movement">
                      <div class="<?php echo "$wk_rl1"; ?>">
                          <div class="row">
                              <div class="<?php echo "$wk_rl"; ?>">
                                  <div class="<?php echo "$wk_class"; ?>">
                                      <ul class="timeline-panel-ul">
                                          <li><a href="http://localhost/PROJECT_MANAGEMENT/project/project.php?id=<?= $project_id ?>" target="_self"><span style="font-size:18px;font-weight:bold;">ชื่อโปรเจ็ค :&nbsp;&nbsp;<?php echo "$project_name"; ?></span></a></li>
                                          <li><span class="importo"><?php echo "$workline"; ?> :</span>&nbsp;&nbsp;<?php echo $member_name;?><br> <?php echo "$ct_name"; ?> </li>
                                          <li><span class="causale"><?php echo "$ct_detail"; ?></span> </li>
                                          <li><p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo "$ct_duedate"; ?></small></p> </li>
                                          <li>
                                          <?php
                                          if($row['TASK_STATUS'] == 'c'){
                                            if($ct_file != ''){?>
                                            <a class="btn btn-primary btn-success" style="width:140px;" href="http://localhost/PROJECT_MANAGEMENT/pic/task/<?php echo $ct_file ;?>" target="_self" ><i class="fa fa-download"></i>&nbsp;&nbsp;ดาวน์โหลดไฟล์</a></center>
                                          <?php
                                        }else{?>
                                          <a class="btn btn-primary btn-success" style="width:140px;" href="#" target="_self" ><i class="fa fa-check"></i>&nbsp;&nbsp;ส่งงานเรียบร้อย</a></center>
                                          <?php
                                        }
                                      }else{?>
                                        <a class="btn btn-primary btn-warning" style="width:150px;" href="#" target="_self" ><i class="fa fa-refresh"></i> กำลังดำเนินการ</a></center></li>
                                      <?php
                                      }
                                          ?>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                  <?php } ?>
            <?php  } ?>
              </div>

              </from>

              </div> -->

            <!-- Form2 -->
          </div>
        </div>
      </div>


</div>
</div>
<style>

#timeline {
  list-style: none;
  position: relative;
}
#timeline:before {
  top: 0;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 2px;
  background-color: #4997cd;
  left: 50%;
  margin-left: -1.5px;
}
#timeline .clearFix {
  clear: both;
  height: 0;
}
#timeline .timeline-badge {
  color: #fff;
  width: 50px;
  height: 50px;
  font-size: 1.2em;
  text-align: center;
  position: absolute;
  top: 20px;
  left: 50%;
  margin-left: -25px;
  background-color: #4997cd;
  z-index: 100;
  border-top-right-radius: 50%;
  border-top-left-radius: 50%;
  border-bottom-right-radius: 50%;
  border-bottom-left-radius: 50%;
}
#timeline .timeline-badge span.timeline-balloon-date-day {
  font-size: 1.4em;
}
#timeline .timeline-badge span.timeline-balloon-date-month {
  font-size: .7em;
  position: relative;
  top: -10px;
}
#timeline .timeline-badge.timeline-filter-movement {
  background-color: #ffffff;
  font-size: 1.7em;
  height: 35px;
  margin-left: -18px;
  width: 35px;
  top: 40px;
}
#timeline .timeline-badge.timeline-filter-movement a span {
  color: #4997cd;
  font-size: 1.3em;
  top: -1px;
}
#timeline .timeline-badge.timeline-future-movement {
  background-color: #ffffff;
  height: 35px;
  width: 35px;
  font-size: 1.7em;
  top: -16px;
  margin-left: -18px;
}
#timeline .timeline-badge.timeline-future-movement a span {
  color: #4997cd;
  font-size: .9em;
  top: 2px;
  left: 1px;
}
#timeline .timeline-movement {
  border-bottom: dashed 1px #4997cd;
  position: relative;
}
#timeline .timeline-movement.timeline-movement-top {
  height: 60px;
}
#timeline .timeline-movement .timeline-item {
  padding: 20px 0;
}
#timeline .timeline-movement .timeline-item .timeline-panel {
  border: 1px solid #d4d4d4;
  border-radius: 3px;
  background-color: #FFFFFF;
  color: #666;
  padding: 10px;
  position: relative;
  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}
#timeline .timeline-movement .timeline-item .timeline-panel .timeline-panel-ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
#timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul {
  text-align: right;
}
#timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul li {
  color: #666;
}
#timeline .timeline-movement .timeline-item .timeline-panel.credits .timeline-panel-ul li span.importo {
  color: #468c1f;
  font-size: 1.3em;
}
#timeline .timeline-movement .timeline-item .timeline-panel.debits .timeline-panel-ul {
  text-align: left;
}
#timeline .timeline-movement .timeline-item .timeline-panel.debits .timeline-panel-ul span.importo {
  color: #e2001a;
  font-size: 1.3em;
}
</style>
<?php
include("user_profile.php");
?>
<!-- jQuery -->
<!-- <script src="../vendors/jquery/dist/jquery.min.js"></script> -->

<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>

<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>

<!-- validator -->
<script src="../vendors/validator/validator.js"></script>

<!-- jquery.inputmask -->
<!-- <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script> -->

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
<?php mysqli_close($conn); ?>
