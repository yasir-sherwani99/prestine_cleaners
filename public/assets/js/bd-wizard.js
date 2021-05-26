//Wizard 
    
    var form = $("#bookingForm");
    form.validate({
        rules: {
            'cleaning_area_post_code': {
                required: true,
                minlength: 10,
                maxlength: 225
            },
            'service': {
                required: true
            },
            'furnished': {
                required: true
            },
            'property_type': {
                required: true
            },
            'house_parts[]': {
                required: true,
                minlength: 1
            },
            // 'property_inside_design[]': {
            //     required: true,
            //     minlength: 1
            // },
            'carpet_service': {
                required: true  
            },
            'carpet_house_location[]': {
                required: true,
                minlength: 1
            },
            'carpet_rug_material[]': {
                required: true,
                minlength: 1  
            },
            'furniture_items[]': {
                required: true,
                minlength: 1  
            },
            'furniture_material[]': {
                required: true,
                minlength: 1
            },
            'highest_window_location': {
                required: true,
            },
            'window_sides': {
                required: true,
                minlength: 1  
            },
            'window_qty': {
                required: true,
            },
            'oven_type[]': {
                required: true,
                minlength: 1  
            },
            'kitchen_accessory[]': {
                required: true,
                minlength: 1  
            },
            'kitchen_appliances': {
                required: true
            },
            'cleaning_schedule': {
                required: true  
            },
            'pets': {
                required: true  
            },
            'mattress_size2[]': {
                required: true
            },
            'iron': {
                required: true  
            },
            'office_rooms[]': {
                required: true,
                minlength: 1  
            },
            'cleaning_start_date': {
                required: true
            },
            'cleaning_start_time': {
                required: true
            },
            'additional_info': {
                maxlength: 500
            },
            'customer': {
                required: true
            },
            'login_email': {
                required: true,
                email: true
            },
            'login_password': {
                required: true
            },
            'complete_name': {
                required: true,
                minlength: 5,
                maxlength: 100
            },
            'phone': {
                required: true
            },
            'email': {
                required: true,
                email: true
            },
            'password': {
                required: true,
                minlength: 6
            },
            'agreement': {
                required: true  
            }
        },
        messages: {
            'cleaning_area_post_code': {
                required: "Cleaning site address is required."
            },
            'service': {
                required: "Please choose a service."
            },
            'furnished': {
                required: "This field is required."
            },
            'property_type': {
                required: "Please select your property."
            },
            'house_parts[]': {
                required: "This field is required, check at least 1."
            },
            // 'property_inside_design[]': {
            //     required: "This field is required, check at least 1.",
            // },
            'carpet_service': {
                required: "Please select carpet service."
            },
            'carpet_house_location[]': {
                required: "This field is required, check at least 1.",
            },
            'carpet_rug_material[]': {
                required: "This field is required, check at least 1.", 
            },
            'furniture_items[]': {
                required: "This field is required, check at least 1.",  
            },
            'furniture_material[]': {
                 required: "This field is required, check at least 1.",
            },
            'highest_window_location': {
                required: "This field is required.",
            },
            'window_sides': {
                required: "This field is required.",  
            },
            'window_qty': {
                required: "This field is required."
            },
            'oven_type[]': {
                required: "This field is required, check at least 1."  
            },
            'kitchen_accessory[]': {
                required: "This field is required, check at least 1."  
            },
            'kitchen_appliances': {
                required: "This field is required."  
            },
            'cleaning_schedule': {
                required: "This field is required."  
            },
            'pets': {
                required: "This field is required."  
            },
            'iron': {
                required: "This field is required."  
            },
            'mattress_size2[]': {
                required: "This field is required, check at least 1."
            },
            'office_rooms[]': {
                required: "This field is required, check at least 1."  
            },
            'cleaning_start_date': {
                required: "This field is required."
            },
            'cleaning_start_time': {
                required: "This field is required."
            },
            'additional_info': {
                maxlength: "You have exceeded the maximum character limit."
            },
            'customer': {
                required: "This field is required."
            },
            'login_email': {
                required: "This field is required."
            },
            'login_password': {
                required: "This field is required."
            },
            'complete_name': {
                required: "This field is required."
            },
            'phone': {
                required: "This field is required."
            },
            'email': {
                required: "This field is required."
            },
            'password': {
                required: "This field is required."
            },
            'agreement': {
                required: "This field is required."  
            }
        },
        onfocusout: function(element) {
            $(element).valid();
        },
        highlight : function(element, errorClass, validClass) {
          //  $(element).find('.actions').addClass('form-error');
            $(element).addClass('is-invalid');
            $(element).removeClass('is-valid');
         //   $(element).addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
        //    $(element).find('.actions').removeClass('form-error');
        //    $(element).removeClass('error');
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        },
        errorPlacement: function errorPlacement(error, element) {
            if ( element.is(":radio") ) {
                error.prependTo( element.parents('.radio_error') );
            } else if ( element.is(":checkbox") ) {
                error.prependTo( element.parents('.checkbox_error') );
            } else if ( element.is("select") ) {
                error.insertAfter(element.parents('.select_error'));
            } else {
                error.insertAfter(element);   
            } 
        }
    });

    $("#wizard").steps({
        headerTag: "h3",
        bodyTag: "section",
        contentMode: "async",
        transitionEffect: "none",
        autoFocus: true,
        saveState: true,
        labels: {
            previous : 'Previous',
            next : 'Next',
            finish : 'Submit',
            current : '',
            loading : 'Loading... Please Wait',
        },
        titleTemplate: '#title#',
        loadingTemplate: '<div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div> #text#',
        onStepChanging: function (event, currentIndex, newIndex)
        {
            if (currentIndex > newIndex)
            {
                if(currentIndex == 1 || currentIndex == 2) {
                    $("div.service_estimated_cost").empty();
                    $(".service_total .col-md-3 #cost_total").text(0);
                }
                return true;
            
            } else {
                if(currentIndex == 0) {

                    var service = $("#service").val();  
                //    var service_title = getServiceTitle(service);

                    $(".cost_estimation_icon i").css('color', '#5c9e30');
                    $(".cost_estimation").css('color', '#5c9e30');

                    if(service == 1 || service == 2) {
                        $(".cost_estimation_yes").removeClass('d-none');
                        $(".service_estimated_cost_msg").removeClass('d-none');
                        $(".cost_estimation_no").addClass('d-none');
                    } else {
                        $(".cost_estimation_yes").addClass('d-none');
                        $(".service_estimated_cost_msg").addClass('d-none');
                        $(".cost_estimation_no").removeClass('d-none');
                    //    $(".service_estimated_cost_others").text('Our cleaning team inspect and decide.')
                    }

                    if($("#service > option:selected").val() == "1")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/tenancy"
                        });
                    } else if($("#service > option:selected").val() == "2")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/carpet"
                        });
                    } else if($("#service > option:selected").val() == "3")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/upholstery"
                        });
                    } else if($("#service > option:selected").val() == "4")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/window"
                        });
                    } else if($("#service > option:selected").val() == "5")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/oven"
                        });
                    } else if($("#service > option:selected").val() == "6")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/one-off"
                        });
                    } else if($("#service > option:selected").val() == "7")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/regular-fortnightly"
                        });
                    } else if($("#service > option:selected").val() == "8")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/office"
                        });
                    } else if($("#service > option:selected").val() == "9")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/after-builders"
                        });
                    } else if($("#service > option:selected").val() == "10")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/mattress"
                        });
                    } else if($("#service > option:selected").val() == "11")
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/sofa"
                        });
                    } else
                    {
                        $("#wizard").steps("remove", 1);
                        // In this case you could also use add instead of insert
                        $("#wizard").steps("insert", 1, {
                            title: '<div class="media"><div class="media-body text-center"><div class="bd-wizard-step-title">Service Details</div><div class="bd-wizard-step-subtitle">Step 2</div></div></div>',
                            contentMode: "async",
                            contentUrl: "/booking/step2/unknown"
                        });
                    }        
                
                } else if(currentIndex == 1) {
                    
                
                } else if(currentIndex == 2) {
                
                    
                } else if(currentIndex == 3) {
   
                
                } 

                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();    
            }
            
        },
        onFinishing: function (event, currentIndex)
        {
        //    form.validate().settings.ignore = ":disabled";
        //    return form.valid();
            return form.submit();
              
        },
        onFinished: function (event, currentIndex)
        {
            // swal("Good job!", "You successfully created your booking", "success");
            //   alert('Good job! You successfully created your booking');
        },
    });

    function toggle(className, obj) 
    {
        var $input = $(obj);
        if ($input.prop('checked')) {
            $(className).removeAttr("disabled");   
            if(className == '.furniture_material_others'){
                $('.furniture_matherial_other_field').removeClass('d-none');
            }
        } else {
            $(className).attr('disabled', 'disabled');
            if(className == '.furniture_material_others'){
                $('.furniture_matherial_other_field').addClass('d-none');
            }
        }
    }

    function toggleProperty(value, obj)
    {
        if(value == "house") {
            $(".choose_house_things").removeClass('d-none');        
        } else if(value == "terraced-house" || value == "semi-detached-house" || value == "detached-house" ) {
            $(".choose_floor_highest_window").removeClass('d-none');
            $(".choose_house_things").removeClass('d-none');        
        } else {
            $(".choose_house_things").addClass('d-none');
            $(".choose_floor_highest_window").addClass('d-none');
        }
    }

    function toggleCarpet(value, obj)
    {
        if(value == "machine") {
            $(".choose_carpet_locations").removeClass('d-none');        
        } else {
            $(".choose_carpet_locations").addClass('d-none');
        }
    } 

    function toggleLogin(value)
    {
        if(value == 1) {
            $(".choose_login").removeClass('d-none');
            $(".choose_login input").removeAttr('disabled');
            $(".choose_signup").addClass('d-none');
            $(".choose_signup input").attr('disabled', 'disabled');        
        } else {
            $(".choose_signup").removeClass('d-none');
            $(".choose_signup input").removeAttr('disabled');
            $(".choose_login").addClass('d-none');
            $(".choose_login input").attr('disabled', 'disabled');
        }
    }

    function getServiceTitle(service)
    {
        if(service == 1) {
            service_title = 'End of Tenancy Cleaning';    
        } else if(service == 2) {
            service_title = 'Carpet/Rug Cleaning';  
        } else if(service == 3) {
            service_title = 'Upholstery Cleaning';  
        } else if(service == 4) {
            service_title = 'Window Cleaning';  
        } else if(service == 5) {
            service_title = 'Oven Cleaning';  
        } else if(service == 6) {
            service_title = 'One-off Cleaning';  
        } else if(service == 7) {
            service_title = 'Regular/Fortnightly Cleaning';  
        } else if(service == 8) {
            service_title = 'Office Cleaning';  
        } else if(service == 9) {
            service_title = 'After Builders Cleaning';  
        } else if(service == 10) {
            service_title = 'Mattress Cleaning';  
        } else if(service == 11) {
            service_title = 'Sofa Cleaning';  
        } else {
            service_title = 'No Service Selected';  
        }

        return service_title;
    }
                
                

    

