<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Admin_model extends CI_Model
{
 /***
  * Function to check the admin login functionality
  * @param VARCHAR $user_name
  * @param VARCHAR $password
  */
 function admin_login($user_name, $password)
 {
   $this -> db -> select('admin_id');
   $this -> db -> from('admin_users');
   $this -> db -> where('user_name', $user_name);
   $this -> db -> where('password',MD5($password));
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->row();
   }
   else
   {
     return false;
   }
 }
 
 /***
  * Function to get admin information
  **/
 function get_admin_info()
 {
	$user_name  = $this->session->userdata('user_name');
	$sql = "SELECT * FROM admin_users WHERE user_name = ? LIMIT 1";
	$query = $this->db->query($sql,array($user_name));
	$row = $query->row();
	return $row;
 }
 
 /***
  * function to check the admin password is correct or not
  * @param INT $password
  **/
 function chk_admin_password($password)
	{
		$user_name  = $this->session->userdata('user_name');
		$sql = "SELECT admin_id FROM admin_users
		        WHERE user_name = ? AND password = ? LIMIT 1";
		$query = $this->db->query($sql,array($user_name,MD5($password)));
		if($query->row())
		  return true;
		else
		  return false;
	}
	 /****
	 * Funciton get the list of the users
	 **/
	function get_user_list()
	{
		$sql = 'SELECT user_id,CONCAT(first_name, " ",last_name) AS "user_name",email,user_emergency_contact_no,gender,status
						FROM '.USER.'
						ORDER BY user_id';
		$query = $this->db->query($sql);
    return $query->result();		        
	}
	/***
	 * Function to fetch the user data as per the searching
	 **/
	function fetch_user_data($offset, $per_page, $orderColumn, $sortOrder,$user_id)
	{
		$cond='';
		if($user_id != '-')
		{
			$cond = "AND user_id = $user_id ";
		}
		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS user_id,CONCAT(first_name, " ",last_name) AS "user_name",email,profile_pic,
						status,user_emergency_contact_no,gender
			      FROM '.USER.'
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    $query = $this->db->query($sql);
		//echo $this->db->last_query();
    return $query->result();
	}
	/***
	 * Update the record in the table
	 * @param String $table_name: Name of the table from which records gets updated
	 * @param Array $ins_db: Updated array
	 **/
	function updateTableData($table_name,$ins_db, $arr='')
	{
    if($this->db->update($table_name,$ins_db,$arr))
		  return true;
	  else
		  return false;
	}


	function get_user_info($user_id)
	{
		$sql = 'SELECT first_name,last_name,CONCAT(first_name, " ",last_name) AS "user_name",email,profile_pic,
						user_emergency_contact_no,gender,status
		        FROM '.USER.'
						WHERE  user_id = ?';
		$query = $this->db->query($sql,array($user_id));
		return $query->row();
	}


	/*property management*/
	function get_property_info($prop_id)
	{
		$sql = 'SELECT a.*, b.country_name, c.state_name, d.city_name, e.roomtype, f.property_type, g.policy, g.policy_description
		        FROM properties as a, master_country as b, master_state as c, master_city as d, master_room_type as e, master_property_type as f, master_cancellation_policy as g
				WHERE  a.property_id = ? AND b.country_id = a.country_id AND c.id = a.state_id AND d.id = a.city_id AND e.room_type_id = a.room_type_id AND f.property_type_id = a.property_type_id AND g.id = a.cancellation_policy_id';
		$query = $this->db->query($sql,array($prop_id));
		return $query->row();
	}

	function Count_property_Rooms($prop_id)
	{
		$this->db->select('*');
		$this->db->from('properties_rooms');
		$this->db->where('property_id', $prop_id);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		return $rowcount;
	}

	function get_property_Rooms($prop_id)
	{
		
		$sql = 'SELECT a.*, b.roomtype
		        FROM properties_rooms as a, master_room_type as b WHERE  a.property_id = ? AND b.room_type_id = a.room_type_id';
		$query = $this->db->query($sql,array($prop_id));
		return $query->result();	
		
		/*$results = array();
				$this->db->select('*');
				$this->db->from('properties_rooms');
				$this->db->join('master_room_type', 'properties_rooms.room_type_id = master_amenities_type.amenities_type_id');
				$this->db->where_in('amenities_id', $ids );*/
	}

	/* End property management */
	function getPropertyTags($prop_id)
	{
		$sql = 'SELECT a.*, b.tag
		        FROM properties_tag as a, master_tag as b WHERE  a.property_id = ? AND b.id = a.master_tag_id';
		$query = $this->db->query($sql,array($prop_id));
		return $query->row();
	}


	public function extractAmenit($property_id){
			$query = $this->db->query( "SELECT amenities_id FROM properties_amenities WHERE property_id ='$property_id'" );
            return $query->result();		
		}

	public function extractTags($property_id){
			$query = $this->db->query( "SELECT master_tag_id FROM properties_tag WHERE property_id ='$property_id'" );
            return $query->result();		
		}	

	public function getAmenitDetails( $ids){
				$results = array();
				$this->db->select('*');
				$this->db->from('master_amenities');
				$this->db->join('master_amenities_type', 'master_amenities.amenities_type = master_amenities_type.amenities_type_id');
				$this->db->where_in('amenities_id', $ids );

				/*
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				*/
				$query = $this->db->get();

    			if($query->num_rows() > 0) {
        			$results = $query->result();
    			}
				return $results;
				/*
				$query = $this->db->query( "SELECT t1.*, t2.amenities_type_name FROM master_amenities AS t1, master_amenities_type AS t2 WHERE IN t1.amenities_id ='$ids' AND t1.amenities_type = t2.amenities_type_id ");
				
				return $query->result(  );*/
				
		}	

	public function getTagsDetails( $ids){
				$this->db->select('*');
				$this->db->from('master_tag');			
				$this->db->where_in('id', $ids );
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}			
		}	

	public function get_season1_price($pid)
	{
			$this->db->select('*');
				$this->db->from('properties_price');			
				$this->db->where('property_id', $pid);
				$this->db->where('master_price_seasontype_id', '1');
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
	}

	public function get_season2_price($pid)
	{
			$this->db->select('*');
				$this->db->from('properties_price');			
				$this->db->where('property_id', $pid);
				$this->db->where('master_price_seasontype_id', '2');
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
	}	

	public function get_season3_price($pid)
	{
			$this->db->select('*');
				$this->db->from('properties_price');			
				$this->db->where('property_id', $pid);
				$this->db->where('master_price_seasontype_id', '3');
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
	}

	public function get_season4_price($pid)
	{
			$this->db->select('*');
				$this->db->from('properties_price');			
				$this->db->where('property_id', $pid);
				$this->db->where('master_price_seasontype_id', '4');
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
	}

	public function get_property_images($pid)
	{
		$this->db->select('*');
				$this->db->from('properties_images');			
				$this->db->where('property_id', $pid);
				$query = $this->db->get();
				if($query){
				return $query->result_array();
				}
				else{
				return null;
				}
	}

	public function Updatestatus($status, $prop_id)
	{
		$data=array('status'=>$status);
		return $this->db->where('property_id',$prop_id)->update(PROPERTY,$data);
	}


	
	/***
	** Function to get user documents
	*/
	function getUserdoc($user_id)
	{
		$sql = 'SELECT * 
						FROM '.DOCUMENT.'
						WHERE user_id = ? 
						LIMIT 1';
		$query = $this->db->query($sql,array($user_id));
		return $query->row();
	}
	/****
	 * Function to check the duplicate record
	 **/
	function chk_duplicate_user($data)
	{
		$email_id = $data['email'];
		if($data['user_id'] != '' )		
			$msg = "AND user_id != ".$data['user_id'] ;
		else
		  $msg = '';
		$sql = 'SELECT user_id FROM '.USER.'
		        WHERE (email= ?) '.$msg.' LIMIT 1';
		$query = $this->db->query($sql,array($email_id));
		return $query->row();
	}
	/**
	** Function to get USER Property according to user_id
	*/
	function getUserproperty($user_id)
	{
		$sql = 'SELECT p.bathrooms,p.user_id,p.property_id,p.price,p.description,p.min_night_stay,m.policy,p.house_rule,
						 p.bed,p.bedrooms,p.guest_allow,c.city_name,r.roomtype,t.property_type,p.check_in_time
						 ,p.check_out_time,p.rnr_recommended,p.property_title,p.address_line1,p.host_language,p.latitude,p.longitude					
						 FROM '.PROPERTY.' as p,'.CITY.' as c, 
						 '.ROOM_TYPE.' as r, '.PROPERTY_TYPE.' as t, '.POLICY.' as m
						 WHERE c.id = p.city_id 
						 AND t.property_type_id = p.property_type_id 
						 AND r.room_type_id = p.room_type_id
						 AND p.cancellation_policy_id = m.id 
						 AND p.user_id = ?';
		$query = $this->db->query($sql,array($user_id));
		//echo $this->db->last_query();
		$result = $query->result();
		return $result;
	}
	
	
		/***
	 * Function to fetch the master_country as per the searching
	 **/
	function fetch_country_master_data($offset, $per_page, $orderColumn, $sortOrder, $country_id)
	{
		
		$cond='';
		if($country_id != '-')
		{
			$cond = "AND country_id = $country_id ";
		}
		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS country_id, country_name, status
			      FROM '.COUNTRY.'
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    $query = $this->db->query($sql);
		//echo $this->db->last_query();
    return $query->result();
	}

	/***
	 * Function to fetch the master_state as per the searching
	 **/
	function fetch_state_master_data($offset, $per_page, $orderColumn, $sortOrder, $id)
	{
		/*	
		$cond='';
		if($id != '-')
		{
			$cond = "AND id = $id ";
		}
		else
		{
			$cond='';
		}*/

		$this->db->select('SQL_CALC_FOUND_ROWS t1.*, t2.country_name', FALSE)
					->from(STATE.' AS t1, '.COUNTRY.' AS t2')
					->where('t1.country_id = t2.country_id');
					//->order_by($orderColumn, $sortOrder)
					//->limit($offset, $per_page);
					//->where($cond);
					$query1 = $this->db->get();
				return $query1->result();

	/*	$sql = "SELECT SQL_CALC_FOUND_ROWS 't1.id', 't1.state_name', 't1.status', 't2.country_name'
			      FROM ".STATE." t1 INNER JOIN ".COUNTRY." t2 ON t1.country_id = t2.country_id 
		        ORDER BY						
						".$orderColumn." 
						".$sortOrder."
						LIMIT 
						".$offset." , ".$per_page." ";*/
		/*$this->db->select('SQL_CALC_FOUND_ROWS t1.id, t1.state_name, t1.status, t2.country_name', false)
					->from(STATE.' AS t1, '.COUNTRY.' AS t2')
					->where('t1.country_id = t2.country_id')
					//->where($cond)
					->order_by($orderColumn, $sortOrder)
					->limit($offset, $per_page);
					$query1 = $this->db->get();
				return $query1->result();*/
			/*
			$this->db->select('SQL_CALC_FOUND_ROWS *', false);
            $this->db->from('master_state a'); 
            $this->db->join('master_country b', 'b.country_id=a.country_id');
           // $this->db->where($cond);
            $this->db->order_by($orderColumn, $sortOrder);  
            $this->db->limit($offset, $per_page);       
            $query = $this->db->get();	*/			
				
    //$query = $this->db->query($sql);
		//echo $this->db->last_query();*/
    //return $query->result();
	}


	/***
	 * Function to fetch the master_state as per the searching
	 **/
	function fetch_city_master_data($offset, $per_page, $orderColumn, $sortOrder, $id)
	{
	
		$this->db->select('SQL_CALC_FOUND_ROWS t1.*, t2.country_name, t3.state_name', FALSE)
					->from(CITY.' AS t1, '.COUNTRY.' AS t2, '.STATE.' AS t3')
					->where('t1.country_id = t2.country_id')
					->where('t1.state_id = t3.id');
					//->order_by($orderColumn, $sortOrder)
					//->limit($offset, $per_page);
					//->where($cond);
					$query1 = $this->db->get();
				return $query1->result();

	}

	/***
	 * Function to fetch the master_roomtype as per the searching
	 **/
	
	function fetch_room_type_data($offset, $per_page, $orderColumn, $sortOrder, $room_id)
	{
		$cond='';
		if($room_id != '-')
		{
			$cond = "AND room_type_id = $room_id ";
		}
		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS room_type_id, roomtype, title, images
			      FROM '.ROOM_TYPE.'
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();	 
	}

	function fetch_amenities_type_data($offset, $per_page, $orderColumn, $sortOrder, $amenities_id)
	{
		$cond='';
		if($amenities_id != '-')
		{
			$cond = "AND amenities_type_id = $amenities_id ";
		}
		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_amenities_type
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	} 

	function fetch_amenitiesSubtype_data($offset, $per_page, $orderColumn, $sortOrder, $amenities_id)
	{
		$cond='';
		if($amenities_id != '-')
		{
			$cond = "AND amenities_id = $amenities_id ";
		}
		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS amenities_id, amenities_type, amenities_subtype, images, status
			      FROM master_amenities
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}

	public function fetch_propertytype_data($offset, $per_page, $orderColumn, $sortOrder, $ptype_id)
	{
		$cond='';
		if($ptype_id != '-')
		{
			$cond = "AND property_type_id = $ptype_id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_property_type
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}

	public function fetch_propertytag_data($offset, $per_page, $orderColumn, $sortOrder, $tag_id)
	{
		$cond='';
		if($tag_id != '-')
		{
			$cond = "AND id = $tag_id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_tag
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}


	public function fetch_propertysmiley_data($offset, $per_page, $orderColumn, $sortOrder, $smiley_id)
	{
		$cond='';
		if($smiley_id != '-')
		{
			$cond = "AND smiley_id = $smiley_id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_smiley
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}
	
	public function fetch_propertypolicy_data($offset, $per_page, $orderColumn, $sortOrder, $id)
	{
		$cond='';
		if($id != '-')
		{
			$cond = "AND id = $id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_cancellation_policy
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}
	
	public function fetch_priceperiod_data($offset, $per_page, $orderColumn, $sortOrder, $id)
	{
		$cond='';
		if($id != '-')
		{
			$cond = "AND id = $id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_price_period
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}

	public function fetch_seasontype_data($offset, $per_page, $orderColumn, $sortOrder, $id)
	{
		$cond='';
		if($id != '-')
		{
			$cond = "AND id = $id ";
		}	

		else
		{
			$cond='';
		}
		$sql = 'SELECT SQL_CALC_FOUND_ROWS *
			      FROM master_price_seasontype
						WHERE 1
						'.$cond.'
		        ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.' ';
    	$query = $this->db->query($sql);
		//echo $this->db->last_query();
   		 return $query->result();
	}
	
	function fetch_property_booking($offset, $per_page, $orderColumn, $sortOrder,$id)
	{
		$sql = 'SELECT SQL_CALC_FOUND_ROWS b.*,CONCAT(u.first_name, " ",u.last_name) AS "user_name",
		        FROM '.USER.' as u, '.PROPERTY_BOOKING.' as b
						WHERE  u.user_id = b.user_id
						 ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.'' ;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}


	function fetch_properties($offset, $per_page, $orderColumn, $sortOrder,$id)
	{
		$sql = 'SELECT SQL_CALC_FOUND_ROWS b.*,CONCAT(u.first_name, " ",u.last_name) AS "user_name", c.country_name, cc.city_name
		        FROM '.USER.' as u, '.PROPERTY.' as b, master_country as c, master_city as cc
						WHERE  u.user_id = b.user_id AND c.country_id = b.country_id AND cc.id = b.city_id
						 ORDER BY						
						'.$orderColumn.' 
						'.$sortOrder.'
						LIMIT 
						'.$offset.' , '.$per_page.'' ;
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
}
?>