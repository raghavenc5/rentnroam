$(document).ready(function() {    
    /**
    * overview starts
    */
   
   /**
   * validation starts
   */

   $("#save_overview").click(function(e) {
       $("#overview_form .fatalErrorHandler").empty().hide();
	   $("#overview_form .successHandler").hide();
	   $("#overview_form .errorHandler").hide();
       
       overview_form_validator.init();
   });

   var overview_form_validator = function () {
       var runValidator = function () {
           var form = $('#overview_form');
           var errorHandler = $('.errorHandler', form);
           $('#overview_form').validate({
               errorElement: "span",
               errorClass: 'help-block',
               errorPlacement: function (error, element) {
                   error.insertAfter((element));                                   
               },
               ignore: "",
               rules: {
                   'title': {
                       required: true,
                   },
                   'description': {
                       required: true,
                       minlength: 50,
                   },
               },
               messages: {
                   'title': {
                       required: "Please enter property title",
                   },
                   'description': {
                       required: "Please enter property description",
                       minlength: "Property description must be atleast 50 characters long",
                   },
               },
               invalidHandler: function (event, validator) {
                   errorHandler.show();
                   $('html,body').animate({
                       scrollTop: $('body').offset().top},
                   'slow');
                   $("a[href='#overview'] .fa-check").css("color", "#e91e63");
               },
               highlight: function (element) {
                   $(element).closest('.help-block').removeClass('valid');
                   $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
               },
               unhighlight: function (element) {
                   $(element).closest('.form-group').removeClass('has-error');
               },
               success: function (label, element) {
                   label.addClass('help-block valid');
                   $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
               },
               submitHandler: function (form) {
                   errorHandler.hide();
                   $("#overlay").show();
                   addOverview();
               }
           });
       };
       return {
           init: function () {
               runValidator();
           }
       };
   }();

   /**
   * validation ends
   */
  
  /**
    * adding overview starts
    */

   function addOverview()
   {       
       $.ajax({
            url: $("#overview_form").attr("action"),
            method: "POST",
            data: $("#overview_form").serialize(),
            dataType: "json",
            success: function(response) {				
                if ("200" == response.status) {                
					$("#overview_form .fatalErrorHandler").empty().hide();
					$("#overview_form .successHandler").show();
					
					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
					
                    $("#overview_is_submitted").val(1);
                    $("a[href='#overview'] .fa-check").css("color", "#55a018");
                } else {
					$("#overview_form .fatalErrorHandler").empty().html('<strong>' + response.message + '</strong>');
					$("#overview_form .fatalErrorHandler").show();

					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
                }
                $("#overlay").hide();
            }
        });
   }

   /**
    * adding overview ends
    */
   
   /**
    * overview ends
    */
   
   /**
    * pricing starts
    */
   
   /**
   * validation starts
   */

   $("#save_pricing").click(function(e) {
       pricing_form_validator.init();
   });

   var pricing_form_validator = function () {
       var runValidator = function () {
           var form = $('#pricing_form');
           var errorHandler = $('.errorHandler', form);
           $.validator.addMethod("is_cleaning_charge_required", function (value, element, param) {
                if ($("#check1").prop("checked")) {
                  if ("" === value) {
                    return false;
                  } else {
                    return true;
                  }
                } else {
                  $("#clean_charge").val("");
                  return true;
                }
            }, '   Please enter cleaning charge');
           $.validator.addMethod("is_guest_charge_required", function (value, element, param) {
                if ($("#check2").prop("checked")) {
                  if ("" === value) {
                    return false;
                  } else {
                    return true;
                  }
                } else {
                  $("#guest_charge").val("");
                  return true;
                }
            }, '   Please enter guest charge');
           $.validator.addMethod("is_security_charge_required", function (value, element, param) {
                if ($("#check3").prop("checked")) {
                  if ("" === value) {
                    return false;
                  } else {
                    return true;
                  }
                } else {
                  $("#security_charge").val("");
                  return true;
                }
            }, '   Please enter security charge');
           $('#pricing_form').validate({
               errorElement: "span",
               errorClass: 'help-block',
               errorPlacement: function (error, element) {
                  error.insertAfter($(element).closest('.input-group'));
               },
               ignore: "",
               rules: {                  
                   'clean_charge': {
                       is_cleaning_charge_required: true,
                       number: true,
                   },
                   'guest_charge': {
                       is_guest_charge_required: true,
                       number: true,
                   },
                   'security_charge': {
                       is_security_charge_required: true,
                       number: true,
                   },
               },
               messages: {
                   'clean_charge': {                       
                       number: "Please enter a valid number as cleaning charge",
                   },
                   'guest_charge': {                       
                       number: "Please enter a valid number as guest charge",
                   },
                   'security_charge': {                       
                       number: "Please enter a valid number as security charge",
                   },
               },
               invalidHandler: function (event, validator) {
                   errorHandler.show();
                   $('html,body').animate({
                       scrollTop: $('body').offset().top},
                   'slow');
                   $("a[href='#pricing'] .fa-check").css("color", "#e91e63");
               },
               highlight: function (element) {
                   $(element).closest('.help-block').removeClass('valid');
                   $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
               },
               unhighlight: function (element) {
                   $(element).closest('.form-group').removeClass('has-error');
               },
               success: function (label, element) {
                   label.addClass('help-block valid');
                   $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
               },
               submitHandler: function (form) {
                   errorHandler.hide();
                   $("#overlay").show();
                   addPricing();
               }
           });
           
            $("[name^=price]").each(function () {
                $(this).rules("add", {
                    required: true,
                    number: true,
                    messages: {
                        required: 'Please enter a price',
                        number: 'Please enter a valid number as price',
                    }
                });
            });
       };
       return {
           init: function () {
               runValidator();
           }
       };
   }();

   /**
   * validation ends
   */
  
  /**
    * adding pricing starts
    */

   function addPricing()
   {       
       $("#pricing_alert").remove();
       
       $.ajax({
            url: $("#pricing_form").attr("action"),
            method: "POST",
            data: $("#pricing_form").serialize(),
            dataType: "json",
            success: function(response) {				
                if ("200" == response.status) {                
					$("#pricing_form .fatalErrorHandler").empty().hide();
					$("#pricing_form .successHandler").show();
					
					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
					
                    $("#pricing_is_submitted").val(1);
                    $("a[href='#pricing'] .fa-check").css("color", "#55a018");
                } else {
					$("#pricing_form .fatalErrorHandler").empty().html('<strong>' + response.message + '</strong>');
					$("#pricing_form .fatalErrorHandler").show();

					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
                }
                $("#overlay").hide();
            }
        });
   }

   /**
    * adding listing ends
    */
   
   /**
    * pricing ends
    */
   
   /**
    * amenities starts
    */

   /**
   * validation starts
   */

   $("#save_amenities").click(function(e) {
        e.preventDefault();
        if ($(".amenities:checked").length < 2) {
			$("#amenities_form .errorHandler").show();
			$('html,body').animate({
			 scrollTop: $('body').offset().top},
			'slow');
			$("a[href='#amenities'] .fa-check").css("color", "#e91e63");
        } else {
			$("#amenities_form .errorHandler").hide();
			$("#overlay").show();
			addAmenities();
        }
   });

   /**
   * validation ends
   */
  
  /**
    * adding amenities starts
    */

   function addAmenities()
   {       
       if ((0 == $(".common").length) && (0 == $(".feature").length) && (0 == $(".extra").length) && (0 == $(".safety").length)) {
           //
       } else {
            $.ajax({
                url: $("#amenities_form").attr("action"),
                method: "POST",
                data: $("#amenities_form").serialize(),
                dataType: "json",
                success: function(response) {					                    
                    if ("200" == response.status) {                
						$("#amenities_form .fatalErrorHandler").empty().hide();
						$("#amenities_form .successHandler").show();
						
						$('html,body').animate({
							 scrollTop: $('body').offset().top},
						'slow');
						
                        $("#amenities_is_submitted").val(1);
                        $("a[href='#amenities'] .fa-check").css("color", "#55a018");
                    } else {
						$("#amenities_form .fatalErrorHandler").empty().html('<strong>' + response.message + '</strong>');
						$("#amenities_form .fatalErrorHandler").show();

						$('html,body').animate({
							 scrollTop: $('body').offset().top},
						'slow');
                    }
                    $("#overlay").hide();
                }
            });
       }
   }

   /**
    * adding amenities ends
    */

   /**
    * amenities ends
    */
   
   /**
    * listing starts
    */
   
   /**
   * validation starts
   */

   $("#save_listing").click(function(e) {
       listing_form_validator.init();
   });

   var listing_form_validator = function () {
       var runValidator = function () {
           var form = $('#listing_form');
           var errorHandler = $('.errorHandler', form);
           $('#listing_form').validate({
               errorElement: "span",
               errorClass: 'help-block',
               errorPlacement: function (error, element) {
                   error.insertAfter($("#tags_container"));                                   
               },
               ignore: "",
               rules: {
                   'tags[]': {
                       required: true,
                   },
               },
               messages: {
                   'tags[]': {
                       required: "Please select at least one tag",
                   },
               },
               invalidHandler: function (event, validator) {
                   errorHandler.show();
                   $('html,body').animate({
                       scrollTop: $('body').offset().top},
                   'slow');
                   $("a[href='#listing'] .fa-check").css("color", "#e91e63");
               },
               highlight: function (element) {
                   $(element).closest('.help-block').removeClass('valid');
                   $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
               },
               unhighlight: function (element) {
                   $(element).closest('.form-group').removeClass('has-error');
               },
               success: function (label, element) {
                   label.addClass('help-block valid');
                   $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
               },
               submitHandler: function (form) {
                   errorHandler.hide();
                   $("#overlay").show();
                   addListing();
               }
           });
       };
       return {
           init: function () {
               runValidator();
           }
       };
   }();

   /**
   * validation ends
   */
  
  /**
    * adding listing starts
    */

   function addListing()
   {       
       $("#listing_alert").remove();
       
       $.ajax({
            url: $("#listing_form").attr("action"),
            method: "POST",
            data: $("#listing_form").serialize(),
            dataType: "json",
            success: function(response) {
                if ("200" == response.status) {                
					$("#listing_form .fatalErrorHandler").empty().hide();
					$("#listing_form .successHandler").show();
					
					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
					
                    $("#listing_is_submitted").val(1);                    
                    $("a[href='#listing'] .fa-check").css("color", "#55a018");
                } else {
					$("#listing_form .fatalErrorHandler").empty().html('<strong>' + response.message + '</strong>');
					$("#listing_form .fatalErrorHandler").show();

					$('html,body').animate({
						 scrollTop: $('body').offset().top},
					'slow');
						
                    $("#save_listing").prop("disabled", false);
                }
                $("#overlay").hide();
            }
        });
   }

   /**
    * adding listing ends
    */
   
   /**
    * listing ends
    */
   
   /**
    * pricing starts
    */
   
   /**
   * validation starts
   */

   $("#save_location").click(function(e) {
       e.preventDefault();
       addLocation();
   });

   /**
   * validation ends
   */
  
  /**
    * adding location starts
    */

   function addLocation()
   {
        $('.help-block').remove();
        $('#location_form .alert').hide();
       
        var errorFlag = false;
    
        var address1 = $('#address_line1').val();
        var address2 = $('#address_line2').val();
        var area = $('#area').val();
        var zip = $('#zip').val();

        if (! address1) {
            $('#address_line1').after('<span class="help-block">Please enter address line 1</span>');
            errorFlag = true;
        }

        if (! $('#country-list').val()) {
            $('#no_country_error').empty().html('<span class="help-block">Please select a country</span>');
            errorFlag = true;
        }

        if (! $('#state_dropdown').val()) {
             $('#no_state_error').empty().html('<span class="help-block">Please select a state</span>');
            errorFlag = true;
        }

        if (! $('#city_dropdown').val()) {
            $('#no_city_error').empty().html('<span class="help-block">Please select a city</span>');
            errorFlag = true;
        }

        if (! area) {
            $('#no_area_error').empty().html('<span class="help-block">Please enter area</span>');
            errorFlag = true;
        }

        if (! zip) {
            $('#zip').after('<span class="help-block">Please enter zip</span>');
            errorFlag = true;
        }
        
        if (errorFlag) {
            $('#location_form .errorHandler').show();
            $('html,body').animate({
                scrollTop: $('body').offset().top},
            'slow');
            $("a[href='#location'] .fa-check").css("color", "#e91e63");
        } else {
            $("#overlay").show();
            $.ajax({
                url: $("#location_form").attr("action"),
                method: "POST",
                data: $("#location_form").serialize(),
                dataType: "json",
                success: function(response) {
                    $(".location_save_loader").remove();

                    if ("200" == response.status) {                
                        $("#location_form .fatalErrorHandler").empty().hide();
                        $("#location_form .successHandler").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');

                        $("#location_is_submitted").val(1);                    
                        $("a[href='#location'] .fa-check").css("color", "#55a018");
                    } else {
                        $("#location_form .fatalErrorHandler").empty().html('<strong>' + response.message + '</strong>');
                        $("#location_form .fatalErrorHandler").show();

                        $('html,body').animate({
                             scrollTop: $('body').offset().top},
                        'slow');

                        $("#save_location").prop("disabled", false);
                    }
                    $("#overlay").hide();
                }
            });
        }
   }

   /**
    * adding location ends
    */
   
   /**
    * location ends
    */
   
   /**
    * rooms start
    */
   
   function checkManageRoomTabInternalStatus()
   {
       var allRoomsAdded = true;
       
       $('#addRooms .room_data_submitted').each(function() {
           if (! $(this).val()) {
               allRoomsAdded = false;
           }
       });
       
       if (allRoomsAdded) {
           $('#manageRooms_is_submitted').val(1);
           $('#manageRooms .errorHandler').hide();
           $('#manageRooms .successHandler').show();
           $("a[href='#manageRooms'] .fa-check").css("color", "#55a018");
       } else {
           $('#manageRooms_is_submitted').val('');
           $('#manageRooms .successHandler').hide();
           $('#manageRooms .errorHandler').show();
           $("a[href='#manageRooms'] .fa-check").css("color", "#e91e63");
       }
       
       $('html,body').animate({
            scrollTop: $('body').offset().top},
       'slow');
   }
   
   /**
    * add a room starts
    */
   
    $("#addRoomsBtn").click(function(){
        $('#manageRooms_is_submitted').val('');
        var parentPropertyId = $('#parent_property_id').val();
        $("#addRooms tbody").append('\
                                    <tr>\
                                        <form name="manage_room_form" class="manage_room_forms" action="' + base_url + 'host/saveRoomDetails" method="post">\
                                        <td>\
                                            <input type="text" class="form-control input-lg txtRoom room_names" placeholder="Room Name" name="room_name"/>\                                                                               <span class="help-block room_name_errors" style="display: none;">Please enter room name</span>\
                                        </td>\
                                        <td>\
                                            <div class="col-md-6 styled-select styled-select-short">\
                                                        <select class="form-control room_types" name="room_types">\
                                                            <option value="">-Select One-</option>\
                                                            <option value="1">Private</option>\
                                                            <option value="2">Shared</option>\
                                                            <option value="3">Entire Home Apartment</option>\
                                                        </select>\
                                                    </div>\
                                                    <span class="help-block room_type_errors" style="display: none;">Please select room type</span>\
                                        </td>\
                                        <td>\
                                            <div class="col-md-6 styled-select styled-select-short">\
                                                        <select class="form-control guest_allowed" name="guest_allowed">\
                                                            <option value="">-select One-</option>\
                                                            <option value="1">1</option>\
                                                            <option value="2">2</option>\
                                                            <option value="3">3</option>\
                                                            <option value="4">4</option>\
                                                            <option value="5">5</option>\
                                                            <option value="6">6</option>\
                                                            <option value="7">7</option>\
                                                            <option value="8">8</option>\
                                                            <option value="9">9</option>\
                                                            <option value="10+">10+</option>\
                                                        </select>\
                                                    </div>\
                                                    <span class="help-block guest_allowed_errors" style="display: none;">Please select guest allowed</span>\
                                        </td>\
                                        <td>\
                                            <a href="javascript:void(0);" class="button-pink btn btn-default pull-left manage_room_button">Add</a>\
                                            <input type="hidden" class="property_ids" name="property_id"/>\
                                            <input type="hidden" value="" name="is_room_data_submitted" class="room_data_submitted"/>\
                                            <input type="hidden" value="" name="is_room_data_visited" class="room_data_visited"/>\
                                        </td>\
                                        <td><a href="javascript:void(0);" class="button-pink btn btn-default pull-left edit_this_room">Edit</a></td>\
                                        <td class="remove">\
                                            <img class="removeRoomsBtn remove_this_room" src="' + base_url + 'public/images/closex.png" alt="Remove">\
                                        </td>\
                                        <td>\
                                            <span class="help-block save-error" style="display:none;"></span>\
                                            <span class="help-block delete-error" style="display:none;"></span>\
                                            <span class="help-block-alt save-success" style="display:none;"></span>\
                                                    </td>\
                                        </form>\
                                    </tr>\
                                ');
    });
    
    /**
    * add a room ends
    */
    
    /**
     * remove a room starts
     */
    
    $("#addRooms").on('click', '.remove_this_room', function(){
        var thisRow = $(this).closest('tr');
        var propertyId = thisRow.find('.property_ids').val();
        $('#overlay').show();
        if (confirm('This will delete the room. Sure to proceed?')) {
            $.ajax({
                url: base_url + 'host/deleteRoom/' + propertyId,
                method: 'post',
                dataType: 'json',
                success: function(response) {
                    if ('500' == response.status) {
                        thisRow.find('.delete-error').empty().html(response.message).show();
                    } else if ('200' == response.status) {
                        thisRow.remove();
                    } else {
                        //
                    }
                    $('#overlay').hide();
                }
            }); 
        }
    });
    
    /**
     * remove a room ends
     */
    
    /**
     * remove all rooms starts
     */
    
    $('.remove_all_rooms').click(function(e) {
        $('#manageRooms .alert').hide();
        $('#overlay').show();
        if (confirm('This will delete all the rooms and the property itself. Sure to proceed?')) {
            $.ajax({
                url: base_url + 'host/deleteAllRooms/' + $('#parent_property_id').val(),
                method: 'post',
                dataType: 'json',
                success: function(response) {
                    if ('500' == response.status) {
                        $('#manageRooms .fatalErrorHandler').empty().html(response.message).show();
                        $('html,body').animate({
                            scrollTop: $('body').offset().top},
                       'slow');
                    } else if ('200' == response.status) {
                        window.location = base_url + 'host/createproperty';
                    } else {
                        //
                    }
                    $('#overlay').hide();
                }
            }); 
        }
    });
    
    /**
     * remove all rooms ends
     */
    
    /**
     * saving a room details starts
     */
    
    $('#addRooms').on('click', '.manage_room_button', function(e) {
        // prevent default action
        e.preventDefault();
        
        // initialize vars
        var errorFlag = false;
        var thisRow = $(this).parent().parent();
        
        // mark this room and the tab too
        $('#manageRooms_is_visited').val(1);
        thisRow.find('.room_data_visited').val(1);
        
        // hide all pre-existing errors
        $('#addRooms .alert').hide();
        thisRow.find('.help-block, .help-block-alt').hide();
        
        // validate form data
        if (! thisRow.find('.room_names').val()) {
            thisRow.find('.room_name_errors').show();
            errorFlag = true;
        }
        if (! thisRow.find('.room_types').val()) {
            thisRow.find('.room_type_errors').show();
            errorFlag = true;
        }
        if (! thisRow.find('.guest_allowed').val()) {
            thisRow.find('.guest_allowed_errors').show();
            errorFlag = true;
        }
        
        if (! errorFlag) {
            // show the overlay
            $('#overlay').show();
            
            // submit the form
            var action = thisRow.find('form').attr('action');
            
            $.ajax({
                url: action,
                method: 'post',
                data: {
                    'room_name': thisRow.find('.room_names').val(),
                    'room_type': thisRow.find('.room_types').val(),
                    'guest_allowed': thisRow.find('.guest_allowed').val(),
                    'property_id': thisRow.find('.property_ids').val(),
                    'user_id': $('#user_id').val(),
                    'property_type_id': $('#property_type_id').val(),
                    'parent_property_id': $('#parent_property_id').val(),
                },
                dataType: 'json',
                success: function(response) {
                    if ('500' === response.status) {
                        thisRow.find('.room_data_submitted').val('');
                        thisRow.find('.save-error').empty().html(response.message).show();
                    } else if ('200' === response.status) {
                        if (response.propertyId) {
                            var editUrl = base_url + 'host/editproperty/' + response.propertyId + '/?referer=' + $('#encoded_referer').val();
                            thisRow.find('.edit_this_room').attr('href', editUrl);
                        }
                        // mark this room as done
                        thisRow.find('.room_data_submitted').val(1);
                        thisRow.find('.save-success').empty().html(response.message).show();
                    } else {
                        //
                    }
                    
                    // hide the overlay
                    $('#overlay').hide();
                }
            });
        } else {
            thisRow.find('.room_data_submitted').val('');
        }
    });
    
    $('.add_all_rooms').click(function(e) {
        $('#manageRooms .alert').hide();
        
        $('#addRooms .manage_room_button').each(function() {
            $(this).trigger('click');
        });
        checkManageRoomTabInternalStatus();
        $(document).ajaxStop(function () {
            checkManageRoomTabInternalStatus();
        });
    });
    
    /**
     * saving a room details ends
     */
   
   /**
    * rooms end
    */
   
   
   /**
    * helper functions start
    */
   
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var successFlag = true;
        var thisTabId = $(this).attr("id");
        
        if ("postApprovalCalendar_tab" == thisTabId) {
            $("#calendar").fullCalendar("destroy");
            $("#calendar").html("");
           
            Calendar.init();
        }
        
        var thisTabPrefix = thisTabId.split("_")[0];

        var thisIsVisitedFlagId = thisTabPrefix + "_is_visited";
        $("#" + thisIsVisitedFlagId).val(1);

        $(".is_visited").each(function() {
          var elementId = $(this).attr("id");
          var thisElementPrefix = elementId.split("_")[0];
          
          if (elementId != thisIsVisitedFlagId) {
              if ("1" == $(this).val()) {
                if ("overview" == thisElementPrefix) {
                    if ("1" != $("#overview_is_submitted").val() && ! $("#save_overview").prop("disabled")) {
                        $("#save_overview").trigger("click");
                    }                                    
                } else if ("photos" == thisElementPrefix) {
                    if ("1" != $("#photos_is_submitted").val()) {
                        $("#add_photo").trigger("click");
                    }                                    
                } else if ("postApprovalCalendar" == thisElementPrefix) {
                    $("a[href='#post_approval_calendar'] .fa-check").css("color", "#55a018");                                    
                } else if ("pricing" == thisElementPrefix) {
                    if ("1" != $("#pricing_is_submitted").val() && ! $("#save_pricing").prop("disabled")) {
                        $("#save_pricing").trigger("click");
                    }                                    
                } else if ("amenities" == thisElementPrefix) {
                    if ("1" != $("#amenities_is_submitted").val() && ! $("#save_amenities").prop("disabled")) {
                        $("#save_amenities").trigger("click");
                    }                                    
                } else if ("listing" == thisElementPrefix) {
                    if ("1" != $("#listing_is_submitted").val() && ! $("#save_listing").prop("disabled")) {
                        $("#save_listing").trigger("click");
                    }                                    
                } else if ("location" == thisElementPrefix) {
                    if ("1" != $("#location_is_submitted").val() && ! $("#save_location").prop("disabled")) {
                        $("#save_location").trigger("click");
                    }                                    
                } else {
                    //
                }
              }
          }
        });      
    })

    $("#save_all").click(function(e) {
        var successFlag = true;
        
        $(".is_submitted").each(function() {
            var elementId = $(this).attr("id");
            var thisElementPrefix = elementId.split("_")[0];

            if ("1" != $(this).val()) {
                if ("overview" == thisElementPrefix) {
                    if ("1" != $("#overview_is_submitted").val() && ! $("#save_overview").prop("disabled")) {
                        $("#save_overview").trigger("click");
                    }                                    
                } else if ("photos" == thisElementPrefix) {
                    if ("1" != $("#photos_is_submitted").val()) {
                        $("#add_photo").trigger("click");
                    }                                    
                } else if ("pricing" == thisElementPrefix) {
                    if ("1" != $("#pricing_is_submitted").val() && ! $("#save_pricing").prop("disabled")) {
                        $("#save_pricing").trigger("click");
                    }                                    
                } else if ("amenities" == thisElementPrefix) {
                    if ("1" != $("#amenities_is_submitted").val() && ! $("#save_amenities").prop("disabled")) {
                        $("#save_amenities").trigger("click");
                    }                                    
                } else if ("listing" == thisElementPrefix) {
                    if ("1" != $("#listing_is_submitted").val() && ! $("#save_listing").prop("disabled")) {
                        $("#save_listing").trigger("click");
                    }                                    
                } else if ("location" == thisElementPrefix) {
                    if ("1" != $("#location_is_submitted").val() && ! $("#save_location").prop("disabled")) {
                        $("#save_location").trigger("click");
                    }                                    
                } else {
                    //
                }
            }
        });
        
        checkOverAllStatus();
    });

    function checkOverAllStatus()
    {
		var successFlag = true;
		
		$(".is_submitted").each(function() {
			if ("1" != $(this).val()) {
				successFlag = false;
			}
		});
		
		if (true === successFlag) {
			$(".global_error_handler").hide();
			$(".global_success_handler").show();
			$("#save_all").prop("disabled", true);
		} else {
			$(".global_success_handler").hide();
			$(".global_error_handler").hide().show();
		}
	}
    
    $("#settings_gear").click(function() {
        $('#calendar_settings').modal();
    });
   
   /**
    * helper functions end
    */
});
