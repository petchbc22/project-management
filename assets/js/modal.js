// 1.สำหรับหน้า icon cog หน้า dataform text input
function lengthCharacters(){
    var minlength = document.getElementById("minimumlength");
    var maxlength = document.getElementById("maximumlength");
    var min = minlength.value;
    var max = maxlength.value;
    if(min > 1 || max < 255){
        document.getElementById("btn-reset").disabled = false;
        document.getElementById("btn-reset").classList.add("btn-normal");
        document.getElementById("btn-reset").classList.remove("btn-unclick");
    }else{
        document.getElementById("btn-reset").disabled = true;
        document.getElementById("btn-reset").classList.remove("btn-normal");
        document.getElementById("btn-reset").classList.add("btn-unclick");
    }
}

// 4.สำหรับหน้า icon cog หน้า dataform dropdown เป็นตัวเดียวที่เกิดขึ้นเมื่อมีการคลิกปุ่มadd
function dropdownvalue(){
    //ตรวจสอบว่าใน textarea มีค่าไหม
    var textareaValue = document.getElementById('FormControlTextareadropdown').value;
    //ถ้าหากมี
    if(textareaValue != ''){
        $('#FormControlSelectDropdown').children('option:not(:first)').remove();
        //ปุ่ม save กับ reset จะแสดงผล
        document.getElementById('btn-save-dropdown').disabled = false;
        document.getElementById('btn-save-dropdown').classList.add("btn-green");
        document.getElementById('btn-save-dropdown').classList.remove("btn-unclick");
        document.getElementById("btn-reset-dropdown").disabled = false;
        document.getElementById("btn-reset-dropdown").classList.add("btn-normal");
        document.getElementById("btn-reset-dropdown").classList.remove("btn-unclick");
        // dropdown แสดงผล
        document.getElementById('FormControlSelectDropdown').disabled = false;
        // เก็บค่าtextarea แต่ละบรรทัดลง array ชื่อ 'arrayTextarea'
        var arrayTextarea = textareaValue.split("\n");
        //เช็คว่าสมาชิกตัวไหนมีค่าว่างไหม
        for(i = 0; i < arrayTextarea.length; i++){
            if(arrayTextarea[i] != ''){
                document.getElementById('ErrorTextAlert').style.visibility = "hidden";
                var x = arrayTextarea[0];
                if(arrayTextarea.length > 1){
                    for(i = 1; i < arrayTextarea.length; i++){
                        if(x != arrayTextarea[i]){
                            for(i = 0; i < arrayTextarea.length; i++){
                                $('#FormControlSelectDropdown').append("<option>"+arrayTextarea[i]+"</option>");
                            }
                        }
                        else{
                            document.getElementById('ErrorTextAlert').style.visibility = "visible";
                            document.getElementById('ErrorTextAlert').innerHTML = "Values should be unique"
                            for(i = 0; i < arrayTextarea.length; i++){
                                $('#FormControlSelectDropdown').append("<option>"+arrayTextarea[i]+"</option>");
                            }
                        }
                    }
                }else{
                    for(i = 0; i < arrayTextarea.length; i++){
                        $('#FormControlSelectDropdown').append("<option>"+arrayTextarea[i]+"</option>");
                    }
                }
            }else{
                document.getElementById('ErrorTextAlert').style.visibility = "visible";
                document.getElementById('ErrorTextAlert').innerHTML = "Values cannot be empty"
            }
        }

    //ถ้าหากไม่มี จะไม่แสดงdropdown
    }else{
        document.getElementById('FormControlSelectDropdown').disabled = true;
    } 
}
// 6.สำหรับหน้า icon cog หน้า dataform files upload
function countfileupload(){
    var files = document.getElementById("countfile");
    var countfile = files.value;
    if(countfile < 10){
        document.getElementById("btn-reset-file").disabled = false;
        document.getElementById("btn-reset-file").classList.add("btn-normal");
        document.getElementById("btn-reset-file").classList.remove("btn-unclick");
    }
    else{
        document.getElementById("btn-reset-file").disabled = true;
        document.getElementById("btn-reset-file").classList.remove("btn-normal");
        document.getElementById("btn-reset-file").classList.add("btn-unclick");
    }
}

