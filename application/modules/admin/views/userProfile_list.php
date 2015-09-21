<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->user_id?>">
							<td class="center"><?php echo $offset_i;?></td>								
							<td class=""><?php echo $row->user_name?></td>
							<td class=""><?php echo $row->email?></td>
							<td class=""><?php echo $row->user_emergency_contact_no?></td>
							<td class="" id="user_request_<?php echo $row->user_id?>">
								<a href="javascript:void(0)" onclick="update_status('<?php echo $row->user_id?>','<?php echo $row->status?>')">
								<?php if($row->status == 'Inactive' ) { echo '<span class="label btn btn-danger">Pending</span>'; }
								      elseif($row->status == 'Active' ) { echo '<span class="label label-success">Approved</span>'; }			
								?>
							</a>
							</td>
				 		 <td class="">	 
						 <a class="btn btn-success" href="<?php echo base_url().index_page().'admin/user_profile/view_user/'.$row->user_id;?>"><i class="icon-zoom-in icon-white"></i>View</a>
					 <a class="btn btn-success" href="<?php echo base_url().index_page().'admin/user_profile/manage_user/'.$row->user_id;?>"><i class="icon-zoom-in icon-white"></i>Edit</a>
			
					</td>
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