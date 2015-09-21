<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Profile_model
* extends class Host_Generic_Model
* encapsulates all the properties
* and methods for profile CRUD
*/

class Profile_model extends Host_Generic_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function fetchProfileDataByHostId($hostId)
	{
		$query = "
			select
			`u`.`user_id`,
			`u`.`profile_pic`,
			`u`.`first_name`,
			`u`.`last_name`,
			`u`.`gender`,
			`u`.`birth_date`,
			`u`.`email`,
			`u`.`is_email_verified`,
			(
				select
				group_concat(concat(`uc`.`id`, ',', `uc`.`prefix`, ',', `uc`.`number`, ',', `uc`.`is_verified`, ',', `uc`.`contact_verification_code`) separator ';')
				from
				`users_addtional_contact` as `uc`
				where
				`uc`.`user_id` = $hostId
			) as `user_other_contact`,
			(
				select
				group_concat(concat(`ue`.`id`, ',', `ue`.`email`, ',', `ue`.`is_verified`, ',', `ue`.`verification_code`) separator ';')
				from
				`users_addtional_email` as `ue`
				where
				`ue`.`user_id` = $hostId
			) as `user_other_email`,
			(
				select
				group_concat(concat(`ud`.`id`, ',', `ud`.`document_id`, ',', `ud`.`status`) separator ';')
				from
				`users_document` as `ud`
				where
				`ud`.`user_id` = $hostId
			) as `user_document`,
			(
				select
				group_concat(`usm`.`social_media` separator ';')
				from
				`users_social_media` as `usm`
				where
				`usm`.`user_id` = $hostId
			) as `user_social_media`,
			`u`.`user_emergency_contact_prefix`,
			`u`.`user_emergency_contact_no`,
			`u`.`is_emergency_contact_verified`,
			`u`.`address_line_1`,
			`u`.`address_line_2`,
			`u`.`country_id`,
			`u`.`state_id`,
			`u`.`city_id`,
			`u`.`zip`,
			`u`.`school`,
			`u`.`college`,
			`u`.`work`,
			`u`.`hobbies`,
			`u`.`about`,
			`u`.`languages`
			from
			`users` as `u`
			left join
			`users_addtional_contact` as `uc`
			on
			`u`.`user_id` = `uc`.`user_id`
			left join
			`users_addtional_email` as `ue`
			on
			`u`.`user_id` = `ue`.`user_id`
			where
			`u`.`user_id` = $hostId
		";
		$result = $this->db->query($query)->result();

		return isset($result[0]) ? $result[0] : array();
	}

	public function saveHostProfileData($hosts, $hostEmails, $hostContacts, $hostId)
	{
		$this->db->trans_start();

		$this->db->where('user_id', $hostId);

		$this->db->delete('users_addtional_email');

		$this->db->insert_batch('users_addtional_email', $hostEmails);

		$this->db->where('user_id', $hostId);

		$this->db->delete('users_addtional_contact');

		$this->db->insert_batch('users_addtional_contact', $hostContacts);

		$this->db->where('user_id', $hostId);

		$this->db->update('users', $hosts);

		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	public function fetchReceivedReviews($hostId)
	{
		$query = "
			select
			concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_full_name`,
			`u`.`profile_pic`,
			date_format(`pr`.`comment_date`, '%b %D, %Y') as `comment_date`,
			`ms`.`smiley_image`,
			`ms`.`smiley_type`,
			concat(
				if(`p`.`property_title` = '', 'Not Given', `p`.`property_title`),
				', ',
				if(`p`.`area` = '', 'Not Given', `p`.`area`)
			) as `property_location`,
			`pr`.`rating`
			from
			`properties_rating_alt` as `pr`
			left join
			`users` as `u`
			on
			`pr`.`user_id` = `u`.`user_id`
			left join
			`master_smiley_alt` as `ms`
			on
			`pr`.`smiley_id` = `ms`.`smiley_id`
			left join
			`properties` as `p`
			on
			`pr`.`property_id` = `p`.`property_id`
			where
			`pr`.`property_id`
			in
			(
				select
				`p1`.`property_id`
				from
				`properties` as `p1`
				where
				`p1`.`user_id` = $hostId
			)
			order by
			`pr`.`review_rating_id` desc
			limit 0, 5
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function fetchOwnReviews($hostId)
	{
		$query = "
			select
			concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_full_name`,
			`u`.`profile_pic`,
			date_format(`pr`.`comment_date`, '%b %D, %Y') as `comment_date`,
			`ms`.`smiley_image`,
			`ms`.`smiley_type`,
			concat(
				if(`p`.`property_title` = '', 'Not Given', `p`.`property_title`),
				', ',
				if(`p`.`area` = '', 'Not Given', `p`.`area`)
			) as `property_location`,
			`pr`.`rating`
			from
			`properties_rating_alt` as `pr`
			left join
			`users` as `u`
			on
			`pr`.`user_id` = `u`.`user_id`
			left join
			`master_smiley_alt` as `ms`
			on
			`pr`.`smiley_id` = `ms`.`smiley_id`
			left join
			`properties` as `p`
			on
			`pr`.`property_id` = `p`.`property_id`
			where
			`pr`.`user_id` = $hostId
			and `pr`.`property_id`
			not in
			(
				select
				`p1`.`property_id`
				from
				`properties` as `p1`
				where
				`p1`.`user_id` = $hostId
			) 
			order by
			`pr`.`review_rating_id` desc
			limit 0, 5
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
			`master_smiley_alt`
		";
		$result = $this->db->query($query)->result();

		return $result;
	}

	public function saveReviewData($reviewData)
	{
		return $this->db->insert('properties_rating', $reviewData);
	}

	public function updateHostProfilePic($profilePicName, $hostId)
	{
		$this->db->where('user_id', $hostId);

		return $this->db->update('users', array('profile_pic' => $profilePicName));
	}

	public function setEmailVerificationDetails($verificationData, $table, $primaryKey, $id)
	{
		$this->db->where($primaryKey, $id);
		return $this->db->update($table, $verificationData);
	}

	public function verifyEmail($emailType, $id, $verificationCode)
	{
		if ('primary' === $emailType) {
			$query = "
				select
				count(`u`.`user_id`) as `is_verified`
				from
				`users` as `u`
				where
				`u`.`verification_code` = '$verificationCode'
				and
				`u`.`user_id` = $id
			";
		} elseif ('secondary' === $emailType) {
			$query = "
				select
				count(`ue`.`id`) as `is_verified`
				from
				`users_addtional_email` as `ue`
				where
				`ue`.`verification_code` = '$verificationCode'
				and
				`ue`.`id` = $id
			";
		} else {
			//
		}
		$result = $this->db->query($query)->result();

		return (isset($result[0]) && $result[0]) ? $result[0] : 0;
	}

	public function markEmailAsVerified($emailType, $id)
	{
		if ('primary' === $emailType) {
			$this->db->where('user_id', $id);
			return $this->db->update('users', array(
				'verification_code' => '',
				'is_verified' => 1,
			));
		} elseif ('secondary' === $emailType) {
			$this->db->where('id', $id);
			return $this->db->update('users_addtional_email', array(
				'verification_code' => '',
				'is_verified' => 1,
			));
		} else {
			//
		}
	}

	public function fetchDocuments()
	{
		$result = $this->db->select('*')
				->from('master_document')
				->where('status', 1)
				->get()
				->result();

		return $result;
	}

	public function saveIdentityDocument($identityDocumentData)
	{
		return $this->db->insert('users_document', $identityDocumentData);
	}
    
    public function logHostSocialMediaVerification($socialMediaVerificationData)
    {
        return $this->db->insert('users_social_media', $socialMediaVerificationData);
    }
}

/**
* end of file profile_model.php
*/
