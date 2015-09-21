<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/****
 * Function to send the email notification as per the various condition
 **/
if ( ! function_exists('send_email_notification'))
{
	function send_email_notification($email_template)
	{
		if(ENVIRONMENT == 'testing')
		   return true;	
		$CI = & get_instance();
		//--------------SEND EMAIL START ---------//
		$CI->load->config('mandrill');
		//require APPPATH.'/libraries/Mandrill.php';
		$CI->load->library('mandrill');
		$mandrill_ready = NULL;
		try
		{
			$CI->mandrill->init($CI->config->item('mandrill_api_key') );
			$mandrill_ready = TRUE;		
		}
	  catch(Mandrill_Exception $e)
		{		
			$mandrill_ready = FALSE;		
		}
		$base_url = base_url();
		$email_array = array($email_template['to']);
		//$email_array =  array(array('email' => 'sonam@appsembly.com' )); 
		$result = '';
		if( $mandrill_ready )
		{
			$email = array(
											'html' =>$email_template['message'],				
											'subject' => $email_template['subject'],
											'from_email' => 'sonam@appsembly.com',
											'from_name' => 'Rnr Team',						
											'to' =>$email_array
											//'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
										);
			$result = $CI->mandrill->messages_send($email);	
			log_message('Mandrill',"Email sent successfully ");
			return true;
		}
		else
		{
		  log_message('Mandrill',"Error Email");		
		  return false;
		}
	}
}
?>