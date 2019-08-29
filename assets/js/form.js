//Validation
// สำหรับ Title template 
function titleTemplate(){
    var inputtitleTem = document.getElementById("input-titleTem");
    var textDisplay = document.getElementById("inputTitle-required");
    if(inputtitleTem.value.length <= 0){
        textDisplay.style.visibility = "visible";
        textDisplay.innerHTML = "Requied";
    }
    else if(inputtitleTem.value.length != '' && inputtitleTem.value.length < 3){
        textDisplay.style.visibility = "visible";
        textDisplay.innerHTML = "Minimum of 3 characters";
    }else{
        textDisplay.style.visibility = "hidden";
    }
}

//Title validation
$('.inputvalidate').on('keyup',function(){
    var inputlength = $(this).val().length;
    var textError = $(this).next();
    console.log(inputlength);
    if(inputlength <= 0){
        textError.css('visibility','visible');
        textError.text('Text is required');
        $(this).addClass("input-error");
    }else if(inputlength > 0 && inputlength <= 2){
        textError.css('visibility','visible');
        textError.text('Minimum of 3 characters');
        $(this).addClass("input-error");
    }else if(inputlength > 2){
        textError.css('visibility','hidden');
        $(this).removeClass("input-error");
    }
});

// หน้า web setting หัวข้อกลุ่ม
// ปุ่ม rename
function renameGroup(){
    document.getElementById('namegroup').style.display = 'none';
    document.getElementById('btnset-rename').style.display = 'none';
    var x = document.getElementById('namegroup').innerHTML;
    document.getElementById('inputGroup').value = x;
    document.getElementById('inputGroup').style.display = "block";
    document.getElementById('btnset-SaveRename').style.display = "block";
}
//ปุ่มcancel
function CancelrenameGroup(){
    document.getElementById('namegroup').style.display = 'block';
    document.getElementById('btnset-rename').style.display = 'block';
    document.getElementById('inputGroup').style.display = "none";
    document.getElementById('btnset-SaveRename').style.display = "none"
    document.getElementById('errorGroupName').style.visibility = "hidden"
}
// input
function checknameGroup(){
    var x = document.getElementById('namegroup').innerHTML;
    var y = document.getElementById('inputGroup').value;
    if(x == y){
        document.getElementById('errorGroupName').style.visibility = "visible"
        document.getElementById('errorGroupName').innerHTML = "Group with the same name already exists";
    }else if(y.length == ''){
        document.getElementById('errorGroupName').style.visibility = "visible"
        document.getElementById('errorGroupName').innerHTML = "Required";
    }else{
        document.getElementById('errorGroupName').style.visibility = "hidden"
        document.getElementById('Save-nameGroup').classList.add('btn-normal');
        document.getElementById('Save-nameGroup').classList.remove('btn-unclick');
        document.getElementById("Save-nameGroup").disabled = false;
    }
}
//ปุ่ม save
function savenameGroup(){
    var y = document.getElementById('inputGroup');
    document.getElementById('namegroup').innerHTML = y.value;
    y.style.display ="none";
    document.getElementById('namegroup').style.display ="block";
    document.getElementById('btnset-rename').style.display = 'block';
    document.getElementById('btnset-SaveRename').style.display = "none"

}
//เปลี่ยนชื่อกลุ่ม อ้างจาก ปุ่ม rename group
// 0 ชื่อกลุ่ม 1 input 2.errorname 3.ปุ่มrename 4.ปุ่มsave และ cancel
$('.renameGroup').on('click',function(){
    var x = $(this).parent().parent().children();
    //ให้ชื่อกลุ่มซ่อน + และตัวมันเองซ่อน
    x.eq(0).css('display','none');
    $(this).parent().css('display','none');
    //เก็บค่าของชื่อกลุ่มเพื่อเอาไปใส่ในinput
    var z = x.eq(0).text();
    x.eq(1).val(z);
    x.eq(1).css('display','block');
    x.eq(4).css('display','block');
});
//เช็ตชื่อกลุ่ม อ้างจากinput
$('.checknamegroup').on('keyup',function(){
    var x = $(this).parent().children();
    var namegroup = x.eq(0).text();
    var valueinput = $(this).val();
    if(namegroup == valueinput){
        $(this).addClass("input-error");
        x.eq(2).css('visibility','visible');
        x.eq(2).text('Group with the same name already exists');
        x.eq(4).children().eq(0).addClass('btn-unclick');
        x.eq(4).children().eq(0).removeClass('btn-normal');
        x.eq(4).children().eq(0).attr('disabled',true);
    }else if(valueinput.length == ''){
        $(this).addClass("input-error");
        x.eq(2).css('visibility','visible');
        x.eq(2).text('Required');
        x.eq(4).children().eq(0).addClass('btn-unclick');
        x.eq(4).children().eq(0).removeClass('btn-normal');
        x.eq(4).children().eq(0).attr('disabled',true);
    }else{
        $(this).removeClass("input-error");
        x.eq(2).text('');
        x.eq(2).css('visibility','hidden');
        x.eq(4).children().eq(0).addClass('btn-normal');
        x.eq(4).children().eq(0).removeClass('btn-unclick');
        x.eq(4).children().eq(0).removeAttr('disabled');
    }
});
//ปุ่มsave
$('.Save-nameGroup').on('click',function(){
    var x = $(this).parent().parent().children();
    //เก็บค่าinput และให้ซ่อน input
    var valueinput = x.eq(1).val();
    x.eq(1).css('display','none');
    //จากนั้นแสดงชื่อกลุ่มและเอาค่าinputใส่ให้มัน
    x.eq(0).css('display','block');
    x.eq(0).text(valueinput);
    x.eq(3).css('display','block');
    x.eq(4).css('display','none');
});
//ปุ่มcalcel
$('.cancelrenamegroup').on('click',function(){
    var x = $(this).parent().parent().children();
    x.eq(0).css('display','block');
    x.eq(1).css('display','none');
    x.eq(2).css('visibility','hidden');
    x.eq(3).css('display','block');
    x.eq(4).css('display','none');
});

