<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(0);
ob_start();
class Master_location extends CI_Controller {

function __construct()
 {
   parent::__construct();
   $this->load->library('session');
   if($this->session->userdata('user_name') == '')
   
        redirect('admin/login');	 
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->model('admin_model');
		$this->load->model('search/search_model');
 }

 /***
  * Index Country (to list country master) Function just loading the simple dashboard view
  **/
 function indexCountry($orderColumn='country_id', $sortOrder='ASC', $country_id = '-')
 {
	 //echo "hii";
  $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexCountry/'.$orderColumn.'/'.$sortOrder.'/'.$country_id;
		$config['uri_segment'] = $uri = 7;
		$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
		$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['country_id'] =  $country_id;
	  
		$data['query'] = $credit_list = $this->admin_model->fetch_country_master_data($offset, $per_page, $orderColumn, $sortOrder, $country_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	
	$this->load->view('admin/masterCountry_list_view',$data);

 }//end of the index


 /***
  * Index State (to list state master) Function just loading the simple dashboard view
  **/
 function indexState($orderColumn='id', $sortOrder='ASC', $id = '-')
 {
	 //echo "hii";
  $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexState/'.$orderColumn.'/'.$sortOrder.'/'.$id;
		$config['uri_segment'] = $uri = 7;
		$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
		$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $id;
	  
		$data['query'] = $credit_list = $this->admin_model->fetch_state_master_data($offset, $per_page, $orderColumn, $sortOrder, $id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	
	$this->load->view('admin/masterState_list_view',$data);

 }//end of the index


  /***
  * Index City (to list city master) Function just loading the simple dashboard view
  **/
 function indexCity($orderColumn='id', $sortOrder='ASC', $id = '-')
 {
	 //echo "hii";
  $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexCity/'.$orderColumn.'/'.$sortOrder.'/'.$id;
		$config['uri_segment'] = $uri = 7;
		$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
		$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $id;
	  
		$data['query'] = $credit_list = $this->admin_model->fetch_city_master_data($offset, $per_page, $orderColumn, $sortOrder, $id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	
	$this->load->view('admin/masterCity_list_view',$data);

 }//end of the index



 /***
  * Index Room (to list Roomtype master) Function just loading the simple dashboard view
  **/
 
 function indexRoomtype($orderColumn='room_type_id', $sortOrder='ASC', $room_id = '-')
 {
	 //echo "hii";
  $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexRoomtype/'.$orderColumn.'/'.$sortOrder.'/'.$room_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['room_type_id'] =  $room_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_room_type_data($offset, $per_page, $orderColumn, $sortOrder, $room_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterRoomtype_list_view',$data);

 }//end of the index

 /***
  * Index Amenities (to list Amenities master) Function just loading the simple dashboard view
  **/
 
 function indexAmenitiestype($orderColumn='amenities_type_id', $sortOrder='ASC', $amenities_id = '-')
 {
	 //echo "hii";
  $this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexAmenitiestype/'.$orderColumn.'/'.$sortOrder.'/'.$amenities_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['amenities_type_id'] =  $amenities_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_amenities_type_data($offset, $per_page, $orderColumn, $sortOrder, $amenities_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterAmenities_list_view',$data);

 }//end of the index


  /***
  * Index Master Amenities subtype (to list Amenities Sub master) Function just loading the simple dashboard view
  **/
 
 function indexAmenitiesSubtype($orderColumn='amenities_id', $sortOrder='ASC', $amenities_id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexAmenitiesSubtype/'.$orderColumn.'/'.$sortOrder.'/'.$amenities_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['amenities_id'] =  $amenities_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_amenitiesSubtype_data($offset, $per_page, $orderColumn, $sortOrder, $amenities_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterAmenitiesSubtype_list_view',$data);

 }//end of the index

   /***
  * Index Master Amenities subtype (to list Amenities Sub master) Function just loading the simple dashboard view
  **/
 
