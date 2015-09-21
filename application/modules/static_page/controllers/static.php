<?php defined('BASEPATH') OR exit('No direct script access allowed');
/***
 * Controller 
 **/
class Static extends MX_Controller
{
	private $viewData;

	private $fbUser;

	function __construct()
	{
		parent::__construct();
		$this->load->model('static_model');
	}
   /**
	 ** Function For Faq
	 **/
	 function faq()
	 {
		 $type= $this->post('type');
		 $data['faq'] = $this->static_model->getFaq($type);
		 $this->load->view('faq_view',$data);
	 }
	 /**
	 * Function to fetch Hot Offers
	 **/
	 function hotOffers()
	 {
		 $data['hot_offer'] = $this->static_model->getHotOffers();
		 $this->load->view('hotoffer_view',$data);
	 }
	 /**
	 * Function to fetch People Stories
	 **/
	 function peopleStories()
	 {
		 $data['people_stories'] = $this->static_model->getPeoplestories();
		 $this->load->view('people_stories_view',$data);
	 }
	 /**
	 * Function to fetch events and happenings
	 **/
	 function eventsHappenings()
	 {
		 $data['festival'] = $this->static_model->getUpcomingfestival();
		 $this->load->view('festival_view',$data);
	 }
}
?>

