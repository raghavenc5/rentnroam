<?php echo $this->load->view('admin/header_view'); ?>
<!-- Edit amenites pop up dialog box (RAIKUMAR) -->
<div id="overlayEditASubtype" tabindex="-1">
     <div>
          <p>Edit Master Amenities subtype<</p>
          
          <form id="submitEditASubtype">
			<table>
				<tr><td>Select Type</td><td>
	            <?php
	            	$baseUrl = base_url().'admin/master/getAmenitiesDropdown';                    
                    $jsonData = file_get_contents($baseUrl); 
                    $jsonDataObject = json_decode($jsonData);
                    
                    echo  '<select id="editAtype" name="Atype" >';    
                    foreach($jsonDataObject as $common)
                    {
                        echo  '<option value='.$common->amenities_type_name.'>'.$common->amenities_type_name.'</option>';                                            
                
                    } 
                    echo '</select>'; 
	             ?>            
	            </td></tr>
	           	<tr><td>Amenities Subtype</td><td>
	            <input type="text" id="editAsubtype" style="text-transform:uppercase" name="Asubtype">
	            <input type="hidden" id="editAsubtype_id" name="Asubtype_id">             
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='editASstatus' name='status1'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>
	            <tr><td>
	            <tr><td>Upload new Icon image</td><td>
	            <input id='editASImage' name='imageicon' type="file"></td></tr>
	            <tr><td>
	            <tr><td>Current Image</td><td>
	            <img src="" id="imageASicon"></td></tr>
	            <tr><td>
	            <input type="submit" id="EditAsubtypeButton" value="Update">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="EditAsubtype">close</a>
     </div>    
</div>
<!--END  Edit amenities pop up dialog box (RAIKUMAR) -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Master Amenities Subtype</a>
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
			<div class="box-header well"  data-original-title>
			<div id="headsubmenu">
			<ul>
				<li><a href="<?php echo base_url().index_page()?>admin/master_location/indexAmenitiestype">Amenities type </a> </li>
				<li><a href="<?php echo base_url().index_page()?>admin/master_location/indexAmenitiesSubtype">Amenities Subtype</a></li>				
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
							<th><a href="#">No.</a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiesSubtype/amenities_type/'.$sortOrder?>">Amenities Type <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
								<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiesSubtype/amenities_subtype/'.$sortOrder?>">Amenities Subtype <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiesSubtype/images/'.$sortOrder?>">Images <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiesSubtype/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterAmenitiesSubtype_list');?>
				</tbody>					
			 </table>
			 <h4>Add Amenities subtype</h4>
			 <br>
			 <div id="cityformdiv">
			 	<form id="formAmenitiesSubtype">
			 		<ul>
			 			<li>    				
							<?php
				            	$baseUrl = base_url().'admin/master/getAmenitiesDropdown';                    
			                    $jsonData = file_get_contents($baseUrl); 
			                    $jsonDataObject = json_decode($jsonData);
			                    
			                    echo  '<select id="Atype" name="Atype" >';    
			                    echo '<option value="" selected>Select Amenities type</option>';
			                    foreach($jsonDataObject as $common)
			                    {
			                        echo  '<option value='.$common->amenities_type_id.'>'.$common->amenities_type_name.'</option>';                                            
			                
			                    } 
			                    echo '</select>'; 
				             ?>     
	             		</li>
			 			<li><input type="text" name="Asubtype" style="text-transform:uppercase" placeholder="Amenities Subtype"id="Asubtype_id"></li>
			 			
			 			<li><select id='ASubstatus' name='status1'><option value="">Select Status</option><option value="Active">Active</option><option value="Inactive">Inactive</option></select>
	            		</li>
	            		<li><input type="file" name="Asubtype_icon" id="Asubtypeicon_id"></li>
			 			</ul>
			 		<input type="submit" id="addAmenitiesSubtype" name="submit" value="Submit">
			 	</form>
			 </div>
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