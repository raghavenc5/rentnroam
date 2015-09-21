<?php defined('BASEPATH') OR exit('No direct script access allowed');
/***
 * Controller 
 **/
class Search extends MX_Controller
{
	private $viewData;
	private $fbUser;
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
		$this->load->model('home/home_model');
		$this->load->library('googleplus');		
		 $this->load->library('facebook_lib', array(
            'appId' => '836829476401717',
            'secret' => '33ba98812df563197075a921cc27decd',
            'permissions' => array('public_profile', 'email'),
        ));
		//$this->load->model('overview_model');
		$this->viewData['fbLogoutUrl'] = $this->facebook_lib->getLogoutUrl(array('next' => site_url('home/logout/facebook')));
	
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
	
   
	public function index()
	{
		$this->load->view('filter');
	}

	/*
	* Function to search property according to filter(For WebApp)
	*/
	function searchresult()
	{
		if ($this->input->get('code')) {
        	try {
        		$this->fbUser = $this->facebook_lib->getUser();
        	} catch (Exception $ex) {
        		echo $ex>getMessage();

        		exit();
        	}
            
        }
        
        if ($this->fbUser) {
            $this->registerWithFacebook();
        }
        
        $data['gpAuthUrl'] = $this->googleplus->getAuthenticationUrl();
        $data['fbLoginUrl'] = $this->facebook_lib->getLoginUrl(array('scope' => array('publish_actions', 'email')));
        $data['fbLogoutUrl'] = $this->viewData['fbLogoutUrl'];



		 $option = $this->input->post('option',TRUE);
		 $type= 'search';
		 $offset = $this->input->post('offset',TRUE);
		 if(empty($offset))
		  {
				$offset = 0;
		  }	
		 $per_page = 10;
		 $sort_by = $this->input->post('sort_by',TRUE);
	   	 $data['city'] = $city1 = $this->input->post('autocomplete_city',TRUE);
		 $myArray = explode(',', $city1);
		 $city_name = $myArray[0];
		 if($city_name == "")
		 {
			 $city_name = $this->session->userdata('city');
		 }
		 $check_in_time = $this->input->post('check_in');
		 $check_out_time = $this->input->post('check_out');
		 $guest1 = $this->input->post('guest');
		  $myArray = explode(" ", $guest1);
		  $guest = $myArray[0];
		 $room_type = $this->input->post('room_type',TRUE);
		 
		 if(!empty($room_type))
		 {
			 $room_type = implode(", ", $room_type);
		 }
		 $property_type = $this->input->post('property_type',TRUE);
		 if(!empty($property_type))
		 {
			 $property_type = implode(", ", $property_type);
		 }
		 $amenities = $this->input->post('amenities',TRUE);
		 if(!empty($amenities))
		 {
			 $amenities = implode(", ", $amenities);
		 }
		 $language = $this->input->post('language',TRUE);
		 if(!empty($language))
		 {
			 $language = implode(", ", $language);
		 }
		 $tags = $this->input->post('tag',TRUE);
		 if(!empty($tags))
		 {
			 $tags = implode(", ", $tags);
		 }
		 $policy = $this->input->post('policy',TRUE);
		 $bed = $this->input->post('bed');
		 $bathroom = $this->input->post('bathroom');
		 $bedroom = $this->input->post('bedroom');
		 $min_package = $this->input->post('min_package');
		 $max_package = $this->input->post('max_package');
		 $property_list = $data['property'] = $this->search_model->getProperty($offset,$per_page,$sort_by,$city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time);
		 //$total_records = $data['total_num_records']  = $this->search_model->countRows();
		 $records = $this->search_model->total_no_rec($city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time);
		 $total_records = $data['total_num_records']  = $this->search_model->countRows();
		 $filter_data = array(
								'city'  => $city_name,
								'check_in_time' => $check_in_time,
								'check_out_time' => $check_out_time,
								'guest' =>$guest,
								'room_type' =>$room_type,
								'bed' =>$bed,
								'bathroom' =>$bathroom,
								'bedroom' =>$bedroom,
								'min_package' =>$min_package,
								'max_package' =>$max_package,
								'offset' =>$offset,
								'total_records' =>$total_records
						);		
		 $this->session->set_userdata($filter_data);
		 $data['room_type'] = $this->search_model->getRoomtype();
		 $data['property_type'] = $this->search_model->getPropertytype();
		 $data['amenities1'] = $data['amenities'] = $this->search_model->getAmenities();
		 $data['language'] = $this->search_model->getHostlanguage();
		 $data['slider_images'] = $this->home_model->getSliderimages($type);
		 $data['cancellation_policy'] = $this->search_model->getCancellationpolicy();
		 $data['tags'] = $this->search_model->getTag();
		 if($offset == 0 && $option == '')
		 {
				$this->load->view('filter',$data);
		 }
		 else
		 {
			 echo $this->load->view('filter_data',$data);
		 }
	}
	function refreshRecord()
	{
		$data['total_num_records'] = $this->session->userdata('total_records');;
		$data['city'] = $this->session->userdata('city');
		echo $this->load->view('record_data',$data);
	}
	function searchresultpopular()
	{
		 $data['city'] = $city1 = $this->input->post('autocomplete_city',TRUE);
		 $myArray = explode(',', $city1);
		 $city_name = $myArray[0];
		 $smiley_id = $this->input->post('smiley_id');
		 $property_list = $data['property'] = $this->search_model->getPopularproperty($city_name,$smiley_id);
		 $data['total_num_records']  = $this->search_model->countRows();
		 echo $this->load->view('filter_data',$data);
	}
	function searchresulttags()
	{
		 $data['city'] = $city1 = $this->input->post('autocomplete_city',TRUE);
		 $myArray = explode(',', $city1);
		 $city_name = $myArray[0];
		 $tag_id = $this->input->post('tag_id');
		 $property_list = $data['property'] = $this->search_model->getTagproperty($city_name,$tag_id);
		 $data['total_num_records']  = $this->search_model->countRows();
		 echo $this->load->view('filter_data',$data);
	}



