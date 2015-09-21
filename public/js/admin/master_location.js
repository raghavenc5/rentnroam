$(document).ready(function(){
	


	//pop up dialog for add country
	$("#addCountry").click(function(){
		el = document.getElementById("overlayCountry");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	$('#overlayCountry').focus();
	});

	//close dialog for add country
	$("#CountryClose").click(function(){
		el = document.getElementById("overlayCountry");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	$('#overlayCountry').focus();
	});

	//close dialog for edit country
	$("#CountryEditClose").click(function(){
		el = document.getElementById("overlayEditCountry");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//close dialog for edit property type
	$("#EditCloseproptype").click(function(){
		el = document.getElementById("overlayEditPropertytype");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	}); 

	//close dialog for edit property type
	$("#EditCloseTag").click(function(){
		el = document.getElementById("overlayEditPropertytag");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//close dialog for edit smiley type
	$("#EditCloseSmiley").click(function(){
		el = document.getElementById("overlayEditPropertysmily");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//close dialog for edit city
	$("#cityEditClose").click(function(){
		el = document.getElementById("overlayEditCity");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//close dialog for edit amenities sub type
	$("#EditAsubtype").click(function(){
		el = document.getElementById("overlayEditASubtype");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//pop up dialog for add_state
	$("#addState").click(function(){
		el = document.getElementById("overlayState");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	$('#overlayState').focus();
	});

	//close dialog for edit state
	$("#stateEditClose").click(function(){
		el = document.getElementById("overlayEditState");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});


	//close dialog for edit roomtype
	$("#EditRoomtype").click(function(){
		el = document.getElementById("overlayEditRoomtype");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});
	//close dialog for edit amenitiestype
	$("#EditAmenitiestypeClose").click(function(){
		el = document.getElementById("overlayEditAmenities");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});

	//pop up dialog for add_state
	$("#stateClose").click(function(){
		el = document.getElementById("overlayState");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});




	//form submit from add country
	$("#CountrySubmitButton").click(function(){
   
		 var a1, a2;
		 
        a1 = document.getElementById("country_fid").value;
        a2 = document.getElementById("status_fid").value;
       
      
		if ( a1 === "")
        {
        	alert("Please fill up the Country field");
            return false;
        }

        else if ( a2 === "")
        {
        	alert("Please select status");
            return false;
        }

        else
        {
			$("#submitCountry").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/insertCountry";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitCountry").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
        }
        
	});


	//delete country
	$(".countryDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".countryId").text();
			
			var url = BASE_URL+"admin/master/deleteCountry/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								//console.log(obj.message);
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("You cant delete row, Remove the child row first from MASTER CITY AND MASTER STATE");
					   }
					 });
		}
			
		

	});		

	//get country and display as input value for editing 
	$(".countryEdit").click(function(){
			//opening master country edit dialog box
			el = document.getElementById("overlayEditCountry");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditCountry').focus();

			var x = $(this).closest("tr").find(".countryId").text();
			
			var url = BASE_URL+"admin/master/getIdbyCountry/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("country1_fid").value =
							obj.country_name;
							document.getElementById("status1_fid").value =
							obj.status;
							document.getElementById("countryfid").value =
							obj.country_id;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	


	//to post update data country_master
	//form submit from edit country dialog box
	$("#CountryEditButton").click(function(){
   
		 var a1, a2;
		 
        a1 = document.getElementById("country1_fid").value;
        a2 = document.getElementById("status1_fid").value;
       
      
		if ( a1 === "")
        {
        	alert("Please fill up the Country field");
            return false;
        }

        else if ( a2 === "")
        {
        	alert("Please select status");
            return false;
        }

        else
        {
			$("#submitEditCountry").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/editCountry";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitEditCountry").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
        }
        
	});


	//form submit from add State
	$("#StateSubmitButton").click(function(){
   
		 var a1;
		 
        a1 = document.getElementById("state_Sfid").value;
        
      
		if ( a1 === "")
        {
        	alert("State is required");
            return false;
        }
        else
        {
			$("#submitState").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/insertCountrystate";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitState").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
        }
        
	});

	//delete country
	$(".stateDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".stateId").text();
			
			var url = BASE_URL+"admin/master/deleteState/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								//console.log(obj.message);
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("You cant delete row, Remove the child row from MASTER CITY");
					   }
					 });
		}
			
		

	});		

	//get state and display as input value for editing 
	$(".stateEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditState");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditState').focus();

			var x = $(this).closest("tr").find(".stateId").text();
			
			var url = BASE_URL+"admin/master/getStateById/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("country_SfEid").value =
							obj.country_name;
							document.getElementById("state_SfEid").value =
							obj.state_name;
							document.getElementById("status_SfEid").value =
							obj.status;
							
							document.getElementById("id_SfEid").value =
							obj.id;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	

	
	//form submit from edit country dialog box
	$("#StateEditButton").click(function(){
   
		 var a1, a2;
		 
        a1 = document.getElementById("state_SfEid").value;      
      
		if ( a1 === "")
        {
        	alert("Please fill up the Country field");
            return false;
        }

     
        else
        {
			$("#submitEditState").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/editState";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitEditState").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
        }
        
	});

	//insert new city..
	$("#addCity").click(function(){
		 var a1, a2, a3, a4;
		 
        a1 = document.getElementById("country_cityID").value;  
        a2 = document.getElementById("state_cityID").value;
        a3 = document.getElementById("cityID").value;      
        a4 = document.getElementById("statusID").value; 
		
		if ( a1 === "-1")
        {
        	alert("Please Select Country");
            return false;
        }
        else if(a2 === "-1")
        {
        	alert("Please Select State");
            return false;
        }	
        else if(a3 === "")
        {
        	alert("Please insert city");
            return false;
        }
        else if(a4 === "-1")
        {
        	alert("Please Select Status");
            return false;
        }
		else
		{
			$("#formCity").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/insertNewlocation";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formCity").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
									console.log(obj.message);							
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
        
		}       
	});

	//delete city
	$(".CityDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".cityDeleteId").text();
			
			var url = BASE_URL+"admin/master/deleteCity/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								//console.log(obj.message);
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});		

	//get city and display as input value for editing 
	$(".CityEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditCity");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditCity').focus();

			var x = $(this).closest("tr").find(".cityDeleteId").text();
			
			var url = BASE_URL+"admin/master/getCitydetByID/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("countryID_city").value =
							obj.country_name;
							document.getElementById("stateID_city").value =
							obj.state_name;
							document.getElementById("cityID_city").value =
							obj.city_name;
							document.getElementById("status_city").value =
							obj.status;
							document.getElementById("cityID_c").value =
							obj.id;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	


	//form submit from edit country dialog box
	$("#CityEditButton").click(function(){
   
		 
			$("#submitEditCity").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/editCity";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitEditCity").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
       
        
	});
	

	//form submit from edit country dialog box
	$("#addRoomtype").click(function(){
	 $("#formRoomtype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertRoomtype";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							if(obj.status === 1)
							{								
									alert(obj.message+'\n'+obj.roomtype+'\n'+obj.title);									
																
							}						
							
							else if(obj.status === 2)
							{
								alert(obj.message);	 							
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});


	//delete city
	$(".RoomDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".roomtype_id").text();
			//alert(x);
			var url = BASE_URL+"admin/master/deleteRoomtype/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								//console.log(obj.message);
								alert(obj.message);
							}
							else
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
								
							}
							
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });

		}
			
		
		
	});	


	//get state and display as input value for editing 
	$(".RoomEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditRoomtype");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditRoomtype').focus();

			var x = $(this).closest("tr").find(".roomtype_id").text();
			
			var url = BASE_URL+"admin/master/getRoomtypebyID/"+x;
			var imgpath = BASE_URL+"public/images/room_type/";
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("editroomtype").value =
							obj.roomtype;
							document.getElementById("editroomtype_id").value =
							obj.room_type_id;
							document.getElementById("editHovertitle").value =
							obj.title;							
							document.getElementById("imageRoomicon").src = imgpath+obj.images;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	


	//form submit from edit country dialog box
	$("#EditRoomtypeButton").click(function(){
	 $("#submitEditRoomtype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/editRoomtype";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							
							if(obj.status === 2)
							{
								alert(obj.message);	 							
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});

	//get amenities type and display as input value for editing 
	$(".AmenitiesEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditAmenities");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditAmenities').focus();

			var x = $(this).closest("tr").find(".amenitiesTypeId").text();
			
			var url = BASE_URL+"admin/master/getAmenitiestypeByID/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("editamenities").value =
							obj.amenities_type_name;
							document.getElementById("editamenitiestype_id").value =
							obj.amenities_type_id;							
							document.getElementById("editAstatus").value =
							obj.status;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	


	//form submit from edit Amenities dialog box
	$("#EditAmenitiesButton").click(function(){
   
		 
			$("#submitEditAmenities").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var url = BASE_URL+"admin/master/editAmenitestype";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#submitEditAmenities").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}						
							
							else(obj.status === 200)
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});
       
        
	});

	//form submit for master amenities type dialog box
	$("#addAmenitiestype").click(function(){
	 $("#formAmenitiestype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertAmenities";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message+"\n"+obj.atype);									
																
							}						
							
							else
							{
								alert(obj.message);	 							
								window.location.reload(true);
							}
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});



	//delete amenities type
	$(".AmenitiesDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".amenitiesTypeId").text();
			
			var url = BASE_URL+"admin/master/deleteAmenitiestype/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});		

	//form submit from edit country dialog box
	$("#addAmenitiesSubtype").click(function(){
	 $("#formAmenitiesSubtype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertAmenitiesSubtype";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							if(obj.status === 1)
							{								
									alert(obj.message+'\n'+obj.Atype+'\n'+obj.Asubtype+'\n'+obj.status1);									
																
							}						
							
							else if(obj.status === 2)
							{
								alert(obj.message);	 							
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});

	//get amenities Sub type and display as input value for editing 
	$(".AmenitiesSubEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditASubtype");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditASubtype').focus();

			var x = $(this).closest("tr").find(".amenitiesSubTypeId").text();
			var imgpath = BASE_URL+"public/images/amenities/";
			var url = BASE_URL+"admin/master/getAmenitieSubstypeByID/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("editAtype").value =
							obj.amenities_type_name;
							document.getElementById("editAsubtype").value =
							obj.amenities_subtype;							
							document.getElementById("editAsubtype_id").value =
							obj.amenities_id;
							document.getElementById("editASstatus").value =
							obj.status;
							document.getElementById("imageASicon").src = imgpath+
							obj.images;
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});	


	//form submit from edit Master sub type amenities dialog box
	$("#EditAsubtypeButton").click(function(){
	 $("#submitEditASubtype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/editASubtype";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							if(obj.status === 3)
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});


	//delete amenities type
	$(".AmenitiesSubDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".amenitiesSubTypeId").text();
			
			var url = BASE_URL+"admin/master/deleteAmenitiesSubtype/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	


	//insert new city..
	$("#addProptype").click(function(){
		
			$("#formPropertytype").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;

				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertPropertytype";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 1)
							{								
									alert(obj.message+'\n'+obj.property_type+'\n'+obj.E_type);									
																
							}						
							
							else if(obj.status === 2)
							{
								alert(obj.message);	 							
								//window.location.reload(true);
							}

							else if(obj.status === 3)
							{
								alert(obj.message);	 							
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});


	//get amenities Sub type and display as input value for editing 
	$(".PropertytypeEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditPropertytype");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditPropertytype').focus();

			var x = $(this).closest("tr").find(".propTypeId").text();
			
			var url = BASE_URL+"admin/master/getPropertytypeByID/"+x;

			var imgpath = BASE_URL+"public/images/property_type/";
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("prop_type").value =
							obj.property_type;
							document.getElementById("prop_id").value =
							obj.property_type_id;							
							document.getElementById("button_type").value =
							obj.element_type;
							document.getElementById("imagePropicon").src =imgpath+obj.images;
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});

	//form submit from edit Master sub type amenities dialog box
	$("#EditProptypeButton").click(function(){
	 
	 $("#submitEditPropertytype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/editPropertytype";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);
							if(obj.status === 2)
							{
								alert(obj.message);	 
								
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}	
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	


		//delete amenities type
	$(".proptypeDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".propTypeId").text();
			
			var url = BASE_URL+"admin/master/deletePropertytype/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});		


	//get tag and display as input value for editing 
	$(".PropertytagEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditPropertytag");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditPropertytag').focus();

			var x = $(this).closest("tr").find(".tagId").text();
			
			var url = BASE_URL+"admin/master/getPropertytagByID/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("tag").value =
							obj.tag;
							document.getElementById("tag_id").value =
							obj.id;							
							
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});
	
	//form submit from edit Master sub type amenities dialog box
	$("#EditTagButton").click(function(){
	 
	 $("#submitEditTags").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/editPropertytag";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);

							if(obj.status === 400)
							{
								alert(obj.message);	 
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	


	//delete tag
	$(".tagDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".tagId").text();
			
			var url = BASE_URL+"admin/master/deletePropertytag/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	


	//insert new tag
	$("#addProptag").click(function(){
		
			$("#formPropertytag").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertTag";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}													
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});
	


	/*-----*/
	//insert smiley
	$("#addPropSmiley").click(function(){
		
			$("#formPropertySmiley").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/insertSmiley";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}													
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});

	//delete smiley
	$(".smileyDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".smileyId").text();
			
			var url = BASE_URL+"admin/master/deletePropertysmiley/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	



	//get smiley and display as input value for editing 
	$(".PropertySmileyEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditPropertysmily");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditPropertysmily').focus();

			var x = $(this).closest("tr").find(".smileyId").text();
			var imgpath = BASE_URL+"public/images/emoticons/";
			var url = BASE_URL+"admin/master/getSmileybyId/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("smiley_id").value =
							obj.smiley_id;
							document.getElementById("imgSmiley").src = imgpath+
							obj.smiley_icon;							
							
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});

	//form submit from edit Master sub type amenities dialog box
	$("#EditSmileyButton").click(function(){
	 
	 $("#submitEditsmily").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/editSmiley";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);

							if(obj.status === 400)
							{
								alert(obj.message);	 
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	




	/*----Cancellation policy---*/
		
	//get policy and display as input value for editing 
	$(".policyEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditPolicy");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditPolicy').focus();

			var x = $(this).closest("tr").find(".policyId").text();
			
			var url = BASE_URL+"admin/master/getPolicybyId/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("policy").value =
							obj.policy;
							document.getElementById("policy_id").value =
							obj.id;
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});
	
	//close dialog for edit policy
	$("#EditClosePolicy").click(function(){
		el = document.getElementById("overlayEditPolicy");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});
	
	
	//form submit from edit Policy dialog box
	$("#EditPolicyButton").click(function(){
	 
	 $("#submitEditpolicy").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/updatePolicy";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);

							if(obj.status === 400)
							{
								alert(obj.message);	 
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	

	
	//insert policy
	$("#addPropPolicy").click(function(){
		
			$("#formPropertyPolicy").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/addPolicy";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}													
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});

	//delete policy
	$(".policyDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".policyId").text();
			
			var url = BASE_URL+"admin/master/deletePolicy/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	

	/*----Master Price period---*/
		
	//get policy and display as input value for editing 
	$(".periodEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditPricePeriod");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditPricePeriod').focus();

			var x = $(this).closest("tr").find(".periodId").text();
			
			var url = BASE_URL+"admin/master/getPeriodbyId/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("period").value =
							obj.period;
							document.getElementById("period_id").value =
							obj.id;
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});
	
	//close dialog for edit policy
	$("#EditClosePeriod").click(function(){
		el = document.getElementById("overlayEditPricePeriod");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});
	
	
	//form submit from edit Policy dialog box
	$("#EditPeriodButton").click(function(){
	 
	 $("#submitEditPricePeriod").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/updatePeriod";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);

							if(obj.status === 400)
							{
								alert(obj.message);	 
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	

	
	//insert policy
	$("#addPeriod").click(function(){
		
			$("#formPeriod").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/addPeriod";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}													
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});

	//delete period 
	$(".periodDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".periodId").text();
			
			var url = BASE_URL+"admin/master/deletePeriod/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	
	

	/*----Master Price Season type---*/		
	

	//get Season and display as input value for editing 
	$(".seasonEdit").click(function(){
			//opening master state edit dialog box
			el = document.getElementById("overlayEditSeasontype");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 		$('#overlayEditSeasontype').focus();

			var x = $(this).closest("tr").find(".seasonId").text();
			
			var url = BASE_URL+"admin/master/getSeasonbyId/"+x;
				$.ajax({
					   type: "GET",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							document.getElementById("season").value =
							obj.season_type;
							document.getElementById("season_id").value =
							obj.id;
							
					   },
					   error: function(response) {
					   	
						   alert("error....");
					   }
					 });		

	});
	
	//close dialog for edit Season
	$("#EditCloseSeason").click(function(){
		el = document.getElementById("overlayEditSeasontype");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	 	
	 	
	});
	
	
	//form submit from edit Policy dialog box
	$("#EditSeasonButton").click(function(){
	 
	 $("#submitEditSeasontype").submit(function(e){
					e.preventDefault();
					//$(this)[0] === this
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/updateSeason";

				$.ajax({
					url: url,
					type: 'POST',
					contentType: false,
					data: formData,
					processData: false,
					async: false,
					success: function (data) {
							var obj = JSON.parse(data);

							if(obj.status === 400)
							{
								alert(obj.message);	 
								//window.location.reload(true);
							}
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
								
							
					},
					error: function(data) {
						alert(data);
						console.log(data);
						},
					cache: false,
					processData: false
				});

				return false;
			});
	});	

	
	//insert policy
	$("#addSeason").click(function(){
		
			$("#formSeason").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var formData = new FormData($(this)[0]);
				var url = BASE_URL+"admin/master/addSeason";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: false,
						data: formData,
						processData: false,
						async: false,
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{								
									alert(obj.message);									
																
							}													
							else
							{
								alert(obj.message);	 
								window.location.reload(true);
							}
							//alert(data);
						
					   },
					   error: function(data) {
						   alert('error...');
					   }
					 });

				return false;
			});       
	});

	//delete period 
	$(".seasonDelete").click(function(){
		var r = confirm("Do you really want to delete?");
		//var r$(this).closest("tr").find(".countryId").text());
		if(r === true)
		{
			var x = $(this).closest("tr").find(".seasonId").text();
			
			var url = BASE_URL+"admin/master/deleteSeason/"+x;
				$.ajax({
					   type: "POST",
					   url: url,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 200)
							{
								//console.log(obj.message);
								alert(obj.message);
								window.location.reload(true);
							}
							
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("Error....");
					   }
					 });
		}
			
		

	});	
	
	

	/*----------------------------------------*/


	
		
	

	
		//$(this).closest("tr").find(".countryId").text();
			
					
});
