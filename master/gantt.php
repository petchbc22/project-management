<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>Teamwork</title>

  <link rel=stylesheet href="platform.css" type="text/css">
  <link rel=stylesheet href="libs/jquery/dateField/jquery.dateField.css" type="text/css">

  <link rel=stylesheet href="gantt.css" type="text/css">
  <link rel=stylesheet href="ganttPrint.css" type="text/css" media="print">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <script src="libs/jquery/jquery.livequery.1.1.1.min.js"></script>
  <script src="libs/jquery/jquery.timers.js"></script>

  <script src="libs/utilities.js"></script>
  <script src="libs/forms.js"></script>
  <script src="libs/date.js"></script>
  <script src="libs/dialogs.js"></script>
  <script src="libs/layout.js"></script>
  <script src="libs/i18nJs.js"></script>
  <script src="libs/jquery/dateField/jquery.dateField.js"></script>
  <script src="libs/jquery/JST/jquery.JST.js"></script>

  <script type="text/javascript" src="libs/jquery/svg/jquery.svg.min.js"></script>
  <script type="text/javascript" src="libs/jquery/svg/jquery.svgdom.1.8.js"></script>


  <script src="ganttUtilities.js"></script>
  <script src="ganttTask.js"></script>
  <script src="ganttDrawerSVG.js"></script>
  <script src="ganttZoom.js"></script>
  <script src="ganttGridEditor.js"></script>
  <script src="ganttMaster.js"></script>


  <!--<script src="libs/profiling.js"></script>-->
  <!--<script type="text/javascript" src="ganttTestSuite.js"></script>-->
</head>
<body style="background-color: #fff;">
  <?php
    include '../appsystem/inc_config.php';
    $sql_noti = "SELECT * FROM project WHERE pj_status = 'N' ";
    $sql_acc_noti_result = $conn->query($sql_noti);
    $sql_acc_noti_count = $sql_acc_noti_result->num_rows;

   //  if($ss_acc_permission == 0 || $ss_acc_permission == 1){
   //
   //
   // while ($acc_result_noti = mysqli_fetch_array($sql_acc_noti_result, MYSQLI_ASSOC)) {
   //   $pj_process_title = $acc_result_noti["pj_process_title"];
   //   $pj_id = $acc_result_noti["pj_id"];
   //   $pjt_start = $acc_result_noti["pj_process_start"];
   //   $pjt_duedate = $acc_result_noti["pj_process_deadline"];
   //   $pj_day = $acc_result_noti["pj_dayofwork"];
   //
   //
   //
   //
   //   // $pjt_start = date("Y-m-d H:i:s", mktime(date("d")-2));
   //   // $stamp_start = date("Y-m-d H:i:s", strtotime("+21 day", strtotime($pjt_start)));
   //   // $stamp_start = date("Y-m-d H:i:s", mktime(date("H",$stamp_start)+0, date("i",$stamp_start)+0, date("s",$stamp_start)+0, date("m",$stamp_start)+20  , date("d",$stamp_start)+0, date("Y",$stamp_start)+0));
   //
   //   $stamp_start = strtotime($pjt_start);
   //   $stamp = strtotime($pjt_duedate);
   //   $pj_day = $pj_day + 1;
   //   // echo $myDate;
   //   // $stamp = strtotime($myDate);
   //   $time_in_start = $stamp_start*1000;
   //   $time_in_ms = $stamp*1000;
   //   echo "show ".$time_in_start."<br>";
   //   echo "showend ".$time_in_ms."<br>";
   // }
// }
    ?>


<!-- <div id="ndo" style="position:absolute;right:5px;top:5px;width:378px;padding:5px;background-color: #FFF5E6; border:1px solid #F9A22F; font-size:12px" class="noprint">
  This Gantt editor is free thanks to <a href="http://twproject.com" target="_blank">Twproject</a> where it can be used on a complete and flexible project management solution.<br> Get your projects done! Give <a href="http://twproject.com" target="_blank">Twproject a try now</a>.
</div> -->
<div id="workSpace" style="padding:0px; overflow-y:auto; overflow-x:hidden;border:1px solid #e5e5e5;position:relative;margin:0 5px"></div>

<style>
  .resEdit {
    padding: 15px;
  }

  .resLine {
    width: 95%;
    padding: 3px;
    margin: 5px;
    border: 1px solid #d0d0d0;
  }

  body {
    overflow: hidden;
  }

  .ganttButtonBar h1{
    color: #000000;
    font-weight: bold;
    font-size: 28px;
    margin-left: 10px;
  }

</style>

<form id="gimmeBack" style="display:none;" action="../gimmeBack.jsp" method="post" target="_blank"><input type="hidden" name="prj" id="gimBaPrj"></form>

