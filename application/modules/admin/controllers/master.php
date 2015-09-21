<?php
class Master extends MX_Controller{
	function __construct()
	{	
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('master_model');		
		$this->load->library('upload');
		$this->load->library('form_validation');
		
	}

	/*----------MASTER COUNTRY-------*/

	//insert country 
	public function insertCountry()
	{
		$countryName = $this->input->post('country');		
		$udata['country_name'] = $countryName;
		$Status = $this->input->post('status');
		$udata['status'] = $Status;

		if($countryName != null)
		{
			/*check country already exist or not*/
			$check = $this->master_model->checkCountry($countryName);
			if($check == true)
			{
				$data["status"] = 400;
				$data["message"] = "Country already exist in database";
				echo json_encode($data);
			}	
			else
			{
				$res = $this->master_model->addCountry($udata);
				if($res)
				{
					$data["status"] = 200;
					$data["message"] = "Inserted..";
					echo json_encode($data);
				}				
			}

		}
		else
		{
				$data["status"] = 400;
				$data["message"] = "Please add country..";
				echo json_encode($data);
		}
	}

	//update country and view 
	public function editCountry()
	{
		$countryName = $this->input->post('country');		
		$udata['country_name'] = $countryName;
		$Status = $this->input->post('status');
		$udata['status'] = $Status;
		$id = $this->input->post('country_id');
		if($countryName != null)
		{	
			/*check country already exist or not*/
			/*
			$check = $this->master_model->checkCountry($countryName);
			if($check == true)
			{
				$data["status"] = 400;
				$data["message"] = "Country already exist";
				echo json_encode($data);
			}	
			else
			{}*/
			
				$res=$this->master_model->updateCountry($udata, $id);
				if($res){
					$data['status'] = 200;
					$data['message'] = "updated...";
					echo json_encode($data);
				}
				
		}
		else{
				$data['status'] = 400;
				$data['message'] = "not..edited...";
				echo json_encode($data);
		}	
		

	}
	//get country by id
	public function getIdbyCountry($id = NULL)
	{
		$data1 = $this->master_model->getCountrybyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}
	
	//delete country 
	public function deleteCountry($id = NULL)
	{
		$res = $this->master_model->removeCountry($id);
		//$this->showLocation();
		if($res)
		{
			//header('location:'.base_url()."admin/showLocation");
				$data['status'] = 200;
				$data['message'] = "Deleted...";
				echo json_encode($data);
		}
		else{
				$data['status'] = 200;
				$data['message_deleteCountry'] = "you cannot delete";
				echo json_encode($data);
		}
		
	}
	/*-----------END Master Country---------*/

	/*----------MASTER STATE --------------*/
	//get country for country drop down selection
	public function getCountrydropdown()
	{
		$res = $this->master_model->getCountrydropdown();
		echo json_encode($res);
	}


		//insert Country and state
	public function insertCountrystate()
	{
		$udata['country_id'] = $this->input->post('country_id');
		$country_id = $udata['country_id'];
		$udata['state_name'] = $this->input->post('state');
		$state = $udata['state_name'];
		$udata['status'] = $this->input->post('status');

		if($country_id == null)
		{
			$data['status'] = 400;
			$data['message'] = "Select Country";
			echo json_encode($data);
		}
		else if($state == null){
			$data['status'] = 400;
			$data['message'] = "Fill up State";
			echo json_encode($data);
		}
		else
		{

			$stateCheck = $this->master_model->checkState($state);
			if($stateCheck == true)
			{
					$data['status'] = 400;
					$data['message'] = "State already exist in database";
					echo json_encode($data);
			}	
			else
			{
				$res = $this->master_model->insertCountrystate($udata);
				if($res){
					$data['status'] = 200;
					$data['message'] = "Inserted...";
					echo json_encode($data);
				}
			}
			
		}
		
	}

	//delete state 
	public function deleteState($id = NULL)
	{
		$res = $this->master_model->removeState($id);
		if($res)
		{
			//header('location:'.base_url()."admin/showLocation");
				$data['status'] = 200;
				$data['message'] = "Deleted...";
				echo json_encode($data);
		}
		else{
				$data['status'] = 200;
				$data['message_deleteCountry'] = "you cannot delete";
				echo json_encode($data);
		}
		
	}

