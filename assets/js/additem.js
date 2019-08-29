
//Tab Condition  เพิ่ม codition item
$('.addCondition').on('click', function(){
    // condition ใหม่แต่ละตัว
    var conditionBox = '<li><div class="conditionTag"></div>'+'<div class="box-one" style="margin-right: 8px;">'+
    '<select class="form-control form-control-sm" style="margin-right: 12px;"><option>Sample from field</option></select>'+
    '<select class="form-control form-control-sm"><option>is filled in</option><option>is not filed in</option>'+
    '<option>is equal to</option><option>is not equal to</option><option>starts with</option><option>ends with</option><option>contains</option>'+
    '</select></div><div class="mini-icon-btn delete-condition" style="justify-content: flex-end;"><i class="fas fa-trash-alt"></i>'+
    '</div></li>'

    //อ้างถึง ul
    var listcondition = $(this).prev();
    //อ้างถึงค่าในselect
    var valuechoice = $(this).parent().prev().val();
    var z = 'If All conditions are met';
    var a = 'If Any conditions is met';
    if(valuechoice == z){
        listcondition.append(conditionBox);
        $('.conditionTag').text("AND");
    }else if(valuechoice == a){
        listcondition.append(conditionBox);
        $('.conditionTag').text("OR");
    }
    //ลบ condition
    $('.delete-condition').on("click", function(e) { 
        e.preventDefault();
        $(this).parent().remove();
    })
});

//Dataform Section
function newSection(){
    var newsection = $('.sectionItem:first').clone(true, true).appendTo('.boxSectionList');
    newsection.css({'visibility':'visible','height':'auto'});
    newsection.removeClass('sectionItem');
    var childrenField = newsection.children().eq(1).children().eq(1).children().eq(0);
    childrenField.removeClass('defualtSection');
    
    $('.eachSectionBox').on("click", function(e) { 
        e.preventDefault();
        $(this).closest(".box-section").remove();
    });
}
//delete section
$('.eachSectionBox').on("click", function(e) { 
    e.preventDefault();
    $(this).closest(".box-section").remove();
});

//Dataform field 
$('.btn-field').on("click", function() {
    var x = $(this).parent().prev();
    console.log(x);
    var newfield = $('.defualtSection:first').clone(true, true).appendTo(x);
    newfield.removeClass('defualtSection');

    $('.delete-field').on("click", function(e) { 
        e.preventDefault();
        $(this).parent().remove();
    })
});

//Delete field ตัวdefault
$('.delete-field').on("click", function(e) { 
    e.preventDefault();
    $(this).parent().remove();
})

