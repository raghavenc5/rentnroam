<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row" id="msg">
					<a class="google loginSocial" href="<?php echo ($gpAuthUrl) ? $gpAuthUrl : '#'; ?>">
						<i class="fa fa-google-plus"></i>sign up with google
					</a><br/>
					<a class="facebook loginSocial" href="<?php echo ($fbLoginUrl) ? $fbLoginUrl : '#'; ?>">
						<i class="fa fa-facebook"></i>sign up with facebook
					</a>
					<p id="orText"><span>or</span></p>
					<p class="mail"><i class="fa fa-envelope-o"></i> sign up with email</p>
					<form class="form-horizontal">
					    <div class="alert alert-error" id="reg_validation_error" style="display: none">		
								<span id="reg_validation_error_text"></span>   
							</div>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="FIRST NAME" value="" id="first_name" name="first_name"
							aria-describedby="basic-addon2" onclick="remove_error_class('first_name');" onKeyPress="remove_error_class('first_name');">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-user"></i></span>
						</div>
						<div class="input-group mrgntp15">
							<input type="text" class="form-control" placeholder="LAST NAME" value="" id="last_name" name="last_name"
							aria-describedby="basic-addon2" onclick="remove_error_class('last_name');" onKeyPress="remove_error_class('last_name');">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-user"></i></span>
						</div>
						<div class="input-group mrgntp15">
							<input type="text" class="form-control" placeholder="EMAIL ADDRESS" value="" id="reg_email_id" name="reg_email_id"
							aria-describedby="basic-addon2" onclick="remove_error_class('reg_email_id');" onKeyPress="remove_error_class('reg_email_id');">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope-o"></i></span>
						</div>
						<div class="input-group mrgntp15">
							<input type="text" class="form-control" placeholder="MOBILE NO(OPTIONAL)" value="" id="phone_number" name="phone_number"
							aria-describedby="basic-addon2">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-phone"></i></span>
						</div>
						<div class="input-group mrgntp15">
							<input type="password" class="form-control" placeholder="PASSWORD" value="" id="reg_password" name="reg_password"
							aria-describedby="basic-addon2" onclick="remove_error_class('reg_password');" onKeyPress="remove_error_class('reg_password');">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock"></i></span>
						</div>
						<div class="input-group mrgntp15">
							<input type="password" class="form-control" placeholder="CONFIRM PASSWORD" value="" id="confirm_password" name="confirm_password"
							aria-describedby="basic-addon2" onclick="remove_error_class('confirm_password');" onKeyPress="remove_error_class('confirm_password');">
							<span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock"></i></span>
						</div>
						<div class="inputCheck"><input type="checkbox"> Tell me about RNR News</div>
						<button class="logInSubmit" type="button" onclick="sign_up();">Sign up</button>
						<p class="signUpLink">
							By signing up, I agree to RNR's 
							<a href="#">Terms of service</a>,
							<a href="#"> Privacy Policy</a>,
							<a href="#"> Giuest Refund Policy</a>, and
							<a href="#"> Host Gurantee Terms</a>.
						</p>
						<hr/>
						<p class="signUpLink">Already a member?<a href="javascript:void(0)" onclick = "load_login_popup();"> LOGIN</a></p>
					</form>
				</div><!-- /.row -->
			</div>
		</div>
	</div>

<script type="text/javascript">
/***
* Function to register
**/
function sign_up()
{
	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
	var reg_email_id  = $('#reg_email_id').val();
	var reg_password  = $('#reg_password').val();
	var phone_number = $('#phone_number').val();
	var confirm_password = $('#confirm_password').val();
	var error_flag = 0; 
  
	if(first_name == '')
	{
		add_error_class('first_name','Please enter the  <strong>First name </strong>.');
		error_flag = 1; 
	}
	if(last_name == '')
	{
		add_error_class('last_name','Please enter the  <strong>Last name </strong>.');
		error_flag = 1; 
	}
	if(reg_email_id == '')
	{
		add_error_class('reg_email_id','Please enter the  <strong>Email-Id</strong>.');
		error_flag = 1; 
	}
	else if(reg_email_id != '' && validate_email(reg_email_id) == false)
	{
		add_error_class('reg_email_id','Please enter the <strong> valid Email-Id </strong>.');
		error_flag = 1; 
	}

	if(reg_password == '') 
	{
		add_error_class('reg_password','Please enter the  <strong>Password</strong>.');
		error_flag = 1;   
	}
	if(confirm_password == '') 
	{
		add_error_class('confirm_password','Please enter the  <strong>Password</strong>.');
		error_flag = 1;   
	}
	if(reg_password != confirm_password )
	{
		add_error_class('reg_password','Please enter the  <strong>  Password </strong>.');
		add_error_class('confirm_password','Please retype the  <strong> Password </strong>.');
		error_flag = 1;
	}
  
	if(error_flag != 1)
	{
		if ( $("#property_type_id").length && $("#room_type_id").length) {
			var  property_type_id = $("#property_type_id").val();
			var  room_type_id = $("#room_type_id").val();
			var  no_of_rooms = $("#no_of_rooms").val();
			var  accommodates = $("#accommodates").val();
			var  citiesInput = $("#citiesInput").val();
			
			var formData = {
				'first_name':first_name,
				'last_name':last_name,
				'phone_number':phone_number,
				'reg_email_id' : reg_email_id,  
				'password' : reg_password,
				'property_type_id' : property_type_id,
				'room_type_id' : room_type_id,
				'no_of_rooms' : no_of_rooms,
				'accommodates' : accommodates,
				'citiesInput' : citiesInput
			};
		}
		else
		{
			var formData = {
				'first_name':first_name,
				'last_name':last_name,
				'phone_number':phone_number,
				'reg_email_id' : reg_email_id,  
				'password' : reg_password
			};
		}
		
		$.post(BASE_URL+'host/signupUser',
			formData,
			function(data)
			{
				if ("500" == data.status) {
					$('#reg_validation_error_text').html("<span class='help-block'>" + data.message + "</span>");
					$('#reg_validation_error').show();
				} else if ("200" == data.status) {
					$('#reg_validation_error').hide();
					$("#msg").css('color','#fff');
					$("#msg").html('Thank you for registration with us. Please check your email.');
				} else {
					//
				}
			},
			"json"
		);		
		
	}
}
</script>