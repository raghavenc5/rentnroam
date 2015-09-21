<?php echo $this->load->view('admin/header_view'); ?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> <?php echo ($user_id == '') ? 'Add' : 'Edit'?> User Profile </h2>
			<div class="box-icon">				
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>				
			</div>
		</div>
		
		<div class="box-content">
			<form class="form-horizontal" method="post" enctype="multipart/form-data" 
			      action="<?php echo base_url().index_page()?>admin/user_profile/manage_user/<?php echo $user_id?>" >
				
					<?php
					 $flash_var = $flash_class = '';
					 if($this->session->flashdata('message_data'))
					 {
					  $flash_var  = $this->session->flashdata('message_data');
						$flash_class = 'alert-success';
					 }
					// else if($error != '')
					// {
					//	$flash_var  = $error;
					//	$flash_class = 'alert-error';
					// }
					 else if(validation_errors())
					 {
						$flash_var = validation_errors();
						$flash_class = 'alert-error';
					 }
					 //Show 
					 if($flash_var != '' && $flash_class != '')
				   {?>
						<div class="alert <?php echo $flash_class;?>">
								<button type="button" class="close" data-dismiss="alert">x</button>
								 <?php echo $flash_var;?>
						</div>
					 <?php
					 }					
					 ?>
					 
					<div class="control-group <?php echo (form_error('first_name') != '' ) ? 'error':'';?>"> 
					<label class="control-label" for="focusedInput">First Name</label>
						<div class="controls">
							<input class="input-xlarge focused" type="text"
										 name="first_name" id="first_name" value="<?php echo $first_name?>"
										 onclick="remove_error_class('first_name')">
						</div>
					</div>
					
					<div class="control-group <?php echo (form_error('last_name') != '' ) ? 'error':'';?>"> 
					<label class="control-label" for="focusedInput">Last Name</label>
						<div class="controls">
							<input class="input-xlarge focused" type="text"
										 name="last_name" id="last_name" value="<?php echo $last_name?>"
										 onclick="remove_error_class('last_name')">
						</div>
					</div>
					
					<div class="control-group <?php echo (form_error('email') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Email-Id</label>
					<div class="controls">
						<input class="input-xlarge focused" type="text"
									 name="email" id="email" value="<?php echo $email;?>"
									 onclick="remove_error_class('email_id')">
					</div>
					</div>
					
						<div class="control-group <?php echo (form_error('contact_number') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Contact Number</label>
					<div class="controls">
						<input class="input-xlarge focused" type="text"
									 name="contact_number" id="contact_number" value="<?php echo $contact_number;?>"
									 onclick="remove_error_class('contact_number')">
					</div>
					</div>
					
				<div class="control-group <?php echo (form_error('gender') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Gender</label>
					
						<div class="controls">
							<label class="radio">
								<input type="radio" name="gender" id="male" value="Male" <?php echo ($gender == 'male') ? 'checked' : '';?>>								
								Male
							</label>
							<div style="clear:both"></div>
							<label class="radio">
								<input type="radio" name="gender" id="female" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?>>
								Female
							</label>
						</div>
						
							<div class="control-group <?php echo (form_error('status') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Status</label>
					
						<div class="controls">
							<label class="radio">
								<input type="radio" name="status" id="active" value="Active" <?php echo ($status == 'Active') ? 'checked' : '';?>>								
								Active
							</label>
							<div style="clear:both"></div>
							<label class="radio">
								<input type="radio" name="status" id="inactive" value="Inactive" <?php echo ($status == 'Inactive') ? 'checked' : ''; ?>>
								Inactive
							</label>
						</div>	
					<div class="control-group <?php echo (form_error('profile_thumb') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Profile Thumb</label>
					<div class="controls">
						 <input class="input-file uniform_on" id="profile_thumb" name="profile_thumb" type="file">
							<input type="hidden" id="profile_img_hidden" name="profile_img_hidden" value="" />
							
					</div>
					</div>
				
				<div class="form-actions">
					<input type="hidden" name="saveFlag" id="saveFlag" value="1" /> 
					<button type="submit" class="btn btn-primary">Save</button>
					<a href="javascript:void(0)" class="btn" onclick="window.location='<?php echo base_url().index_page().'admin/user_profile'?>'">Cancel</a>
				</div>
				
				</form>					
		</div> 
	</div><!--/span-->				
</div><!--/row-->
<?php echo $this->load->view('admin/footer_view');  ?>