	/*-------------LOGIN REGISTER ------------------*/	
	
	public function registerWithFacebook()
    {
        $userData = $this->facebook_lib->api('/me?fields=email,name,first_name,last_name,picture');
        
        $id = null;

        if (! $userDbData = $this->search_model->getUserDataFromDb($userData['email'])) {
            $id = $this->search_model->saveUser(array(
                'email' => $userData['email'],
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'profile_pic' => $userData['picture']['data']['url'],
                'status' => 1,
            ));
        }
        
        $this->session->set_userdata('user', array(
            'user_id' => ($id) ? $id : $userDbData['user_id'],
            'email' => ($id) ? $userData['email'] : $userDbData['email'],
            'first_name' => ($id) ? $userData['first_name'] : $userDbData['first_name'],
            'last_name' => ($id) ? $userData['last_name'] : $userDbData['last_name'],
            'profile_pic' => ($id) ? $userData['picture']['data']['url'] : $userDbData['profile_pic'],
            'user_source' => 'facebook',
        ));
        
        $currentUrl = $this->session->userdata('referer');
        redirect($currentUrl);
    }

    public function registerWithGPlus()
    {
        if ($this->input->get('code')) {
            $this->googleplus->authenticateAccess($this->input->get('code'));
        }
        
        $gPlusAccessToken = $this->session->userdata('gplus_access_token');
        
        if (isset($gPlusAccessToken)) {
            $this->googleplus->setAccessToken($gPlusAccessToken);
        }
        
        $id = null;

        if ($this->googleplus->getAccessToken()) {
            $userData = $this->googleplus->getAuthenticatedUserInfo();
            
            if (! $userDbData = $this->search_model->getUserDataFromDb($userData->email)) {
               	$id = $this->search_model->saveUser(array(
                    'email' => $userData->email,
                    'first_name' => $userData->givenName,
                    'last_name' => $userData->familyName,
                    'profile_pic' => $userData->picture,
                    'status' => 1,
                ));
            }        

            $this->session->set_userdata('user', array(
                'user_id' => ($id) ? $id : $userDbData['user_id'],
                'email' => ($id) ? $userData->email : $userDbData['email'],
                'first_name' => ($id) ? $userData->givenName : $userDbData['first_name'],
                'last_name' => ($id) ? $userData->familyName : $userDbData['last_name'],
                'profile_pic' => ($id) ? $userData->picture : $userDbData['profile_pic'],
                'user_source' => 'googleplus',
            ));
        }
        
        $currentUrl = $this->session->userdata('referer');
        redirect($currentUrl);
    }

    public function logout($mode = null)
    {
        if ('googleplus' == $mode) {
            $this->session->unset_userdata('gplus_access_token');
        }
        
        $this->session->unset_userdata('user');
        
        if ('facebook' == $mode) {
            $this->session->sess_destroy();
        }
        
        redirect(site_url('search/searchresult'));
    }

