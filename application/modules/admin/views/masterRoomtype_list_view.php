<?php echo $this->load->view('admin/header_view'); ?>
<!-- Edit country pop up dialog box (RAIKUMAR) -->
<div id="overlayEditRoomtype" tabindex="-1">
     <div>
          <p>Edit Master Room type</p>
          
          <form id="submitEditRoomtype">
			<table>
	           	<tr><td>Room type</td><td>
	            <input type="text" id="editroomtype" name="roomtype">
	            <input type="hidden" id="editroomtype_id" name="room_type_id">             
	            </td></tr>
	            <tr><td>Hover Title</td><td>
	            <input id='editHovertitle' name='title' type="text"></td></tr>
	            <tr><td>
	            <tr><td>Upload new Icon image</td><td>
	            <input id='editImage' name='imageicon' type="file"></td></tr>
	            <tr><td>
	            <tr><td>Privious Image</td><td>
	            <img src="" id="imageRoomicon"></td></tr>
	            <tr><td>
	            <input type="submit" id="EditRoomtypeButton" value="Update">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="EditRoomtype">close</a>
     </div>    
</div>
<!--END  Edit country pop up dialog box (RAIKUMAR) -->
<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?php echo base_url().index_page().'admin/dashboard'?>">Home</a> <span class="divider">/</span>
		</li>
		<li>
			<a href="javascript:void(0)">Master Room</a>
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
			<p>Master room type</p>
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
							<th><a href="#">No of Rooms</a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexRoomtype/roomtype/'.$sortOrder?>">Room Type <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexRoomtype/title/'.$sortOrder?>">Hover Title <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							<th><a href="<?php echo base_url().index_page().'admin/master_location/indexRoomtype/images/'.$sortOrder?>">Image <i class="<?php echo ($sortOrder == 'ASC') ? 'icon-chevron-down' : 'icon-chevron-up'?>"></i></a></th>
							
						<th><a href="#">Actions</a></th>
						</tr>
					</thead>
					<tbody id="user_content">
					<?php echo $this->load->view('admin/masterRoomtype_list');?>
				</tbody>					
			 </table>
			 <h4>Add Room type</h4>
			 <br>
			 <div id="cityformdiv">
			 	<form id="formRoomtype">
			 		<ul>
			 			<li>    				
							<input type="text" name="roomtype" id="roomtype_id" placeholder="Room type">  
                        </li>
			 			<li><input type="text" name="title" id="title_id" placeholder="Hover title"></li>
			 			<li><input type="file" name="userfile" id="roomPic_id" ></li>
			 			</ul>
			 		<input type="submit" id="addRoomtype" name="submit" value="Submit">
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