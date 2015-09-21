<?php defined('BASEPATH') OR exit('No direct script access allowed');
/***
 * Controller 
 **/
class Home extends MX_Controller
{
	private $viewData;

	private $fbUser;

	function __construct()
	{
		parent::__construct();
		$this->load->library('googleplus');
		$this->load->library('facebook_lib', array(
            'appId' => '1612651935651661',
            'secret' => '30170ca7c0ba0e396d6e32bb0c9ea66e',
            'permissions' => array('public_profile', 'email'),
        ));
		$this->load->model('home_model');
		$this->load->model('admin/admin_model');
		$this->viewData['fbLogoutUrl'] = $this->facebook_lib->getLogoutUrl(array('next' =>site_url('home/logout/facebook'), 'access_token' => $this->facebook_lib->getAccessToken()));
	}
   
	/***
	 * Function to load home page
	 */
	public function index()
	{
		$type = 'home';
		$data['slider_images'] = $this->home_model->getSliderimages($type);
		$data['hot_offer'] = $this->home_model->getHotOffers();
		$data['recommend_property'] = $this->home_model->getRnrrecommendProperty();
		$data['people_stories'] = $this->home_model->getPeoplestories();
		$data['upcoming_festival'] = $this->home_model->getUpcomingfestival();
		$data['trending_destination'] = $this->home_model->getTrendingDestination();

		if ($this->input->get('code')) {
        	try {
        		$this->fbUser = $this->facebook_lib->getUser();
        	} catch (Exception $ex) {
        		echo $ex->getMessage();

        		exit();
        	}
            
        }
        
        if ($this->fbUser) {
            $this->registerWithFacebook();
        }
        
        $data['gpAuthUrl'] = $this->googleplus->getAuthenticationUrl();
        $data['fbLoginUrl'] = $this->facebook_lib->getLoginUrl(array('scope' => array('publish_actions', 'email')));
        $data['fbLogoutUrl'] = $this->viewData['fbLogoutUrl'];

		$this->load->view('home',$data);
	}

	public function registerWithFacebook()
    {
        $userData = $this->facebook_lib->api('/me?fields=email,name,first_name,last_name,picture');
        
        $id = null;

        if (! $userDbData = $this->home_model->getUserDataFromDb($userData['email'])) {
            $id = $this->home_model->saveUser(array(
                'email' => $userData['email'],
                'is_email_verified' => 1,
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'profile_pic' => $userData['picture']['data']['url'],
                'status' => 1,
                'created_on' => date('Y-m-d H:i:s', time()),
            ));

            $this->home_model->addHostSocialMedia(array(
            	'user_id' => $id,
            	'social_media' => 'facebook',
        	));
        }

        $this->session->set_userdata('user', array(
            'user_id' => ($id) ? $id : $userDbData['user_id'],
            'email' => ($id) ? $userData['email'] : $userDbData['email'],
            'first_name' => ($id) ? $userData['first_name'] : $userDbData['first_name'],
            'last_name' => ($id) ? $userData['last_name'] : $userDbData['last_name'],
            'profile_pic' => ($id) ? $userData['picture']['data']['url'] : $userDbData['profile_pic'],
            'status' => ($userDbData) ? $userDbData['status']: 'Active',
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
            
            if (! $userDbData = $this->home_model->getUserDataFromDb($userData->email)) {
               	$id = $this->home_model->saveUser(array(
                    'email' => $userData->email,
                    'is_email_verified' => 1,
                    'first_name' => $userData->givenName,
                    'last_name' => $userData->familyName,
                    'profile_pic' => $userData->picture,
                    'status' => 1,
                    'created_on' => date('Y-m-d H:i:s', time()),
                ));

                $this->home_model->addHostSocialMedia(array(
	            	'user_id' => $id,
	            	'social_media' => 'google+',
	        	));
            }        

            $this->session->set_userdata('user', array(
                'user_id' => ($id) ? $id : $userDbData['user_id'],
                'email' => ($id) ? $userData->email : $userDbData['email'],
                'first_name' => ($id) ? $userData->givenName : $userDbData['first_name'],
                'last_name' => ($id) ? $userData->familyName : $userDbData['last_name'],
                'profile_pic' => ($id) ? $userData->picture : $userDbData['profile_pic'],
                'status' => ($userDbData) ? $userDbData['status']: 'Active',
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
        
        redirect(site_url('home/index'));
    }

	/**
	* Function to save user number for sending app link
	*/
	function doAppsmobilenostore()
	{
		$mobile_number =  $this->input->post('mobile_number');
		$this->home_model->saveNumber($mobile_number);
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

		$rec = $this->home_model->checkLogin($email,$password);

		if (! $rec) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'Login authentication failed',
			));
			exit();
		}

		$this->session->set_userdata('user', array(
            'user_id' => $rec->user_id,
            'email' => $rec->email,
            'first_name' => $rec->first_name,
            'last_name' => $rec->last_name,
            'profile_pic' => $rec->profile_pic,
            'status' => $rec->profile_status,
            'user_source' => 'ownsite',
        ));

        echo json_encode(array(
			'status' => '200',
		));
		exit();
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

		$this->home_model->chkDuplicateuser($email_id);

		if ($this->home_model->chkDuplicateuser($email_id)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'This email is already registered with us',
			));
			exit();
		}

