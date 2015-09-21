<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->property_type_id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center propTypeId" style="display:none"><?php echo $row->property_type_id; ?></td>		
							
							<td class=""><?php echo $row->property_type; ?></td>				
							<td class=""><?php echo $row->element_type; ?></td>
							<td class=""><img src="<?php echo base_url().'public/images/property_type/'.$row->images; ?>"></td>
							
				 		 <td><button class='PropertytypeEdit'>Edit</button><tab align=right><button class="proptypeDelete">Delete</button></td>
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