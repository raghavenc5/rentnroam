<?php

class Host_model extends Host_Generic_Model
{

	
		function __construct()

		{
			parent::__construct();
			$this->load->database();
		}
		
		//extracting all room type from "mater_room_type" table
		function extractRomType(){
			$query = $this->db->get(ROOM_TYPE);
			return $query->result();
		}
		
		
		//extracting all property type from "master_property_type" table
		function extractProperType(){
			$query = $this->db->get(PROPERTY_TYPE);
			return $query->result();
		}
		
		
		//extracting tab status
		function extractStatustab($property_id)
		{
				$this->db->select('*');
				$this->db->from('properties_tab_state');
				$this->db->where('property_id', $property_id);
				$query = $this->db->get();
				return $query->result();
		}
		
		
		//extracting city
		public function ExtractCity()
		{
		
			//$query = $this->db->query( 'SELECT * FROM '.CITY );
			//return $query->result();
			$query = "select `c`.`id`, `c`.`country_id`, `c`.`state_id`, concat(`c`.`city_name`, ', ', `s`.`state_name`) as `city_state_combo_name` from `master_city` as `c` inner join `master_state` as `s` on `c`.`state_id` = `s`.`id` order by `c`.`id` desc";
			$result = $this->db->query($query)->result();

			return $result;
		}
		
		

		//checking user exist or not
		function user_exists($user)
		{
			$query = $this->db->get_where(USER,array('user_id'=>$user));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		
		}
		
		//check input city
		function city_check($city){
			    $this->db->select('id');
				$this->db->from(CITY);
				$this->db->where('city_name', $city );
				$query = $this->db->get();
				return $query->result();
						
		}
		
		//get city name by giving country_id
		function extractStateCountry($country_id){
				$this->db->select('*');
				$this->db->from(STATE);
				$this->db->where('country_id', $country_id);
				$query = $this->db->get();
				return $query->result();
		
		}
		
		//inserting-creating new property to database					
		function create_property($udata1, $udata2, $udata3, $udata4, $udata5)
		{			
			//$status = 0;
			$sql = 'INSERT INTO '.PROPERTY.'(property_type_id, status, room_type_id, guest_allow, city_id, user_id)
			VALUES ('.$udata1.', "Inactive", '.$udata2.', "'.$udata3.'", '.$udata4.', '.$udata5.')';

			if ($this->db->query($sql) == TRUE) {
			$last_id = $this->db->insert_id();
				return $last_id;
			} 			
		}
		
		//checking property exists or not
		function property_check($property_id){		
			$query = $this->db->get_where(PROPERTY,array('property_id'=>$property_id));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		
		}

