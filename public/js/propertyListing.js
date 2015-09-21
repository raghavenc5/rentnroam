$(document).ready(function(){
	
	function loadTab1(tabId, tabdiv){
		$('.nav-tabs a[href="#' + tabId + '"]').tab('show');
		$('#'+ tabdiv + '').focus();
	}
	

	$("#saveOverview").click(function(){
        var title_in, description_in, neighbourhood_in, a1, a2, a3, a8, p1;
        /* reset the form fields when click */ 
		document.getElementById("title_fv").innerHTML = "";
        document.getElementById("description_fv").innerHTML = "";
		
		
        // Get the value of the input field with id="numb"
        title_in = document.getElementById("title").value;
        description_in = document.getElementById("description").value;
        description_in_1 = document.getElementById("description").value.length;
        neighbourhood_in = document.getElementById("neighbourhood").value;
        // If x is Not a Number or less than one or greater than 10
        if (title_in === "") {
            
            
            //alert("Please provide the property title");
            document.getElementById("title_fv").innerHTML = "Please provide the property title";
			return false;
        } 
        else if(description_in === "")
        {
           
           // alert("Please provide the property description");
            document.getElementById("description_fv").innerHTML = "Please provide the description";
			return false;
        }
        else if(neighbourhood_in === "")
        {
            //alert("Please provide the neighbourhood details");
			 document.getElementById("neighbourhood_fv").innerHTML = "Please provide the neighbourhood details";
            return false;

           
        }
        else if (description_in_1 < 50)
        {
            //alert("Property Description:- Please provide max length of 50 characters");
            document.getElementById("neighbourhood_fv").innerHTML = "Please provide the neighbourhood details";
			return false;
            
        }
        else 
        {

		  //console.log($( "#formOverview" ).serialize());
		  //Program a custom submit function for the form
			$("#formOverview").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"host/Propertyoverview";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formOverview").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								//alert(obj.message);
								$("a[href='#Overview'] .fa-check").css("color", "#55a018");
								loadTab1("Photo","Photo");
							}
					   },
					   error: function(data) {
						   alert(data);
					   }
					 });

				return false;
			});
          //loadTab("Photo");
        }
	});
	/*------------------- Photo upload ------------------------------*/

			// You don't need this - it's used only for the demo.
            function jsonPrettify(json) {
                if (typeof json != 'string') {
                    json = JSON.stringify(json, undefined, 2);
                }
                json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                    var cls = 'number';
                    if (/^"/.test(match)) {
                        if (/:$/.test(match)) {
                            cls = 'key';
                        } else {
                            cls = 'string';
                        }
                    } else if (/true|false/.test(match)) {
                        cls = 'boolean';
                    } else if (/null/.test(match)) {
                        cls = 'null';
                    }
                    return '<span class="' + cls + '">' + match + '</span>';
                });
            }
            // You don't need this - it's used only for the demo.

	 		// The code
            var filesArray = [];

            /**
             * This function processes all selected files
             *
             * @param e eventObject
             */
            function previewFiles( e ) {
                // FileList object
                var files = e.target.files;
                var preview = $('#imagePreviews');

                // Loop through the FileList and render image files as thumbnails.
                for (var i = 0, f; f = files[i]; i++) {

                    // Only process image files.
                    if (!f.type.match('image.*')) {
                    	alert("This file "+f.name+" not valid file, allow only .png, .jpg, .jpeg");
                        continue;
                    }

                    //size of 100KB
					else if(f.size < 102400)
					{
						alert("This file "+f.name+" has lower the min size, please add above 200kb of size.");
					}

					//size of 5MB  .... 1024KB
					else if(f.size > 5242880)
					{
						alert("This file "+f.name+" has exceed the size, Please add below 1MB to 5MB of size.");
					}

					else{
						 var reader = new FileReader();

	                    // Closure to capture the file information.
	                    reader.onload = (function(theFile) {
	                        return function(e) {
	                            // Render thumbnail.
	                            var li = $('<li style="list-style:none;" class="col-md-4 photo-container col-padding-no"><div><div style="color:red;"class="remove">X</div><img class="thumb" src="'+ e.target.result +'" title="'+ escape(theFile.name) +'"/><textarea  name="caption[]"  placeholder="Caption here" class="form-control photo-desc" rows="3"></textarea></div></li>');
	                            preview.append(li);

	                            // Append image to array
	                            filesArray.push(theFile);
	                        };
	                    })(f,preview);

	                    // Read the image file as a data URL.
	                    reader.readAsDataURL(f);	

						}

                   
                }
            }
            // Attach on change to the file input
            $('#fileInput').on('change', previewFiles);

            /**
             * Remove the file from the array list.
             *
             * @param index integer
             */
            function removeFile( index ){
                filesArray.splice(index, 1);
            }
            // Attach on click listener which will handle the removing of images.
            $(document).on('click', '#imagePreviews .remove',function(e){
                var image = $(this).closest('li');

                console.log(image.index());

                // Remove the image from the array by getting it's index.
                // NOTE: The order of the filesArray will be the same as you see it displayed, therefore
                //       you simply need to get the file's index to "know" which item from the array to delete.
                console.log('Files:' ,filesArray);
                removeFile(image.index());
                console.log('Files:' ,filesArray);

                // Fadeout the image and remove it from the UI.
                image.fadeOut(function(){
                    $(this).remove();
                });
            });


            /**
             * This function processes the submission of the form.
             *
             * @param e
             */
            function submitForm(e){
            	e.preventDefault();
            	var propertyPhoto, videoId;

		        propertyPhoto = document.getElementById("fileInput").value;
		        videoId = document.getElementById("videoId").value;

		        if (propertyPhoto === "") {
		          
		            alert("Please Select photos");
		            return false;
		        } 

		        if (videoId === "") {
		          
		            alert("Please insert youtube video ID");
		            return false;
		        } 

		        if(filesArray.length > 8)
		        {
		        	alert("max photos 10, please put only 10 photos");
		        }	
			
		        else 
		        {

                // Stop the form from actually submitting.
                // Create a new FormData based on our current form.
                // Makes live easier as we can attach a list of File objects.
                var formData = new FormData($('#myForm')[0]);
                for(var i= 0, file; file = filesArray[i]; i++){
                    formData.append('userfile[]', file);
                }
                var url = base_url+"host/uploadImages";

                // Send the ajax request.
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
      				   $("#wait").css("display", "block");
    				},
    				complete: function(){
        				$("#wait").css("display", "none");
    				},
                    success: function(response) {
                        //$('#response').html(jsonPrettify(response));
                    	var obj = JSON.parse(response);
						
							if(obj.status === 400)
							{
								alert(obj.message);
							}
														
							if(obj.status === 200)
							{
								//alert(obj.message);
								$("a[href='#Photo'] .fa-check").css("color", "#55a018");
								loadTab1("Pricing","Pricing");
							}

							
                    },
                    error: function(response) {
                    	//var obj = JSON.parse(response);
						  // alert(response);
						  $('#responseY').html(jsonPrettify(response));
						 // var obj = jsonPrettify(response);
						  alert(response);
					   }
                });
            }
        }
            // Attach on submit to the form submission.
            $('#myForm').on('submit', submitForm);
	
    /*-------------------END Photo upload--------------*/        



	$("#saveBasePrice").click(function(){
        var a1, a2, a3, a4;
		var numbers = /^[0-9]+$/; 
			/* if((inputtxt.value.match(letterNumber))   
			  {  
			   return true;  
			  }*/ 
        a1 = document.getElementById("season1Daily").value;
        a2 = document.getElementById("season1Weekly").value;
        a3 = document.getElementById("season1Monthly").value;
        a4 = document.getElementById("season1Weekend").value;
        
        if (a1 === "" & a2 === "" & a3 === "" & a4 === "") {
          
            alert("Please set all base price fields");
            return false;
        } 
		 else if ( a1 === "")
        {
        	alert("Please set daily price");
            return false;
        }

        else if ( a2 === "")
        {
        	alert("Please set weekly price");
            return false;
        }

        else if ( a3 === "")
        {
        	alert("Please set monthly price");
            return false;
        }

        else if ( a4 === "")
        {
        	alert("Please set weekend price");
            return false;
        }
		

        else
        {
			//loadTab("Amenities");
			$("#formPrice").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"host/insertPreseasonalprice";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formPrice").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{
								//alert('error test');
								var message='Please provide the valid data :';
								document.getElementById("sd1").innerHTML = obj.season1_daily;
								document.getElementById("sw1").innerHTML = obj.season1_weekly;
								document.getElementById("sm1").innerHTML = obj.season1_monthly;
								document.getElementById("swe1").innerHTML = obj.season1_weekend;
								document.getElementById("clean_charge").innerHTML = obj.clean_charge;
								document.getElementById("guest_charge").innerHTML = obj.guest_charge;
								document.getElementById("security_charge").innerHTML = obj.security_charge;
								alert(message+'\n'+obj.season1_daily + '\n' + obj.season1_weekly+ '\n'+obj.season1_monthly+'\n'+obj.season1_weekend);
							}
							if(obj.status === 200)
							{
								//alert(obj.message);
								$("a[href='#Pricing'] .fa-check").css("color", "#55a018");
								loadTab1("Amenities","Amenities");
							}
							
							
					   },
					   error: function(data) {
						   alert('error');
					   }
					 });

				return false;
			});
        }
		

	});

	$("#saveAmenities").click(function(){
        var a1, a2, a3, a4;

        
    		$("#formAmenities").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"host/insertAmenities";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formAmenities").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{
								
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								//alert(obj.message);
								$("a[href='#Amenities'] .fa-check").css("color", "#55a018");
								loadTab1("Listing","Listing");
							}
							//alert(data);
							
							//alert(obj.);
						   // loadTab1("Photo","photo_tab");
					   },
					   error: function(data) {
						   alert('error');
					   }
					 });

				return false;
			});
    	

        
	});

	$("#saveInfo").click(function(){
   
		 var a1, a2;
		 
        a1 = document.getElementById("check_in").value;
        a2 = document.getElementById("check_out").value;
       
        if (a1 === "" & a2 === "") {
          
            alert("Please set check in and check out time");
            return false;
        } 
		 else if ( a1 === "")
        {
        	alert("Please set check in time");
            return false;
        }

        else if ( a2 === "")
        {
        	alert("Please set check out time");
            return false;
        }

        else
        {
			//loadTab("Amenities");
			$("#formInfo").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"host/insertListinginfo";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formInfo").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.type === 1)
							{
								
									alert(obj.tag);
																
							}
							if(obj.type === 2)
							{
								
									alert(obj.message);
																
							}
							
							if(obj.type === 2)
							{
								
									alert(obj.message);
																
							}
							
							
							if(obj.type === 4)
							{
								//alert(obj.message);
								$("a[href='#Listing'] .fa-check").css("color", "#55a018");
								loadTab1("Location","Location");
							}
							
							//alert(obj.);
						   // loadTab1("Photo","photo_tab");
					   },
					   error: function(data) {
						   alert(data);
					   }
					 });

				return false;
			});
        }
        
	});
	
	
	$("#saveAddress").click(function(){
   
		 var a1, a2, a3, a4, a5, a6, a7, a8;
		 
        a1 = document.getElementById("address1").value;
        a2 = document.getElementById("address2").value;
		a3 = document.getElementById("country-list").value;
		a4 = document.getElementById("state_dropdown").value;
		a5 = document.getElementById("city_dropdown").value;
		a6 = document.getElementById("area").value;
		a7 = document.getElementById("zip").value;
		a8 = document.getElementById("lat").value;
        
        if (a1 === "" & a2 === "" & a3 === "" & a4 === "" & a5 === "" & a6 === "" & a7 === "" & a8 === "") {
          
            alert("Please fill up all the fields");
            return false;
        } 
		 else if ( a1 === "")
        {
        	alert("Please fill the address line 1");
            return false;
        }

        else if ( a2 === "")
        {
        	alert("Please fill address line 2");
            return false;
        }
		
		else if ( a3 === "")
        {
        	alert("Please select country");
            return false;
        }
		else if ( a4 === "")
        {
        	alert("Please select state");
            return false;
        }
		else if ( a5 === "")
        {
        	alert("Please select city");
            return false;
        }
		
		else if ( a6 === "")
        {
        	alert("Please fill area");
            return false;
        }
		
		else if ( a7 === "")
        {
        	alert("Please fill zip");
            return false;
        }
		
		else if ( a8 === "")
        {
        	alert("Please point your exact location on map");
            return false;
        }

        else
        {
			//loadTab("Amenities");
			$("#formAddress").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"host/insertLocation";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formAddress").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{
								var msg = obj.message;
								alert(msg);
								
							}
							if(obj.status === 200)
							{
								$("a[href='#Location'] .fa-check").css("color", "#55a018");
								var msg = obj.message;
								alert(msg);
							}
							
							//alert(obj.);
						   // loadTab1("Photo","photo_tab");
					   },
					   error: function(data) {
							
						   alert(data);
					   }
					 });

				return false;
			});
        }
        
	});
	
	
	

	
	
	
	
	
	//POSTING property photos
	
		
		
});