<script type="text/javascript">

var ge;
$(function() {
  var canWrite=true; //this is the default for test purposes

  // here starts gantt initialization
  ge = new GanttMaster();
  ge.set100OnClose=true;

  ge.shrinkParent=true;

  ge.init($("#workSpace"));
  loadI18n(); //overwrite with localized ones

  //in order to force compute the best-fitting zoom level
  delete ge.gantt.zoom;

  var project=loadFromLocalStorage();

  if (!project.canWrite)
    $(".ganttButtonBar button.requireWrite").attr("disabled","true");

  ge.loadProject(project);
  ge.checkpoint(); //empty the undo stack
});



function getDemoProject(){
  //console.debug("getDemoProject")
ret= {"tasks":   [
  <?php
   if($ss_acc_permission == 0 || $ss_acc_permission == 1){


  while ($acc_result_noti = mysqli_fetch_array($sql_acc_noti_result, MYSQLI_ASSOC)) {
    $pj_process_title = $acc_result_noti["pj_process_title"];
    $pj_id = $acc_result_noti["pj_id"];
    $pjt_start = $acc_result_noti["pj_process_start"];
    $pjt_duedate = $acc_result_noti["pj_process_deadline"];
    $pj_day = $acc_result_noti["pj_dayofwork"];




    // $pjt_start = date("Y-m-d H:i:s", mktime(date("d")-2));
    // $stamp_start = date("Y-m-d H:i:s", strtotime("+21 day", strtotime($pjt_start)));
    // $stamp_start = date("Y-m-d H:i:s", mktime(date("H",$stamp_start)+0, date("i",$stamp_start)+0, date("s",$stamp_start)+0, date("m",$stamp_start)+20  , date("d",$stamp_start)+0, date("Y",$stamp_start)+0));

    $stamp_start = strtotime($pjt_start);
    $stamp = strtotime($pjt_duedate);
    $pj_day = $pj_day + 1;
    // echo $myDate;
    // $stamp = strtotime($myDate);
    $time_in_start = $stamp_start*1000;
    $time_in_ms = $stamp*1000;
  ?>

      {"id": <?php echo "-".$pj_id; ?>, "name": "<?php echo "$pj_process_title"; ?>", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "<?php if($pjt_complete_user == 0){ echo "STATUS_SUSPENDED"; } else if($pjt_complete_user == 1){ echo "STATUS_ACTIVE"; }?>", "depends": "", "canWrite": true, "start": <?php echo "$time_in_start"; ?>, "duration":<?php echo $pj_day; ?>, "end": <?php echo $time_in_ms; ?>,  "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
      // {"id": <?php echo $pj_id; ?>, "name": "<?php echo $pj_process_title; ?>", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": <?php echo $time_in_start; ?>, "duration": 10, "end": <?php echo $time_in_ms; ?>, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
    <?php
      $sql_noti1 = "SELECT * FROM project_task WHERE pj_id = '$pj_id' AND pjt_status = 'N' ";
      $sql_acc_noti_result1 = $conn->query($sql_noti1);
      $sql_acc_noti_count1 = $sql_acc_noti_result1->num_rows;
      while ($acc_result_noti1 = mysqli_fetch_array($sql_acc_noti_result1, MYSQLI_ASSOC)) {
        $pjt_id = $acc_result_noti1["pjt_id"];
        $pjt_title = $acc_result_noti1["pjt_title"];
        $pjt_start = $acc_result_noti1["pjt_starteddate"];
        $pjt_duedate1 = $acc_result_noti1["pjt_duedate"];
        $pjt_complete_user = $acc_result_noti1["pjt_complete"];
        $pjt_dayofwork = $acc_result_noti1["pjt_dayofwork"];

        $stamp0 = strtotime($pjt_start);
        $stamp1 = strtotime($pjt_duedate1);

        $start_time_in_ms_1 = $stamp0*1000;
        $end_time_in_ms_1 = $stamp1*1000;
      ?>
      {"id": <?php echo $pjt_id; ?>, "name": "<?php echo "- ".$pjt_title;?>", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "<?php if($pjt_complete_user == 0){ echo "STATUS_SUSPENDED"; } else if($pjt_complete_user == 1){ echo "STATUS_ACTIVE"; }?>", "depends": "", "canWrite": true, "start": <?php echo $start_time_in_ms_1; ?>, "duration": <?php echo $pjt_dayofwork; ?>,"end": <?php echo $end_time_in_ms_1; ?>, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      // {"id": 4, "name": "editor part", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "3", "canWrite": true, "start": 1397167200000, "duration": 4, "end": 1397685599999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      // {"id": 5, "name": "testing", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 1, "status": "STATUS_SUSPENDED", "depends": "2:5", "canWrite": true, "start": 1398981600000, "duration": 5, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},
      // {"id": 6, "name": "test on safari", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "", "canWrite": true, "start": 1398981600000, "duration": 2, "end": 1399327199999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      // {"id": 7, "name": "test on ie", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 3, "end": 1399586399999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
      // {"id": 8, "name": "test on chrome", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "STATUS_SUSPENDED", "depends": "6", "canWrite": true, "start": 1399327200000, "duration": 2, "end": 1399499999999, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false}
<?php
}
 }
} else {

  $sql_noti5 = "SELECT * FROM project_main_assign_user WHERE acc_id = '$ss_acc_id' AND pmau_status = 'N' ";
  $sql_acc_noti_result5 = $conn->query($sql_noti5);
  $sql_acc_noti_count5 = $sql_acc_noti_result5->num_rows;

    while ($acc_result_noti5 = mysqli_fetch_array($sql_acc_noti_result5, MYSQLI_ASSOC)) {
      $pj_id2 = $acc_result_noti5["pj_id"];

      $sql_noti6 = "SELECT * FROM project WHERE pj_id = '$pj_id2' AND pj_status = 'N' ";
      $sql_acc_noti_result6 = $conn->query($sql_noti6);
      $sql_acc_noti_count6 = $sql_acc_noti_result6->num_rows;

      while ($acc_result_noti6 = mysqli_fetch_array($sql_acc_noti_result6, MYSQLI_ASSOC)) {
        $pj_process_title6 = $acc_result_noti6["pj_process_title"];
        $pj_id3 = $acc_result_noti6["pj_id"];
        $pjt_duedate6 = $acc_result_noti6["pj_process_deadline"];
        $pj_process_start = $acc_result_noti6["pj_process_start"];
        $pj_day = $acc_result_noti6["pj_dayofwork"];

        $stamp_start = strtotime($pj_process_start);
        $stamp6 = strtotime($pjt_duedate6);
        // echo $myDate;
        // $stamp = strtotime($myDate);
        $time_in_ms_start = $stamp_start*1000;
        $time_in_ms6 = $stamp6*1000;
        ?>
        {"id": <?php echo $pj_id3; ?>, "name": "<?php echo $pj_process_title6; ?>", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 0, "status": "STATUS_ACTIVE", "depends": "", "canWrite": true, "start": <?php echo $time_in_ms6; ?>, "duration": <?php echo $pj_day; ?>, "end": <?php echo $time_in_ms6; ?>, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": true},


        <?php
        $sql_noti7 = "SELECT * FROM project_assign_user WHERE acc_id = '$ss_acc_id' AND pau_status = 'N' ";
        $sql_acc_noti_result7 = $conn->query($sql_noti7);
        $sql_acc_noti_count7 = $sql_acc_noti_result7->num_rows;

        while ($acc_result_noti7 = mysqli_fetch_array($sql_acc_noti_result7, MYSQLI_ASSOC)) {
        $pjt_id_user = $acc_result_noti7["pjt_id"];

        $sql_noti8 = "SELECT * FROM project_task WHERE pjt_id = '$pjt_id_user' AND pjt_status = 'N' ";
        $sql_acc_noti_result8 = $conn->query($sql_noti8);
        $sql_acc_noti_count8 = $sql_acc_noti_result8->num_rows;

          while ($acc_result_noti8 = mysqli_fetch_array($sql_acc_noti_result8, MYSQLI_ASSOC)) {
            $pjt_id_user = $acc_result_noti8["pjt_id"];
            $pjt_title8 = $acc_result_noti8["pjt_title"];
            $pjt_start8 = $acc_result_noti8["pjt_starteddate"];
            $pjt_duedate8 = $acc_result_noti8["pjt_duedate"];
            $pjt_complete_user = $acc_result_noti8["pjt_complete"];
            $pjt_dayofwork = $acc_result_noti8["pjt_dayofwork"];



            $stamp8 = strtotime($pjt_start8);
            $stamp9 = strtotime($pjt_duedate8);

            $start_time_in_ms_8 = $stamp8*1000;
            $end_time_in_ms_9 = $stamp9*1000;

            ?>

            {"id": <?php echo $pjt_id_user; ?>, "name": "<?php echo $pjt_title8;?>", "progress": 0, "progressByWorklog": false, "relevance": 0, "type": "", "typeId": "", "description": "", "code": "", "level": 2, "status": "<?php if($pjt_complete_user == 0){ echo "STATUS_SUSPENDED"; } else if($pjt_complete_user == 1){ echo "STATUS_ACTIVE"; }?>", "depends": "", "canWrite": true, "start": <?php echo $start_time_in_ms_8; ?>, "duration": <?php echo $pjt_dayofwork; ?>, "end": <?php echo $end_time_in_ms_9; ?>, "startIsMilestone": false, "endIsMilestone": false, "collapsed": false, "assigs": [], "hasChild": false},
<?php
          }

      }
}
    }

  ?>

<?php } ?>
    ],}


    //actualize data
    var offset=new Date().getTime()-ret.tasks[0].start;
    for (var i=0;i<ret.tasks.length;i++) {
      ret.tasks[i].start = ret.tasks[i].start + offset;
    }
  return ret;
}



function loadGanttFromServer(taskId, callback) {

  //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
  var ret=loadFromLocalStorage();

  //this is the real implementation
  /*
  //var taskId = $("#taskSelector").val();
  var prof = new Profiler("loadServerSide");
  prof.reset();

  $.getJSON("ganttAjaxController.jsp", {CM:"LOADPROJECT",taskId:taskId}, function(response) {
    //console.debug(response);
    if (response.ok) {
      prof.stop();

      ge.loadProject(response.project);
      ge.checkpoint(); //empty the undo stack

      if (typeof(callback)=="function") {
        callback(response);
      }
    } else {
      jsonErrorHandling(response);
    }
  });
  */

  return ret;
}


function saveGanttOnServer() {

  //this is a simulation: save data to the local storage or to the textarea
  saveInLocalStorage();

  /*
  var prj = ge.saveProject();

  delete prj.resources;
  delete prj.roles;

  var prof = new Profiler("saveServerSide");
  prof.reset();

  if (ge.deletedTaskIds.length>0) {
    if (!confirm("TASK_THAT_WILL_BE_REMOVED\n"+ge.deletedTaskIds.length)) {
      return;
    }
  }

  $.ajax("ganttAjaxController.jsp", {
    dataType:"json",
    data: {CM:"SVPROJECT",prj:JSON.stringify(prj)},
    type:"POST",

    success: function(response) {
      if (response.ok) {
        prof.stop();
        if (response.project) {
          ge.loadProject(response.project); //must reload as "tmp_" ids are now the good ones
        } else {
          ge.reset();
        }
      } else {
        var errMsg="Errors saving project\n";
        if (response.message) {
          errMsg=errMsg+response.message+"\n";
        }

        if (response.errorMessages.length) {
          errMsg += response.errorMessages.join("\n");
        }

        alert(errMsg);
      }
    }

  });
  */
}

function newProject(){
  clearGantt();
}


function clearGantt() {
  ge.reset();
}

//-------------------------------------------  Get project file as JSON (used for migrate project from gantt to Teamwork) ------------------------------------------------------
function getFile() {
  $("#gimBaPrj").val(JSON.stringify(ge.saveProject()));
  $("#gimmeBack").submit();
  $("#gimBaPrj").val("");

  /*  var uriContent = "data:text/html;charset=utf-8," + encodeURIComponent(JSON.stringify(prj));
   neww=window.open(uriContent,"dl");*/
}


function loadFromLocalStorage() {
  var ret;
  if (localStorage) {
    if (localStorage.getObject("teamworkGantDemo")) {
      ret = localStorage.getObject("teamworkGantDemo");
    }
  }

  //if not found create a new example task
  if (!ret || !ret.tasks || ret.tasks.length == 0){
    ret=getDemoProject();
  }
  return ret;
}


function saveInLocalStorage() {
  var prj = ge.saveProject();
  if (localStorage) {
    localStorage.setObject("teamworkGantDemo", prj);
  }
}


//-------------------------------------------  Open a black popup for managing resources. This is only an axample of implementation (usually resources come from server) ------------------------------------------------------
function editResources(){

  //make resource editor
  var resourceEditor = $.JST.createFromTemplate({}, "RESOURCE_EDITOR");
  var resTbl=resourceEditor.find("#resourcesTable");

  for (var i=0;i<ge.resources.length;i++){
    var res=ge.resources[i];
    resTbl.append($.JST.createFromTemplate(res, "RESOURCE_ROW"))
  }


  //bind add resource
  resourceEditor.find("#addResource").click(function(){
    resTbl.append($.JST.createFromTemplate({id:"new",name:"resource"}, "RESOURCE_ROW"))
  });

  //bind save event
  resourceEditor.find("#resSaveButton").click(function(){
    var newRes=[];
    //find for deleted res
    for (var i=0;i<ge.resources.length;i++){
      var res=ge.resources[i];
      var row = resourceEditor.find("[resId="+res.id+"]");
      if (row.length>0){
        //if still there save it
        var name = row.find("input[name]").val();
        if (name && name!="")
          res.name=name;
        newRes.push(res);
      } else {
        //remove assignments
        for (var j=0;j<ge.tasks.length;j++){
          var task=ge.tasks[j];
          var newAss=[];
          for (var k=0;k<task.assigs.length;k++){
            var ass=task.assigs[k];
            if (ass.resourceId!=res.id)
              newAss.push(ass);
          }
          task.assigs=newAss;
        }
      }
    }

    //loop on new rows
    var cnt=0
    resourceEditor.find("[resId=new]").each(function(){
      cnt++;
      var row = $(this);
      var name = row.find("input[name]").val();
      if (name && name!="")
        newRes.push (new Resource("tmp_"+new Date().getTime()+"_"+cnt,name));
    });

    ge.resources=newRes;

    closeBlackPopup();
    ge.redraw();
  });


  var ndo = createModalPopup(400, 500).append(resourceEditor);
}

function initializeHistoryManagement(){

  //si chiede al server se c'è della hisory per la root
  $.getJSON(contextPath+"/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID:10236}, function (response) {

    //se c'è
    if (response.ok == true && response.historyPoints && response.historyPoints.length>0) {

      //si crea il bottone sulla bottoniera
      var histBtn = $("<button>").addClass("button textual icon lreq30 lreqLabel").attr("title", "SHOW_HISTORY").append("<span class=\"teamworkIcon\">&#x60;</span>");

      //al click
      histBtn .click(function () {
        var el = $(this);
        var ganttButtons = $(".ganttButtonBar .buttons");

        //è gi�  in modalit�  history?
        if (!ge.element.is(".historyOn")) {
          ge.element.addClass("historyOn");
          ganttButtons.find(".requireCanWrite").hide();

          //si carica la history server side
          if (false) return;
          showSavingMessage();
          $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTPOINTS", OBJID: ge.tasks[0].id}, function (response) {
            jsonResponseHandling(response);
            hideSavingMessage();
            if (response.ok == true) {
              var dh = response.historyPoints;
              //ge.historyPoints=response.historyPoints;
              if (dh && dh.length > 0) {
                //si crea il div per lo slider
                var sliderDiv = $("<div>").prop("id", "slider").addClass("lreq30 lreqHide").css({"display":"inline-block","width":"500px"});
                ganttButtons.append(sliderDiv);

                var minVal = 0;
                var maxVal = dh.length-1 ;

                $("#slider").show().mbSlider({
                  rangeColor : '#2f97c6',
                  minVal     : minVal,
                  maxVal     : maxVal,
                  startAt    : maxVal,
                  showVal    : false,
                  grid       :1,
                  formatValue: function (val) {
                    return new Date(dh[val]).format();
                  },
                  onSlideLoad: function (obj) {
                    this.onStop(obj);

                  },
                  onStart    : function (obj) {},
                  onStop     : function (obj) {
                    var val = $(obj).mbgetVal();
                    showSavingMessage();
                    $.getJSON(contextPath + "/applications/teamwork/task/taskAjaxController.jsp", {CM: "GETGANTTHISTORYAT", OBJID: ge.tasks[0].id, millis:dh[val]}, function (response) {
                      jsonResponseHandling(response);
                      hideSavingMessage();
                      if (response.ok ) {
                        ge.baselines=response.baselines;
                        ge.showBaselines=true;
                        ge.baselineMillis=dh[val];
                        ge.redraw();
                      }
                    })

                  },
                  onSlide    : function (obj) {
                    clearTimeout(obj.renderHistory);
                    var self = this;
                    obj.renderHistory = setTimeout(function(){
                      self.onStop(obj);
                    }, 200)

                  }
                });
              }
            }
          });
          // quando si spenge
        } else {
          //si cancella lo slider
          $("#slider").remove();
          ge.element.removeClass("historyOn");
          if (ge.permissions.canWrite)
            ganttButtons.find(".requireCanWrite").show();

          ge.showBaselines=false;
          ge.baselineMillis=undefined;
          ge.redraw();
        }

      });
      $("#saveGanttButton").before(histBtn);
    }
  })
}

