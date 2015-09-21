<?php

if (! defined('BASEPATH')) {
    exit('Direct file access is prohibited');
}

class Linkedin_Authentication
{
    private $ci;
    private $client;
    
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->config->load('linkedin');
        $this->ci->load->helper(array(
            'url',
        ));
        
        require_once(APPPATH . 'third_party/LinkedIn/http.php');
        require_once(APPPATH . 'third_party/LinkedIn/oauth_client.php');
        
        $this->client = new oauth_client_class;
        
        $this->client->debug = false;
        $this->client->debug_http = true;
        $this->client->client_id = $this->ci->config->item('client_id', 'linkedin');
        $this->client->client_secret = $this->ci->config->item('client_secret', 'linkedin');
        $this->client->redirect_uri = $this->ci->config->item('redirect_url', 'linkedin');
        $this->client->scope = $this->ci->config->item('app_scope', 'linkedin');
    }
    
    public function authorizeWithLinkedIn()
    {
        if ($success = $this->client->Initialize()) {
            if ($success = $this->client->Process()) {
                if (strlen($this->client->authorization_error)) {
                    $this->client->error = $this->client->authorization_error;
                    $success = false;
                } elseif (strlen($this->client->access_token)) {
                    $success = $this->client->CallAPI(
                        'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)',
                        'GET',
                        array(
                            'format' => 'json',
                        ),
                        array(
                            'FailOnAccessError' => true,
                        ),
                        $user
                    );
                } else {
                    //
                }
            }
            $success = $this->client->Finalize($success);
        }
        
        if ($this->client->exit) {
            exit();
        }
        
        if ($success) {
            return array(
                'status' => 'success',
                'user' => $user,
            );
        } else {
            return array(
                'status' => 'error',
                'error' => $this->client->error,
            );
        }
    }
}

/**
 * end of Linkedin_Authentication.php
 */