<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Dashboard
* extends class Host_Generic_Controller
* encapsulates all the properties
* and methods defining a host dashboard
*/

class Dashboard extends Host_Generic_Controller
{
	public function __construct()
	{
		parent::__construct();

		// load models
		$this->load->model(array(
			'dashboard_model',
		));

		// load libraries
		$this->load->library(array(
            'pagination',
            'googleplus',
        ));

        $this->load->library('facebook_lib', array(
            'appId' => '1612651935651661',
            'secret' => '30170ca7c0ba0e396d6e32bb0c9ea66e',
            'permissions' => array('public_profile', 'email'),
        ));

        // load helpers
        $this->load->helper(array(
        	'url',
        	'io_format',
    	));

        // facebook logout url
    	$this->viewData['fbLogoutUrl'] = $this->facebook_lib->getLogoutUrl(array('next' =>site_url('home/logout/facebook'), 'access_token' => $this->facebook_lib->getAccessToken()));
	}

	/**
	* method to render the main dashboard page
	*/
	public function index()
	{
        // check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

        // fetch data for dashboard
        $dashboardData = $this->dashboard_model->fetchDashboardData($sessionUserData['user_id']);

        // fetch properties data
        $propertiesData = $this->dashboard_model->fetchPropertiesDataByHost($sessionUserData['user_id']);

        // fetch messages data
        $messagesData = $this->dashboard_model->fetchLatestMessagesDataByHost($sessionUserData['user_id']);

        //$this->debug($messagesData);

    	// construct view variables
    	$data = array(
    		'title' => 'Host Dashboard',
    		'userData' => $sessionUserData,
            'dashboardData' => $dashboardData,
            'propertiesData' => $propertiesData,
            'messagesData' => $messagesData,
		);
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('dashboard/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
	}
    
    public function fetchAllMessagesAsync($hostId, $page = 0)
    {
        // count messages
        $messagesCount = $this->dashboard_model->countAllMessagesByHost($hostId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/dashboard/fetchAllMessagesAsync/$hostId", $messagesCount, 1, 5);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for all messages
        $messages = $this->dashboard_model->fetchAllMessagesByHost($hostId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'messagesCount' => $messagesCount,
            'messages' => $messages,
            'messagePageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('dashboard/async_pages/all_messages', $this->viewData);        
    }
}

/**
* end of file dashboard.php
*/
