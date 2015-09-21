<?php
include(APPPATH.'libraries/REST_Controller.php');
/***
 * Controller 
 **/
class Home_mobile extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('admin/admin_model');
	}

	/**
	* Function for login
	*/
function dologin_post()
	{		
		$status_info = $user_info = $status = $error = ''; $error_flag = 0;
		$req_type = $this->post('req_type');
		$device_token = $this->post('device_token');
		log_message('error', "In process login function req_type = $req_type");
		if($req_type == '')
		{
			$error_flag = 1;
			$status = 404;
			$error =  "Request type is required parameter";			
		}
		else if($req_type == 'custom') //---------------------------------- CUSTOM Login------------------------------------//
	  {
			$email_id = $this->post('email_id');
			$password = $this->post('password');
			log_message('error', "In process login function Email $email_id ===== Password == $password");
			if($email_id == '')
			{
				$error_flag = 1;
				$status = 404;
				$error =  "Email-id is required parameter";				
			}
			else if($password == '')
			{
				$error_flag = 1;
				$status = 404;
				$error=  "Password is required parameter";				
			}
			if($error_flag == 0)
			{
				//Check for the login cond now
				$fb_id = '';
				$user_info = $this->home_model->checkLogin($email_id,$password,$fb_id);
				if(!empty($user_info))
				{				
					$user_id = $user_info->user_id;
					$user_name = $user_info->user_name;
					//Update the device token in the database
					$upd_data['device_token']  = $device_token;
					$whr_data['user_id'] = $user_id;
					$this->admin_model->updateTableData('users',$upd_data,$whr_data);
					$status = 200;
					$user_info = array('user_id' => (int)$user_id , 'user_name' => $user_name , 'email_id' => $email_id);						
				}
				else
				{
					$error_flag = 1;
					$status = 401;
					$error = "'Authentication failure. Please try again";					
				}
			}			
		}		
		else if($req_type == 'fb') //---------------------------------- FACEBOOK Login ------------------------------------//
		{
			$fb_id = $this->post('fb_id');			
			$email_id = $this->post('email_id');
			$password = $this->post('password');
			$first_name = $this->post('first_name');
			$last_name = $this->post('last_name');
			if($fb_id == '')
			{
				$error_flag = 1;
				$status = 404;
				$error=  "Facebook Id is required parameter";				
			}
			else if($email_id == '')
			{
				$error_flag = 1;
				$status = 404;
				$error=  "Email Id is required parameter";				
			}
			else
			{
				//echo $fb_id;
			  $check_email = $this->home_model->checkEmail($email_id);
				$check_fb_id = $this->home_model->checkFbid($fb_id);
				if(!empty($check_fb_id))
				{
					$user_data = $this->home_model->checkFbid($fb_id);
					$user_id = $user_data->user_id;
				  $first_name = $user_data->first_name;
					$last_name = $user_data->last_name;
					//Update the device token in the database
					$upd_data['device_token']  = $device_token;
					$whr_data['user_id'] = $user_id;
					$status = 200;
					$this->admin_model->updateTableData('users',$upd_data,$whr_data);
					$user_info = array('user_id' => (int)$user_id , 'first_name' => $first_name , 'last_name' => $last_name, 'email_id' => $email_id);
				}
				else if((empty($check_email)) && (empty($check_fb_id)) )
				 {
						//Insert it in the database
						$ins_data['fb_id'] = $fb_id;
						$ins_data['email'] = $email_id;
						$md5_pass = $ins_data['password'] = md5($password);
						$ins_data['first_name'] = $first_name;
						$ins_data['last_name'] = $last_name;
						$ins_data['status'] = 'active';
						$ins_data['device_token'] = $device_token;
						$this->home_model->insertTableData('users',$ins_data);
						$user_id = $this->db->insert_id();
						$status = 200;
						log_message('error', "In the fb function New user $user_id -------- $user_name ------- $email_id ---- ");
						$user_info = array('user_id' => (int)$user_id , 'user_name' => $user_name , 'email_id' => $email_id, 'user_type' => $user_type );
					}
				 else if((!empty($check_email)) && (empty($check_fb_id)) )
				 {
						$fetch_data = $this->home_model->checkEmail($email_id);
						$user_id = $fetch_data->user_id;
				  	$first_name = $fetch_data->first_name;
						$last_name = $fetch_data->last_name;
						$email_id = $fetch_data->email;
						$upd_data['fb_id']  = $fb_id;
						$upd_data['email']  = $email_id;
						$md5_pass = $upd_data['password'] = md5($password);
						$whr_data['user_id'] = $user_id;
						$status = 200;
						$this->admin_model->updateTableData('users',$upd_data,$whr_data);
						$user_info = array('user_id' =>$user_id , 'first_name' => $first_name , 'last_name' => $last_name , 'email_id' => $email_id );
				 }
			}
		}
		else
		{
			$error_flag = 1;
			$status = 401;
			$error = "Invalid Request type. Request type should be custom or fb.";			
		}		
		if($error_flag ==1 || $error != '')
		{
			$user_info = array('user_id' => 0 , 'first_name' => '' , 'last_name' => '' ,'email_id' => '' );
		  $status_info = $error;
		}
		else
		  $status_info = 'success';
    log_message('error', "In process login end status = $status  status_info =$status_info");
		
		$output = array ('status' => $status , 'user_info' => $user_info ,'status_info' => $status_info );
		$this->response($output);
	}
	/***
	**Function for custom Registration
	*/
	function customSignup_post()
	{
		set_time_limit (0);
		$status = $status_info = $user_info  = $error = '';
		$error_flag = 0;
		$device_token = $this->post('device_token');
		$email_id = $this->post('email_id');
		$first_name = $this->post('first_name');
		$last_name = $this->post('last_name');
		$password = $this->post('password');			
		log_message('error', "In Registration email_id = $email_id first_name=$first_name last_name=$last_name password=$password ");
		if($email_id == '')
		{
			$error_flag = 1;
			$status = 404;
			$error =  "Email-id is required parameter";
		}				
		else if($password == '')
		{
			$error_flag = 1;
			$status = 404;
			$error=  "Password is required parameter";
		}
		else if($first_name == '')
		{
			$error_flag = 1;
			$status = 404;
			$error=  "first_name is required parameter";
		}
		else if($last_name == '')
		{
			$error_flag = 1;
			$status = 404;
			$error=  "last_name is required parameter";
		}
		if($error_flag == 0)
		{		 		
			//Check if the registration exists
			$user_info = $this->home_model->userExists($email_id);
			if(!empty($user_info))
			{				
					$user_id = $user_info->user_id;
					$first_name = $user_info->first_name;
					$last_name = $user_info->last_name;
					//Update the device token in the database
					$upd_data['device_token']  = $device_token;
					$whr_data['user_id'] = $user_id;
					$this->admin_model->updateTableData('users',$upd_data,$whr_data);
					$status = 401;
					$error=  "User already exist.";				
					$user_info = array('user_id' => (int)$user_id ,
														 'first_name' => $first_name ,
														 'last_name' => $last_name,
														 'email_id' => $email_id 
														 );
			}
			else //REGISTER
			{
				$error_flag = 0;
				$status = 200;
				//Insert it in the database
				$ins_data['email'] = $email_id;							
				$md5_pass = $ins_data['password'] = md5($password);
				log_message('error', "In Registration password b4 $password aftr md5 ==> $md5_pass");
				$ins_data['first_name'] = $first_name;
				$ins_data['last_name'] = $last_name;
				$ins_data['status'] = 'active';
				$ins_data['device_token'] = $device_token;
				$this->home_model->insertTableData('users',$ins_data);
				$user_id = $this->db->insert_id();
				$user_info = array('user_id' => (int)$user_id ,
													 'first_name' => $first_name ,
													 'last_name' =>$last_name,
													 'email_id' => $email_id
														);		
			}
		}	
			if($error_flag ==1 || $error != '')
			{
				$user_info = array('user_id' => 0 , 'first_name' => '' , 'last_name' => '' , 'email_id' => '' );
				$status_info = $error;
			}
			else
				$status_info = 'success';
		$output = array ('status' => $status , 'user_info' => $user_info ,'status_info' => $status_info );
		$this->response($output);
	}//endof the function
	/***
	 * Function for Forgot PASSWORD
	 **/
	function forgotPassword_post()
	{		
		$email_id= $this->post('email_id');
		$rec1= $this->home_model->userExists($email_id);
		if(!empty($rec1))//check the count
			{							
				$user_id=$rec1->user_id;
				$password=$rec1->password;
				$email_id=$rec1->email;
				if (empty($password))//if user is registered from Facebook
				{
					$status = 500;
					$message="success";
					$error= "User is registered through Facebook.";
				}
				else//update the new password and sent the mail
				{
					$new_password= random_string('alnum',6);
					$upd_data['password']  =  md5($new_password);
					//$upd_data['password']  =  md5("1234");
					$whr_data['email'] = $email_id;
					$this->admin_model->updateTableData('users',$upd_data,$whr_data);
					$status = 200;
					$error= "";
					$message="password sent";
					$error = "success";
					//Send the email to the user
						$email_template['subject'] = 'Password Reset';
						$email_template['message'] = '<div> 
						<div>
							<p>
								 Hello {USERNAME}!<br><br>
								<p>
								 Forgot your Rnr password?<br><br>
								 
									Your new password is "{New Password}".<br>
									Please keep in mind that your password is case-sensitive. <br><br>
								</p>
							Yours truly,<br>
							The Rnr Team<br>     
							</p>
					 </div>
				 </div>';									
						//Replace the variables from the message
						$first_name = $rec1->first_name;
						$last_name = $rec1->last_name;
						$user_name = $first_name.$last_name;
						$pattern = array('/{USERNAME}/','/{New Password}/');
						$replacement = array($user_name,$new_password);
						$email_template['message'] = preg_replace($pattern,$replacement,$email_template['message']);
						//$email_template['to'] = $email_id;
						$email_template['to'] = array( 'email' =>$email_id);
						send_email_notification($email_template); //From the email helper
				}					
			}
			else //Invalid user_email
			{
				$status = 403;
				$message="";
				$error= "Invalid email-id.";
			}
		$output = array ('status' => $status , 'message' => $message,'status_info' =>$error );
		$this->response($output);
	}
	function contactHost_post()
	{
		$status = $status_info = $error = '';
		$error_flag = 0;
		$property_id = $this->post('property_id');
		$host_id = $this->post('host_id');
		$user_id = $this->post('user_id');
		$arrival_date = $this->post('arrival_date');
		$departure_date = $this->post('departure_date');
		$guest = $this->post('guest');
		$message = $this->post('message');
		
	}
}
?>