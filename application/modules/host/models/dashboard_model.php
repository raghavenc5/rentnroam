<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Dashboard_model
* extends class Host_Generic_Model
* encapsulates all the properties
* and methods for dashboard CRUD
*/

class Dashboard_model extends Host_Generic_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function fetchDashboardData($hostId)
	{
		$query = "
			select
			u1.profile_pic,
			concat(u1.first_name, ' ' , u1.last_name) full_name,
			date_format(u1.updated_on, '%b %D, %Y') last_updated,
			concat( mc.city_name, ', ', ms.state_name) as location,
			round(
				(
					(
						select
						if (u5.first_name = '', 0, 1)
						+
						if (u5.last_name = '', 0, 1)
						+
						if (u5.gender = '', 0, 1)
						+
						if (u5.birth_date = '0000-00-00', 0, 1)
						+
						if (u5.is_email_verified = 0, 0, 1)
						+
						if (u5.is_emergency_contact_verified = 0, 0, 1)
						+
						if (u5.address_line_1 = '', 0, 1)
						+
						if (u5.address_line_2 = '', 0, 1)
						+
						if (u5.country_id = 0, 0, 1)
						+
						if (u5.state_id = 0, 0, 1)
						+
						if (u5.city_id = 0, 0, 1)
						+
						if (u5.zip = '', 0, 1)
						+
						if (u5.school = '', 0, 1)
						+
						if (u5.college = '', 0, 1)
						+
						if (u5.work = '', 0, 1)
						+
						if (u5.hobbies = '', 0, 1)
						+
						if (u5.about = '', 0, 1)
						+
						if (u5.languages = '', 0, 1)
						from
						users as u5
						where
						u5.user_id = $hostId
					)
					/
					18
				) * 100
			) as profile_completion_percent,
			round(
					(
						(
							(
								select
								if(u2.is_email_verified = 1, 1, 0)
								from
								users u2
								where
								u2.user_id = $hostId
							)
							+
							(
								select
								count(ue2.id)
								from
								users_addtional_email ue2
								where
								ue2.is_verified = 1
								and
								ue2.user_id = $hostId
							)
							+
							(
								select
								if(u2.is_emergency_contact_verified = 1, 1, 0)
								from
								users u2
								where
								u2.user_id = $hostId
							)
							+
							(
								select
								count(uc2.id)
								from
								users_addtional_contact uc2
								where
								uc2.is_verified = 1
								and
								uc2.user_id = $hostId
							)
							+
							(
								select
								count(usm2.id)
								from
								users_social_media usm2
								where
								usm2.user_id = $hostId
							)
							+
							(
								select
								count(ud2.id)
								from
								users_document ud2
								where
								ud2.status = 1
								and
								ud2.user_id = $hostId
							)
						)
						/
						(
							1
							+
							(
								select
								count(ue1.id)
								from
								users_addtional_email ue1
								where
								ue1.user_id = $hostId
							)
							+
							1
							+
							(
								select
								count(uc1.id)
								from
								users_addtional_contact uc1
								where
								uc1.user_id = $hostId
							)
							+
							5
							+
							(
								select
								count(md1.id)
								from
								master_document md1
							)
						)
					) * 100
			) as verification_completion_percent,
			if(
				(
					(
						1
						+
						(
							select
							count(ue3.id)
							from
							users_addtional_email ue3
							where
							ue3.user_id = $hostId
						)
					)
					-
					(
						(
							select
							if(u3.is_email_verified = 1, 1, 0)
							from
							users u3
							where
							u3.user_id = $hostId
						)
						+
						(
							select
							count(ue3.id)
							from
							users_addtional_email ue3
							where
							ue3.is_verified = 1
							and
							ue3.user_id = $hostId
						)
					)
				) = 0,
				true,
				false	
			) as email_verification_completion_status,
			if(
				(
					(
						1
						+
						(
							select
							count(uc3.id)
							from
							users_addtional_contact uc3
							where
							uc3.user_id = $hostId
						)
					)
					-
					(
						(
							select
							if(u4.is_emergency_contact_verified = 1, 1, 0)
							from
							users u4
							where
							u4.user_id = $hostId
						)
						+
						(
							select
							count(uc3.id)
							from
							users_addtional_contact uc3
							where
							uc3.is_verified = 1
							and
							uc3.user_id = $hostId
						)
					)
				) = 0,
				true,
				false	
			) as contact_verification_completion_status,
			if(
				(
					(
						select
						count(md1.id)
						from
						master_document md1
					)
					-
					(
						select
						count(ud3.id)
						from
						users_document ud3
						where
						ud3.status = 1
						and
						ud3.user_id = $hostId
					)
				) = 0,
				true,
				false	
			) as identity_document_verification_completion_status,
			if(
				(
					5
					-
					(
						select
						count(usm3.id)
						from
						users_social_media usm3
						where
						usm3.user_id = $hostId
					)
				) = 0,
				true,
				false	
			) as social_media_verification_completion_status
			from
			users u1
			left join
			master_city mc
			on
			u1.city_id = mc.id
			left join
			master_state ms
			on
			u1.state_id = ms.id
			where
			u1.user_id = $hostId
		";
		$result = $this->db->query($query)->result();

		return isset($result[0]) ? $result[0] : array();
	}

	public function fetchPropertiesDataByHost($hostId)
	{
		$query = "
			select
			*
			from
			(
				select
				p.property_id,
				p.property_title,
				p.area,
				p.latitude,
				p.longitude,
				p.price,
				mpt.property_type,
				count(pr.review_rating_id) review_count,
				greatest(group_concat(pr.rating separator ','),0) highest_rate,
				group_concat(pi.images separator ',') property_images
				from
				properties p
				left join
				master_property_type as mpt
				on
				p.property_type_id = mpt.property_type_id
				left join
				properties_rating pr
				on
				p.property_id = pr.property_id
				left join
				properties_images pi
				on
				p.property_id = pi.property_id
				where
				p.user_id = $hostId
                and
                p.parent_id is null
				group by
				p.property_id
			) as derived_table_1
			left join
			(
				select
				ms.smiley_id,
				ms.smiley_icon
				from
				master_smiley ms
			) as derived_table_2
			on
			derived_table_1.highest_rate = derived_table_2.smiley_id
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function fetchLatestMessagesDataByHost($hostId)
	{
		$query = "
			select
			um.id,
			concat(u1.first_name, ' ', u1.last_name) sender_full_name,
			concat(u2.first_name, ' ', u2.last_name) receiver_full_name,
			um.message,
			date_format(um.sent_on, '%b %D, %Y %l:%i %p') sent_on,
			um.status
			from
			users_insta_private_message as um
			inner join
			users u1
			on
			um.sender_id = u1.user_id
			inner join
			users u2
			on
			um.receiver_id = u2.user_id
			where
			um.receiver_id = $hostId
			order by
			um.id desc
			limit 0, 2
		";
		$result = $this->db->query($query)->result();

		return $result;
	}
    
    public function countAllMessagesByHost($hostId)
    {
        $query = "
            select
            count(*) all_messages_count
            from
            (
                select
                um.id,
                concat(u1.first_name, ' ', u1.last_name) sender_full_name,
                concat(u2.first_name, ' ', u2.last_name) receiver_full_name,
                um.message,
                date_format(um.sent_on, '%b %D, %Y %l:%i %p') sent_on,
                um.status
                from
                users_insta_private_message as um
                inner join
                users u1
                on
                um.sender_id = u1.user_id
                inner join
                users u2
                on
                um.receiver_id = u2.user_id
                where
                um.receiver_id = $hostId
                order by
                um.id desc
            ) dt_1
        ";
        $result = $this->db->query($query)->result();

		return isset($result[0]->all_messages_count) ? $result[0]->all_messages_count : 0;
    }
    
    public function fetchAllMessagesByHost($hostId, $start, $end)
    {
        $query = "
            select
			um.id,
			concat(u1.first_name, ' ', u1.last_name) sender_full_name,
			concat(u2.first_name, ' ', u2.last_name) receiver_full_name,
			um.message,
			date_format(um.sent_on, '%b %D, %Y %l:%i %p') sent_on,
			um.status
			from
			users_insta_private_message as um
			inner join
			users u1
			on
			um.sender_id = u1.user_id
			inner join
			users u2
			on
			um.receiver_id = u2.user_id
			where
			um.receiver_id = $hostId
			order by
			um.id desc
			limit $start, $end
        ";
        $result = $this->db->query($query)->result();

		return $result;
    }
}

/**
* end of file profile_model.php
*/
