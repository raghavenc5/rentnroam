<?php echo $this->load->view('admin/header_view'); ?>
<style type="text/css">
dd
{
	margin-bottom: 10px;
	font-size : 15px;
}
</style>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> <?php echo $user_info->user_name;?> </h2>
			<div class="box-icon">				
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		
		<div class="box-content">
			<form class="form-horizontal" method="post"
			      action="" >
				<fieldset>
					 <div class="box-content">
						<dl>
						  <dt>Username</dt>
						  <dd><?php echo $user_info->user_name;?></dd>
							
							<dt>Email-Id</dt>
						  <dd><?php echo $user_info->email;?></dd>
							
							<dt>Status</dt>
						  <dd><?php echo ( $user_info->user_status == 'inactive')? 'Inactive' : 'Active';?></dd>
							
							<dt>Gender</dt>
						  <dd><?php echo $user_info->gender;?></dd>
							<?php
							$user_image_path = base_url().'/public/uploads/user_image/';
							$user_image = $user_info->profile_pic;		
							$profile_image = $user_image_path.$user_image;
							if($profile_image != '') {?>
							<dt>Profile Image</dt>
						  <dd>
							<img width="200" height="200" img src="<?php echo $profile_image;?>"></dd>
						</dl>
						<?php } ?>
						<dt>User Properties</dt>
							<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th class="center">No</th>
							<th class="center">Title</th>
					    <th class="center">Price</th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php
					$offset_i = 0;
					if(!empty($user_property))
				{
					foreach($user_property as $row)
					{
						$offset_i++;
						?>
						<tr>
						<td class="center"><?php echo $offset_i;?></td>	
						<td class="center"><?php echo $row->property_title;?></td>		
						<td class="center"><?php echo $row->price;?></td>	
</tr>						
						<?php
					}
				}
				else
				{
				?>
				<tr>
					<td colspan="7"> No Records found</td>
				</tr>
				<?php
				}
				?>
				</tbody>					
			 </table>
						<dt>User Documents</dt>
						<?php
						if(empty($user_doc))
						{
						?>
						<dd>No Documents Found.</dd>
						<?php
						}
						else
						{
							$doc_name = $user_doc->id_proof;
							$doc_path = base_url().'/public/uploads/user_documents/';
							$doc = $doc_path.$doc_name;
						?>
						<a href="<?php echo $doc; ?>" target="_blank" class="btn" >View</a>
						<a href="<?php echo base_url(); ?>admin/user_profile/download_doc/<?php echo $user_id;?>" class="btn">Download</a>
					
					<?php
						}
						?>
						<div class="form-actions">						
						<a href="javascript:void(0)" class="btn" onclick="window.location='<?php echo base_url().index_page().'admin/user_profile'?>'">Back</a>
					</div>
					</div>					
				</fieldset>
				</form>					
		</div> 
	</div><!--/span-->				
</div><!--/row-->
<script type="text/javascript">
function download_doc(value)
{
	$.post(BASE_URL+'admin/user_profile/download_doc',
  {
  'user_id' : value
  },
	 function(data)
      {
          
      });
}
</script>
<?php echo $this->load->view('admin/footer_view');  ?>
