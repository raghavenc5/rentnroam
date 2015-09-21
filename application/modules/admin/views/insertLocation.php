<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Insert Location</title>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>public/js/master_location.js"></script>

</head>

<body>

<form method="post" id="formSubmit">

<table width="400" border="0" cellpadding="5">

<tr>

<th width="213" align="right" scope="row">Enter Country</th>

<td width="161"><!--<input type="text" id="country" name="country" size="20" />-->
<select name="country" id="country-list" class="demoInputBox" onchange="selectState(this.options[this.selectedIndex].value)" >
                                                       <option value="-1">Select country</option>
                                                                                <?php
                                                                                foreach($list->result() as $listElement){
                                                                                    ?>
                                                                                    <option value="<?php echo $listElement->country_id?>"><?php echo $listElement->country_name?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                            
                                                    </select>

</td>

</tr>

<tr>

<th align="right" scope="row">Enter State</th>

<td><!--<input type="text" name="state" id="state" size="20" />-->
<select name="state" id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)" class="form-control">
                                                       <option value="-1">Select state</option>
                                                    </select>
</td>

</tr>

<tr>

<th align="right" scope="row">Enter City</th>

<td><input type="text" name="city" id="city" size="20" />
                                                    </td>

</tr>

<tr>

<th align="right" scope="row">Status</th>

<td><select name="status" rows="5" cols="20"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></td>

</tr>

<tr>

<th align="right" scope="row">&nbsp;</th>

<td><input type="submit" id="save" name="submit" value="Send" /></td>

</tr>

</table>

</form>
<script>

	$("#save").click(function(){
        var country, state, city;
        
        country = document.getElementById("country-list").value;
        state = document.getElementById("state_dropdown").value;
        city = document.getElementById("city").value;
        // If x is Not a Number or less than one or greater than 10
        if (country === -1) {
           
            alert("Please fill up Country");
            return false;
        } 
        else if(state === -1)
        {
            
            alert("Please fill up State");
            return false;
        }
        else if(city === "")
        {
           alert("Please fill up City");
            return false;
        }
     
        else 
        {

			$("#formSubmit").submit(function(e) { 
				e.preventDefault();
				//var base_url = window.location.origin;
				var baseurl="<?php echo base_url()?>";
				var url = baseurl+"admin/insertNewlocation";
				$.ajax({
					   type: "POST",
					   url: url,
					   contentType: 'application/x-www-form-urlencoded',
					   data: $("#formSubmit").serialize(),
					   success: function(data) {
							var obj = JSON.parse(data);
							if(obj.status === 400)
							{
								alert(obj.message);
							}
							if(obj.status === 200)
							{
								window.location="<?php echo base_url();?>admin/showLocation";
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
</body>

</html>
