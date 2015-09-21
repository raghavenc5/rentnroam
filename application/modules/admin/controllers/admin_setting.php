<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
ob_start();
class Admin_setting extends CI_Controller {
 function __construct()
 {
   parent::__construct();
	  $this->load->library('session');
	 if($this->session->userdata('user_name') == '')
     redirect('admin/login');
		 
	 $this->load->helper(array('form', 'url'));
	 $this->load->model('admin_model');
	
 }
 
 /***
  * Update the admin information
  **/
 function index()
 {
	
	 $admin_info = $this->admin_model->get_admin_info();
	 //$result['user_name'] = $upd_db['user_name'] = $this->input->post('user_name',true);	
	 $result['email_id'] = $upd_db['email_id'] = $this->input->post('email_id',true);
	 
	 $result['new_password'] = $this->input->post('new_password',true);
	 $result['confirm_password'] = $this->input->post('confirm_password',true);
	
	 $result['password'] = $this->input->post('password',true);
	
	 $saveFlag = $this->input->post('saveFlag',true);
	$result['user_name'] = $admin_info->user_name;
	 if($saveFlag != 1)
	 {
		$result['user_name'] = $admin_info->user_name;
		$result['email_id'] = $admin_info->email_id;		
	 }
	 else
	 {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_id', 'Email-ID', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($result['new_password'] != '')
		{
		 $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|matches[confirm_password]');
		 $this->form_validation->set_rules('confirm_password', 'Re-Enter', 'trim|required');		 
		}
		if ($this->form_validation->run() == FALSE)
		{  
			$errorFlag = 1;
		}
		else
		{
		  //Check for the old password validation 
			$chk_password = $this->admin_model->chk_admin_password($result['password']);
			if(!$chk_password)
			{
			  $errorFlag = 1;
				$this->session->set_flashdata('error_data','Password does not match. Enter correct password to update admin information.');
				redirect('admin/admin_setting');
			}
			else
			{
			  $message_data = 'Admin Information Updated Successfully.';
			  if($result['new_password'] != '')
				{
		      $upd_db['password'] = MD5($result['new_password']);
					$message_data = "Password and ".$message_data;
				}
				$arr['user_name'] = $this->session->userdata('user_name');
				if($this->admin_model->updateTableData('admin', $upd_db, $arr))
				{
				 $this->session->set_flashdata('message_data',$message_data);
				 redirect('admin/admin_setting');
				}
			}
		}
	 }
	 
   $this->load->view('admin/admin_setting_view',$result);
 }
}
ob_clean();
?>