// 7.สำหรับหน้า icon cog หน้า dataform Money
function countMoney(){
    var maxMoney = document.getElementById("max-money").value;
    var minMoney = document.getElementById("min-money").value;
    if(minMoney != 0 || maxMoney != 0){
        document.getElementById("btn-reset-money").disabled = false;
        document.getElementById("btn-reset-money").classList.add("btn-normal");
        document.getElementById("btn-reset-money").classList.remove("btn-unclick");
    }else{
        document.getElementById("btn-reset-money").disabled = true;
        document.getElementById("btn-reset-money").classList.remove("btn-normal");
        document.getElementById("btn-reset-money").classList.add("btn-unclick");
    }
}

// 8.สำหรับหน้า icon cog หน้า dataform multiline
function lengthMultiline(){
    var minMul = document.getElementById("min-multi").value;
    var maxMul = document.getElementById("max-multi").value;
    if(minMul > 1 || maxMul < 2000){
        document.getElementById("btn-reset-multi").disabled = false;
        document.getElementById("btn-reset-multi").classList.add("btn-normal");
        document.getElementById("btn-reset-multi").classList.remove("btn-unclick");
    }else{
        document.getElementById("btn-reset-multi").disabled = true;
        document.getElementById("btn-reset-multi").classList.remove("btn-normal");
        document.getElementById("btn-reset-multi").classList.add("btn-unclick");
    }
}
// 9.สำหรับหน้า icon cog หน้า dataform multiselect
function multiselect(){
    var x = document.getElementById('FormControlTextareaMultiselect').value;
    if(x != ''){
        document.getElementById('btn-save-multiselect').disabled = false;
        document.getElementById('btn-save-multiselect').classList.add("btn-green");
        document.getElementById('btn-save-multiselect').classList.remove("btn-unclick");
        document.getElementById("btn-reset-multiselect").disabled = false;
        document.getElementById("btn-reset-multiselect").classList.add("btn-normal");
        document.getElementById("btn-reset-multiselect").classList.remove("btn-unclick");
    }else{
        document.getElementById("btn-save-multiselect").disabled = true;
        document.getElementById("btn-save-multiselect").classList.remove("btn-normal");
        document.getElementById("btn-save-multiselect").classList.add("btn-unclick");
        document.getElementById("btn-reset-multiselect").disabled = true;
        document.getElementById("btn-reset-multiselect").classList.remove("btn-normal");
        document.getElementById("btn-reset-multiselect").classList.add("btn-unclick");
    }
}
// 10. สำหรับหน้า icon cog หน้า dataform Number
function checkNumber(){
    var checkBox = document.getElementById('CheckNumberBox').checked;
    var precision = document.getElementById('PrecisionNumber');
    var numberMin = document.getElementById('numberMin');
    var numberMax = document.getElementById('numberMax');
    if(checkBox == true || precision != 2 || numberMax != '' || numberMin != ''){
        document.getElementById("btn-reset-number").disabled = false;
        document.getElementById("btn-reset-number").classList.add("btn-normal");
        document.getElementById("btn-reset-number").classList.remove("btn-unclick");
    }
}

