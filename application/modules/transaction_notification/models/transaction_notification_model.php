<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Transaction_notification_model extends CI_Model
{
	/***
	 * Insert the records in the table
	 * @param $table_name : Name of the table to insert the data
	 * @param $ins_data: Array to be inserted
	 **/
	function insertTableData($table_name,$ins_data)
	{
		if($this->db->insert($table_name,$ins_data))
			return $this->db->insert_id();
		else
			return false;
	}
	
	/***
	 * Function to fetch the record based on user_id
	 **/
	function getNotificationByUserId($user_id)
	{
		$sql = "SELECT N.title,TN.id,N.type FROM ".TRANSAC_NOTIFY." as TN, ".NOTIFICATION." as N WHERE TN.user_id='".$user_id."' AND TN.notification_id = N.id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>