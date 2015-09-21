<?php echo $this->load->view('admin/header_view'); ?>
<!-- Edit amenites pop up dialog box (RAIKUMAR) -->
<div id="overlayEditPropertytype" tabindex="-1">
     <div>
          <p>Edit Master Property type</p>
          
          <form id="submitEditPropertytype">
			<table>
				<tr><td>Property Type</td><td>
	            <input type="text" name="property_type" id="prop_type">
	            <input type="hidden" name="id" id="prop_id">          
	            </td></tr>
	           	<tr><td>Button type</td><td>
	            <input type="text" id="button_type" name="element_type">            
	            </td></tr>
	            <tr><td>Upload new Icon image</td><td>
	            <input id='editPropImage' name='imageicon' type="file"></td></tr>
	            <tr><td>
	            <tr><td>Current Image</td><td>
	            <img src="" id="imagePropicon"></td></tr>
	            <tr><td>
	            <input type="submit" id="EditProptypeButton" value="Update">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="EditCloseproptype">close</a>
     </div>    
</div>
<!--END  Edit amenities pop up dialog box (RAIKUMAR) -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Master Property type</a>
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
				<li>
				<a href="<?php echo base_url().index_page()?>admin/master_location/indexPropertytype">Property type </a> 
				</li>
								
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
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexPropertytype/property_type/'.$sortOrder?>">Property Type <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
								<th><a href="<?php echo base_url().index_page().'admin/master_location/indexPropertytype/element_type/'.$sortOrder?>">Element Type <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexPropertytype/images/'.$sortOrder?>">Images <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a>

							</th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterPropertytype_list');?>
				</tbody>					
			 </table>
			 <h4>Add Property type</h4>
			 <br>
			 <div id="cityformdiv">
			 	<form id="formPropertytype">
			 		<ul>
			 			<li>    				
							<input type="text" name="property_type" placeholder="Property Type" id="proptype">    
	             		</li>
			 			<li>
			 				<input type="text" name="E_type" placeholder="Element Type" id="Etype_id">
			 			</li>
	            		<li>
	            			<input type="file" name="iconimage" id="image_id">
	            		</li>
			 			</ul>
			 		<input type="submit" id="addProptype" name="submit" value="Submit">
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