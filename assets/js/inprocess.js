// inprocessTask
function btncondition(number){
    var checkbox = document.getElementById("customCheckbox2");
    var btnheadComp = document.getElementById("btn-head-Comp");
    var btnheadAssign = document.getElementById("btn-head-Assign");
    var btnheadReopen = document.getElementById("btn-head-Reopen");
    var InprocessGroup1User = document.getElementById("InprocessGroup1-user");
    var InprocessGroup1Btn = document.getElementById("InprocessGroup1-btn");
    var InprocessGroup2User = document.getElementById("InprocessGroup2-user");
    var InprocessGroup2Btn = document.getElementById("InprocessGroup2-btn");
    var InprocessGroup3User = document.getElementById("InprocessGroup3-user");
    // 1. เมื่อ กดปุ่ม unassign
    if(number == 1){
        checkbox.disabled = true;
        btnheadComp.style.display = 'none';
        btnheadAssign.style.display = 'inline';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'none';
        InprocessGroup1Btn.style.display = 'none';
        InprocessGroup2User.style.display = 'flex';
        InprocessGroup2Btn.style.display = 'flex';
        InprocessGroup3User.style.display = 'none';
    }
    // 2. เมื่อ กดปุ่ม assign to me
    else if(number == 2){
        checkbox.disabled = false;
        btnheadComp.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
    }
    //3. เมื่อกด check box
    else if(number == 3){
        if(checkbox.checked == true){
            btnheadComp.style.display = 'none';
            btnheadAssign.style.display = 'none';
            btnheadReopen.style.display = 'inline';
            InprocessGroup1User.style.display = 'none';
            InprocessGroup1Btn.style.display = 'none';
            InprocessGroup2User.style.display = 'none';
            InprocessGroup2Btn.style.display = 'none';
            InprocessGroup3User.style.display = 'flex';
            $('.form-line input').attr('disabled','disabled');
            $('.form-line select').attr('disabled','disabled');
            $('.form-line textarea').attr('disabled','disabled');
        }
        else if(checkbox.checked == false){
            btnheadComp.style.display = 'inline';
            btnheadAssign.style.display = 'none';
            btnheadReopen.style.display = 'none';
            InprocessGroup1User.style.display = 'flex';
            InprocessGroup1Btn.style.display = 'flex';
            InprocessGroup2User.style.display = 'none';
            InprocessGroup2Btn.style.display = 'none';
            InprocessGroup3User.style.display = 'none';
            $('.form-line input').removeAttr('disabled');
            $('.form-line select').removeAttr('disabled');
            $('.form-line textarea').removeAttr('disabled');
        }
    }
    //4.เมื่อกด Complete
    else if(number == 4){
        checkbox.checked = true;
        btnheadComp.style.display = 'none';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'inline';
        InprocessGroup1User.style.display = 'none';
        InprocessGroup1Btn.style.display = 'none';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'flex';
        $('.form-line input').attr('disabled','disabled');
        $('.form-line select').attr('disabled','disabled');
        $('.form-line textarea').attr('disabled','disabled');
    }
    //5.เมื่อกด assign to me บน head
    else if(number == 5){
        checkbox.disabled = false;
        btnheadComp.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
    }
    //5.เมื่อกด reopen
    else if(number == 6){
        checkbox.checked = false;
        btnheadComp.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
        $('.form-line input').removeAttr('disabled');
        $('.form-line select').removeAttr('disabled');
        $('.form-line textarea').removeAttr('disabled');
    }
}

