<?php

if (! defined('BASEPATH')) {
    exit('Direct script access is not allowed');
}

class Googleplus
{
    /**
     * 
     * variable to store
     * current CI instance
     * 
     * @var CI Object
     */
    public $ci;
    
    /**
     *
     * @var Google API Client Object 
     */
    public $client;
    
    /**
     *
     * @var Oauth2 Object 
     */
    public $plus;
    
    /**
     * 
     * constructor
     */
    public function __construct()
    {
        // store current CI instance
        $this->ci =& get_instance();
        
        // load config file
        $this->ci->config->load('googleplus');
        
        // load helper
        $this->ci->load->helper(array(
            'url',
        ));
        
        // require google API SDK source files
        require_once(APPPATH . 'third_party/google-api-php-client-master/src/Google/autoload.php');
        require_once(APPPATH . 'third_party/google-api-php-client-master/src/Google/Client.php');
        require_once(APPPATH . 'third_party/google-api-php-client-master/src/Google/Service/Oauth2.php');
        
        // instantiate the Google API Client class
        $this->client = new Google_Client();
        
		// set OAuth2 parameters
        $this->client->setApplicationName($this->ci->config->item('application_name', 'googleplus'));
		$this->client->setClientId($this->ci->config->item('client_id', 'googleplus'));
		$this->client->setClientSecret($this->ci->config->item('client_secret', 'googleplus'));
		$this->client->setRedirectUri($this->ci->config->item('redirect_uri', 'googleplus'));
		$this->client->setDeveloperKey($this->ci->config->item('api_key', 'googleplus'));
        $this->client->addScope("https://www.googleapis.com/auth/userinfo.email");
		
		// instantiate the Oauth2 service definoition class
        $this->plus = new Google_Service_Oauth2($this->client);
    }
    
    /**
     * 
     * pass code to OAuth2
     * in exchange for
     * access token
     * 
     * @param string $code
     */
    public function authenticateAccess($code)
    {
        try{
            // authenticate with code to get access token
            $this->client->authenticate($code);
            
            $this->ci->session->set_userdata('gplus_access_token', $this->getAccessToken());
            
            redirect($this->ci->config->item('redirect_uri', 'googleplus'));
        } catch (Google_Auth_Exception $ex) {
            echo $ex->getMessage();
            
            exit();
        }
        
        // get access token
        ;
    }
    
    public function getAccessToken()
    {
        // get access token
        return $this->client->getAccessToken();
    }
    
    public function setAccessToken($token)
    {
        // set access token
        return $this->client->setAccessToken($token);
    }


    /**
     * 
     * get authentication url
     * 
     * @return string
     */
    public function getAuthenticationUrl()
    {
        // get authentication url
        return $this->client->createAuthUrl();
    }
    
    /**
     * 
     * get authenticated user info
     * 
     * @return Google_Service_Oauth2_Userinfoplus Object
     */
    public function getAuthenticatedUserInfo()
    {
        try {
            // get authenticated user info
            return $this->plus->userinfo->get();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            
            exit();
        }
    }


    /**
     * print data for debugging
     * optionally exit from program execution
     * 
     * @param array $data
     * @param boolean $exit
     */
    public function debug($data = null, $exit = true)
    {
        if (! $data) {
            // no data was passed as parameter
            echo 'No data was passed for debugging';
        } else {
            // pretty print data
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
        
        if ($exit) {
            // exit from program
            exit();
        }
    }
}