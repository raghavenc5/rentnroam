<?php echo $this->load->view('admin/header_view'); ?>
<!-- Add state pop up dialog box (RAIKUMAR) -->
<div id="overlayState" tabindex="-1">
     <div>
          <p>Insert State</p>
          <p id="dem"></p>
          <form id="submitState">
			<table>
	           	<tr><td>Select Country</td><td>
	              <?php 
                                                            $baseUrl = base_url().'admin/master/getCountrydropdown';                    
                                                            $jsonData = file_get_contents($baseUrl); 
                                                            $jsonDataObject = json_decode($jsonData);
                                                            
                                                            echo  '<select id="country_Sfid" name="country_id" >';    
                                                            foreach($jsonDataObject as $common)
                                                            {
                                                                echo  '<option value='.$common->country_id.'>'.$common->country_name.'</option>';                                            
                                                        
                                                            } 
                                                            echo '</select>';                                      
                                                       
                                                      ?>          
	            </td></tr>
	            <tr><td>State</td><td>
	            <input type="text" name="state" id='state_Sfid' >            
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='status_Sfid' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            </td></tr>
	            <tr><td>
	            <input type="submit" id="StateSubmitButton" value="Send">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="stateClose" >close</a>
     </div>    
</div>
<!--END  Add state pop up dialog box (RAIKUMAR) -->

<!-- Edit state pop up dialog box (RAIKUMAR) -->
<div id="overlayEditState" tabindex="-1">
     <div>
          <p>Insert State</p>
          <p id="dem"></p>
          <form id="submitEditState">
			<table>
	           	<tr><td>Select Country</td><td>
	              <?php 
                                                            $baseUrl = base_url().'admin/master/getCountrydropdown';                    
                                                            $jsonData = file_get_contents($baseUrl); 
                                                            $jsonDataObject = json_decode($jsonData);
                                                            
                                                            echo  '<select id="country_SfEid" name="country" >';    
                                                            foreach($jsonDataObject as $common)
                                                            {
                                                                echo  '<option value='.$common->country_name.'>'.$common->country_name.'</option>';                                            
                                                        
                                                            } 
                                                            echo '</select>';                                      
                                                       
                                                      ?>          
	            </td></tr>
	           <!--
	            <tr><td>Country</td><td>
	            <input type="text" name="country_id" id='country_SfEid' >  
	              -->         
	            </td></tr>
	            
	            <tr><td>State</td><td>
	            <input type="text" name="state" id='state_SfEid' >  
	            <input type="hidden" name="id" id='id_SfEid' >            
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='status_SfEid' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            </td></tr>
	            <tr><td>
	            <input type="submit" id="StateEditButton" value="Send">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="stateEditClose" >close</a>
     </div>    
</div>
<!--END  Edit state pop up dialog box (RAIKUMAR) -->
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
							<th><a href="#">State No.</a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexState/country_name/'.$sortOrder?>">Country <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexState/state_name/'.$sortOrder?>">State <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexState/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterState_list');?>
				</tbody>					
			 </table>
			 <button id="addState">Add State</button>
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