//ปุ่มinvite new user :modal :email
function checkvalueModal(number){
    if(number == 1){
        var x1 = document.getElementById('input-email1').value;
        var x2 = document.getElementById('input-email2').value;
        var x3 = document.getElementById('input-email3').value;
        var x4 = document.getElementById('input-email4').value;
        if( x1 != '' || x2 != '' || x3 != '' || x4 != ''){
            $('.send-inv').removeClass("btn-unclick");
            $('.send-inv').addClass("btn-green");
            $('.send-inv').removeAttr('disabled');
        }else{
            $('.send-inv').removeClass("btn-green");
            $('.send-inv').addClass("btn-unclick");
            $('.send-inv').attr('disabled','disabled');
        }
    }else if(number == 2){
        var x5 = document.getElementById('input-email5').value;
        var x6 = document.getElementById('input-email6').value;
        var x7 = document.getElementById('input-email7').value;
        var x8 = document.getElementById('input-email8').value;
        if(x5 != '' || x6 != '' || x7 != '' || x8 != ''){
            $('.send-invGroup').removeClass("btn-unclick");
            $('.send-invGroup').addClass("btn-green");
            $('.send-invGroup').removeAttr('disabled');
        }else{
            $('.send-invGroup').removeClass("btn-green");
            $('.send-invGroup').addClass("btn-unclick");
            $('.send-invGroup').attr('disabled','disabled');
        }
    }
}

$('.emailCheck').on('keyup',function(){
    var valueitself = $(this).val();
    var ul = $(this).parent().parent().parent();
    console.log(ul);
    //เริ่มเช็คที่ลูกตัวที่2
    var item = jQuery(ul)
    jQuery(item).each(function() {
        var itemPrice = jQuery(".price",this).html();
        alert(itemPrice);  
    });
    
});

//หน้าweb setting : Company logo
function readURLlogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#logoUpload')
                .attr('src', e.target.result)
                .css('display','block');
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById("defualtLogoUpload").style.display = "none";
        document.getElementById("up-logo").style.display = "none";
        document.getElementById("change-clear-logo").style.display = "block";
        document.getElementById("logoUpload").style.display = "block";
    }
    
    $('#Clearlogo').on('click',function(){
        $('#logoUpload').attr('src','#');
        document.getElementById("logoUpload").style.display = "none";
        document.getElementById("defualtLogoUpload").style.display = "block";
        document.getElementById("change-clear-logo").style.display = "none";
        document.getElementById("up-logo").style.display = "block";
        input.files[0].val = '';
    });
}


//web setting hodiday
function addHoliday(){
    document.getElementById('btn-addHoliday').style.display = 'none';
    document.getElementById('input-addHoliday').style.display = 'block';
}

//ปุ่ม ติ๊กถูกเช็คก่อนว่า input ทุกตัวต้องมีค่า ถึงจะนำค่านั้นไปแสดงผลในช่องด้านบน
function correctHoliday(){
    var date = document.getElementById('input-dateHoliday').value;
    var name = document.getElementById('input-nameHoliday').value;
    var listHoliday = '<li class="text-f12">' + '<span style="color:#F75F5F">'+ date +'</span>' + '  ' + name  + '  ' 
            + '<span class="delete-Holiday" onclick="deleteHoliday()"><i class="fas fa-times"></i><span>' + '</li>';
    if(date == '' && name != ''){
        document.getElementById('input-dateHoliday').classList.add('input-error');
    }else if(date!='' && name == ''){
        document.getElementById('input-nameHoliday').classList.add('input-error');
    }else if(date == '' && name == ''){
        document.getElementById('input-dateHoliday').classList.add('input-error');
        document.getElementById('input-nameHoliday').classList.add('input-error');
    }else if(date!='' && name != ''){
        $('#box-holiday').append(listHoliday);
        $('#noHoliday').text('');
        $('#noHoliday').css('display','none');
        document.getElementById('input-dateHoliday').classList.remove('input-error');
        document.getElementById('input-nameHoliday').classList.remove('input-error');
        document.getElementById('btn-addHoliday').style.display = 'block';
        document.getElementById('input-addHoliday').style.display = 'none';
        document.getElementById('input-dateHoliday').value = '';
        document.getElementById('input-nameHoliday').value = '';
    }
}
//ปุ่มปิด input 
function closeHoliday(){
    document.getElementById('input-dateHoliday').value = '';
    document.getElementById('input-nameHoliday').value = '';
    document.getElementById('btn-addHoliday').style.display = 'block';
    document.getElementById('input-addHoliday').style.display = 'none';
}
//ปุ่มลบ วันหยุด
function deleteHoliday(){
    //เช็คดูว่าใน ul มี li กี่ตัว
    var x = $('ul#box-holiday li').length;
    var a = '<li class="text-sub" id="noHoliday">No holidays</li>'
    var y = $('.delete-Holiday').parent();
    console.log(y);
    console.log('x is' + x);
    y.detach()
    console.log('x.y is' + x);
    if(x == 2){
        $('#box-holiday').append(a);
        console.log('yo')
    }
}

