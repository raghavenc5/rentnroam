<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->id?>">
							<td class="center"><?php echo $row->id;?></td>		
							<td class=""><?php echo $row->property_id?></td>							
							<td class=""><?php echo $row->user_name?></td>
							<td class=""><?php echo $row->booking_date?></td>
							<td class=""><?php echo $row->booking_to?></td>
							<td class=""><?php echo $row->booking_upto?></td>
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