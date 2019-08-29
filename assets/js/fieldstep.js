   $(document).ready(function() {
        $(".next").click(function() {
            var form = $("#myform");
            form.validate({
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').addClass("has-error");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass("has-error");
                },
                errorPlacement: function(error, element) {
                    if (element.closest('.form-group').find('label.error').length == 0) {
                        error.insertBefore(element.closest('.form-group').find(
                            '.error_message_holder'));
                    }
                },
                rules: {
                    pj_name: {
                        required: true,
                    },
                    pj_duedate: {
                        required: true,
                    },
                    pj_process_start:{
                        required: true,
                    },
                    pj_customer : {
                        required: true,
                    }
                },
                messages: {
                    pj_name: {
                        required: "Name Project Required",
                    },
                    pj_duedate: {
                        required: "Due date Required",
                    },
                    pj_process_start:{
                        required : "Start date Required",
                    },
                    pj_customer : {
                        required : "Customer name Required"
                    }
                }
            });
            if (form.valid() === true) {
                if ($('#info').is(":visible")) {
                    current_fs = $('#info').fadeIn(300);
                    next_fs = $('#pre_production').fadeIn(300);
                    $(".info").addClass("activated");
                    $(".info").removeClass("active");
                    $(".pre-pro").addClass("active");
                    $(".f1-progress-line").removeClass("w-16");
                    $(".f1-progress-line").addClass("w-35");

                } else if ($('#pre_production').is(":visible")) {

                    current_fs = $('#pre_production').fadeIn(300);
                    next_fs = $('#production').fadeIn(300);
                    $(".pre-pro").removeClass("active");
                    $(".pro").addClass("active");
                    $(".pre-pro").addClass("activated");

                    $(".f1-progress-line").removeClass("w-35");
                    $(".f1-progress-line").addClass("w-65");

                } else if ($('#production').is(":visible")) {

                    current_fs = $('#production').fadeIn(300);
                    next_fs = $('#post_production').fadeIn(300);
                    $(".pre-pro").removeClass("active");
                    $(".pro").removeClass("active");
                    $(".pro").addClass("activated");
                    $(".post-pro").addClass("active");
                    $(".f1-progress-line").removeClass("w-65");
                    $(".f1-progress-line").addClass("w-90");
                }

                next_fs.show();
                current_fs.hide();
            }
        });

        $('.previous').click(function() {

            if ($('#pre_production').is(":visible")) {
                current_fs = $('#pre_production').fadeIn(300);
                next_fs = $('#info').fadeIn(300);
                $(".pre-pro").removeClass("active");
                $(".info").addClass("active");
                $(".info").removeClass("activated");
                $(".f1-progress-line").removeClass("w-35");
                $(".f1-progress-line").addClass("w-16");
            } else if ($('#production').is(":visible")) {
                current_fs = $('#production').fadeIn(300);
                next_fs = $('#pre_production').fadeIn(300);
                $(".pro").removeClass("active");
                $(".pre-pro").addClass("active");
                $(".pre-pro").removeClass("activated");
                $(".f1-progress-line").removeClass("w-65");
                $(".f1-progress-line").addClass("w-35");
            } else if ($('#post_production').is(":visible")) {
                current_fs = $('#post_production').fadeIn(300);
                next_fs = $('#production').fadeIn(300);
                $(".post-pro").removeClass("active");
                $(".post-pro").removeClass("activated");
                $(".pro").addClass("active");
                $(".pro").removeClass("activated");
                $(".post-pro").removeClass("activated");
                $(".f1-progress-line").removeClass("w-90");
                $(".f1-progress-line").addClass("w-65");
            }

            next_fs.show();
            current_fs.hide();
        });
    });