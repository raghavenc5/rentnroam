<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Booking_model
* extends class Host_Generic_Model
* encapsulates all the properties
* and methods for host's booking CRUD
*/

class Booking_model extends Host_Generic_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
    /**
     * fetch property data by host
     * 
     * @param int $hostId
     * 
     * @return array
     */
    public function fetchPropertyData($hostId)
    {
        $query = "
            select
            p.property_id,
            if(p.property_title = '', 'Not Given', p.property_title) property_title,
            count(p1.property_id) child_property_count,
            group_concat(p1.property_id order by p1.property_id desc) child_properties,
            group_concat(if(p1.property_title = '', 'Not Given', p1.property_title) order by p1.property_id desc) child_properties_title
            from
            properties p
            left join
            properties p1
            on
            p.property_id = p1.parent_id
            left join
            master_property_type mpt
            on
            p.property_type_id = mpt.property_type_id
            left join
            properties_images pi
            on
            p.property_id = pi.property_id
            left join
            properties_price pp
            on
            p.property_id = pp.property_id
            left join
            properties_tag pt
            on
            p.property_id = pt.property_id
            where
            p.user_id = $hostId
            group by
            p.property_id
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    /**
     * count messages by property
     * that have been dealt by the host
     * 
     * @param int $propertyId
     * 
     * @return int
     */
    public function countViewedMessages($propertyId)
    {
        $query = "
            select
            count(*) viewed_message_count
            from
            (
                select
                um.message,
                if(
                    date(um.sent_on) = curdate(),
                    date_format(um.sent_on, '%l:%i %p'),
                    date_format(um.sent_on, '%D %b, %y')
                ) sent_on,
                concat(u.first_name, ' ', u.last_name) sender_full_name,
                um.status
                from
                users_insta_private_message um
                left join
                users u
                on
                um.sender_id = u.user_id
                where
                um.property_id = $propertyId
                and
                um.status != 'pending'
                order by
                um.id desc
            ) dt_1
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0]->viewed_message_count)) ? $result[0]->viewed_message_count : 0;
    }

    /**
     * fetch messages by property
     * that have been dealt by the host
     * 
     * @param int $propertyId
     * @param int $start
     * @param int $end
     * 
     * @return array
     */
    public function fetchViewedMessages($propertyId, $start, $end)
    {
        $query = "
            select
            um.message,
            if(
                date(um.sent_on) = curdate(),
                date_format(um.sent_on, '%l:%i %p'),
                date_format(um.sent_on, '%D %b, %y')
            ) sent_on,
            concat(u.first_name, ' ', u.last_name) sender_full_name,
            um.status
            from
            users_insta_private_message um
            left join
            users u
            on
            um.sender_id = u.user_id
            where
            um.property_id = $propertyId
            and
            um.status != 'pending'
            order by
            um.id desc
            limit $start, $end
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    
    /**
     * count messages by property
     * that havn't been dealt by host
     * 
     * @param int $propertyId
     * 
     * @return int
     */
    public function countPendingMessages($propertyId)
    {
        $query = "
            select
            count(*) viewed_message_count
            from
            (
                select
                um.message,
                if(
                    date(um.sent_on) = curdate(),
                    date_format(um.sent_on, '%l:%i %p'),
                    date_format(um.sent_on, '%D %b, %y')
                ) sent_on,
                concat(u.first_name, ' ', u.last_name) sender_full_name,
                um.status
                from
                users_insta_private_message um
                left join
                users u
                on
                um.sender_id = u.user_id
                where
                um.property_id = $propertyId
                and
                um.status = 'pending'
                order by
                um.id desc
            ) dt_1
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0]->viewed_message_count)) ? $result[0]->viewed_message_count : 0;
    }

    /**
     * fetch messages by property
     * that havn't been dealt by host
     * 
     * @param int $propertyId
     * @param int $start
     * @param int $end
     * 
     * @return array
     */
    public function fetchPendingMessages($propertyId, $start, $end)
    {
        $query = "
            select
            um.message,
            if(
                date(um.sent_on) = curdate(),
                date_format(um.sent_on, '%l:%i %p'),
                date_format(um.sent_on, '%D %b, %y')
            ) sent_on,
            concat(u.first_name, ' ', u.last_name) sender_full_name,
            um.status
            from
            users_insta_private_message um
            left join
            users u
            on
            um.sender_id = u.user_id
            where
            um.property_id = $propertyId
            and
            um.status = 'pending'
            order by
            um.id desc
            limit $start, $end
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    /**
     * count reviews for this property
     * 
     * @param type $propertyId
     * @return array
     */
    public function countReviews($propertyId)
    {
        $query = "
            select
            count(*) review_count
            from
            (
                select
                u.profile_pic,
                concat(u.first_name, ' ', u.last_name) user_full_name,
                if(
                    date(pr.comment_date) = curdate(),
                    date_format(pr.comment_date, '%l:%i %p'),
                    date_format(pr.comment_date, '%D %b, %y')
                ) commented_on,
                ms.smiley_icon,
                pr.comment_text
                from
                properties_rating pr
                left join
                users u
                on
                pr.user_id = u.user_id
                left join
                master_smiley ms
                on
                pr.smiley_id = ms.smiley_id
                where
                pr.property_id = $propertyId
            ) dt_1            
        ";
        
        $result = $this->db->query($query)->result();
        
        return isset($result[0]->review_count) ? $result[0]->review_count : 0;
    }
    
    /**
     * fetch reviews for this property
     * 
     * @param type $propertyId
     * @return array
     */
    public function fetchReviews($propertyId, $start = 0, $end = null)
    {
        $query = "
            select
            u.profile_pic,
            concat(u.first_name, ' ', u.last_name) user_full_name,
            if(
                date(pr.comment_date) = curdate(),
                date_format(pr.comment_date, '%l:%i %p'),
                date_format(pr.comment_date, '%D %b, %y')
            ) commented_on,
            ms.smiley_icon,
            pr.comment_text
            from
            properties_rating pr
            left join
            users u
            on
            pr.user_id = u.user_id
            left join
            master_smiley ms
            on
            pr.smiley_id = ms.smiley_id
            where
            pr.property_id = $propertyId
        ";
        $query .= ($end) ? "limit $start, $end" : '';
        
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    /**
     * fetch top rating and view count by property
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchTopRatingAndViewCount($propertyId)
    {
        $query = "
            select
            p.view_count,
            dt_1.rating,
            ms.smiley_icon
            from
            properties p
            left join
            (
                select
                pr_3.property_id,
                pr_3.rating
                from
                properties_rating pr_1
                join
                (
                    select
                    pr_2.property_id,
                    pr_2.rating,
                    count(*) as rating_count 
                    from
                    properties_rating pr_2
                    where
                    pr_2.property_id = $propertyId
                    group by rating
                ) pr_3
                on
                pr_1.rating = pr_3.rating
                group by
                pr_3.rating
                order by
                pr_3.rating_count desc
                limit 0, 1
            ) dt_1
            on
            p.property_id = dt_1.property_id
            left join
            master_smiley ms
            on
            dt_1.rating = ms.smiley_id
            where
            p.property_id = $propertyId
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0])) ? $result[0] : array();
    }
    
    /**
     * fetch upcoming and past booking count by property
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchUpcomingAndPastBookingCount($propertyId) {
        $query = "
            select
            dt1.upcoming_booking_count,
            dt2.past_booking_count
            from
            (
                select
                $propertyId property_id,
                count(pb1.id) upcoming_booking_count
                from
                properties_booking pb1
                where
                pb1.property_id = $propertyId
                and
                curdate() < pb1.booking_to
            ) dt1
            inner join
            (
                select
                $propertyId property_id,
                count(pb2.id) past_booking_count
                from
                properties_booking pb2
                where
                pb2.property_id = $propertyId
                and
                pb2.booking_to < curdate()
            ) dt2
            on
            dt1.property_id = dt2.property_id
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0])) ? $result[0] : array();
    }
    
    /**
     * fetch booking scgedule data by property
     * 
     * @param int $propertyId
     * @param string $selectedDate
     * 
     * @return type
     */
    public function fetchCalendarData($propertyId, $selectedDate)
    {
        $query = "
            select
            dt_23.start date,
            (
                case
                    when dt_25.status = 2 then 'booked'
                    when dt_26.status = 0 then 'blocked'
                    else ''
                end
            ) class,
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
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    /**
     * fetch listing completion data by property
     * 
     * @param int $propertyId
     * @return array
     */
    public function fetchPropertyListingCompletionData($propertyId)
    {
        $query = "
            select
            p.property_id,
            p.guest_allow,
            mpt.property_type,
            (
                (
                    if(p.property_title != '', 1, 0)
                    +
                    if(p.description != '', 1, 0)
                    +
                    if(group_concat(pi.images) is null, 0, 1)
                    +
                    if(group_concat(pp.price) is null, 0, 1)
                    +
                    if(p.property_type_id = 0, 0, 1)
                    +
                    if(p.room_type_id = 0, 0, 1)
                    +
                    if(p.guest_allow = '', 0, 1)
                    +
                    if(p.bedrooms = '', 0, 1)
                    +
                    if(p.bathrooms = '', 0, 1)
                    +
                    if(p.cancellation_policy_id = 0, 0, 1)
                    +
                    if(p.check_in_time = '', 0, 1)
                    +
                    if(p.check_out_time = '', 0, 1)
                    +
                    if(group_concat(pt.master_tag_id) is null, 0, 1)
                    +
                    if(p.address_line1 = '', 0, 1)
                    +
                    if(p.country_id = 0, 0, 1)
                    +
                    if(p.state_id = 0, 0, 1)
                    +
                    if(p.city_id = 0, 0, 1)
                    +
                    if(p.zip = '', 0, 1)
                    +
                    if(p.latitude = '', 0, 1)
                    +
                    if(p.longitude = '', 0, 1)
                )
                /
                20
            ) listing_completeness,
            if(p.property_title = '', 'Not Given', p.property_title) property_title
            from
            properties p
            left join
            master_property_type mpt
            on
            p.property_type_id = mpt.property_type_id
            left join
            properties_images pi
            on
            p.property_id = pi.property_id
            left join
            properties_price pp
            on
            p.property_id = pp.property_id
            left join
            properties_tag pt
            on
            p.property_id = pt.property_id
            where
            p.property_id = $propertyId
            group by
            p.property_id
        ";
        $result = $this->db->query($query)->result();
        
        return (isset($result[0])) ? $result[0] : array();
    }
    
    /**
     * fetch upcoming bookings count
     * 
     * @param int $propertyId
     * @return int
     */
    public function countUpcomingBookings($propertyId)
    {
        $query = "select count(*) upcoming_bookings_count from properties_booking where property_id = $propertyId and curdate() < booking_to";
        $result = $this->db->query($query)->result();
        
        return isset($result[0]->upcoming_bookings_count) ? $result[0]->upcoming_bookings_count : 0;
    }
    
    /**
     * fetch upcoming bookings
     * 
     * @param int $propertyId
     * @param int $start
     * @param int $end
     */
    public function fetchUpcomingBookings($propertyId, $start, $end)
    {
        $query = "
            select
            pb.id,
            if(
                date(pb.booking_date) = curdate(),
                date_format(pb.booking_date, '%l:%i %p'),
                date_format(pb.booking_date, '%D %b, %y')
            ) applied_on,
            concat(u.first_name, ' ', u.last_name) applied_by,
            concat(
                'From', ' ', date_format(pb.booking_to, '%D %b, %y'), ' ', 'To', ' ', date_format(pb.booking_upto, '%D %b, %y')
            ) tenure,
            pb.guest_no guest_count,
            pb.status
            from
            properties_booking pb
            left join
            properties p
            on
            pb.property_id = p.property_id
            left join
            users u
            on
            p.user_id = u.user_id
            where
            pb.property_id = $propertyId
            and
            curdate() < pb.booking_to
            order by
            pb.id desc
            limit
            $start, $end
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
    
    /**
     * fetch past bookings count
     * 
     * @param int $propertyId
     * @return int
     */
    public function countPastBookings($propertyId)
    {
        $query = "select count(*) past_bookings_count from properties_booking where property_id = $propertyId and booking_to <= curdate()";
        $result = $this->db->query($query)->result();
        
        return isset($result[0]->past_bookings_count) ? $result[0]->past_bookings_count : 0;
    }
    
    /**
     * fetch past bookings
     * 
     * @param int $propertyId
     * @param int $start
     * @param int $end
     */
    public function fetchpastBookings($propertyId, $start, $end)
    {
        $query = "
            select
            pb.id,
            if(
                date(pb.booking_date) = curdate(),
                date_format(pb.booking_date, '%l:%i %p'),
                date_format(pb.booking_date, '%D %b, %y')
            ) applied_on,
            concat(u.first_name, ' ', u.last_name) applied_by,
            concat(
                'From', ' ', date_format(pb.booking_to, '%D %b, %y'), ' ', 'To', ' ', date_format(pb.booking_upto, '%D %b, %y')
            ) tenure,
            pb.guest_no guest_count,
            pb.status
            from
            properties_booking pb
            left join
            properties p
            on
            pb.property_id = p.property_id
            left join
            users u
            on
            p.user_id = u.user_id
            where
            pb.property_id = $propertyId
            and
            pb.booking_to <= curdate()
            order by
            pb.id desc
            limit
            $start, $end
        ";
        $result = $this->db->query($query)->result();
        
        return $result;
    }
}

/**
* end of file Trip_model.php
*/
