function selectState(country_id){
	if(country_id!=""){
		loadData('state',country_id);
		$("#city_dropdown").html("<option value=''>Select city</option>");	
	}else{
		$("#state_dropdown").html("<option value=''>Select state</option>");
		$("#city_dropdown").html("<option value=''>Select city</option>");		
	}
}

function selectCity(state_id){
	if(state_id!=""){
		loadData('city',state_id);
	}else{
		$("#city_dropdown").html("<option value=''>Select city</option>");		
	}
}

function loadData(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    //$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
	$.ajax({
		type: "POST",
		url: base_url + "host/loadData",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value=''>Select "+loadType+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}
