<?php
if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

class Host extends Host_Generic_Controller
{
    
    private $fbUser;

	function __construct()
	{	
		parent::__construct();	
		$this->load->helper(array('form', 'url', 'cookie', 'io_format'));
        
        $this->config->load('property_listing_image'); 
        
        $this->load->library(array(
            'session',
            'form_validation',
            'upload',
            'image_lib',
            'googleplus',
            'pagination',
        ));

        $this->load->library('facebook_lib', array(
            'appId' => '1612651935651661',
            'secret' => '30170ca7c0ba0e396d6e32bb0c9ea66e',            
            'permissions' => array('public_profile', 'email'),
        ));
        
        $this->load->model('host_model');
        $this->load->model('home/home_model');
		$this->load->model('notification/notification_model');
		$this->load->model('transaction_notification/transaction_notification_model');
		
		$this->load->helper('email_helper');
		$this->viewData['fbLogoutUrl'] = $this->facebook_lib->getLogoutUrl(array('next' =>site_url('home/logout/facebook'), 'access_token' => $this->facebook_lib->getAccessToken()));
	}

	public function isAuthenticated()
    {
        if ($this->session->userdata('user')) {
            /**
             * user is in session
             * mark him as authenticated
             */
            return true;
        }
        
        return false;
    }
	
	//this function will check the successful insertion of form status of each part of form tab
	//to display green tick for succssful insertion of form of particular property_id
	function checkStatustab($property_id = NULL)
	{
		$data = $this->host_model->extractStatustab($property_id);
		echo json_encode($data);
	
	}
	
	//extracting room type
	//this function is for drop down list of room type
	public function getRoomtype(){		
		$data = $this->host_model->extractRomType();	
		echo json_encode($data);			
	}

	
	//extracting property type
	//this function is for drop down list of property type
	public function getPropertytype(){		 
		$data = $this->host_model->extractProperType();				
		echo json_encode($data);		
	}
	
	//extracting city
	//this function is for auto search of city 
	public function getCity(){		 
		$data = $this->host_model->ExtractCity();
		echo json_encode($data);			
	}

	//to load and view the Create property page(Host Listing page)
	function createproperty()
	{
		$til["title"] = "Create Property";
        
        if ($this->isAuthenticated()) {
			$sessionUserData = $this->session->userdata('user');
            $til['host_id'] = $sessionUserData['user_id'];
		}
        
		$til = array_merge($til, $this->viewData);
		$this->load->view('create_property', $til);
	}

	
	