// 12.สำหรับหน้า icon cog หน้า dataform Yes No
function chooseYesNo(){
    var x = document.getElementById("yesno").value;
    var z = 'yes';
    var a = 'no';
    if(x == z || x == a){
        document.getElementById("btn-reset-yesNo").disabled = false;
        document.getElementById("btn-reset-yesNo").classList.add("btn-normal");
        document.getElementById("btn-reset-yesNo").classList.remove("btn-unclick");
    }else{
        document.getElementById("btn-reset-yesNo").disabled = true;
        document.getElementById("btn-reset-yesNo").classList.remove("btn-normal");
        document.getElementById("btn-reset-yesNo").classList.add("btn-unclick");
    }
}
// ปุ่ม reset
function resetlengthCharacters(number){
    // Text input
    if(number == 1){
        document.getElementById("minimumlength").value = 1;
        document.getElementById("maximumlength").value = 255;
        document.getElementById("btn-reset").disabled = true;
        document.getElementById("btn-reset").classList.remove("btn-normal");
        document.getElementById("btn-reset").classList.add("btn-unclick");
    }
    //date
    else if(number == 2){
        document.getElementById("dateStart").value = '';
        document.getElementById("dateEnd").value = '';
    }
    //date&time
    else if(number == 3){
        document.getElementById("dateTimeMin").value = '';
        document.getElementById("dateTimeMax").value = '';
    }
    //dropdown
    else if(number == 4){
        document.getElementById('FormControlTextareadropdown').value = '';
        document.getElementById("btn-save-dropdown").disabled = true;
        document.getElementById("btn-save-dropdown").classList.remove("btn-green");
        document.getElementById("btn-save-dropdown").classList.add("btn-unclick");
        document.getElementById("btn-reset-dropdown").disabled = true;
        document.getElementById("btn-reset-dropdown").classList.remove("btn-normal");
        document.getElementById("btn-reset-dropdown").classList.add("btn-unclick");
    }
    //file upload
    else if(number == 6){
        document.getElementById("countfile").value = 10;
        document.getElementById("btn-reset-file").disabled = true;
        document.getElementById("btn-reset-file").classList.remove("btn-normal");
        document.getElementById("btn-reset-file").classList.add("btn-unclick");
    }
    //money
    else if(number == 7){
        document.getElementById("max-money").value = 0;
        document.getElementById("min-money").value = 0;
        document.getElementById("btn-reset-money").disabled = true;
        document.getElementById("btn-reset-money").classList.remove("btn-normal");
        document.getElementById("btn-reset-money").classList.add("btn-unclick")
    }
    //multiline
    else if(number == 8){
        document.getElementById("min-multi").value = 1;
        document.getElementById("max-multi").value = 2000;
        document.getElementById("btn-reset-multi").disabled = true;
        document.getElementById("btn-reset-multi").classList.remove("btn-normal");
        document.getElementById("btn-reset-multi").classList.add("btn-unclick");
    }
    //multiselect
    else if(number == 9){
        document.getElementById('FormControlTextareaMultiselect').value = '';
        document.getElementById("btn-save-multiselect").disabled = true;
        document.getElementById("btn-save-multiselect").classList.remove("btn-green");
        document.getElementById("btn-save-multiselect").classList.add("btn-unclick");
        document.getElementById("btn-reset-multiselect").disabled = true;
        document.getElementById("btn-reset-multiselect").classList.remove("btn-normal");
        document.getElementById("btn-reset-multiselect").classList.add("btn-unclick");
    }
    //number
    else if(number == 10){
        document.getElementById('CheckNumberBox').checked = false;
        document.getElementById('PrecisionNumber').value = 2;
        document.getElementById('numberMin').value = '';
        document.getElementById('numberMax').value = '';
        document.getElementById("btn-reset-number").disabled = true;
        document.getElementById("btn-reset-number").classList.remove("btn-normal");
        document.getElementById("btn-reset-number").classList.add("btn-unclick");
    }
    //user****
    else if(number == 11){
        document.getElementById("btn-reset-user").disabled = true;
        document.getElementById("btn-reset-user").classList.remove("btn-normal");
        document.getElementById("btn-reset-user").classList.add("btn-unclick");
    }
    //yes No
    else if(number == 12){
        document.getElementById("yesno").value = 'empty value';
        document.getElementById("btn-reset-yesNo").disabled = true;
        document.getElementById("btn-reset-yesNo").classList.remove("btn-normal");
        document.getElementById("btn-reset-yesNo").classList.add("btn-unclick");
    }

    
}


