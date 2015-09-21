<?php 

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	error_reporting(1);
	ob_start();
	class User_profile extends CI_Controller {
 
 	function __construct()
 	{
   		parent::__construct();
	 	$this->load->library('session');
  		if($this->session->userdata('user_name') == '')
  		redirect('admin/login');	 
		$this->load->helper(array('form', 'url'));	
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->model('admin_model');
		$this->load->model('search/search_model');
		$this->load->model('home/home_model');
 	}

 	/***
  	* Index Function just loading the simple dashboard view
  	**/
 function index($orderColumn='user_id', $sortOrder='ASC',$user_id = '-')
 {
	//echo "hii";
    $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
		$data['sortOrder'] = 'DESC';
		$config['base_url'] = base_url().index_page().'admin/user_profile/index/'.$orderColumn.'/'.$sortOrder.'/'.$user_id;
		$config['uri_segment'] = $uri = 7;
		$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
		$config['per_page'] = $data['per_page'] = $per_page = 10;
    	$data['user_id'] =  $user_id;
	  	$data['user_list'] = $this->admin_model->get_user_list($offset, $per_page, $orderColumn, $sortOrder,$user_id);
		$data['query'] = $credit_list = $this->admin_model->fetch_user_data($offset, $per_page, $orderColumn, $sortOrder,$user_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;
	//----------- Pagination Design ----------------//
	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	
	$this->load->view('admin/userProfile_list_view',$data);

 }//end of the index


/***
  * Function to view the details of the view
  **/
 function view_user($user_id)
 {
	$user_info = $this->admin_model->get_user_info($user_id);
	$user_doc = $this->admin_model->getUserdoc($user_id);
	$user_property = $this->admin_model->getUserproperty($user_id);
	if(!empty($user_info))
	{
		$data['user_info'] = $user_info;
		$data['user_doc'] = $user_doc;
		$data['user_id'] = $user_id;
		$data['user_property'] = $user_property;
		$this->load->view('admin/user_detail_view',$data); 
	}
 	else
	 redirect('admin/user_profile');
 }

 /***
  * Function to add-edit user
  * @param INT $user_id : IF user id present then edit the existing information
  * else add the new user
  **/ 
 function manage_user($user_id = '')
 {
	//$this->load->config('upload_config');
	$errorFlag = '';
	$data['user_id'] = $user_id;
	$data['first_name'] = $upd_data['first_name'] =  $this->input->post('first_name',TRUE);
	$data['last_name'] = $upd_data['last_name'] =  $this->input->post('last_name',TRUE);
	$data['email'] = $upd_data['email'] =  $this->input->post('email',TRUE);
  $data['profile_pic'] = $upd_data['profile_pic']= $this->input->post('profile_thumb',TRUE);
  $data['profile_img_hidden'] = $profile_img_hidden = $this->input->post('profile_img_hidden',TRUE);	
  $data['status'] = $upd_data['status'] =  $this->input->post('status',TRUE);
	$data['gender'] = $upd_data['gender'] =  $this->input->post('gender',TRUE);
  $data['contact_number'] = $upd_data['user_emergency_contact_no'] = $this->input->post('contact_number',TRUE);
	$saveFlag = $this->input->post('saveFlag',TRUE);
	//Fetch the records from the database
	if($saveFlag != 1 && $user_id != '')
	{	 
	 $user_info = $this->admin_model->get_user_info($user_id);
	if(!empty($user_info))
	 {	 
		$data['first_name'] = $user_info->first_name;
		$data['last_name'] = $user_info->last_name;
		$data['email'] =  $user_info->email;
		$data['profile_pic'] =  $user_info->profile_pic;
		$data['profile_img_hidden'] =  $user_info->profile_pic;
		$data['status'] = $user_info->status;
		$data['gender'] = $user_info->gender;
		$data['contact_number'] = $user_info->user_emergency_contact_no;
		 }
	 else
	  redirect('admin/user_profile');
	}
	if($saveFlag == 1)
	{
	 $this->load->library('form_validation');
	 $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	 $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	 $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');	 
	 if ($this->form_validation->run() == FALSE)
	 {  
		 $errorFlag = 1;
	 }
	 else
	 {
		//Check duplicate email-id or user_name
		$dup = $this->admin_model->chk_duplicate_user($data);
		if(!empty($dup))
		{
		 $errorFlag = 1;
		 if(!empty($dup))
			$data['error'] = "Email-id already Existed.";	
		}
				if(!empty($_FILES["profile_thumb"]['name']))
		   { 	
				//Upload profile pics
				$this->config->load('upload_config');
				$config['upload_path'] = $this->config->item('user_profile_rel_url');
				$config['allowed_types'] = $this->config->item('user_profile_allowed_types');  
				$config['max_size']	= '2000';
				$config['max_width']  = '2000';
				$config['max_height'] = '2000';
				$config['encrypt_name'] = TRUE;
				$type_image="profile_thumb";
				$this->load->library('upload',$config);	    
				if ( ! $this->upload->do_upload($type_image))				
					$error = $this->upload->display_errors();			
				else
				{
					$data1 = $this->upload->data();
				  //create the thumbnail
					$profile_image = $data1['file_name'];
			    $temp = $data1;
					if($temp['file_name'] != '')
					{
					 $newpic = $temp['file_name'];
					 $config['image_library'] = 'GD2';
					 $config['source_image'] = $this->config->item('user_profile_rel_url').$newpic;
					 $config['create_thumb'] = TRUE;
					 $config['maintain_ratio'] = FALSE;
					 $config['width']  = "614";
					 $config['height'] = "276";
					 $type_img_thumb = $temp['raw_name'].'_thumb'.$temp['file_ext'];
					 $this->load->library('image_lib', $config);
					 $this->image_lib->resize();
					 if ( ! $this->image_lib->resize())
					 {	
					 $error = $this->image_lib->display_errors();					
					 }
					 $upd_data['profile_pic'] = $type_img_thumb;
					}
				}
			 }
		 else
			{
			 $upd_data['profile_pic'] =$profile_img_hidden;
			}
		
		if(($user_id == '') && ($errorFlag != '1'))    // INSERT
		{
			//$data['reg_date'] = date("Y-m-d"); //2013-06-06
			$this->home_model->insertTableData('users',$upd_data);
			$user_id = $this->db->insert_id();
			$this->session->set_flashdata('message_data','User Profile Added Successfully.');
			redirect('admin/user_profile');
		}
		else if ($errorFlag != '1') //Update
		{
		  $arr['user_id'] = $user_id;
			$this->admin_model->updateTableData('users', $upd_data, $arr);
			$this->session->set_flashdata('message_data','User Profile Updated Successfully.');
			redirect('admin/user_profile');
		}
	 }
	}
	else
	 $errorFlag = 1;
	if($errorFlag == 1)
	 $this->load->view('admin/edit_user_view', $data);	
 }//end of the function manage_user

 /**
 ** Function to download the document
 */
 function download_doc($user_id)
 {
		$user_doc = $this->admin_model->getUserdoc($user_id);
		$doc_image = $user_doc->id_proof;
	 	$this->load->helper('download');
		//Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
		$doc_name = $user_doc->id_proof;
								$doc_path = base_url().'/public/uploads/user_documents/';
								$doc = $doc_path.$doc_name;
		$data = file_get_contents($doc);
		//Read the file's contents
		$name = 'id_proof.png';
		//use this function to force the session/browser to download the file uploaded by the user 
		force_download($name, $data);
 }

  /***
  * Load the status popup to update the status
  **/
 function load_request_popup()
 {
	$data['user_id'] = $this->input->post('user_id',TRUE);
	$data['status'] = $this->input->post('status',TRUE);
	//get the name of the user from user_id
	//$data['full_name'] = $this->user_model->get_user_full_name($data['user_id']);
	$popup_view = $this->load->view('admin/user_request_popup_view',$data,TRUE);
	echo $popup_view;
 }
  /***
  * Funcition to update the user status
  **/
 function update_status()
 {
	 $user_id = $this->input->post('user_id',TRUE);
	 //echo $user_id;
	
	 $upd['status'] = $status = $this->input->post('status',TRUE);
	 if($status == 'Inactive')
		 $status_message = 'User status is Pending.';
	 else if($status == 'Active')
		 $status_message = 'User has been Approved Successfully.';
	
	  $arr['user_id'] = $user_id;
	 if($this->admin_model->updateTableData('users', $upd, $arr))
			echo $status_message;
	 else
			echo 'error';
 }//end of the fun update_status
}//end of the class User_profile
ob_clean();
?>