<style>
    .help-block {
        color: #EA1B64 !important;
        font-weight: bold !important;
    }
</style>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <a class="google loginSocial" href="<?php echo ($gpAuthUrl) ? $gpAuthUrl : '#'; ?>">
                    <i class="fa fa-google-plus"></i>sign up with google
                </a><br/>
                <a class="facebook loginSocial" href="<?php echo ($fbLoginUrl) ? $fbLoginUrl : '#'; ?>">
                    <i class="fa fa-facebook"></i>sign up with facebook
                </a>
                <p id="orText"><span>or</span></p>
                <p class="mail"><i class="fa fa-envelope-o"></i> login with email</p>
                <form class="form-horizontal">
                    <div class="alert alert-error" id="validation_error" style="display: none">						
                        <span id="validation_error_text"></span>
                    </div>
                    <div class="input-group">
                        <input type="text" id="email_id" name="email_id" class="form-control" placeholder="EMAIL ID" value=""
                        aria-describedby="basic-addon2" onclick="remove_error_class('email_id');" onKeyPress="remove_error_class('email_id');" >
                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-envelope-o"></i></span>
                    </div>
                    <div class="input-group mrgntp15">
                        <input type="password" id="password" name = "password" class="form-control" placeholder="PASSWORD" value=""
                        aria-describedby="basic-addon2" onclick="remove_error_class('password');" onKeyPress="remove_error_class('password');">
                        <span class="input-group-addon" id="basic-addon2"><i class="fa fa-lock"></i></span>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox"> Remember me
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="pull-right">Forgot Password</a>
                    </div>
                    <button class="logInSubmit" type="button" onclick = "check_login();">Login</button>
                    <p class="signUpLink">Not a member?<a href="javascript:void(0)" onclick = "load_registration_popup();"> SIGN UP</a></p>
                </form>
            </div><!-- /.row -->
        </div>
    </div>
</div>

<script type="text/javascript">
/****
* Function to check the login creds
**/
function check_login()
{  
	var email_id = $('#email_id').val();
	var password = $('#password').val();
	var error_flag = 0; 
	//Check the validation
	if (email_id == '')
	{
		add_error_class('email_id','Please enter the <strong>Email-Id</strong>.');
		error_flag = 1; 
	}
	else if(email_id != '' && validate_email(email_id) == false)
	{
		add_error_class('email_id','Please enter the valid <strong>Email-Id</strong>.');
		error_flag = 1; 
	}
	if (password == '')
	{
		add_error_class('password','Please enter the <strong>Password</strong>.');
		error_flag = 1; 
	}
 
	if(error_flag != 1) 
	{
		$.post(BASE_URL+'host/doLogin',
		{
			'email_id' : email_id,
			'password' : password
		},
		function(data)
		{
			error_msg = '';
			if ('500' == data.status) {
			  error_msg = data.message;
			  $('#validation_error_text').html("<span class='help-block'>" + error_msg + "</span>");
			  $('#validation_error').show();
			} else if('200' == data.status) {
				$('#modal_placeholder').modal('hide');
				$("#user_id").val(data.test.user_id);
				$('#create_property_form').submit();
				//alert(data.test);
				//window.location = BASE_URL+'host/Createhostproperty';
				//return registerUser();
			} else {
				//
			}
		},
		"json"
		);
	}
}//end of the function
</script>