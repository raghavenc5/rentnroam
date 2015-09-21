<?php echo $this->load->view('admin/header_view'); ?>

<!-- Edit state pop up dialog box (RAIKUMAR) -->
<div id="overlayEditCity" tabindex="-1">
     <div>
          <p>Edit City</p>
          <p id="dem"></p>
          <form id="submitEditCity">
			<table>
	           	<tr><td>Country</td><td>
	                   <input type="text" name="country" id="countryID_city" disabled>
	            </td></tr>
	            
	            <tr><td>State</td><td>
	           <!-- <select id="stateID_city" name="state_id"><option  selected>Select State</option></select>-->
	           		<input type="text" name="state" id="stateID_city" disabled>
	           	</td></tr>
	           <!--
	            <tr><td>Country</td><td>
	            <input type="text" name="country_id" id='country_SfEid' >  
	              -->         
	            </td></tr>
	            
	            <tr><td>City</td><td>
	            <input type="text" name="city" id='cityID_city' >  
	            <input type="hidden" name="id" id='cityID_c' >            
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='status_city' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            </td></tr>
	            <tr><td>
	            <input type="submit" id="CityEditButton" value="Update">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="cityEditClose" >close</a>
     </div>    
</div>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Master Location</a>
		</li>
	</ul>
</div>
    <div class="alert" id="action_message" style="display: none">
				<button type="button" class="close" data-dismiss="alert">x</button>
				 <span id="inner_text_td"></span>
		</div>
		
		<?php
		if($this->session->flashdata('message_data')!= '')
		{?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">x</button>
				 <?php echo $this->session->flashdata('message_data');?>
		  </div>
		<?php
		}?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<div id="headsubmenu">
			<ul>
				<li><a href="<?php echo base_url().index_page()?>admin/master_location/indexCountry">Country Master </a> </li>
				<li><a href="<?php echo base_url().index_page()?>admin/master_location/indexState">State Master</a></li>
				<li><a href="<?php echo base_url().index_page()?>admin/master_location/indexCity">City Master </a></li>
				
			</ul>
			</div>
			
			<div class="box-icon">
				<!--<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>-->
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<!--<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
			</div>
		</div>
		
		<div class="box-content">					
			<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><a href="#">City No.</a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCity/country_name/'.$sortOrder?>">Country <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCity/state_name/'.$sortOrder?>">State <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCity/city_name/'.$sortOrder?>">City <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCity/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterCity_list');?>
				</tbody>					
			 </table>
			 <h4>Add City</h4>
			 <br>
			 <div id="cityformdiv">
			 	<form id="formCity">
			 		<ul>
			 			<li>    				
								<?php 				
                                    $baseUrl = base_url().'admin/master/getCountrydropdown';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    
                                    echo  '<select id="country_cityID" onchange="myFunction()" name="country_id" >';
                                    echo  '<option value="-1" selected>Select Country</option>';    
                                    foreach($jsonDataObject as $common)
                                    {
                                        echo  '<option value='.$common->country_id.'>'.$common->country_name.'</option>';                                            
                                
                                    } 

                                    echo '</select>';                                      
                               
                              ?>  
                        </li>
			 			<li><select id="state_cityID" name="state_id"><option value="-1" selected>Select State</option></select></li>
			 			<li><input type="text" name="city" id="cityID" placeholder="City"></li>
			 			<li><select id="statusID" name="status" ><option value="-1" selected>Select Status</option><option value="Active">Active</option><option value="Inactive">Inactive</option></select></li>
			 		</ul>
			 		<input type="submit" id="addCity" name="submit" value="Submit">
			 	</form>
			 </div>
			 	<script>
							function myFunction() {
							    var x = document.getElementById("country_cityID").value;
							    var url = BASE_URL+"admin/master/getStatebyCid/"+x;
								$.ajax({
									   type: "GET",
									   url: url,
									   dataType: 'text',
									   success: function(response) {
											
											
											$("#state_cityID").empty();
											//console.log(x.length);
											if(!$.trim(response))
											{
												alert("there is no state, please add state");
											}
											else
											{	
												
												var x = response;
												x = jQuery.parseJSON(x);
											
												var html_code = "";
												console.log(x);
												for(var i = 0; i < x.length ; i++) {
													/*var obj = x[i].state_name;*/
													console.log(x[i]);
													//alert(obj)
													html_code = html_code + "<option value='"+x[i].id+"'>"+x[i].state_name+"</option>";
												}
												
												$("#state_cityID").append(html_code);
											}
									   },
									   error: function(response) {
									   	
										   alert("error....");
									   }
									 });	
							}
				</script>
		<div class="box-content">
			<?php if($total_rows > $per_page) { ?>
			<div class="span12">
				<div class="dataTables_info" id="DataTables_Table_0_info">
					Showing <?php echo ($offset+1).' to '.( $offset + $per_page).' of '.$total_rows?> entries
				</div>
			</div>
			<?php } ?>
			<div class="span12 center">
				<div class="pagination pagination-centered" id="pagination">
				 <?php echo $links;?>
				</div>
			</div>
		</div>

		</div>
		
	</div><!--/span-->
</div><!--/row-->

<?php echo $this->load->view('admin/footer_view');  ?>