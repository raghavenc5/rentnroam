<?php
include(APPPATH.'libraries/REST_Controller.php');
/***
 * Controller 
 **/
class Host_mobile extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('host_model');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->model('home/home_model');
	}
	/***
	** Function to Create Property
	*/
	function createProperty_post()
	{
		$status = $result = $statusInfo = '';
		$error_flag = 0;
		$ins_data['property_type_id'] = $this->post('property_type_id');
		$ins_data['room_type_id'] = $this->post('room_type_id');							
		$ins_data['city_id'] = $this->post('city_id');
		$ins_data['user_id'] = $user_id = $this->post('user_id');
		$ins_data['property_title'] = $this->post('property_title');
		$ins_data['description'] = $this->post('description');							
		$ins_data['neighbourhood'] = $this->post('neighbourhood');
		$ins_data['house_rule'] = $this->post('house_rule');
		$ins_data['min_night_stay'] = $this->post('min_night_stay');					
		$ins_data['guest_allow'] = $this->post('guest_allow');
		$ins_data['bedrooms'] = $this->post('bedrooms');
		$ins_data['bathrooms'] = $this->post('bathrooms');
		$ins_data['bed'] = $this->post('bed');
		$ins_data['cancellation_policy_id'] = $this->post('cancellation_policy_id');
		$ins_data['price'] = $this->post('price');
		$ins_data['address_line1'] = $this->post('address');
		$ins_data['latitude'] = $this->post('latitude');
		$ins_data['longitude'] = $this->post('longitude');
		$ins_data['clean_charge'] = $this->post('clean_charge');
		$ins_data['guest_charge'] = $this->post('guest_charge');
		$ins_data['area'] = $this->post('area');
		$ins_data['service_fee'] = $this->post('service_fee');
		$ins_data['tax_fee'] = $this->post('tax_fee');
		$amenities = $this->post('amenities');	
		$userCheck=$this->host_model->user_exists($user_id);		
		if($userCheck == false)
		{					
			$error_flag = 1;
			$status = 404;
			$status_info =  "user doesn't exists, need to sign up";	
		}  
		if($error_flag == 0)
		{
			$status = 200;
			$this->home_model->insertTableData('properties',$ins_data);
			$status_info = "Success";
		}
		$output = array ('status' => $status ,'status_info' => $status_info );
		$this->response($output);
	}		
}
?>
	