//create Template add task 
var idtask = 1;
var idadd = 1;
function addTask(){
    //ฝั่งซ้าย
    var taskitem = $( ".taskdefault:first" ).clone(true, true);
    var list = $('.list-itemTab');
    taskitem.removeClass('active');
    taskitem.css({'visibility':'visible','height':'64px'});
    taskitem.attr("onclick", "openItem(event, 'task"+idtask+"')");
    taskitem.children().eq(1).attr("onclick", "deleteItem(this, 'task"+idtask+"')");
    taskitem.children().eq(0).children().eq(1).children().eq(0).attr("class","text-f14 replace-text"+idtask+"");   
    taskitem.appendTo(list);

    var taskcontent = $("#task").clone(true, true);
    var listcontent = $("#RightSideBox-Detail");
    taskcontent.removeAttr('id');

    taskcontent.attr('id','task' + idtask);
    taskcontent.removeClass('show active');
    taskcontent.css('display','none');
    taskcontent.appendTo(listcontent);
    
   
    //เนื้อหาด้านขวาแก้ไข id แต่ละตัว
    //1.กล่องใหญ่สุด
    $("#task"+idtask+" .tab-Header").removeAttr('id aria-labelledby');
    $("#task"+idtask+" .tab-Header").attr('id','v-pills-Task' + idtask);
    $("#task"+idtask+" .tab-Header").attr("aria-labelledby","v-pills-Task-tab" + idtask);
    // Header processdetail
    $("#task"+idtask+" .listST").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listST").attr('id','pills-ProcessDetail-task-tab' + idtask);
    $("#task"+idtask+" .listST").attr('href','#pills-ProcessDetail-task' + idtask);
    $("#task"+idtask+" .listST").attr('aria-controls','pills-ProcessDetail-task' + idtask);
    // Header Field visibility
    $("#task"+idtask+" .listND").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listND").attr('id','pills-FieldsVisibility-task-tab' + idtask);
    $("#task"+idtask+" .listND").attr('href','#pills-FieldsVisibility-task' + idtask);
    $("#task"+idtask+" .listND").attr('aria-controls','pills-FieldsVisibility-task' + idtask);
    //Header Condition condition
    $("#task"+idtask+" .listTH").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listTH").attr('id','pills-Condition-task-tab' + idtask);
    $("#task"+idtask+" .listTH").attr('href','#pills-Condition-task' + idtask);
    $("#task"+idtask+" .listTH").attr('aria-controls','pills-Condition-task' + idtask);
    //body detil
    $("#task"+idtask+' .tab-body .ST').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .ST').attr('id','pills-ProcessDetail-task' + idtask);
    $("#task"+idtask+' .tab-body .ST').attr("aria-labelledby","pills-ProcessDetail-task-tab" + idtask);
    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('id','task_title');
    $("#task"+idtask+' .tab-body .ST').children().eq(1).children().eq(1).children().eq(0).attr('id','task_description');   
    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('name','task_title[]');
    $("#task"+idtask+' .tab-body .ST').children().eq(1).children().eq(1).children().eq(0).attr('name','task_description[]');   

    $("#task"+idtask+' .tab-body .ST').children().eq(2).children().eq(1).children().eq(0).attr('id','pjt_starteddate');
    $("#task"+idtask+' .tab-body .ST').children().eq(3).children().eq(1).children().eq(0).attr('id','pjt_duedate');   
    $("#task"+idtask+' .tab-body .ST').children().eq(2).children().eq(1).children().eq(0).attr('name','pjt_starteddate[]');
    $("#task"+idtask+' .tab-body .ST').children().eq(3).children().eq(1).children().eq(0).attr('name','pjt_duedate[]');  

 
    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('class','form-control form-control-sm inputvalidate inputjs_replace'+idtask);
    // $('#hdnCount').val(rows);
    // console.log(y);
    //body field
    $("#task"+idtask+' .tab-body .ND').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .ND').attr('id','pills-FieldsVisibility-task' + idtask);
    $("#task"+idtask+' .tab-body .ND').attr("aria-labelledby","pills-FieldsVisibility-task-tab" + idtask);
    //body condition
    $("#task"+idtask+' .tab-body .TH').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .TH').attr('id','pills-Condition-task' + idtask);
    $("#task"+idtask+' .tab-body .TH').attr("aria-labelledby","pills-Condition-task-tab" + idtask);

    
    $(".inputjs_replace1").on('input', function() {
        $(".replace-text1").text($(this).val());
    });
    $(".inputjs_replace2").on('input', function() {
        $(".replace-text2").text($(this).val());
    });
    $(".inputjs_replace3").on('input', function() {
        $(".replace-text3").text($(this).val());
    });
  
    $(".inputjs_replace4").on('input', function() {
        $(".replace-text4").text($(this).val());
    });
    $(".inputjs_replace5").on('input', function() {
        $(".replace-text5").text($(this).val());
    });
    $(".inputjs_replace6").on('input', function() {
        $(".replace-text6").text($(this).val());
    });
    $(".inputjs_replace7").on('input', function() {
        $(".replace-text7").text($(this).val());
    });
    $(".inputjs_replace8").on('input', function() {
        $(".replace-text8").text($(this).val());
    });
    $(".inputjs_replace9").on('input', function() {
        $(".replace-text9").text($(this).val());
    });
    $(".inputjs_replace10").on('input', function() {
        $(".replace-text10").text($(this).val());
    });
    $(".inputjs_replace11").on('input', function() {
        $(".replace-text11").text($(this).val());
    });

     //บวกค่า id เพิ่ม
     
      
    idtask++;
    idadd++;
    $('#hdnCount').val(idadd-1);
    
}
// addtask for edit project 
function addTaskedit(){
    //ฝั่งซ้าย
    $( "#task_title_adds" ).attr("value", "data");

    var taskitem = $( ".taskdefault:first" ).clone(true, true);
    var list = $('.list-itemTab');
    taskitem.removeClass('active');
    taskitem.css({'visibility':'visible','height':'64px'});
    taskitem.attr("onclick", "openItem(event, 'task"+idtask+"')");
    taskitem.children().eq(1).attr("onclick", "deleteItem(this, 'task"+idtask+"')");
    taskitem.children().eq(0).children().eq(1).children().eq(0).attr("class","text-f14 replace-texteee"+idtask+"");  
    taskitem.appendTo(list);

    var taskcontent = $("#task").clone(true, true);
    var listcontent = $("#RightSideBox-Detail");
    taskcontent.removeAttr('id');

    taskcontent.attr('id','task' + idtask);
    taskcontent.removeClass('show active');
    taskcontent.css('display','none');
    taskcontent.appendTo(listcontent);
    
    //เนื้อหาด้านขวาแก้ไข id แต่ละตัว
    //1.กล่องใหญ่สุด
    $("#task"+idtask+" .tab-Header").removeAttr('id aria-labelledby');
    $("#task"+idtask+" .tab-Header").attr('id','v-pills-Task' + idtask);
    $("#task"+idtask+" .tab-Header").attr("aria-labelledby","v-pills-Task-tab" + idtask);
    // Header processdetail
    $("#task"+idtask+" .listST").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listST").attr('id','pills-ProcessDetail-task-tab' + idtask);
    $("#task"+idtask+" .listST").attr('href','#pills-ProcessDetail-task' + idtask);
    $("#task"+idtask+" .listST").attr('aria-controls','pills-ProcessDetail-task' + idtask);
    // Header Field visibility
    $("#task"+idtask+" .listND").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listND").attr('id','pills-FieldsVisibility-task-tab' + idtask);
    $("#task"+idtask+" .listND").attr('href','#pills-FieldsVisibility-task' + idtask);
    $("#task"+idtask+" .listND").attr('aria-controls','pills-FieldsVisibility-task' + idtask);
    //Header Condition condition
    $("#task"+idtask+" .listTH").removeAttr('id href aria-controls');
    $("#task"+idtask+" .listTH").attr('id','pills-Condition-task-tab' + idtask);
    $("#task"+idtask+" .listTH").attr('href','#pills-Condition-task' + idtask);
    $("#task"+idtask+" .listTH").attr('aria-controls','pills-Condition-task' + idtask);
    //body detil
    $("#task"+idtask+' .tab-body .ST').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .ST').attr('id','pills-ProcessDetail-task' + idtask);
    $("#task"+idtask+' .tab-body .ST').attr("aria-labelledby","pills-ProcessDetail-task-tab" + idtask);
    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('id','task_title_add');
    $("#task"+idtask+' .tab-body .ST').children().eq(1).children().eq(1).children().eq(0).attr('id','task_description_add');   
    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('name','task_title_add[]');
    $("#task"+idtask+' .tab-body .ST').children().eq(1).children().eq(1).children().eq(0).attr('name','task_description_add[]');   

    $("#task"+idtask+' .tab-body .ST').children().eq(2).children().eq(1).children().eq(0).attr('id','pjt_starteddate_add');
    $("#task"+idtask+' .tab-body .ST').children().eq(3).children().eq(1).children().eq(0).attr('id','pjt_duedate_add');   
    $("#task"+idtask+' .tab-body .ST').children().eq(2).children().eq(1).children().eq(0).attr('name','pjt_starteddate_add[]');
    $("#task"+idtask+' .tab-body .ST').children().eq(3).children().eq(1).children().eq(0).attr('name','pjt_duedate_add[]');  

    $("#task"+idtask+' .tab-body .ST').children().eq(0).children().eq(1).children().eq(0).attr('class','form-control form-control-sm inputvalidate inputjs_replaceeee'+idtask);

    // $('#hdnCount').val(rows);
    // console.log(y);
    //body field
    $("#task"+idtask+' .tab-body .ND').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .ND').attr('id','pills-FieldsVisibility-task' + idtask);
    $("#task"+idtask+' .tab-body .ND').attr("aria-labelledby","pills-FieldsVisibility-task-tab" + idtask);
    //body condition
    $("#task"+idtask+' .tab-body .TH').removeAttr('id aria-labelledby');
    $("#task"+idtask+' .tab-body .TH').attr('id','pills-Condition-task' + idtask);
    $("#task"+idtask+' .tab-body .TH').attr("aria-labelledby","pills-Condition-task-tab" + idtask);
    
    $(".inputjs_replaceeee1").on('input', function() {
        $(".replace-texteee1").text($(this).val());
    });
    $(".inputjs_replaceeee2").on('input', function() {
        $(".replace-texteee2").text($(this).val());
    });
    $(".inputjs_replaceeee3").on('input', function() {
        $(".replace-texteee3").text($(this).val());
    });
  
    $(".inputjs_replaceeee4").on('input', function() {
        $(".replace-texteee4").text($(this).val());
    });
    $(".inputjs_replaceeee5").on('input', function() {
        $(".replace-texteee5").text($(this).val());
    });
    $(".inputjs_replaceeee6").on('input', function() {
        $(".replace-texteee6").text($(this).val());
    });
    $(".inputjs_replaceeee7").on('input', function() {
        $(".replace-texteee7").text($(this).val());
    });
    $(".inputjs_replaceeee8").on('input', function() {
        $(".replace-texteee8").text($(this).val());
    });
    $(".inputjs_replaceeee9").on('input', function() {
        $(".replace-texteee9").text($(this).val());
    });
    $(".inputjs_replaceeee10").on('input', function() {
        $(".replace-texteee10").text($(this).val());
    });
    $(".inputjs_replaceeee11").on('input', function() {
        $(".replace-texteee11").text($(this).val());
    });
     //บวกค่า id เพิ่ม
     
    idtask++;
    idadd++;

}
//create Template add approval
var idapproval = 0;
function addApproval(){
    //ฝั่งซ้าย
    var approvalitem = $( ".approvaldefault:first" ).clone(true, true);
    var list = $('.list-itemTab');
    approvalitem.removeClass('active');
    approvalitem.css({'visibility':'visible','height':'64px'});
    approvalitem.attr("onclick", "openItem(event, 'approval"+idapproval+"')");
    approvalitem.children().eq(1).attr("onclick", "deleteItem(this, 'approval"+idapproval+"')");
    approvalitem.appendTo(list);

    //ฝั่งขวา
    var approvalcontent = $("#approval").clone(true, true);
    var listcontent = $("#RightSideBox-Detail");
    approvalcontent.removeClass('show active');
    approvalcontent.css('display','none');
    approvalcontent.removeAttr('id');
    approvalcontent.attr('id','approval' + idapproval);
    approvalcontent.appendTo(listcontent);

    //เนื้อหาด้านขวาแก้ไข id แต่ละตัว
    //1.กล่องใหญ่สุด
    $("#approval"+idapproval+" .tab-Header").removeAttr('id aria-labelledby');
    $("#approval"+idapproval+" .tab-Header").attr('id','v-pills-Approval' + idapproval);
    $("#approval"+idapproval+" .tab-Header").attr("aria-labelledby","v-pills-Approval-tab" + idapproval);
    // Header processdetail
    $("#approval"+idapproval+" .listST").removeAttr('id href aria-controls');
    $("#approval"+idapproval+" .listST").attr('id','pills-ProcessDetail-approval-tab' + idapproval);
    $("#approval"+idapproval+" .listST").attr('href','#pills-ProcessDetail-approval' + idapproval);
    $("#approval"+idapproval+" .listST").attr('aria-controls','pills-ProcessDetail-approval' + idapproval);
    // Header Field visibility
    $("#approval"+idapproval+" .listND").removeAttr('id href aria-controls');
    $("#approval"+idapproval+" .listND").attr('id','pills-FieldsVisibility-approval-tab' + idapproval);
    $("#approval"+idapproval+" .listND").attr('href','#pills-FieldsVisibility-approval' + idapproval);
    $("#approval"+idapproval+" .listND").attr('aria-controls','pills-FieldsVisibility-approval' + idapproval);
    //Header Condition condition
    $("#approval"+idapproval+" .listTH").removeAttr('id href aria-controls');
    $("#approval"+idapproval+" .listTH").attr('id','pills-Conditionapproval-tab' + idapproval);
    $("#approval"+idapproval+" .listTH").attr('href','#pills-Conditionapproval' + idapproval);
    $("#approval"+idapproval+" .listTH").attr('aria-controls','pills-Conditionapproval' + idapproval);
    //body detil
    $("#approval"+idapproval+' .tab-body .ST').removeAttr('id aria-labelledby');
    $("#approval"+idapproval+' .tab-body .ST').attr('id','pills-ProcessDetail-approval' + idapproval);
    $("#approval"+idapproval+' .tab-body .ST').attr("aria-labelledby","pills-ProcessDetail-approval-tab" + idapproval);
    //body field
    $("#approval"+idapproval+' .tab-body .ND').removeAttr('id aria-labelledby');
    $("#approval"+idapproval+' .tab-body .ND').attr('id','pills-FieldsVisibility-approval' + idapproval);
    $("#approval"+idapproval+' .tab-body .ND').attr("aria-labelledby","pills-FieldsVisibility-approval-tab" + idapproval);
    //body condition
    $("#approval"+idapproval+' .tab-body .TH').removeAttr('id aria-labelledby');
    $("#approval"+idapproval+' .tab-body .TH').attr('id','pills-Conditionapproval' + idapproval);
    $("#approval"+idapproval+' .tab-body .TH').attr("aria-labelledby","pills-Conditionapproval-tab" + idapproval);

    //บวกค่า id เพิ่ม
    idapproval++;
}
var idgroup = 0;
//create Template add group
function addGroup(){
    //ฝั่งซ้าย
    var groupitem = $( ".groupdefault:first" ).clone(true, true);
    var list = $('.list-itemTab');
    groupitem.removeClass('active');
    groupitem.css({'visibility':'visible','height':'64px'});
    groupitem.attr("onclick", "openItem(event, 'group"+idgroup+"')");
    groupitem.appendTo(list);

    //ฝั่งขวา
    var groupcontent = $("#group").clone(true, true);
    var listcontent = $("#RightSideBox-Detail");
    groupcontent.removeClass('show active');
    groupcontent.css('display','none');
    groupcontent.removeAttr('id');
    groupcontent.attr('id','group' + idgroup);
    groupcontent.appendTo(listcontent);
        //เนื้อหาด้านขวาแก้ไข id แต่ละตัว
    //1.กล่องใหญ่สุด
    $("#group"+idgroup+" .tab-Header").removeAttr('id aria-labelledby');
    $("#group"+idgroup+" .tab-Header").attr('id','v-pills-Group' + idgroup);
    $("#group"+idgroup+" .tab-Header").attr("aria-labelledby","v-pills-Group-tab" + idgroup);
    // Header processdetail
    $("#group"+idgroup+" .listST").removeAttr('id href aria-controls');
    $("#group"+idgroup+" .listST").attr('id','pills-Groupdetails-tab' + idgroup);
    $("#group"+idgroup+" .listST").attr('href','#pills-Groupdetails' + idgroup);
    $("#group"+idgroup+" .listST").attr('aria-controls','pills-Groupdetails' + idgroup);
    //Header Condition condition
    $("#group"+idgroup+" .listTH").removeAttr('id href aria-controls');
    $("#group"+idgroup+" .listTH").attr('id','pills-ConditionGroup-tab' + idgroup);
    $("#group"+idgroup+" .listTH").attr('href','#pills-ConditionGroup' + idgroup);
    $("#group"+idgroup+" .listTH").attr('aria-controls','pills-ConditionGroup' + idgroup);
    //body detil
    $("#group"+idgroup+' .tab-body .ST').removeAttr('id aria-labelledby');
    $("#group"+idgroup+' .tab-body .ST').attr('id','pills-Groupdetails' + idgroup);
    $("#group"+idgroup+' .tab-body .ST').attr("aria-labelledby","pills-Groupdetails-tab" + idgroup);
    //body condition
    $("#group"+idgroup+' .tab-body .TH').removeAttr('id aria-labelledby');
    $("#group"+idgroup+' .tab-body .TH').attr('id','pills-ConditionGroup' + idgroup);
    $("#group"+idgroup+' .tab-body .TH').attr("aria-labelledby","pills-ConditionGroup-tab" + idgroup);
    
    
    //บวกค่า id เพิ่ม
    idgroup++;
}
//Delete item
function deleteItem(a,b){
    //js ล้วน
    //a คือ this elementของevent ส่วน b คือค่าid ที่จะเอาไปหาต่อ
    var z = document.getElementById(b);
    z.remove();
    a.parentElement.remove();
}

