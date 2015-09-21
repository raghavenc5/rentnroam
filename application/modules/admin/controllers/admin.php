<?php
class Admin extends MX_Controller{
	function __construct()
	{	
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('master_model');		
		$this->load->library('upload');
		$this->load->library('form_validation');
		
	}

	//to view the country and state 
	public function showLocation()
	{
	$data['location_list'] = $this->master_model->getLocation();	
	$data['Country_list']=$this->master_model->getCountryList();
	$data['CountryState_list']=$this->master_model->getCountrystatelist();
	$this->load->view('masterLocation', $data);
	//echo json_encode($data);
	}

	//get country
	public function getCountrydropdown()
	{
		$res = $this->master_model->getCountrydropdown();
		echo json_encode($res);
	}

	//to view the form to add country, state and city
	public function addLocation()
	{
	$til['list']=$this->master_model->getCountry();
	$this->load->view('insertLocation', $til);

	}


	//insert country 
	public function insertCountry($countryName = NULL)
	{
		$udata['country_name'] = $countryName;
		$udata['status'] = 'Active';
		$country = $udata['country_name'];
		if($country != null)
		{
			$res = $this->master_model->addCountry($udata);
			if($res)
			{
				$data["status"] = 200;
				$data["message"] = "Inserted";
				echo json_encode($data);
			}
		}
		else
		{
				$data["status"] = 400;
				$data["message"] = "add Country ....";
				echo json_encode($data);
		}
	}


	//to insert new location from insertLocation view page
	public function insertNewlocation()
	{

		$udata['country'] = $this->input->post('country');
		$CountryID = $udata['country'];

		$udata['state'] = $this->input->post('state');
		$StateID = $udata['state'];

		$udata['city'] = $this->input->post('city');

		$udata['status'] = $this->input->post('status');
		$City = $udata['city'];

		$status = $udata['status'];		
		if($CountryID == "-1")
		{
					$data['status'] = 400;
					$data['message'] = 'Select Country';
					echo json_encode($data);
		}	
		else if($StateID == "-1")
		{
					$data['status'] = 400;
					$data['message'] = 'Select State';
					echo json_encode($data);	
		}	
		else if($City == NULL)
		{
					$data['status'] = 400;
					$data['message'] = 'Fill City';
					echo json_encode($data);		
		}	
		else{

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
					
					
					if($res != NULL){

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


	//insert Country and state
	public function insertCountrystate()
	{
		$udata['country_id'] = $this->input->post('country_id');
		$country_id = $udata['country_id'];
		$udata['state_name'] = $this->input->post('state');
		$state = $udata['state_name'];
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
		else{
			$res = $this->master_model->insertCountrystate($udata);
			if($res){
				$data['status'] = 200;
				$data['message'] = "Inserted";
				echo json_encode($data);
			}
		}
		
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


	//update country and view 
	public function editCountry($countryName=null, $id=null)
	{

		if($countryName != null)
		{
			$res=$this->master_model->updateCountry($countryName, $id);
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

	//delete location 
	public function deleteLocation($id)
	{
		$this->master_model->deleteLocation($id);
		//$this->showLocation();
		header('location:'.base_url()."admin/showLocation");
	}

	//delete country 
	public function deleteCountry($id = NULL)
	{
		$res = $this->master_model->deleteCountry($id);
		//$this->showLocation();
		if($res)
		{
			//header('location:'.base_url()."admin/showLocation");
				$data['status'] = 400;
				$data['message'] = "Deleted...";
				echo json_encode($data);
		}
		else{
				$data['status'] = 200;
				$data['message_deleteCountry'] = "you cannot delete";
				echo json_encode($data);
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

