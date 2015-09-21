<!DOCTYPE html>
<html>
<head>
<title>Master Location</title>
</head>
<body>

<h1>Insert Country, State and City</h1>
		<form method="POST" action="<?php base_url()?>admin/insertLocation">
		Country:<br>
		<input type="text" name="country">
		<br>
		State:<br>
		<input type="text" name="state">
		<br>
		City:<br>
		<input type="text" name="city">
		<br>
		Status:<br>
		<select name="status">
			<option value="Active">Active</option>
			<option value="Inactive">Inactive</option>
		</select>
		<br>
		<input type="submit" value="Submit">
		</form>

<h3>Master Location</h3>
	
	 
	
		<?php 
		echo "<table style='width:100%'>";
		echo "<tr>";
	    echo "<th>Country</th>";
	    echo "<th>State</th>";		
	    echo "<th>City</th>";
	    echo "<th>Status</th>";
	    echo "<th>Edit</th>";
	    echo "<th>Remove</th>";
	    echo "</tr>";
		 // Base URL for the service
		$baseUrl = base_url().'admin/getLocation';                    
		$jsonData = file_get_contents($baseUrl); 
		$jsonDataObject = json_decode($jsonData);
		foreach($jsonDataObject as $Location)
		{
			echo '<tr>';
		    echo '<td>'.$Location->country_name.'</td>';	
		    echo '<td>'.$Location->state_name.'</td>';
		    echo '<td>'.$Location->city_name.'</td>';
		    echo '<td>'.$Location->status.'</td>';
		    echo '<td><a href="#">Edit</a><p hidden>'.$Location->id.'</p></td>';
		    echo '<td><a href="#">Remove</a><p hidden>'.$Location->id.'</p></td>';					    
		    echo '</tr>';
		}
		echo "</table>";
		?>


</body>
</html>