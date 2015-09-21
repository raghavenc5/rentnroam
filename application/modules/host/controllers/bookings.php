<?php
if (! defined('BASEPATH')) {
    exit('Direct script access is not allowed');
}

/**
 * class Bookings
 * extends class Host_Generic_Controller
 * encapsulates all the properties
 * and methods
 * for host bookings
 */

class Bookings extends Host_Generic_Controller
{
    public function __construct()
	{
		parent::__construct();

		// load models
		$this->load->model(array(
			'booking_model',
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
     * method to render the main page
     */
    public function index()
    {
        // check if user's logged in
    	if (! $this->isAuthenticated()) {
            redirect(site_url('home/index'));
    	}
        
        // get user data from session
    	$sessionUserData = $this->session->userdata('user');
        
        // fetch host properties data
        $propertiesData = $this->booking_model->fetchPropertyData($sessionUserData['user_id']);
        
        $propertyId = isset($propertiesData[0]) ? (($propertiesData[0]->child_properties) ? ((false !== strpos($propertiesData[0]->child_properties, ',')) ? explode(',', $propertiesData[0]->child_properties)[0] : $propertiesData[0]->child_properties) : $propertiesData[0]->property_id) : null;
        
        // construct view variables
        $data = array(
            'title' => 'My Bookings',
            'userData' => $sessionUserData,
            'propertyId' => $propertyId,
            'propertiesData' => $propertiesData,
        );
        
        // fetch widget data
        $widgetData = $this->fetchWidgetData($propertyId);
        
        // merge data
        $data = array_merge($data, $widgetData);
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load the respective view
        $this->load->view('bookings/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }
    
    /**
     * method to render the main page
     * 
     * invoked by ajax call
     * 
     * @param int $propertyId
     */
    public function indexAsync($propertyId)
    {        
        // get user data from session
    	$sessionUserData = $this->session->userdata('user');

        // construct view variables
        $data = array(
            'userData' => $sessionUserData,
            'propertyId' => $propertyId,
        );
        
        // fetch widget data
        $widgetData = $this->fetchWidgetData($propertyId);
        
        // merge data
        $data = array_merge($data, $widgetData);
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/index', $this->viewData);
    }
    
    /**
     * fetch widget data
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    private function fetchWidgetData($propertyId) {
        // fetch widget data
        $propertyListingCompletionData = ($propertyId) ? $this->fetchPropertyListingCompletionData($propertyId) : array();
        $viewedMessagesData = ($propertyId) ? $this->fetchViewedMessages($propertyId) : array();
        $pendingMessagesData = ($propertyId) ? $this->fetchPendingMessages($propertyId) : array();
        $reviewsData = ($propertyId) ? $this->fetchReviews($propertyId) : array();
        $topRatingAndViewCount = ($propertyId) ? $this->fetchTopRatingAndViewCount($propertyId) : array();
        $upcomingAnPastBookingCount = ($propertyId) ? $this->fetchUpcomingAndPastBookingCount($propertyId) : array();
        
        // merge widget data
        $widgetData = array_merge($propertyListingCompletionData, $viewedMessagesData, $pendingMessagesData, $reviewsData, $topRatingAndViewCount, $upcomingAnPastBookingCount);
        
        return $widgetData;
    }
    
    /**
     * fetch messages on property basis
     * that have already been viewed by the host
     * 
     * invoked by another method
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchViewedMessages($propertyId, $limit = 2, $page = 0)
    {
        // count viewed messages
        $viewedMessagesCount = $this->booking_model->countViewedMessages($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchViewedMessagesAsync/$propertyId/$limit", $viewedMessagesCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for host's viewed messages
        $viewedMessages = $this->booking_model->fetchViewedMessages($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'viewedMessagesCount' => $viewedMessagesCount,
            'viewedMessages' => $viewedMessages,
            'viewMessagesPageLinks' => $pageLinks,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch messages on property basis
     * that have already been viewed by the host
     * 
     * invoked by an ajax call
     * 
     * @param int $propertyId
     * @param int $page
     */
    public function fetchViewedMessagesAsync($propertyId, $limit = 2, $page = 0)
    {
        // count viewed messages
        $viewedMessagesCount = $this->booking_model->countViewedMessages($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchViewedMessagesAsync/$propertyId/$limit", $viewedMessagesCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for host's viewed messages
        $viewedMessages = $this->booking_model->fetchViewedMessages($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'viewedMessagesCount' => $viewedMessagesCount,
            'viewedMessages' => $viewedMessages,
            'viewMessagesPageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/viewed_messages', $this->viewData);
    }
    
    /**
     * fetch messages on property basis
     * that are pending to be viewed by the host
     * 
     * invoked by another method
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchPendingMessages($propertyId, $limit = 2, $page = 0)
    {
        // count pending messages
        $pendingMessagesCount = $this->booking_model->countPendingMessages($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchPendingMessagesAsync/$propertyId/$limit", $pendingMessagesCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for host's viewed messages
        $pendingMessages = $this->booking_model->fetchPendingMessages($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'pendingMessagesCount' => $pendingMessagesCount,
            'pendingMessages' => $pendingMessages,
            'pendingMessagesPageLinks' => $pageLinks,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch messages on property basis
     * that are pending to be viewed by the host
     * 
     * invoked by an ajax call
     * 
     * @param int $propertyId
     * @param int $page
     */
    public function fetchPendingMessagesAsync($propertyId, $limit = 2, $page = 0)
    {
        // count pending messages
        $pendingMessagesCount = $this->booking_model->countPendingMessages($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchPendingMessagesAsync/$propertyId/$limit", $pendingMessagesCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for host's viewed messages
        $pendingMessages = $this->booking_model->fetchPendingMessages($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'pendingMessagesCount' => $pendingMessagesCount,
            'pendingMessages' => $pendingMessages,
            'pendingMessagesPageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/pending_messages', $this->viewData);
    }
    
    /**
     * fetch reviews by property
     * invoked by another method
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchReviews($propertyId)
    {
        // fetch reviews submitted for this property
        $reviews = $this->booking_model->fetchReviews($propertyId);
        
        // construct view variables
        $data = array(
            'reviews' => $reviews,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch user's top rating and views by property
     * invoked by another method
     * 
     * @param int $propertyId
     * 
     * @return array
     */
    public function fetchTopRatingAndViewCount($propertyId)
    {
        // fetch reviews submitted for this property
        $topRatingAndViews = $this->booking_model->fetchTopRatingAndViewCount($propertyId);
        
        // construct view variables
        $data = array(
            'topRatingAndViews' => $topRatingAndViews,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch upcoming and past bookings by property
     * invoked by another method
     * 
     * @param type $propertyId
     * 
     * @return type
     */
    public function fetchUpcomingAndPastBookingCount($propertyId)
    {
        // fetch upcoming and past bookings for this property
        $upcomingAnPastBookingCount = $this->booking_model->fetchUpcomingAndPastBookingCount($propertyId);
        
        // construct view variables
        $data = array(
            'upcomingAnPastBookingCount' => $upcomingAnPastBookingCount,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch calendar data by property
     * invoked by an AJAX call
     * 
     * @param type $propertyId
     * 
     * @return type
     */
    public function fetchCalendarData($propertyId, $selectedDate)
    {
        // fetch calendar data for this property
        $calendarData = $this->booking_model->fetchCalendarData($propertyId, $selectedDate);
        
        $this->jsonResponse(array('event' => $calendarData));
    }
    
    /**
     * fetch listing completion data by property
     * invoked by another method
     * 
     * @param type $propertyId
     * 
     * @return type
     */
    public function fetchPropertyListingCompletionData($propertyId)
    {
        // fetch listing completion data for this property
        $propertyListingCompletionData = $this->booking_model->fetchPropertyListingCompletionData($propertyId);
        
        // construct view variables
        $data = array(
            'propertyListingCompletionData' => $propertyListingCompletionData,
        );
        
        // return data to the caller method
        return $data;
    }
    
    /**
     * fetch upcoming bookings by property
     * 
     * @param int $propertyId
     * @param int $limit
     * @param int $page
     */
    public function fetchUpcomingBookingsAsync($propertyId, $limit = 2, $page = 0)
    {
        // count upcoming bookings
        $upcomingBookingsCount = $this->booking_model->countUpcomingBookings($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchUpcomingBookingsAsync/$propertyId/$limit", $upcomingBookingsCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for upcoming bookings
        $upcomingBookings = $this->booking_model->fetchUpcomingBookings($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'upcomingBookingsCount' => $upcomingBookingsCount,
            'upcomingBookings' => $upcomingBookings,
            'upcomingBookingPageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/upcoming_bookings', $this->viewData);
    }
    
    /**
     * fetch past bookings by property
     * 
     * @param int $propertyId
     * @param int $limit
     * @param int $page
     */
    public function fetchPastBookingsAsync($propertyId, $limit = 2, $page = 0)
    {
        // count past bookings
        $pastBookingsCount = $this->booking_model->countPastBookings($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchPastBookingsAsync/$propertyId/$limit", $pastBookingsCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for past bookings
        $pastBookings = $this->booking_model->fetchpastBookings($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'pastBookingsCount' => $pastBookingsCount,
            'pastBookings' => $pastBookings,
            'pastBookingPageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/past_bookings', $this->viewData);
    }
    
    /**
     * fetch reviews by property
     * 
     * @param int $propertyId
     * @param int $limit
     * @param int $page
     */
    public function fetchReviewsAsync($propertyId, $limit = 2, $page = 0)
    {
        // count reviews
        $reviewsCount = $this->booking_model->countReviews($propertyId);
        
        // set pagination configuration
        $paginationConfig = $this->setPaginationConfigs("/host/bookings/fetchReviewsAsync/$propertyId/$limit", $reviewsCount, $limit, 6);
        $this->pagination->initialize($paginationConfig);
        
        // fetch paginated data for past bookings
        $reviews = $this->booking_model->fetchReviews($propertyId, $page, $paginationConfig['per_page']);
        
        // create pagination links
        $pageLinks = $this->pagination->create_links();
        
        // construct view variables
        $data = array(
            'reviewsCount' => $reviewsCount,
            'reviews' => $reviews,
            'reviewPageLinks' => $pageLinks,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // load async view
        $this->load->view('bookings/async_pages/reviews', $this->viewData);
    }
}

/**
 * end of file bookings.php
 */