// inprocess approve
function btnconditionApprove(number){
    var checkbox = document.getElementById("customCheckbox2");
    var btnheadApp = document.getElementById("btn-head-Approve");
    var btnheadReject = document.getElementById("btn-head-Reject");
    var btnheadAssign = document.getElementById("btn-head-Assign");
    var btnheadReopen = document.getElementById("btn-head-Reopen");
    var InprocessGroup1User = document.getElementById("InprocessGroup1-user");
    var InprocessGroup1Btn = document.getElementById("InprocessGroup1-btn");
    var InprocessGroup2User = document.getElementById("InprocessGroup2-user");
    var InprocessGroup2Btn = document.getElementById("InprocessGroup2-btn");
    var InprocessGroup3User = document.getElementById("InprocessGroup3-user");
    // 1. เมื่อ กดปุ่ม unassign
    if(number == 1){
        checkbox.disabled = true;
        btnheadApp.style.display = 'none';
        btnheadReject.style.display = 'none';
        btnheadAssign.style.display = 'inline';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'none';
        InprocessGroup1Btn.style.display = 'none';
        InprocessGroup2User.style.display = 'flex';
        InprocessGroup2Btn.style.display = 'flex';
        InprocessGroup3User.style.display = 'none';
    }
    // 2. เมื่อ กดปุ่ม assign to me
    else if(number == 2){
        checkbox.disabled = false;
        btnheadApp.style.display = 'inline';
        btnheadReject.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
    }
    //3. เมื่อกด check box
    else if(number == 3){
        if(checkbox.checked == true){
            btnheadApp.style.display = 'none';
            btnheadReject.style.display = 'none';
            btnheadAssign.style.display = 'none';
            btnheadReopen.style.display = 'inline';
            InprocessGroup1User.style.display = 'none';
            InprocessGroup1Btn.style.display = 'none';
            InprocessGroup2User.style.display = 'none';
            InprocessGroup2Btn.style.display = 'none';
            InprocessGroup3User.style.display = 'flex';
            $('.form-line input').attr('disabled','disabled');
            $('.form-line select').attr('disabled','disabled');
            $('.form-line textarea').attr('disabled','disabled');
        }
        else if(checkbox.checked == false){
            btnheadApp.style.display = 'inline';
            btnheadReject.style.display = 'inline';
            btnheadAssign.style.display = 'none';
            btnheadReopen.style.display = 'none';
            InprocessGroup1User.style.display = 'flex';
            InprocessGroup1Btn.style.display = 'flex';
            InprocessGroup2User.style.display = 'none';
            InprocessGroup2Btn.style.display = 'none';
            InprocessGroup3User.style.display = 'none';
            $('.form-line input').removeAttr('disabled');
            $('.form-line select').removeAttr('disabled');
            $('.form-line textarea').removeAttr('disabled');
        }
    }
    //4.เมื่อกด Complete
    else if(number == 4){
        checkbox.checked = true;
        btnheadApp.style.display = 'none';
        btnheadReject.style.display = 'none';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'inline';
        InprocessGroup1User.style.display = 'none';
        InprocessGroup1Btn.style.display = 'none';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'flex';
        $('.form-line input').attr('disabled','disabled');
        $('.form-line select').attr('disabled','disabled');
        $('.form-line textarea').attr('disabled','disabled');
    }
    //5.เมื่อกด assign to me บน head
    else if(number == 5){
        checkbox.disabled = false;
        btnheadApp.style.display = 'inline';
        btnheadReject.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
    }
    //5.เมื่อกด reopen
    else if(number == 6){
        checkbox.checked = false;
        btnheadApp.style.display = 'inline';
        btnheadReject.style.display = 'inline';
        btnheadAssign.style.display = 'none';
        btnheadReopen.style.display = 'none';
        InprocessGroup1User.style.display = 'flex';
        InprocessGroup1Btn.style.display = 'flex';
        InprocessGroup2User.style.display = 'none';
        InprocessGroup2Btn.style.display = 'none';
        InprocessGroup3User.style.display = 'none';
        $('.form-line input').removeAttr('disabled');
        $('.form-line select').removeAttr('disabled');
        $('.form-line textarea').removeAttr('disabled');
    }
}

//calender header สำหรับกำหนดวันส่งงาน
function calenderDue(){
    $('#btn-calender').click(function(){
        $('#btn-calender').css('display','none');
    });
    
    $('#btn-savecalender').click(function(){
        var date = $('#daedlineDay').val();
        if(date == ''){
            $('#btn-calender').css('display','flex');
            $('#show-calender').css('display','none');
            $('#pj_process_deadline').text(' ');
        }else{
            $('#btn-calender').css('display','none');
            $('#show-calender').css('display','block');
            $('#pj_process_deadline').text(date);
        }
    });
    $('#btn-resetcalender').click(function(){
        $('#daedlineDay').val('');
    });
}

// วันที่ของแต่ะละตัว
function calenderItem(){
    $('#Save-dateItem1').click (function(){
        var date = $('#dateItem1').val();
        if(date == ''){
            $('.date-icon').css('display','block');
            $('.date-text').css('display','none');
            $('.date-text').text('');
        }else{
            $('.date-icon').css('display','none');
            $('.date-text').css('display','block');
            $('.date-text').text(date);
        }
    });
    $('#Reset-dateItem1').click(function(){
        $('.date-icon').css('display','block');
        $('.date-text').css('display','none');
        $('#dateItem1').val('');
    });
}