		//checking room_id exists or not
		function checkRoom($room_id){
			$query = $this->db->get_where(PROPERTY_ROOMS,array('room_id'=>$room_id));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}

		}
		
		//extract cancellation policy
		function getPolicy(){
				$this->db->select('*');
				$this->db->from(POLICY);
				$query = $this->db->get();
				return $query->result();
		}
		
		//extract tags
		function getTag(){
				
				$this->db->select('*');
				$this->db->from(TAGS);
				$query = $this->db->get();
				return $query->result();
		
		}
		
		
		//update-insert property to database(2nd step Property Overview)
		function insert_overview($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7)
		{
			$data=array('property_title'=>$udata1,'description'=>$udata2, 'neighbourhood_highlight'=> $udata3, 'house_rule'=>$udata4, 'min_night_stay'=>$udata5);
			return $this->db->where('property_id',$udata7)->update(PROPERTY,$data);
			
		}

		//inserting-rooms 					
		function insert_room($udata1, $udata2, $udata3, $udata4, $udata5)
		{			
			$data=array('room_name'=>$udata1,'room_type_id'=>$udata2, 'guest_no'=> $udata3, 'room_details'=>$udata4, 'property_id'=>$udata5, 'status'=>'Inactive');
			//return $this->db->where('property_id',$udata5)->update(PROPERTY,$data);
		     $this->db->insert(PROPERTY_ROOMS,$data);
		     $last_id = $this->db->insert_id();
				return $last_id;	
		}
		
		//extracting entire apartment room type
		function extractRoomTypeApartment(){
			$query = $this->db->query( 'SELECT * FROM '.ROOM_TYPE.' WHERE room_type_id in (1, 2)' );
			return $query->result(  );		
		}


		//inserting images
		public function insert_images($data)
		{								
			return $this->db->insert_batch(PROPERTY_IMAGES,$data);
		}



		//inserting youtube id
		public function insert_video($records)
		{
			return $this->db->insert_batch(PROPERTY_VIDEO,$records);		
		}



		function delRoom($room_id)
		{
		//return $this->db->delete(PROPERTY_ROOMS, array('room_id' => $room_id));
			//return $del->result();
				   $this->db->where('room_id', $room_id);
			return $this->db->delete(PROPERTY_ROOMS);
		}	


		

		
		//extracting all room of particular property
		function extractPropertyRooms($property_id)
		{		
			
				$this->db->select('t1.*, t2.roomtype')
					->from(PROPERTY_ROOMS.' AS t1, '.ROOM_TYPE.' AS t2')
					->where('t1.property_id ='.$property_id)
					->where('t1.room_type_id = t2.room_type_id');
					$query = $this->db->get();
				return $query->result();
			
		}	
		
		
		//room_name, room_type_id, guest_no, room_details, property_id, status
		//update each room of particular
		function updateRoom($udata1, $udata2, $udata3, $udata4, $udata5, $udata7){
			
			$data=array('room_name'=>$udata1,'room_type_id'=>$udata2, 'guest_no'=> $udata3, 'room_details'=>$udata4, 'property_id'=>$udata5, 'room_id'=>$udata7);
			
			return $this->db->where('room_id',$udata7)
			       ->update(PROPERTY_ROOMS,$data);
		}
		
		
		
				
		//extract common type amenities
		function extraType(){			
				
				$this->db->select('*');
				$this->db->from(AMENETIES);
				$this->db->where('amenities_type', '3' );
				$query = $this->db->get();
				return $query->result();
		}
		
		//extract extra type amenities
		function featureType(){
				$this->db->select('*');
				$this->db->from(AMENETIES);
				$this->db->where('amenities_type', '2' );
				$query = $this->db->get();
				return $query->result();
		}
		
		//extract feature type amenities
		function commonType(){
				$this->db->select('*');
				$this->db->from(AMENETIES);
				$this->db->where('amenities_type', '1' );
				$query = $this->db->get();
				return $query->result();
		}
		
		//extract safety type amenities
		function safetyType(){
				$this->db->select('*');
				$this->db->from(AMENETIES);
				$this->db->where('amenities_type', '4' );
				$query = $this->db->get();
				return $query->result();
		}

		
		//inserting amenities of particular properties
		public function insert_amenities($data)
		{		
			 return $this->db->insert_batch(PROPERTY_AMENITIES,$data);
				
		}
		
		//inserting property tags
		public function insertTag($records)
		{
			 return $this->db->insert_batch(PROPERTY_TAGS,$records);
		}
		
		//update-insert property to database(5th step Listing Info)
		function insert_listing_info($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7, $udata8, $udata9, $udata10, $udata11)
		{				
			$data=array('property_type_id'=>$udata1,'room_type_id'=>$udata2, 'guest_allow'=> $udata3, 'bedrooms'=>$udata4, 'bed'=>$udata5, 'bathrooms'=>$udata6, 'check_in_time'=>$udata7, 'check_out_time'=>$udata8, 'cancellation_policy_id'=>$udata11);			
			//return $this->db->where('property_id',$udata7)->update(PROPERTY,$data);
			return $this->db->where('property_id',$udata10)->update(PROPERTY,$data);	

		}
	
		
		
		//update-insert property address to database(6th step Address )
		function insert_address($udata1, $udata2, $udata3, $udata4, $udata5, $udata6, $udata7, $udata8, $udata9, $udata10, $udata11)
		{
			$address = $udata1.' '.$udata2;
				
			$data=array('address_line1'=>$address,'country_id'=>$udata3, 'state_id'=> $udata4, 'city_id'=>$udata5, 'area'=>$udata6, 'zip'=>$udata7, 'latitude'=>$udata8, 'longitude'=>$udata9);
			
			return $this->db->where('property_id',$udata11)
			       ->update(PROPERTY,$data);	

		}
		
		function extractCountry(){
				$this->db->select('*');
				$this->db->from(COUNTRY);
				$query = $this->db->get();
				return $query->result();
		}
		
		
		function extractState(){
				$this->db->select('*');
				$this->db->from(STATE);
				$query = $this->db->get();
				return $query->result();
		}
		
		
		//insert seasonal price  
		function insert_prePrice($table, $data)
		{
			return $this->db->insert_batch($table, $data);

		}
		
		//insert extra price 
		function insert_ExtraPrice($clean_charge, $guest_charge, $security_charge, $propId)		
		{			
			$data=array('clean_charge'=>$clean_charge,'guest_charge'=>$guest_charge, 'security_charge'=> $security_charge);			
			return $this->db->where('property_id',$propId)
			       ->update(PROPERTY,$data);				
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
			   }else{
				$fieldList='id,city_name as name';
				$table='master_city';
				$fieldName='state_id';
				$orderByField='city_name';
			   }
			   $this->db->select($fieldList);
			   $this->db->from($table);
			   $this->db->where($fieldName, $loadId);
			   $this->db->order_by($orderByField, 'asc');
			   $query=$this->db->get();
			   return $query;
			 }

				
	public function saveUser($data)
    {
        $this->db->insert('users', $data);
        
        return $this->db->insert_id();
    }
    
    public function getUserDataFromDb($email)
    {
        $result = $this->db->select('*')->from('users')->where('email', $email)->get()->result_array();
        return (isset($result[0])) ? $result[0] : null;
    }
    
    
    
    /**
     * new db operation methods start
     */
    
    private $propertyTable = array(
        'table_name' => 'properties',
        'primary_key' => 'property_id',
        'foreign_keys' => array(
            'user_id',
        ),
        'join_tables' => array(
            'users',
        ),
        'status_keys' => array(
            'status',
        ),
    );
    
    private $propertyTypeTable = array(
        'table_name' => 'master_property_type',
        'primary_key' => 'property_type_id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(),
    );
    
    private $roomTypeTable = array(
        'table_name' => 'master_room_type',
        'primary_key' => 'room_type_id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(),
    );
    
    private $policyTable = array(
        'table_name' => 'master_cancellation_policy',
        'primary_key' => 'id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(),
    );
    
    private $tagTable = array(
        'table_name' => 'master_tag',
        'primary_key' => 'id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(),
    );
    
    private $propertyPhotoTable = array(
        'table_name' => 'properties_images',
        'primary_key' => 'property_image_id',
        'foreign_keys' => array(
            'property_id',
        ),
        'join_tables' => array(
            'properties',
        ),
        'status_keys' => array(),
    );
    
    private $propertyVideoTable = array(
        'table_name' => 'properties_video',
        'primary_key' => 'property_video_id',
        'foreign_keys' => array(
            'property_id',
        ),
        'join_tables' => array(
            'properties',
        ),
    );
    
    private $countryTable = array(
        'table_name' => 'master_country',
        'primary_key' => 'country_id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(
            'status',
        ),
    );
    
    private $amenityTable = array(
        'table_name' => 'master_amenities',
        'primary_key' => 'amenities_id',
        'foreign_keys' => array(
            'amenities_type',
        ),
        'join_tables' => array(
            'master_amenities_type',
        ),
        'status_keys' => array(
            'status',
        ),
    );
    
    private $amenityTypesTable = array(
        'table_name' => 'master_amenities_type',
        'primary_key' => 'amenities_type_id',
        'foreign_keys' => array(),
        'join_tables' => array(),
        'status_keys' => array(
            'status',
        ),
    );
    
    private $propertyAmenitiesTable = array(
        'table_name' => 'properties_amenities',
        'primary_key' => 'property_amenities_id',
        'foreign_keys' => array(
            'property_id',
            'amenities_id',
        ),
        'join_tables' => array(
            'properties',
            'master_amenities',
        ),
        'status_keys' => array(),
    );
    
    private $propertyTagsTable = array(
        'table_name' => 'properties_tag',
        'primary_key' => 'id',
        'foreign_keys' => array(
            'property_id',
            'master_tag_id',
        ),
        'join_tables' => array(
            'properties',
            'master_tag',
        ),
        'status_keys' => array(),
    );
    
    private $propertyPriceTable = array(
        'table_name' => 'properties_price',
        'primary_key' => 'price_id',
        'foreign_keys' => array(
            'master_price_seasontype_id',
        ),
        'join_tables' => array(
            'master_price_seasontype',
        ),
        'status_keys' => array(),
    );
    
    private $validate = array(
        'property_photo' => array(
            'video_id' => array(
                'field' => 'property_photo[video_id]',
                'label' => 'youtube vedio id',
                'rules' => 'required'
            )
        ),
        'pricing' => array(
            'season1_daily' => array(
                'field' => 'season1_daily',
                'label' => 'daily price for season 1',
                'rules' => 'required|numeric'
            ),
            'season1_weekly' => array(
                'field' => 'season1_weekly',
                'label' => 'weekly price for season 1',
                'rules' => 'required|numeric'
            ),
            'season1_monthly' => array(
                'field' => 'season1_monthly',
                'label' => 'monthly price for season 1',
                'rules' => 'required|numeric'
            ),
            'season1_weekend' => array(
                'field' => 'season1_weekend',
                'label' => 'weekend price for season 1',
                'rules' => 'required|numeric'
            ),
            'clean_charge' => array(
                'field' => 'clean_charge',
                'label' => 'cleaning charge',
                'rules' => 'numeric'
            ),
            'guest_charge' => array(
                'field' => 'guest_charge',
                'label' => 'guest charge',
                'rules' => 'numeric'
            ),
            'security_charge' => array(
                'field' => 'security_charge',
                'label' => 'security charge',
                'rules' => 'numeric'
            ),
        ),
    );
    
    public function fetchAmenities()
    {
//        $query = "select * from " . $this->amenityTable['table_name'] . " as ma inner join " . $this->amenityTypesTable['table_name'] . " as mat on ma." . $this->amenityTable['foreign_keys'][0] . " = mat." . $this->amenityTypesTable['primary_key'] . " where mat." . $this->amenityTypesTable['status_keys'][0] . " = 1 and ma." . $this->amenityTable['status_keys'][0] . " = 1";
//        
//        $result = $this->db->query($query)->result();
        
        $result = $this->db->select('*')
                ->from('master_amenities')
                ->get()
                ->result();
        
        return $result;
    }
    
    public function fetchPropertyTypes()
    {
        $result = $this->db->select('*')
                ->from($this->propertyTypeTable['table_name'])
                ->get()
                ->result();
        
        return $result;
    }
    
    public function fetchRoomTypes()
    {
        $result = $this->db->select('*')
                ->from($this->roomTypeTable['table_name'])
                ->get()
                ->result();
        
        return $result;
    }
    
    public function fetchCancellationPolicies()
    {
        $result = $this->db->select('*')
                ->from($this->policyTable['table_name'])
                ->get()
                ->result();
        
        return $result;
    }
    
    public function fetchTags()
    {
        $result = $this->db->select('*')
                ->from($this->tagTable['table_name'])
                ->get()
                ->result();
        
        return $result;
    }
    
    public function saveOverview($overviewSaveData, $propertyId)
    {
        $this->db->trans_start();
        
        $this->db->where($this->propertyTable['primary_key'], $propertyId); 
        $this->db->update($this->propertyTable['table_name'], $overviewSaveData);
        
        $this->db->where('parent_id', $propertyId); 
        $this->db->update('properties', $overviewSaveData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function savePropertyVideo($propertyVideoSaveData)
    {
        $this->db->trans_start();

        $result = $this->db->select('*')->from($this->propertyVideoTable['table_name'])->where($this->propertyVideoTable['foreign_keys'][0], $propertyVideoSaveData['property_id'])->get()->result();

        if ($result) {
			$this->db->where($this->propertyVideoTable['foreign_keys'][0], $propertyVideoSaveData['property_id']);
			$this->db->update($this->propertyVideoTable['table_name'], array('youtube_video_id' => $propertyVideoSaveData['youtube_video_id']));
		} else {
			$this->db->insert($this->propertyVideoTable['table_name'], $propertyVideoSaveData);
		}        
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }


    public function savePropertyPhotos($propertyPhotoSaveData)
    {
        $this->db->trans_start();
        
        $this->db->insert_batch($this->propertyPhotoTable['table_name'], $propertyPhotoSaveData);      
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    public function deletePhoto($propertyImageId)
    {
		$this->db->where($this->propertyPhotoTable['primary_key'], $propertyImageId);

		$this->db->delete($this->propertyPhotoTable['table_name']);
	}
    
    public function savePricing($pricingData, $additionalPricingData, $propertyId, $childPropertyList) {
        $this->db->trans_start();
        
		$this->db->where('property_id', $propertyId);

		$this->db->delete('properties_price');
        
        if ($childPropertyList) {
            $this->db->where_in('property_id', $childPropertyList);

            $this->db->delete('properties_price');
        }

        $this->db->insert_batch('properties_price', $pricingData);
        
        $this->db->where('property_id', $propertyId);
        
        $this->db->update('properties', $additionalPricingData);
        
        $this->db->where('parent_id', $propertyId);
        
        $this->db->update('properties', $additionalPricingData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function saveAmenities($amenitiesSaveData, $propertyId, $childPropertyList)
    {        
        $this->db->trans_start();

        $this->db->where('property_id', $propertyId);

        $this->db->delete('properties_amenities');
        
        if ($childPropertyList) {
            $this->db->where_in('property_id', $childPropertyList);

            $this->db->delete('properties_amenities');
        }
        
        $this->db->insert_batch('properties_amenities', $amenitiesSaveData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function saveListing($listingData, $tagsData, $propertyId, $childPropertyList)
    {
        $this->db->trans_start();
        
        $this->db->where('property_id', $propertyId);
        
        $this->db->update('properties', $listingData);
        
        if ($childPropertyList) {
            $this->db->where_in('property_id', $childPropertyList);
        
            $this->db->update('properties', $listingData);
        }

        $this->db->where('property_id', $propertyId);

        $this->db->delete('properties_tag');
        
        if ($childPropertyList) {
            $this->db->where_in('property_id', $childPropertyList);
            
            $this->db->delete('properties_tag');
        }
        
        $this->db->insert_batch('properties_tag', $tagsData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function saveLocation($locationSaveData, $propertyId)
    {
        $this->db->trans_start();
        
        $this->db->where($this->propertyTable['primary_key'], $propertyId);
        
        $this->db->update($this->propertyTable['table_name'], $locationSaveData);
        
        $this->db->where('parent_id', $propertyId);
        
        $this->db->update($this->propertyTable['table_name'], $locationSaveData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function validatePropertyPhotoData( $propertyPhoto ){
        return $this->validateUserData( $propertyPhoto, $this->validate['property_photo'] );
    }
    
    public function validatePricingData( $pricings ){
        return $this->validateUserData( $pricings, $this->validate['pricing'] );
    }

    public function isThisPropertyPhoto($propertyId, $fileName)
    {
		$query = "select `property_image_id` from `properties_images` where `images` = '$fileName' and `property_id` = $propertyId";
		$result = $this->db->query($query)->result_array();

		return (isset($result[0]['property_image_id'])) ? $result[0]['property_image_id'] : null;
	}

	public function getPhotoDataFromDb($propertyId, $fileName)
	{
		$query = "select * from `properties_images` where `images` = '$fileName' and `property_id` = $propertyId";
		$result = $this->db->query($query)->result_array();

		return $result[0];
	}

    public function countPropertiesByHostId($hostId, $searchQuery, $sortKey, $sortDirection)
    {
    	$query = "
    		select
    		count(`temp_properties`.`property_id`) as `property_count`
    		from(
    			select
	    		`p`.`property_id`,
	    		`p`.`property_title`,
	    		concat(`p`.`address_line1`, '; ', `ct`.`city_name`, '; ', `s`.`state_name`, '; ', `co`.`country_name`, '; ', `p`.`zip`) as `property_address`,
				(
					select
					`pi`.`thumbs`
					from
					`properties_images` as `pi`
					where `pi`.`property_id` = `p`.`property_id`
					order by
					`pi`.`property_image_id` desc
					limit 0, 1
				) as `property_image`,
				if(`p`.`created_on` != '0000-00-00 00:00:00', date_format(`p`.`created_on`, '%b %D, %Y'), 'Not Found') as `property_created_on`
				from
				`properties` as `p`
				left join
				`master_country` as `co`
				on
				`p`.`country_id` = `co`.`country_id`
				left join
				`master_state` as `s`
				on
				`p`.`state_id` = `s`.`id`
				left join
				`master_city` as `ct`
				on
				`p`.`city_id` = `ct`.`id`
				where
				`p`.`user_id` = $hostId
                and
                `p`.`parent_id` is null
				$searchQuery
				order by
				`p`.$sortKey $sortDirection
			) as `temp_properties`
    	";
    	$result = $this->db->query($query)->result();

    	return (isset($result[0])) ? $result[0]->property_count : 0;
    }

    public function fetchPropertiesByHostId($hostId, $searchQuery, $start, $offset, $sortKey, $sortDirection)
    {
    	$query = "
    		select
    		`p`.`property_id`,
    		`p`.`property_title`,
            `mrt`.`roomtype`,
    		concat(`p`.`address_line1`, '; ', `ct`.`city_name`, '; ', `s`.`state_name`, '; ', `co`.`country_name`, '; ', `p`.`zip`) as `property_address`,
			(
				ifnull(
                    (
                        select
                        `pi`.`thumbs`
                        from
                        `properties_images` as `pi`
                        where `pi`.`property_id` = `p`.`property_id`
                        order by
                        `pi`.`property_image_id` desc
                        limit 0, 1
                    ),
                    (
                        select
                        `pi`.`thumbs`
                        from
                        `properties_images` as `pi`
                        where `pi`.`property_id` in (
                            select
                            `p1`.`property_id`
                            from
                            `properties` as `p1`
                            where
                            `p1`.`parent_id` = `p`.`property_id`
                        )
                        order by
                        `pi`.`property_image_id` desc
                        limit 0, 1
                    )
                )
            ) as `property_image`,
			if(`p`.`created_on` != '0000-00-00 00:00:00', date_format(`p`.`created_on`, '%b %D, %Y'), 'Not Found') as `property_created_on`
			from
			`properties` as `p`
			left join
			`master_country` as `co`
			on
			`p`.`country_id` = `co`.`country_id`
			left join
			`master_state` as `s`
			on
			`p`.`state_id` = `s`.`id`
			left join
			`master_city` as `ct`
			on
			`p`.`city_id` = `ct`.`id`
            left join
            `master_room_type` as `mrt`
            on
            `p`.`room_type_id` = `mrt`.`room_type_id`
			where
			`p`.`user_id` = $hostId
            and
            `p`.`parent_id` is null
			$searchQuery
			order by
			`p`.`$sortKey` $sortDirection
			limit
			$start, $offset
		";
		$result = $this->db->query($query)->result();

		return $result;
    }

    public function fetchPropertyViewDetailsById($propertyId)
	{
		$query = "
			select
			`p`.`property_id`,
			`p`.`property_title`,
			`p`.`guest_allow`,
			`p`.`description`,
			`p`.`neighbourhood_highlight`,
			`p`.`house_rule`,
			`p`.`min_night_stay`,
			`p`.`bedrooms`,
			`p`.`bathrooms`,
			`p`.`bed`,
			`p`.`check_in_time`,
			`p`.`check_out_time`,
			`p`.`address_line1`,
			`p`.`zip`,
			`p`.`area`,
			`p`.`latitude`,
			`p`.`longitude`,
			`p`.`clean_charge`,
			`p`.`guest_charge`,
			`p`.`security_charge`,
            `p`.`status`,
			`mrt`.`roomtype`,
			`mpt`.`property_type`,
			`mcp`.`policy`,
			`mco`.`country_name`,
			`ms`.`state_name`,
			`mct`.`city_name`,
            (
                select
                group_concat(`p_1`.`property_id` order by `p_1`.`property_id` asc separator ';')
                from
                `properties` `p_1`
                where
                `p_1`.`parent_id` = (
                    select
                    `p_2`.`parent_id`
                    from
                    `properties` `p_2`
                    where
                    `p_2`.`property_id` = $propertyId
                )
            ) sibling_properties,
            (
                select
                group_concat(`p_3`.`property_id` order by `p_3`.`property_id` asc separator ';')
                from
                `properties` `p_3`
                where
                `p_3`.`parent_id` = $propertyId
            ) child_properties,
			(
				select
				group_concat(
					concat(`pi`.`images`, ',', `pi`.`thumbs`, ',', `pi`.`description`)
					separator ';'
				)
				from
				`properties_images` as `pi`
				where
				`pi`.`property_id` = $propertyId
				group by
				`pi`.`property_id`
			) as `property_images`,
			(
				select
				`pv`.`youtube_video_id`
				from
				`properties_video` as `pv`
				where
				`pv`.`property_id` = $propertyId
			) as `property_video`,
			(
				select
				group_concat(`pp`.`price` separator ';')
				from
				`properties_price` as `pp`
				where
				`pp`.`property_id` = $propertyId
				group by
				`pp`.`property_id`
			) as `property_prices`,
            (
				select
				group_concat(concat(`pp`.`master_price_period_id`, ',', `pp`.`master_price_seasontype_id`) separator ';')
				from
				`properties_price` as `pp`
				where
				`pp`.`property_id` = $propertyId
				group by
				`pp`.`property_id`
			) as `property_prices_relation`,
			(
				select
				group_concat(`amenities_map` separator ';')
				from
				(
					select
					`pa`.`property_id`,
					concat(`mat`.`amenities_type_name`, ':', group_concat(`ma`.`amenities_subtype` separator ', ')) as `amenities_map`
					from
					`master_amenities` as `ma`
					inner join
					`properties_amenities` as `pa`
					on
					`pa`.`amenities_id` = `ma`.`amenities_id`
					inner join
					`master_amenities_type` as `mat`
					on
					`ma`.`amenities_type` = `mat`.`amenities_type_id`
					where
					`pa`.`property_id` = $propertyId
					group by
					`mat`.`amenities_type_id`
				) as `amenities_map_table`
				group by
				`amenities_map_table`.`property_id`
			) as `property_amenities`,
			(
				select
				group_concat(`mt`.`tag` separator ', ')
				from
				`master_tag` as `mt`
				inner join
				`properties_tag` as `pt`
				on
				`pt`.`master_tag_id` = `mt`.`id`
				where
				`pt`.`property_id` = $propertyId
				group by
				`pt`.`property_id`
			) as `property_tags`
			from
			`properties` as `p`
			left join
			`master_room_type` as `mrt`
			on
			`p`.`room_type_id` = `mrt`.`room_type_id`
			left join
			`master_property_type` as `mpt`
			on
			`p`.`property_type_id` = `mpt`.`property_type_id`
			left join
			`master_cancellation_policy` as `mcp`
			on
			`p`.`cancellation_policy_id` = `mcp`.`id`
			left join
			`master_country` as `mco`
			on
			`p`.`country_id` = `mco`.`country_id`
			left join
			`master_state` as `ms`
			on
			`p`.`state_id` = `ms`.`id`
			left join
			`master_city` as `mct`
			on
			`p`.`city_id` = `mct`.`id`
			where
			`p`.`property_id` = $propertyId;
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function fetchPropertyEditdetailsById($propertyId)
	{
		$query = "
			select
			`p`.`property_id`,
            `p`.`parent_id`,
            `p`.`user_id`,
			`p`.`property_title`,
			`p`.`guest_allow`,
			`p`.`description`,
			`p`.`neighbourhood_highlight`,
			`p`.`house_rule`,
			`p`.`min_night_stay`,
			`p`.`bedrooms`,
			`p`.`bathrooms`,
			`p`.`bed`,
			`p`.`check_in_time`,
			`p`.`check_out_time`,
			`p`.`address_line1`,
			`p`.`zip`,
			`p`.`area`,
			`p`.`latitude`,
			`p`.`longitude`,
			`p`.`clean_charge`,
			`p`.`guest_charge`,
			`p`.`security_charge`,
			`p`.`room_type_id`,
			`p`.`property_type_id`,
			`p`.`cancellation_policy_id`,
			`p`.`country_id`,
			`p`.`state_id`,
			`p`.`city_id`,
            `p`.`status`,
            (
                select
                group_concat(`p_1`.`property_id` order by `p_1`.`property_id` asc separator ';')
                from
                `properties` `p_1`
                where
                `p_1`.`parent_id` = (
                    select
                    `p_2`.`parent_id`
                    from
                    `properties` `p_2`
                    where
                    `p_2`.`property_id` = $propertyId
                )
            ) sibling_properties,
            (
                select
                group_concat(`p_3`.`property_id` order by `p_3`.`property_id` asc separator ';')
                from
                `properties` `p_3`
                where
                `p_3`.`parent_id` = $propertyId
            ) child_properties,
			(
				select
				group_concat(
					concat(`pi`.`property_image_id`, ',', `pi`.`images`, ',', `pi`.`thumbs`, ',', `pi`.`description`)
					separator ';'
				)
				from
				`properties_images` as `pi`
				where
				`pi`.`property_id` = $propertyId
				group by
				`pi`.`property_id`
			) as `property_images`,
			(
				select
				`pv`.`youtube_video_id`
				from
				`properties_video` as `pv`
				where
				`pv`.`property_id` = $propertyId
			) as `property_video`,
			(
				select
				group_concat(concat(`pp`.`master_price_period_id`, ',', `pp`.`master_price_seasontype_id`) separator ';')
				from
				`properties_price` as `pp`
				where
				`pp`.`property_id` = $propertyId
				group by
				`pp`.`property_id`
			) as `property_prices_relation`,
            (
				select
				group_concat(`pp`.`price` separator ';')
				from
				`properties_price` as `pp`
				where
				`pp`.`property_id` = $propertyId
				group by
				`pp`.`property_id`
			) as `property_prices`,
			(
				select
				group_concat(`pa`.`amenities_id` separator ';')
				from
				`properties_amenities` as `pa`
				where
				`pa`.`property_id` = $propertyId
				group by
				`pa`.`property_id`
			) as `property_amenities`,
			(
				select
				group_concat(`pt`.`master_tag_id` separator ';')
				from
				`properties_tag` as `pt`
				where
				`pt`.`property_id` = $propertyId
				group by
				`pt`.`property_id`
			) as `property_tags`
			from
			`properties` as `p`
			where
			`p`.`property_id` = $propertyId;
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function deletePropertyById($propertyId)
	{
		$this->db->where($this->propertyTable['primary_key'], $propertyId);

		return $this->db->delete($this->propertyTable['table_name']);
	}

	public function deleteProperties($propertyList)
	{
		$this->db->where_in('property_id', $propertyList);

		return $this->db->delete('properties');
	}
    
    public function createChildProperties($childPropertiesData)
    {
        $this->db->trans_start();
        
        $this->db->insert_batch('properties', $childPropertiesData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function fetchChildPropertyIds($propertyId)
    {
        $query = "
            select
            group_concat(property_id separator ',') child_property_ids
            from
            properties
            where
            parent_id = $propertyId
            group by
            parent_id
        ";
        $result = $this->db->query($query)->result_array();
        
        return (isset($result[0]['child_property_ids']) && $result[0]['child_property_ids']) ? $result[0]['child_property_ids'] : '';
    }
    
    public function fetchCalendarEventData($propertyId, $selectedDate)
    {
        $query = "
            select
            '' title,
            dt_23.start,
            dt_23.end,
            ifnull(
                dt_24.price,
                ifnull(
                    (
                        select
                        pp.price
                        from
                        properties_price pp
                        where
                        pp.property_id = $propertyId
                        and
                        pp.master_price_period_id = 2
                        and
                        pp.master_price_seasontype_id = 2
                    ),
                    0.00
                )
            ) price,
            (
                case
                    when dt_25.status is not null then dt_25.status
                    when dt_26.status is not null then dt_26.status                    
                    when dt_23.start < curdate() then 3
                    else 1
                end
            ) status,
            (
                case
                    when dt_25.status = 2 then '#E5F09D'
                    when dt_26.status = 0 then '#D3DCE3'
                    when dt_26.status = 1 then ''                    
                    when dt_23.start < curdate() then '#DFD7CF'
                    else ''
                end
            ) background_color,
            dt_23.property_id
            from
            (
                select
                $propertyId property_id,
                dt_22.date_field start,
                dt_22.date_field end
                from
                (
                    select 
                    MAKEDATE(year('$selectedDate'), 1) + interval (month('$selectedDate') - 1) month + interval dt_21.daynum day date_field
                    from
                    (
                        select 
                        dt_19.t * 10 + dt_20.u daynum
                        from
                        (
                            select 0 t union select 1 union select 2 union select 3
                        ) dt_19, 
                        (
                            select 0 u union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9
                        ) dt_20
                        order by daynum
                    ) dt_21
                ) dt_22
                where
                month(dt_22.date_field) = month('$selectedDate')
            ) dt_23
            left join
            (
                select
                dt_6.start,
                dt_6.end,
                substring_index(
                    dt_6.price, ';', -1
                ) price
                from
                (
                    select
                    dt_5.date_field start,
                    dt_5.date_field end,
                    group_concat(
                        ifnull(
                            pdp.price,
                            0.00
                        )
                        order by
                        pdp.id asc
                        separator ';'
                    ) price
                    from
                    (
                        select
                        $propertyId property_id,
                        dt_4.date_field
                        from
                        (
                            select 
                            MAKEDATE(year('$selectedDate'), 1) + interval (month('$selectedDate') - 1) month + interval dt_3.daynum day date_field
                            from
                            (
                                select 
                                dt_1.t * 10 + dt_2.u daynum
                                from
                                (
                                    select 0 t union select 1 union select 2 union select 3
                                ) dt_1, 
                                (
                                    select 0 u union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9
                                ) dt_2
                                order by daynum
                            ) dt_3
                        ) dt_4
                        where
                        month(dt_4.date_field) = month('$selectedDate')
                    ) dt_5
                    left join
                    properties_daily_price pdp
                    on
                    dt_5.property_id = pdp.property_id
                    where
                    dt_5.date_field between pdp.effective_from and pdp.effective_to
                    group by
                    dt_5.date_field
                    order by
                    dt_5.date_field asc
                ) dt_6
            ) dt_24
            on
            dt_23.start = dt_24.start
            left join
            (
                select
                dt_12.start,
                dt_12.end,
                2 status
                from
                (
                    select
                    $propertyId property_id,
                    dt_11.date_field start,
                    dt_11.date_field end
                    from
                    (
                        select 
                        dt_10.date_field
                        from
                        (
                            select 
                            MAKEDATE(year('$selectedDate'), 1) + interval (month('$selectedDate') - 1) month + interval dt_9.daynum day date_field
                            from
                            (
                                select 
                                dt_7.t * 10 + dt_8.u daynum
                                from
                                (
                                    select 0 t union select 1 union select 2 union select 3
                                ) dt_7, 
                                (
                                    select 0 u union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9
                                ) dt_8
                                order by daynum
                            ) dt_9
                        ) dt_10
                        where
                        month(dt_10.date_field) = month('$selectedDate')
                    ) dt_11
                ) dt_12
                left join
                properties_booking pb
                on
                dt_12.property_id = pb.property_id
                where
                dt_12.start between pb.booking_to and pb.booking_upto
            ) dt_25
            on
            dt_23.start = dt_25.start
            left join
            (
                select
                dt_18.start,
                dt_18.end,
                substring_index(
                    dt_18.status, ';', -1
                ) status
                from
                (
                    select
                    dt_17.date_field start,
                    dt_17.date_field end,
                    group_concat(
                        pa.status
                        order by
                        pa.id asc
                        separator ';'
                    ) status
                    from
                    (
                        select
                        $propertyId property_id,
                        dt_16.date_field
                        from
                        (
                            select 
                            MAKEDATE(year('$selectedDate'), 1) + interval (month('$selectedDate') - 1) month + interval dt_15.daynum day date_field
                            from
                            (
                                select 
                                dt_13.t * 10 + dt_14.u daynum
                                from
                                (
                                    select 0 t union select 1 union select 2 union select 3
                                ) dt_13, 
                                (
                                    select 0 u union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9
                                ) dt_14
                                order by daynum
                            ) dt_15
                        ) dt_16
                        where
                        month(dt_16.date_field) = month('$selectedDate')
                    ) dt_17
                    left join
                    properties_availability pa
                    on
                    dt_17.property_id = pa.property_id
                    where
                    dt_17.date_field between pa.effective_from and pa.effective_to
                    group by
                    dt_17.date_field
                    order by
                    dt_17.date_field asc
                ) dt_18
            ) dt_26
            on
            dt_23.start = dt_26.start
            order by
            dt_23.start asc
        ";
        $result = $this->db->query($query)->result_array();
        
        return $result;
    }
    
    public function saveCalendarEventData($priceData, $availabilityData)
    {
        $this->db->trans_start();
        
        $this->db->insert('properties_daily_price', $priceData);
        
        $this->db->insert('properties_availability', $availabilityData);
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function fetchSeasonTypes()
    {
        $query = "select * from master_price_seasontype";
        
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    public function fetchPeriodTypes()
    {
        $query = "select * from master_price_period";
        
        $result = $this->db->query($query)->result();
        
        return $result;
    }


    /**
     * new db operation methods end
     */
    
   /**
	** Function to fetch the property for comparing
	*/
	function fetchCompareproperties($property_id)
	{
		 $sql = 'SELECT u.user_id,CONCAT(u.first_name, " " , u.last_name) AS "user_name",u.profile_pic,p.bathrooms,p.user_id,p.property_id,p.price,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,i.images,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language
						 FROM '.PROPERTY.' as p, '.PROPERTY_IMAGES.' as i, '.CITY.' as c, 
						 '.USER.' as u, '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t
						 WHERE c.id = p.city_id 
						 AND u.user_id=p.user_id  
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id 
						 AND p.property_id = i.property_id
						 AND p.property_id IN ('.$property_id.')';
		$query = $this->db->query($sql,array($property_id));
		return $query->result();
	}
	/**
	** Function to fetch amenities
	*/
//	function fetchAmenities($property_id)
//	{
//		$sql = 'SELECT * 
//						FROM '.PROPERTY_AMENITIES.'
//						WHERE property_id IN ('.$property_id.')';
//		$query = $this->db->query($sql,array($property_id));
//		return $query->result();
//	}
	/**
	* Function to fetch user Info
	*/
	function userInfo($user_id)
	{
		$sql = 'SELECT *
						FROM '.USER.'
						WHERE user_id = ?
						LIMIT 1';
		$query = $this->db->query($sql,array($user_id));
		return $query->row();
	}
    
    public function fetchChildProperties($propertyId)
    {
        $query = "
            select
            group_concat(property_id) child_properties
            from
            properties
            where
            parent_id = $propertyId
        ";
        $result = $this->db->query($query)->result();
        
        return $result[0]->child_properties;
    }
    
    public function fetchSiblingProperties($propertyId)
    {
        $query = "
            select
            group_concat(property_id) sibling_properties
            from
            properties
            where
            parent_id = (
                select
                parent_id
                from
                properties
                where
                property_id = $propertyId
            )
            and
            property_id != $propertyId
        ";
        $result = $this->db->query($query)->result();
        
        return $result[0]->sibling_properties;
    }
    
    public function fetchChildPropertyDataByParentId($propertyId)
    {
        $query = "
            select
            property_id, property_title, room_type_id, guest_allow, property_type_id, user_id
            from
            properties
            where
            parent_id = $propertyId
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    public function fetchChildPropertyListByParentId($propertyId)
    {
        $query = "
            select
            group_concat(property_id separator ',') child_property_list
            from
            properties
            where
            parent_id = $propertyId
            group by
            parent_id
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0]->child_property_list)) ? $result[0]->child_property_list : '';
    }
    
    public function saveRoomDetails($propertyId, $roomData)
    {        
        if (! $propertyId) {
            $this->db->insert('properties', $roomData);
            $propertyId = $this->db->insert_id();
        }
        
        $this->db->where('property_id', $propertyId);
        $this->db->update('properties', $roomData);
        
        return $propertyId;
    }
    
    public function deleteAllRooms($propertyId)
    {
        $this->db->trans_start();
        
        $this->db->where('parent_id', $propertyId);
        $this->db->delete('properties');
        
        $this->db->where('property_id', $propertyId);
        $this->db->delete('properties');
        
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function deleteRoom($propertyId)
    {
        $this->db->where('property_id', $propertyId);
        return $this->db->delete('properties');
    }
	
	//verify email
	function verify_email($email_id){
		$query = $this->db->query("SELECT user_id FROM " . USER . " WHERE email = '".$email_id."'");
		$row = $query->row_array();
		
		if($row['user_id']){
			$updatArr['profile_status'] = 'Active';
			$this->db->where('user_id', $row['user_id']);
        	$this->db->update(USER, $updatArr);
		
			return true;
		}else{
			return false;
		}
	}
    
    public function saveTab($propertyId, $tabId)
    {
        $query = "select if(count(*) = 0, false, true) is_tab_exist from properties_tab_state where property_id = $propertyId and tab_id = $tabId";
        $isTabExist = $this->db->query($query)->result()[0]->is_tab_exist;
        
        if (! $isTabExist) {
            $query = "insert into properties_tab_state values (null, $tabId, $propertyId)";
        }
        
        $this->db->query($query);
    }
    
    public function fetchPropertyListingTabStatuses($PropertyId)
    {
        $query = "select group_concat(tab_id) as tabs from properties_tab_state where property_id = $PropertyId group by property_id";
        $result = $this->db->query($query)->result();
        
        return isset($result[0]) ? $result[0] : null;
    }
}
?>