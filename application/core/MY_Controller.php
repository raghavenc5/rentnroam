<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(-1);

/**
 * 
 * This controller contains the common functions
 * @author Teamtweaks 
 *
 */ 
date_default_timezone_set('Asia/Kolkata'); 
class MY_Controller extends CI_Controller {  
	public $privStatus;	
	public $data = array();
	function __construct()
    {
        parent::__construct();
		ob_start();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->helper('url');
        $this->load->helper('text');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('session');
		$this->load->model('product_model');
		
		/*
		 * Connecting Database
		 */
		 
		$this->load->database();
		$this->db->reconnect();
		$this->data['demoserverChk'] = $demoserverChk = strpos($this->input->server('DOCUMENT_ROOT'),'casperon/');
		/*
		 * Loading CMS Pages
		 */
		if ($_SESSION['cmsPages'] == ''){
			$cmsPages = $this->db->query('select * from '.CMS.' where `status`="Publish" and `hidden_page`="No"');
			$_SESSION['cmsPages'] = $cmsPages->result_array();
		}
		$this->data['cmsPages'] = $_SESSION['cmsPages'];
		
		/*
		 * Getting fancybox count
		 */
		/* if ($_SESSION['fancyBoxCount'] == ''){
			$fancyBoxList = $this->db->query('select * from '.FANCYYBOX.' where `status`="Publish"');
			$_SESSION['fancyBoxCount'] = $fancyBoxList->num_rows();
		}
		$this->data['fancyBoxCount'] = $_SESSION['fancyBoxCount']; */
		
		/*
		 * Loading Footer Cms
		 */
		if ($this->data['cmsList'] == ''){
			$this->data['cmsList'] = $this->db->query('select * from '.CMS.'');
		}
		
		//$this->data['cmsList_serial'] = serialize($_SESSION['cmsList']);
		
		//print_r($this->data['cmsList']->result());die;

		/*
		 * Loading active languages
		 */
		if ($_SESSION['activeLgs'] == ''){
			$activeLgsList = $this->db->query('select * from '.LANGUAGES.' where `status`="Active"');
			$_SESSION['activeLgs'] = $activeLgsList->result_array();
		}
		$this->data['activeLgs'] = $_SESSION['activeLgs'];
		
		$prefooter_query="SELECT * FROM ".PREFOOTER." WHERE status='Active'  ORDER BY id ASC LIMIT 3";
		$this->data['prefooter_results']=$this->db->query($prefooter_query);
		//print_r($this->data['prefooter_results']->result());
		/*
		 * Checking user language and loading user details
		 */
		if($this->checkLogin('U')!=''){
			$this->data['userDetails'] = $this->db->query('select * from '.USERS.' where `id`="'.$this->checkLogin('U').'"');
			$selectedLangCode = $this->session->userdata('language_code');
	 		/*if ($this->data['userDetails']->row()->language != $selectedLangCode){
	 			$this->session->set_userdata('language_code',$this->data['userDetails']->row()->language);
	 			$this->session->keep_flashdata('sErrMSGType');
	 			$this->session->keep_flashdata('sErrMSG');
	 			redirect($this->uri->uri_string());
	 		}*/
		}
		$config['SITENAME']=$this->config->item('meta_title');
		if (substr($uriMethod, 0,7) == 'display' || substr($uriMethod, 0,4) == 'view' || $uriMethod == '0'){
			$this->privStatus = '0';
		}else if (substr($uriMethod, 0,3) == 'add'){
			$this->privStatus = '1';
		}else if (substr($uriMethod, 0,4) == 'edit' || substr($uriMethod, 0,6) == 'insert' || substr($uriMethod, 0,6) == 'change'){
			$this->privStatus = '2';
		}else if (substr($uriMethod, 0,6) == 'delete'){
			$this->privStatus = '3';
		}else {
			$this->privStatus = '0';
		}
		$this->data['title'] = $this->config->item('meta_title');
		$this->data['heading'] = '';
		$this->data['flash_data'] = $this->session->flashdata('sErrMSG');
		$this->data['flash_data_type'] = $this->session->flashdata('sErrMSGType');
		$this->data['adminPrevArr'] = $this->config->item('adminPrev');
 		$this->data['adminEmail'] = $this->config->item('email');	
		$this->data['privileges'] = $this->session->userdata('fc_session_admin_privileges');
		$this->data['subAdminMail'] = $this->session->userdata('fc_session_admin_email');				
		$this->data['loginID'] = $this->session->userdata('fc_session_user_id');				
    	$this->data['allPrev'] = '0';
    	$this->data['logo'] = $this->config->item('logo_image');
    	$this->data['fevicon'] = $this->config->item('fevicon_image');
		$this->data['watermark'] = $this->config->item('watermark');
    	$this->data['footer'] = $this->config->item('footer_content');
    	$this->data['siteContactMail'] = $this->config->item('site_contact_mail');
		$this->data['WebsiteTitle'] = $this->config->item('email_title');
    	$this->data['siteTitle'] = $this->config->item('email_title');
    	$this->data['meta_title'] = $this->config->item('meta_title');
    	$this->data['meta_keyword'] = $this->config->item('meta_keyword');
    	$this->data['meta_description'] = $this->config->item('meta_description');
    	$this->data['giftcard_status'] = $this->config->item('giftcard_status');
		$this->data['sidebar_id'] = $this->session->userdata('session_sidebar_id');
		if ($this->session->userdata('fc_session_admin_name') == $this->config->item('admin_name')){
			$this->data['allPrev'] = '1';
		}
		$this->data['paypal_ipn_settings'] = unserialize($this->config->item('payment_0'));
		$this->data['paypal_credit_card_settings'] = unserialize($this->config->item('payment_1'));
		$this->data['authorize_net_settings'] = unserialize($this->config->item('payment_2'));
		
//		$this->data['currencySymbol'] = html_entity_decode($this->config->item('currency_currency_symbol'));

		/**********Curreny Settings*********/
/*		 var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
			die;
*/		
		//$this->load->library('geoPlugin');
		//echo geocurrencyCode;
		//$this->session->unset_userdata('currency_type');
		
		if($this->session->userdata('currency_type') == ''){
			
			$this->load->library('geoloc');
			$GeoCurrencyType=$geocurrencyCode;
			$currencyArr = $this->product_model->get_all_details(CURRENCY,array('status'=>'Active','currency_type'=>$GeoCurrencyType));
			//echo geocountryCode;
			
			
			if(count($currencyArr->result()) > 0){
		
				$currency_values = $currencyArr;
			}else{
				$currency_values = $this->product_model->get_all_details(CURRENCY,array('status'=>'Active','default_currency'=>'Yes'));
				
				
			}
			//print_r($currency_values->result());die;
			
			
		    if($currency_values->num_rows() ==1){
			foreach($currency_values->result() as $currency_v){
			$this->session->set_userdata('currency_type',$currency_v->currency_type) ;
			$this->session->set_userdata('currency_s',$currency_v->currency_symbols) ; 
			$this->session->set_userdata('currency_r',$currency_v->currency_rate) ;
			 }}
			$this->data['currencySymbol'] = $this->session->userdata('currency_s');
			$this->data['currencyType'] = $this->session->userdata('currency_type');
		}else{
		//echo $this->session->userdata('currency_type');die;
		 	$this->data['currencySymbol'] = $this->session->userdata('currency_s');
		 	$this->data['currencyType'] = $this->session->userdata('currency_type');
		}
		
		$this->data['currency_setup'] = $this->product_model->get_all_details(CURRENCY,array('status'=>'Active'),'');
		/**********Curreny Settings end*********/

		$this->data['datestring'] = "%Y-%m-%d %h:%i:%s";
		if($this->checkLogin('U')!=''){
 			$this->data['common_user_id'] = $this->checkLogin('U'); 
		}elseif($this->checkLogin('T')!=''){
 			$this->data['common_user_id'] = $this->checkLogin('T'); 
		}else{
			$temp_id = substr(number_format(time() * rand(),0,'',''),0,6);
			$this->session->set_userdata('fc_session_temp_id',$temp_id);
			$this->data['common_user_id'] = $temp_id;
		}
		$this->data['emailArr'] = $this->config->item('emailArr');
		$this->data['notyArr'] = $this->config->item('notyArr');
		
		$this->load->model('product_model');
		
		
		/*
		 * Like button texts
		 */
		define(LIKE_BUTTON, $this->config->item('like_text'));
		define(LIKED_BUTTON, $this->config->item('liked_text'));
		define(UNLIKE_BUTTON, $this->config->item('unlike_text'));
		
		if($_SESSION['authUrl'] == ''){
			//header( 'Location:base_url()');
		}
		
		
		/*Refereral Start */
		
		if($this->input->get('ref') != '')
		{
			//echo $this->input->get('ref');	
			$referenceName = $this->input->get('ref');
			$this->session->set_userdata('referenceName',$referenceName);
		}
		
		/*Refereral End */
		
		/* Multilanguage start*/
		if($this->uri->segment('1') != 'admin')
		{
		
			$this->load->library('geoloc');
			$GeoCountryCode=geocountryCode;
			$CountryArr = $this->product_model->get_all_details(COUNTRY_LIST,array('status'=>'Active','country_code'=>$GeoCountryCode));
			
			 /*****************Currency Setup*******************/
			if($this->session->userdata('currency_type') == ''){
			  //echo $this->session->userdata('currency_type');die;
			 $this->config->item('currency_currency_type');
			}
			/*if($this->session->userdata('cur_store_id')== ''){
			  $this->session->set_userdata('cur_store_name',$this->config->item('store_name')) ;
			}*/ 
		
			$defaultLanguage = 'en';
			if($this->session->userdata('language_code')==''){
			$this->load->library('geoloc');
			$GeoCountryCode=geocountryCode;
			$CountryArr = $this->product_model->get_all_details(COUNTRY_LIST,array('status'=>'Active','country_code'=>$GeoCountryCode));
				if($CountryArr->row()->status=='Active'){
					$this->session->set_userdata('language_code',$CountryArr->row()->language_code);
					$defaultLanguage = $CountryArr->row()->language_code;
				}else{
					$this->session->set_userdata('language_code','en');
					$defaultLanguage = 'en';
				}
			
			}
			
			$selectedLanguage = $this->session->userdata('language_code');	
			($selectedLanguage != '')? $selectedLanguage = $selectedLanguage : $selectedLanguage = 'en';

			$filePath = APPPATH."language/".$selectedLanguage."/".$selectedLanguage."_lang.php";
			if($selectedLanguage != '')
			{
			
					if(!(is_file($filePath)))
					{
					
						$this->lang->load($defaultLanguage, $defaultLanguage);
					}
					else
					{
						$this->lang->load($selectedLanguage, $selectedLanguage);
					}
				
			}
			else
			{
				$this->lang->load($defaultLanguage, $defaultLanguage);
			}
		}		
		/* Multilanguage end*/
		
    }
    