	//get state by id
	public function getStateById($id = NULL)
	{
		$data1 = $this->master_model->getStatebyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}

	//update state 
	public function editState()
	{
		$countryName = $this->input->post('country');
		$udata['state_name'] = $this->input->post('state');	
		$stateName = $udata['state_name'];	
		$udata['status'] = $this->input->post('status');
		$id = $this->input->post('id');
		if($stateName != null)
		{	
				//get country_id from input country_name
				$countryID = $this->master_model->getCountryID($countryName);
				$country_id = '';
				foreach($countryID as $ID)
				{
					$country_id = $ID->country_id;
				}

				$udata['country_id'] = $country_id;


				$res=$this->master_model->updateState($udata, $id);
				if($res){
					$data['status'] = 200;
					$data['message'] = "updated...";
					echo json_encode($data);
				}
				
		}
		else{
				$data['status'] = 400;
				$data['message'] = "not..edited...";
				echo json_encode($data);
		}	
		

	}
	
	

	/*---------END MASTER STATE-----------*/


	/*---------MASTER CITY---------------*/

	//get country_id and extract state(slection dropdown)
	public function getStatebyCid($id = NULL)
	{
		$result=$this->master_model->getStatebyCid($id);
		if($result)
		{
			echo json_encode($result);
		}
	}

	//insert new city	
	public function insertNewlocation()
	{

		$udata['country_id'] = $this->input->post('country_id');
		$CountryID = $udata['country_id'];

		$udata['state_id'] = $this->input->post('state_id');
		$StateID = $udata['state_id'];

		$udata['city'] = $this->input->post('city');

		$udata['status'] = $this->input->post('status');
		
		$City = $udata['city'];

		$status = $udata['status'];		
		
		if($status == "-1")
		{
					$data['status'] = 400;
					$data['message'] = 'Select status..';

					echo json_encode($data);

		}
		else
		{
			$City = $udata['city'];
			$CityName = $this->master_model->cityCheck($City);	
				
				if($CityName == true)
				{
					$data['status'] = 400;
					$data['message'] = 'City already exist... insert new';

					//$dat = $data['message'];
					//$this->load->view('insertLocation', $data);
					echo json_encode($data);
				}

				else{
					
					$res = $this->master_model->insertLocation($CountryID, $StateID, $City, $status);
					
					
					if($res){

						$data['status'] = 200;
						$data['message'] = 'Inserted';
						
						//$this->load->view('insertLocation', $data);
						echo json_encode($data);
						
						//header('location:'.base_url()."index.php/users/".$this->showLocation());
						//header('location:'.base_url()."admin/showLocation");

					}
					else{
							$data['status'] = 400;
						$data['message'] = 'ERROR....';
						echo json_encode($data);
						//$this->load->view('insertLocation', $data);

					}
				
				}		
		}
				
	}


	//delete City 
	public function deleteCity($id = NULL)
	{
		$res = $this->master_model->deleteCity($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	//get city details by id
	public function getCitydetByID($id = NULL)
	{
		$data1 = $this->master_model->getCityByID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}

	//update City
	public function editCity()
	{
		
		$udata['city_name']=$_POST['city'];
		$cityName = $udata['city_name']; 
		$udata['status']=$_POST['status'];
		$id = $_POST['id'];

		if($cityName == "")
		{	
				$data['status'] = 400;
				$data['message'] = "City name is required";
				echo json_encode($data);				
		}
		else{
				
				$res=$this->master_model->updateCity($udata, $id);
				if($res){
					$data['status'] = 200;
					$data['message'] = "updated...";
					echo json_encode($data);
				}
		}	
		

	}


	/*---------END MASTER CITY-----------*/



	/*-----------MASTER ROOM TYPE --------*/
	//inserting room
	public function insertRoomtype()
	{		 
		 $roomtype = $this->input->post('roomtype');
		 $title = $this->input->post('title');

		 $this->form_validation->set_rules('roomtype', 'roomtype', 'required');
		$this->form_validation->set_rules('title', 'hover text', 'required');    
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 1,
				'error' => true,
				'message' =>'Required:-',			
				'roomtype' => strip_tags(form_error('roomtype')),
				'title' => strip_tags(form_error('title')),
				
				);
							
			echo json_encode($arr);
			
		}

		else		
		{
					
						$baseurl = base_url();
						$config = array();
						$config['upload_path'] = './public/images/room_type';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100';
						$config['min_size']	= '100';
						$config['max_width']  = '100';
						$config['min_width']  = '100';
						$config['min_width']  = '100';
						$config['max_height']  = '100';
						$this->upload->initialize($config);
					
						if ( ! $this->upload->do_upload())
						{
							$error = array(
								'status' =>2,
								'message' => strip_tags($this->upload->display_errors()));
							echo json_encode($error);
							
						}
						else
						
						{	
							$data1 = array('upload_data' => $this->upload->data());
							$upload_data = $this->upload->data();
							$name = $upload_data['file_name'];
						
							//$url= $baseurl."public/images/".$name;
						
							//$records[] = array('roomtype' => $roomtype, 'title' => $title, 'images' => $name);
							$res = $this->master_model->insertMasterroom($roomtype, $title, $name);	
							if($res)
							{
								$data['status'] = 3;
								$data['message'] ="inserted..";
								echo json_encode($data);
							}
						}

						
			}

		
	
	}


