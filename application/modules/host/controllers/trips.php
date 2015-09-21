<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Trips
* extends class Host_Generic_Controller
* encapsulates all the properties
* and methods defining a host's trips
*/

class Trips extends Host_Generic_Controller
{
	public function __construct()
	{
		parent::__construct();

		// load models
		$this->load->model(array(
			'trip_model',
            'profile_model',
		));

		// load libraries
		$this->load->library(array(
            'pagination',
            'googleplus',
        ));

        $this->load->library('facebook_lib', array(
            'appId' => '1612651935651661',
            'secret' => '30170ca7c0ba0e396d6e32bb0c9ea66e',
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
	* method to render the trips page
    * that lists host's past trips on page load
	*/
	public function index($page = 0)
	{
        // check if user's logged in
    	if (! $this->isAuthenticated()) {
            ($this->input->is_ajax_request()) ? $this->jsonResponse(array('status' => '500', 'errorType' => 'auth_error', 'message' => 'User unauthenticated')) : redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

        // count past trips
        $pastTripCount = $this->trip_model->countPastTripsByHost($sessionUserData['user_id']);

        // count upcoming trips
        $upcomingTripCount = $this->trip_model->countUpcomingTripsByHost($sessionUserData['user_id']);

        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/trips/index", $pastTripCount, 1, 4);
        $this->pagination->initialize($paginationConfig);

        // fetch paginated data for host's past trips
        $pastTrips = $this->trip_model->fetchPastTripsByHost($sessionUserData['user_id'], $page, $paginationConfig['per_page']);

        // fetch the pagination links
        $pageLinks = $this->pagination->create_links();

        // fetch smileys
        $smileys = $this->trip_model->fetchSmileys();

        // construct view variables
        $data = array(
            'title' => 'My Trips',
            'userData' => $sessionUserData,
            'pastTripCount' => $pastTripCount,
            'upcomingTripCount' => $upcomingTripCount,
            'pastTrips' => $pastTrips,
            'pageLinks' => $pageLinks,
            'smileys' => $smileys,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        if ($this->input->is_ajax_request()) {
            // load ajax view
            $this->load->view('trips/async_pages/past_trips', $this->viewData);
        } else {
            $this->load->view('trips/index', array(
                'header' => $this->load->view('page_elements/header', $this->viewData, true),
                'footer' => $this->load->view('page_elements/footer', null, true),
            ));
        }
	}

    public function upcomingTrips($page = 0)
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            ($this->input->is_ajax_request()) ? $this->jsonResponse(array('status' => '500', 'errorType' => 'auth_error', 'message' => 'User unauthenticated')) : redirect(site_url('home/index'));
        }

        // get user data from session
        $sessionUserData = $this->session->userdata('user');

        // count upcoming trips
        $upcomingTripCount = $this->trip_model->countUpcomingTripsByHost($sessionUserData['user_id']);

        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/trips/upcomingTrips", $upcomingTripCount, 1, 4);
        $this->pagination->initialize($paginationConfig);

        // fetch paginated data for host's upcoming trips
        $upcomingTrips = $this->trip_model->fetchUpcomingTripsByHost($sessionUserData['user_id'], $page, $paginationConfig['per_page']);

        // fetch the pagination links
        $pageLinks = $this->pagination->create_links();

        // construct view variables
        $data = array(
            'title' => 'My Trips',
            'userData' => $sessionUserData,
            'upcomingTrips' => $upcomingTrips,
            'pageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load async view
        $this->load->view('trips/async_pages/upcoming_trips', $this->viewData);
    }

    public function viewReviews($propertyId, $page = 0)
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            $this->jsonResponse(array('status' => '500', 'errorType' => 'auth_error', 'message' => 'User unauthenticated'));
        }

        // count property reviews
        $propertyReviewCount = $this->trip_model->countReviewsByProperty($propertyId);

        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/trips/viewReviews/$propertyId", $propertyReviewCount, 1, 5);
        $this->pagination->initialize($paginationConfig);

        // fetch paginated data for reviews on a property
        $propertyReviews = $this->trip_model->fetchReviewsByProperty($propertyId, $page, $paginationConfig['per_page']);

        // fetch the pagination links
        $pageLinks = $this->pagination->create_links();

        // construct view variables
        $data = array(
            'propertyReviews' => $propertyReviews,
            'pageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load async view
        $this->load->view('trips/async_pages/view_reviews', $this->viewData);
    }

    public function messages($propertyId, $page = 0)
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            $this->jsonResponse(array('status' => '500', 'errorType' => 'auth_error', 'message' => 'User unauthenticated'));
        }

        // count property reviews
        $messagesCount = $this->trip_model->countMessagesByProperty($propertyId);

        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/trips/messages/$propertyId", $messagesCount, 1, 5);
        $this->pagination->initialize($paginationConfig);

        // fetch paginated data for reviews on a property
        $messages = $this->trip_model->fetchMessgaesByProperty($propertyId, $page, $paginationConfig['per_page']);

        // fetch the pagination links
        $pageLinks = $this->pagination->create_links();

        // construct view variables
        $data = array(
            'messages' => $messages,
            'pageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load async view
        $this->load->view('trips/async_pages/messages_history', $this->viewData);
    }
}

/**
* end of file Trips.php
*/
