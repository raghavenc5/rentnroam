<?php echo $this->load->view('admin/header_view'); ?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><span class= class="glyphicon glyphicon-info-sign"></span>Property Details </h2>
			<div class="box-icon">				
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>				
			</div>
		</div>
		
		<div class="box-content">
			
				
				<fieldset>					
					<h4>Overview Property</h4>				 
					<dl>
					<dt>Property title</dt>
					
						<dd>
						<?php 
						if(!empty($property_info->property_title))
						{																																
							echo $property_info->property_title;								
						}
						else 
							echo "Not Provided";
						?>
						</dd>
					</dl>
					
					<dl>
					<dt>Property description</dt>
					
						<dd>
							
							<?php 
							if(!empty($property_info->description))
							{																																
								echo $property_info->description;								
							}
							else
								echo "Not Provided"; 
							?>
						</dd>
					</dl>
					
					<dl>
					<dt>Neighberhood highlight</dt>
					
						<dd>
						<?php 
							
							if(!empty($property_info->neighbourhood_highlight))
							{
								echo $property_info->neighbourhood_highlight;
							}
							else
								echo "Not Provided";
						?>
						</dd>
					</dl>
					
					<dl>
					<dt>House Rules</dt>
					
						<dd>
						<?php 
							if(!empty($property_info->house_rule))
							{
								echo $property_info->house_rule;
							}
							else
								echo "Not Provided";	
						?>
					</dd>
					</dl>

					<dl>
					<dt>Min night Stay</dt>
					
						<dd>
						<?php 
						if(!empty($property_info->min_night_stay))
							{
								echo $property_info->min_night_stay;
							}
						else
								echo "Not Provided";	
						?>	
					</dd>
					</dl>
				</fieldset>
				<hr>

				
				<fieldset>					
				<h4>Listing Information</h4>					 
					<dl>
					<dt>Property type</dt>
					
						<dd>
							<?php 
							//echo $property_info->property_type;
							if(!empty($property_info->property_type))
							{
								echo $property_info->property_type;
							}
							else
								echo "Not Provided";
							?>
						</dd>
					</dl>
					
					<dl>
					<dt>Room type</dt>
					
						<dd>
							<?php 
							//echo $property_info->roomtype;
							if(!empty($property_info->roomtype))
							{
								echo $property_info->roomtype;
							}
							else
								echo "Not Provided";
							?>
						</dd>
					</dl>
					
					<dl>
					<dt>No of guest allow</dt>
					
						<dd>
						<?php 
						//echo $property_info->guest_allow;
						if(!empty($property_info->guest_allow))
							{
								echo $property_info->guest_allow;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>
					
					<dl>
					<dt>No of bedrooms</dt>
					
						<dd>
						<?php 
						//echo $property_info->bedrooms;
						if(!empty($property_info->bedrooms))
							{
								echo $property_info->bedrooms;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>

					<dl>
					<dt>No of beds</dt>
					
						<dd>
						<?php 
						//echo $property_info->bed;
						if(!empty($property_info->bed))
							{
								echo $property_info->bed;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>

					<dl>
					<dt>No of bathrooms</dt>
					
						<dd>
						<?php 
						//echo $property_info->bathrooms;
						if(!empty($property_info->bathrooms))
							{
								echo $property_info->bathrooms;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>

					<dl>
					<dt>Cancellation Policy</dt>
					
						<dd>
						<?php 
						if(!empty($property_info->policy) & !empty($property_info->policy_description) )						{
								echo $property_info->policy."<br>".$property_info->policy_description;
							}
							else
								echo "Not Provided";
						?>						
					</dd>
					</dl>

					

					<dl>
					<dt>Check In time</dt>
					
						<dd>
						<?php 
						//echo $property_info->check_in_time;
						if(!empty($property_info->check_in_time))
							{
								echo $property_info->check_in_time;
							}
							else
								echo "Not Provided";	
						?>
					</dd>
					</dl>

					<dl>
					<dt>Check out time</dt>
					
						<dd>
						<?php 
						//echo $property_info->check_out_time;
						if(!empty($property_info->check_out_time))
							{
								echo $property_info->check_out_time;
							}
							else
								echo "Not Provided";

						?>
					</dd>
					</dl>

					<dl>
					<dt>Tags</dt>
					
						<dd>
					<?php if(!empty($property_tags))
						{														
							foreach($property_tags as $option)
							{												
								echo '<span>'.$option['tag'].'<br></span>';
							}
								
						}
						else
								echo "Not Provided";
						?>

						</dd>
					</dl>

					</fieldset>
				<hr>

				<fieldset>					
				<h4>Location </h4>					 
					<dl>
					<dt>Address</dt>
					
						<dd>
							<?php 
							//echo $property_info->address_line1;
							if(!empty($property_info->address_line1))
							{
								echo $property_info->address_line1;
							}
							else
								echo "Not Provided";
							?>
						</dd>
					</dl>
					
					<dl>
					<dt>Country</dt>
					
						<dd>
							<?php 
							//echo $property_info->country_name;
							if(!empty($property_info->country_name))
							{
								echo $property_info->country_name;
							}
							else
								echo "Not Provided";
							
							?>
						</dd>
					</dl>
					
					<dl>
					<dt>State</dt>
					
						<dd>
						<?php 
						//echo $property_info->state_name;
						if(!empty($property_info->state_name))
							{
								echo $property_info->state_name;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>
					
					<dl>
					<dt>City</dt>
					
						<dd>
						<?php 
						//echo $property_info->city_name;
						if(!empty($property_info->city_name))
							{
								echo $property_info->city_name;
							}
							else
								echo "Not Provided";
						?>
					</dd>
					</dl>

					<dl>
					<dt>Area</dt>
					
						<dd>
						<?php 
						//echo $property_info->area;
						if(!empty($property_info->area))
							{
								echo $property_info->area;
							}
							else
								echo "Not Provided";
						?>
						</dd>
					</dl>

					<dl>
					<dt>Zip</dt>
					
						<dd>
						<?php //echo $property_info->zip;
							if(!empty($property_info->zip))
							{
								echo $property_info->zip;
							}
							else
								echo "Not Provided";
						?>
						<?php if(!empty($property_info->latitude) & !empty($property_info->longitude))
							{
								$lat =  $property_info->latitude;
								$log = $property_info->longitude;
							}
							?>
					</dd>
					</dl>


					
					</fieldset>
					
					<div id="map-wrapper">
						
					</div>

					<hr>

					<h4>Amenities</h4>
					<div class="amenities-cell equal-heights2">
							<?php
						
						if($amenities_ != "null")
						{
							$common = '';
							$extra = '';
							$feature = '';
							$safety = '';
								

								foreach($amenities_ as $opt) 
								{				
										    if($opt->amenities_type_name == 'COMMON') {											
											$common = 'COMMON';
												//$commm = $opt['amenities_type_name'];
											}
											if($opt->amenities_type_name == 'EXTRA') {											
											$extra = 'EXTRA';
											}
											if($opt->amenities_type_name == 'FEATURE') {											
												$feature = 'FEATURE';
											}
											if($opt->amenities_type_name == 'SAFETY') {											
												$safety = 'SAFETY';
											}

											
								}
							
							
						}
						
						else
						{
							echo "Not Provided";
						}

						
						?>
						<?php
						if($amenities_ != "null")
						{

							echo '<table>';
							echo '<th>';
							echo $common;
							echo '</th>';				
							foreach($amenities_ as $opt) 
							{				
									  
								if($opt->amenities_type_name == 'COMMON') 
								{
									
									echo '<tr>';
									echo '<td>';
									echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$opt->images.'></span>';
									echo '<span>'.$opt->amenities_subtype.'</span>';											
									echo '</td>';
									echo '</tr>';
									
								}
							}
							echo '</table>';
							//echo '<a class="more_common_subtype" href="#">more</a>';
						}

					
						?>
						
						
						<?php
						if($amenities_ != "null")
						{
										

											echo '<table>';
											echo '<th>';
											echo $extra;
											echo '</th>';
						foreach($amenities_ as $option) {
										if($option->amenities_type_name == 'EXTRA') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$opt->images.'></span>';
											echo '<span>'.$opt->amenities_subtype.'</span>';
											echo '</tr>';
											echo '</td>';											
										}
									}
										echo '</table>';
						
						}
					
						?>	
						<?php 
						if($amenities_ != "null")
						{			

											echo '<table>';
											echo '<th>';
											echo $feature;
											echo '</th>';
										foreach($amenities_ as $option) {

										if($option->amenities_type_name == 'FEATURE') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$opt->images.'></span>';
											echo '<span>'.$opt->amenities_subtype.'</span>';
											echo '</tr>';
											echo '</td>';
											
										}
									}
						}
					
						?>
						<?php

						 if($amenities_ != "null")
						
						{			
							
											echo '</table>';
											
											echo '<table>';
											echo '<th>';
											echo $safety;
											echo '</th>';
									foreach($amenities_ as $option) {

										if($option->amenities_type_name == 'SAFETY') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$opt->images.'></span>';
											echo '<span>'.$opt->amenities_subtype.'</span>';
											echo '</tr>';
											echo '</td>';
											
										}
									}
								echo '</table>';
						}
					

						?>
					</div><!-- end amenities-cell -->
				<hr>	

				<fieldset>					
				<h4>Pricing</h4>					 
				
					<dl>
					<dt>Base price (Season 1)</dt>					
					<dd>
					<?php if(!empty($season1_price))
						{																									
							echo '<ul>';																							
							foreach($season1_price as $option) 
							{											
								if($option['master_price_period_id'] == 1)
									
								echo '<li>Weekly  <span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 2)									
								echo '<li>Daily  <span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 3)									
								echo '<li>Monthly  <span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 4)									
								echo '<li>Weekend  <span>Rs '.$option['price'].'</span></li>';
											
							}
							echo '</ul>';
								
						}
						else
								echo "Not Provided";
						?>

						</dd>
					</dl>

					<dl>
					<dt>Season 2</dt>					
					<dd>
					<?php if(!empty($season2_price))
						{		
							echo '<ul>';																							
							foreach($season2_price as $option) 
							{											
								if($option['master_price_period_id'] == 1)
									
								echo '<li>Weekly <span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 2)									
								echo '<li>Daily <span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 3)									
								echo '<li>Monthly<span>Rs '.$option['price'].'</span></li>';
								if($option['master_price_period_id'] == 4)									
								echo '<li>>Weekend<span>Rs '.$option['price'].'</span></li>';
											
							}
							echo '</ul>';
								
						}
						else
								echo "Not Provided";
						?>

						</dd>
					</dl>

					<dl>
					<dt>Season 3</dt>					
					<dd>
					<?php if(!empty($season3_price))
						{																									
							foreach($season3_price as $option) 
							{											
								if($option['master_price_period_id'] == 1)

								echo '<p>Weekly</p><span>Rs '.$option['price'].'<br></span>';

								if($option['master_price_period_id'] == 2)
									
								echo '<p>Daily</p><span>Rs '.$option['price'].'<br></span>';

								if($option['master_price_period_id'] == 3)
									
								echo '<p>Monthly</p><span>Rs '.$option['price'].'<br></span>';
								if($option['master_price_period_id'] == 4)
									
								echo '<p>Weekend</p><span>Rs '.$option['price'].'<br></span>';
											
							}
								
						}
						else
								echo "Not Provided";
						?>

						</dd>
					</dl>

					<dl>
					<dt>Season 4</dt>					
					<dd>
					<?php if(!empty($season4_price))
						{																									
							foreach($season4_price as $option) 
							{											
								if($option['master_price_period_id'] == 1)

								echo '<p>Weekly</p><span>Rs '.$option['price'].'<br></span>';

								if($option['master_price_period_id'] == 2)
									
								echo '<p>Daily</p><span>Rs '.$option['price'].'<br></span>';

								if($option['master_price_period_id'] == 3)
									
								echo '<p>Monthly</p><span>Rs '.$option['price'].'<br></span>';
								if($option['master_price_period_id'] == 4)
									
								echo '<p>Weekend</p><span>Rs '.$option['price'].'<br></span>';
											
							}
								
						}
						else
								echo "Not Provided";
						?>

						</dd>
					</dl>
					<h4>Other Charges</h4>
					<ul>
					<li><p> Cleaning Fee: <?php if(!empty($property_info->clean_charge))
							{
								echo "Rs ".$property_info->clean_charge;
							}
							else echo "Not provided";
								?></p></li>
					<li><p> Security Charge: <?php if(!empty($property_info->security_charge))
							{
								echo "Rs ".$property_info->security_charge;
							}
							else echo "Not provided";
								?> </p></li>
					<li><p> Additional Guest Charge: <?php if(!empty($property_info->guest_charge))
							{
								echo "Rs ".$property_info->guest_charge;

							}
							else echo "Not provided";
								?></li>
					</ul>

					</fieldset>

					<hr>
					<div>
						<h4>Property Photos</h4>
							
						<?php if(!empty($property_imgs))
						{		
							echo '<ul>';																							
							foreach($property_imgs as $option) 
							{											
								echo '<li><img src="'.base_url().'public/uploads/property_image/'.$option['images'].'">  <p><b>Caption: </b>   '.$option['description'].'</li>';	
												
							}
							echo '</ul>';
								
						}
						else
								echo "No photos have been added yet";
						?>	
					</div>					
				<br>
				<hr>
				<!--
				<h4>Property Rooms</h4>
					<?php if(!empty($property_rooms))
						{		
							echo "<br>";
							echo "<b>No of rooms:</b> ".$property_rooms_count;
							echo "<br>";
							echo "<br>";
							echo '<ul>';
							$count = 1;																							
							foreach($property_rooms as $option) 
							{											
								echo "Room ".$count;
								echo '<li><b>Room Name:</b> '.$option->room_name.'</li>';
								echo '<li><b>Room Type:</b> '.$option->roomtype.'</li>';
								echo '<li><b>Guest No:</b> '.$option->guest_no.'</li>';
								echo '<li><b>Room Name:</b> '.$option->room_details.'</li>';
								echo '<li><b>Status:</b> '.$option->status.'</li>';	
								
								echo '<hr>';
								$count++;
												
							}
							echo '</ul>';
								
						}
						else
								echo "No Rooms provided for separate listing";
						?>
				<br>
				<hr>
				-->	
				<h4>User Details</h4>	
				<br>
				<a class="btn btn-success" href="<?php echo base_url().index_page().'admin/user_profile/view_user/'.$user_id;?>"><i class="icon-zoom-in icon-white"></i>Click Here to view the user details</a>
				<br>
				<hr>
				<h4>Select for Activation or Deactivation of property</h4>
				<div class="controls">
							<label class="radio">
								<input type="radio" name="status" id="active" onchange="sendApproval(1);" value="Active" <?php 
								if(!empty($property_info->status))
								{	
								echo ($property_info->status == 'Active') ? 'checked' : ''; }?>>								
								Active
							</label>
							<div style="clear:both"></div>
							<label class="radio">
								<input type="radio" name="status" id="inactive" onchange="sendApproval(2);" value="Inactive" <?php 
								if(!empty($property_info->status))
								{
								echo ($property_info->status == 'Inactive') ? 'checked' : ''; 
								}
								?>>
								Inactive
							</label>
				</div>
				<br>
				<hr>
				<a class="btn btn-success" href="<?php echo base_url().index_page().'admin/property_detail/view_properties';?>"><i class="icon-zoom-in icon-white"></i>Back to Property Management</a>
				<script>
				function sendApproval(x)
				{

					
							
					var url = BASE_URL + "admin/property_detail/updateStatus/"+x+"/"+'<?php echo $property_info->property_id;?>';
					if(x == 1)
					{
						
								$.ajax({
							   type: "GET",
							   url: url,
							   dataType: 'text', 
							   success: function(response) {												
										
							   				alert("Activated the property");
											
										}
								});
							
					
					}	
					if(x == 2)
					{
						
							$.ajax({
						   type: "GET",
						   url: url,
						   dataType: 'text', 
						   success: function(response) {												
									
						   				alert("Deactivated the property");
										
									}
							});
							
					}	
				}
				</script>			
		</div> 
	</div><!--/span-->				
</div><!--/row-->


<?php echo $this->load->view('admin/footer_view');  ?>