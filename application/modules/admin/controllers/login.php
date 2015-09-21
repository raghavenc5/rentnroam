<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
error_reporting(0);
class Login extends CI_Controller {
 function __construct()
 {
   parent::__construct();
	$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('text');
 }

 /***
  * Function to load the login view
  **/
 function index()
 {
  if($this->session->userdata('user_name') != '')
     redirect('admin/dashboard');  	
  else  
   {
		 $data['no_visible_elements']=true;
     $data['error'] = '';
     $data['errorFlag'] = '';
		 $data['user_name'] = $this->input->post('user_name');
     $data['password']  = $this->input->post('password');
     $this->load->view('login_view',$data); 
   }     
 }
 /***
  * Function to checkt the login functionality
  **/
 function process_login()
 {   
  if($this->session->userdata('user_name') != '')
      redirect('admin/dashboard');  
  else  
   {
	 $data['no_visible_elements']=true;
   $data['errorFlag'] = '';
   $data['user_name'] = $user_name = $this->input->post('user_name');
   $data['password']  = $password  = $this->input->post('password');
   $this->load->library('form_validation');
   $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE)
	{  
		$data['errorFlag'] = 1;	
		$data['error'] = '';
	}
	else
	{
		$this->load->model('admin_model');
		$rec = $this->admin_model->admin_login($user_name,$password);			
	 if(!empty($rec))
	 {
		 //start session
		 $admin_session_data =
					array(
										'user_name'  => $user_name,                 
										'admin_logged_in' => TRUE
								);
 
		 $this->session->set_userdata($admin_session_data); 
		 redirect('admin/dashboard');
	 }
	 else
	 {
		$data['errorFlag'] = 1;	
		$data['error'] = "Please Try Again.";	
	 }
	}	
	if($data['errorFlag'] == 1 )
	 $this->load->view('login_view',$data);
   }
 }
 
 /****
  * Function to logout from the admin section
  **/
 function logout()
 {
   $admin_session_data = array('user_name' => '', 'logged_in' => '');
   $this->session->unset_userdata($admin_session_data);
   redirect('admin/login'); 
 }
 
 
}
ob_clean();
?>