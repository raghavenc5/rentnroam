<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Trip_model
* extends class Host_Generic_Model
* encapsulates all the properties
* and methods for host's trip CRUD
*/

class Trip_model extends Host_Generic_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function countPastTripsByHost($hostId)
	{
		$query = "
			select
			count(derived_table_1.booking_id) past_trip_count
			from
			(
				select
				pb.id booking_id,
				pb.property_id,
				date_format(pb.booking_to, '%D %b, %y') booking_from,
				concat(
					if(p.area = '', 'Area Unknown', p.area),
					', ',
					if(ms.state_name = '', 'State Unknown', ms.state_name)
				) location,
				if(p.property_title = '', 'Property Name Unknown', p.property_title) property_title,
				p.bedrooms,
				concat(u.first_name, ' ', u.last_name) host_name,
				p.guest_allow
				from
				properties_booking pb
				left join
				properties p
				on
				pb.property_id = p.property_id
				left join
				master_state ms
				on
				p.state_id = ms.id
				left join
				users u
				on
				p.user_id = u.user_id
				where
				pb.user_id = $hostId
				and
				date(pb.booking_to) <= curdate()
			) derived_table_1
		";
		$result = $this->db->query($query)->result();

		return (isset($result[0]->past_trip_count) && $result[0]->past_trip_count) ? $result[0]->past_trip_count : 0;
	}

	public function fetchPastTripsByHost($hostId, $start, $end)
	{
		$query = "
			select
			pb.id booking_id,
			pb.property_id,
			date_format(pb.booking_to, '%D %b, %y') booking_from,
			concat(
				if(p.area = '', 'Area Unknown', p.area),
				', ',
				if(ms.state_name = '', 'State Unknown', ms.state_name)
			) location,
			if(p.property_title = '', 'Property Name Unknown', p.property_title) property_title,
			p.bedrooms,
			concat(u.first_name, ' ', u.last_name) host_name,
			p.guest_allow
			from
			properties_booking pb
			left join
			properties p
			on
			pb.property_id = p.property_id
			left join
			master_state ms
			on
			p.state_id = ms.id
			left join
			users u
			on
			p.user_id = u.user_id
			where
			pb.user_id = $hostId
			and
			date(pb.booking_to) <= curdate()
			order by
			pb.id desc
			limit $start, $end
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function countUpcomingTripsByHost($hostId)
	{
		$query = "
			select
			count(derived_table_1.booking_id) upcoming_trip_count
			from
			(
				select
				pb.id booking_id,
				pb.property_id,
				date_format(pb.booking_to, '%D %b, %y') booking_from,
				concat(
					if(p.area = '', 'Area Unknown', p.area),
					', ',
					if(ms.state_name = '', 'State Unknown', ms.state_name)
				) location,
				if(p.property_title = '', 'Property Name Unknown', p.property_title) property_title,
				p.bedrooms,
				concat(u.first_name, ' ', u.last_name) host_name,
				p.guest_allow
				from
				properties_booking pb
				left join
				properties p
				on
				pb.property_id = p.property_id
				left join
				master_state ms
				on
				p.state_id = ms.id
				left join
				users u
				on
				p.user_id = u.user_id
				where
				pb.user_id = $hostId
				and
				date(pb.booking_to) >= curdate()
			) derived_table_1
		";
		$result = $this->db->query($query)->result();

		return (isset($result[0]->upcoming_trip_count) && $result[0]->upcoming_trip_count) ? $result[0]->upcoming_trip_count : 0;
	}

	public function fetchUpcomingTripsByHost($hostId, $start, $end)
	{
		$query = "
			select
			pb.id booking_id,
			pb.property_id,
			date_format(pb.booking_to, '%D %b, %y') booking_from,
			concat(
				if(p.area = '', 'Area Unknown', p.area),
				', ',
				if(ms.state_name = '', 'State Unknown', ms.state_name)
			) location,
			if(p.property_title = '', 'Property Name Unknown', p.property_title) property_title,
			p.bedrooms,
			concat(u.first_name, ' ', u.last_name) host_name,
			p.guest_allow
			from
			properties_booking pb
			left join
			properties p
			on
			pb.property_id = p.property_id
			left join
			master_state ms
			on
			p.state_id = ms.id
			left join
			users u
			on
			p.user_id = u.user_id
			where
			pb.user_id = $hostId
			and
			date(pb.booking_to) >= curdate()
			order by
			pb.id desc
			limit $start, $end
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function countReviewsByProperty($propertyId)
	{
		$query = "
			select
			count(derived_table_1.review_id) review_count
			from
			(
				select
				`pr`.`review_rating_id` as review_id,
				concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_full_name`,
				`u`.`profile_pic`,
				date_format(`pr`.`comment_date`, '%b %D, %Y') as `comment_date`,
				`ms`.`smiley_icon`,
				concat(
					if(`p`.`property_title` = '', 'Not Given', `p`.`property_title`),
					', ',
					if(`p`.`area` = '', 'Not Given', `p`.`area`)
				) as `property_location`,
				`pr`.`comment_text`
				from
				`properties_rating` as `pr`
				left join
				`users` as `u`
				on
				`pr`.`user_id` = `u`.`user_id`
				left join
				`master_smiley` as `ms`
				on
				`pr`.`smiley_id` = `ms`.`smiley_id`
				left join
				`properties` as `p`
				on
				`pr`.`property_id` = `p`.`property_id`
				where
				`pr`.`property_id` = $propertyId
			) derived_table_1
		";
		$result = $this->db->query($query)->result();

		return (isset($result[0]->review_count) && $result[0]->review_count) ? $result[0]->review_count : 0;
	}

	public function fetchReviewsByProperty($propertyId, $start, $end)
	{
		$query = "
			select
			`pr`.`review_rating_id` as review_id,
			concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_full_name`,
			`u`.`profile_pic`,
			date_format(`pr`.`comment_date`, '%b %D, %Y') as `comment_date`,
			`ms`.`smiley_icon`,
			concat(
				if(`p`.`property_title` = '', 'Not Given', `p`.`property_title`),
				', ',
				if(`p`.`area` = '', 'Not Given', `p`.`area`)
			) as `property_location`,
			`pr`.`comment_text`
			from
			`properties_rating` as `pr`
			left join
			`users` as `u`
			on
			`pr`.`user_id` = `u`.`user_id`
			left join
			`master_smiley` as `ms`
			on
			`pr`.`smiley_id` = `ms`.`smiley_id`
			left join
			`properties` as `p`
			on
			`pr`.`property_id` = `p`.`property_id`
			where
			`pr`.`property_id` = $propertyId
			order by
			`pr`.`review_rating_id` desc
			limit $start, $end
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function countMessagesByProperty($propertyId)
	{
		$query = "
			select
			count(derived_table_1.id) message_count
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
				users_message as um
				inner join
				users u1
				on
				um.sender_id = u1.user_id
				inner join
				users u2
				on
				um.receiver_id = u2.user_id
				where
				um.property_id = $propertyId
			) derived_table_1
		";
		$result = $this->db->query($query)->result();

		return (isset($result[0]->message_count) && $result[0]->message_count) ? $result[0]->message_count : 0;
	}

	public function fetchMessgaesByProperty($propertyId, $start, $end)
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
			users_message as um
			inner join
			users u1
			on
			um.sender_id = u1.user_id
			inner join
			users u2
			on
			um.receiver_id = u2.user_id
			where
			um.property_id = $propertyId
			order by
			um.id asc
			limit $start, $end
		";
		$result = $this->db->query($query)->result();

		return $result;
	}
    
    public function fetchSmileys()
	{
		$query = "
			select
			*
			from
			`master_smiley`
		";
		$result = $this->db->query($query)->result();

		return $result;
	}
}

/**
* end of file Trip_model.php
*/
