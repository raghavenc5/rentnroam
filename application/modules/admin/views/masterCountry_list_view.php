<?php echo $this->load->view('admin/header_view'); ?>
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
			<div class="box-header well"  data-original-title>
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
							<th><a href="#">Country No</a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCountry/country_name/'.$sortOrder?>">Country <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexCountry/status/'.$sortOrder?>">Status <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterCountry_list');?>
				</tbody>					
			 </table>
			 <button id="addCountry">Add Country</button>
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