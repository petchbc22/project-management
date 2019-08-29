        // check checkbox 
        $('#submit-val').click(function(){
            // for project info
            var name_project = $('#pj_name').val();
            var due_date = $('#pj_duedate').val();
            $('.name_project_val').val(name_project);
            $('.due_date_val').val(due_date);
            // pre production true or false
            if($('#Casting_Talent').prop("checked") == true){
                // $( ".Casting_Talent_val" ).html("<i class='fas fa-check text-success'></i>");
                $( "#main_Casting_Talent" ).removeClass('d-none');
                // prepare to use ajax
                // pt_id
                $("#Casting_Talent_cls #js_pt_id").attr('id','pt_id');
                $("#Casting_Talent_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Casting_Talent_cls #js_task_name").attr('id','task_name');
                $("#Casting_Talent_cls #task_name").attr('name','task_name[]');
                $("#Casting_Talent_cls #task_name").val('Casting Talent');
                // task_duedate
                $("#Casting_Talent_cls #js_task_duedate").attr('id','task_duedate');
                $("#Casting_Talent_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Casting_Talent_cls #js_task_detail").attr('id','task_detail');
                $("#Casting_Talent_cls #task_detail").attr('name','task_detail[]');
                
            }
            if($('#Casting_Talent').prop("checked") == false){
                $( "#main_Casting_Talent" ).addClass('d-none');
                // hide cls if expand 
                $("#Casting_Talent_cls").removeClass("show");
                // taskname
                $("#Casting_Talent_cls #task_name").attr('id','js_task_name');
                $("#Casting_Talent_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Casting_Talent_cls #pt_id").attr('id','js_pt_id');
                $("#Casting_Talent_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Casting_Talent_cls #task_duedate").attr('id','js_task_duedate');
                $("#Casting_Talent_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Casting_Talent_cls #task_detail").attr('id','js_task_detail');
                $("#Casting_Talent_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Location_Survey_Cost').prop("checked") == true){
                $( "#main_Location_Survey_Cost" ).removeClass('d-none');
                     // prepare to use ajax
                     // pt_id
                $("#Location_Survey_Cost_cls #js_pt_id").attr('id','pt_id');
                $("#Location_Survey_Cost_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Location_Survey_Cost_cls #js_task_name").attr('id','task_name');
                $("#Location_Survey_Cost_cls #task_name").attr('name','task_name[]');
                $("#Location_Survey_Cost_cls #task_name").val('Location Survey Cost');
                // task_duedate
                $("#Location_Survey_Cost_cls #js_task_duedate").attr('id','task_duedate');
                $("#Location_Survey_Cost_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Location_Survey_Cost_cls #js_task_detail").attr('id','task_detail');
                $("#Location_Survey_Cost_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Location_Survey_Cost').prop("checked") == false){
                $( "#main_Location_Survey_Cost" ).addClass('d-none');
                // hide cls if expand 
                $("#Location_Survey_Cost_cls").removeClass("show");
                // taskname
                $("#Location_Survey_Cost_cls #task_name").attr('id','js_task_name');
                $("#Location_Survey_Cost_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Location_Survey_Cost_cls #pt_id").attr('id','js_pt_id');
                $("#Location_Survey_Cost_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Location_Survey_Cost_cls #task_duedate").attr('id','js_task_duedate');
                $("#Location_Survey_Cost_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Location_Survey_Cost_cls #task_detail").attr('id','js_task_detail');
                $("#Location_Survey_Cost_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Storyline_writing').prop("checked") == true){
                $( "#main_Storyline_writing" ).removeClass('d-none');
                // prepare to use ajax
                // pt_id
                $("#Storyline_writing_cls #js_pt_id").attr('id','pt_id');
                $("#Storyline_writing_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Storyline_writing_cls #js_task_name").attr('id','task_name');
                $("#Storyline_writing_cls #task_name").attr('name','task_name[]');
                $("#Storyline_writing_cls #task_name").val('Storyline writing');
                // task_duedate
                $("#Storyline_writing_cls #js_task_duedate").attr('id','task_duedate');
                $("#Storyline_writing_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Storyline_writing_cls #js_task_detail").attr('id','task_detail');
                $("#Storyline_writing_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Storyline_writing').prop("checked") == false){
                $( "#main_Storyline_writing" ).addClass('d-none');
                // hide cls if expand 
                $("#Storyline_writing_cls").removeClass("show");
                // taskname
                $("#Storyline_writing_cls #task_name").attr('id','js_task_name');
                $("#Storyline_writing_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Storyline_writing_cls #pt_id").attr('id','js_pt_id');
                $("#Storyline_writing_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Storyline_writing_cls #task_duedate").attr('id','js_task_duedate');
                $("#Storyline_writing_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Storyline_writing_cls #task_detail").attr('id','js_task_detail');
                $("#Storyline_writing_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Storyboard').prop("checked") == true){
                $( "#main_Storyboard" ).removeClass('d-none');
                     // prepare to use ajax
                     // pt_id
                $("#Storyboard_cls #js_pt_id").attr('id','pt_id');
                $("#Storyboard_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Storyboard_cls #js_task_name").attr('id','task_name');
                $("#Storyboard_cls #task_name").attr('name','task_name[]');
                $("#Storyboard_cls #task_name").val('Storyboard');
                // task_duedate
                $("#Storyboard_cls #js_task_duedate").attr('id','task_duedate');
                $("#Storyboard_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Storyboard_cls #js_task_detail").attr('id','task_detail');
                $("#Storyboard_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Storyboard').prop("checked") == false){
                $( "#main_Storyboard" ).addClass('d-none');
                // hide cls if expand 
                $("#Storyboard_cls").removeClass("show");
                // taskname
                $("#Storyboard_cls #task_name").attr('id','js_task_name');
                $("#Storyboard_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Storyboard_cls #pt_id").attr('id','js_pt_id');
                $("#Storyboard_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Storyboard_cls #task_duedate").attr('id','js_task_duedate');
                $("#Storyboard_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Storyboard_cls #task_detail").attr('id','js_task_detail');
                $("#Storyboard_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Script').prop("checked") == true){
                $( "#main_Script" ).removeClass('d-none');
                     // prepare to use ajax
                               // pt_id
                $("#Script_cls #js_pt_id").attr('id','pt_id');
                $("#Script_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Script_cls #js_task_name").attr('id','task_name');
                $("#Script_cls #task_name").attr('name','task_name[]');
                $("#Script_cls #task_name").val('Script');
                // task_duedate
                $("#Script_cls #js_task_duedate").attr('id','task_duedate');
                $("#Script_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Script_cls #js_task_detail").attr('id','task_detail');
                $("#Script_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Script').prop("checked") == false){
                $( "#main_Script" ).addClass('d-none');
                // hide cls if expand 
                $("#Script_cls").removeClass("show");
                // taskname
                $("#Script_cls #task_name").attr('id','js_task_name');
                $("#Script_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Script_cls #pt_id").attr('id','js_pt_id');
                $("#Script_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Script_cls #task_duedate").attr('id','js_task_duedate');
                $("#Script_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Script_cls #task_detail").attr('id','js_task_detail');
                $("#Script_cls #js_task_detail").attr('name','js_task_detail');
            }
            // production true or false //

            if($('#Camera_operator').prop("checked") == true){
                $( "#main_Camera_operator" ).removeClass('d-none');
                     // prepare to use ajax
                // pt_id
                $("#Camera_operator_cls #js_pt_id").attr('id','pt_id');
                $("#Camera_operator_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Camera_operator_cls #js_task_name").attr('id','task_name');
                $("#Camera_operator_cls #task_name").attr('name','task_name[]');
                $("#Camera_operator_cls #task_name").val('Camera operator');
                // task_duedate
                $("#Camera_operator_cls #js_task_duedate").attr('id','task_duedate');
                $("#Camera_operator_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Camera_operator_cls #js_task_detail").attr('id','task_detail');
                $("#Camera_operator_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Camera_operator').prop("checked") == false){
                $( "#main_Camera_operator" ).addClass('d-none');
                // hide cls if expand 
                $("#Camera_operator_cls").removeClass("show");
                // taskname
                $("#Camera_operator_cls #task_name").attr('id','js_task_name');
                $("#Camera_operator_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Camera_operator_cls #pt_id").attr('id','js_pt_id');
                $("#Camera_operator_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Camera_operator_cls #task_duedate").attr('id','js_task_duedate');
                $("#Camera_operator_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Camera_operator_cls #task_detail").attr('id','js_task_detail');
                $("#Camera_operator_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Assistance_camera_operator').prop("checked") == true){
                $( "#main_Assistance_camera_operator" ).removeClass('d-none');
                     // prepare to use ajax
                    // pt_id
                $("#Assistance_camera_operator_cls #js_pt_id").attr('id','pt_id');
                $("#Assistance_camera_operator_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Assistance_camera_operator_cls #js_task_name").attr('id','task_name');
                $("#Assistance_camera_operator_cls #task_name").attr('name','task_name[]');
                $("#Assistance_camera_operator_cls #task_name").val('Assistance camera operator');
                // task_duedate
                $("#Assistance_camera_operator_cls #js_task_duedate").attr('id','task_duedate');
                $("#Assistance_camera_operator_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Assistance_camera_operator_cls #js_task_detail").attr('id','task_detail');
                $("#Assistance_camera_operator_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Assistance_camera_operator').prop("checked") == false){
                $( "#main_Assistance_camera_operator" ).addClass('d-none');
                 // hide cls if expand 
                 $("#Assistance_camera_operator_cls").removeClass("show");
                 // taskname
                 $("#Assistance_camera_operator_cls #task_name").attr('id','js_task_name');
                 $("#Assistance_camera_operator_cls #js_task_name").attr('name','js_task_name');
                 // ptid
                 $("#Assistance_camera_operator_cls #pt_id").attr('id','js_pt_id');
                 $("#Assistance_camera_operator_cls #js_pt_id").attr('name','js_pt_id');
                 // taskduedate
                 $("#Assistance_camera_operator_cls #task_duedate").attr('id','js_task_duedate');
                 $("#Assistance_camera_operator_cls #js_task_duedate").attr('name','js_task_duedate');
                 // taskdetail
                 $("#Assistance_camera_operator_cls #task_detail").attr('id','js_task_detail');
                 $("#Assistance_camera_operator_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Director').prop("checked") == true){
                $( "#main_Director" ).removeClass('d-none');
                     // prepare to use ajax
                        // pt_id
                $("#Director_cls #js_pt_id").attr('id','pt_id');
                $("#Director_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Director_cls #js_task_name").attr('id','task_name');
                $("#Director_cls #task_name").attr('name','task_name[]');
                $("#Director_cls #task_name").val('Director');
                // task_duedate
                $("#Director_cls #js_task_duedate").attr('id','task_duedate');
                $("#Director_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Director_cls #js_task_detail").attr('id','task_detail');
                $("#Director_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Director').prop("checked") == false){
                $( "#main_Director" ).addClass('d-none');
                // hide cls if expand 
                $("#Director_cls").removeClass("show");
                // taskname
                $("#Director_cls #task_name").attr('id','js_task_name');
                $("#Director_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Director_cls #pt_id").attr('id','js_pt_id');
                $("#Director_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Director_cls #task_duedate").attr('id','js_task_duedate');
                $("#Director_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Director_cls #task_detail").attr('id','js_task_detail');
                $("#Director_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Assistance_Director').prop("checked") == true){
                $( "#main_Assistance_Director" ).removeClass('d-none');
                     // prepare to use ajax
                // pt_id
                $("#Assistance_Director_cls #js_pt_id").attr('id','pt_id');
                $("#Assistance_Director_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Assistance_Director_cls #js_task_name").attr('id','task_name');
                $("#Assistance_Director_cls #task_name").attr('name','task_name[]');
                $("#Assistance_Director_cls #task_name").val('Assistance Director');
                // task_duedate
                $("#Assistance_Director_cls #js_task_duedate").attr('id','task_duedate');
                $("#Assistance_Director_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Assistance_Director_cls #js_task_detail").attr('id','task_detail');
                $("#Assistance_Director_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Assistance_Director').prop("checked") == false){
                $( "#main_Assistance_Director" ).addClass('d-none');
                // hide cls if expand 
                $("#Assistance_Director_cls").removeClass("show");
                // taskname
                $("#Assistance_Director_cls #task_name").attr('id','js_task_name');
                $("#Assistance_Director_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Assistance_Director_cls #pt_id").attr('id','js_pt_id');
                $("#Assistance_Director_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Assistance_Director_cls #task_duedate").attr('id','js_task_duedate');
                $("#Assistance_Director_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Assistance_Director_cls #task_detail").attr('id','js_task_detail');
                $("#Assistance_Director_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#producer').prop("checked") == true){
                $( "#main_producer" ).removeClass('d-none');
                     // prepare to use ajax
                    // pt_id
                $("#producer_cls #js_pt_id").attr('id','pt_id');
                $("#producer_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#producer_cls #js_task_name").attr('id','task_name');
                $("#producer_cls #task_name").attr('name','task_name[]');
                $("#producer_cls #task_name").val('producer');
                // task_duedate
                $("#producer_cls #js_task_duedate").attr('id','task_duedate');
                $("#producer_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#producer_cls #js_task_detail").attr('id','task_detail');
                $("#producer_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#producer').prop("checked") == false){
                $( "#main_producer" ).addClass('d-none');
                // hide cls if expand 
                $("#producer_cls").removeClass("show");
                // taskname
                $("#producer_cls #task_name").attr('id','js_task_name');
                $("#producer_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#producer_cls #pt_id").attr('id','js_pt_id');
                $("#producer_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#producer_cls #task_duedate").attr('id','js_task_duedate');
                $("#producer_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#producer_cls #task_detail").attr('id','js_task_detail');
                $("#producer_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#staff').prop("checked") == true){
                $( "#main_staff" ).removeClass('d-none');
                     // prepare to use ajax
                // pt_id
                $("#staff_cls #js_pt_id").attr('id','pt_id');
                $("#staff_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#staff_cls #js_task_name").attr('id','task_name');
                $("#staff_cls #task_name").attr('name','task_name[]');
                $("#staff_cls #task_name").val('staff');
                // task_duedate
                $("#staff_cls #js_task_duedate").attr('id','task_duedate');
                $("#staff_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#staff_cls #js_task_detail").attr('id','task_detail');
                $("#staff_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#staff').prop("checked") == false){
                $( "#main_staff" ).addClass('d-none');
                // hide cls if expand 
                $("#staff_cls").removeClass("show");
                // taskname
                $("#staff_cls #task_name").attr('id','js_task_name');
                $("#staff_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#staff_cls #pt_id").attr('id','js_pt_id');
                $("#staff_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#staff_cls #task_duedate").attr('id','js_task_duedate');
                $("#staff_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#staff_cls #task_detail").attr('id','js_task_detail');
                $("#staff_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Gear').prop("checked") == true){
                $( "#main_Gear" ).removeClass('d-none');
                     // prepare to use ajax
                // pt_id
                $("#Gear_cls #js_pt_id").attr('id','pt_id');
                $("#Gear_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Gear_cls #js_task_name").attr('id','task_name');
                $("#Gear_cls #task_name").attr('name','task_name[]');
                $("#Gear_cls #task_name").val('Gear');
                // task_duedate
                $("#Gear_cls #js_task_duedate").attr('id','task_duedate');
                $("#Gear_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Gear_cls #js_task_detail").attr('id','task_detail');
                $("#Gear_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Gear').prop("checked") == false){
                $( "#main_Gear" ).addClass('d-none');
                // hide cls if expand 
                $("#Gear_cls").removeClass("show");
                // taskname
                $("#Gear_cls #task_name").attr('id','js_task_name');
                $("#Gear_cls #js_task_name").attr('name','js_task_name');
                // ptid
                $("#Gear_cls #pt_id").attr('id','js_pt_id');
                $("#Gear_cls #js_pt_id").attr('name','js_pt_id');
                // taskduedate
                $("#Gear_cls #task_duedate").attr('id','js_task_duedate');
                $("#Gear_cls #js_task_duedate").attr('name','js_task_duedate');
                // taskdetail
                $("#Gear_cls #task_detail").attr('id','js_task_detail');
                $("#Gear_cls #js_task_detail").attr('name','js_task_detail');
            }
            // Post Production
            if($('#Editing').prop("checked") == true){
                $( "#main_Editing" ).removeClass('d-none');
                // prepare to use ajax
                // pt_id
                $("#Editing_cls #js_pt_id").attr('id','pt_id');
                $("#Editing_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Editing_cls #js_task_name").attr('id','task_name');
                $("#Editing_cls #task_name").attr('name','task_name[]');
                $("#Editing_cls #task_name").val('Editing');
                // task_duedate
                $("#Editing_cls #js_task_duedate").attr('id','task_duedate');
                $("#Editing_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Editing_cls #js_task_detail").attr('id','task_detail');
                $("#Editing_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Editing').prop("checked") == false){
                $( "#main_Editing" ).addClass('d-none');
                 // hide cls if expand 
                 $("#Editing_cls").removeClass("show");
                 // taskname
                 $("#Editing_cls #task_name").attr('id','js_task_name');
                 $("#Editing_cls #js_task_name").attr('name','js_task_name');
                 // ptid
                 $("#Editing_cls #pt_id").attr('id','js_pt_id');
                 $("#Editing_cls #js_pt_id").attr('name','js_pt_id');
                 // taskduedate
                 $("#Editing_cls #task_duedate").attr('id','js_task_duedate');
                 $("#Editing_cls #js_task_duedate").attr('name','js_task_duedate');
                 // taskdetail
                 $("#Editing_cls #task_detail").attr('id','js_task_detail');
                 $("#Editing_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Text_Info').prop("checked") == true){
                $( "#main_Text_Info" ).removeClass('d-none');
                // prepare to use ajax
                // pt_id
                $("#Text_Info_cls #js_pt_id").attr('id','pt_id');
                $("#Text_Info_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Text_Info_cls #js_task_name").attr('id','task_name');
                $("#Text_Info_cls #task_name").attr('name','task_name[]');
                $("#Text_Info_cls #task_name").val('Text Info');
                // task_duedate
                $("#Text_Info_cls #js_task_duedate").attr('id','task_duedate');
                $("#Text_Info_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Text_Info_cls #js_task_detail").attr('id','task_detail');
                $("#Text_Info_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Text_Info').prop("checked") == false){
                $( "#main_Text_Info" ).addClass('d-none');
                 // hide cls if expand 
                 $("#Text_Info_cls").removeClass("show");
                 // taskname
                 $("#Text_Info_cls #task_name").attr('id','js_task_name');
                 $("#Text_Info_cls #js_task_name").attr('name','js_task_name');
                 // ptid
                 $("#Text_Info_cls #pt_id").attr('id','js_pt_id');
                 $("#Text_Info_cls #js_pt_id").attr('name','js_pt_id');
                 // taskduedate
                 $("#Text_Info_cls #task_duedate").attr('id','js_task_duedate');
                 $("#Text_Info_cls #js_task_duedate").attr('name','js_task_duedate');
                 // taskdetail
                 $("#Text_Info_cls #task_detail").attr('id','js_task_detail');
                 $("#Text_Info_cls #js_task_detail").attr('name','js_task_detail');
            }

            if($('#Song').prop("checked") == true){
                $( "#main_Song" ).removeClass('d-none');
                // prepare to use ajax
                // pt_id
                $("#Song_cls #js_pt_id").attr('id','pt_id');
                $("#Song_cls #pt_id").attr('name','pt_id[]');
                // task_name 
                $("#Song_cls #js_task_name").attr('id','task_name');
                $("#Song_cls #task_name").attr('name','task_name[]');
                $("#Song_cls #task_name").val('Song');
                // task_duedate
                $("#Song_cls #js_task_duedate").attr('id','task_duedate');
                $("#Song_cls #task_duedate").attr('name','task_duedate[]');
                // task_detail
                $("#Song_cls #js_task_detail").attr('id','task_detail');
                $("#Song_cls #task_detail").attr('name','task_detail[]');
            }
            if($('#Song').prop("checked") == false){
                $( "#main_Song" ).addClass('d-none');
                 // hide cls if expand 
                 $("#Song_cls").removeClass("show");
                 // taskname
                 $("#Song_cls #task_name").attr('id','js_task_name');
                 $("#Song_cls #js_task_name").attr('name','js_task_name');
                 // ptid
                 $("#Song_cls #pt_id").attr('id','js_pt_id');
                 $("#Song_cls #js_pt_id").attr('name','js_pt_id');
                 // taskduedate
                 $("#Song_cls #task_duedate").attr('id','js_task_duedate');
                 $("#Song_cls #js_task_duedate").attr('name','js_task_duedate');
                 // taskdetail
                 $("#Song_cls #task_detail").attr('id','js_task_detail');
                 $("#Song_cls #js_task_detail").attr('name','js_task_detail');
            }
            
        });