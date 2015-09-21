<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>CI CRUD</title>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
 <script>
        var base_url = '<?php echo base_url(); ?>';
        </script>

<script type="text/javascript">

function show_confirm(act,gotoid)

{

if(act=="editLocationId")

var r=confirm("Do you really want to edit?");

else

var r=confirm("Do you really want to delete?");

if (r==true)

{

window.location="<?php echo base_url();?>admin/"+act+"/"+gotoid;

}

}

</script>

<script type="text/javascript">

function deleteCountry(id)

{

var r=confirm("Do you really want to delete?");
if (r==true)
{
var url1 ='<?php echo base_url();?>';
//window.location="<?php echo base_url();?>admin/"+act+"/"+gotoid;
$.ajax({
					   type: "POST",
					   url: url1+'admin/deleteCountry/'+id,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								console.log(obj.message);
							}
							if(obj.status === 200)
							{
								console.log(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
					   	
						   alert("You cant delete row, Remove the child row first.");
					   }
					 });
}

}

</script>
<script type="text/javascript">
	
	function editCountry(countrylod, id1)
	{
		var url1 = base_url+"admin/editCountry";
		var country1=prompt("Edit Country:-", countrylod);
				if(country1 != null)
				{
	
				$.ajax({
					   type: "POST",
					   url: url1+'/'+country1+'/'+id1,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								alert(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
						   alert(response);
					   }
					 });

				return false;
			}
			
	}
</script>
<style>
#overlay {
     visibility: hidden;
     position: absolute;
     left: 0px;
     top: 0px;
     width:100%;
     height:100%;
     text-align:center;
     z-index: 1000;
}

#overlay div {
     width:300px;
     margin: 100px auto;
     background-color: #819FF7;
     border:1px solid #000;
     padding:15px;
     text-align:center;
}
</style>
</head>

<body>

<h2> Master Location </h2>
<hr>
<h4>Master Country Table<h4>
<table width="600" border="1" cellpadding="5">

<tr>

<th scope="col">Id</th>

<th scope="col">Country</th>

<th scope="col" colspan="2">Action</th>

</tr>

<?php foreach ($Country_list as $u_key){ ?>

<tr>

<td><?php echo $u_key->country_id; ?></td>

<td><?php echo $u_key->country_name; ?></td>

<td width="40" align="left" ><a href="#" onClick="editCountry('<?php echo $u_key->country_name;?>',<?php echo $u_key->country_id;?>)">Edit</a></td>

<td width="40" align="left" ><a href="#" onClick="deleteCountry(<?php echo $u_key->country_id;?>)">Delete </a></td>

</tr>

<?php }?>

<tr>

<td colspan="7" align="right"> <button id="button1">Insert Country</button></td>
<script>

		//e.preventDefault();
				//var base_url = window.location.origin;
				var url = base_url+"admin/insertCountry";
				$("#button1").click(function(e) {
				var country=prompt("Insert Country:-");
				if(country != null)
				{
	
				$.ajax({
					   type: "POST",
					   url: url+'/'+country,
					   dataType: 'text',
					   success: function(response) {
							var obj = JSON.parse(response);
							if(obj.status === 400)
							{
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								alert(obj.message);
								window.location.reload(true);
								
							}
							//alert(response);
					   },
					   error: function(response) {
						   alert(response);
					   }
					 });

				return false;
			}
			});
	

</script>
</tr>

</table>

<br>
<hr>
<h4>Master State Table<h4>
<table width="600" border="1" cellpadding="5">

<tr>

<th scope="col">Id</th>

<th scope="col">Country</th>

<th scope="col">State</th>

<th scope="col" colspan="2">Action</th>

</tr>

<?php foreach ($CountryState_list as $u_key){ ?>

<tr>

<td><?php echo $u_key->id; ?></td>

<td><?php echo $u_key->country_name; ?></td>
<td><?php echo $u_key->state_name; ?></td>

<td width="40" align="left" ><a href="#" onClick="editCountry('<?php echo $u_key->country_name;?>',<?php echo $u_key->country_id;?>)">Edit</a></td>

<td width="40" align="left" ><a href="#" onClick="show_confirm_country('deleteCountry',<?php echo $u_key->country_id;?>)">Delete </a></td>

</tr>

<?php }?>

