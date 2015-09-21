<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->amenities_id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center amenitiesSubTypeId" style="display:none"><?php echo $row->amenities_id; ?></td>		
							
							<td class=""><?php echo $row->amenities_type; ?></td>				
							<td class=""><?php echo $row->amenities_subtype; ?></td>
							<td class=""><img src="<?php echo base_url().'public/images/amenities/'.$row->images; ?>"></td>
							<td class=""><?php echo $row->status; ?></td>
							
				 		 <td><button class='AmenitiesSubEdit'>Edit</button><tab align=right><button class="AmenitiesSubDelete">Delete</button></td>
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