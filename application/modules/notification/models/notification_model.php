<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Notification_model extends CI_Model
{
	/***
	 * Function to fetch the record based on type
	 **/
	function getTypeBaseNotification($type)
	{
		$sql = "SELECT id FROM ".NOTIFICATION." WHERE type='".$type."'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}
?>