 function indexPropertytype($orderColumn='property_type_id', $sortOrder='ASC', $ptype_id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPropertytype/'.$orderColumn.'/'.$sortOrder.'/'.$ptype_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['property_type_id'] =  $ptype_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_propertytype_data($offset, $per_page, $orderColumn, $sortOrder, $ptype_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPropertytype_list_view',$data);

 }//end of the index

    /***
  * Index Master Amenities subtype (to list Amenities Sub master) Function just loading the simple dashboard view
  **/
 
 function indexPropertytag($orderColumn='id', $sortOrder='ASC', $tag_id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPropertytag/'.$orderColumn.'/'.$sortOrder.'/'.$ptype_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $tag_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_propertytag_data($offset, $per_page, $orderColumn, $sortOrder, $tag_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPropertytag_list_view',$data);

 }//end of the index


  function indexPropertySmiley($orderColumn='smiley_id', $sortOrder='ASC', $smiley_id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPropertySmiley/'.$orderColumn.'/'.$sortOrder.'/'.$smiley_id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['smiley_id'] =  $smiley_id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_propertysmiley_data($offset, $per_page, $orderColumn, $sortOrder, $smiley_id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPropertySmiley_list_view',$data);

 }//end of the index


   function indexPropertyPolicy($orderColumn='id', $sortOrder='ASC', $id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPropertyPolicy/'.$orderColumn.'/'.$sortOrder.'/'.$id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_propertypolicy_data($offset, $per_page, $orderColumn, $sortOrder, $id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPolicy_list_view',$data);

 }


 function indexPricePeriod($orderColumn='id', $sortOrder='ASC', $id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPricePeriod/'.$orderColumn.'/'.$sortOrder.'/'.$id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_priceperiod_data($offset, $per_page, $orderColumn, $sortOrder, $id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPricePeriod_list_view',$data);

 }

 function indexPriceSeasontype($orderColumn='id', $sortOrder='ASC', $id = '-')
 {
	 //echo "hii";
  	$this->load->library('pagination');
	$data['orderColumn'] = $orderColumn;
	if($sortOrder == 'DESC')
	$data['sortOrder'] = 'ASC';
	else
	$data['sortOrder'] = 'DESC';
	$config['base_url'] = base_url().index_page().'admin/master_location/indexPriceSeasontype/'.$orderColumn.'/'.$sortOrder.'/'.$id;
	$config['uri_segment'] = $uri = 7;
	$data['offset'] = $offset = (int) $this->uri->segment($uri, 0);
	$config['per_page'] = $data['per_page'] = $per_page = 10;
    $data['id'] =  $id;
	  
	$data['query'] = $credit_list = $this->admin_model->fetch_seasontype_data($offset, $per_page, $orderColumn, $sortOrder, $id);
	
	$config['total_rows'] = $data['total_rows'] = $this->search_model->countRows();		
	$config['num_links'] = 3;

	//----------- Pagination Design ----------------//

	$config['full_tag_open']	= '<ul>';
	$config['full_tag_close']	= '</ul>';
	$config['first_tag_open']	= '<li>';
	$config['first_tag_close']	= '</li>';
	$config['last_tag_open']	= '<li>';
	$config['last_tag_close']	= '</li>';	
	$config['cur_tag_open']  = '&nbsp;<li class="active"><a href="#">';
	$config['cur_tag_close']	= '</a></li>';
	$config['next_tag_open']	= '<li>';
	$config['next_tag_close']	= '</li>';
	$config['prev_tag_open']	= '<li>';
	$config['prev_tag_close']	= '</li>';
	$config['num_tag_open']  = '<li>';
	$config['num_tag_close']	= '</li>';
	$config['first_link'] = 'First';
	$config['last_link'] = 'Last';

	$this->pagination->initialize($config);	
	$data['links'] = $this->pagination->create_links();
	//print_r($data);
	$this->load->view('admin/masterPriceSeasontype_list_view',$data);

 }




}//end of the class User_profile
ob_clean();
?>