	//delete City 
	public function deleteRoomtype($id = NULL)
	{
		
		$res = $this->master_model->getRoomtype($id);		
		$imagename='';
		foreach($res as $id1)
		{
			$imagename = $id1->images;
		}
		//echo $imagename;
		/*
		$unlink_link = base_url()."public/images/";		
		$trimmed = str_replace($unlink_link,'', $imagename);		
       	*/
        
        // unlink($unlink_link.$trimmed);				
		//$this->load->helper("url");
		//delete_files(base_url("public/images/" . $trimmed));
		
		if(unlink("./public/images/room_type/" . $imagename))
		{
			$ress = $this->master_model->deleteRoomtype($id);		
			
			if($ress)
			{
				$data['status'] = 200;
				$data['message'] = "Deleted...";
				echo json_encode($data);
			}
			
		}
		else
		{
				$data['status'] = 400;
				$data['message'] = "Error....";
				echo json_encode($data);
		}

	}


	//get roomtype by idgetAmenitiestypeByID
	public function getRoomtypebyID($id = NULL)
	{
		$data1 = $this->master_model->getRoomtypebyID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}

	//edit room type
	public function editRoomtype()
	{
		 
		 $roomtype = $this->input->post('roomtype');
		 $title = $this->input->post('title');
		 $roomId = $this->input->post('room_type_id');
		
		 	//update image without image
			if (empty($_FILES['imageicon']['name']))
			{
    				$res = $this->master_model->updateMasterroom($roomtype, $title, $roomId);	
					
						if($res)
						{
							$data['status'] = 3;
							$data['message'] ="updated...";
							echo json_encode($data);
						}
			}

			else
			{
				//extract image and remove from directory
				$img = $this->master_model->getimgRoomtype($roomId);
				$imge = '';
				foreach($img as $idd)
				{
					$imge = $idd->images;
				}

				if(unlink("./public/images/room_type/". $imge))
				{

					$baseurl = base_url();					
					$config = array();
					$config['upload_path'] = './public/images/room_type';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '100';
					$config['min_size']	= '100';
					$config['max_width']  = '100';
					$config['min_width']  = '100';
					$config['min_width']  = '100';
					$config['max_height']  = '100';
					$this->upload->initialize($config);
				
					if ( ! $this->upload->do_upload('imageicon'))
					{
						$error = array(
							'status' =>2,
							'message' => strip_tags($this->upload->display_errors()));
						echo json_encode($error);
						
					}
					else
					
					{	
						$data1 = array('upload_data' => $this->upload->data());
						$upload_data = $this->upload->data();
						$name = $upload_data['file_name'];					
						//$url= $baseurl."public/images/".$name;
					
						//$records[] = array('roomtype' => $roomtype, 'title' => $title, 'images' => $name);
						$res = $this->master_model->updateMasterroomImage($roomtype, $title, $name, $roomId);	
						if($res)
						{
							$data['status'] = 3;
							$data['message'] ="updated...";
							echo json_encode($data);
						}
					}
				}
				else
				{
					$data['status'] = 2;
					$data['message'] = "Error....";
					echo json_encode($data);
				}	
						
			}						
	
	}
	/*-----------END MASTER ROOM TYPE ------*/

	/*---------MASTER AMENITIES ----------*/
	//get amenity type  by id
	public function getAmenitiestypeByID($id = NULL)
	{
		$data1 = $this->master_model->getAmenitiestypeByID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}

