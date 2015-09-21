<?php echo $this->load->view('admin/header_view'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">User</a>
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
			<h2>All Users</h2>
			
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
							<th>
			<div class="control-group">
				<label class="control-label" for="selectError" >User Name</label>
				<div class="controls">
					<select id="user_id" data-rel="chosen" onchange="search('user_id')";>
						<option value="">Select Name</option>
						<?php
						foreach($user_list as $rec){
						?>
					<option value="<?php echo $rec->user_id?>" <?php if($user_id == $rec->user_id) echo "selected"?>><?php echo $rec->user_name?> </option>
					<?php } ?>
					</select>
				</div>
				</div>
			</th>
			<th>
			<div class="control-group">
				<label class="control-label" for="selectError">Email Id</label>
				<div class="controls">
					<select id="user_id1" data-rel="chosen" onchange="search('user_id1')";>
					<option value="">Select Email</option>
						<?php
						foreach($user_list as $rec){
						?>
					<option value="<?php echo $rec->user_id?>" <?php if($user_id == $rec->user_id) echo "selected"?>><?php echo $rec->email?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			</th>
					</tr>
					</thead>
					<tbody>		
		</div>
	<div class="box-content">	
			<a href="<?php echo base_url().index_page().'admin/user_profile/manage_user/'?>" title="Click here to add the new user" data-rel="tooltip" class="btn btn-warning"><i class="icon-plus icon-white"></i> Add User</a>
		</div>
		<div class="box-content">					
			<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th>User. No</th>
							<th><a href="<?php echo base_url().index_page().'admin/user_profile/index/user_name/'.$sortOrder?>">Username <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/user_profile/index/email/'.$sortOrder?>">Email-Id <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th>Contact Number</th>
							<th><a href="<?php echo base_url().index_page().'admin/user_profile/index/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
								<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/userProfile_list');?>
				</tbody>					
			 </table>
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
<script type="text/javascript">
	 function search(id)
	 {		

	  var user_id = $("#"+id).val();
		//console.log(user_id);
		window.location = "<?php echo base_url().index_page()?>admin/user_profile/index/<?php echo $orderColumn."/".$sortOrder."/"?>"+user_id;			
  }

	
	 function search_name()
	 {
	  var user_id = $("#user_id").val();
		//console.log(user_id);
			$.post('<?php echo base_url().index_page()?>admin/user_profile/index',
						 {'user_id' : user_id},
						 function(data)
						 {
							//console.log(data);
						 $('#user_content').html(data);
						 	 $('#pagination').hide();	
						 });
			
  }
	
	function search_email()
	 {
	  var user_id = $("#user_id1").val();
		$.post('<?php echo base_url().index_page()?>admin/user_profile/search_email',
						 {'user_id' : user_id},
						 function(data)
						 {
							//console.log(data);
						 $('#user_content').html(data);
						 	 $('#pagination').hide();	
						 });	
  }
	/***
	 * Function to load the popup to update the request
	 **/	
	function update_status(user_id,status)
	{
		$.post('<?php echo base_url().index_page()?>admin/user_profile/load_request_popup',
			{'user_id' : user_id, 'status' : status },
			function(data)
			{
				$('#dynamic_popup').html(data);
				$('#dynamic_popup').modal('show');
			});
	}
	/***
	 * Function to update the status of the user
	 **/
	function change_status()
	{
		var user_id = $('#request_user_id').val();
		var status = $('input:radio[name=status]:checked').val();
		
	  var newStatus = '';
		if (confirm("Are you sure to update the status?")) {
			$.post('<?php echo base_url().index_page()?>admin/user_profile/update_status',
			{'user_id' : user_id, 'status' : status },
			function(data)
			{
			 if(data != 'error')
			 {
				 if (status == 'Inactive') {					
					 ansText = '<span class="label btn btn-danger">Pending</span>';	
				 }
				 else if(status == 'Active') {					 
					 ansText = '<span class="label label-success">Approved</span>';
				 }
				
				 $('#action_message').addClass('alert-success');
				 $('#action_message').show();
				 $('#inner_text_td').html(data);	
				 var innetHtml = '<a href="javascript:void(0)" onclick="update_status('+user_id+','+status+')" ><u>'+ansText+'</u></a>';
					 $('#user_request_'+user_id).html(innetHtml);
					 //hide modal
					 $('#dynamic_popup').html("");
				   $('#dynamic_popup').modal('hide');
			 }
			 else
			 {
				 $('#action_message').removeClass('alert-success');
				 $('#action_message').addClass('alert-error');
				 $('#action_message').show();
				 $('#inner_text_td').html("Something went wrong! Please try again.");	
			 }
			});	
		}
	}
</script>