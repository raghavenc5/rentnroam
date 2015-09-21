<?php

class Host_Generic_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function validateUserData($userData, $validationRules)
    {
        $validationErrors = array();
        
        foreach ($userData as $key => $value) {
            if (array_key_exists($key, $validationRules)){
                $this->form_validation->set_rules($validationRules[$key]['field'], $validationRules[$key]['label'], $validationRules[$key]['rules']);
                
                if (! $this->form_validation->run()){
                    $validationErrors[$validationRules[$key]['field']] = strip_tags(form_error($validationRules[$key]['field']));
                }
            }
        }
        
        return $validationErrors;
    }

    public function isHostExist($hostId)
    {
        $result = $this->db->select('count(user_id) as user_count')
                ->from('users')
                ->where('user_id', $hostId)
                ->get()
                ->result();

        return (isset($result[0]) && $result[0]->user_count) ? $result[0]->user_count : null;
    }

    public function isPropertyExist($propertyId)
    {
        $result = $this->db->select('count(property_id) as property_count')
                ->from('properties')
                ->where('property_id', $propertyId)
                //->where('status', 1)
                ->get()
                ->result();

        return (isset($result[0]) && $result[0]->property_count) ? $result[0]->property_count : null;
    }

    public function fetchCountries()
    {
        $result = $this->db->select('*')
                ->from('master_country')
                ->where('status', 1)
                ->get()
                ->result();
        
        return $result;
    }

    public function fetchStatesByCountryId($countryId)
    {
        $result = $this->db->select('id, state_name')
                ->from('master_state')
                ->where('country_id', $countryId)
                ->get()
                ->result();

        return $result;
    }

    public function fetchCitiesByStateId($stateId)
    {
        $result = $this->db->select('id, city_name')
                ->from('master_city')
                ->where('state_id', $stateId)
                ->get()
                ->result();

        return $result;
    }

    public function fetchLanguages()
    {
        $result = $this->db->select('id, language')
                ->from('master_language')
                ->get()
                ->result();

        return $result;
    }

    public function fetchEmailRelatedData($emailType, $id)
    {
        if ('primary' === $emailType) {
            $query = "
                select
                concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_name`,
                `u`.`email`
                from
                `users` as `u`
                where
                `u`.`user_id` = $id
            ";
        } else {
            $query = "
                select
                concat(`u`.`first_name`, ' ', `u`.`last_name`) as `user_name`,
                `ue`.`email`
                from
                `users` as `u`
                inner join
                `users_email` as `ue`
                on
                `ue`.`user_id` = `u`.`user_id`
                where
                `ue`.`id` = $id
            ";
        }
        $result = $this->db->query($query)->result();

        return (isset($result[0]) && $result[0]) ? $result[0] : array();
    }
}