//Web setting
//เพิ่มuser ในmodal ของปุ่ม invite new user
function addUser(){
    var user = $('.inputUser:first').clone(true, true);
    var y = user.css('display','flex');
    y.appendTo('.content-invite');
}

//ลบuser ในmodal ของปุ่ม invite new user
$('.btn-modelUser-delete').on("click", function(e) { 
    e.preventDefault();
    $(this).closest(".row").remove();
});

//Web setting group
var idUsergroup = 0;
function addNewGroup(){
    //ฝั่งซ้าย
    var usergroup = $(".defaultGroup:first").clone(true, true);
    usergroup.attr("onclick", "openGroup()");
    usergroup.removeAttr('id href aria-controls');
    usergroup.attr('id','v-pills-groupTab' + idUsergroup);
    usergroup.attr("aria-labelledby","v-pills-group" + idUsergroup);
    usergroup.attr('href','#v-pills-group' + idUsergroup);
    usergroup.removeClass('active');
    usergroup.children().eq(1).attr("onclick", "deleteGroup(this, 'v-pills-group"+idapproval+"')");
    var list = $('.Usergrouplist');
    usergroup.appendTo(list);

    //ฝั่งขวา
    var usergroupcontent = $(".defaultGroupContent:first").clone(true, true);
    usergroupcontent.removeAttr('id');
    var listcontent = $("#RightSide-group .tab-content");
    usergroupcontent.removeAttr('id aria-labelledby');
    usergroupcontent.attr('id','v-pills-group' + idUsergroup);
    usergroupcontent.attr("aria-labelledby","v-pills-groupTab" + idUsergroup);
    usergroupcontent.removeClass('show active');
    usergroupcontent.appendTo(listcontent);

    //บวกค่า id เพิ่ม
    idUsergroup++;
}
//Delete group
function deleteGroup(a,b){
    //js ล้วน
    //a คือ this elementของevent ส่วน b คือค่าid ที่จะเอาไปหาต่อ
    var z = document.getElementById(b);
    z.remove();
    a.parentElement.remove();
}


