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
							<td	class="center policyId" style="display:none"><?php echo $row->id; ?></td>		
							
							<td class=""><?php echo $row->policy; ?></td>				
							
				 		 <td><button class='policyEdit'>Edit</button><tab align=right><button class="policyDelete">Delete</button></td>
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