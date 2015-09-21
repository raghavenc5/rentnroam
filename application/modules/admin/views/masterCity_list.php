<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center cityDeleteId" style="display:none"><?php echo $row->id; ?></td>							
							<td class=""><?php echo $row->country_name; ?></td>
							<td class=""><?php echo $row->state_name; ?></td>
							<td class=""><?php echo $row->city_name; ?></td>
							<td class=""><?php echo $row->status; ?></td>
				 		 <td><button class='CityEdit'>Edit</button><tab align=right><button class="CityDelete">Delete</button></td>
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