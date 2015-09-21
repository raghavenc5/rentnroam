<?php echo $this->load->view('admin/header_view'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Property</a>
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
			<h2>Properties</h2>
			
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
							<th><a href="<?php echo base_url().index_page().'admin/property_detail/view_properties/property_id/'.$sortOrder?>">Property No <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/property_detail/view_properties/property_title/'.$sortOrder?>">Property title <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th>Country</th>
							<th>City</th>
							<th>Username</th>
							<th><a href="<?php echo base_url().index_page().'admin/property_detail/view_properties/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a>
							</th>
							<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/property_list');?>
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
	function update_status(property_id,status)
	{
		$.post('<?php echo base_url().index_page()?>admin/property_detail/load_request_popup',
			{'property_id' : property_id, 'status' : status },
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
		var property_id = $('#request_property_id').val();
		var status = $('input:radio[name=status]:checked').val();
		
	  var newStatus = '';
		if (confirm("Are you sure to update the status?")) {
			$.post('<?php echo base_url().index_page()?>admin/property_detail/update_status',
			{'property_id' : property_id, 'status' : status },
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
				 var innetHtml = '<a href="javascript:void(0)" onclick="update_status('+property_id+','+status+')" ><u>'+ansText+'</u></a>';
					 $('#property_request_'+property_id).html(innetHtml);
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