	//update master amenities type 
	public function editAmenitestype()
	{
		$udata['amenities_type_name']=$_POST['amenitiestype'];
		$name = $udata['amenities_type_name']; 
		$udata['status']=$_POST['status'];
		$id = $_POST['amenities_type_id'];

		if($name == "")
		{	
				$data['status'] = 400;
				$data['message'] = "Amenities type is required";
				echo json_encode($data);				
		}
		else{
				
				$res=$this->master_model->updateAmenitiesType($udata, $id);
				if($res){
					$data['status'] = 200;
					$data['message'] = "updated...";
					echo json_encode($data);
				}
		}	
	}

	//insert master amenities 
	public function insertAmenities()
	{
		
		
		$this->form_validation->set_rules('amenitiestype', 'amenitiestype', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');    
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'amenitiestype is required',			
				'atype' => strip_tags(form_error('amenitiestype')),
				'status' => strip_tags(form_error('status')),
				
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				$udata['amenities_type_name'] = $this->input->post('amenitiestype');				
				$udata['status'] = $this->input->post('status');

				$res = $this->master_model->addAmenitiestype($udata);
				if($res)
				{
					$data["status"] = 200;
					$data["message"] = "Inserted..";
					echo json_encode($data);
				}				
			}

		
		
	}


	//delete City 
	public function deleteAmenitiestype($id = NULL)
	{
		$res = $this->master_model->deleteAmenitiestype($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	//get amenities type (drop down)
	public function getAmenitiesDropdown()
	{
		$res = $this->master_model->getAmenitiestype();
		echo json_encode($res);
	}



	//insert master amenities subtype 
	public function insertAmenitiesSubtype()
	{
		
		
		$this->form_validation->set_rules('Atype', 'Amenities type', 'required');
		$this->form_validation->set_rules('Asubtype', 'Amenities subtype', 'required');
		$this->form_validation->set_rules('status1', 'status', 'required');    
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 1,
				'error' => true,
				'message' =>'Required:-',		
				'Atype' => strip_tags(form_error('Atype')),	
				'Asubtype' => strip_tags(form_error('Asubtype')),
				'status1' => strip_tags(form_error('status1')),				
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				
				
						$baseurl = base_url();

						$config = array();
						$config['upload_path'] = './public/images/amenities';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100';
						$config['min_size']	= '100';
						$config['max_width']  = '100';
						$config['min_width']  = '100';
						$config['min_width']  = '100';
						$config['max_height']  = '100';
						$this->upload->initialize($config);
					
						if ( ! $this->upload->do_upload('Asubtype_icon'))
						{
							$error = array(
								'status' =>2,
								'message' => strip_tags($this->upload->display_errors()));
							echo json_encode($error);
							
						}
						else
						
						{	
							$data1 = array('upload_data' => $this->upload->data());
							$upload_data = $this->upload->data();
							$name = $upload_data['file_name'];
						
							//$url= $baseurl."public/images/".$name;


							$udata['amenities_type'] = $this->input->post('Atype');
							$Asubtype= $this->input->post('Asubtype');
							$udata['amenities_subtype'] = strtoupper($Asubtype);
							$udata['images'] = $name;			
							$udata['status'] = $this->input->post('status1');

							$res = $this->master_model->addAmenitiesSubtype($udata);
							if($res)
							{
								$data["status"] = 200;
								$data["message"] = "Inserted..";
								echo json_encode($data);
							}
						}					
			}

		
		
	}


	//edit Amenities subtype
	public function editASubtype()
	{
		 
		 $atype = $this->input->post('Atype');
		 //$asubtype = $this->input->post('Asubtype');
		 
		 $Aasubtype= $this->input->post('Asubtype');
		 $asubtype = strtoupper($Aasubtype);
		 
		 $id = $this->input->post('Asubtype_id');
	     $status = $this->input->post('status1');
	     $re = $this->master_model->getIdamenities($atype);
	     
	     $amenitiestype = '';
	     foreach($re as $r)
	     {
	     	$amenitiestype= $r->amenities_type_id;
	     }		
		 	//update image without image
			if (empty($_FILES['imageicon']['name']))
			{
    				$res = $this->master_model->updateMasterSubAmenities($amenitiestype, $asubtype, $status, $id);	
					
						if($res)
						{
							$data['status'] = 3;
							$data['message'] ="updated...";
							echo json_encode($data);
						}
			}

			else
			{
					$img = $this->master_model->getimgASubtype($id);
					
					$imag='';
					foreach($img as $im)
					{
						$imag = $im->images;
					}

					if(unlink("./public/images/amenities/". $imag))
					{


							$baseurl = base_url();					
							$config = array();
							$config['upload_path'] = './public/images/amenities';
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']	= '100';
							$config['min_size']	= '100';
							$config['max_width']  = '100';
							$config['min_width']  = '100';
							$config['min_width']  = '100';
							$config['max_height']  = '100';
							$this->upload->initialize($config);
						
							if ( ! $this->upload->do_upload('imageicon'))
							{
								$error = array(
									'status' =>2,
									'message' => strip_tags($this->upload->display_errors()));
								echo json_encode($error);
								
							}
							else
							
							{	
								$data1 = array('upload_data' => $this->upload->data());
								$upload_data = $this->upload->data();
								$name = $upload_data['file_name'];
							
								//$url= $baseurl."public/images/".$name;
							
								//$records[] = array('roomtype' => $roomtype, 'title' => $title, 'images' => $name);
								$res = $this->master_model->updateMasterSubAmenitiesImg($amenitiestype, $asubtype, $name, $status, $id);	
								if($res)
								{
									$data['status'] = 3;
									$data['message'] ="updated...";
									echo json_encode($data);
								}
							}
						}
						else
						{
									$data['status'] = 2;
									$data['message'] ="error .... ";
									echo json_encode($data);
						}	
						

			}						
	
	}

	public function getAmenitieSubstypeByID($id = NULL)
	{
		$data1 = $this->master_model->getAmenitieSubstypeByID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}



	//delete amenities subtype
	public function deleteAmenitiesSubtype($id = NULL)
	{
		
		$res = $this->master_model->getAmenSubtype($id);		
		$imagename='';
		foreach($res as $id1)
		{
			$imagename = $id1->images;
		}
		//echo $imagename;
		
		//$unlink_link = base_url()."public/images/";		
		//$trimmed = str_replace($unlink_link,'', $imagename);		
       	
       // unlink($unlink_link.$trimmed);		
		
		//$this->load->helper("url");
		//delete_files(base_url("public/images/" . $trimmed));
		
		if(unlink("./public/images/amenities/" . $imagename))
		{
			$ress = $this->master_model->deleteAmSubtype($id);		
			
			if($ress)
			{
				$data['status'] = 200;
				$data['message'] = "Deleted...";
				echo json_encode($data);
			}
			
		}
		else
		{
				$data['status'] = 400;
				$data['message'] = "Error....";
				echo json_encode($data);
		}

	}

	//insert master Property type 
	public function insertPropertytype()
	{
		$udata['property_type'] = $this->input->post('property_type');
		$udata['element_type'] = $this->input->post('E_type');
		


		$this->form_validation->set_rules('property_type', 'Property type', 'required');
		$this->form_validation->set_rules('E_type', 'Element type', 'required');   
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 1,
				'error' => true,
				'message' =>'Required:-',		
				'property_type' => strip_tags(form_error('property_type')),	
				'E_type' => strip_tags(form_error('E_type'))				
				);
							
			echo json_encode($arr);
			
		}

