<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
ob_start();
class Dashboard extends CI_Controller {
 function __construct()
 {
   parent::__construct();
	 $this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('text');
	 
	 if($this->session->userdata('user_name') == '')
		 redirect('admin/login');
	 
	 $this->load->helper(array('form', 'url'));
 }

 /****
  * Function to load the recent user view
  **/
 function index()
 {
		$this->load->view('dashboard_view');
 }
 
 
}
ob_clean();
?>