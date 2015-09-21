<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Search_model extends CI_Model
{
	/***
	 * Function to fetch the property as per the filter
	 **/
	 function getProperty($offset,$per_page,$sort_by,$city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time)
	 {
		 $room_type_cond = $bed_cond = $bathroom_cond = $bedroom_cond = $guest_cond = $package_cond = 
		 $check_in_time_cond = $check_out_time_cond = $pag_cond = $sort_cond = $rating_cond = 
		 $property_type_cond = $amenities_cond = $language_cond = $policy_cond = $tag_cond = "";
		 
		 // If room_type is not empty
		 if($room_type != "")
		 {
			 $room_type_cond = "AND p.room_type_id IN ($room_type)";
		 }
		 // If property_type is not empty
		 if($property_type != "")
		 {
			 $property_type_cond = "AND p.property_type_id IN ($property_type)";
		 }
		 // If amenities is not empty
		 if($amenities != "")
		 {
			 $amenities_cond = "AND a.amenities_id IN ($amenities) AND a.property_id = p.property_id";
		 }
		 // If tag is not empty
		 if($tags != "")
		 {
			  $tag_cond = "AND pt.master_tag_id IN ($tags) AND pt.property_id = p.property_id";
		 }
		 // If language is not empty
		 if($language != "")
		 {
			 $language_cond = "AND p.host_language IN ($language)";
		 }
		  // If policy is not empty
		 if($policy != "")
		 {
			 $policy_cond = "AND p.cancellation_policy_id = $policy";
		 }
		 // If No of bed is not empty
		 if($bed != "")
		 {
			 $bed_cond = "AND p.bed = $bed";
		 }
		 // If No of bathroom is not empty
		 if($bathroom != "")
		 {
			 $bathroom_cond = "AND p.bathrooms = $bathroom";
		 }
		 // If No of bedroom is not empty
		 if($bedroom != "")
		 {
			 $bedroom_cond = "AND p.bedrooms = $bedroom";
		 }
		 // If NO of guest is not empty
		 if($guest != "")
		 {
			 $guest_cond = "AND p.guest_allow >= $guest";
		 }
		 //If Price is not empty
		 if($min_package || $max_package != "")
		 {
			 $package_cond = "AND p.price BETWEEN $min_package AND  $max_package";
		 }
		 //If Check in time is not empty
		 if($check_in_time !="")
		 {
			 $check_in_time_cond = "AND p.check_in_time >= $check_in_time";
			 $check_in_time_cond =  "";
		 }
		 //If check out time is not empty
		 if($check_out_time != "")
		 {
			 $check_out_time_cond = "AND p.check_out_time <= $check_out_time";
			 $check_out_time_cond = "";
		 }
		if($offset != '' || $offset == 0)
		{
			 $pag_cond = "LIMIT $offset, $per_page";
		}
		if(!empty($sort_by))
		{
			if($sort_by == 'high_price')
			{
				$sort_cond = "ORDER BY p.price DESC";
			}
			else if($sort_by == 'low_price')
			{
				$sort_cond = "ORDER BY p.price ASC";
			}
		}
		else
			{
				$sort_cond = "ORDER BY p.property_id DESC";
			}
		 $sql = 'SELECT SQL_CALC_FOUND_ROWS u.user_id,CONCAT(u.first_name, " " , u.last_name) AS "user_name",u.profile_pic,p.bathrooms,p.user_id,p.property_id,p.price,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,i.images,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language
						 FROM '.PROPERTY.' as p, '.PROPERTY_IMAGES.' as i, '.CITY.' as c, 
						 '.USER.' as u, '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t, '.PROPERTY_AMENITIES.' as a, '.PROPERTY_TAGS.' as pt
						 WHERE c.city_name LIKE "' . strtolower($city_name) .'%"
						 AND c.id = p.city_id 
						 AND u.user_id=p.user_id  
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id 
						 AND p.property_id = i.property_id
						 AND p.status = "Active"
							'.$room_type_cond.'
							'.$property_type_cond.'
							'.$amenities_cond.'
							'.$language_cond.'
							'.$policy_cond.'
							'.$tag_cond.'
							'.$bed_cond.'
							'.$bathroom_cond.'
							'.$bedroom_cond.'
							'.$guest_cond.'
							'.$package_cond.'
							'.$check_in_time_cond.'
							'.$check_out_time_cond.'group by p.property_id
							'.$sort_cond.'
							'.$pag_cond.' 
							';
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	 }
	 /***
	 * Function to fetch room_type
	 */
	 function getRoomtype()
	 {
		 $sql = 'SELECT * FROM '.ROOM_TYPE.'';
		 $query = $this->db->query($sql);
		 return $query->result();
	 }
	 /***
	 * Function to fetch property_type
	 */
	 function getPropertytype()
	 {
		 $sql = 'SELECT * FROM '.PROPERTY_TYPE.'';
		 $query = $this->db->query($sql);
		 return $query->result();
	 }
	 /**
	 * Function to fetch Ameneties
	 **/
	 function getAmenities()
	 {
		 $sql = 'SELECT * FROM '.AMENETIES.'';
		 $query = $this->db->query($sql);
		 return $query->result();
	 }
	 /***
	 * Function to fetch reviews according to property_id
	 */
	 function getReviewscount($property_id)
	 {
		 $sql = 'SELECT COUNT(property_review_id) as tot_review
						 FROM '.REVIEWS.' 
						 WHERE property_id = ?';
		 $query = $this->db->query($sql,array($property_id));
		 return $query->row();
	 }
	 /***
	 * Function to fetch host language
	 */
	 function getHostlanguage()
	 {
		 $sql = 'SELECT * FROM '.LANGUAGE.'';
		 $query = $this->db->query($sql);
		 return $query->result();
	 }
	 /**
	 * Function to count the number of rows fetch by the Previous Query
	 **/
	function countRows()
	{
		$sql = "SELECT FOUND_ROWS() as tot_row";
		$query = $this->db->query($sql);
		return $query->row()->tot_row;
	}
	/**
	* Function to fetch cancellation policy
	*/
	function getCancellationpolicy()
	{
		$sql = 'SELECT * FROM '.POLICY.'';
		$query = $this->db->query($sql);
		return $query->result();
	}
	/**
	* Function to fetch cancellation policy
	*/
	function getTag()
	{
		$sql = 'SELECT * FROM '.TAGS.'';
		$query = $this->db->query($sql);
		return $query->result();
	}
	/**
	* Function to fetch property according to tags
	*/
	function getTagproperty($city_name,$tag_id)
	{
		 $sql = 'SELECT SQL_CALC_FOUND_ROWS u.user_id,CONCAT(u.first_name, " " , u.last_name) AS "user_name",u.profile_pic,p.bathrooms,p.user_id,p.property_id,p.price,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,i.images,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language
						 FROM '.PROPERTY.' as p, '.PROPERTY_IMAGES.' as i, '.CITY.' as c, 
						 '.USER.' as u, '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t, '.PROPERTY_TAGS.' as pt
						 WHERE c.city_name LIKE "' . strtolower($city_name) .'%"
						 AND c.id = p.city_id 
						 AND u.user_id=p.user_id  
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id 
						 AND p.property_id = i.property_id
						 AND pt.master_tag_id = "' .$tag_id .'" 
						 AND pt.property_id = p.property_id';
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}
	
	/**
	* Function to fetch property according to popularity
	*/
	function getPopularproperty($city_name,$smiley_id)
	{
		 $sql = 'SELECT SQL_CALC_FOUND_ROWS u.user_id,CONCAT(u.first_name, " " , u.last_name) AS "user_name",u.profile_pic,p.bathrooms,p.user_id,p.property_id,p.price,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,i.images,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language
						 FROM '.PROPERTY.' as p, '.PROPERTY_IMAGES.' as i, '.CITY.' as c, 
						 '.USER.' as u, '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t, '.PROPERTY_RATING.' as pr
						 WHERE c.city_name LIKE "' . strtolower($city_name) .'%"
						 AND c.id = p.city_id 
						 AND u.user_id=p.user_id  
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id 
						 AND p.property_id = i.property_id
						 AND pr.smiley_id = "' .$smiley_id .'"
						 AND pr.property_id = p.property_id';
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}

	/*------------LOGIN REGISTER MODEL---------------------*/

		/*model*/
		/**
			* Function to search the rnr recommend property
			*/
			function getRnrrecommendProperty()
			{
				$sql = 'SELECT c.city_name,p.price ,i.images 
								FROM '.PROPERTY.' as p, '.CITY.' as c, '.PROPERTY_IMAGES.' as i
								WHERE p.property_id = i.property_id 
								AND c.id = p.city_id 
								AND p.rnr_recommended = 1 
								order by RAND() 
								LIMIT 3';
				$query = $this->db->query($sql);
				return $query->result();
			}
			/**
			* Function to fetch people stories
			*/
			function getPeoplestories()
			{
				$sql = 'SELECT p.article_text,p.created_on,CONCAT(u.first_name, " ", u.last_name) AS "user_name" ,u.profile_pic 
								FROM '.USER.' as u ,'.PEOPLE_STORIES.' p 
								WHERE u.user_id = p.user_id 
								order by RAND() 
								LIMIT 3';
				$query = $this->db->query($sql);
				return $query->result();
			}
			/*
			* Function to fetch slider images of home page
			*/
			function getSliderimages($type)
			{
				$sql = 'SELECT * FROM '.SLIDER.'
								WHERE type = ? ';
				$query = $this->db->query($sql,array($type));
				return $query->result();
			}
			/**
			* Function to load what happening section
			*/
			function getUpcomingfestival()
			{
				$sql = 'SELECT * FROM '.WHAT_HAPPENING.' 
								order by RAND() 
								LIMIT 1';
				$query = $this->db->query($sql);
				return $query->result();
			}
			 /**
			 * Function to fetch Trending Destination
			 */
			 
			function getTrendingDestination()
			{
				/*$sql = 'SELECT * FROM '.TRENDING_DESTINATION.'
								order by RAND() 
								LIMIT 8';
				$query = $this->db->query($sql);
				return $query->result();*/
			}
			/***
			 * Function to check the user authentication
			 **/
		  function checkLogin($email = '' ,$password = '',$fb_id = '')
			{
				if($fb_id == '')
				{
					$md5_password = md5($password);
					$sql = 'SELECT user_id, first_name, last_name, email, profile_pic
								FROM '.USER.'  WHERE email = ? 
								AND password = ? 
								LIMIT 1';
					$query = $this->db->query($sql,array($email,$md5_password));	
				}
			  else
				{
				  $sql = 'SELECT user_id,CONCAT(first_name, " ", last_name) AS "user_name",email,status 
									FROM '.USER.' WHERE fb_id = ? LIMIT 1';
					$query = $this->db->query($sql,array($fb_id));
				}	
				$row = $query->row();
				return $row;
			}

			/***
			 ** Function to check wheather email_id is present or not in case of fb login
			 **/
			function checkEmail($email_id)
			{
			  $sql = 'SELECT *  
							 FROM '.USER.' 
							 where email= ?  
							 LIMIT 1';
			  $query = $this->db->query($sql,array($email_id));
			  return $query->row();
			}
			
			/***
			 ** Function to check wheather fb_id is present or not in case of fb login
			 **/
			function checkFbid($fb_id)
			{
				$sql = 'SELECT * 
							  FROM '.USER.' 
								where fb_id= ?  
								LIMIT 1';
				$query = $this->db->query($sql,array($fb_id));
				return $query->row();
			}
			
			/****
			 * Function to check the duplicate record
			 **/
			
			function chkDuplicateuser($data)
			{
				$email_id = $data;
				$sql = 'SELECT user_id FROM '.USER.'
				        WHERE email = ?  
								LIMIT 1';
				$query = $this->db->query($sql,array($email_id));
				return $query->row();
			}
			
			/***
			 * Insert the records in the table
			 * @param $table_name : Name of the table to insert the data
			 * @param $ins_data: Array to insert data
			 **/
			
			function insertTableData($table_name,$ins_data)
			{
				if($this->db->insert($table_name,$ins_data))
				  return true;
				else
				  return false;
			}
			
			/**
			* Function to save mobile numbers
			*/
			function saveNumber($mobile_number)
			{
				$sql = 'Insert into users_number (mobile_number)
		            values ('.$mobile_number.')';
				$this-> db-> query($sql);
			}
			
			/***
			 * Function to check if  the user exists
			 **/
		  function userExists($email_id = '',$fb_id = '')
			{
				 if($fb_id == '')
				 {
					$sql = 'SELECT user_id,first_name, last_name,email,status,password
									FROM '.USER.'
									WHERE email = ?  
									LIMIT 1';
					$query = $this->db->query($sql,array($email_id));
				 }
				 else
				 {
				  $sql = 'SELECT user_id,first_name, last_name,email,status ,password
									FROM '.USER.'
									WHERE fb_id = ? 
									LIMIT 1';
					$query = $this->db->query($sql,array($fb_id));
				 }		
				 $row = $query->row();
				 return $row;
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

	/*--------END LOGIN REGISTER------------------------*/
		/***
	 * Function to fetch the total number of property as per the filter
	 **/
	 function total_no_rec($city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time)
	 {
		 $room_type_cond = $bed_cond = $bathroom_cond = $bedroom_cond = $guest_cond = $package_cond = 
		 $check_in_time_cond = $check_out_time_cond = $rating_cond = 
		 $property_type_cond = $amenities_cond = $language_cond = $policy_cond = $tag_cond = "";
		 
		 // If room_type is not empty
		 if($room_type != "")
		 {
			 $room_type_cond = "AND p.room_type_id IN ($room_type)";
		 }
		 // If property_type is not empty
		 if($property_type != "")
		 {
			 $property_type_cond = "AND p.property_type_id IN ($property_type)";
		 }
		 // If amenities is not empty
		 if($amenities != "")
		 {
			 $amenities_cond = "AND a.amenities_id IN ($amenities) AND a.property_id = p.property_id";
		 }
		 // If tag is not empty
		 if($tags != "")
		 {
			  $tag_cond = "AND pt.master_tag_id IN ($tags) AND pt.property_id = p.property_id";
		 }
		 // If language is not empty
		 if($language != "")
		 {
			 $language_cond = "AND p.host_language IN ($language)";
		 }
		  // If policy is not empty
		 if($policy != "")
		 {
			 $policy_cond = "AND p.cancellation_policy_id = $policy";
		 }
		 // If No of bed is not empty
		 if($bed != "")
		 {
			 $bed_cond = "AND p.bed = $bed";
		 }
		 // If No of bathroom is not empty
		 if($bathroom != "")
		 {
			 $bathroom_cond = "AND p.bathrooms = $bathroom";
		 }
		 // If No of bedroom is not empty
		 if($bedroom != "")
		 {
			 $bedroom_cond = "AND p.bedrooms = $bedroom";
		 }
		 // If NO of guest is not empty
		 if($guest != "")
		 {
			 $guest_cond = "AND p.guest_allow >= $guest";
		 }
		 //If Price is not empty
		 if($min_package || $max_package != "")
		 {
			 $package_cond = "AND p.price BETWEEN $min_package AND  $max_package";
		 }
		 //If Check in time is not empty
		 if($check_in_time !="")
		 {
			 $check_in_time_cond = "AND p.check_in_time >= $check_in_time";
			 $check_in_time_cond =  "";
		 }
		 //If check out time is not empty
		 if($check_out_time != "")
		 {
			 $check_out_time_cond = "AND p.check_out_time <= $check_out_time";
			 $check_out_time_cond = "";
		 }
		 $sql = 'SELECT SQL_CALC_FOUND_ROWS u.user_id,CONCAT(u.first_name, " " , u.last_name) AS "user_name",u.profile_pic,p.bathrooms,p.user_id,p.property_id,p.price,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,i.images,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language
						 FROM '.PROPERTY.' as p, '.PROPERTY_IMAGES.' as i, '.CITY.' as c, 
						 '.USER.' as u, '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t, '.PROPERTY_AMENITIES.' as a, '.PROPERTY_TAGS.' as pt
						 WHERE c.city_name LIKE "' . strtolower($city_name) .'%"
						 AND c.id = p.city_id 
						 AND u.user_id=p.user_id  
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id 
						 AND p.property_id = i.property_id
						 AND p.status = "Active"
							'.$room_type_cond.'
							'.$property_type_cond.'
							'.$amenities_cond.'
							'.$language_cond.'
							'.$policy_cond.'
							'.$tag_cond.'
							'.$bed_cond.'
							'.$bathroom_cond.'
							'.$bedroom_cond.'
							'.$guest_cond.'
							'.$package_cond.'
							'.$check_in_time_cond.'
							'.$check_out_time_cond.'group by p.property_id
							';
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	 }
}
?>