function showBaselineInfo (event,element){
  //alert(element.attr("data-label"));
  $(element).showBalloon(event, $(element).attr("data-label"));
  ge.splitter.secondBox.one("scroll",function(){
    $(element).hideBalloon();
  })
}

</script>





<div id="gantEditorTemplates" style="display:none;">
<div class="__template__" type="GANTBUTTONS"><!--
  <div class="ganttButtonBar noprint">
    <div class="buttons">
      <a href="https://gantt.twproject.com/"><img src="res/twGanttLogo.png" alt="Twproject" align="absmiddle" style="max-width: 136px; padding-right: 15px"></a>


    <span class="ganttButtonSeparator"></span>
      <button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="zoom out"><span class="teamworkIcon">)</span></button>
      <button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="zoom in"><span class="teamworkIcon">(</span></button>
    <span class="ganttButtonSeparator"></span>

      <button onclick="ge.splitter.resize(.1);return false;" class="button textual icon" ><span class="teamworkIcon">F</span></button>
      <button onclick="ge.splitter.resize(50);return false;" class="button textual icon" ><span class="teamworkIcon">O</span></button>
      <button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon">R</span></button>
      <span class="ganttButtonSeparator"></span>


      &nbsp; &nbsp; &nbsp; &nbsp;


    <button class="button login" title="login/enroll" onclick="loginEnroll($(this));" style="display:none;">login/enroll</button>
    <button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));" style="display:none;"><em>collaborate</em></button>
    </div></div>
  --></div>

