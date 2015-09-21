<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Static_model extends CI_Model
{
	 
	/***
	 * Function to get hot offer property
	 **/
	function getHotOffers()
	{
	   $sql = 'SELECT c.city_name,p.price 
						FROM '.PROPERTY.' as p, '.CITY.' as c
						WHERE c.id = p.city_id 
						AND p.hot_offer = 1 
						order by RAND()';
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
						order by RAND()';
		$query = $this->db->query($sql);
		return $query->result();
	}

	/**
	* Function to load what happening section
	*/
	function getUpcomingfestival()
	{
		$sql = 'SELECT * 
						FROM '.WHAT_HAPPENING.' 
						order by RAND()';
		$query = $this->db->query($sql);
		return $query->result();
	}
	/**
	* Function to load faq according to type
	**/
	function getFaq($type)
	{
		$sql = 'SELECT * 
						FROM '.FAQ.'
						WHERE type = ?';
		$query = $this->db->query($sql,array($type));
		return $query->result();
						
	}
}
?>
