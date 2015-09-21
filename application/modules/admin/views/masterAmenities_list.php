<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->amenities_type_id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center amenitiesTypeId" style="display:none"><?php echo $row->amenities_type_id; ?></td>							
							<td class=""><?php echo $row->amenities_type_name; ?></td>
							<td class=""><?php echo $row->status; ?></td>
							
				 		 <td><button class='AmenitiesEdit'>Edit</button><tab align=right><button class="AmenitiesDelete">Delete</button></td>
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