<div class="__template__" type="TASKSEDITHEAD"><!--
  <table class="gdfTable" cellspacing="0" cellpadding="0">
    <thead>
    <tr style="height:40px">
      <th class="gdfColHeader" style="width:35px; border-right: none"></th>
      <th class="gdfColHeader" style="width:25px;"></th>
      <th class="gdfColHeader gdfResizable" style="width:100px;">code/short name</th>
      <th class="gdfColHeader gdfResizable" style="width:300px;">name</th>
      <th class="gdfColHeader"  align="center" style="width:17px;" title="Start date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">start</th>
      <th class="gdfColHeader"  align="center" style="width:17px;" title="End date is a milestone."><span class="teamworkIcon" style="font-size: 8px;">^</span></th>
      <th class="gdfColHeader gdfResizable" style="width:80px;">End</th>
      <th class="gdfColHeader gdfResizable" style="width:50px;">dur.</th>
      <th class="gdfColHeader gdfResizable" style="width:20px;">%</th>
      <th class="gdfColHeader gdfResizable requireCanSeeDep" style="width:50px;">depe.</th>
      <th class="gdfColHeader gdfResizable" style="width:1000px; text-align: left; padding-left: 10px;">assignees</th>
    </tr>
    </thead>
  </table>
  --></div>

