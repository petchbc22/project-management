//ใช้กับหน้า creat Tem / Edit Tem / InTem
function openRightSide(){
    function myFunction(x) {
        if (x.matches) { 
            document.getElementById("LeftSideBox-List").style.display = "none";
            document.getElementById("RightSideBox-Detail").style.display = "block";
            document.getElementById("LeftSide-List").style.display = "none";
            document.getElementById("RightSide-Detail").style.display = "block"
        } else {
            document.getElementById("LeftSideBox-List").style.display = "block";
            document.getElementById("RightSideBox-Detail").style.display = "block";
            document.getElementById("LeftSide-List").style.display = "none";
            document.getElementById("RightSide-Detail").style.display = "none"
        }
    } 
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction) 
}
function openLeftSide(){
    function myFunction(x) {
        if (x.matches) {
            document.getElementById("LeftSideBox-List").style.display = "block";
            document.getElementById("RightSideBox-Detail").style.display = "none";
            document.getElementById("LeftSide-List").style.display = "block";
            document.getElementById("RightSide-Detail").style.display = "none";
        }else {
            document.getElementById("LeftSideBox-List").style.display = "block";
            document.getElementById("RightSideBox-Detail").style.display = "block";
            document.getElementById("LeftSide-List").style.display = "none";
            document.getElementById("RightSide-Detail").style.display = "none";
        }
    }
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction) 
}

//inprocess
function openCommmentSide(){
    function myFunction(x) {
        if (x.matches) { 
            document.getElementById("LeftSide-item").style.display = "none";
            document.getElementById("RightSide-comment").style.display = "block";
            document.getElementById("btn-commentSide").style.display = "none";
            document.getElementById("btn-OpenComment").style.display = "block"
        } else {
            document.getElementById("LeftSide-item").style.display = "block";
            document.getElementById("RightSide-comment").style.display = "block";
            document.getElementById("btn-commentSide ").style.display = "none";
            document.getElementById("btn-OpenComment").style.display = "none"
        }
    } 
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction)
}
function closeCommentSide(){
    function myFunction(x) {
        if (x.matches) { 
            document.getElementById("LeftSide-item").style.display = "block";
            document.getElementById("RightSide-comment").style.display = "none";
            document.getElementById("btn-commentSide").style.display = "block";
            document.getElementById("btn-OpenComment").style.display = "none"
        } else {
            document.getElementById("LeftSide-item").style.display = "block";
            document.getElementById("RightSide-comment").style.display = "block";
            document.getElementById("btn-commentSide").style.display = "none";
            document.getElementById("btn-OpenComment").style.display = "none"
        }
    } 
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction)
}

//web setting
function openUser(){
    function myFunction(x) {
        if (x.matches) { 
            document.getElementById("RightSide-user").style.display = "block";
            document.getElementById("LeftSide-user").style.display = "none";
        } else {
            document.getElementById("RightSide-user").style.display = "block";
            document.getElementById("LeftSide-user").style.display = "block";
        }
    } 
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction)
}
function openGroup(){
    function myFunction(x) {
        if (x.matches) { 
            document.getElementById("RightSide-group").style.display = "block";
            document.getElementById("LeftSide-group").style.display = "none";
        } else {
            document.getElementById("RightSide-group").style.display = "block";
            document.getElementById("LeftSide-group").style.display = "block";
        }
    } 
    var x = window.matchMedia("(max-width: 1022px)")
    myFunction(x) 
    x.addListener(myFunction)
}

function closeSelf(){
    $('.box-right-side').css('display','none');
    $('.box-left-side').css('display','block');
}



