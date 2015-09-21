
function loadTab(tabId, tabdiv){
    $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
    $('#'+ tabdiv + '').focus();
}

var overview_form_validator = function () {
    var runValidator = function () {
        var form = $('#Overview_form');
        var errorHandler = $('.errorHandler', form);
        $('#Overview_form').validate({
            errorElement: "span",
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else {
                    error.insertAfter(element);
                }
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
                'neighbourhood': {
                    required: true,
                },
            },
            messages: {
                'title': {
                    required: "Please provide the property title",
                },
                'description': {
                    required: "Please provide the property description",
                    minlength: "Property Description must be at least of 50 characters",
                },
                'neighbourhood': {
                    required: "Please provide the neighbourhood details",
                },
            },
            invalidHandler: function (event, validator) {
                errorHandler.show();
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
                var url = base_url+"host/Propertyoverview";
                $.ajax({
                    type: "POST",
                    url: url,
                    contentType: 'application/x-www-form-urlencoded',
                    data: $("#Overview_form").serialize(),
                    success: function(data) {
                        var obj = JSON.parse(data);
                        if(obj.status === 400)
                        {
                            alert(obj.message);
                        }
                        if(obj.status === 200)
                        {
                            $("#Overview_is_submitted").val(1);
                            $("#saveOverview").prop("disabled", true);  
                            $("a[href='#Overview'] .fa-check").css("color", "#55a018");
                            loadTab("Photo","Photo");
                        }
                    },
                    error: function(data) {
                       alert(data);
                    }
                });
            }
        });
    };
    return {
        init: function () {
            runValidator();
        }
    };
}();

var photo_form_validator = function () {
    var runValidator = function () {
        var form = $('#Photo_form');
        var errorHandler = $('.errorHandler', form);
        $('#Photo_form').validate({
            
            errorElement: "span",
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: "",
            rules: {
                'fileInput': {
                    required: true,
                },
            },
            messages: {
                'fileInput': {
                    required: "Please provide at least one photo",
                },
            },
            invalidHandler: function (event, validator) {
                errorHandler.show();
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
                var formData = new FormData($('#PhotoForm')[0]);
                for(var i= 0, file; file = filesArray[i]; i++){
                    formData.append('userfile[]', file);
                }
                var url = base_url+"host/uploadImages";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                       
                    },
                    complete: function(){
                       
                    },
                    success: function(response) {
                        var obj = JSON.parse(response);                        
                        if(obj.status === 400)
                        {
                            alert(obj.message);
                        }
                                                    
                        if(obj.status === 200)
                        {
                            $("#Photo_is_submitted").val(1);
                            $("#photoOverview").prop("disabled", true);
                            $("a[href='#Photo'] .fa-check").css("color", "#55a018");
                            loadTab("Pricing","Pricing");
                        }  
                    },
                    error: function(response) {
                          alert(response);
                    }
                });
            }
        });
    };
    return {
        init: function () {
            runValidator();
        }
    };
}();