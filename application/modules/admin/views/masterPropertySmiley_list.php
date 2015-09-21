<?php
				$offset_i = $offset;
				
				if(!empty($query))
				{
					foreach($query as $row)
					{
						$offset_i++;
						?>
						<tr id="row_<?php echo $row->smiley_id?>">

							<td class=""><?php echo $offset_i;?></td> 
							<td	class="center smileyId" style="display:none"><?php echo $row->smiley_id; ?></td>									
							<td class=""><img src="<?php echo base_url()."public/images/emoticons/".$row->smiley_icon;?>"></td>				
							
				 		 <td><button class='PropertySmileyEdit'>Edit</button><tab align=right><button class="smileyDelete">Delete</button></td>
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