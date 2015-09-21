<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Home_model extends CI_Model
{
	 
	/***
	 * Function to search the hot offer property
	 **/
	function getHotOffers()
	{
	   $sql = 'SELECT c.city_name,p.price,i.images
						FROM '.PROPERTY.' as p, '.CITY.' as c, '.PROPERTY_IMAGES.' as i
						WHERE c.id = p.city_id 
						AND p.property_id = i.property_id
						AND p.hot_offer = 1 
						order by RAND() 
						LIMIT 5';
		$query = $this->db->query($sql);
		return $query->result();
	}
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
						WHERE type = ? order by RAND()';
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
		$sql = 'SELECT c.city_name,t.image,t.overlay_image 
						FROM '.TRENDING_DESTINATION.' as t, '.CITY.' as c
						WHERE c.id = t.city
						order by RAND() 
						LIMIT 8';
		$query = $this->db->query($sql);
		return $query->result();
	}
	/***
	 * Function to check the user authentication
	 **/
  function checkLogin($email = '' ,$password = '',$fb_id = '')
	{
		if($fb_id == '')
		{
			$md5_password = md5($password);
			$sql = 'SELECT * FROM '.USER.'  WHERE email = ? AND password = ? AND profile_status = "Active" LIMIT 1';
			$query = $this->db->query($sql,array($email,$md5_password));	
		}
	  else
		{
		  $sql = 'SELECT * FROM '.USER.' WHERE fb_id = ? LIMIT 1';
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
	function chkDuplicateuser($email_id)
	{
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
		  return $this->db->insert_id();
		else
		  return false;
	}
	/**
	* Function to save mobile numbers
	*/
	function saveNumber($mobile_number)
	{
		$sql = 'Insert into guest_mobileno_apps_manage (mobile_number)
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
			$sql = 'SELECT user_id,first_name, last_name,email,profile_status,password
							FROM '.USER.'
							WHERE email = ?  
							LIMIT 1';
			$query = $this->db->query($sql,array($email_id));
		 }
		 else
		 {
		  $sql = 'SELECT user_id,first_name, last_name,email,profile_status ,password
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

    public function addHostSocialMedia($hostSocialMediaData)
    {
    	$this->db->insert('users_social_media', $hostSocialMediaData);
    }
		/***
	 * Function to get the email template from id
	 **/
	function fetchEmailTemplate($email_type)
	{
		$sql = 'SELECT * 
						FROM '.EMAIL_TEMPLATE.' 
						WHERE email_type = ? LIMIT 1';
		$query = $this->db->query($sql,array($email_type));
		return $query->row();
	}
}
?>
