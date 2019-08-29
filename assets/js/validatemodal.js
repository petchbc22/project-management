  $(function() {
        $('#Casting_Talent_cls').change(function(){
        //alert($(this).val());
            if ($('#Casting_Talent_cls').children().eq(3).val() != "" && $('#Casting_Talent_cls').children().eq(5).val() != "" ) {
                $( ".Casting_Talent_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Casting_Talent_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Location_Survey_Cost_cls').change(function(){
        //alert($(this).val());
            if ($('#Location_Survey_Cost_cls').children().eq(3).val() != "" && $('#Location_Survey_Cost_cls').children().eq(5).val() != "" ) {
                $( ".Location_Survey_Cost_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Location_Survey_Cost_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Storyline_writing_cls').change(function(){
        //alert($(this).val());
            if ($('#Storyline_writing_cls').children().eq(3).val() != "" && $('#Storyline_writing_cls').children().eq(5).val() != "" ) {
                $( ".Storyline_writing_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Storyline_writing_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Storyboard_cls').change(function(){
        //alert($(this).val());
            if ($('#Storyboard_cls').children().eq(3).val() != "" && $('#Storyboard_cls').children().eq(5).val() != "" ) {
                $( ".Storyboard_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Storyboard_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Script_cls').change(function(){
        //alert($(this).val());
            if ($('#Script_cls').children().eq(3).val() != "" && $('#Script_cls').children().eq(5).val() != "" ) {
                $( ".Script_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Script_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Camera_operator_cls').change(function(){
        //alert($(this).val());
            if ($('#Camera_operator_cls').children().eq(3).val() != "" && $('#Camera_operator_cls').children().eq(5).val() != "" ) {
                $( ".Camera_operator_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Camera_operator_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Assistance_camera_operator_cls').change(function(){
        //alert($(this).val());
            if ($('#Assistance_camera_operator_cls').children().eq(3).val() != "" && $('#Assistance_camera_operator_cls').children().eq(5).val() != "" ) {
                $( ".Assistance_camera_operator_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Assistance_camera_operator_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Director_cls').change(function(){
        //alert($(this).val());
            if ($('#Director_cls').children().eq(3).val() != "" && $('#Director_cls').children().eq(5).val() != "" ) {
                $( ".Director_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Director_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Assistance_Director_cls').change(function(){
        //alert($(this).val());
            if ($('#Assistance_Director_cls').children().eq(3).val() != "" && $('#Assistance_Director_cls').children().eq(5).val() != "" ) {
                $( ".Assistance_Director_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Assistance_Director_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#producer_cls').change(function(){
        //alert($(this).val());
            if ($('#producer_cls').children().eq(3).val() != "" && $('#producer_cls').children().eq(5).val() != "" ) {
                $( ".producer_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".producer_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#staff_cls').change(function(){
        //alert($(this).val());
            if ($('#staff_cls').children().eq(3).val() != "" && $('#staff_cls').children().eq(5).val() != "" ) {
                $( ".staff_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".staff_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Gear_cls').change(function(){
        //alert($(this).val());
            if ($('#Gear_cls').children().eq(3).val() != "" && $('#Gear_cls').children().eq(5).val() != "" ) {
                $( ".Gear_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Gear_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Editing_cls').change(function(){
        //alert($(this).val());
            if ($('#Editing_cls').children().eq(3).val() != "" && $('#Editing_cls').children().eq(5).val() != "" ) {
                $( ".Editing_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Editing_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Text_Info_cls').change(function(){
        //alert($(this).val());
            if ($('#Text_Info_cls').children().eq(3).val() != "" && $('#Text_Info_cls').children().eq(5).val() != "" ) {
                $( ".Text_Info_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Text_Info_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
        });
        $('#Song_cls').change(function(){
        //alert($(this).val());
            if ($('#Song_cls').children().eq(3).val() != "" && $('#Song_cls').children().eq(5).val() != "" ) {
                $( ".Song_val" ).html("<i class='fas fa-check text-success'></i>");
            } else{
                $( ".Song_val" ).html("<i class='fas fa-times text-danger'></i>");
            } 
      
        });  
    }); 