		$ins_data['password'] = md5($password);

		if (! $userId = $this->home_model->insertTableData('users', $ins_data)) 
		{
			echo json_encode(array(
				'status' => '500',
				'message' => 'User registration failed',
			));
			exit();
		}

		// $this->session->set_userdata('user', array(
		    // 'user_id' => $userId,
		    // 'email' => $email_id,
		    // 'first_name' => $first_name,
		    // 'last_name' => $last_name,
		    // 'profile_pic' => '',
            // 'status' => 'Inactive',
		    // 'user_source' => 'ownsite',
		// ));
		 $activation_link = '<a href='.base_url('verify').'/'.$email_id.'>Click Here</a>';
		//Send the email to the user
		$email_temp = $this->home_model->fetchEmailTemplate('1');
		$email_template['subject'] = $email_temp->email_title;
			$email_template['message'] = $email_temp->email_body;				
		//Replace the variables from the message
						$user_name = $first_name.$last_name;
						$pattern = array('/{USERNAME}/','/{ACTIVATION LINK}/');
						$replacement = array($user_name,$activation_link);
						$email_template['message'] = preg_replace($pattern,$replacement,$email_template['message']);
						//$email_template['to'] = $email_id;
						$email_template['to'] = array( 'email' =>$email_id);
						send_email_notification($email_template); //From the email helper		 
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
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('login_view', $data, TRUE);
		echo $load_login_view;
	}
	function load_login_popup_tocreateprop()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('host/login_view', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_registration_popup()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_registration_view = $this->load->view('registration_view', $data, TRUE);
		echo $load_registration_view;
	}
	/**
	** Function to load hot offer page
	*/
	function hotOffer()
	{
		$this->load->view('hotoffer_view');
	}
	/**
	** Function to load Trending Destination page
	*/
	function trendingDestination()
	{
		
		$type = 'home';
		$data['slider_images'] = $this->home_model->getSliderimages($type);
		$data['hot_offer'] = $this->home_model->getHotOffers();
		$data['recommend_property'] = $this->home_model->getRnrrecommendProperty();
		$data['people_stories'] = $this->home_model->getPeoplestories();
		$data['upcoming_festival'] = $this->home_model->getUpcomingfestival();
		$data['trending_destination'] = $this->home_model->getTrendingDestination();

		if ($this->input->get('code')) {
        	try {
        		$this->fbUser = $this->facebook_lib->getUser();
        	} catch (Exception $ex) {
        		echo $ex->getMessage();

        		exit();
        	}
            
        }
        
        if ($this->fbUser) {
            $this->registerWithFacebook();
        }
        
        $data['gpAuthUrl'] = $this->googleplus->getAuthenticationUrl();
        $data['fbLoginUrl'] = $this->facebook_lib->getLoginUrl(array('scope' => array('publish_actions', 'email')));
        $data['fbLogoutUrl'] = $this->viewData['fbLogoutUrl'];

		/*$this->load->view('home',$data);*/
		$this->load->view('trending_destination_view',$data);
	}
	/**
	** Function to load Trending Destination page
	*/
	function rnrRecommend()
	{
		$this->load->view('rnr_recommended_view');
	}	
	/**
	* Function to load People Stories
	*/
	function peopleStories()
	{
		$this->load->view('people_stories_view');
	}
	/**
	* Function to load what Event and Happenings
	*/
	function eventHappenings()
	{
		$this->load->view('event_happening_view');
	}
	function view_verify($email_id)
	{
    $upd_data['profile_status']  = 'active';
		$whr_data['email'] = $email_id;
		$this->admin_model->updateTableData('users',$upd_data,$whr_data);
		echo "Your account is activated.Please Login.";
	}
	/***
  * Function to send the new password to the user
  **/
 function forgot_password()
 {
		$email_id = $this->input->post('email_id',TRUE);	
		$this->load->helper('string');
		$random_password = random_string('alnum',6);
		$rec1= $this->home_model->userExists($email_id);
		if(empty($rec1))
		{
			echo "Not found";
		}
		else
		{
			//-------- Update password in to database ----------//	
			$new_password= random_string('alnum',6);
			$upd_data['password']  =  md5($new_password);						
			$whr_data['email'] = $email_id;
			$this->admin_model->updateTableData('users',$upd_data,$whr_data);
			//Send the email to the user
			$email_temp = $this->home_model->fetchEmailTemplate('2');
			$email_template['subject'] = $email_temp->email_title;
			$email_template['message'] = $email_temp->email_body;		
				//Replace the variables from the message
				$first_name = $rec1->first_name;
				$last_name = $rec1->last_name;
				$user_name = $first_name.$last_name;
				$pattern = array('/{USERNAME}/','/{New Password}/');
				$replacement = array($user_name,$new_password);
				$email_template['message'] = preg_replace($pattern,$replacement,$email_template['message']);
				//$email_template['to'] = $email_id;
				$email_template['to'] = array( 'email' =>$email_id);
				send_email_notification($email_template); //From the email helper
				echo 'success';
		}		
	}
	function thankYou()
	{
		$this->load->view('thankyou_view.php');
	}
}
?>

