<?php

if (! defined('BASEPATH')) {
	exit('Direct script access is prohibited');
}

/**
* class Profile
* extends class Host_Generic_Controller
* encapsulates all the properties
* and methods defining a host profile
*/

class Profile extends Host_Generic_Controller
{
	public function __construct()
	{
		parent::__construct();

		// load models
		$this->load->model(array(
			'profile_model',
		));

		// load libraries
		$this->load->library(array(
            'form_validation',
            'upload',
            'encrypt',
            //'email',
            'googleplus',
            'Linkedin_Authentication',
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
	* method to render the main profile page
	*/
	public function index()
	{
        // check if user's logged in
    	if (! $this->isAuthenticated()) {
    		redirect(site_url('home/index'));
    	}

    	// get user data from session
    	$sessionUserData = $this->session->userdata('user');

        // fetch user profile data
        $profileData = $this->profile_model->fetchProfileDataByHostId($sessionUserData['user_id']);

        // fetch received reviews data
        $hostPropertyReviews = $this->profile_model->fetchReceivedReviews($sessionUserData['user_id']);

        // fetch submitted reviews data
        $hostOwnReviews = $this->profile_model->fetchOwnReviews($sessionUserData['user_id']);

        // fetch countries
        $countries = $this->profile_model->fetchCountries();

        // load states
        $states = $profileData->country_id ? $this->profile_model->fetchStatesByCountryId($profileData->country_id) : array();

        // load cities
        $cities = $profileData->state_id ? $this->profile_model->fetchCitiesByStateId($profileData->state_id) : array();

        // fetch languages
        $languages = $this->profile_model->fetchLanguages();

        // fetch smileys
        $smileys = $this->profile_model->fetchSmileys();

        // fetch verification documents
        $documents = $this->profile_model->fetchDocuments();

    	// construct view variables
    	$data = array(
    		'title' => 'Host Profile',
    		'userData' => $sessionUserData,
            'profileData' => $profileData,
            'hostPropertyReviews' => $hostPropertyReviews,
            'hostOwnReviews' => $hostOwnReviews,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'languages' => $languages,
            'smileys' => $smileys,
            'documents' => $documents,
		);
        
        // prepare data for view
        $this->prepareDataForView($data);
        
        // check and render async view
        if ($this->input->is_ajax_request()) {
            // get render mode
            $mode = $this->input->post('mode') ? $this->input->post('mode') : 'edit_profile';

            // select view file
            switch ($mode) {
                case 'save_review': {
                    $this->load->view('profile/async_pages/property_review', $this->viewData);

                    break;
                }
                case 'load_verify_panel': {
                    $this->load->view('profile/async_pages/verify', $this->viewData);

                    break;
                }
                default:
                case 'edit_profile' : {
                    $this->load->view('profile/async_pages/edit_profile', $this->viewData);

                    break;
                }
            }
        } else {
            // load the respective view file
            $this->load->view('profile/index', array(
                'header' => $this->load->view('page_elements/header', $this->viewData, true),
                'footer' => $this->load->view('page_elements/footer', null, true),
            ));
        }
	}

    /**
    * edit profile handlers start
    */

    public function updateHostProfile()
    {
        // process only if ajax request
        if ($this->input->is_ajax_request()) {
            // get posted profile data
            $profileData = $this->input->post('profile_data') ? $this->input->post('profile_data') : array();

            // check for posted data
            if (! $profileData || ! $profileData['users'] || !  $profileData['users_email'] || ! $profileData['users_contact']) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: No data was found for processing',
                ));
            }

            // construct data for data tables save
            $hosts = $profileData['users'];
            $hostEmails = $this->constructHostEmailSaveData($profileData['users_email'], $hosts['user_id']);
            $hostContacts = $this->constructHostContactSaveData($profileData['users_contact'], $hosts['user_id']);
            $hosts['updated_on'] = date('Y-m-d H:i:s', time());
            $hosts['birth_date'] = $hosts['birth_year'] . '-' . $hosts['birth_month'] . '-' . $hosts['birth_date'];
            $hosts['languages'] = implode(',', $hosts['languages']);

            // remove unnecessary data
            unset($hosts['birth_year']);
            unset($hosts['birth_month']);
            unset($hosts['birth_date']);

            // check for host existence
            if (! $hosts['user_id'] || ! $this->profile_model->isHostExist($hosts['user_id'])) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: Host doesn\'t exist in database',
                ));
            }

            // saving host data failed
            if (! $this->profile_model->saveHostProfileData($hosts, $hostEmails, $hostContacts, $hosts['user_id'])) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: Host couldn\'t be saved',
                ));
            }

            // saving host data succeeded
            $this->jsonResponse(array(
                'status' => '200',
            ));
        }
    }

    /**
    * contruct host email data
    * for batch insert
    */
    private function constructHostEmailSaveData($hostEmailData, $hostId)
    {
        $hostEmailSaveData = array();

        // loop through
        foreach ($hostEmailData['is_verified'] as $key => $value) {
            // construct each data row as an array item
            $hostEmailSaveData[] = array(
                'user_id' => $hostId,
                'email' => $hostEmailData['email'][$key],
                'is_verified' => $value,
                'verification_code' => $hostEmailData['verification_code'][$key],
            );
        }

        return $hostEmailSaveData;
    }

    /**
    * contruct host contact data
    * for batch insert
    */
    private function constructHostContactSaveData($hostContactData, $hostId)
    {
        $hostContactSaveData = array();

        // loop through
        foreach ($hostContactData['is_verified'] as $key => $value) {
            // construct each data row as an array item
            $hostContactSaveData[] = array(
                'user_id' => $hostId,
                'prefix' => $hostContactData['prefix'][$key],
                'number' => $hostContactData['number'][$key],
                'is_verified' => $value,
                'contact_verification_code' => $hostContactData['contact_verification_code'][$key],
            );
        }

        return $hostContactSaveData;
    }

    /**
    * edit profile handlers end
    */

    /**
    * save review handlers start
    */

    public function savePropertyReview()
    {
        // get posted review data
        $reviewData = $this->input->post('review_data') ? $this->input->post('review_data') : array();

        // check for empty posted data
        if (! $reviewData) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal error: No data was found for processing',
            ));
        }

        // check for presence of critical data
        if (! $reviewData['property_id'] || ! $reviewData['user_id']) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal error: Critical data is/are missing',
            ));
        }

        // check if property has been rated
        if (! $reviewData['smiley_id']) {
            $this->jsonResponse(array(
                'status' => '400',
                'message' => 'Warning: Please rate this property',
            ));
        }

        // check if host is a valid one
        if (! $this->profile_model->isHostExist($reviewData['user_id'])) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal error: Invalid host found',
            ));
        }
        
        // check if property is a valid one
        if (! $this->profile_model->isPropertyExist($reviewData['property_id'])) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal error: Invalid property found',
            ));
        }

        // construct data for data table save
        $reviewData['comment_date'] = date('Y-m-d', time());

        // saving host data failed
        if (! $this->profile_model->saveReviewData($reviewData)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal error: Review couldn\'t be saved',
            ));
        }

        // saving host data succeeded
        $this->jsonResponse(array(
            'status' => '200',
        ));
    }

    /**
    * save review handlers end
    */

    /**
    * save profile pic handlers start
    */

    public function uploadHostProfilePhoto()
    {
        // allow only an ajax request
        if ($this->input->is_ajax_request()) {
            // check if host is a valid one
            if (! $this->profile_model->isHostExist($this->input->post('host_id'))) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: Invalid host found',
                ));
            }

            // check for empty image upload attempt
            $encodedImageData = $this->input->post('image-data');

            if (! $encodedImageData) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: No photo has been uploaded',
                ));
            }

            // decode encoded image
            $decodedImageData = urldecode($encodedImageData);

            // construct image data
            $imageData = explode(',', $decodedImageData)[1];
            $imageData = str_replace(' ', '+', $imageData);
            $imageData = base64_decode($imageData);

            // construct image extension
            $imageExt = explode('/', explode(';', explode(',', $decodedImageData)[0])[0])[1];

            // check valid image format
            if (! in_array($imageExt, array('jpeg', 'jpg', 'png'))) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => "Fatal error: Uploaded file type: $imageExt is not supported",
                ));
            }

            // construct image name and file directory
            $profilePicName = 'profile_pic_' . $this->input->post('host_id') . '_' . time() . '.' . $imageExt;
            $uploadPath = "./public/uploads/user_image/$profilePicName";

            // save image
            $sourceImage = imagecreatefromstring($imageData);
            $isImageSaved = ('jpeg' == $imageExt || 'jpg' == $imageExt) ? imagejpeg($sourceImage, $uploadPath, 100) : imagepng($sourceImage, $uploadPath, 9);

            // image couldnot be uploaded
            if (! $isImageSaved) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: Image could not be saved',
                ));
            }

            // iamge saved, perform db operation
            if (! $this->profile_model->updateHostProfilePic($profilePicName, $this->input->post('host_id'))) {
                $this->jsonResponse(array(
                    'status' => '500',
                    'message' => 'Fatal error: Host profile photo could not be updated',
                ));

                unlink($uploadPath);
            }

            // saving host profile image succeeded
            $this->jsonResponse(array(
                'status' => '200',
            ));

            imagedestroy($sourceImage);
        }
    }

    /**
    * save profile pic handlers end
    */

    /**
    * sending verification email handlers start
    */

    public function sendVerificationEmail($emailType, $id)
    {
        // construct the verification code
        $encryptedVerificationCode = $this->constructVerificationCode($id);

        // verification data
        $verificationData = array(
            'verification_code' => $encryptedVerificationCode,
        );

        // conditional params
        $primaryKey = ('primary' === $emailType) ? 'user_id' : 'id';
        $table = ('primary' === $emailType) ? 'users' : 'users_email';

        // set verification details
        if (! $this->profile_model->setEmailVerificationDetails($verificationData, $table, $primaryKey, $id)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal Error: Verification code could not be generated',
            ));
        }

        // fetch all required email related data from db
        $emailRelatedData = $this->profile_model->fetchEmailRelatedData($emailType, $id);

        // construct email body data
        $emailBodyData = array(
            'email' => $emailRelatedData->email,
            'user_name' => $emailRelatedData->user_name,
            'emailType' =>$emailType,
            'id' => $id,
            'encryptedVerificationCode' => $encryptedVerificationCode,
        );
        $emailBody = $this->load->view('mail_templates/email_verification', $emailBodyData, true);

        // configure mail
        $this->load->library('email');
        $this->email->to($emailRelatedData->email);
        $this->email->from('saptarshimandal2012@rediffmail.com');
        $this->email->subject('Email Verification');
        $this->email->message($emailBody);
        
        // send email
        if (! $this->email->send()) {
            $this->debug($this->email->print_debugger());
        }



        // operation successful
        $this->jsonResponse(array(
            'status' => '200',
            'message' => 'Verification mail sent to ' . $emailRelatedData->email,
        ));
    }

    public function verifyemail($emailType, $id, $verificationCode)
    {
        // check out for valid email type
        if (! $emailType || ! in_array($emailType, array('primary', 'secondary'))) {
            redirect(site_url('/home/index'));
        }

        // check out for valid id
        if (! $id || ! is_numeric($id)) {
            redirect(site_url('/home/index'));
        }

        // check out for non empty varification code
        if (! $verificationCode) {
            redirect(site_url('/home/index'));
        }

        $emailType = trim($emailType);
        $verificationCode = trim($verificationCode);

        // construct view variables
        $data = array(
            'title' => 'Host Email Verification',
            'verifyStatus' => false,
        );

        // check validity of verification code
        if (! $this->profile_model->verifyEmail($emailType, $id, $verificationCode)) {
            redirect(site_url('/home/index'));
        }

        // mark this email as verified
        if (markEmailAsVerified($emailType, $id)) {
            $data['verifyStatus'] = true;
        }

        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('profile/verify_email', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }

    private function constructVerificationCode($id)
    {
        // set the raw verification code
        $verificationCode = 'email_verification_' . trim($id) . '_' . time() . '_code';

        // set the encryption algo
        $this->encrypt->set_cipher(MCRYPT_BLOWFISH);

        // encrypted verification code
        $encryptedVerificationCode = $this->encrypt->encode($verificationCode);

        return $encryptedVerificationCode;
    }

    /**
    * sending verification email handlers end
    */

    /**
    * identity document handlers start
    */

    public function uploadIdentityDocument()
    {
        // set file upload configs
        $identityDocumentUploadConfig = array(
            'upload_path' => './public/uploads/identity_documents',
            'allowed_types' => 'jpg|png',
            'encrypt_name' => true,
        );
        $this->upload->initialize($identityDocumentUploadConfig);

        // upload the document
        if (! $this->upload->do_upload()) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal Error: Document could not be uploaded',
            ));
        }

        // get the upload data
        $uploadData = $this->upload->data();

        // get the posted data
        $identityDocumentData = $this->input->post('identity_document');

        // construct document data for saving
        $identityDocumentData['document_image'] = $uploadData['file_name'];

        // save document data
        if (! $this->profile_model->saveIdentityDocument($identityDocumentData)) {
            $this->jsonResponse(array(
                'status' => '500',
                'message' => 'Fatal Error: Document data could not be saved',
            ));
        }

        // operation successful
        $this->jsonResponse(array(
            'status' => '200',
            'message' => 'Document submitted; waiting for approval',
        ));
    }

    /**
    * identity document handlers end
    */

    /**
    * dummy controllers
    */

    public function overview()
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            redirect(site_url('home/index'));
        }

        // get user data from session
        $sessionUserData = $this->session->userdata('user');

        // construct view variables
        $data = array(
            'title' => 'Property Overview',
            'userData' => $sessionUserData,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('overview/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }

    public function mybookings()
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            redirect(site_url('home/index'));
        }

        // get user data from session
        $sessionUserData = $this->session->userdata('user');

        // construct view variables
        $data = array(
            'title' => 'My Bookings',
            'userData' => $sessionUserData,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('bookings/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }

    public function mytrips()
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            redirect(site_url('home/index'));
        }

        // get user data from session
        $sessionUserData = $this->session->userdata('user');

        // construct view variables
        $data = array(
            'title' => 'My Trips',
            'userData' => $sessionUserData,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('trips/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }

    public function dashboard()
    {
        // check if user's logged in
        if (! $this->isAuthenticated()) {
            redirect(site_url('home/index'));
        }

        // get user data from session
        $sessionUserData = $this->session->userdata('user');

        // construct view variables
        $data = array(
            'title' => 'Dashboard',
            'userData' => $sessionUserData,
        );
        
        // prepare data for view
        $this->prepareDataForView($data);

        // load the respective view file
        $this->load->view('dashboard/index', array(
            'header' => $this->load->view('page_elements/header', $this->viewData, true),
            'footer' => $this->load->view('page_elements/footer', null, true),
        ));
    }
    
    public function verifywithlinkedin()
    {
        $ret = $this->linkedin_authentication->authorizeWithLinkedIn();        
        if ('success' == $ret['status']) {
            $sessionUserData = $this->session->userdata('user');
            $this->profile_model->logHostSocialMediaVerification(array('user_id' => $sessionUserData['user_id'], 'social_media' => 'linkedin'));
        } 
        $this->session->set_flashdata('sm_verification', 'linkedin');
        redirect(site_url('/host/profile/'));
    }

    /**
    * dummy controllers
    */
}

/**
* end of file profile.php
*/