<div class="__template__" type="TASKROW"><!--
  <tr id="tid_(#=obj.id#)" taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
    <th class="gdfCell edit" align="right" style="cursor:pointer;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span> <span class="teamworkIcon" style="font-size:12px;" >e</span></th>
    <td class="gdfCell noClip" align="center"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
    <td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)" placeholder="code/short name"></td>
    <td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
      <div class="exp-controller" align="center"></div>
      <input type="text" name="name" value="(#=obj.name#)" placeholder="name">
    </td>
    <td class="gdfCell" align="center"><input type="checkbox" name="startIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="start"  value="" class="date"></td>
    <td class="gdfCell" align="center"><input type="checkbox" name="endIsMilestone"></td>
    <td class="gdfCell"><input type="text" name="end" value="" class="date"></td>
    <td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)"></td>
    <td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":""#)></td>
    <td class="gdfCell requireCanSeeDep"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#)></td>
    <td class="gdfCell taskAssigs">(#=obj.getAssigsString()#)</td>
  </tr>
  --></div>

<div class="__template__" type="TASKEMPTYROW"><!--
  <tr class="taskEditRow emptyRow" >
    <th class="gdfCell" align="right"></th>
    <td class="gdfCell noClip" align="center"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell"></td>
    <td class="gdfCell requireCanSeeDep"></td>
    <td class="gdfCell"></td>
  </tr>
  --></div>

<div class="__template__" type="TASKBAR"><!--
  <div class="taskBox taskBoxDiv" taskId="(#=obj.id#)" >
    <div class="layout (#=obj.hasExternalDep?'extDep':''#)">
      <div class="taskStatus" status="(#=obj.status#)"></div>
      <div class="taskProgress" style="width:(#=obj.progress>100?100:obj.progress#)%; background-color:(#=obj.progress>100?'red':'rgb(153,255,51);'#);"></div>
      <div class="milestone (#=obj.startIsMilestone?'active':''#)" ></div>

      <div class="taskLabel"></div>
      <div class="milestone end (#=obj.endIsMilestone?'active':''#)" ></div>
    </div>
  </div>
  --></div>


<div class="__template__" type="CHANGE_STATUS"><!--
    <div class="taskStatusBox">
    <div class="taskStatus cvcColorSquare" status="STATUS_ACTIVE" title="Active"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_DONE" title="Completed"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_FAILED" title="Failed"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_SUSPENDED" title="Suspended"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_WAITING" title="Waiting" style="display: none;"></div>
    <div class="taskStatus cvcColorSquare" status="STATUS_UNDEFINED" title="Undefined"></div>
    </div>
  --></div>




<div class="__template__" type="TASK_EDITOR"><!--
  <div class="ganttTaskEditor">
    <h2 class="taskData">Task editor</h2>
    <table  cellspacing="1" cellpadding="5" width="100%" class="taskData table" border="0">
          <tr>
        <td width="200" style="height: 80px"  valign="top">
          <label for="code">code/short name</label><br>
          <input type="text" name="code" id="code" value="" size=15 class="formElements" autocomplete='off' maxlength=255 style='width:100%' oldvalue="1">
        </td>
        <td colspan="3" valign="top"><label for="name" class="required">name</label><br><input type="text" name="name" id="name"class="formElements" autocomplete='off' maxlength=255 style='width:100%' value="" required="true" oldvalue="1"></td>
          </tr>


      <tr class="dateRow">
        <td nowrap="">
          <div style="position:relative">
            <label for="start">start</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="startIsMilestone" name="startIsMilestone" value="yes"> &nbsp;<label for="startIsMilestone">is milestone</label>&nbsp;
            <br><input type="text" name="start" id="start" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
            <span title="calendar" id="starts_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>          </div>
        </td>
        <td nowrap="">
          <label for="end">End</label>&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" id="endIsMilestone" name="endIsMilestone" value="yes"> &nbsp;<label for="endIsMilestone">is milestone</label>&nbsp;
          <br><input type="text" name="end" id="end" size="8" class="formElements dateField validated date" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DATE">
          <span title="calendar" id="ends_inputDate" class="teamworkIcon openCalendar" onclick="$(this).dateField({inputField:$(this).prevAll(':input:first'),isSearchField:false});">m</span>
        </td>
        <td nowrap="" >
          <label for="duration" class=" ">Days</label><br>
          <input type="text" name="duration" id="duration" size="4" class="formElements validated durationdays" title="Duration is in working days." autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="DURATIONDAYS">&nbsp;
        </td>
      </tr>

      <tr>
        <td  colspan="2">
          <label for="status" class=" ">status</label><br>
          <select id="status" name="status" class="taskStatus" status="(#=obj.status#)"  onchange="$(this).attr('STATUS',$(this).val());">
            <option value="STATUS_ACTIVE" class="taskStatus" status="STATUS_ACTIVE" >active</option>
            <option value="STATUS_WAITING" class="taskStatus" status="STATUS_WAITING" >suspended</option>
            <option value="STATUS_SUSPENDED" class="taskStatus" status="STATUS_SUSPENDED" >suspended</option>
            <option value="STATUS_DONE" class="taskStatus" status="STATUS_DONE" >completed</option>
            <option value="STATUS_FAILED" class="taskStatus" status="STATUS_FAILED" >failed</option>
            <option value="STATUS_UNDEFINED" class="taskStatus" status="STATUS_UNDEFINED" >undefined</option>
          </select>
        </td>

        <td valign="top" nowrap>
          <label>progress</label><br>
          <input type="text" name="progress" id="progress" size="7" class="formElements validated percentile" autocomplete="off" maxlength="255" value="" oldvalue="1" entrytype="PERCENTILE">
        </td>
      </tr>

          </tr>
          <tr>
            <td colspan="4">
              <label for="description">Description</label><br>
              <textarea rows="3" cols="30" id="description" name="description" class="formElements" style="width:100%"></textarea>
            </td>
          </tr>
        </table>

    <h2>Assignments</h2>
  <table  cellspacing="1" cellpadding="0" width="100%" id="assigsTable">
    <tr>
      <th style="width:100px;">name</th>
      <th style="width:70px;">Role</th>
      <th style="width:30px;">est.wklg.</th>
      <th style="width:30px;" id="addAssig"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
    </tr>
  </table>

  <div style="text-align: right; padding-top: 20px">
    <span id="saveButton" class="button first" onClick="$(this).trigger('saveFullEditor.gantt');">Save</span>
  </div>

  </div>
  --></div>



<div class="__template__" type="ASSIGNMENT_ROW"><!--
  <tr taskId="(#=obj.task.id#)" assId="(#=obj.assig.id#)" class="assigEditRow" >
    <td ><select name="resourceId"  class="formElements" (#=obj.assig.id.indexOf("tmp_")==0?"":"disabled"#) ></select></td>
    <td ><select type="select" name="roleId"  class="formElements"></select></td>
    <td ><input type="text" name="effort" value="(#=getMillisInHoursMinutes(obj.assig.effort)#)" size="5" class="formElements"></td>
    <td align="center"><span class="teamworkIcon delAssig del" style="cursor: pointer">d</span></td>
  </tr>
  --></div>



<div class="__template__" type="RESOURCE_EDITOR"><!--
  <div class="resourceEditor" style="padding: 5px;">

    <h2>Project team</h2>
    <table  cellspacing="1" cellpadding="0" width="100%" id="resourcesTable">
      <tr>
        <th style="width:100px;">name</th>
        <th style="width:30px;" id="addResource"><span class="teamworkIcon" style="cursor: pointer">+</span></th>
      </tr>
    </table>

    <div style="text-align: right; padding-top: 20px"><button id="resSaveButton" class="button big">Save</button></div>
  </div>
  --></div>



<div class="__template__" type="RESOURCE_ROW"><!--
  <tr resId="(#=obj.id#)" class="resRow" >
    <td ><input type="text" name="name" value="(#=obj.name#)" style="width:100%;" class="formElements"></td>
    <td align="center"><span class="teamworkIcon delRes del" style="cursor: pointer">d</span></td>
  </tr>
  --></div>


</div>
<script type="text/javascript">
  $.JST.loadDecorator("RESOURCE_ROW", function(resTr, res){
    resTr.find(".delRes").click(function(){$(this).closest("tr").remove()});
  });

  $.JST.loadDecorator("ASSIGNMENT_ROW", function(assigTr, taskAssig){
    var resEl = assigTr.find("[name=resourceId]");
    var opt = $("<option>");
    resEl.append(opt);
    for(var i=0; i< taskAssig.task.master.resources.length;i++){
      var res = taskAssig.task.master.resources[i];
      opt = $("<option>");
      opt.val(res.id).html(res.name);
      if(taskAssig.assig.resourceId == res.id)
        opt.attr("selected", "true");
      resEl.append(opt);
    }
    var roleEl = assigTr.find("[name=roleId]");
    for(var i=0; i< taskAssig.task.master.roles.length;i++){
      var role = taskAssig.task.master.roles[i];
      var optr = $("<option>");
      optr.val(role.id).html(role.name);
      if(taskAssig.assig.roleId == role.id)
        optr.attr("selected", "true");
      roleEl.append(optr);
    }

    if(taskAssig.task.master.permissions.canWrite && taskAssig.task.canWrite){
      assigTr.find(".delAssig").click(function(){
        var tr = $(this).closest("[assId]").fadeOut(200, function(){$(this).remove()});
      });
    }

  });


  function loadI18n(){
    GanttMaster.messages = {
      "CANNOT_WRITE":"No permission to change the following task:",
      "CHANGE_OUT_OF_SCOPE":"Project update not possible as you lack rights for updating a parent project.",
      "START_IS_MILESTONE":"Start date is a milestone.",
      "END_IS_MILESTONE":"End date is a milestone.",
      "TASK_HAS_CONSTRAINTS":"Task has constraints.",
      "GANTT_ERROR_DEPENDS_ON_OPEN_TASK":"Error: there is a dependency on an open task.",
      "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK":"Error: due to a descendant of a closed task.",
      "TASK_HAS_EXTERNAL_DEPS":"This task has external dependencies.",
      "GANNT_ERROR_LOADING_DATA_TASK_REMOVED":"GANNT_ERROR_LOADING_DATA_TASK_REMOVED",
      "CIRCULAR_REFERENCE":"Circular reference.",
      "CANNOT_DEPENDS_ON_ANCESTORS":"Cannot depend on ancestors.",
      "INVALID_DATE_FORMAT":"The data inserted are invalid for the field format.",
      "GANTT_ERROR_LOADING_DATA_TASK_REMOVED":"An error has occurred while loading the data. A task has been trashed.",
      "CANNOT_CLOSE_TASK_IF_OPEN_ISSUE":"Cannot close a task with open issues",
      "TASK_MOVE_INCONSISTENT_LEVEL":"You cannot exchange tasks of different depth.",
      "CANNOT_MOVE_TASK":"CANNOT_MOVE_TASK",
      "PLEASE_SAVE_PROJECT":"PLEASE_SAVE_PROJECT",
      "GANTT_SEMESTER":"Semester",
      "GANTT_SEMESTER_SHORT":"s.",
      "GANTT_QUARTER":"Quarter",
      "GANTT_QUARTER_SHORT":"q.",
      "GANTT_WEEK":"Week",
      "GANTT_WEEK_SHORT":"w."
    };
  }



  function createNewResource(el) {
    var row = el.closest("tr[taskid]");
    var name = row.find("[name=resourceId_txt]").val();
    var url = contextPath + "/applications/teamwork/resource/resourceNew.jsp?CM=ADD&name=" + encodeURI(name);

    openBlackPopup(url, 700, 320, function (response) {
      //fillare lo smart combo
      if (response && response.resId && response.resName) {
        //fillare lo smart combo e chiudere l'editor
        row.find("[name=resourceId]").val(response.resId);
        row.find("[name=resourceId_txt]").val(response.resName).focus().blur();
      }

    });
  }
</script>






</body>
</html>
