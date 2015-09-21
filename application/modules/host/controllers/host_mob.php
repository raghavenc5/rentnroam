<?php
include(APPPATH.'libraries/REST_Controller.php');

class Host_mob extends REST_Controller{
	
	function __construct()
	{	
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('host_model');
		$this->load->library('upload');
		$this->load->library('form_validation');
		
	}
	
	
	//extracting room type
	public function getRoomtype_get(){		
		$data = $this->host_model->extractRomType();	
		//echo json_encode($data);
		$this->response($data, 200);
	}

	
	//extracting property type
	public function getPropertytype_get(){		 
		$data = $this->host_model->extractProperType();				
		echo json_encode($data);		
	}
	
	//extracting city
	public function getCity_get(){		 
		$data = $this->host_model->ExtractCity();				
		echo json_encode($data);			
	}
	
	//selection: to get the state 
	function getStatecountry_get(){
		$country_id = $this->get('country_id');
		$data['state'] = $this->host_model->extractStateCountry($country_id);
		echo json_encode($data);
	}
	
	
	/*--------------------------------Property Listing step 1 ---------------------------------------*/
	/*
	**	
	For posting form data from Host Property Listing 
	1st step of creating property by host user
	*/
	public function createProperty_post(){	
	
		 $this->form_validation->set_rules('property_type_id', 'property_type_id', 'required');
		 $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required');
		 $this->form_validation->set_rules('accommodates', 'accommodates', 'required|numeric');
		 $this->form_validation->set_rules('city', 'city', 'required');
		//$this->form_validation->set_rules('uid', 'uid', 'required');
	    
		//response validation errors
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'property_type_id' => strip_tags(form_error('property_type_id')),
				'room_type_id' => strip_tags(form_error('room_type_id')),
				'accommodates' => strip_tags(form_error('accommodates')),
				'city' => strip_tags(form_error('city'))
				//'uid' => strip_tags(form_error('uid')),
				);
				$offerArray = array();	
				
				foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
				echo json_encode($offerArray);
				//$this->response($offerArray, 400);
		}
		
		//response after validation check
		else{									
							
							$udata1 = $this->input->post('property_type_id');
							$udata2 = $this->input->post('room_type_id');							
							$udata3 = $this->input->post('accommodates');
							$udata4 = $this->input->post('city_id');
							$udata5 = $this->input->post('user_id');
							
							//checking user exists or not
							$userCheck=$this->host_model->user_exists($udata5);
							
									
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
							$res = $this->host_model->create_property($udata1, $udata2, $udata3, $udata4, $udata5);
							//var_dump($res);
							if($res){							
								$data= array();
								$data["status"] = 200;
								$data["error"]= false;
								$data["property_ID"] = $res;
								$data["user_id"] =$udata5;
								$data["message"] = "You've Created Your Listing";
								
								//output:- {"status":200,"error":false,"property_ID":48,"message":"You've Created Your Listing"}
								$this->response($data, 200);
							
		}
							else{
								$data= array();
								$data["status"] = 500;
								$data["error"]= true;								
								$data["message"] = "Opps!!! something wrong";
								//echo json_encode($data);
								$this->response($data, 500);
							}
						}				
			}

	}
	
	//Property Listing step 2
	/*
	**
	For posting form data from Host Property Overview page 
	*/
	public function propertyOverview_post(){	
		
		 $this->form_validation->set_rules('title', 'title', 'required');
		 $this->form_validation->set_rules('description', 'description', 'required');
		 $this->form_validation->set_rules('neighbourhood', 'neighbourhood', 'required');
		/* $this->form_validation->set_rules('house_rules', 'house_rules', 'required');*/
		 $this->form_validation->set_rules('min_night', 'min_night', 'required|numeric');	

		//response validation errors 
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
				//echo json_encode($offerArray);
		
			$this->response($offerArray, 400);
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
							//$this->response($data, 400);							
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
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
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
								$data["message"] = "Successfully Inserted, Proceed to next Steps..";
								//$this->load->view('Property_Listing', $data);
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}

	}
	
	
	//Extract room type for "Add rooms" of entire apartment
	//this function is to extract room type(Private and Shared) and to display on "add room" form fields
	public function getRoomtypeapartment_get(){	
			$data = $this->host_model->extractRoomTypeApartment();				
			echo json_encode($data);	
	}	
	
	//extract all the rooms for entire apartment
	//this function is to extract all the details of each rooms of particular entire apartment
	public function getAllpropertyroom_get(){
			$property_id = $this->get('property_id');
			$data = $this->host_model->extractPropertyRooms($property_id);				
			echo json_encode($data);	
	}
	
	
	//Property Listing (Entire apartment to add rooms)
	/*
	**
	For posting form data for to add rooms of Entire apartment  
	*/
	public function Addrooms_post(){	
		
		 $this->form_validation->set_rules('room_name', 'room_name', 'required');
		 $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required|numeric');
		 $this->form_validation->set_rules('guest_no', 'guest_no', 'required|numeric');
		 $this->form_validation->set_rules('details', 'details', 'required');	    
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,			
				'room_name' => strip_tags(form_error('room_name')),
				'room_type' => strip_tags(form_error('room_type_id')),
				'guest_no' => strip_tags(form_error('guest_no')),
				'details' => strip_tags(form_error('details'))
				);
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			echo json_encode($offerArray);
			//$this->response($offerArray, 400);
		}
		
		else{									
							$udata1 = $this->input->post('room_name');
							$udata2 = $this->input->post('room_type_id');							
							$udata3 = $this->input->post('guest_no');
							$udata4 = $this->input->post('details');
							$udata5 = $this->input->post('property_id');
							$udata6 = $this->input->post('user_id');							
						
							//$udata8 = $this->input->post('property_id');
							$userCheck=$this->host_model->user_exists($udata6);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
							//$this->response($data, 400);							
							echo json_encode($data);
						}  
						if ($userCheck==true)
						{ 	
							$userPropertyCheck=$this->host_model->property_check($udata5);
							
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								//$this->response($data, 400);
								echo json_encode($data);
							}
						
							if($userPropertyCheck == true)
							{ 
							$res = $this->host_model->insert_room($udata1, $udata2, $udata3, $udata4, $udata5);
							
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["property_id"] = $udata5;
								$data["property_room_id"] = $res;
								$data["message"] = "Inserted...";
								// $this->load->view('property_Photo', $data);
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}

	}
	
	
	
	//Property Listing (To update each rooms of Entire apartment)
	/*
	**
	For update-posting form data for to add rooms of Entire apartment  
	*/
	public function updateRooms_post(){	
		
		 $this->form_validation->set_rules('room_name', 'room_name', 'required');
		 $this->form_validation->set_rules('room_type', 'room_type', 'required');
		 $this->form_validation->set_rules('guest_no', 'guest_no', 'required');
		 $this->form_validation->set_rules('details', 'details', 'required');	    
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,			
				'room_name' => strip_tags(form_error('room_name')),
				'room_type' => strip_tags(form_error('room_type')),
				'guest_no' => strip_tags(form_error('guest_no')),
				'details' => strip_tags(form_error('details'))
				);
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			echo json_encode($offerArray);
			//$this->response($offerArray, 400);
		}
		
		else{									
							$udata1 = $this->input->post('room_name');
							$udata2 = $this->input->post('room_type');							
							$udata3 = $this->input->post('guest_no');
							$udata4 = $this->input->post('details');
							$udata5 = $this->input->post('property_id');
							$udata6 = $this->input->post('user_id');							
						
							//$udata8 = $this->input->post('property_id');
							$userCheck=$this->host_model->user_exists($udata6);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
							//$this->response($data, 400);							
							echo json_encode($data);
						}  
						if ($userCheck==true)
						{ 	
							$userPropertyCheck=$this->host_model->property_check($udata5);
							
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								//$this->response($data, 400);
								echo json_encode($data);
							}
						
							if($userPropertyCheck == true)
							{ 
							$res = $this->host_model->updateRoom($udata1, $udata2, $udata3, $udata4, $udata5);
							
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["property_id"] = $udata5;
								$data["property_room_id"] = $res;
								$data["message"] = "Inserted...";
								// $this->load->view('property_Photo', $data);
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}

	}
	
	
	//Step 3: uploading photos
	//For posting form data from Host Property photo uploading 
	//MULTIPLE IMAGE UPLOAD
	function do_upload_post() {
	
			$records = array();
			$rec=array();
			
			$count = count($_FILES['userfile']['size']);
			$propertyId = $this->input->post('property_id');
			$caption = $this->input->post('caption');
			$videoID = $this->input->post('videoId');
	
		$userPropertyCheck=$this->host_model->property_check($propertyId);
		if($userPropertyCheck == false)
		{
				$data= array();
				$data["status"] = 400;
				$data["error"]= true;
				$data["message"] = "Property_id not found!!!";
				echo json_encode($data);
			
		}
		if($userPropertyCheck == true)
		{
			foreach($_FILES as $key=>$value)
		
			for($s=0; $s<$count; $s++) {
				$_FILES['userfile']['name']=$value['name'][$s];	
				$_FILES['userfile']['type']    = $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']       = $value['error'][$s];
				$_FILES['userfile']['size']    = $value['size'][$s];  
				
				$config = array();
				$config['upload_path'] = './uploads/property_image/';
				$config['allowed_types'] = 'gif|jpg|png';		
				$config['max_size']	= '2000';
				$config['max_width']  = '3024';		
				$config['max_height']  = '3024';
				$this->upload->initialize($config);	
				

					
				//image validation part
				if ( ! $this->upload->do_upload())
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode($error);	
					
				}
				else				
				{										
						//$uploadedDetails    = $this->upload->data();
						
						$uploadedDetails = array('upload_data' => $this->upload->data());
										
						$upload_data = $this->upload->data();
						$name = $upload_data['file_name'];											
						$records[] = array('images' => $name, 'description' => $caption[$s], 'property_id' => $propertyId);
						
				}	
			
					
			}
					//get the images on array and insert it to database
					$res = $this->host_model->insert_images($records);		
					
					if($res)
					{			
							//if host-user doesn't put video id 
							if(empty($videoID)){
							
								$response["error"] = "false";
								$response["message"] = "inserted ...";
								echo json_encode($response);
								//$this->load->view('Property_Listing');
							}
							else{							
							$rec[] = array('youtube_video_id' => 'https://www.youtube.com/watch?v='.$videoID, 'property_id' => $propertyId);
							$link = 'https://www.youtube.com/watch?v='.$videoID;
							$ress = $this->host_model->insert_video($rec);
						
								if($ress)
								{
											 
								$response["error"] = "false";
								$response["video_link"] = $link;
								$response["message"] = "inserted";
								$response["video_id"] = $ress;
								echo json_encode($response);								
								//$this->load->view('Property_Listing');
								}
							}
					}

		}
		
	}
	
	
	

	
	//extracting amenities for amenities property page
	//this method is use in Property amenities pages for listing amenities type with each subtype
	public function getAmenities_get(){
		$data = array();

		$data['extra'] = $this->host_model->extraType();
		$data['feature'] = $this->host_model->featureType();	
		$data['common'] = $this->host_model->commonType();
		$data['safety'] = $this->host_model->safetyType();
		echo json_encode($data);		

	}
	
	
	//Property Listing step 4 (Inserting amenities)
	//this method is use to insert multiple amenities from host property amenities pages
	public function insertPropertyAmenities_post(){
	//inserting amenities of property
	
		$user_property_id = $this->input->post('property_id');
		$amenities_id = $this->input->post('amenities');
		$this->form_validation->set_rules('amenities', 'select 1 or more', 'required');	    
		if($this->form_validation->run()==FALSE)    
		{	
			$message['message'] = 'Please select the amenities';
			echo json_encode($message);
		}
		else{
				$records = array();
				for($i=0; $i < count($amenities_id); $i++){
				$records[] = array('property_id' => $user_property_id, 'amenities_id' => $amenities_id[$i]);		
				}
				
				$userPropertyCheck=$this->host_model->property_check($user_property_id);
								
	  				if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								echo json_encode($data);
								//$this->response($data, 400);
							}
							
							if($userPropertyCheck == true)
							{
								//insertTableData($table_name,$ins_data)
								$res = $this->host_model->insert_amenities($records);
								//$res = $this->common_model->insertTableData('property_amenities', $records);
								if($res)
								{
								
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted...";
								//echo json_encode($data);
								$this->HostPropertyListing_get();
								//$this->load->view('property_ListingListing');
								
								}
						}
		}
	}
	
	
	
	
		
		
		
		
	//Property Listing step 5 (Listing Info)
	/*
	**
	This method is use to post form data from Host property listing info pages
	*/
	public function propertyListinginfo_post(){	
	
		
		 $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required');
		 $this->form_validation->set_rules('guest', 'guest', 'required|numeric');
		 $this->form_validation->set_rules('bedrooms', 'bedrooms', 'required|numeric');
		 $this->form_validation->set_rules('beds', 'beds', 'required|numeric');	
		 $this->form_validation->set_rules('bathrooms', 'bathrooms', 'required|numeric');
		 $this->form_validation->set_rules('check_in', 'Check in', 'required');	 
		 $this->form_validation->set_rules('check_out', 'Check out', 'required');	
		if($this->form_validation->run()==FALSE)    #3
		{			
			$arr = array(
				'status' => 400,
				'error' => true,				
			
				'room_type_id' => strip_tags(form_error('room_type_id')),
				'guest' => strip_tags(form_error('guest')),
				'bedrooms' => strip_tags(form_error('bedrooms')),
				'beds' => strip_tags(form_error('beds')),
				'bathrooms' => strip_tags(form_error('bathrooms')),
				'check_in' => strip_tags(form_error('check_in')),
				'check_out' => strip_tags(form_error('check_out'))
				);
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			echo json_encode($offerArray);
			
		}
		
		else{									
							
							$udata1 = $this->input->post('property_type_id');
							$udata2 = $this->input->post('room_type_id');							
							$udata3 = $this->input->post('guest');
							$udata4 = $this->input->post('bedrooms');
							$udata5 = $this->input->post('beds');
							$udata6 = $this->input->post('bathrooms');
							$udata7 = $this->input->post('check_in');
							$udata8 = $this->input->post('check_out');
							$udata9 = $this->input->post('user_id');
							$udata10 = $this->input->post('property_id');
			
						$userCheck=$this->host_model->user_exists($udata9);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
							//echo json_encode($data);
							$this->response($data, 400);							
						}
						
						if ($userCheck==true)
						{	
							$userPropertyCheck=$this->host_model->property_check($udata10);
						
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								//echo json_encode($data);
								$this->response($data, 400);
							}
							
							if($userPropertyCheck == true)
							{
							$res = $this->host_model->insert_listing_info($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7, $udata8, $udata9, $udata10);
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted...";
								echo json_encode($data);
												
								}
							}							
						}
			}

	}	
	
	//extracting all country 
	//this api will use in location drop down of property location page
	function getCountry_get(){
		$data = $this->host_model->extractCountry();	
		echo json_encode($data);		
	}
	
	//extracting all state
	function getState_get(){
		$data = $this->host_model->extractState();	
		echo json_encode($data);		
	}


	//Property Listing step 6 (Property Address)
	/*
	**
	this method is use to post form data from HOST property location pages
	*/
	public function propertyAddress_post(){	
	
		 $this->form_validation->set_rules('address_line1', 'address_line1', 'required');
		 $this->form_validation->set_rules('address_line2', 'address_line2', 'required');
		 $this->form_validation->set_rules('country', 'country', 'required');
		 $this->form_validation->set_rules('state', 'state', 'required');
		 $this->form_validation->set_rules('city', 'city', 'required');	
		 $this->form_validation->set_rules('area', 'area', 'required');
		 $this->form_validation->set_rules('zip', 'zip', 'required');	 
		 $this->form_validation->set_rules('latitude', 'latitude', 'required');
		 $this->form_validation->set_rules('longitude', 'longitude', 'required');
		
		if($this->form_validation->run()==FALSE)    #3
		{			
			$arr = array(
				'status' => 400,
				'error' => true,				
				'address_line1' => strip_tags(form_error('address_line1')),
				'address_line2' => strip_tags(form_error('address_line2')),
				'country' => strip_tags(form_error('country')),
				'state' => strip_tags(form_error('state')),
				'city' => strip_tags(form_error('city')),
				'area' => strip_tags(form_error('area')),
				'zip' => strip_tags(form_error('zip')),
				'latitude' => strip_tags(form_error('latitude')),
				'longitude' => strip_tags(form_error('longitude'))
				);
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			echo json_encode($offerArray);
			//$this->response($offerArray, 400);
		}
		
		else{									
							
							$udata1 = $this->input->post('address_line1');
							$udata2 = $this->input->post('address_line2');							
							$udata3 = $this->input->post('country');
							$udata4 = $this->input->post('state');
							$udata5 = $this->input->post('city');
							$udata6 = $this->input->post('area');
							$udata7 = $this->input->post('zip');
							$udata8 = $this->input->post('latitude');
							$udata9 = $this->input->post('longitude');							
							$udata10 = $this->input->post('user_id');
							$udata11 = $this->input->post('property_id');
							$userCheck=$this->host_model->user_exists($udata10);
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
							echo json_encode($data);
							//$this->response($data, 400);							
						}
						if ($userCheck==true)
						{	
							$userPropertyCheck=$this->host_model->property_check($udata11);
						
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								//echo json_encode($data);
								$this->response($data, 400);
							}
							
							if($userPropertyCheck == true)
							{
							$res = $this->host_model->insert_address($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7, $udata8, $udata9, $udata10, $udata11);
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted...";
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							
							}							
						}
			}

	}

	
	//Property Listing step 7 (Property Pricing)
	/*
	**
	this method is use to post form data from Host property pricing pages
	(this method is use for pre approval price setting)
	*/
	 
	public function Propertypricing_post(){	
		 
		 $this->form_validation->set_rules('season1_daily', 'daily price', 'required');
		 $this->form_validation->set_rules('season1_weekly', 'weekly price', 'required');
		 $this->form_validation->set_rules('season1_monthly', 'monthly price', 'required');
		 $this->form_validation->set_rules('season1_weekend', 'monthly price', 'required');
		 			
		if($this->form_validation->run()==FALSE)
		{			
			
			$arr = array(
				'status' => 400,
				'error' => true,
					
				'season1_daily' => strip_tags(form_error('season1_daily')),
				'season1_weekly' => strip_tags(form_error('season1_weekly')),
				'season1_monthly' => strip_tags(form_error('season1_monthly')),
				'season1_weekend' => strip_tags(form_error('season1_weekend')),
			
				);
			
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			
			echo json_encode($offerArray);
			
		}
		
		else{			
							//$udata1 = array();
							$udata1 = $this->input->post('season1_daily');
							$udata2 = $this->input->post('season1_weekly');							
							$udata3 = $this->input->post('season1_monthly');
							$udata4 = $this->input->post('season1_weekend');
							
							$clean_charge = $this->input->post('clean_charge');
							$guest_charge = $this->input->post('guest_charge');
							
							$security_charge = $this->input->post('security_charge');
							
							$user = $this->input->post('user_id');
							$property_id = $this->input->post('property_id');
							
							
						//$records = array('Price' => $data, 'season_type' => 'Season '.$j, 'period' => 'daily', 'user_property_id' => $property_id);
						$DataIns = array(
										array(
												'price' => $udata1,
												'master_price_period_id' => '1',
												'master_price_seasontype_id' => '1',
												'property_id' => $property_id
											),
										array(
												'price' => $udata2,
												'master_price_period_id' => '2',
												'master_price_seasontype_id' => '1',
												'property_id' => $property_id
											),
										array(
												'price' => $udata3,
												'master_price_period_id' => '3',
												'master_price_seasontype_id' => '1',
												'property_id' => $property_id
											),
										array(
												'price' => $udata4,
												'master_price_period_id' => '4',
												'master_price_seasontype_id' => '1',
												'property_id' => $property_id
											)
									);
									
						$userCheck=$this->host_model->user_exists($user);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							$data["error"]= true;
							$data["message"] = "user doesn't exists";
							echo json_encode($data);
							//$this->response($data, 400);							
						}
						if ($userCheck==true)
						{	
							$userPropertyCheck=$this->host_model->property_check($property_id);
						
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!!";
								
								//echo json_encode($data);
								//$this->response($data, 400);
							}
							
							if($userPropertyCheck == true)
							{
							$res = $this->host_model->insert_prePrice('property_price', $DataIns);
							//print_r($res);
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted...";
								//echo json_encode($data);
								$this->Propertyadditionalcharge($clean_charge, $guest_charge, $security_charge, $property_id);
								//$this->response($data, 200);					
								}
							
							}							
						}
			}

	}
	
	
	/*
	**
	Passing parameters from PreSeasonalPricing method to this methods
	Inserting extra charge details from Host property pricing page.
	*/
	public function Propertyadditionalcharge($clean_charge, $guest_charge,$security_charge, $propId){		
							
																					
							$res = $this->host_model->insert_ExtraPrice($clean_charge, $guest_charge, $security_charge, $propId);
							//$res = $this->hostproperty_model->insert_ExtraPrice('user_property', $records, $propId);
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted...";
								echo json_encode($data);
											
								}						
	}
	
	
}
?>