<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>CI Insert Form</title>

</head>

<body>
<?php
foreach($location as $data)
{


?>
<form method="post" action="<?php echo base_url();?>admin/updateLocation">

<table width="400" border="0" cellpadding="5">

<tr>

<th width="213" align="right" scope="row">Enter Country</th>

<td width="161"><input type="text" name="country" size="20" value="<?php echo $data->country_name; ?>" disabled>
<input type="hidden" name="country_id" size="20" value="<?php echo $data->country_id;?>">
</td>

</tr>

<tr>

<th align="right" scope="row">Enter State</th>

<td> <input type="text" name="state" size="20" value="<?php echo $data->state_name; ?>" disabled>
<input type="hidden" name="state_id" size="20" value="<?php echo $data->state_id; ?>"></td>

</tr>

<tr>

<th align="right" scope="row">Enter City</th>

<td><input type="text" name="city" size="20" value="<?php echo $data->city_name; ?>" /></td>

</tr>

<tr>

<th align="right" scope="row">Enter Status</th>

<td><select name="status" onchange='CheckStatus(this.value);'><option  value="Inactive">Inactive</option><option value="Active">Active</option></select><input type="text" name="status" value="<?php echo $data->status; ?>" id="status"/></td>
<script> 
			function CheckStatus(val){
			 var element=document.getElementById('status');
			 if(val=='Inactive'){
			 	// element.style.display='Inactive';
			   document.getElementById('status').value='Inactive';
			   document.getElementById('status').show='Inactive';
			 }
			  
			 else 
			 {
			 	document.getElementById('status').value='Active';
			   document.getElementById('status').show='Active';
			 } 
			   
			}
</script>     
</tr>

<tr>

<th align="right" scope="row">&nbsp;</th>

<td>
<input type="hidden" name="id" value="<?php echo $data->id; ?>" />
<?php 
}?>
<input type="submit" name="submit" value="Update" /></td>

</tr>

</table>

</form>

</body>

</html>