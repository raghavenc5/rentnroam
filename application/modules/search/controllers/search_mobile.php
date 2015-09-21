<?php
include(APPPATH.'libraries/REST_Controller.php');
/***
 * Controller 
 **/
class Search_mobile extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}
	/***
	** Function to fetch all property(Without any filter)
	*/
	function FetchProperty_get()
	{	
		$status = $result = $statusInfo = '';	
		$search_result = $this->search_model->getAllproperty();
		$total_num_records  = count($search_result);
		if(!empty($search_result))
		{
			foreach($search_result as $property)
			{
				$properties_image= array();
				$available_amenities = array();
				$property_id= $property->property_id;
				$property_image = $this->search_model->getImage($property_id);
				if(!empty($property_image))
				{
					foreach($property_image as $image)
					{
						$property_image_path = base_url().'/public/uploads/property_image/';
						$property_image =$image->images;
						if($property_image!='')
						{
							$property_pic = $property_image_path.$property_image;
						}
						else
						{
							$property_image = "default.png";
							$property_pic = $property_image_path.$property_image;
						}						
						
						$properties_image[] =array( 'image' => $property_pic);
					}
				}
				else
				{
					$property_image_path = base_url().'/public/uploads/property_image/';
					$property_image = "default.png";
					$property_pic = $property_image_path.$property_image;
					$properties_image[] =array( 'image' => $property_pic);
				}
				$property_amenities = $this->search_model->fetchAmenities($property_id);
				if(!empty($property_amenities))
				{
					foreach($property_amenities as $amenities)
					{
						$available_amenities[] =array( 'amenities' => $amenities->amenities_subtype);
					}
				}
				else
				{
					$available_amenities = array();
				}
				$user_image_path = base_url().'/public/uploads/user_image/';
				$user_image = $property->profile_pic;
				if($user_image!='')
				{
					$profile_pic = $user_image_path.$user_image;
				}
				else
					$profile_pic = '';
				$property_list[] = array(
															 'user_id' => $property->user_id ,
															 'user_name' => $property->user_name,
															 'bathrooms' => $property->bathrooms,
															 'property_id' => $property->property_id,
															 'property_image' => $properties_image ,
															 'price'=>$property->price,
															 'bed'=>$property->bed,
															 'bedrooms'=>$property->bedrooms,
															 'guest_allow'=>$property->guest_allow,
															 'city'=>$property->city_name,
															 'room_type'=>$property->roomtype,
															 'property_type'=>$property->property_type,
															 'check_in_time'=>$property->check_in_time,
															 'check_out_time'=>$property->check_out_time,
															 'host_image'=>$profile_pic,
															 'property_name'=>$property->property_title,
															 'description'=>$property->description,
															 'latitude'=>$property->latitude,
															 'longitude'=>$property->longitude,
															 'minimum_stay'=>$property->min_night_stay,
															 'cancellation_policy'=>$property->policy,
															 'house_rules'=>$property->house_rule,
															 'available_amenities'=>$available_amenities
															);
			}
			    $data= array();
					$data["status"] = 200;
					$data["error"]= false;
					$data["search_result"] = $property_list;
					$data["message"] = "Success" ;
					$data["total_no_of_records"] = $total_num_records;
		}
		else
				{
					$data= array();
					$data["status"] = 400;
					$data["error"]= True;
					$data["search_result"] = array();
					$data["message"] = "No records found" ;
					$data["total_no_of_records"] = $total_num_records;	
				}
		$this->response($data);
	}
 /**
 * Function to apply filter on searching property
 */
 function PropertyFilter_post()
 {	
		$status = $result = $statusInfo = '';
		$error_flag = 0;
		$city_name = $this->post('city');
		if($city_name == '')
		{
			$error_flag = 1;
			$status = "404";
			$statusInfo =  "Please provide city.";
		}
		if($error_flag == 0)
		{
			$offset = $this->post('offset');
			$total_num_records = 0;
			$per_page = $this->post('per_page');
			$sort_by = $this->post('sort_by');
			//------------------------- ROOM TYPE ID------------------------------//
			//------------------------- No OF BED ------------------------------//
			$bed = $this->post('bed');
			//------------------------- NO OF BATHROOM ------------------------------//
			$bathroom = $this->post('bathroom');
			//------------------------- NO OF BEDROOM ------------------------------//
			$bedroom = $this->post('bedroom');
			//------------------------- NO OF GUEST ALLOWED ------------------------------//
			$guest = $this->post('guest');
			//------------------------- SUITABLE PACKAGE ------------------------------//
			$min_package = $this->post('min_package');
			$max_package = $this->post('max_package');
			//------------------------- Check In and Check Out ------------------------------//
			$check_in_time = $this->post('check_in_time');
			$check_out_time = $this->post('check_out_time');
			 $room_type = $this->post('room_type');
		 $property_type = $this->post('property_type');		
		 $amenities = $this->post('amenities');		
		 $language = $this->post('language');
		 $tags = $this->post('tag');
		 $policy = $this->post('policy');
			
			$search_result = $this->search_model->getProperty($offset,$per_page,$sort_by,$city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time);
			$total_num_records  = count($search_result);
			 foreach($search_result as $property)
			 {
				 $properties_image= array();
			$available_amenities = array();
			$property_id = $property->property_id;
			$property_image = $this->search_model->getImage($property_id);
			if(!empty($property_image))
			{
				foreach($property_image as $image)
				{
					$property_image_path = base_url().'/public/uploads/property_image/';
					$property_image =$image->images;
					if($property_image!='')
					{
						$property_pic = $property_image_path.$property_image;
					}
					else
						$property_pic = '';					
					$properties_image[] =array( 'image' => $property_pic);
				}
			}
			else
			{
				$properties_image = array();
			}
			$property_amenities = $this->search_model->fetchAmenities($property_id);
			if(!empty($property_amenities))
			{
				foreach($property_amenities as $amenities)
				{
					$available_amenities[] =array( 'amenities' => $amenities->amenities_subtype);
				}
			}
			else
			{
				$available_amenities = array();
			}
				  //$user_image_path = "http://104.215.198.240/rentnroam/uploads/user_image/";
					$user_image_path = base_url().'/public/uploads/user_image/';
					$user_image = $property->profile_pic;
					if($user_image!='')
					{
						$profile_pic = $user_image_path.$user_image;
					}
					else
						$profile_pic = '';
				 	$result[] = array(
														 'user_id' => $property->user_id ,
														 'user_name' => $property->user_name,
														 'bathrooms' => $property->bathrooms,
														 'property_id' => $property->property_id,
														 'property_image' => $properties_image ,
														 'price'=>$property->price,
														 'bed'=>$property->bed,
														 'bedrooms'=>$property->bedrooms,
														 'guest_allow'=>$property->guest_allow,
														 'city'=>$property->city_name,
														 'room_type'=>$property->roomtype,
														 'property_type'=>$property->property_type,
														 'check_in_time'=>$property->check_in_time,
														 'check_out_time'=>$property->check_out_time,
														 'host_image'=>$profile_pic,
														 'property_name'=>$property->property_title,
														 'description'=>$property->description,
														 'latitude'=>$property->latitude,
														 'longitude'=>$property->longitude,
														 'minimum_stay'=>$property->min_night_stay,
														 'cancellation_policy'=>$property->policy,
														 'house_rules'=>$property->house_rule,
														 'available_amenities'=>$available_amenities
																);
			 
			}
		}
		$output = array ('status' => $status , 'result' => $result ,'status_info' => $statusInfo );
		$this->response($output);
 }

}
?>