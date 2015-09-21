<?php

class Overview_model extends CI_Model {

	function __construct()
		{
			parent::__construct();
			$this->load->database();
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
		
		function wish_check($u_id, $p_id)
		{
			$query = $this->db->get_where('user_wishlist',array('user_id'=>$u_id, 'property_id'=>$p_id));
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		
		function delete_wish($u_id, $p_id)
		{
			return $this->db->delete('user_wishlist', array('user_id' => $u_id, 'property_id'=>$p_id)); 
		}
		
		function insert_wish($data)
		{
			return $this->db->insert('user_wishlist', $data); 
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
		function extractDetails($property_id)
		{
			/*
			return	$this->db->select('t1.*, t2.roomtype', 't3.property_type')
					->from(PROPERTY_ROOMS.' AS t1, '.ROOM_TYPE.' AS t2', PROPERTY_TYPE.' AS t3')
					->where('t1.property_id ='.$property_id)
					->where('t1.room_type_id = t2.room_type_id')
					->where('t1.property_type_id = t3.property_type_id');
			*/
			$query = $this->db->query( "SELECT t1.*, t2.roomtype, t3.property_type, t4.country_name, t5.state_name, t6.city_name, t7.policy, t7.policy_description FROM properties AS t1, ".ROOM_TYPE." AS t2,".PROPERTY_TYPE." AS t3,".COUNTRY." AS t4,".STATE." AS t5,".CITY." AS t6, master_cancellation_policy AS t7 WHERE t1.property_id ='$property_id' AND t1.room_type_id = t2.room_type_id AND t1.country_id = t4.country_id AND t1.state_id = t5.id AND t1.city_id = t6.id AND t1.property_type_id = t3.property_type_id AND t1.cancellation_policy_id = t7.id");
			return $query->result(  );	
				
		}
		
		function propImages($property_id){
				$query = $this->db->query( "SELECT images, description FROM properties_images WHERE property_id ='$property_id'" );
			return $query->result(  );
		
		}
		
		//dummy code for querying property by city
		public function get_by_city($city)
		{
			$query = $this->db->query( "SELECT user_property_id, property_title, neighbourhood_highlight FROM user_property WHERE city ='$city'" );
				return $query->result(  );
		
		
		}
		
		public function getAmenitcommon()
		{				
				$query = $this->db->query( "SELECT * FROM ".PROPERTY_AMENITIES." WHERE user_id ='$id'" );
				return $query->result();				
		}
		
		
		
		/*
			price_id
			property_id
			master_price_period_id
			master_price_seasontype_id	
		*/
		
		//price of season 1 daily
		public function getPrices1($property_id, $seasontype)
		{
			$query = $this->db->query("SELECT * FROM properties_price WHERE property_id = '$property_id' AND master_price_period_id = 1 AND master_price_seasontype_id = '$seasontype'");
			return $query->result();
		}
		
		//price of season 1 weekly
		public function getPrices2($property_id, $seasontype)
		{
			$query = $this->db->query("SELECT * FROM properties_price WHERE property_id = '$property_id' AND master_price_period_id = 2 AND master_price_seasontype_id = '$seasontype'");
			return $query->result();
		}
		
		//price of season 1 monthly
		public function getPrices3($property_id, $seasontype)
		{
			$query = $this->db->query("SELECT * FROM properties_price WHERE property_id = '$property_id' AND master_price_period_id = 3 AND master_price_seasontype_id = '$seasontype'");
			return $query->result();
		}
		
		//price of season 1 weekend
		public function getPrices4($property_id, $seasontype)
		{
			$query = $this->db->query("SELECT * FROM properties_price WHERE property_id = '$property_id' AND master_price_period_id = 4 AND master_price_seasontype_id = '$seasontype'");
			return $query->result();
		}
		
					
		public function userdetails($id){		
			$query = $this->db->query( "SELECT * FROM users WHERE user_id ='$id'" );
            return $query->result();		
		}
		
		
		public function extractAmenit($property_id){
			$query = $this->db->query( "SELECT amenities_id FROM properties_amenities WHERE property_id ='$property_id'" );
            return $query->result();		
		}

		public function getResponsetime($property_id){
			$query = $this->db->query( "SELECT * FROM users_insta_private_message WHERE property_id ='$property_id'" );
            return $query->result();		
		}

		public function getResponseCount($property_id)
		{
			$this->db->select('*');
			$this->db->from('users_insta_private_message');
			$this->db->where('property_id', $property_id);
			$query = $this->db->get();
			$rowcount = $query->num_rows();
			return $rowcount; 
		}
	
	
		public function getAmenitDetails( $ids){
				$this->db->select('*');
				$this->db->from('master_amenities');
				$this->db->join('master_amenities_type', 'master_amenities.amenities_type = master_amenities_type.amenities_type_id');
				$this->db->where_in('amenities_id', $ids );

				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
				/*
				$query = $this->db->query( "SELECT t1.*, t2.amenities_type_name FROM master_amenities AS t1, master_amenities_type AS t2 WHERE IN t1.amenities_id ='$ids' AND t1.amenities_type = t2.amenities_type_id ");
				
				return $query->result(  );*/
				
		}
		
	/**
	** Function to fetch user reviews according to property_id
	*/
	function extractPropertyreviews($property_id)
	{
		$sql = 'SELECT p.review_message, p.smiley_id, p.created_on,CONCAT(u.first_name, " ", u.last_name) AS "user_name" ,u.profile_pic, v.smiley_icon 
						FROM '.USER.' as u ,properties_reviews as p, master_smiley as v WHERE u.user_id = p.user_id AND p.property_id = ? AND p.smiley_id =  v.smiley_id
						order by RAND() LIMIT 10';
		$query = $this->db->query($sql,array($property_id));
		return $query->result();
	}
	/*count number of review*/
	function countReview($property_id)
	{
		//$query = $this->db->query('SELECT * FROM properties_reviews WHERE property_id = '.$property_id.'');
		$this->db->select('*');
		$this->db->from('properties_reviews');
		$this->db->where('property_id', $property_id);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount; 
	}
	
	public function getReviewbysmiley($smiley_id, $prop_id)
	{
		$sql = 'SELECT p.review_message, p.smiley_id, DATE_FORMAT(p.created_on, "%M %Y") AS "date" ,CONCAT(u.first_name, " ", u.last_name) AS "user_name" ,u.profile_pic, v.smiley_icon 
						FROM '.USER.' as u ,properties_reviews as p, master_smiley as v WHERE u.user_id = p.user_id AND p.smiley_id = ? AND p.property_id = ? AND p.smiley_id =  v.smiley_id
						order by RAND() LIMIT 10';
		$query = $this->db->query($sql,array($smiley_id, $prop_id));
		return $query->result();
	}

	/*
	**function for checking user has visited the place
	*/
	function getbookstatus($uid, $property_id)
	{
		$this->db->select('*');
		$this->db->from('properties_booking');
		$this->db->where('property_id', $property_id);
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount;
	}

	/*
	**function to get the last visited date 
	*/
	function getlastVisited($uid, $property_id)
	{
		/*
		$this->db->select('booking_upto');
		$this->db->from('properties_booking');
		$this->db->where('property_id', $property_id);
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		return $query->result();
		SELECT date,personssn FROM Table1 ORDER BY ABS( DATEDIFF(DATE, NOW() ) ) LIMIT 5
		*/
		$sql = "SELECT booking_upto FROM properties_booking WHERE property_id = '$property_id' AND user_id = '$uid' order by
        abs(now() - booking_upto) desc";
		$query = $this->db->query($sql);
				return $query->result();
	}

	/***
	** Function to get video according to property id
	*/
	function extractPropertyvideo($property_id)
	{
		$sql = 'SELECT * FROM '.PROPERTY_VIDEO.' 
						WHERE property_id = ? LIMIT 1';
		$query = $this->db->query($sql,array($property_id));
		return $query->result();
	}
	/***
	** Function to fetch images according to property_id
	*/
	function extractPropertyimage($property_id)
	{
		$sql = 'SELECT * FROM '.PROPERTY_IMAGES.'
						WHERE property_id = ? LIMIT 4';
		$query = $this->db->query($sql,array($property_id));
		return $query->result();
	}
	
	function insert_review($udata)
	{
		return $this->db->insert('properties_reviews',$udata);
	}


	function getUsermsgs($uid)
	{

		$this->db->select('*');
		$this->db->from('users_insta_private_message');
		$this->db->where('receiver_id', $uid);
		//$this->db->where('user_id', $uid);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount;
	}

	function getUserreply($uid)
	{

		$this->db->select('*');
		$this->db->from('users_insta_private_message');
		$this->db->where('receiver_id', $uid);
		$this->db->where('response_flag', '1');
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount;
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

}

?>

