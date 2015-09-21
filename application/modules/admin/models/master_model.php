<?php

class Master_model extends CI_Model {

	
		function __construct()

		{
			parent::__construct();
			$this->load->database();
		}

		//countryname validation checking
		public function checkCountry($countryName)
		{
			$this->db->select('*')
					->from(COUNTRY)
					->where('country_name',$countryName);
					$query1 = $this->db->get();
				return $query1->result();
		}
		//state name validation checking
		public function checkState($state)
		{
				$this->db->select('*')
					->from(STATE)
					->where('state_name',$state);
					$query1 = $this->db->get();
				return $query1->result();
		}

		public function tagCheck($tag)
		{
			$this->db->select('*')
					->from('master_tag')
					->where('tag',$tag);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//insert country
		public function addCountry($data)
		{
			return $this->db->insert(COUNTRY, $data);
		}

		//insert tag
		public function addTag($udata)
		{
			return $this->db->insert('master_tag', $udata);
		}

		//update country
		public function updateCountry($data, $id)
		{
			//$data = array('country_name'=>$countryName, 'status'=>'Active');
			$this->db->where('master_country.country_id',$id);
			return $this->db->update('master_country', $data);
		}
		
		public function editTag($udata, $id)
		{
			$this->db->where('master_tag.id',$id);
			return $this->db->update('master_tag', $udata);
		}

		public function updateState($udata, $id)
		{
			$this->db->where('master_state.id',$id);
			return $this->db->update('master_state', $udata);
		}

		//update master room type with image
		public function updateMasterroomImage($roomtype, $title, $url, $id)
		{
			$data=array('roomtype'=>$roomtype,'title'=>$title, 'images'=> $url);
			$this->db->where('room_type_id',$id);		
			return $this->db->update('master_room_type', $data);
		}
		//update master room type with no image
		public function updateMasterroom($roomtype, $title, $id)
		{
			$data=array('roomtype'=>$roomtype,'title'=>$title);
			$this->db->where('room_type_id',$id);		
			return $this->db->update('master_room_type', $data);
		}

		//get country by id
		public function getCountrybyId($id)
		{
			$this->db->select('*')
					->from(COUNTRY)
					->where('country_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
				

		}
		public function getAmenitiestypeByID($id)
		{
			$this->db->select('*')
					->from(AMENETIES_TYPE)
					->where('amenities_type_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//get roomtype by id
		public function getRoomtypebyID($id)
		{
			$this->db->select('*')
					->from('master_room_type')
					->where('room_type_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
				

		}

		//get state by id
		public function getStatebyId($id)
		{
			

				$this->db->select('t1.*, t2.country_name')
					->from(STATE. ' AS t1,'.COUNTRY.' AS t2')
					->where('t1.country_id = t2.country_id')
					->where('id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//get country_id by country name
		public function getCountryID($countryName)
		{
			$this->db->select('country_id')
			->from(COUNTRY)
			->where('country_name', $countryName);
			$query1 = $this->db->get();
				return $query1->result();
		}

		//delete country
		public function removeCountry($id)
		{
			$this->db->where('country_id', $id);
			return $this->db->delete(COUNTRY);
		}

		//delete smiley
		public function deletePropertysmiley($id)
		{
			$this->db->where('smiley_id', $id);
			return $this->db->delete('master_smiley');
		}

		



		//insert state
		public function insertCountrystate($data)
		{
			return $this->db->insert(STATE, $data);
		}

		//delete state
		public function removeState($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete(STATE);
		}

		//extract state by country id
		public function getStatebyCid($id)
		{
			$this->db->select('id, state_name')
					->from(STATE)
					->where('country_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}


		public function getPropertytagByID($id)
		{
			$this->db->select('*')
					->from('master_tag')
					->where('id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//extract roomtype by id
		public function getRoomtype($id)
		{
			$this->db->select('*')
					->from('master_room_type')
					->where('room_type_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//extract amenities subtype by id
		public function getAmenSubtype($id)
		{
			$this->db->select('*')
					->from('master_amenities')
					->where('amenities_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//extract master amenities sub type by id
		public function getAmenitieSubstypeByID($id)
		{
					$this->db->select('t1.*, t2.amenities_type_name')
					->from('master_amenities AS t1, master_amenities_type AS t2')
					->where('t1.amenities_type = t2.amenities_type_id')
					->where('amenities_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//extract master smiley by id
		public function getSmileybyId($id)
		{
					$this->db->select('*')
					->from('master_smiley')
					->where('smiley_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}



		//insert new location to db
		public function insertLocation($Country_id, $State_id, $CityName, $status)
		{
			$data=array('country_id'=>$Country_id,'state_id'=>$State_id, 'city_name'=> $CityName, 'status'=> $status);		
			return $this->db->insert(CITY, $data);
		

		}

		//delete city
		public function deleteCity($id)
		{
		 	$this->db->where('id', $id);
			return $this->db->delete(CITY);
		}

		//delete roomtype
		public function deleteRoomtype($id)
		{
			$this->db->where('room_type_id', $id);
			return $this->db->delete('master_room_type');
		}


		//delete amenities type
		public function deleteAmenitiestype($id)
		{
			$this->db->where('amenities_type_id', $id);
			return $this->db->delete('master_amenities_type');
		}

		//delete amenities subtype
		public function deleteAmSubtype($id)
		{
			$this->db->where('amenities_id', $id);
			return $this->db->delete('master_amenities');
		}


		//delete property type
		public function deletePropertytype($id)
		{
			$this->db->where('property_type_id', $id);
			return $this->db->delete('master_property_type');
		}

		//delete property tag
		public function deletePropertytag($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('master_tag');
		}

		public function getCityByID($id)
		{
			$this->db->select('t1.*, t2.state_name, t3.country_name')
					->from(CITY.' AS t1, '.STATE.' AS t2, '.COUNTRY.' AS t3')
					->where('t1.country_id = t3.country_id')
					->where('t1.state_id = t2.id')
					->where('t1.id ='.$id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//update city 
		public function updateCity($udata, $id)
		{
				$this->db->where('master_city.id',$id);
			return $this->db->update('master_city', $udata);
		}

		public function insertMasterroom($d1, $d2, $d3)
		{
			$data=array('roomtype'=>$d1,'title'=>$d2, 'images'=> $d3);
			
			return $this->db->insert('master_room_type', $data);
		}

		//insert master property type
		public function addPropertyType($udata)
		{
			return $this->db->insert('master_property_type', $udata);
		}

		//insert 
		public function addSmiley($url)
		{
			$udata =array('smiley_icon'=>$url);
			return $this->db->insert('master_smiley', $udata);
		}

		//update amenities type
		public function updateAmenitiesType($udata, $id)
		{
			$this->db->where('master_amenities_type.amenities_type_id',$id);
			return $this->db->update('master_amenities_type', $udata);
		}


		//insert master amenities
		public function addAmenitiestype($udata)
		{
			return $this->db->insert('master_amenities_type', $udata);
		}

		//get amenities type
		public function getAmenitiestype()
		{
			$this->db->select('*')
				->from('master_amenities_type');
				$query1 = $this->db->get();
				return $query1->result();
		}

		//insert amenities subtype
		public function addAmenitiesSubtype($udata)
		{
			return $this->db->insert('master_amenities', $udata);
		}

		//get id by amenity type
		public function getIdamenities($atype)
		{
					$this->db->select('*')
					->from('master_amenities_type')
					->where('amenities_type_name',$atype);
					$query1 = $this->db->get();
				return $query1->result();
		}

		//update sub amenities master with no images
		public function updateMasterSubAmenities($amenitiestype, $asubtype, $status, $id)
		{
			$data=array('amenities_type'=>$amenitiestype,'amenities_subtype'=>$asubtype, 'status'=>$status);
			$this->db->where('amenities_id',$id);		
			return $this->db->update('master_amenities', $data);
		}

		//update smiley 
		public function updateSmiley($url, $id)
		{
			$data=array('smiley_icon'=>$url);
			$this->db->where('smiley_id',$id);		
			return $this->db->update('master_smiley', $data);
		}

		//update sub amenities master with images
		public function updateMasterSubAmenitiesImg($amenitiestype, $asubtype, $url, $status, $id)
		{
			$data=array('amenities_type'=>$amenitiestype,'amenities_subtype'=>$asubtype, 'images'=>$url, 'status'=>$status);
			$this->db->where('amenities_id',$id);		
			return $this->db->update('master_amenities', $data);
		}

		//update propertytype with image
		public function updateMasterPropertytypeImg($propertytype , $buttontype, $url,  $id)
		{
			$data=array('property_type'=>$propertytype,'element_type'=>$buttontype, 'images'=>$url);
			$this->db->where('property_type_id',$id);		
			return $this->db->update('master_property_type', $data);
		}

		//update propertytype with no image
		public function updateMasterPropertytype($propertytype , $buttontype, $id)
		{
			$data=array('property_type'=>$propertytype,'element_type'=>$buttontype);
			$this->db->where('property_type_id',$id);		
			return $this->db->update('master_property_type', $data);
		}




		//update policy 
		public function updatePolicy($policy, $id)
		{
			//$data=array('policy'=>$policy);
			$this->db->where('id',$id);		
			return $this->db->update('master_cancellation_policy', $policy);
		}
		
		//delete policy
		public function deletePropertypolicy($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('master_cancellation_policy');
		}
		
		
		//extract master policy by id
		public function getPolicybyId($id)
		{
					$this->db->select('*')
					->from('master_cancellation_policy')
					->where('id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}
		//insert 
		public function addPolicy($policy)
		{
			//$udata =array('policy'=>$policy);
			return $this->db->insert('master_cancellation_policy', $policy);
		}

		public function policyCheck($policy)
		{
				$this->db->select('*')
					->from('master_cancellation_policy')
					->where('policy',$policy);
					$query1 = $this->db->get();
				return $query1->result();
		
		}




		//update period
		public function updatePeriod($period, $id)
		{
			//$data=array('policy'=>$policy);
			$this->db->where('id',$id);		
			return $this->db->update('master_price_period', $period);
		}
		
		//delete policy
		public function deletePeriod($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('master_price_period');
		}
		
		
		//extract master policy by id
		public function getPeriodbyId($id)
		{
					$this->db->select('*')
					->from('master_price_period')
					->where('id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}
		//insert 
		public function addPeriod($period)
		{
			//$udata =array('policy'=>$policy);
			return $this->db->insert('master_price_period', $period);
		}

		public function periodCheck($period)
		{
				$this->db->select('*')
					->from('master_price_period')
					->where('period',$period);
					$query1 = $this->db->get();
				return $query1->result();
		
		}








		//update Season
		public function updateSeason($season, $id)
		{
			//$data=array('policy'=>$policy);
			$this->db->where('id',$id);		
			return $this->db->update('master_price_seasontype', $season);
		}
		
		//delete Season
		public function deleteSeason($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('master_price_seasontype');
		}
		
		
		//extract master season by id
		public function getSeasonbyId($id)
		{
					$this->db->select('*')
					->from('master_price_seasontype')
					->where('id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}
		//insert 
		public function addSeason($period)
		{
			//$udata =array('policy'=>$policy);
			return $this->db->insert('master_price_seasontype', $period);
		}

		public function seasonCheck($period)
		{
				$this->db->select('*')
					->from('master_price_seasontype')
					->where('season_type',$period);
					$query1 = $this->db->get();
				return $query1->result();
		
		}
		
		

		/*----------------------------------------------*/

		//extract country, state and city
		public function getLocation()
		{

				$this->db->select('t1.*, t2.state_name, t3.country_name')
					->from(CITY.' AS t1, '.STATE.' AS t2, '.COUNTRY.' AS t3')
					->where('t1.country_id = t3.country_id')
					->where('t1.state_id = t2.id');
					$query1 = $this->db->get();
				return $query1->result();

		}

		//extract country and state
		public function getCountrystatelist()
		{
			$this->db->select('t1.*, t2.country_name')
					->from(STATE.' AS t1, '.COUNTRY.' AS t2')
					->where('t1.country_id = t2.country_id');
					$query1 = $this->db->get();
				return $query1->result();

		}

		//extract country
		public function getCountrydropdown()
		{
			$this->db->select('*')
			->from(COUNTRY);
			$query = $this->db->get();
			return $query->result();
		}

		
		
		
		//extracting country_id
		public function countryCheck($Country)
		{
			$this->db->select('country_id')
			->from(COUNTRY)
			->where('country_name', $Country);

				$query = $this->db->get();
				return $query->result();
		}


		//extracting state_id
		public function stateCheck($State)
		{
			$this->db->select('id')
			->from(STATE)
			->where('state_name', $State);
				$query = $this->db->get();
				return $query->result();
		}


		//extracting city
		public function cityCheck($City)
		{
			$query = $this->db->get_where(CITY,array('city_name'=>$City));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		//check property type
		public function checkPropertytype($property_type)
		{
			$query = $this->db->get_where('master_property_type',array('property_type'=>$property_type));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
	
		public function getProptypeByID($id)
		{
			$this->db->select('*')
					->from('master_property_type')
					->where('property_type_id', $id);
					$query1 = $this->db->get();
				return $query1->result();

		}		

		public function getimgRoomtype($roomId)
		{
				$this->db->select('*')
					->from('master_room_type')
					->where('room_type_id', $roomId);
					$query1 = $this->db->get();
				return $query1->result();
		}

		public function getimgPropertytype($id)
		{
			$this->db->select('*')
					->from('master_property_type')
					->where('property_type_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		public function getimgSmiley($id)
		{
			$this->db->select('*')
					->from('master_smiley')
					->where('smiley_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}

		public function getimgASubtype($id)
		{
			$this->db->select('*')
					->from('master_amenities')
					->where('amenities_id', $id);
					$query1 = $this->db->get();
				return $query1->result();
		}
		

		//get id of location from master_city table
		public function getById($id){
			//$query = $this->db->get_where('admint_temp',array('id'=>$id));
			//return $query->row_array();
			$this->db->select('t1.*, t2.state_name, t3.country_name')
					->from(CITY.' AS t1, '.STATE.' AS t2, '.COUNTRY.' AS t3')
					->where('t1.country_id = t3.country_id')
					->where('t1.state_id = t2.id')
					->where('t1.id ='.$id);
					$query = $this->db->get();
				return $query->result();
		}

		//update location 
		public function updateLocation($data,$id)
		{

		$this->db->where('master_city.id',$id);
		return $this->db->update('master_city', $data);

		}

		

		function getCountryList()
		{
		   $this->db->select('*');
		   $this->db->from('master_country');
		   $query=$this->db->get();
		   return $query->result();
		}	



		//load country for location search
			function getCountry()
			{
			   $this->db->select('country_id,country_name');
			   $this->db->from('master_country');
			   $this->db->order_by('country_name', 'asc');
			   $query=$this->db->get();
			   return $query;
			}

			//load state and city
			function getData($loadType,$loadId)
			{
			   if($loadType=="state"){
				$fieldList='id,state_name as name';
				$table='master_state';
				$fieldName='country_id';
				$orderByField='state_name';
			   }
			   $this->db->select($fieldList);
			   $this->db->from($table);
			   $this->db->where($fieldName, $loadId);
			   $this->db->order_by($orderByField, 'asc');
			   $query=$this->db->get();
			   return $query;
			 }

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







}		