    /**
     * 
     * This function return the session value based on param
     * @param $type
     */
    public function checkLogin($type=''){
    	if ($type == 'A'){
    		return $this->session->userdata('fc_session_admin_id');
    	}else if ($type == 'N'){
    		return $this->session->userdata('fc_session_admin_name');
    	}else if ($type == 'M'){
    		return $this->session->userdata('fc_session_admin_email');
    	}else if ($type == 'P'){
    		return $this->session->userdata('fc_session_admin_privileges');
    	}else if ($type == 'U'){
    		return $this->session->userdata('fc_session_user_id');
    	}else if ($type == 'T'){
    		return $this->session->userdata('fc_session_temp_id');
			
    	}
    }
    
    /**
     * 
     * This function set the error message and type in session
     * @param string $type
     * @param string $msg
     */
    public function setErrorMessage($type='',$msg=''){
    	($type == 'success') ? $msgVal = 'message-green' : $msgVal = 'message-red';
		$this->session->set_flashdata('sErrMSGType', $msgVal);
		$this->session->set_flashdata('sErrMSG', $msg);
    }
   /**
    * 
    * This function check the admin privileges
    * @param String $name	->	Management Name
    * @param Integer $right	->	0 for view, 1 for add, 2 for edit, 3 delete
    */ 
   public function checkPrivileges($name='',$right=''){
   		$prev = '0';
		$privileges = $this->session->userdata('fc_session_admin_privileges');
		extract($privileges);
		$userName =  $this->session->userdata('fc_session_admin_name');
		$adminName = $this->config->item('admin_name');
		if ($userName == $adminName){
			$prev = '1';
		}
		if (isset(${$name}) && is_array(${$name}) && in_array($right, ${$name})){
			$prev = '1';
		}
		if ($prev == '1'){
			return TRUE;
		}else {
			return FALSE;
		}
   }
   
