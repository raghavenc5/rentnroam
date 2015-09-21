$(document).ready(function() {
    /**
    * adding emails start
    */

    $("#profile").on("click", "#add_another_email", function(e) {
        e.preventDefault();

        // add markup
        var html = '<div class="custom-input-group"><input type="hidden" name="profile_data[users_email][is_verified][]" value="0"/><input type="hidden" name="profile_data[users_email][verification_code][]" value=""/><input type="text" name="profile_data[users_email][email][]" class="form-control email" placeholder="email address" value=""><p>Not Verified <i class="fa fa-times"></i><span class="pull-right"><a href="javascript:void(0);" class="email_remover"><img src="' + base_url + 'public/images/closex.png"></a></span></p></div><div class="clearfix"></div>';

        $("#add_another_email_button_container").before(html);
    });

    /**
    * adding emails end
    */

    /**
    * removing emails start
    */

    $("#profile").on("click", ".email_remover", function(e) {
        e.preventDefault();

        // remove markup
        $(this).parent().parent().parent().remove();
    });

    /**
    * removing emails end
    */

    /**
    * adding contacts start
    */

    $("#profile").on("click", "#add_another_contact", function(e) {
        e.preventDefault();

        // add markup
        var html = '<div class="custom-input-group"><input type="hidden" name="profile_data[users_contact][is_verified][]" value="0"/><input type="hidden" name="profile_data[users_contact][contact_verification_code][]" value=""/><input type="text" name="profile_data[users_contact][prefix][]" class="form-control stdCode prefix" placeholder="Prefix"><input type="text" name="profile_data[users_contact][number][]" class="form-control stdCodeMobile number" placeholder="Number"><p>Not Verified <i class="fa fa-times"></i><span class="pull-right"><a href="javascript:void(0);" class="contact_remover"><img src="' + base_url + 'public/images/closex.png"></a></span></p></div><div class="clearfix"></div>';

        $("#add_another_contact_button_container").before(html);
    });

    /**
    * adding contacts end
    */

    /**
    * removing contacts start
    */

    $("#profile").on("click", ".contact_remover", function(e) {
        e.preventDefault();

        // remove markup
        $(this).parent().parent().parent().remove();
    });

    /**
    * removing contacts end
    */

    /**
    * edit profile form validation starts
    */

    $("#profile").on("click", ".basicSubmit", function(e) {
        // prevent form submitting
        e.preventDefault();

        // remove existing error messages
        $("#edit_profile_form .help-block").remove();

        $("#client_side_global_error, #server_side_error_500, #server_side_error_300, #server_side_status_200").hide();

        // local vars
        var errorFlag = false;
        var firstName = $("#first_name").val().trim();
        var lastName = $("#last_name").val().trim();
        var addressLine1 = $("#address_line_1").val().trim();
        var country = $("#country_dropdown").val();
        var state = $("#state_dropdown").val();
        var city = $("#city_dropdown").val();
        var zip = $("#zip").val();
        var work = $("#work").val();
        var about = $("#about").val();
        var language = $("#language").val();
        var locationErrors = [];

        // first name check
        if (! firstName) {
            errorFlag = true;
            $("#first_name").after("<span class='help-block'>Please enter your first name</span>");
        } else if (! /^[a-z\s]+$/i.test(firstName)) {
            errorFlag = true;
            $("#first_name").after("<span class='help-block'>First name must contain only letters and spaces</span>");
        } else {
            //
        }

        // last name check
        if (! lastName) {
            errorFlag = true;
            $("#last_name").after("<span class='help-block'>Please enter your last name</span>");
        } else if (! /^[a-z\s]+$/i.test(lastName)) {
            errorFlag = true;
            $("#last_name").after("<span class='help-block'>Last name must contain only letters and spaces</span>");
        } else {
            //
        }

        // emails check
        $(".email").each(function() {
            var thisEmail = $(this).val().trim();
            var regex = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

            if (! thisEmail) {
                errorFlag = true;
                $(this).closest(".custom-input-group").after("<span class='help-block'>Please enter an email</span>");
            } else if (! regex.test(thisEmail)) {
                errorFlag = true;
                $(this).closest(".custom-input-group").after("<span class='help-block'>Please enter a valid email</span>");
            } else {
                //
            }
        });

        // contacts check
        $(".prefix").each(function() {
            var thisPrefix = $(this).val().trim();
            var thisNumber = $(this).siblings(".number").val().trim();

            if (thisPrefix && ! /^[0-9]+$/.test(thisPrefix)) {
                errorFlag = true;
                $(this).closest(".custom-input-group").after("<span class='help-block'>Prefix must contain only digits</span>");
            } else if (! thisNumber) {
                errorFlag = true;
                $(this).closest(".custom-input-group").after("<span class='help-block'>Please enter a contct number</span>");
            } else if (! /^[0-9]+$/.test(thisNumber)) {
                errorFlag = true;
                $(this).closest(".custom-input-group").after("<span class='help-block'>Contct number must contain only digits</span>");
            } else {
                //
            }
        });

        // address line 1 check
        if (! addressLine1) {
            errorFlag = true;
            $("#address_line_1").after("<span class='help-block'>Please enter address line 1</span>");
        } else {
            //
        }

        // country check
        if (! country) {
            locationErrors.push("country");
        }

        // state check
        if (! state) {
            locationErrors.push("state");
        }

        // city check
        if (! city) {
            locationErrors.push("city");
        }

        // zip check
        if (! zip) {
            locationErrors.push("zip");
        }

        // print location errors out
        if (locationErrors.length) {
            errorFlag = true;
            var locationErrorMessage = locationErrors.join(", ");
            $("#location_error_before").after("<span class='help-block'>Please provide " + locationErrorMessage + "</span>");
        }

        // work check
        if (! work) {
            errorFlag = true;
            $("#work").after("<span class='help-block'>Please enter your work place</span>");
        } else {
            //
        }

        // about check
        if (! about) {
            errorFlag = true;
            $("#about").after("<span class='help-block'>Please enter a few lines about yourself</span>");
        } else if (about.length < 50) {
            $("#about").after("<span class='help-block'>Please write atleast 50 characters</span>");
        } else {
            //
        }

        // language check
        if (! language) {
            errorFlag = true;
            $("#language_error_before").after("<span class='help-block'>Please select at least one language</span>");
        }

        if (errorFlag) {
            // show global error
            $("#client_side_global_error").show();

            $("a[href='#profile'] .fa-check").css("color", "#4285F4");

            $('html,body').animate({
                 scrollTop: $('body').offset().top},
            'slow');
        } else {
            $(".basicSubmit").prop("disabled", true);

            // ajax submit the form
            $.ajax({
                url: $("#edit_profile_form").attr("action"),
                method: "post",
                dataType: "json",
                data: $("#edit_profile_form").serialize(),
                success: function(response) {
                    if ("500" == response.status) {
                        $("#server_side_error_500").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');

                        $(".basicSubmit").prop("disabled", false);
                    } else if ("400" == response.status) {
                        $("#server_side_error_300").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');

                        $(".basicSubmit").prop("disabled", false);
                    } else if ("200" == response.status) {
                        $("a[href='#profile'] .fa-check").css("color", "#55a018");

                        $.ajax({
                            url: base_url + "host/profile",
                            method: "post",
                            dataType: "html",
                            data: {"mode": "edit_profile"},
                            success: function(response) {
                                $("#profile").empty().html(response);
                                $("#profile_is_submitted").val(1);
                                $("#server_side_status_200").show();
                                $('html,body').animate({
									 scrollTop: $('body').offset().top},
								'slow');
                            }
                        });

                        $.ajax({
                            url: base_url + "host/profile",
                            method: "post",
                            dataType: "html",
                            data: {"mode": "load_verify_panel"},
                            success: function(response) {
                                $("#verify").empty().html(response);
                            }
                        });
                    } else {
                        //
                    }
                }
            });
        }
    });

    /**
    * edit profile form validation ends
    */

    /**
    * write a review handlers start
    */

    /**
    * on clicking the write review button
    * populate the property id
    * open write review modal
    */
    $("#review").on("click", ".write_review_button", function() {
        var propertyId = $(this).attr("id").split("_")[2];
        $("#reviewed_property_id").val(propertyId);
        $("#review_is_clicked").val(1);
        $('#write_review').modal();
    });

    /**
    * on clickin one rating smiley
    * populate the smiley id
    */
    $("#write_review").on("click", ".rating_smileys", function() {
        var smileyId = $(this).attr("id").split("_")[1];
        $("#reviewed_smiley_id").val(smileyId);
    });

    /**
    * validate write review form
    * on successful validation submit form
    * on successfull save reload the panel content
    */
    $("#write_review").on("click", "#submit_review_button", function(e) {
        // prevent default form submit
        e.preventDefault();

        // remove any existing errors
        $("#review_client_side_global_error, #review_server_side_error_500, #review_server_side_error_300, #review_server_side_status_200").hide();

        $("#write_review .help-block").remove();

        // local vars
        var errorFlag = false;
        var rating = $("#rating").val().trim();
        var smiley = $("#reviewed_smiley_id").val();

        // validate review text
        if (! rating) {
            errorFlag = true;
            $("#rating").after("<span class='help-block'>Please enter review text</span>");
        } else if (rating.length < 50) {
            errorFlag = true;
            $("#rating").after("<span class='help-block'>Review must contain atleast 50 characters</span>");
        } else {
            //
        }

        // validate rating smiley
        if (! smiley) {
            errorFlag = true;
            $("#smiley_error").empty().after("<span class='help-block'>Please rate this property</span>");
        }

        if (errorFlag) {
            // show global error
            $("#review_client_side_global_error").show();
            $("a[href='#review'] .fa-check").css("color", "#4285F4");
            $('html,body').animate({
                 scrollTop: $('body').offset().top},
            'slow');
        } else {
            $("#submit_review_button").prop("disabled", true);

            // ajax submit the form
            $.ajax({
                url: $("#write_review_form").attr("action"),
                method: "post",
                dataType: "json",
                data: $("#write_review_form").serialize(),
                success: function(response) {
                    if ("500" == response.status) {
                        $("#review_server_side_error_500").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else if ("400" == response.status) {
                        $("#review_server_side_error_300").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else if ("200" == response.status) {
                        $("a[href='#review'] .fa-check").css("color", "#55a018");

                        $.ajax({
                            url: base_url + "host/profile",
                            method: "post",
                            dataType: "html",
                            data: {"mode": "save_review"},
                            success: function(response) {
                                $("#byYou").empty().html(response);
                                $("#review_is_clicked").val("");
                                $("#review_is_submitted").val(1);
                                $("#review_server_side_status_200").show();
                                $('#write_review').modal("hide");
                            }
                        });
                    } else {
                        //
                    }
                }
            });
        }
    });

    /**
    * write a review handlers start
    */

    /**
    * profile photo upload handlers start
    */

    $("#captureImage").click(function(e) {
        // prevent the default form submission
        e.preventDefault();

        // remove any existing errors
        $("#profile_pic_client_side_global_error, #profile_pic_server_side_error_500, #profile_pic_server_side_error_300, #profile_pic_server_side_status_200").hide();

        $("#imageUploader .help-block").remove();

        // validate empty file upload attempt
        if (! $("#host_profile_pic_uploader").val()) {
            $("#profile_pic_client_side_global_error").show();
            $("#captureImage").after("<span class='help-block'>Please select a photo to upload</span>");

            $("a[href='#Photo'] .fa-check").css("color", "#4285F4");

            $('html,body').animate({
                 scrollTop: $('body').offset().top},
            'slow');
        } else {
            var imageUrl = base_url + "public/uploads/user_image/" + "<?php echo $profileData->profile_pic; ?>";
            //var imageData = $('.image-editor').cropit('export', { imageState: { src: { '' } } });
            $('.image-editor').cropit({ imageBackground: true, imageState: { src: { imageUrl } } });
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);

            $("#captureImage").prop("disabled", true);

            $.ajax({
                url: $("#imageUploader").attr("action"),
                method: "post",
                data: $("#imageUploader").serialize(),
                dataType: "json",
                success: function(response) {
                    if ("500" == response.status) {
                        $("#profile_pic_side_error_500").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else if ("400" == response.status) {
                        $("#profile_pic_server_side_error_300").empty().html("<strong>" + response.message + "</strong>").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else if ("200" == response.status) {
						$("#Photo_is_submitted").val(1);
                        $("a[href='#Photo'] .fa-check").css("color", "#55a018");                        
                        $("#profile_pic_server_side_status_200").show();
                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else {
                        //
                    }

                    $("#captureImage").prop("disabled", false);
                }
            });
        }
    });

    /**
    * profile photo upload handlers end
    */

    /**
    * verification handlers start
    */


    /**
    * sending email verification starts
    */

    $("#verify").on("click", ".verify_email_button", function(e) {
        // prevent default redirection
        e.preventDefault();

        // remove existing messages        
        $("#verify_client_side_global_error, #verify_server_side_error_500, #verify_server_side_error_300, #verify_server_side_status_200").hide();
        $(this).closest(".email_verification_send_success").hide();


        $.ajax({
            url: $(this).attr("href"),
            method: "get",
            dataType: "json",
            success: function(response) {
                if ("500" == response.status) {
                    $("#verify_server_side_error_500").empty().html(response.message).show();

                    $('html,body').animate({
                         scrollTop: $('body').offset().top},
                    'slow');
                } else if ("200" == response.status) {
                    $("#verify_server_side_status_200").empty().html(response.message).show();

                    $('html,body').animate({
                         scrollTop: $('body').offset().top},
                    'slow');
                } else {
                    //
                }
            }
        });
    });

    /**
    * sending email verification ends
    */

    /**
    * identity verification handlers start
    */

    $("#verify").on("click", "#identity_document_upload_button", function(e) {
        // prevent default redirection
        e.preventDefault();

        // remove existing messages        
        $("#verify_client_side_global_error, #verify_server_side_error_500, #verify_server_side_error_300, #verify_server_side_status_200, #identity_document_error").hide();

        if (! $("#identity_document_browser").val()) {
            $("#identity_document_error").show();
        } else {
            var formData = new FormData($("#identity_document_upload_form")[0]);

            $.ajax({
                url: base_url + "host/profile/uploadIdentityDocument",
                method: "post",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if ("500" == response.status) {
                        $("#server_side_error_500").empty().html(response.message).show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');
                    } else if ("200" == response.status) {
                        $.ajax({
                            url: base_url + "host/profile",
                            method: "post",
                            dataType: "html",
                            data: {"mode": "load_verify_panel"},
                            success: function(response) {
                                $("#verify").empty().html(response);
                                
                                $("#verify_server_side_status_200").empty().html(response.message).show();

                                $('html,body').animate({
                                     scrollTop: $('body').offset().top},
                                'slow');
                            }
                        });                        
                    } else {
                        //
                    }
                }
            });
        }
    });    

    /**
    * identity verification handlers end
    */

    /**
    * verification handlers end
    */

    /**
    * helper handlers start
    */

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var successFlag = true;
        var thisTabId = $(this).attr("id");
        var thisTabPrefix = thisTabId.split("_")[0];

        if ("review" == thisTabPrefix && $("#review_is_clicked").val()) {
            $(".write_review_button").trigger("click");
        }

        var thisIsVisitedFlagId = thisTabPrefix + "_is_visited";
        $("#" + thisIsVisitedFlagId).val(1);

        $(".is_visited").each(function() {
          var elementId = $(this).attr("id");
          var thisElementPrefix = elementId.split("_")[0];
          
          if (elementId != thisIsVisitedFlagId) {
              if ("1" == $(this).val()) {
                if ("profile" == thisElementPrefix) {
                    if ("1" != $("#profile_is_submitted").val() && ! $(".basicSubmit").prop("disabled")) {
                        $(".basicSubmit").trigger("click");
                    }                                    
                } else if ("Photo" == thisElementPrefix && ! $("#captureImage").prop("disabled")) {
                    if ("1" != $("#Photo_is_submitted").val()) {
                        $("#captureImage").trigger("click");
                    }                                    
                } else if ("review" == thisElementPrefix) {
                    if ("1" == $("#review_is_clicked").val() && "1" != $("#review_is_submitted").val() && ! $("#submit_review_button").prop("disabled")) {
                        $("#submit_review_button").trigger("click");
                    }                                    
                } else {
                    //
                }
              }
          }
        });    
    });

    $("#save_all").click(function(e) {
        var successFlag = true;
        
        $(".is_submitted").each(function() {
            var elementId = $(this).attr("id");
            var thisElementPrefix = elementId.split("_")[0];

            if ("1" != $(this).val()) {
                if ("profile" == thisElementPrefix) {
                    if ("1" != $("#profile_is_submitted").val() && ! $(".basicSubmit").prop("disabled")) {
                        $(".basicSubmit").trigger("click");
                    }                                    
                } else if ("Photo" == thisElementPrefix && ! $("#captureImage").prop("disabled")) {
                    if ("1" != $("#Photo_is_submitted").val()) {
                        $("#captureImage").trigger("click");
                    }                                    
                } else if ("review" == thisElementPrefix) {
                    if ("1" == $("#review_is_clicked").val() && "1" != $("#review_is_submitted").val() && ! $("#submit_review_button").prop("disabled")) {
                        $("#submit_review_button").trigger("click");
                    }                                    
                } else {
                    //
                }
            }
        });
        
        setTimeout(function() {
            var successFlag = true;
        
            $(".is_submitted").each(function() {
                if ("1" != $(this).val()) {
                    successFlag = false;
                }
            });
            
            if (true === successFlag) {
                $(".super_global_error_handler").hide();
                $(".super_global_success_handler").show();
                $("#save_all").prop("disabled", true);
            } else {
                $(".super_global_error_handler").hide().show();
            }

            $("html,body").animate({
                 scrollTop: $("body").offset().top},
            "slow");
        }, 3000);
    });

    /**
    * helper handlers end
    */

});
