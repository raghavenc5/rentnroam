<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->country_id?>">
							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center countryId" style="display:none"><?php echo $row->country_id?></td>							
							<td class=""><?php echo $row->country_name?></td>
							<td class=""><?php echo $row->status?></td>
				 		 <td><button class="countryEdit">Edit</button><button class="countryDelete">Delete</button></td>
					</tr>
				  <?php
					}
				}
				else
				{
				?>
				<tr>
		class="countryEdit"ecords found</td>
				</tr>
				<?php
				}
				?>