	/**
	* Function to save user number for sending app link
	*/
	function doAppsmobilenostore()
	{
		$mobile_number =  $this->input->post('mobile_number');
		$this->search_model->saveNumber($mobile_number);
	}

	/**
	* Function for login
	*/
	function doLogin()
	{
		$email = $this->input->post('email_id') ? trim($this->input->post('email_id', true)) : '';
		$password = $this->input->post('password') ?  trim($this->input->post('password', true)) : '';

		if (! $email) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Email ID is required',
			));
			exit();
		}

		if (! $password) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Password is required',
			));
			exit();
		}

		$rec = $this->search_model->checkLogin($email,$password);

		if (! $rec) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Login authentication failed',
			));
			exit();
		}
		else{

			$this->session->set_userdata('user', array(
            'user_id' => $rec->user_id,
            'email' => $rec->email,
            'first_name' => $rec->first_name,
            'last_name' => $rec->last_name,
            'profile_pic' => $rec->profile_pic,
            'user_source' => 'ownsite'
        ));

        echo json_encode(array(
			'status' => '200',
		));
		exit();

		}

		
	}

	/****
	* Function to get the signup user
	**/
	function signupUser()
	{
		$first_name = $ins_data['first_name'] = $this->input->post('first_name') ? trim($this->input->post('first_name',TRUE)) : '';
		$last_name = $ins_data['last_name'] = $this->input->post('last_name') ? trim($this->input->post('last_name',TRUE)) : '';
		$email_id = $ins_data['email'] = $this->input->post('reg_email_id') ? trim($this->input->post('reg_email_id',TRUE)) : '';
		$password = $ins_data['password'] = $this->input->post('password') ? trim($this->input->post('password',TRUE)) : '';
		$phone_number = $ins_data['user_emergency_contact_no'] = $this->input->post('phone_number') ? trim($this->input->post('phone_number',TRUE)) : '';

		$this->search_model->chkDuplicateuser($email_id);

		if ($this->search_model->chkDuplicateuser($email_id)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'This email is already registered with us',
			));
			exit();
		}

		$ins_data['password'] = md5($password);

		if (! $userId = $this->search_model->insertTableData('users', $ins_data)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'User registration failed',
			));
			exit();
		}

		$this->session->set_userdata('user', array(
		    'user_id' => $userId,
		    'email' => $email_id,
		    'first_name' => $first_name,
		    'last_name' => $last_name,
		    'profile_pic' => '',
		    'user_source' => 'ownsite',
		));

		echo json_encode(array(
			'status' => '200',
		));
		exit();
	}//end of the function
 
	/**
	* Function to save User currency in session 
	*/
	function doCurrencysave()
	{
		$currency = $this->input->post('currency',TRUE);
		$this->session->set_userdata('currency', $currency);
	}
	
	function load_login_popup()
	{

		if ($this->input->get('code')) {
        	try {
        		$this->fbUser = $this->facebook_lib->getUser();
        	} catch (Exception $ex) {
        		echo $ex>getMessage();

        		exit();
        	}
            
        }
        
        if ($this->fbUser) {
            $this->registerWithFacebook();
        }
        
        $data['gpAuthUrl'] = $this->googleplus->getAuthenticationUrl();
        $data['fbLoginUrl'] = $this->facebook_lib->getLoginUrl(array('scope' => array('publish_actions', 'email')));
        
        $data['fbLogoutUrl'] = $this->viewData['fbLogoutUrl'];
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('login_view', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_registration_popup()
	{
		if ($this->input->get('code')) {
        	try {
        		$this->fbUser = $this->facebook_lib->getUser();
        	} catch (Exception $ex) {
        		echo $ex>getMessage();

        		exit();
        	}
            
        }
        
        if ($this->fbUser) {
            $this->registerWithFacebook();
        }
        
        $data['gpAuthUrl'] = $this->googleplus->getAuthenticationUrl();
        $data['fbLoginUrl'] = $this->facebook_lib->getLoginUrl(array('scope' => array('publish_actions', 'email')));
        $data['fbLogoutUrl'] = $this->viewData['fbLogoutUrl'];
		//$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		//$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_registration_view = $this->load->view('registration_view', $data, TRUE);
		echo $load_registration_view;
	}

	/*---------------------END LOGIN REGISTER---------------*/
	

}
?>