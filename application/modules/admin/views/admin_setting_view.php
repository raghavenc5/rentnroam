<?php echo $this->load->view('admin/header_view'); ?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Edit Admin Setting </h2>
			<div class="box-icon">				
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		
		<div class="box-content">
			<form class="form-horizontal" method="post"
			      action="<?php echo base_url().index_page()?>admin/admin_setting/index" >
				<fieldset>
					<?php
					 $flash_var = $flash_class = '';
					 if($this->session->flashdata('message_data'))
					 {
					  $flash_var  = $this->session->flashdata('message_data');
						$flash_class = 'alert-success';
					 }
					 else if($this->session->flashdata('error_data'))
					 {
						$flash_var  = $this->session->flashdata('error_data');
						$flash_class = 'alert-error';
					 }
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
					 
					<div class="control-group <?php echo (form_error('user_name') != '' ) ? 'error':'';?>"> 
					<label class="control-label" for="focusedInput">Admin Username</label>
					<div class="controls">
					
									<span><h3> <?php echo $user_name?></h3></span>
					</div>
					</div>
					<div class="control-group <?php echo (form_error('email_id') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Email-Id</label>
					<div class="controls">
						<input class="input-xlarge focused" type="text"
									 name="email_id" id="email_id" value="<?php echo $email_id;?>"
									 onclick="remove_error_class('email_id')">
					</div>
					</div>
					
					<div class="control-group">					
					<div>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Leave blank if you dont want to update the password.</b>
					</div>
					</div>
				
					<div class="control-group <?php echo (form_error('new_password') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">New pasword</label>
					<div class="controls">
						<input class="input-xlarge focused" type="password"
									 name="new_password" id="new_password" value=""
									 onclick="remove_error_class('new_password')">
					</div>
					</div>
					<div class="control-group <?php echo (form_error('confirm_password') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Re-enter Password</label>
					<div class="controls">
						<input class="input-xlarge focused" type="password"
									 name="confirm_password" id="confirm_password" value=""
									 onclick="remove_error_class('confirm_password')">
					</div>
					</div>
					<div class="control-group">					
					<div>
						<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						You must submit the current password to update setting information.</b>
					</div>
					</div>
					<div class="control-group <?php echo (form_error('password') != '' ) ? 'error' : '';?>">
					<label class="control-label" for="focusedInput">Current Password</label>
					<div class="controls">
						<input class="input-xlarge focused" type="password"
									 name="password" id="password" value=""
									 onclick="remove_error_class('password')">
					</div>
					</div>
					<div class="form-actions">
						<input type="hidden" name="saveFlag" id="saveFlag" value="1" /> 
						<button type="submit" class="btn btn-primary">Save changes</button>
						<a href="javascript:void(0)" class="btn" onclick="go_to_dashboard();">Cancel</a>
					</div>
				</fieldset>
				</form>					
		</div> 
	</div><!--/span-->				
</div><!--/row-->
<?php echo $this->load->view('admin/footer_view');  ?>
