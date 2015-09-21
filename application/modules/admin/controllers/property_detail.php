<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting( E_ALL );
ob_start();

class Property_detail extends CI_Controller 
{
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
			$this->load->model('host/host_model');
			$this->load->model('home/home_model');
	 }
		
	/**
	** Function to view property booking
	*/
	function view_booking($orderColumn='id', $sortOrder='ASC',$id = '-')
	{
		
		$this->load->library('pagination');
		$data['orderColumn'] = $orderColumn;
		if($sortOrder == 'DESC')
		$data['sortOrder'] = 'ASC';
		else
			$data['sortOrder'] = 'DESC';
			$config['base_url'] = base_url().index_page().'admin/property_detail/view_booking/'.$orderColumn.'/'.$sortOrder.'/'.$id;
			$config['uri_segment'] = $uri = 7;
			$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
			$config['per_page'] = $data['per_page'] = $per_page = 10;
			$data['id'] =  $id;
			$data['query'] = $credit_list = $this->admin_model->fetch_property_booking($offset, $per_page, $orderColumn, $sortOrder,$id);
		
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
		
		$this->load->view('admin/property_booking_list_view',$data);
	}

	/**
	** Function to view all property
	*/
	function view_properties($orderColumn='property_id', $sortOrder='ASC',$id = '-')
	{
		
		$this->load->library('pagination');
		$data['orderColumn'] = $orderColumn;
		if($sortOrder == 'DESC')
		$data['sortOrder'] = 'ASC';
		else
			$data['sortOrder'] = 'DESC';
			$config['base_url'] = base_url().index_page().'admin/property_detail/view_properties/'.$orderColumn.'/'.$sortOrder.'/'.$id;
			$config['uri_segment'] = $uri = 7;
			$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
			$config['per_page'] = $data['per_page'] = $per_page = 10;
			$data['property_id'] =  $id;
			$data['query'] = $credit_list = $this->admin_model->fetch_properties($offset, $per_page, $orderColumn, $sortOrder,$id);
		
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
		
		$this->load->view('admin/properties_list_view',$data);
	}


	function edit_property($property_id, $user_id)
	{
		$data['property_info'] = $this->admin_model->get_property_info($property_id);

		//$property_tags = $this->admin_model->getPropertyTags($property_id);

		$data['property_imgs'] = $this->admin_model->get_property_images($property_id);
		//get property tags of property
		$data['property_tags'] = '';
		$tag = $this->admin_model->extractTags($property_id);			
			$ids = array();
			foreach($tag as $r)
			{
				$ids[] = $r->master_tag_id;	
			}
			if(empty($ids))
			{
				$data['property_tags'] = null;
			}
			else
			{
			$data['property_tags'] = $this->admin_model->getTagsDetails($ids);
			//$results['amenities'] = $amenitDetails; 			
			}

		$data['season1_price'] = $this->admin_model->get_season1_price($property_id);	
		$data['season2_price'] = $this->admin_model->get_season2_price($property_id);
		$data['season3_price'] = $this->admin_model->get_season3_price($property_id);
		$data['season4_price'] = $this->admin_model->get_season4_price($property_id);

		$data['user_id'] = $user_id;
		//get amenities of property
		$data['amenities_'] = '';
		$amenities = $this->admin_model->extractAmenit($property_id);			
			$ids = array();
			foreach($amenities as $r)
			{
				$ids[] = $r->amenities_id;	
			}
			if(empty($ids))
			{
				$data['amenities_'] = "null";
			}
			else
			{
			$data['amenities_'] = $this->admin_model->getAmenitDetails($ids);
			//$results['amenities'] = $amenitDetails; 			
			}
		
		
		$this->load->view('admin/edit_property_view', $data);
	}


	/***
  		* Function to view the details of the view
  	**/
 	function view_property($property_id, $user_id)
 	{
		$data['property_info'] = $this->admin_model->get_property_info($property_id);

		//$property_tags = $this->admin_model->getPropertyTags($property_id);

		$data['property_imgs'] = $this->admin_model->get_property_images($property_id);
		//get property tags of property
		$data['property_tags'] = '';
		$tag = $this->admin_model->extractTags($property_id);			
			$ids = array();
			foreach($tag as $r)
			{
				$ids[] = $r->master_tag_id;	
			}
			if(empty($ids))
			{
				$data['property_tags'] = null;
			}
			else
			{
			$data['property_tags'] = $this->admin_model->getTagsDetails($ids);
			//$results['amenities'] = $amenitDetails; 			
			}

		$data['season1_price'] = $this->admin_model->get_season1_price($property_id);	
		$data['season2_price'] = $this->admin_model->get_season2_price($property_id);
		$data['season3_price'] = $this->admin_model->get_season3_price($property_id);
		$data['season4_price'] = $this->admin_model->get_season4_price($property_id);

		$data['user_id'] = $user_id;
		//get amenities of property
		$data['amenities_'] = '';
		$amenities = $this->admin_model->extractAmenit($property_id);			
			$ids = array();
			foreach($amenities as $r)
			{
				$ids[] = $r->amenities_id;	
			}
			if(empty($ids))
			{
				$data['amenities_'] = "null";
			}
			else
			{
			$data['amenities_'] = $this->admin_model->getAmenitDetails($ids);
			//$results['amenities'] = $amenitDetails; 			
			}
		
			
			//To check property has additional rooms 
			$data['property_rooms'] = $this->admin_model->get_property_Rooms($property_id);
			$data['property_rooms_count'] = $this->admin_model->Count_property_Rooms($property_id);
			
			//$data['property_tags'] = $property_tags;
			$this->load->view('admin/property_details_view',$data); 
			//echo json_encode($data);
	
 	}


 	public function Propertyoverview()
 	{ 
 		$this->form_validation->set_rules('title', 'title', 'required');
		 $this->form_validation->set_rules('description', 'description', 'required');
		 $this->form_validation->set_rules('neighbourhood', 'neighbourhood', 'required');
		/* $this->form_validation->set_rules('house_rules', 'house_rules', 'required');*/
		 $this->form_validation->set_rules('min_night', 'min_night', 'required|numeric');	    
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,			
				'title' => strip_tags(form_error('title')),
				'description' => strip_tags(form_error('description')),
				'neighbourhood' => strip_tags(form_error('neighbourhood')),
				'house_rules' => strip_tags(form_error('house_rules')),
				'min_night' => strip_tags(form_error('min_night')),
				);
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			echo json_encode($offerArray);
			
		}
		
		else{									
							
							$udata1 = $this->input->post('title');
							$udata2 = $this->input->post('description');							
							$udata3 = $this->input->post('neighbourhood');
							$udata4 = $this->input->post('house_rules');
							$udata5 = $this->input->post('min_night');
							$udata6 = $this->input->post('user_id');
						
							$udata7 = $this->input->post('property_id');
													
							$userCheck=$this->host_model->user_exists($udata6);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
														
							echo json_encode($data);
						}  
						if ($userCheck==true)
						{ 	
							$userPropertyCheck=$this->host_model->property_check($udata7);
							
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!!";
								//$this->response($data, 400);
								echo json_encode($data);
							}
						
							if($userPropertyCheck == true)
							{ 
							$res = $this->host_model->insert_overview($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7);
							//$res = $this->common_model->updateTableData('user_property', $udata, $whr_data['user_property_id'] );
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["property_id"] = $udata7;
								$data["message"] = "Property Overview:- Edited...";
								//$this->load->view('Property_Listing', $data);
								
									
								
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}
 	}

 	function updateStatus($status, $prop_id)
 	{
 		if($status == 1)
 		{
 			$status = "Active";
 			$res = $this->admin_model->Updatestatus($status, $prop_id);
 			if($res)
 			{
 				$data['status'] = 200;
 				$data['message'] = "Property Activated";
 				echo json_encode($data);
 			}
 		}
 		if($status == 2)
 		{
 			$status = "Inactive";
 			$res = $this->admin_model->Updatestatus($status, $prop_id);
 			if($res)
 			{
 				$data['status'] = 200;
 				$data['message'] = "Property Deactivated";
 				echo json_encode($data);
 			}	
 		}	
 	}

	/***
	  * Load the status popup to update the status
	  **/
	 function load_request_popup()
	 {
		$data['property_id'] = $this->input->post('property_id',TRUE);
		$data['status'] = $this->input->post('status',TRUE);
		//get the name of the user from user_id
		//$data['full_name'] = $this->user_model->get_user_full_name($data['user_id']);
		$popup_view = $this->load->view('admin/property_status_popup_view',$data,TRUE);
		echo $popup_view;
	 }

	  /***
	  * Funcition to update the property status
	  **/
	 function update_status()
	 {
		 $property_id = $this->input->post('property_id',TRUE);
		 //echo $user_id;
		
		 $upd['status'] = $status = $this->input->post('status',TRUE);
		 if($status == 'Inactive')
			 $status_message = 'Property status is Pending.';
		 else if($status == 'Active')
			 $status_message = 'Property has been Approved Successfully.';
		
		  $arr['property_id'] = $property_id;
		 if($this->admin_model->updateTableData('properties', $upd, $arr))
				echo $status_message;
		 else
				echo 'error';
	 }//end of the fun update_status
		
	
	 


}//end of the class property_details
ob_clean();
?>