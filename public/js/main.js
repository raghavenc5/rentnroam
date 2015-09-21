/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: base_url + "host/uploadFiles",
        previewMinWidth: 196,
        previewMinHeight: 246,
        previewMaxWidth: 196,
        previewMaxHeight: 246,
        previewCrop: true,
        previewCanvas: false,
        prependFiles: true,
        uploadTemplateId: 'upload_container',
		downloadTemplateId: null,
		uploadTemplate: function (o) {
			var rows = $();
			$.each(o.files, function (index, file) {
				var acceptFileTypes = o.options.acceptFileTypes;
				var maxFileSize = o.options.maxFileSize;
                //var maxFileSizeInBytes = (maxFileSize/(1024*1024));
                var maxFileSizeInBytes = 5;
                var minFileSize = o.options.minFileSize;
                //var minFileSizeInBytes = (minFileSize/(1024*1024));
                var minFileSizeInBytes = 1;
				var maxNumberOfFiles = o.options.maxNumberOfFiles;
				var errorMessage = "";
				if (! acceptFileTypes.test(file.type)) {
					errorMessage = "File type " + file.type + " is not allowed";
                } else if (maxFileSize < file.size) {
					errorMessage = "File size exeeded maximum limit of " + maxFileSizeInBytes + " MB";
				} else if (minFileSize > file.size) {
					errorMessage = "File size should be atleast " + minFileSizeInBytes + " MB";
				} else {
					errorMessage = "";
				}

				if (! errorMessage) {
					var row = $('<li style="list-style:none;" class="col-md-4 photo-container col-padding-no template-upload fade"><div><img class="cancel" src="'+ base_url +'public/images/closex.png"><span class="preview"></span><textarea  name="caption[]"  placeholder="Add a caption" class="form-control photo-desc" rows="3"></textarea><button class="start" disabled style="display:none">Start</button></div></li>');
				} else {
					var row = $('<li style="list-style:none;" class="col-md-4 photo-container col-padding-no template-upload fade error"><div><img class="cancel" src="'+ base_url +'public/images/closex.png"><img src="'+ base_url +'public/images/noimage.jpg"/><textarea  name="caption[]" class="form-control photo-desc" rows="3" disabled="disabled">' + errorMessage + '</textarea><button class="dummy" disabled style="display:none">Start</button></div></li>');
				}
				
				rows = rows.add(row);
			});
            
            if (0 < $('.template-download').length) {
                $('.template-download').each(function() {
                    if ($(this).hasClass('upload_error')) {
                        $(this).remove();
                    }
                });
            }
			
			return rows;
		},
		downloadTemplate: function (o) {
			var rows = $();
			$.each(o.files, function (index, file) {
                var url = (! file.url) ? base_url + 'public/images/noimage.jpg' : file.url;
                var description = (! file.description) ? ((file.error) ? file.error : 'No caption available') : file.description;
				var row = $('<li style="list-style:none;" class="col-md-4 photo-container col-padding-no template-download fade"><div><a class="glyphicon glyphicon-remove delete" style="cursor:pointer" href="javascript:void(0);"></a><img src="'+ url +'"/><textarea  name="caption[]"  placeholder="Add a caption" class="form-control photo-desc" rows="3" disabled="disabled">' + description + '</textarea><button class="dummy" disabled style="display:none">Start</button></div></li>');

				row.find('.delete')
				.attr('data-type', file.deleteType)
				.attr('data-url', file.deleteUrl);
            
                if (file.opType) {
                    row.closest('.template-download').addClass(file.opType);
                }
				
				rows = rows.add(row);
			});
			
			return rows;
		},
		submit: function (e, data) {
			var caption = data.context.find(':input');
			var video_id = $('#video_id');
			var property_id = $('#property_id');
			var photos_is_submitted = $('#photos_is_submitted');
			var photos_is_visited = $('#photos_is_visited');
			data.formData = {video_id: video_id.val(), property_id: property_id.val(), photos_is_submitted: photos_is_submitted.val(), photos_is_visited: photos_is_visited.val(), caption: caption.val(), };
		},
		stopped: function(e) {
            var errorCount = 0;
            var defaultImageUrl = base_url + 'public/images/noimage.jpg';
            
            $('.just_uploaded').each(function() {
                if (defaultImageUrl == $(this).find('div > img').attr('src')) {
                    errorCount++;
                }
            });
            
            $('.template-upload').each(function() {
                $(this).remove();
            });
            
            if (errorCount === $('.just_uploaded').length) {
                $("a[href='#photos'] .fa-check").css("color", "#e91e63");
                $("#fileupload .errorHandler").show();
            } else if (0 < errorCount && errorCount < $('.just_uploaded').length) {
                $("#fileupload #photos_is_submitted").val(1);
                $("a[href='#photos'] .fa-check").css("color", "#55a018");
                $("#fileupload .warningHandler").show();
            } else {
                $("#fileupload #photos_is_submitted").val(1);
                $("a[href='#photos'] .fa-check").css("color", "#55a018");
                $("#fileupload .successHandler").show();
            }
            
            $("#overlay").hide();			
			$('html,body').animate({
			   scrollTop: $('body').offset().top},
			'slow');
		},
    });

    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        data: {
			'property_id': $("#property_id").val(),
		},
        context: $('#fileupload')[0],
    })
    .always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});
