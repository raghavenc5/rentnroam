<?php echo $this->load->view('admin/header_view'); ?>
<!-- Edit amenites pop up dialog box (RAIKUMAR) -->
<div id="overlayEditAmenities" tabindex="-1">
     <div>
          <p>Edit Master Amenities type</p>
          
          <form id="submitEditAmenities">
			<table>
	           	<tr><td>Amenities type</td><td>
	            <input type="text" id="editamenities" style="text-transform:uppercase" name="amenitiestype">
	            <input type="hidden" id="editamenitiestype_id" name="amenities_type_id">             
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='editAstatus' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>
	            </td></tr>
	            
	            <tr><td>
	            <input type="submit" id="EditAmenitiesButton" value="Update">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="EditAmenitiestypeClose">close</a>
     </div>    
</div>
<!--END  Edit amenities pop up dialog box (RAIKUMAR) -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Master Amenities type</a>
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
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiestype/amenities_type_name/'.$sortOrder?>">Amenities Type <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexAmenitiestype/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterAmenities_list');?>
				</tbody>					
			 </table>
			 <h4>Add Amenities type</h4>
			 <br>
			 <div id="cityformdiv">
			 	<form id="formAmenitiestype">
			 		<ul>
			 			<li>    				
							<input type="text" name="amenitiestype" style="text-transform:uppercase" id="amenities_type_id" placeholder="Amenities type">  
                        </li>
			 			<li><select id='amenitiestype_status' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            		</li>
			 			</ul>
			 		<input type="submit" id="addAmenitiestype" name="submit" value="Submit">
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