   /**
    * 
    * Generate random string
    * @param Integer $length
    */
   public function get_rand_str($length='6'){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
   }
   
   /**
    * 
    * Unsetting array element
    * @param Array $productImage
    * @param Integer $position
    */
	public function setPictureProducts($productImage,$position){
		unset($productImage[$position]);
		return $productImage;
	}
	
	/**
	 * 
	 * Resize the image
	 * @param int target_width
	 * @param int target_height
	 * @param string image_name
	 * @param string target_path
	 */
	 public function imageResizeWithSpace($box_w,$box_h,$userImage,$savepath){
			$thumb_file = $savepath.$userImage;
			
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
			
				//print_r($box_w);die;
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
			$whiteColorIndex = imagecolorexact($new,255,255,255);
			$whiteColor = imagecolorsforindex($new,$whiteColorIndex);
			imagecolortransparent($new,$whiteColor);
		
			$fill = imagecolorallocate($new, 064, 064, 064);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $thumb_file, 90);
			
	}
	public function imageResizeWithSpace1($box_w,$box_h,$userImage,$savepath){
			
			
			
			 $thumb_file = $savepath.$userImage;
			
			 $dist_file = $savepath.'/thumb/'.$userImage;
			 
			 
			 
			 					$config['source_image']    = $dist_file;
								$config['wm_text'] = 'Rentals';
								$config['wm_type'] = 'text';
								$config['wm_font_path'] = './GILSANUB.TTF';
								$config['wm_font_size']    = '22';
								$config['wm_font_color'] = 'e9b9b9';
								$config['wm_vrt_alignment'] = 'middle';
								$config['wm_hor_alignment'] = 'center';
								$config['wm_padding'] = '0';
								$this->image_lib->initialize($config); 
								$this->image_lib->watermark();
			 
			 
			 
			 
			 
			 
			 
			 
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 255, 255, 255);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $dist_file, 99);
	}
	/**
	 * 
	 * Resize the image
	 * @param int target_width
	 * @param int target_height
	 * @param string image_name
	 * @param string target_path
	 */
	public function imageResizeWithSpaceold($box_w,$box_h,$userImage,$savepath){
			
			$thumb_file = $savepath.$userImage;
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 255, 255, 255);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $thumb_file, 99);
			
	}
	
	public function watermarkimages($uploaddir,$image_name){
			$masterURL =$uploaddir.$image_name;
			header('content-type: image/jpeg');
			//$path = base_url().'images/logo'.$this->config->item('watermark');
			$watermark = imagecreatefrompng('images/watermark3.png');
			$watermark_width = imagesx($watermark);
			$watermark_height = imagesy($watermark);
			$image = imagecreatetruecolor($watermark_width, $watermark_height);
			$image = imagecreatefromjpeg($masterURL);
			$size = getimagesize($masterURL);
			$dest_x = $size[0] - $watermark_width - 5;
			$dest_y = $size[1] - $watermark_height - 500;
			imagecopymerge($image, $watermark, $dest_x, $dest_y,0, 0, $watermark_width, $watermark_height,20);
			imagejpeg($image, $masterURL);
	}
	
	
	/**
	 * 
	 * Resize the image
	 * @param int target_width
	 * @param int target_height
	 * @param string image_name
	 * @param string target_path
	 */
	public function imageResizeWithSpaceCity($box_w,$box_h,$userImage,$savepath){
			
			 $thumb_file = $savepath.$userImage;
			
			 $dist_file = $savepath.'/thumb/'.$userImage;
				
			list($w, $h, $type, $attr) = getimagesize($thumb_file);
				
				$size=getimagesize($thumb_file);
			    switch($size["mime"]){
			        case "image/jpeg":
            			$img = imagecreatefromjpeg($thumb_file); //jpeg file
			        break;
			        case "image/gif":
            			$img = imagecreatefromgif($thumb_file); //gif file
				      break;
			      case "image/png":
			          $img = imagecreatefrompng($thumb_file); //png file
			      break;
				
				  default:
				        $im=false;
				    break;
				}
				
			$new = imagecreatetruecolor($box_w, $box_h);
			if($new === false) {
				//creation failed -- probably not enough memory
				return null;
			}
		
		
			$fill = imagecolorallocate($new, 000, 000, 000);
			imagefill($new, 0, 0, $fill);
		
			//compute resize ratio
			$hratio = $box_h / imagesy($img);
			$wratio = $box_w / imagesx($img);
			$ratio = min($hratio, $wratio);
		
			if($ratio > 1.0)
				$ratio = 1.0;
		
			//compute sizes
			$sy = floor(imagesy($img) * $ratio);
			$sx = floor(imagesx($img) * $ratio);
		
			$m_y = floor(($box_h - $sy) / 2);
			$m_x = floor(($box_w - $sx) / 2);
		
			if(!imagecopyresampled($new, $img,
				$m_x, $m_y, //dest x, y (margins)
				0, 0, //src x, y (0,0 means top left)
				$sx, $sy,//dest w, h (resample to this size (computed above)
				imagesx($img), imagesy($img)) //src w, h (the full size of the original)
			) {
				//copy failed
				imagedestroy($new);
				return null;
				
			}
			imagedestroy($i);
			imagejpeg($new, $dist_file, 99);
			
	}

}