<tr>

<td colspan="7" align="right"> <button onclick='overlay()'>Insert State</button></td>

</tr>

</table>
<script type="text/javascript">
function overlay() {
	el = document.getElementById("overlay");
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
	 $('#overlay').focus();
}
</script>
<div id="overlay" tabindex="-1">
     <div>
          <p>Insert State.</p>
          
          <form id="submitState">
			  <table>
             <tr><td>Select Country</td><td>   <?php 
                		$base_url = base_url();
                        $baseUrl = $base_url.'admin/getCountrydropdown';                    
                        $jsonData = file_get_contents($baseUrl); 
                        $jsonDataObject = json_decode($jsonData);
                        
                        echo  '<select id="country_dropdown1" name="country_id">';    
                        foreach($jsonDataObject as $common)
                        {
                            echo  '<option value='.$common->country_id.'>'.$common->country_name.'</option>';                                            
                    
                        } 
                        echo '</select>';                                      
                   
                  ?>  
           
           	</td></tr>
           	<tr><td>Insert State</td><td>
            <input type="text" id="state_dropdown1" name="state">            
            </td></tr>
            <tr><td>
            <input type="submit" id="insertState" value="Send">
           </td></tr>
           </table>
          </form>
          <script type="text/javascript">
          	$("#insertState").click(function(){
			        var country, state;
			        
			        country = document.getElementById("country_dropdown1").value;
			        state = document.getElementById("state_dropdown1").value;
			       
			        // If x is Not a Number or less than one or greater than 10
			        if (country === null) {
			           
			            alert("Please select Country");
			            return false;
			        } 
			        else if(state === null)
			        {
			            
			            alert("Please fill up State");
			            return false;
			        }
			      
			     
			        else 
			        {

						$("#submitState").submit(function(e) { 
							//e.preventDefault();
							//var base_url = window.location.origin;
							var baseurl="<?php echo base_url()?>";
							var url = baseurl+"admin/insertCountrystate";
							$.ajax({
								   type: "POST",
								   url: url,
								   contentType: 'application/x-www-form-urlencoded',
								   data: $("#submitState").serialize(),
								   success: function(data) {
										var obj = JSON.parse(data);
										if(obj.status === 400)
										{
											alert(obj.message);
										}
										if(obj.status === 200)
										{
											alert(obj.message);
											el = document.getElementById("overlay");
											el.style.visibility ="hidden";
											window.location.reload(true);

										}
										//alert(data);
								   },
								   error: function(data) {
									   alert(data);
								   }
								 });

							return false;
						});
			          //loadTab("Photo");
			        }
				});
          </script>
          
          Click here to [<a href='#' onclick='overlay()'>close</a>]
     </div>

</div>
<br>
<hr>

<br>
<h4> Master City table </h4>
<table width="600" border="1" cellpadding="5">

<tr>

<th scope="col">Id</th>

<th scope="col">Country</th>

<th scope="col">State</th>

<th scope="col">City</th>

<th scope="col">Status</th>



<th scope="col" colspan="2">Action</th>

</tr>

<?php foreach ($location_list as $u_key){ ?>

<tr>

<td><?php echo $u_key->id; ?></td>

<td><?php echo $u_key->country_name; ?></td>

<td><?php echo $u_key->state_name; ?></td>

<td><?php echo $u_key->city_name; ?></td>

<td><?php echo $u_key->status; ?></td>

<td width="40" align="left" ><a href="#" onClick="show_confirm('editLocationId',<?php echo $u_key->id;?>)">Edit</a></td>

<td width="40" align="left" ><a href="#" onClick="show_confirm('deleteLocation',<?php echo $u_key->id;?>)">Delete </a></td>

</tr>

<?php }?>

<tr>

<td colspan="7" align="right"> <a href="<?php echo base_url();?>admin/addLocation">Insert New City</a></td>

</tr>

</table>
 
</body>

</html>