		else
			{
						$propertytype = $udata['property_type'];
						$checkProp = $this->master_model->checkPropertytype($propertytype);
						
						if($checkProp == false)
						{
							$baseurl = base_url();

							$config = array();
							$config['upload_path'] = './public/images/property_type/';
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']	= '100';
							$config['min_size']	= '100';
							$config['max_width']  = '100';
							$config['min_width']  = '100';
							$config['min_width']  = '100';
							$config['max_height']  = '100';
							$this->upload->initialize($config);
						
							if ( ! $this->upload->do_upload('iconimage'))
							{
								$error = array(
									'status' =>2,
									'message' => strip_tags($this->upload->display_errors()));
								echo json_encode($error);
								
							}
							else						
							{	
								$data1 = array('upload_data' => $this->upload->data());
								$upload_data = $this->upload->data();
								$udata['images'] = $upload_data['file_name'];
							
								//$url= $baseurl."public/images/".$name;


							
								//$udata['images'] = $url;			
								
								$res = $this->master_model->addPropertyType($udata);
								if($res)
								{
									$data["status"] = 200;
									$data["message"] = "Inserted..";
									echo json_encode($data);
								}
							}					
						}
						else
						{
									$data["status"] = 3;
									$data["message"] = "Property type name already exist..";
									echo json_encode($data);
						}		
				
						
			}

		
		
	}

	public function getPropertytypeByID($id = NULL)
	{
		$data1 = $this->master_model->getProptypeByID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}

	//edit Master Property type
	public function editPropertytype()
	{
		 
		 $propertytype = $this->input->post('property_type');
		 $buttontype = $this->input->post('element_type');
		 $id = $this->input->post('id');
		 	//update image without image
			if (empty($_FILES['imageicon']['name']))
			{
    				$res = $this->master_model->updateMasterPropertytype($propertytype, $buttontype, $id);	
					
						if($res)
						{
							$data['status'] = 3;
							$data['message'] ="updated...";
							echo json_encode($data);
						}
			}

			else
			{
				$img = $this->master_model->getimgPropertytype($id);
				$imag='';
				foreach($img as $im)
				{
					$imag = $im->images;
				}

				if(unlink("./public/images/property_type/". $imag))
				{

					$baseurl = base_url();					
					$config = array();
					$config['upload_path'] = './public/images/property_type/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '100';
					$config['min_size']	= '100';
					$config['max_width']  = '100';
					$config['min_width']  = '100';
					$config['min_width']  = '100';
					$config['max_height']  = '100';
					$this->upload->initialize($config);
				
					if ( ! $this->upload->do_upload('imageicon'))
					{
						$error = array(
							'status' =>2,
							'message' => strip_tags($this->upload->display_errors()));
						echo json_encode($error);
						
					}
					else
					
					{	
						$data1 = array('upload_data' => $this->upload->data());
						$upload_data = $this->upload->data();
						$name = $upload_data['file_name'];
					
						//$url= $baseurl."public/images/".$name;
					
						//$records[] = array('roomtype' => $roomtype, 'title' => $title, 'images' => $name);
						$res = $this->master_model->updateMasterPropertytypeImg($propertytype , $buttontype, $name,  $id);	
						if($res)
						{
							$data['status'] = 3;
							$data['message'] ="updated...";
							echo json_encode($data);
						}
					}
				}
				else
				{
					$data['status'] = 2;
					$data['message'] = "Error....";
					echo json_encode($data);
				}		
			}						
	
	}



	//delete property type
	public function deletePropertytype($id = NULL)
	{
	
		$res = $this->master_model->getimgPropertytype($id);		
		$imagename='';
		foreach($res as $id1)
		{
			$imagename = $id1->images;
		}
		
		
		if(unlink("./public/images/property_type/" . $imagename))
		{
				$res = $this->master_model->deletePropertytype($id);
				if($res)
				{
					$data['status'] = 200;
					$data['message'] = "Deleted...";
					echo json_encode($data);
				}
			
		}
		else
		{
				$data['status'] = 400;
				$data['message'] = "Error....";
				echo json_encode($data);
		}

	}

	//delete property tag
	public function deletePropertytag($id = NULL)
	{
		$res = $this->master_model->deletePropertytag($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	public function getPropertytagByID($id = NULL)
	{
		$data1 = $this->master_model->getPropertytagByID($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}


	//insert master amenities 
	public function insertTag()
	{
		
		
		$this->form_validation->set_rules('tag', 'tag', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'tag is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				$udata['tag'] = $this->input->post('tag');
				$tag = $udata['tag'];
				$checktag = $this->master_model->tagCheck($tag);
				if($checktag == true)
				{
					$data["status"] = 400;
					$data["message"] = "Tag name already exist.. try other";
					echo json_encode($data);
				}
				else
				{
					$res = $this->master_model->addTag($udata);
					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Inserted..";
						echo json_encode($data);
					}
				}				
								
			}

		
		
	}

	//insert master amenities 
	public function editPropertytag()
	{
		
		
		$this->form_validation->set_rules('tag', 'tag', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'tag is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
					$udata['tag'] = $this->input->post('tag');
					$id = $this->input->post('id');
					$res = $this->master_model->editTag($udata, $id);

					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Updated..";
						echo json_encode($data);
					}
								
								
			}

		
		
	}

	//insert smiley
	public function insertSmiley()
	{
				
						$baseurl = base_url();
						$config = array();
						$config['upload_path'] = './public/images/emoticons';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100';
						$config['min_size']	= '100';
						$config['max_width']  = '100';
						$config['min_width']  = '100';
						$config['min_width']  = '100';
						$config['max_height']  = '100';
						$this->upload->initialize($config);
					
						if ( ! $this->upload->do_upload('smiley'))
						{
							$error = array(
								'status' =>400,
								'message' => strip_tags($this->upload->display_errors()));
							echo json_encode($error);
							
						}
						else
						
						{	
							$data1 = array('upload_data' => $this->upload->data());
							$upload_data = $this->upload->data();
							$name = $upload_data['file_name'];
						
							//$url= $baseurl."public/images/emoticons/".$name;

							$res = $this->master_model->addSmiley($name);
							if($res)
							{
								$data["status"] = 200;
								$data["message"] = "Inserted..";
								echo json_encode($data);
							}
						}					
		

	}


	//update smiley
	public function editSmiley()
	{
					$id=$this->input->post('id');

					$img = $this->master_model->getimgSmiley($id);
					$imag='';
					foreach($img as $im)
					{
						$imag = $im->smiley_icon;
					}

					if(unlink("./public/images/emoticons/". $imag))
					{


																
						$baseurl = base_url();
						$config = array();
						$config['upload_path'] = './public/images/emoticons';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100';
						$config['min_size']	= '100';
						$config['max_width']  = '100';
						$config['min_width']  = '100';
						$config['min_width']  = '100';
						$config['max_height']  = '100';
						$this->upload->initialize($config);					
						if ( ! $this->upload->do_upload('smiley'))
						{
							$error = array(
								'status' =>400,
								'message' => strip_tags($this->upload->display_errors()));
							echo json_encode($error);
							
						}
						else						
						{	
							$data1 = array('upload_data' => $this->upload->data());
							$upload_data = $this->upload->data();
							$name = $upload_data['file_name'];						
							//$url= $baseurl."public/images/emoticons/".$name;
							$res = $this->master_model->updateSmiley($name, $id);
							if($res)
							{
								$data["status"] = 200;
								$data["message"] = "Updated..";
								$data['id'] = $id;
								//$data['name'] = $url;
								echo json_encode($data);
							}
						}
					}						
	}

	public function getSmileybyId($id = NULL)
	{
		$data1 = $this->master_model->getSmileybyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}
		echo json_encode($output);
	}

	//delete property smiley
	public function deletePropertysmiley($id = NULL)
	{
		
				$id=$this->input->post('id');

				$img = $this->master_model->getimgSmiley($id);
				$imag='';
				foreach($img as $im)
				{
					$imag = $im->smiley_icon;
				}

				if(unlink("./public/images/emoticons/". $imag))
				{

					$res = $this->master_model->deletePropertysmiley($id);
					if($res)
					{
						$data['status'] = 200;
						$data['message'] = "Deleted...";
						echo json_encode($data);
					}
				}
	}






	//delete policy
	public function deletePolicy($id = NULL)
	{
		$res = $this->master_model->deletePropertypolicy($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	public function getPolicybyId($id = NULL)
	{
		$data1 = $this->master_model->getPolicybyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}


	//insert master amenities 
	public function addPolicy()
	{
		
		
		$this->form_validation->set_rules('policy', 'policy', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'policy type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				$udata['policy'] = $this->input->post('policy');
				$policy = $udata['policy'];
				$checktag = $this->master_model->policyCheck($policy);
				if($checktag == true)
				{
					$data["status"] = 400;
					$data["message"] = "Policy type already exist.. try other";
					echo json_encode($data);
				}
				else
				{
					$res = $this->master_model->addPolicy($udata);
					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Inserted..";
						echo json_encode($data);
					}
				}				
								
			}

		
		
	}

	//edit master policy
	public function updatePolicy()
	{
		
		
		$this->form_validation->set_rules('policy', 'policy type', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'policy type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
					$udata['policy'] = $this->input->post('policy');
					$id = $this->input->post('id');
					$res = $this->master_model->updatePolicy($udata, $id);

					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Updated..";
						echo json_encode($data);
					}
								
								
			}

		
		
	}




	
	//delete period
	public function deletePeriod($id = NULL)
	{
		$res = $this->master_model->deletePeriod($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	public function getPeriodbyId($id = NULL)
	{
		$data1 = $this->master_model->getPeriodbyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}


	//insert master amenities 
	public function addPeriod()
	{
		
		
		$this->form_validation->set_rules('period', 'period', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'period type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				$udata['period'] = $this->input->post('period');
				$policy = $udata['period'];
				$checktag = $this->master_model->periodCheck($policy);
				if($checktag == true)
				{
					$data["status"] = 400;
					$data["message"] = "Period type already exist.. try other";
					echo json_encode($data);
				}
				else
				{
					$res = $this->master_model->addPeriod($udata);
					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Inserted..";
						echo json_encode($data);
					}
				}				
								
			}

		
		
	}

	//edit master policy
	public function updatePeriod()
	{
		
		
		$this->form_validation->set_rules('period', 'period type', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'period type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
					$udata['period'] = $this->input->post('period');
					$id = $this->input->post('id');
					$res = $this->master_model->updatePeriod($udata, $id);

					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Updated..";
						echo json_encode($data);
					}
								
								
			}

		
		
	}


	/*-----*/

	
	//delete Season type
	public function deleteSeason($id = NULL)
	{
		$res = $this->master_model->deleteSeason($id);
		if($res)
		{
			$data['status'] = 200;
			$data['message'] = "Deleted...";
			echo json_encode($data);
		}
	}

	public function getSeasonbyId($id = NULL)
	{
		$data1 = $this->master_model->getSeasonbyId($id);
		//converting json array to json object
		$output = array();
		foreach($data1 as $v) {
			$output = $v;
		}

		echo json_encode($output);
	}


	//insert master amenities 
	public function addSeason()
	{
		
		
		$this->form_validation->set_rules('season', 'season', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'season type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
				$udata['season_type'] = $this->input->post('season');
				$policy = $udata['season_type'];
				$checktag = $this->master_model->seasonCheck($policy);
				if($checktag == true)
				{
					$data["status"] = 400;
					$data["message"] = "Season type already exist.. try other";
					echo json_encode($data);
				}
				else
				{
					$res = $this->master_model->addSeason($udata);
					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Inserted..";
						echo json_encode($data);
					}
				}				
								
			}

		
		
	}

	//edit master policy
	public function updateSeason()
	{
		
		
		$this->form_validation->set_rules('season', 'season type', 'required');
		
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'message' =>'season type is required'						
				);
							
			echo json_encode($arr);
			
		}

		else
			{
					$udata['season_type'] = $this->input->post('season');
					$id = $this->input->post('id');
					$res = $this->master_model->updateSeason($udata, $id);

					if($res)
					{
						$data["status"] = 200;
						$data["message"] = "Updated..";
						echo json_encode($data);
					}
								
								
			}

		
		
	}



	/*---------------------------------*/


	//to view the country and state 
	public function showLocation()
	{
	$data['location_list'] = $this->master_model->getLocation();	
	$data['Country_list']=$this->master_model->getCountryList();
	$data['CountryState_list']=$this->master_model->getCountrystatelist();
	$this->load->view('masterLocation', $data);
	//echo json_encode($data);
	}

	

	//to view the form to add country, state and city
	public function addLocation()
	{
	$til['list']=$this->master_model->getCountry();
	$this->load->view('insertLocation', $til);

	}





	



	//to get location ID 
	public function editLocationId($id = NULL){
		//$id = $this->uri->segment(3);
		$data['location'] = $this->master_model->getById($id);
		$data['list']=$this->master_model->getCountry();

		$this->load->view('editLocation', $data);
		//echo  json_encode($data);
	}


	//update location and view 
	public function updateLocation()
	{

		$mdata['country_id']=$_POST['country_id'];
		$mdata['state_id']=$_POST['state_id'];
		$mdata['city_name']=$_POST['city'];
		$mdata['status']=$_POST['status'];

		$res=$this->master_model->updateLocation($mdata, $_POST['id']);

		if($res){
			header('location:'.base_url()."admin/showLocation");
		}

	}




	

	

	//to load location state and city
	public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		//$this->load->host_model('model');
		$result=$this->master_model->getData($loadType,$loadId);
		$HTML="";
		
		if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}	





}

