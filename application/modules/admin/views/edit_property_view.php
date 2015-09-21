<?php echo $this->load->view('admin/header_view'); ?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Edit Property </h2>
			<div class="box-icon">				
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>				
			</div>
		</div>
		
		<div class="box-content">
			<form class="form-horizontal" id="formOverview" method="post" enctype="multipart/form-data" 
			       >
				<h4>Property Overview</h4>
				<fieldset>															 
					<div class="control-group"> 
					<label class="control-label" for="focusedInput">Title</label>
						<div class="controls">
							<input class="input-xlarge focused" type="text"
										 name="title" id="title" value="<?php 
										 if(!empty($property_info->property_title))
											{																																
												echo $property_info->property_title;								
											}
										 ?>">
						</div>
					</div>
					
					<div class="control-group"> 
					<label class="control-label" for="focusedInput">Description</label>
						<div class="controls">
							<textarea class="input-xlarge focused" type="text" 
							name="description" id="description" 
							>
							<?php
							if(!empty($property_info->description))
							{																																
								echo $property_info->description;								
							}
							?>
							</textarea> 
						</div>
					</div>
					<input type="hidden" name="property_id" value="<?php echo $property_info->property_id;?>">
					<input type="hidden" name="user_id" value="<?php echo $property_info->user_id;?>">
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">Neighberhood Highligh</label>
					<div class="controls">
						<textarea class="input-xlarge focused" type="text" name="neighbourhood" id="neighbourhood" 
						>
						<?php 
							
							if(!empty($property_info->neighbourhood_highlight))
							{
								echo $property_info->neighbourhood_highlight;
							}
						?>
						</textarea> 
						
					</div>
					</div>
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">House Rules</label>
					<div class="controls">
						<textarea class="input-xlarge focused" type="text" name="house_rules" id="house_rules">
							<?php 
							if(!empty($property_info->house_rule))
							{
								echo $property_info->house_rule;
							}	
						?>
						</textarea> 
						
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">Min Night stay</label>
					<div class="controls">
						 <select class="form-control" name="min_night" id='min_night'>
						 <?php 
							if(!empty($property_info->min_night_stay))
							{
							

			                    echo   '<option value='.$property_info->min_night_stay.'>'.$property_info->min_night_stay.'</option>';
							}
							?>
			
			                            <option value="1">1</option>
			                            <option value="2">2</option>
			                            <option value="3">3</option>
			             </select>
					</div>
					</div>
					
					<input type="submit" value="Save" id="saveOverview" class="btn btn-success">
				</fieldset>
				</form>					
		</div>
		<hr> 

		<div class="box-content">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<h4>Property Listing</h4>
				<fieldset>															 
					<div class="control-group"> 
					<label class="control-label" for="focusedInput">Property Type</label>
						<div class="controls">
						<!--	<input class="input-xlarge focused" type="text"
										 name="title" id="property_title" value="">-->
							<?php 
								$base_url  = base_url();
                                $baseUrl = $base_url.'host/getPropertytype';                    
                                $jsonData = file_get_contents($baseUrl); 
                                $jsonDataObject = json_decode($jsonData);
                                echo  '<select name="property_type_id" class="form-control">';
                                if(!empty($property_info->property_type) & !empty($property_info->property_type_id))
								{ 
                                echo  '<option value='.$property_info->property_type_id.'>'.$property_info->property_type.'</option>';   
                                }
                                foreach($jsonDataObject as $common)
                                {
                                   echo  '<option value='.$common->property_type_id.'>'.$common->property_type.'</option>';                                            
                                
                                } 
                                echo '</select>';                                                                    
                            ?> 
                             			 
						</div>
					</div>
					
					<div class="control-group"> 
					<label class="control-label" for="focusedInput">Room type</label>
						<div class="controls">
								<?php 
								$baseUrl = $base_url.'host/getRoomtype';                    
                                $jsonData = file_get_contents($baseUrl); 
                                $jsonDataObject = json_decode($jsonData);
                                echo  '<select name="room_type_id" class="form-control">'; 
                                if(!empty($property_info->roomtype) & !empty($property_info->room_type_id))
								{ 
                                echo  '<option value='.$property_info->room_type_id.'>'.$property_info->roomtype.'</option>';   
                                }
                                foreach($jsonDataObject as $common)
                                {
                                   echo  '<option value='.$common->room_type_id.'>'.$common->roomtype.'</option>';                                            
                                
                                } 
                                echo '</select>';                                                                    
                            ?> 
                             	
						</div>
					</div>
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">No of guest allow</label>
					<div class="controls">
						  <select name="guest"  class="form-control">
						  <?php 
						  if(!empty($property_info->guest_allow))
						  { 
							echo 	'<option value='.$property_info->guest_allow.'>'.$property_info->guest_allow.'</option>';
						  }
						  ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
						
					</div>
					</div>
					
					<div class="control-group">
					<label class="control-label" for="focusedInput">No of bedrooms</label>
					<div class="controls">
						<select name="guest"  class="form-control">
						  <?php 
						  if(!empty($property_info->bedrooms))
						  { 
							echo 	'<option value='.$property_info->bedrooms.'>'.$property_info->bedrooms.'</option>';
						  }
						  ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
						
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">No of beds</label>
					<div class="controls">
						 <select name="guest"  class="form-control">
						  <?php 
						  if(!empty($property_info->bed))
						  { 
							echo 	'<option value='.$property_info->bed.'>'.$property_info->bed.'</option>';
						  }
						  ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">No of bathrooms</label>
					<div class="controls">
						  <select name="guest"  class="form-control">
						  <?php 
						  if(!empty($property_info->bathrooms))
						  { 
							echo 	'<option value='.$property_info->bed.'>'.$property_info->bathrooms.'</option>';
						  }
						  ?>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                          </select>
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">Cancellation Policy</label>
					<div class="controls">
						<?php 
								$baseUrl = $base_url.'host/getCancellationpolicy';                    
                                $jsonData = file_get_contents($baseUrl); 
                                $jsonDataObject = json_decode($jsonData);
                                echo  '<select name="room_type_id" class="form-control">'; 
                                if(!empty($property_info->cancellatioin_policy_id) & !empty($property_info->policy))
								{ 
                                echo  '<option value='.$property_info->cancellatioin_policy_id.'>'.$property_info->policy.'</option>';   
                                }
                                foreach($jsonDataObject as $common)
                                {
                                   echo  '<option value='.$common->cancellatioin_policy_id.'>'.$common->policy.'</option>';                                            
                                
                                } 
                                echo '</select>';                                                                    
                            ?> 
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">Check in time</label>
					<div class="controls">
						 <?php 
						  if(!empty($property_info->check_in_time))
						  { 
							echo 	'<input type="time" value='.$property_info->check_in_time.'>';
						  }
						  ?>
					</div>
					</div>


					<div class="control-group">
					<label class="control-label" for="focusedInput">Check out time</label>
					<div class="controls">
						<?php   
						if(!empty($property_info->check_out_time))
							{
								echo 	'<input type="time" value='.$property_info->check_out_time.'>';
							}
						?>
			                            
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">Current Tags</label>
					<div class="controls">
						<?php 
						 if(!empty($property_tags))
							{														
								foreach($property_tags as $option)
								{												
									echo '<i>'.$option['tag'].'</i><br>';
								}									
							}
						 else	
						 echo "no tags"; 	
						?>	
						
					</div>
					</div>

					<div class="control-group">
					<label class="control-label" for="focusedInput">Tags</label>
					<div class="controls">
						<?php 
                             // Base URL for the service
                            $baseUrl = $base_url.'host/getTags';                    
                            $jsonData = file_get_contents($baseUrl); 
                            $jsonDataObject = json_decode($jsonData);
                           
                            $count =0;
                           
                           
                            foreach($jsonDataObject as $common)
                            {
                                echo '<input id="tag_check'.$count.'" name="tag[]"  type="checkbox" value="'.$common->id.'">
                                <label for="extra_check'.$count.'">'.$common->tag.'</label>'.PHP_EOL;
                                //echo "\r\n";
                                $count++;
                            }
                           
                        ?>
					</div>
					</div>
					
					<input type="submit" value="Save" class="btn btn-success">
				</fieldset>
				</form>					
		</div>
		<hr> 
	</div><!--/span-->				
</div><!--/row-->
<script type="text/javascript">
	$(document).ready(function(){
		$("#saveOverview").click(function(){
        

		  //console.log($( "#formOverview" ).serialize());
		  //Program a custom submit function for the form
			$("#formOverview").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin+"/rentnroam/admin";
				//alert(base_url);

				var url = BASE_URL+"admin/property_detail/Propertyoverview";
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
								 console.log(data);
							}
							if(obj.status === 200)
							{
								alert(obj.message);
								 console.log(data);
								
							}
					   },
					   error: function(data) {
						  alert(data);
						  console.log(data);
					   }
					 });

				return false;
			});
          //loadTab("Photo");
        
	});
	});
	
</script>>
	


<?php echo $this->load->view('admin/footer_view');  ?>