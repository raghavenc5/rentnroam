<?php
				$offset_i = $offset;
				$baseurl = base_url();
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
					
						<tr id="row_<?php echo $row->room_type_id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center roomtype_id" style="display:none"><?php echo $row->room_type_id; ?></td>							
							<td class=""><?php echo $row->roomtype; ?></td>
							<td class=""><?php echo $row->title; ?></td>
							<td class=""><img src="<?php echo $baseurl.'public/images/room_type/'.$row->images; ?>"></td>
							
				 		 <td><button class='RoomEdit'>Edit</button><tab align=right><button class="RoomDelete">Delete</button></td>
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