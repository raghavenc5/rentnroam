<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends MX_Controller{
	
	private $viewData;
	private $fbUser;

	function __construct()
	{	
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('overview_model');
		$this->load->model('search/search_model');
		$this->load->library('googleplus');
		  $this->load->library(array(
            'form_validation'
        ));
	
		
		 $this->load->library('facebook_lib', array(
            'appId' => '836829476401717',
            'secret' => '33ba98812df563197075a921cc27decd',
            'permissions' => array('public_profile', 'email'),
        ));
		//$this->load->model('overview_model');
		$this->load->helper('text');
		$this->load->helper('time_helper');

		
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
	

	public function index($property_id='-')
	{
			
		//$data['property_id'] = $property_id = $this->input->post('property_id',TRUE);
		$data['location'] = $res = $this->overview_model->extractDetails($property_id);
		$data['property_review'] = $this->overview_model->extractPropertyreviews($property_id);
		$data['property_video'] = $this->overview_model->extractPropertyvideo($property_id);
		$data['property_image'] = $this->overview_model->extractPropertyimage($property_id);
		$data['review_count'] = $this->overview_model->countReview($property_id);

		$data['response_time'] = $this->overview_model->getResponsetime($property_id);
		$data['response_count'] = $this->overview_model->getResponseCount($property_id);

		$uid = '';
		$userDataFromSession = $this->session->userdata('user');
		if(count($userDataFromSession) >= 2)
		{		
		$uid = $userDataFromSession['user_id'];	
		}			
		
		/*FILTER DATA */
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
		 $check_in_time = $this->input->post('check_in');
		 $check_out_time = $this->input->post('check_out');
		 $guest = $this->input->post('guest');
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
								'offset' =>$offset
						);
		
		 $this->session->set_userdata($filter_data);
		
		 $property_list = $data['property'] = $this->search_model->getProperty($offset,$per_page,$sort_by,$city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time);
		
		
		 $data['city'] = $city1 = $this->input->post('autocomplete_city',TRUE);
		 //$data['property'] = $this->search_model->getProperty($offset,$per_page,$sort_by,$city_name,$room_type,$property_type,$amenities,$language,$tags,$policy,$bed,$bathroom,$bedroom,$guest,$min_package,$max_package,$check_in_time,$check_out_time);
		 $data['total_num_records']  = $this->search_model->countRows();
		 $data['room_type'] = $this->search_model->getRoomtype();
		 $data['property_type'] = $this->search_model->getPropertytype();
		 $data['amenities1'] = $data['amenities'] = $this->search_model->getAmenities();
		 $data['language'] = $this->search_model->getHostlanguage();
		// $data['slider_images'] = $this->home_model->getSliderimages($type);
		 $data['cancellation_policy'] = $this->search_model->getCancellationpolicy();
		 $data['tags'] = $this->search_model->getTag();

		/*END FILTER DATA*/


		


		$checkbook = $this->overview_model->getbookstatus($uid, $property_id);
		$data['checkbook'] = $checkbook;

		$lastvisit = $this->overview_model->getlastVisited($uid, $property_id);
		$data['last_visit'] = $lastvisit;
		 
		$reviewCount = $this->overview_model->extractPropertyreviews($property_id);
		
		$smiley1 = 0;
		$smiley2 = 0;
		$smiley3 = 0;
		$smiley4 = 0;
		$smiley5 = 0;
		foreach($reviewCount as $count)
		{
			if($count->smiley_id == 1)
			{
				$smiley1++;
			}
			if($count->smiley_id == 2)
			{
				$smiley2++;
			}
			if($count->smiley_id == 3)
			{
				$smiley3++;
			}
			if($count->smiley_id == 4)
			{
				$smiley4++;
			}
			if($count->smiley_id == 5)
			{
				$smiley5++;
			}
		}
		$data['smiley1'] = $smiley1;
		$data['smiley2'] = $smiley2;
		$data['smiley3'] = $smiley3;
		$data['smiley4'] = $smiley4;
		$data['smiley5'] = $smiley5;	

		$sm1 = $smiley1*1;
		$sm2 = $smiley2*2;
		$sm3 = $smiley3*3;
		$sm4 = $smiley4*4;
		$sm5 = $smiley5*5;


		$total_review = $data['review_count'];
		if($total_review == 0)
		{
			$data['total'] = 0;
		}
		else
		{
			$data['total'] = ($sm1 + $sm2 + $sm3 + $sm4 + $sm5)/$total_review;
		}	
		

	
		

		if($total_review != 0)
		{
			$smiley1_percent = ($smiley1/$total_review)*100;		
			$smiley2_percent = ($smiley2/$total_review)*100;
			$smiley3_percent = ($smiley3/$total_review)*100;
			$smiley4_percent = ($smiley4/$total_review)*100;
			$smiley5_percent = ($smiley5/$total_review)*100;

			
			$data['smiley1_percent'] = $smiley1_percent;
			$data['smiley2_percent'] = $smiley2_percent;
			$data['smiley3_percent'] = $smiley3_percent;
			$data['smiley4_percent'] = $smiley4_percent;
			$data['smiley5_percent'] = $smiley5_percent;
		}
		else
		{
			$data['smiley1_percent'] = 0;
			$data['smiley2_percent'] = 0;
			$data['smiley3_percent'] = 0;
			$data['smiley4_percent'] = 0;
			$data['smiley5_percent'] = 0;
		}

		$wish_check = $this->overview_model->wish_check($uid, $property_id);		
		if($wish_check == true)
		{	
			$data['wish_check'] = true;
		}
		else
		{
			$data['wish_check'] = false;
		}
		
		


		//get user_id from property detials
	    $res = $this->overview_model->extractDetails($property_id);
		$userId='';
		foreach($res as $row)
		{				
			$userId = $row->user_id;
		}	
		//get user details for particular property
		$data['user_info'] = $this->overview_model->userdetails($userId);

		$total_msgs = $this->overview_model->getUsermsgs($userId);

		$total_msg_reply = $this->overview_model->getUserreply($userId);

		if($total_msgs == 0)
		{
			$data['response_rate_percent'] = 0;
		}
		else
		{
		  $data['response_rate_percent']  =($total_msg_reply/$total_msgs);
		}

		//get amenities of property
		$data['amenities_'] = '';
		$amenities = $this->overview_model->extractAmenit($property_id);			
			$ids = array();
			foreach($amenities as $r)
			{
				$ids[] = $r->amenities_id;	
			}
			if(empty($ids))
			{
				$results['amenities_'] = "null";
			}
			else
			{
			$data['amenities_'] = $this->overview_model->getAmenitDetails($ids);
			//$results['amenities'] = $amenitDetails; 			
			}

		//get seasonal price 	
		$data['seasonal_price'] = $this->getseasonPrice($property_id);
		
		
		
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
		
		echo $this->load->view('Propertyoverview',$data);
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
	
	

	public function propertyOverview()
	{
		$this->load->view('Propertyoverview');
	}

	
	function wishlist()
	{
		$udata['property_id'] = $this->input->post('prop_id');
		$udata['user_id'] = $this->input->post('user_id');
		$p_id = $udata['property_id'];
		$u_id = $udata['user_id'];
		//check id already in db
		$res = $this->overview_model->wish_check($u_id, $p_id);
		if($res == true)
		{
			//if true do nothing
			/*$del = $this->overview_model->delete_wish($u_id, $p_id);
			if($del)
			{*/
				$data= array();
				$data["status"] = 1;
				$data["message"] = "...";															
				echo json_encode($data);
			//}
		}
		else
		{
				
			//if false insert wishlist
			$add = $this->overview_model->insert_wish($udata);
			if($add)
			{
			$data= array();
			$data["status"] = 2;
			$data["message"] = "Inserted";															
			echo json_encode($data);
			}
		}
	}
	
	public function writeReview()
	{
		 $this->form_validation->set_rules('user_id', 'property id', 'required');
		 $this->form_validation->set_rules('property_id', 'property_id', 'required');
		 $this->form_validation->set_rules('rating', 'rating', 'required|numeric');
		 $this->form_validation->set_rules('review', 'review', 'required');
		//$this->form_validation->set_rules('uid', 'uid', 'required');
	    
		//response validation errors
		if($this->form_validation->run()==FALSE)    
		{			
			$arr = array(
				'status' => 400,
				'error' => true,
				'user_id' => strip_tags(form_error('user_id')),
				'property_id' => strip_tags(form_error('property_id')),
				'rating' => strip_tags(form_error('rating')),
				'review' => strip_tags(form_error('review'))
				//'uid' => strip_tags(form_error('uid')),
				);
				/*
				$offerArray = array();	
				
				foreach ($arr as $key => $value) {
					if($value != null)
					$offerArray[$key] = $value;					
				}*/	
			
				echo json_encode($arr);
				//$this->response($offerArray, 400);
		}
		
		//response after validation check
		else{									
							
							$udata['property_id'] = $this->input->post('property_id');
							$udata['user_id'] = $this->input->post('user_id');							
							$udata['review_message'] = $this->input->post('review');
							$udata['smiley_id'] = $this->input->post('rating');
																									
							$res = $this->overview_model->insert_review($udata);
							//var_dump($res);
							if($res){							
								$data= array();
								$data["status"] = 200;
								$data["error"]= false;
								$data["message"] = "Review Inserted";								
								//$this->response($data, 200);							
								echo json_encode($data);
							}									
			}
	}



		
	
	public function getseasonPrice($id)
	{
		    //get current month
			$currentMonth=DATE("m");
			$s1 = '';
			$results = array();
			//retrieve season 1 price
			IF ($currentMonth>="03" && $currentMonth<="05")
			{
			  
					//get season 1 daily price
					$price1 = '';
					$d1 = $this->overview_model->getPrices1($id, '1');
					foreach($d1 as $dd1)
					{
						$price1 = $dd1->price;
					}
					$results['season1daily'] = $price1;
					
					//get season 1 weekly price
					$price2 = '';
					$d2 = $this->overview_model->getPrices2($id, '1');
					foreach($d2 as $dd2)
					{
						$price2 = $dd2->price;
					}
					$results['season1weekly'] = $price2;
					
					//get season 1 monthly price
					$price3 = '';
					$d3 = $this->overview_model->getPrices3($id, '1');
					foreach($d3 as $dd3)
					{
						$price3 = $dd3->price;
					}
					$results['season1monthly'] = $price3;
					
					//get season 1 weekend price
					$price4 = '';
					$d4 = $this->overview_model->getPrices4($id, '1');
					foreach($d4 as $dd4)
					{
						$price4 = $dd4->price;
					}
					$results['season1weekend'] = $price4;
			
			}	//retrieve season 2 prices
			ELSEIF ($currentMonth>="06" && $currentMonth<="08")
			{  
							
						$price1 = '';
						$d1 = $this->overview_model->getPrices1($id, '2');
						foreach($d1 as $dd1)
						{
							$price1 = $dd1->price;
						}
						$results['season1daily'] = $price1;
						
						
						$price2 = '';
						$d2 = $this->overview_model->getPrices2($id, '2');
						foreach($d2 as $dd2)
						{
							$price2 = $dd2->price;
						}
						$results['season1weekly'] = $price2;
						
						
						$price3 = '';
						$d3 = $this->overview_model->getPrices3($id, '2');
						foreach($d3 as $dd3)
						{
							$price3 = $dd3->price;
						}
						$results['season1monthly'] = $price3;
						
						
						$price4 = '';
						$d4 = $this->overview_model->getPrices4($id, '2');
						foreach($d4 as $dd4)
						{
							$price4 = $dd4->price;
						}
						$results['season1weekend'] = $price4;		   
			}//retrieve season 3 prices
			ELSEIF ($currentMonth>="09" && $currentMonth<="11")
			{	
						$price1 = '';
						$d1 = $this->overview_model->getPrices1($id, '3');
						foreach($d1 as $dd1)
						{
							$price1 = $dd1->price;
						}
						$results['season1daily'] = $price1;
						
						$price2 = '';
						$d2 = $this->overview_model->getPrices2($id, '3');
						foreach($d2 as $dd2)
						{
							$price2 = $dd2->price;
						}
						$results['season1weekly'] = $price2;
						
						$price3 = '';
						$d3 = $this->overview_model->getPrices3($id, '3');
						foreach($d3 as $dd3)
						{
							$price3 = $dd3->price;
						}
						$results['season1monthly'] = $price3;
						
						$price4 = '';
						$d4 = $this->overview_model->getPrices4($id, '3');
						foreach($d4 as $dd4)
						{
							$price4 = $dd4->price;
						}
						$results['season1weekend'] = $price4;
			}//retrieve season 4 prices
			ELSE
			{	
												
							$price1 = '';
							$d1 = $this->overview_model->getPrices1($id, '4');
							foreach($d1 as $dd1)
							{
								$price1 = $dd1->price;
							}
							$results['season1daily'] = $price1;
							
							
							$price2 = '';
							$d2 = $this->overview_model->getPrices2($id, '4');
							foreach($d2 as $dd2)
							{
								$price2 = $dd2->price;
							}
							$results['season1weekly'] = $price2;
							
							
							$price3 = '';
							$d3 = $this->overview_model->getPrices3($id, '4');
							foreach($d3 as $dd3)
							{
								$price3 = $dd3->price;
							}
							$results['season1monthly'] = $price3;
							
					
							$price4 = '';
							$d4 = $this->overview_model->getPrices4($id, '4');
							foreach($d4 as $dd4)
							{
								$price4 = $dd4->price;
							}
							$results['season1weekend'] = $price4;
			}
			return $results;
	}
	
	/*
	**get review by smiley id
	*/
	function getReviewSmiley($smiley_id = NULL, $prop_id = NULL)
	{
		//$smiley_id = $this->input->post('smiley_id');
		$data = $this->overview_model->getReviewbysmiley($smiley_id, $prop_id);

		echo json_encode($data);
		
	}
	

	/*-------------LOGIN REGISTER ------------------*/	
	public function registerWithFacebook()
    {
        $userData = $this->facebook_lib->api('/me?fields=email,name,first_name,last_name,picture');
        
        $id = null;

        if (! $userDbData = $this->overview_model->getUserDataFromDb($userData['email'])) {
            $id = $this->overview_model->saveUser(array(
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
            
            if (! $userDbData = $this->overview_model->getUserDataFromDb($userData->email)) {
               	$id = $this->overview_model->saveUser(array(
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
        
        redirect(site_url(''));
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

		$rec = $this->overview_model->checkLogin($email,$password);

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
			'test' =>$rec
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

		$this->overview_model->chkDuplicateuser($email_id);

		if ($this->overview_model->chkDuplicateuser($email_id)) {
			echo json_encode(array(
				'status' => '500',
				'message' => 'This email is already registered with us',
			));
			exit();
		}

		$ins_data['password'] = md5($password);

		if (! $userId = $this->overview_model->insertTableData('users', $ins_data)) {
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
 
	
	
	function load_login_popup()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('login_view', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_login_popup_to_createproperty()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_login_view = $this->load->view('login_to_createproperty', $data, TRUE);
		echo $load_login_view;
	}
	
	function load_registration_popup()
	{
		$data['gpAuthUrl'] = $this->input->post('gpAuthUrl');
		$data['fbLoginUrl'] = $this->input->post('fbLoginUrl');

		$load_registration_view = $this->load->view('registration_view', $data, TRUE);
		echo $load_registration_view;
	}
	/*---------------------END LOGIN REGISTER---------------*/
	
	




	
	
	
}	