//Process Detail :: Deadline มีตัวเดียว
function deadline(){
    var x = document.getElementById("ProcessDeadline-select").value;
    var y = 'Notset';
    var z = 'Afterprocessstart';
    if(x == y){
        document.getElementById("ProcessDeadline-day").disabled = true;
        document.getElementById("ProcessDeadline-chocie").disabled = true;
    }else if(x == z){
        document.getElementById("ProcessDeadline-day").disabled = false;
        document.getElementById("ProcessDeadline-chocie").disabled = false;
    }
}
// Task+Approval Detail ::  Due date ใช้ได้กับหลายๆตัว
$('.duedatechange').on("change",function(){
    var x = $(this).val();
    var y = 'Not set';
    var z = 'After process start';
    var a = 'After previous task complete';
    var b = 'Before process deadline';
    console.log($(this).next().children());
    var statusofchild = $(this).next().children();
    if(x == y){
        statusofchild.attr('disabled','disabled');
    }else if(x == z || x == a || x == b){
        statusofchild.removeAttr('disabled');
    }
});

/* Tab :: condition all item */
//Condition :: Task+app+group
$('.Conditionchoice').on("change",function(){
    var x = $(this).val();
    var y = 'Always';
    var z = 'If All conditions are met';
    var a = 'If Any conditions is met';
    // อ้างถึง box-condition
    var boxcondition = $(this).next();
    if(x == y){
        boxcondition.css('display','none');
    }else if(x == z){
        boxcondition.css('display','block');
        $('.conditionTag').css('display','block');
        $('.conditionTag').text("AND");
    }else if(x == a){
        boxcondition.css('display','block');
        $('.conditionTag').css('display','block');
        $('.conditionTag').text("OR");
    }
});


//select หน้า process
function statusprocess(){
    var processstate = document.getElementById("processStatus").value;
    var groupstatus = document.getElementById("groupStatus").value;
    var status = document.getElementById("Status").value;
    //Myprocess Nogroup Active
    if(processstate == 1 && groupstatus == 3 && status == 5){
        document.getElementById("boxA").style.display ="block";
        document.getElementById("boxB").style.display ="none";
        document.getElementById("boxC").style.display ="none";
        document.getElementById("boxD").style.display ="none";
        document.getElementById("boxE").style.display ="none";
    // Myprocess Nogroup completed  / Allprocess Nogroup Completed 
    }else if((processstate == 1 || processstate == 2) && groupstatus == 3 && status == 6){
        document.getElementById("boxA").style.display ="none";
        document.getElementById("boxB").style.display ="block";
        document.getElementById("boxC").style.display ="none";
        document.getElementById("boxD").style.display ="none";
        document.getElementById("boxE").style.display ="none";
    //Allprocess Nogroup Active 
    }else if(processstate == 2 && groupstatus == 3 && status == 5){
        document.getElementById("boxA").style.display ="none";
        document.getElementById("boxB").style.display ="none";
        document.getElementById("boxC").style.display ="block";
        document.getElementById("boxD").style.display ="none";
        document.getElementById("boxE").style.display ="none";
    //Myprocess Group Active / All process Group Active
    }else if((processstate == 1 || processstate == 2) && groupstatus == 4 && status == 5){
        document.getElementById("boxA").style.display ="none";
        document.getElementById("boxB").style.display ="none";
        document.getElementById("boxC").style.display ="none";
        document.getElementById("boxD").style.display ="block";
        document.getElementById("boxE").style.display ="none";
    //Myprocess Group Complated  / Allprocess Group Complated 
    }else if((processstate == 1 || processstate == 2) && groupstatus == 4 && status == 6){
        document.getElementById("boxA").style.display ="none";
        document.getElementById("boxB").style.display ="none";
        document.getElementById("boxC").style.display ="none";
        document.getElementById("boxD").style.display ="none";
        document.getElementById("boxE").style.display ="block";
    }
}

//select หน้า Template 
$('.chosen').chosen({
    width: '200px',
    allow_single_deselect: true,
});

//select หน้า Creattemplate
//start start Processmanagers
$('.chosen-select').chosen({
    width: '100%'
});

function test(){
    var x = document.getElementById('testuservalue').value;
    console.log(x);
}