	//to view host property listing in one page 
	
    
	//to load location state and city
	public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		//$this->load->host_model('model');
		$result=$this->host_model->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}

	
	/*--------------------------------Property Listing step 1 ---------------------------------------*/
	/*
	**	
	For posting form data from Host Property Listing 
	1st step of creating property by host user
	*/
	public function Createhostproperty(){	
	
		 $this->form_validation->set_rules('property_type_id', 'Property type', 'required|numeric');
		 $this->form_validation->set_rules('room_type_id', 'Room type', 'required|numeric');
		 $this->form_validation->set_rules('accommodates', 'guest no', 'required');
		 $this->form_validation->set_rules('city', 'city', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{
			$arr = array(
				'status' => 400,
				'error' => true,
				'property_type_id' => form_error('property_type_id', '<span style="color: #EA1B64; font-weight: bold;">', '</span>'),
				'room_type_id' => form_error('room_type_id', '<span style="color: #EA1B64; font-weight: bold;">', '</span>'),
				'accommodates' => form_error('accommodates', '<span style="color: #EA1B64; font-weight: bold;">', '</span>'),
				'city' => form_error('city', '<span style="color: #EA1B64; font-weight: bold;">', '</span>'),
				
				);
			
			$this->session->set_flashdata('errors', $arr);
			redirect('host/createProperty');
		}
		else{														
			$udata1 = $this->input->post('property_type_id');
			$udata2 = $this->input->post('room_type_id');							
			$udata3 = $this->input->post('accommodates');
			$udata4 = $this->input->post('city');
			$hostId = $udata5 = $this->input->post('user_id');
			
			$userCheck=$this->host_model->user_exists($udata5);
							
			if($userCheck == false)
			{					
				$data= array();
				$data["status"] = 400;
				$data["error"]= true;
				$data["message"] = "Please Sign in ....";
				//$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
				//$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');
				//echo json_encode($data);
				$this->session->set_flashdata('auth_text', $data, TRUE);
				redirect('host/createproperty');
											
			}
			if ($userCheck==true)
			{						
																		
				$udata4Arr = explode(', ', $udata4);
				$udata4 = $udata4Arr[0];
				//check input city
				$cityCheck = $this->host_model->city_check($udata4);
				if($cityCheck)
				{
					foreach($cityCheck as $r)
					{
						$city = $r->id;
					}
					$res = $this->host_model->create_property($udata1, $udata2, $udata3, $city, $udata5);

				if($res){							
					$data= array();
					$data["status"] = 200;
					$data["error"]= false;
					$propertyId = $data["property_ID"] = $res;
					$data["user_id"] =$udata5;
					$data["message"] = "You've Created Your Listing";
					
					
					// create child properties if room type was not shared                               
					if (2 != $udata2) {
						$roomCount = $this->input->post('no_of_rooms');
						$childPropertiesData = '';
						
						for ($i = 0; $i < $roomCount; $i++) {
							$childPropertiesData[] = array(
								'parent_id' => $propertyId,
								'user_id' => $hostId,
								'room_type_id' => $udata2,
								'property_type_id' => $udata1,
								'guest_allow' => $udata3,
								'city_id' => $udata4,
								'status' => 'Inactive',
							);
						}
						
						$this->host_model->createChildProperties($childPropertiesData);                   
					}
					
					redirect("host/propertylisting/$propertyId");
				}
				else{
					$data= array();
					$data["status"] = 500;
					$data["error"]= true;								
					$data["message"] = "Opps!!! something wrong";
					echo json_encode($data);
					//$this->response($data, 500);
				}
				
				}
				else{
					$data= array();
					$data["status"] = 400;
					$data["error"]= true;								
					$data["message"] = "City not found!!! Your city is not in our list";
					
					$this->session->set_flashdata('city_error', $data);
					redirect('host/createProperty');
				}
			}				
		}
	}
    
    public function browseToNextChildProperty($propertyId)
    {
        //$propertyId = $this->input->post('propertyId');
        $allChildPropertyIds = $this->input->post('allChildPropertyIds');
        $visitedChildPropertyIds = $this->input->post('visitedChildPropertyIds');
        //$nextChildPropertyIds = $this->input->post('nextChildPropertyIds');
        
        //$nextChildPropertyIds = explode(',', $nextChildPropertyIds);
        //$propertyId = array_shift($nextChildPropertyIds);
        //$nextChildPropertyIds = implode(',', $nextChildPropertyIds);
        
        $data = array(
            'allChildPropertyIds' => $allChildPropertyIds,
            'property_ID' => $propertyId,
            'visitedChildPropertyIds' => $visitedChildPropertyIds,
        );
        
        $this->session->set_flashdata('property_id', $data);
        
        $this->jsonResponse(array('status' => '200'));
    }
	
	//Property Listing step 2
	/*
	**
	For posting form data from Host Property Overview page 
	*/
	public function Propertyoverview(){	
		
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
	public function getRoomtypeapartment(){	
			$data = $this->host_model->extractRoomTypeApartment();				
			echo json_encode($data);	
	}	
	
	
	
	//extract all the rooms for entire apartment that host-user were inserted.
	//this function is to extract all the details of each rooms of particular entire apartment
	public function getAllPropertyrooms($property_id = NULL){
			//$property_id = $this->get('property_id');
			$data = $this->host_model->extractPropertyRooms($property_id);				
			echo json_encode($data);	
	}
	


	//Property Listing (apartment to add rooms)
	/*
	**
	For posting form data for to add rooms of apartment  
	*/
	public function addRooms(){	
		
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
								$data["room_id"] = $res;
								$data["message"] = "Inserted...";
								// $this->load->view('property_Photo', $data);
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}

	}
	
	
	
	//Property Listing (To update each rooms of apartment)
	/*
	**
	For update-posting form data for to add rooms of apartment  
	*/
	public function updateRooms(){	
		
		 $this->form_validation->set_rules('room_name', 'room_name', 'required');
		 $this->form_validation->set_rules('room_type_id', 'room_type', 'required');
		 $this->form_validation->set_rules('guest_no', 'guest_no', 'required');
		 $this->form_validation->set_rules('details', 'details', 'required');
		 $this->form_validation->set_rules('room_id', 'room id', 'required');	    
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,			
				'room_name' => strip_tags(form_error('room_name')),
				'room_type_id' => strip_tags(form_error('room_type')),
				'guest_no' => strip_tags(form_error('guest_no')),
				'room_id' => strip_tags(form_error('room_id')),
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
							$udata7 = $this->input->post('room_id');							
						
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
							$res = $this->host_model->updateRoom($udata1, $udata2, $udata3, $udata4, $udata5, $udata7);
							
							if($res){							
								$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["property_id"] = $udata5;
								//$data["property_room_id"] = $res;
								$data["message"] = "Updated...";
								// $this->load->view('property_Photo', $data);
								echo json_encode($data);
								//$this->response($data, 200);					
								}
							}
						}
			}

	}

	//Property Listing (To delete rooms of apartment)
	/*
	**
	For deleting each rooms of apartment  
	*/
	function removeRoom($room_id = NULL)
	{
		$roomCheck = $this->host_model->checkRoom($room_id);
		
		if($roomCheck == true)
		{
			$del = $this->host_model->delRoom($room_id);
			//print_r($del);
			//$res = $this->response($del, 200);		
			if($del){
				
				$data["status"]= 200;
				$data["message"] = "deleted successfully";
				echo json_encode($data);
				//$this->response($data, 200);
			}
		}	
			
		else{
			$data["status"]= 400;
			$data["message"] = "room_id not found";
			echo json_encode($data);
		
		}
	}

	
	
	//Step 3: uploading photos
	//For posting form data from Host Property photo uploading 
	//MULTIPLE IMAGE UPLOAD
	function uploadImages() {
	
			$records = array();
			$rec=array();
			$error='';
			$uploadedDetails ='';
			//$error['error'] = array();
			
			//check empty file
			if (empty($_FILES['userfile']['name']))
			{
    			$this->form_validation->set_rules('userfile', 'Document', 'required');
    			
    			$data = array('status' => 400,
    				'message' => 'Please Select photos...');
    			echo json_encode($data);
			}
			
			else{

					$count = count($_FILES['userfile']['size']);
					$propertyId = $this->input->post('property_id');
					$caption = $this->input->post('caption');
					$videoID = $this->input->post('videoId');
			
		
					//check property_id exist or not
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
						//youtube id validation
						$baseUrl = "https://www.googleapis.com/youtube/v3/videos?id=".$videoID."&key=AIzaSyAolDIxJxBGJijjtZFO7wDN4Oh-W2rp_V4&part=snippet";                    
			            //$jsonData = file_get_contents($baseUrl); 
			            //$jsonDataObject = json_decode($jsonData);
			        
			            //valid youtube id
			            if(1)
			            {
			            	//process images

								foreach($_FILES as $key=>$value)
								
								for($s=0; $s<$count; $s++) {
									$_FILES['userfile']['name']=$value['name'][$s];	
									$_FILES['userfile']['type']    = $value['type'][$s];
									$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
									$_FILES['userfile']['error']       = $value['error'][$s];
									$_FILES['userfile']['size']    = $value['size'][$s];  
									
									
									//$this->load->library('image_lib');
									
									//original image
									
									$config = array();
									$config['upload_path'] = './public/uploads/property_image/';
									$config['allowed_types'] = 'gif|jpg|png';		
									$config['max_size']	= '5000';
									$config['max_width']  = '3000';		
									$config['max_height']  = '1800';
									$this->upload->initialize($config);
										
									//!$this->upload->do_upload('userfile',$k)
										
									//image validation part
									if (!$this->upload->do_upload())
									{
										//$uploadedDetails    = $this->upload->data();
											
										
										$error = strip_tags($this->upload->display_errors());


									}
									//store valid images in server (store images name, caption and property id in array)
									else				
									{										
										
										$uploadedDetails = array('upload_data' => $this->upload->data());													
										$upload_data = $this->upload->data();
										$name = $upload_data['file_name'];											
										$records[] = array('images' => $name, 'description' => $caption[$s], 'property_id' => $propertyId);
																	
								        
									}	
								
										
								}

								//if images contain valid image 
								if($error == null)
								{
								    $rec1 = array();
									$rec1[] = array('youtube_video_id' => 'https://www.youtube.com/watch?v='.$videoID, 'property_id' => $propertyId);
									//$link = 'https://www.youtube.com/watch?v='.$videoID;
									//pass the parameters to function
									$this->insertImages($records, $rec1);
									
								}
								else
								{
									$response['status'] = 400;
									$response['message'] = $error;
									echo json_encode($response);
								}	
								
								
								
								
						}
						
						//youtube id not exist
						else
						{

												$response["error"] = "false";
												$response["status"] = 400;
												$response["message"] = "Invalid Youtube ID, Please provide valid ID";

												echo json_encode($response);
						}
								//get the images on array and insert it to database
									

					}

			}		
	}




	private function insertImages($records, $rec1)
	{
		$res = $this->host_model->insert_images($records);		
					
					if($res)
					{		
						$ress = $this->host_model->insert_video($rec1);
						
								if($ress)
								{
											 
								$response["error"] = "false";
								$response["status"] = 200;
								//$response["video_link"] = $link;
								$response["message"] = "Inserted!! proceed to next";
								//$response["video_id"] = $ress;
								echo json_encode($response);								
								//$this->load->view('Property_Listing');
								}
	
						
					}
					
					
	}

	
	
	

	
	//extracting amenities for amenities property page
	//this method is use in Property amenities pages for listing amenities type with each subtype
	public function getAmenities(){
		$data = array();

		$data['extra'] = $this->host_model->extraType();
		$data['feature'] = $this->host_model->featureType();	
		$data['common'] = $this->host_model->commonType();
		$data['safety'] = $this->host_model->safetyType();
		echo json_encode($data);		

	}
	
	
	//Property Listing step 4 (Inserting amenities)
	//this method is use to insert multiple amenities from host property amenities pages
	public function insertAmenities(){
	//inserting amenities of property
	
		$user_property_id = $this->input->post('property_id');
		$amenities_id = $this->input->post('amenities');
		$this->form_validation->set_rules('amenities', 'select 1 or more', 'required');	    
		if($this->form_validation->run()==FALSE)    
		{	
			$data= array();
			$data["status"] = 400;
			$data["error"]= true;
			$data['message'] = 'Please select the amenities';
			echo json_encode($data);
		}
		else{
				//$amenities_id = $this->input->post('amenities');
				$records = array();
				for($i=0; $i < count($amenities_id); $i++){
				$records[] = array('property_id' => $user_property_id, 'amenities_id' => $amenities_id[$i]);		
				}
				//$user_property = "user_property";
				// check_duplicate($table_name,$where)
				// $userPropertyCheck=$this->common_model->check_duplicate('user_property', $user_property_id['user_property_id'] );
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
								$data["message"] = "Inserted, Proceed to next Step";
								echo json_encode($data);
								//$this->HostPropertyListing_get();
								//$this->load->view('property_ListingListing');
								
								}
						}
		}
	}
	
	
	//extract cancellation policy type
	public function getCancellationpolicy(){
		$data = $this->host_model->getPolicy();
		echo json_encode($data);
	}
	
	//extract tags
	public function getTags(){
		$data = $this->host_model->getTag();
		echo json_encode($data);
	}
	
		
		
		
		
	//Property Listing step 5 (Listing Info)
	/*
	**
	This method is use to post form data from Host property listing info pages
	*/
	public function insertListinginfo(){	
							
							
				
		 
		 $this->form_validation->set_rules('property_type_id', 'property_type_id', 'required');
		 $this->form_validation->set_rules('room_type_id', 'room_type_id', 'required');
		 $this->form_validation->set_rules('guest', 'guest', 'required|numeric');
		 $this->form_validation->set_rules('bedrooms', 'bedrooms', 'required|numeric');
		 $this->form_validation->set_rules('beds', 'beds', 'required|numeric');	
		  $this->form_validation->set_rules('tag', 'tag', 'required');	
		 $this->form_validation->set_rules('policy','policy', 'required|numeric');
		 $this->form_validation->set_rules('bathrooms', 'bathrooms', 'required|numeric');
		 $this->form_validation->set_rules('check_in', 'Check in', 'required');	 
		 $this->form_validation->set_rules('check_out', 'Check out', 'required');	
		if($this->form_validation->run()==FALSE)    #3
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				//type 1 for validation
				'type' => 1,	
				'property_type_id' => strip_tags(form_error('property_type_id')),
				'room_type_id' => strip_tags(form_error('room_type_id')),
				'guest' => strip_tags(form_error('guest')),
				'policy' => strip_tags(form_error('policy')),
				'tag' => strip_tags(form_error('tag')),
				'bedrooms' => strip_tags(form_error('bedrooms')),
				'beds' => strip_tags(form_error('beds')),
				'bathrooms' => strip_tags(form_error('bathrooms')),
				'check_in' => strip_tags(form_error('check_in')),
				'check_out' => strip_tags(form_error('check_out'))
				);
			/*$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}*/				
			echo json_encode($arr);
			//$this->HostPropertyListing_get();
			//$this->response($offerArray, 400);
		}
		
		else{									
							$tags_id = $this->input->post('tag');
							
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
							$udata11 = $this->input->post('policy');
							
							
							
							
						$userCheck=$this->host_model->user_exists($udata9);
						
						if($userCheck == false)
						{					
							$data= array();
							$data["status"] = 400;
							//type 2 for user not found
							$data["type"] = 2;
							$data["error"]= true;
							$data["message"] = "user doesn't exists, need to sign up";
							echo json_encode($data);
							//$this->response($data, 400);							
						}
						if ($userCheck==true)
						{	
							$userPropertyCheck=$this->host_model->property_check($udata10);
						
							if($userPropertyCheck == false)
							{
								$data= array();
								$data["status"] = 400;
								//type 3 for property_id not found
								$data["type"] = 3;
								$data["error"]= true;
								$data["message"] = "Property_id not found!!! You haven't created 1st Step.";
								echo json_encode($data);
								//$this->response($data, 400);
							}
							
							if($userPropertyCheck == true)
							{
							$res = $this->host_model->insert_listing_info($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7, $udata8, $udata9, $udata10, $udata11);
							if($res){							
								/*$data= array();
								$data["error"]= false;
								$data["status"] = 200;
								$data["message"] = "Inserted, Proceed to next step";
								echo json_encode($data);
								*/
								$records = array();
								for($i=0; $i < count($tags_id); $i++){
								$records[] = array('property_id' => $udata10, 'master_tag_id' => $tags_id[$i]);		
								}	
								$this->insertTags($records);
								//$this->HostPropertyListing_get();
								//$this->response($data, 200);					
								}
							}							
						}
			}

	}	
	
	//inserting property tags
	public function insertTags($records){
	
				$res = $this->host_model->insertTag($records);
					if($res)
					{
											$data= array();
											$data["error"]= false;
											//type 4 for successful insertion
											$data["type"] = 4;
											$data["status"] = 200;
											$data["message"] = "Inserted, Proceed to next step";
											echo json_encode($data);
					}
	
	}
	
	//extracting all country 
	function getCountry(){
		$data = $this->host_model->extractCountry();	
		echo json_encode($data);		
	}
	
	//extracting all state
	function getState(){
		$data = $this->host_model->extractState();	
		echo json_encode($data);		
	}
	function getStatecountry(){
		$country_id = $this->get('country_id');
		$data = $this->host_model->extractStateCountry($country_id);
		echo json_encode($data);
	}


	//Property Listing step 6 (Property Address)
	/*
	**
	this method is use to post form data from HOST property location pages
	*/
	public function insertLocation(){	
	
		 $this->form_validation->set_rules('address_line1', 'address line 1', 'required');
		 $this->form_validation->set_rules('address_line2', 'address line 2', 'required');
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
								echo json_encode($data);
								//$this->response($data, 400);
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
	http://104.215.198.240/rentnroam/host/PreSeasonalPricing
	this method is use to post form data from Host property pricing pages
	(this method is use for pre approval price setting)
	*/
	 
	public function insertPreseasonalprice(){	
		 
		 $this->form_validation->set_rules('season1_daily', 'daily price', 'required|numeric');
		 $this->form_validation->set_rules('season1_weekly', 'weekly price', 'required|numeric');
		 $this->form_validation->set_rules('season1_monthly', 'monthly price', 'required|numeric');
		 $this->form_validation->set_rules('season1_weekend', 'monthly price', 'required|numeric');
		 
		 $this->form_validation->set_rules('clean_charge', 'cleaning fee', 'numeric');			
		 $this->form_validation->set_rules('guest_charge', 'additional guest charge', 'numeric');
		 $this->form_validation->set_rules('security_charge', 'security fee', 'numeric');
		 
		if($this->form_validation->run()==FALSE)
		{			
			
			$arr = array(
				'status' => 400,
				'error' => true,
					
				'season1_daily' => strip_tags(form_error('season1_daily')),
				'season1_weekly' => strip_tags(form_error('season1_weekly')),
				'season1_monthly' => strip_tags(form_error('season1_monthly')),
				'season1_weekend' => strip_tags(form_error('season1_weekend')),
				
				'clean_charge' => strip_tags(form_error('clean_charge')),
				'guest_charge' => strip_tags(form_error('guest_charge')),
				'security_charge' => strip_tags(form_error('security_charge')),
			
				);
			/*
			$offerArray = array();	
			foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}				
			*/
			echo json_encode($arr);
			//$this->response($offerArray, 400);
			
			//$this->HostPropertyListing_get();
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
							$res = $this->host_model->insert_prePrice('properties_price', $DataIns);
							//print_r($res);
							if($res){							
								
								$this->Propertyadditionalcharge($clean_charge, $guest_charge, $security_charge, $property_id);
												
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
								$data["message"] = "Inserted, Proceed to next Step";
								echo json_encode($data);
								//$this->HostPropertyListing_get();
								//$this->response($data, 200);					
								}						
	}
	
	
    
    /**
     * new methods start
     */
    
    public function propertylisting($propertyId)
	{
        // check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('host/createproperty'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

    	// check if valid property
        if (! $propertyId) {
    		redirect(site_url('host/createproperty'));
    	}
        
    	if (! $this->host_model->isPropertyExist($propertyId)) {
    		redirect(site_url('host/createproperty'));
    	}

        // fetch necessary data
    	$countries = $this->host_model->fetchCountries();        
        $amenities = $this->host_model->fetchAmenities();        
        $propertyTypes = $this->host_model->fetchPropertyTypes();        
        $roomTypes = $this->host_model->fetchRoomTypes();        
        $policies = $this->host_model->fetchCancellationPolicies();        
        $tags = $this->host_model->fetchTags();
        $seasonTypes = $this->host_model->fetchSeasonTypes();        
        $periodTypes = $this->host_model->fetchPeriodTypes();
        $childPropertyData = array();
        
        // fetch property data
        $propertyData = $this->host_model->fetchPropertyEditdetailsById($propertyId);
        
        if ($propertyData[0]->child_properties) {
            // fetch data for all child properties/rooms
            $childPropertyData = $this->host_model->fetchChildPropertyDataByParentId($propertyId);
        }

        // fetch other location data
        $states = $this->host_model->fetchStatesByCountryId($propertyData[0]->country_id);
        $cities = $this->host_model->fetchCitiesByStateId($propertyData[0]->state_id);
        
        // fetch property listing tab statuses
        $tabData = $this->host_model->fetchPropertyListingTabStatuses($propertyId);
        $tabs = (isset($tabData->tabs)) ? ((false !== strpos($tabData->tabs, ',')) ? explode(',', $tabData->tabs) : array($tabData->tabs)) : array();
        $tabStatuses = (isset($tabData->tab_statuses)) ? ((false !== strpos($tabData->tab_statuses, ',')) ? explode(',', $tabData->tab_statuses) : array($tabData->tab_statuses)) : array();
        
        
		// construct view variables
        $data = array(
            'title' => 'Property Listing',
            'countries' => $countries,
            'amenities' => $amenities,
            'propertyTypes' => $propertyTypes,
            'roomTypes' => $roomTypes,
            'policies' => $policies,
            'seasonTypes' => $seasonTypes,
            'periodTypes' => $periodTypes,
            'tags' => $tags,
            'userData' => $sessionUserData,
            'propertyId' => $propertyId,
            'propertyDetails' => $propertyData[0],
            'childPropertyDetails' => $childPropertyData,
            'states' => $states,
            'cities' => $cities,
            'tabs' => $tabs,
            'tabStatuses' => $tabStatuses,
        );
        
        $this->prepareDataForView($data);
        
        $this->load->view('property_listing', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
	}


    /**
     * overview handlers start
     */
    
    public function saveOverview()
    {
        $overviewData = $this->input->post();
        
        if (! $this->host_model->isPropertyExist($overviewData['property_id'])) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: this property with ID $overviewData[property_id] does not exist",
            ));
        }
        
        $overviewSaveData = array(
            'property_title' => $overviewData['title'],
            'description' => $overviewData['description'],
            'neighbourhood_highlight' => $overviewData['neighbourhood'],
            'house_rule' => $overviewData['house_rules'],
            'min_night_stay' => $overviewData['min_night'],
        );
        
        if (! $this->host_model->saveOverview($overviewSaveData, $overviewData['property_id'])) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: overview could not be saved",
            ));
        }
        
        $this->host_model->saveTab($overviewData['property_id'], 1);
        
        $this->jsonResponse(array(
            'status' => '200',
            'message' => "Success: overview saved successfully",
        ));
    }
    
    /**
     * overview handlers end
     */
    
    /**
     * property photo and video
     * upload and save handlers start
     */

    public function uploadFiles()
    {
		$this->load->library('UploadHandler');
    }

    public function checkPhotoUploadParams()
    {
		$propertyId = $this->input->post('property_id') ? (int)$this->input->post('property_id') : null;
		$propertyVideoUrl = $this->input->post('video_id') ? trim($this->input->post('video_id')) : null;
        $videoId = str_ireplace(array('https://www.youtube.com/watch?v=', 'http://www.youtube.com/watch?v='), '', $propertyVideoUrl);
        $embedUrl = "https://www.youtube.com/embed/$videoId";

		if (! $propertyId || ! $this->host_model->isPropertyExist($propertyId)) {
            $this->jsonResponse(array(
                'status' => '500',
                'type' => 'null_property_id_error',
                'message' => "Property with id $propertyId does not exist",
            ));
        }
        
        if (! $this->isYouTubeVideoExist($propertyVideoUrl)) {
            $this->jsonResponse(array(
                'status' => '500',
                'type' => 'wrong_video_id_error',
                'message' => "Not Found: this video $propertyVideoUrl was not found on YouTube",
            ));
        }
        
        
        $embedIframe = "<iframe width='100%' height='315' src='$embedUrl' frameborder='0' allowfullscreen></iframe>";

        $this->jsonResponse(array(
			'status' => '200',
            'embedIframe' => $embedIframe,
		));
	}
    
    private function isYouTubeVideoExist($propertyVideoUrl)
    {
        $propertyVideoJson = "http://www.youtube.com/oembed?url=$propertyVideoUrl&format=json";
        $headers = get_headers($propertyVideoJson);
        $code = substr($headers[0], 9, 3);
        
        return ('404' == $code) ? false : true;
    }
    
    /**
     * property photo and video
     * upload and save handlers end
     */
    
    /**
     * pricing handlers start
     */
    
    public function addPricing()
    {
        $pricings = $this->input->post();
        
        if (! $this->host_model->isPropertyExist($pricings['property_id'])) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: this property with ID $propertyPhotoData[property_id] does not exist",
            ));
        }
        
        $childPropertyList = $this->host_model->fetchChildPropertyListByParentId($pricings['property_id']);
        $childPropertyList = $childPropertyList ? ((false !== strpos($childPropertyList, ',')) ? explode(',', $childPropertyList): array($childPropertyList)) : array();
        
        $pricingData = array();
        
        foreach ($pricings['price'] as $key => $value) {
            $pricingData[] = array(
                'price' => $value,
                'master_price_period_id' => $pricings['master_price_period_id'][$key],
                'master_price_seasontype_id' => $pricings['master_price_seasontype_id'][$key],
                'property_id' => $pricings['property_id'],
            );
        }
        
        if ($childPropertyList) {
            foreach ($childPropertyList as $thisChildProperty) {
                foreach ($pricings['price'] as $key => $value) {
                    $pricingData[] = array(
                        'price' => $value,
                        'master_price_period_id' => $pricings['master_price_period_id'][$key],
                        'master_price_seasontype_id' => $pricings['master_price_seasontype_id'][$key],
                        'property_id' => $thisChildProperty,
                    );
                }
            }
        }
        
        $additionalPricingData = array(
            'clean_charge' => $pricings['clean_charge'],
            'guest_charge' => $pricings['guest_charge'],
            'security_charge' => $pricings['security_charge'],
        );
        
        if (! $this->host_model->savePricing($pricingData, $additionalPricingData, $pricings['property_id'], $childPropertyList)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: pricings could not be saved",
            ));
        }
        
        $this->host_model->saveTab($pricings['property_id'], 3);
        $this->jsonResponse(array(
            'status' => '200',
            'message' => "Success: pricings saved successfully",
        ));
    }


    /**
     * pricing haandlers end
     */
    
    /**
     * amenities handlers start
     */
    
    public function addAmenities()
    {
        $amenitiesData = $this->input->post();
        
        if (! $this->host_model->isPropertyExist($amenitiesData['property_id'])) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: this property with ID $amenitiesData[property_id] does not exist",
            ));
        }
        
        if (! isset($amenitiesData['common_amenities']) && ! isset($amenitiesData['feature_amenities']) && ! isset($amenitiesData['extra_amenities']) && ! isset($amenitiesData['safety_amenities'])) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: no amenities were selected",
            ));
        }
        
        $childPropertyList = $this->host_model->fetchChildPropertyListByParentId($amenitiesData['property_id']);
        $childPropertyList = $childPropertyList ? ((false !== strpos($childPropertyList, ',')) ? explode(',', $childPropertyList): array($childPropertyList)) : array();
        
        $amenitiesSaveData = array();
        
        if (isset($amenitiesData['common_amenities'])) {
            $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['common_amenities'], $amenitiesData['property_id']));
        }
        
        if (isset($amenitiesData['feature_amenities'])) {
            $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['feature_amenities'], $amenitiesData['property_id']));
        }
        
        if (isset($amenitiesData['extra_amenities'])) {
            $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['extra_amenities'], $amenitiesData['property_id']));
        }
        
        if (isset($amenitiesData['safety_amenities'])) {
            $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['safety_amenities'], $amenitiesData['property_id']));
        }
        
        if ($childPropertyList) {
            foreach ($childPropertyList as $thisChildProperty) {
                if (isset($amenitiesData['common_amenities'])) {
            $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['common_amenities'], $thisChildProperty));
        }
        
                if (isset($amenitiesData['feature_amenities'])) {
                    $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['feature_amenities'], $thisChildProperty));
                }

                if (isset($amenitiesData['extra_amenities'])) {
                    $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['extra_amenities'], $thisChildProperty));
                }

                if (isset($amenitiesData['safety_amenities'])) {
                    $amenitiesSaveData = array_merge($amenitiesSaveData, $this->constructAmenitiesData($amenitiesData['safety_amenities'], $thisChildProperty));
                }
            }
        }
        
        if (! $this->host_model->saveAmenities($amenitiesSaveData, $amenitiesData['property_id'], $childPropertyList)) {
            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: amenities could not be saved",
            ));
        }
        
        $this->host_model->saveTab($amenitiesData['property_id'], 4);
        
        $this->jsonResponse(array(
            'status' => '200',
            'message' => "Success: amenities saved successfully",
        ));
    }
    
    private function constructAmenitiesData($amenityTypeData, $propertyId)
    {
        $data = array();
        
        foreach ($amenityTypeData as $value) {
            $data[] = array(
                'property_id' => $propertyId, 
                'amenities_id' => $value,
            );
        }
        
        return $data;
    }
    
    /**
     * amenities handlers end
     */
    
    /**
     * listing handlers start
     */
    
    public function addListing()
    {
        $listingData = $this->input->post('listing');
        $tagsData = $this->input->post('tags');
        
        if (! $this->host_model->isPropertyExist($this->input->post('property_id'))) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: this property with ID " . $this->input->post('property_id') . " does not exist",
            ));
        }
        
        $childPropertyList = $this->host_model->fetchChildPropertyListByParentId($this->input->post('property_id'));
        $childPropertyList = $childPropertyList ? ((false !== strpos($childPropertyList, ',')) ? explode(',', $childPropertyList): array($childPropertyList)) : array();
        
        $tagsSaveData = $this->constructTagsData($tagsData, $this->input->post('property_id'));
        
        if ($childPropertyList) {
            foreach ($childPropertyList as $thisChildProperty) {
                $tagsSaveData = array_merge($tagsSaveData, $this->constructTagsData($tagsData, $thisChildProperty));
            }
        }
        
        if (! $this->host_model->saveListing($listingData, $tagsSaveData, $this->input->post('property_id'), $childPropertyList)) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: listing could not be saved",
            ));
        }
        
        $this->host_model->saveTab($this->input->post('property_id'), 5);
        
        $this->jsonResponse(array(
            'status' => '200',
            'message' => "Success: listing saved successfully",
        ));
    }
    
    private function constructTagsData($tagsData, $propertyId)
    {
        $data = array();
        
        foreach ($tagsData as $value) {
            $data[] = array(
                'property_id' => $propertyId, 
                'master_tag_id' => $value,
            );
        }
        
        return $data;
    }


    /**
     * listing handlers end
     */
    
    /**
     * location handlers start
     */
    
    public function addLocation()
    {
        $locationData = $this->input->post();
        
        if (! $this->host_model->isPropertyExist($locationData['property_id'])) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: this property with ID " . $this->input->post('property_id') . " does not exist",
            ));
        }
        
        if (! $locationData['latitude'] || ! $locationData['longitude']) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal Error: Please pin your location to map first',
            ));
        }
        
        $locationSaveData = array(
            'address_line1' => $locationData['address_line1'],
            'country_id' => $locationData['country'],
            'state_id' => $locationData['state'],
            'city_id' => $locationData['city'],
            'area' => $locationData['area'],
            'zip' => $locationData['zip'],
            'latitude' => $locationData['latitude'],
            'longitude' => $locationData['longitude'],
        );
        
        if (! $this->host_model->saveLocation($locationSaveData, $locationData['property_id'])) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => "Fatal Error: location could not be saved",
            ));
        }
        
        $this->host_model->saveTab($locationData['property_id'], 6);
        
        $this->jsonResponse(array(
            'status' => '200',
            'message' => "Success: location saved successfully",
        ));
    }


    /**
     * location handlers end
     */

    /**
    * list property handlers start
    */

    public function properties($page = 0, $sortKey = 'property_id', $sortDirection = 'desc')
    {
    	// check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

    	// search request
    	if ('post' === strtolower($this->input->server('REQUEST_METHOD')) && (false !== $this->input->post('property_search_data'))) {
			// persist search data in session
			$this->persistSearchData('property_search_data', $this->input->post('property_search_data'));
		}

		// get search data if any and construct search query
		$propertySearchData = (false !== $this->session->userdata('property_search_data')) ? $this->session->userdata('property_search_data') : array();
		$searchQuery = ($propertySearchData) ? $this->constructPropertySearchQuery($propertySearchData) : '';    	

    	// set pagination configuration
		$paginationConfig = $this->setPaginationConfigs("/host/properties", $this->host_model->countPropertiesByHostId($sessionUserData['user_id'], $searchQuery, $sortKey, $sortDirection), 10, 3);
		$this->pagination->initialize($paginationConfig);

		// fetch properties data for this host
		$properties = $this->host_model->fetchPropertiesByHostId($sessionUserData['user_id'], $searchQuery, $page, $paginationConfig['per_page'], $sortKey, $sortDirection);

		// fetch the pagination links
		$pageLinks = $this->pagination->create_links();

		// load countries
		$countries = $this->host_model->fetchCountries();

		// load states
		$countryId = isset($propertySearchData['country_id']) ? $propertySearchData['country_id'] : $countries[0]->country_id;
		$states = $this->host_model->fetchStatesByCountryId($countryId);

		// load cities
		$stateId = isset($propertySearchData['state_id']) ? $propertySearchData['state_id'] : $states[0]->id;
		$cities = $this->host_model->fetchCitiesByStateId($stateId);
        
        // fetch room types
        $roomTypes = $this->host_model->fetchRoomTypes();

    	// construct view variables
    	$data = array(
    		'title' => 'properties',
    		'pageHeader' => 'Properties',
    		'userData' => $sessionUserData,
    		'properties' => $properties,
    		'countries' => $countries,
    		'states' => $states,
    		'cities' => $cities,
            'roomTypes' => $roomTypes,
    		'propertySearchData' => $propertySearchData,
    		'pageLinks' => $pageLinks,
    		'currentPage' => $page,
    		'recordPerPage' => $paginationConfig['per_page'],
    		'sortKey' => $sortKey,
    		'sortDirection' => $sortDirection,
		);
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load the respective view file
        $this->load->view('properties', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }

    private function constructPropertySearchQuery($propertySearchData) {
		$searchQuery = '';

		if ($propertySearchData['country_id']) {
			$searchQuery .= " and `p`.`country_id` = $propertySearchData[country_id]";
		}

		if ($propertySearchData['state_id']) {
			$searchQuery .= " and `p`.`state_id` = $propertySearchData[state_id]";
		}

		if ($propertySearchData['city_id']) {
			$searchQuery .= " and `p`.`city_id` = $propertySearchData[city_id]";
		}
        
        if ($propertySearchData['room_type_id']) {
			$searchQuery .= " and `p`.`room_type_id` = $propertySearchData[room_type_id]";
		}

		return $searchQuery;
	}

	public function exitsearch()
	{
		// get the query params
		$queryParams = $this->input->get();
		
		// decode referer
		$referer = isset($queryParams['referer']) ? base64_decode(trim($queryParams['referer'])) : site_url('/host/properties');

		// unset search data from session
		$this->session->unset_userdata('property_search_data');

		redirect($referer);
	}

	/**
    * list property handlers end
    */

    /**
    * edit property handlers start
    */

	public function editproperty($propertyId = null)
	{
		// check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

    	// get the query params
		$queryParams = $this->input->get();
		
		// decode referer
		$referer = isset($queryParams['referer']) ? base64_decode(trim($queryParams['referer'])) : site_url('/host/properties');

    	if (! $propertyId) {
    		redirect($referer);
    	}
        
    	if (! $this->host_model->isPropertyExist($propertyId)) {
    		redirect($referer);
    	}

    	// fetch necessary data
    	$countries = $this->host_model->fetchCountries();        
        $amenities = $this->host_model->fetchAmenities();        
        $propertyTypes = $this->host_model->fetchPropertyTypes();        
        $roomTypes = $this->host_model->fetchRoomTypes();        
        $policies = $this->host_model->fetchCancellationPolicies();        
        $tags = $this->host_model->fetchTags();
        $seasonTypes = $this->host_model->fetchSeasonTypes();        
        $periodTypes = $this->host_model->fetchPeriodTypes();
        $childPropertyData = array();
        
        // fetch property data
        $propertyData = $this->host_model->fetchPropertyEditdetailsById($propertyId);
        
        if ($propertyData[0]->child_properties) {
            // fetch data for all child properties/rooms
            $childPropertyData = $this->host_model->fetchChildPropertyDataByParentId($propertyId);
        }

        // fetch other location data
        $states = $this->host_model->fetchStatesByCountryId($propertyData[0]->country_id);
        $cities = $this->host_model->fetchCitiesByStateId($propertyData[0]->state_id);
        
		// construct view variables
        $data = array(
            'title' => 'Edit Property',
            'countries' => $countries,
            'amenities' => $amenities,
            'propertyTypes' => $propertyTypes,
            'roomTypes' => $roomTypes,
            'policies' => $policies,
            'seasonTypes' => $seasonTypes,
            'periodTypes' => $periodTypes,
            'tags' => $tags,
            'userData' => $sessionUserData,
            'propertyId' => $propertyId,
            'propertyDetails' => $propertyData[0],
            'childPropertyDetails' => $childPropertyData,
            'states' => $states,
            'cities' => $cities,
            'referer' => $referer,
            'rawReferer' => $queryParams['referer'],
        );
        
		// prepare data for view
        $this->prepareDataForView($data);
        
		// load the respective view file
        $this->load->view('edit_property', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
	}

    /**
    * edit property handlers end
    */

    /**
     * view property handlers start
     */

	public function propertydetails($propertyId = null)
	{
		// check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

    	// get the query params
		$queryParams = $this->input->get();
		
		// decode referer
		$referer = isset($queryParams['referer']) ? base64_decode(trim($queryParams['referer'])) : site_url('/host/properties');

    	// check if valid property
    	if (! $propertyId || ! $this->host_model->isPropertyExist($propertyId)) {
    		redirect(site_url('host/properties'));
    	}
        
        // fetch necessary data
        $seasonTypes = $this->host_model->fetchSeasonTypes();        
        $periodTypes = $this->host_model->fetchPeriodTypes();
        $navProperties = array();
        
        // fetch property data
    	$propertyDetails = $this->host_model->fetchPropertyViewDetailsById($propertyId);
        
        if ($propertyDetails[0]->child_properties) {
            $propertyIdArr = explode(';', $propertyDetails[0]->child_properties);  
			
	      	$propertyId = $propertyIdArr[0];
            redirect(site_url("/host/propertydetails/$propertyId/?referer=$queryParams[referer]"));
        }
        
        if ($propertyDetails[0]->sibling_properties) {
            $navProperties = explode(';', $propertyDetails[0]->sibling_properties);
        }
        
		// construct view variables
        $data = array(
            'title' => 'Property Details',
            'userData' => $sessionUserData,
            'seasonTypes' => $seasonTypes,
            'periodTypes' => $periodTypes,
            'propertyDetails' => $propertyDetails[0],
            'siblings' => $navProperties,
            'referer' => $referer,
        );
        
		// prepare data for view
        $this->prepareDataForView($data);
        
		// load the respective view file
        $this->load->view('property_details', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
	}
		
	/**
	 * view property handlers end
	 */

	/**
	 * delete property handlers start
	 */

	public function deleteproperty($propertyId = null)
	{
		// check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

		// get the query params
		$queryParams = $this->input->get();
		
		// filter the query params
		$currentPage = isset($queryParams['cpi']) ? trim($queryParams['cpi']) : '';
		$totalRecordCount = (isset($queryParams['trc']) && $queryParams['trc']) ? trim($queryParams['trc']) : null;
		$deletableRecordCount = (isset($queryParams['drc']) && ($queryParams['drc'] == 1)) ? trim($queryParams['drc']) : null;
		
		// decode referer
		$referer = isset($queryParams['referer']) ? base64_decode(trim($queryParams['referer'])) : site_url('/host/properties');

		// request validity check
		if ('' === $currentPage || ! $totalRecordCount || ! $deletableRecordCount) {
			$this->session->set_flashdata('fatalError', 'Fatal Error: Query params were hacked');
			redirect($referer);
		}

		// check if valid property
		if (! $propertyId || ! $this->host_model->isPropertyExist($propertyId)) {
			$this->session->set_flashdata('fatalError', 'Fatal Error: Property ID doesnot exist');
			redirect($referer);
		}

		// delete property
		if (! $this->host_model->deletePropertyById($propertyId)) {
			$this->session->set_flashdata('fatalError', 'Fatal Error: Could not delete property');
			redirect($referer);
		}

		// adjust redircet url
		$referer = $this->adjustReferer($referer, $currentPage, $totalRecordCount, $deletableRecordCount);

		$this->session->set_flashdata('success', 'Success: Property deleted successfully');
		
		redirect($referer);
	}

	public function deleteproperties()
	{
		// check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

		// get the query params
		$queryParams = $this->input->get();
		
		// filter the query params
		$currentPage = isset($queryParams['cpi']) ? trim($queryParams['cpi']) : '';
		$totalRecordCount = (isset($queryParams['trc']) && $queryParams['trc']) ? trim($queryParams['trc']) : null;
		$deletableRecordCount = (isset($queryParams['drc']) && ($this->pagination->per_page == $queryParams['drc'] || $queryParams['drc'] < $this->pagination->per_page)) ? trim($queryParams['drc']) : null;
		
		// decode referer
		$referer = isset($queryParams['referer']) ? base64_decode(trim($queryParams['referer'])) : site_url('/host/properties');

		// request validity check
		if ('' === $currentPage || ! $totalRecordCount || ! $deletableRecordCount) {
			$this->session->set_flashdata('fatalError', 'Fatal Error: Query params were hacked');
			
			$this->jsonResponse(array(
				'referer' => $referer,
			));
		}

		// get the property list
		$propertyList = $this->input->post('propertyList');
		$propertyList = (false !== strpos($propertyList, ',')) ? explode(',', $propertyList) : array($propertyList);

		// delete property
		if (! $this->host_model->deleteProperties($propertyList)) {
			$this->session->set_flashdata('fatalError', 'Fatal Error: Could not delete property');
			
			$this->jsonResponse(array(
				'referer' => $referer,
			));
		}

		// adjust redircet url
		$referer = $this->adjustReferer($referer, $currentPage, $totalRecordCount, $deletableRecordCount);

		$this->session->set_flashdata('success', 'Success: Property deleted successfully');
		
		$this->jsonResponse(array(
			'referer' => $referer,
		));
	}

	private function adjustReferer($referer, $currentPage, $totalRecordCount, $deletableRecordCount)
	{
		/**
		 * if current page is the first page
		 * or records to be deleted is less than
		 * total records on the page
		 * we do not need to adjust referer
		 */
		if ((0 == $currentPage) || ($deletableRecordCount < $totalRecordCount)) {
			return $referer;
		}

		$refererParts = explode('/', $referer);

		/**
		 * if 7th uri segment is not set
		 * current page is the first page
		 * we do not need to adjust referer
		 */
		if (! isset($refererParts[7])) {
			return $referer;
		}

		/**
		 * current page is some other than the first page
		 * records to be deleted is equal to
		 * total records on the page
		 * we do need to adjust referer
		 * let's load the previous page
		 */
		if (0 < $refererParts[7]) {
			$refererParts[7] = ($currentPage - $this->pagination->per_page);

			$referer = implode('/', $refererParts);

			return $referer;
		}
	}
    
    /**
	 * delete property handlers end
	 */
    
    public function fetchCalendarEventData()
    {
        $propertyId = $this->input->post('property_id');
        $selectedDate = $this->input->post('selected_date');        
        $dateParts = explode('/', $selectedDate);
        $selectedDate = "$dateParts[2]-$dateParts[0]-$dateParts[1]";
        
        $dailyPriceData = $this->host_model->fetchCalendarEventData($propertyId, $selectedDate);
        
        $this->jsonResponse(array('event_data' => $dailyPriceData));
    }
    
    public function updateCalendarEventData()
    {
        $priceData = array(
            'property_id' => $this->input->post('property_id'),
            'effective_from' => $this->input->post('date_range_from'),
            'effective_to' => $this->input->post('date_range_to'),
            'price' => $this->input->post('price'),
        );
        $availabilityData = array(
            'property_id' => $this->input->post('property_id'),
            'effective_from' => $this->input->post('date_range_from'),
            'effective_to' => $this->input->post('date_range_to'),
            'status' => $this->input->post('availibility'),
        );
        
        if (! $this->host_model->saveCalendarEventData($priceData, $availabilityData)) {            
            $this->jsonResponse(array(
                'status' => 500
            ));
        }
        
        $this->host_model->saveTab($priceData['property_id'], 7);
        
        $this->fetchCalendarEventData();
    }
    
    /**
     * new methods end
     */

	/***
	** Function to book a property
	*/
	function bookProperty()
	{
		$ins_data['property_id'] = $this->input->post('property_id',TRUE);
		$ins_data['user_id'] = $this->input->post('user_id',TRUE);
		$ins_data['booking_to'] = $this->input->post('booking_to',TRUE);
		$ins_data['booking_upto'] = $this->input->post('booking_upto',TRUE);
		$ins_data['user_name'] = $this->input->post('user_name',TRUE);
		$ins_data['guest_no'] = $this->input->post('guest_no',TRUE);
		$this->home_model->insertTableData('properties_booking',$ins_data);
		echo "success";
	}
	/***
	** Function to contact host
	*/
	function contactHost()
	{
		$receiver_id = $ins_data['receiver_id'] = $this->input->post('host_id',TRUE);
		$message = $ins_data['message'] = $this->input->post('message',TRUE);
		$ins_data['property_id'] = $this->input->post('property_id',TRUE);
		$sender_id = $ins_data['sender_id'] = $this->input->post('sender_id',TRUE);
		$this->home_model->insertTableData('users_message',$ins_data);
			//Send the email to the user
						$email_template['subject'] = 'Property Enquiry';
						$email_template['message'] = '<div> 
						<div>
							<p>
								 Hello {USERNAME}!<br><br>
								<p>
								 
									{QUERY}<br>
								</p>
							Yours truly,<br>
							{SENDERNAME}<br>     
							</p>
					 </div>
				 </div>';									
						//Replace the variables from the message
						$receiver_info = $this->host_model->userInfo($receiver_id);
						$first_name = $receiver_info->first_name;
						$last_name = $receiver_info->last_name;
						$user_name = $first_name.$last_name;
						$email_id = $receiver_info->email;
						$sender_info = $this->host_model->userInfo($sender_id);
						$sender_first_name = $sender_info->first_name;
						$sender_last_name = $sender_info->last_name;
						$sender_name = $sender_first_name.$sender_last_name;
						$pattern = array('/{USERNAME}/','/{QUERY}/','/{SENDERNAME}/');
						$replacement = array($user_name,$new_password,$sender_name);
						$email_template['message'] = preg_replace($pattern,$replacement,$email_template['message']);
						//$email_template['to'] = $email_id;
						$email_template['to'] = array( 'email' =>$email_id);
						send_email_notification($email_template); //From the email helper
						echo "Success";
	}
	/***
	** Function to compare properties 
	*/
	function compareProperties()
	{
		$property_id = $this->input->post('property_id',TRUE);
		$property_detail = $this->host_model->fetchCompareproperties($property_id);
		$amenities = $this->host_model->fetchAmenities($property_id);
	}



	/*-------------LOGIN REGISTER ------------------*/	
	public function registerWithFacebook()
    {
        $userData = $this->facebook_lib->api('/me?fields=email,name,first_name,last_name,picture');
        
        $id = null;

        if (! $userDbData = $this->home_model->getUserDataFromDb($userData['email'])) {
            $id = $this->home_model->saveUser(array(
                'email' => $userData['email'],
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'profile_pic' => $userData['picture']['data']['url'],
                'status' => 1,
            ));
        }
        
        $this->session->set_userdata('user', array(
            'user_id' => ($id) ? $id : $userDbData['user_id'],
            'email' => ($id) ? $userData['email'] : $userDbData['email'],
            'first_name' => ($id) ? $userData['first_name'] : $userDbData['first_name'],
            'last_name' => ($id) ? $userData['last_name'] : $userDbData['last_name'],
            'profile_pic' => ($id) ? $userData['picture']['data']['url'] : $userDbData['profile_pic'],
            'user_source' => 'facebook',
        ));
        
        $currentUrl = $this->session->userdata('referer');
        redirect($currentUrl);
    }

    public function registerWithGPlus()
    {
        if ($this->input->get('code')) {
            $this->googleplus->authenticateAccess($this->input->get('code'));
        }
        
        $gPlusAccessToken = $this->session->userdata('gplus_access_token');
        
        if (isset($gPlusAccessToken)) {
            $this->googleplus->setAccessToken($gPlusAccessToken);
        }
        
        $id = null;

        if ($this->googleplus->getAccessToken()) {
            $userData = $this->googleplus->getAuthenticatedUserInfo();
            
            if (! $userDbData = $this->home_model->getUserDataFromDb($userData->email)) {
               	$id = $this->home_model->saveUser(array(
                    'email' => $userData->email,
                    'first_name' => $userData->givenName,
                    'last_name' => $userData->familyName,
                    'profile_pic' => $userData->picture,
                    'status' => 1,
                ));
            }        

            $this->session->set_userdata('user', array(
                'user_id' => ($id) ? $id : $userDbData['user_id'],
                'email' => ($id) ? $userData->email : $userDbData['email'],
                'first_name' => ($id) ? $userData->givenName : $userDbData['first_name'],
                'last_name' => ($id) ? $userData->familyName : $userDbData['last_name'],
                'profile_pic' => ($id) ? $userData->picture : $userDbData['profile_pic'],
                'user_source' => 'googleplus',
            ));
        }
        
        $currentUrl = $this->session->userdata('referer');
        redirect($currentUrl);
    }

    public function logout($mode = null)
    {
        if ('googleplus' == $mode) {
            $this->session->unset_userdata('gplus_access_token');
        }
        
        $this->session->unset_userdata('user');
        
        if ('facebook' == $mode) {
            $this->session->sess_destroy();
        }
        
        redirect(site_url(''));
    }

	
	
	/**
	* Function for login
	*/
	function doLogin()
	{
		$email = $this->input->post('email_id') ? trim($this->input->post('email_id', true)) : '';
		$password = $this->input->post('password') ?  trim($this->input->post('password', true)) : '';

		if (! $email) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Email ID is required',
			));
			exit();
		}

		if (! $password) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Password is required',
			));
			exit();
		}

		$rec = $this->home_model->checkLogin($email,$password);

		if (! $rec) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Login authentication failed',
			));
			exit();
		}
		else{

			$this->session->set_userdata('user', array(
            'user_id' => $rec->user_id,
            'email' => $rec->email,
            'first_name' => $rec->first_name,
            'last_name' => $rec->last_name,
            'profile_pic' => $rec->profile_pic,
            'user_source' => 'ownsite'
        ));

        echo json_encode(array(
			'status' => '200',
			'test' =>$rec
		));
		exit();
		}
	}

	/****
	* Function to get the signup user
	**/
	function signupUser()
	{
		$first_name = $ins_data['first_name'] = $this->input->post('first_name') ? trim($this->input->post('first_name',TRUE)) : '';
		$last_name = $ins_data['last_name'] = $this->input->post('last_name') ? trim($this->input->post('last_name',TRUE)) : '';
		$email_id = $ins_data['email'] = $this->input->post('reg_email_id') ? trim($this->input->post('reg_email_id',TRUE)) : '';
		$password = $ins_data['password'] = $this->input->post('password') ? trim($this->input->post('password',TRUE)) : '';
		$phone_number = $ins_data['user_emergency_contact_no'] = $this->input->post('phone_number') ? trim($this->input->post('phone_number',TRUE)) : '';
		$ins_data['created_on'] = date('Y-m-d H:i:s');
		$ins_data['updated_on'] = date('Y-m-d H:i:s');
		$this->home_model->chkDuplicateuser($email_id);

		if ($this->home_model->chkDuplicateuser($email_id)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'This email is already registered with us',
			));
			exit();
		}

		$ins_data['password'] = md5($password);

		if (! $userId = $this->home_model->insertTableData(USER, $ins_data)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'User registration failed',
			));
			exit();
		}
		
		$notify = $this->notification_model->getTypeBaseNotification('BHR');
		
		$ins_trans_data['user_id'] = $userId;
		$ins_trans_data['notification_id'] = $notify['id'];
		$ins_trans_data['created_on'] = date('Y-m-d');
		$this->transaction_notification_model->insertTableData(TRANSAC_NOTIFY, $ins_trans_data);
		
		$email_id_hash = base64_encode($email_id);
		/*$body = "Dear ".$first_name." ".$last_name.",<br/>Please <a href='".base_url()."/host/verify/".$userid_hash."'>click here</a> to verify your email.<br/>Regards,<br/>RentnRoam";
		$to      = $email_id;
		$subject = 'RnR: Verify email';
		$headers = 'From: support@rnr.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($to, $subject, $body, $headers);*/
		
		$activation_link = '<a href='.base_url().'host/verify/'.$email_id_hash.'>Click Here</a>';
		//Send the email to the user
		$email_template['subject'] = 'User Registration Activation Email';
		$email_template['message'] = '<div> 
						<div>
							<p>
								 Hello {USERNAME},<br>
								<p>
								 Welcome to Rnr<br><br>
								 
									Click this link to activate your account.<br><br>
									{ACTIVATION LINK}
									
								</p>
							Kind Regards,<br>
							The Rnr Team<br>     
							</p>
					 </div>
				 </div>';									
		//Replace the variables from the message
		$user_name = $first_name.' '.$last_name;
		$pattern = array('/{USERNAME}/','/{ACTIVATION LINK}/');
		$replacement = array($user_name,$activation_link);
		$email_template['message'] = preg_replace($pattern,$replacement,$email_template['message']);
		//$email_template['to'] = $email_id;
		$email_template['to'] = array( 'email' =>$email_id);
		send_email_notification($email_template); //From the email helper	
		
		/*$this->session->set_userdata('user', array(
		    'user_id' => $userId,
		    'email' => $email_id,
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'profile_pic' => '',
		    'user_source' => 'ownsite',
		));*/

		echo json_encode(array(
			'status' => '200',
			/*'user_id' => $userId,*/
		));
		exit();
	}//end of the function
 
	
	
	function load_login_popup()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('host/login_view', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_login_popup_to_createproperty()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('login_to_createproperty', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_registration_popup()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_registration_view = $this->load->view('host/registration_view', $data, TRUE);
		echo $load_registration_view;
	}
	/*---------------------END LOGIN REGISTER---------------*/
	
    
    /**
     * save a room detail
     */
    public function saveRoomDetails()
    {
        // get the property id
        $propertyId = $this->input->post('property_id');
        $primaryPropertyId = (int)$this->input->post('parent_property_id');
        
        // construct room data
        $roomData = array(
            'property_title' => $this->input->post('room_name'),
            'room_type_id' => $this->input->post('room_type'),
            'guest_allow' => $this->input->post('guest_allowed'),
        );
        
        if (! $propertyId) {
            $roomData['parent_id'] = (int)$this->input->post('parent_property_id');
            $roomData['user_id'] = (int)$this->input->post('user_id');
            $roomData['property_type_id'] = (int)$this->input->post('property_type_id');
        }
        
        // try saving the room
        if (! $thisPropertyId = $this->host_model->saveRoomDetails($propertyId, $roomData)) {            
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Room details could not be saved'
            ));
        }
        
        $this->host_model->saveTab($primaryPropertyId, 8);
        
        $this->jsonResponse(array(
            'status' => '200',
            'propertyId' => ($propertyId != $thisPropertyId) ? $thisPropertyId : null,
            'message' => 'Room details saved successfully'
        ));
    }
	
    /**
     * delete all rooms and parent property
     * 
     * @param int $propertyId
     */
    public function deleteAllRooms($propertyId)
    {
        if (! $this->host_model->deleteAllRooms($propertyId)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => '<strong>Fatal Error: </strong>rooms and property could not be deleted'
            ));
        }
        
        $this->jsonResponse(array(
            'status' => '200',
        ));
    }
    
    public function deleteRoom($propertyId = null)
    {
        if ($propertyId && ! $this->host_model->deleteRoom($propertyId)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Room could not be deleted'
            ));
        }
        
        $this->jsonResponse(array(
            'status' => '200',
        ));
    }
	
	public function verify($email_id = null)
    {
        $til["title"] = "Verify Email";
        $email_id = base64_decode($email_id);
		if($this->host_model->verify_email($email_id))
			$til["msg"] = "Your email has been verified. Please login to cotinue.";
		else
			$til["msg"] = "Cannot find the email. Please check your verify link.";
			
		$til = array_merge($til, $this->viewData);
		$this->load->view('verify', $til);
    }
}
?>