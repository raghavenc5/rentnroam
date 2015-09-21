<?php

class Host_Generic_Controller extends MX_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_notification/transaction_notification_model');
		$sess_data = $this->session->userdata('user');
		$trans_notify = $this->transaction_notification_model->getNotificationByUserId($sess_data['user_id']);
        $this->viewData = array('trans_notify'=>$trans_notify);
    }
    
    protected function debug($data, $exit = true)
    {
        if (! $data) {
            echo 'No data was passed for debugging';
        } else {
            echo '<pre>';
            var_dump($data);
            echo '</pre>';
        }
        
        if ($exit) {
            exit();
        }
    }
    
    protected function prepareDataForView($data)
    {
        $this->viewData = array_merge($this->viewData, $data);
    }
    
    protected function jsonResponse($data)
    {
        echo json_encode($data);
        
        exit();
    }

    protected function setPaginationConfigs($url, $totalRows, $recordPerPage, $uriSegment) {
        $config = array();

        $config['base_url'] = site_url($url);
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $recordPerPage;
        $config['uri_segment'] = $uriSegment;

        $config['full_tag_open'] = '<ul class="pagination" style="margin-top:0px;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo&laquo';
        $config['last_link'] = '&raquo&raquo';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        return $config;
    }

    protected function persistSearchData($identifier, $searchData)
    {
        $this->session->set_userdata($identifier, $searchData); 
    }

    public function isAuthenticated()
    {
        if ($this->session->userdata('user')) {
            /**
             * user is in session
             * mark him as authenticated
             */
            return true;
        }
        
        return false;
    }
}