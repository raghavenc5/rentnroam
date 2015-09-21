<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


define('developer_key' ,"0b9908c2-1f51-4bf2-bd2e-846e5868e9db");
define('password' ,"Senthil7$");
define('accountId_info_uk' ,"c40c1f93-03c2-4e21-abb4-92f68e8ea767");
define('accountId_trendtwo_uk' ,"983d573f-d9ff-46f2-9e86-aaef166e3a9d");

define('accountId_craze_uk' ,"ca916e03-70ce-4259-81e3-03c7f4248eaa");
define('accountId_craze_us' ,"b55af4e5-9591-4dc9-85a7-b69eff56cd8b");
define('accountId_craze_german' ,"7492549b-18dd-4e32-9cb9-02527ff28ba0");
define('accountId_craze_france' ,"05314dea-1db2-4b8f-9f52-f072dbafdd36");
define('accountId_craze_italy' ,"cd86e5f3-d2b4-4343-bd15-ecca5875ff4a");
define('accountId_craze_spanish' ,"c2cf46d4-d888-431e-a3f0-1ee00029c1fb");


define('Style_Tribe_uk' ,"782bac47-2c47-47b6-9b1e-e774dae3268b");
define('Style_Tribe_us' ,"4bf61483-913f-4817-a7a6-f74d8f2b783c");
define('Style_Tribe_fr' ,"57465eab-ec07-44da-bb66-484f846a8700");
define('Style_Tribe_de' ,"2e80db2b-5208-4d87-b766-dfb0eeb5ca72");
define('Style_Tribe_it' ,"d3fe024e-3329-49ee-b860-87c01f706540");
define('Style_Tribe_es' ,"81368fcd-45b6-4627-a1de-8529648205d0");




define('tt_uk' ,"983d573f-d9ff-46f2-9e86-aaef166e3a9d");
define('tt_us' ,"c83f5bcc-dbf4-4dd0-9850-f4fd0589060d");
define('tt_fr' ,"9efbe923-04af-4a70-b75f-c914a9361f07");
define('tt_de' ,"8782f93f-0d3d-461c-8ea2-af0069cb94a5");
define('tt_it' ,"c32c6b6a-8c58-420c-83e3-cb8a3a2adb99");
define('tt_es' ,"7ef7f0ff-3c0e-4d9b-bfb5-e70e3db32b74");


define('inventory_service_wsdl_url' ,
"https://api.channeladvisor.com/ChannelAdvisorAPI/v7/InventoryService.asmx?WSDL");
define('api_url' ,"http://api.channeladvisor.com/webservices/");

/*shopify starts*/
/*define('shop_domain' ,"trendtwo2.myshopify.com");
define('token' ,"e5d9f14514a4fcce5a81ed08d7cc265e");
define('api_key' ,"9c81657abbdc5e9a62c6c21189b39372");
define('secret' ,"00ea2bb7a1d3e52302104f22a4abd0f4");*/

define('shop_domain' ,"b-style.myshopify.com");
define('token' ,"2b6c7c8405aeda01c8c973e39a208eba");
define('api_key' ,"634926eacadcc7b5ddbdfd0d1f9d61e4");
define('secret' ,"3e27792ba614fd016b4a7956c87d2c6d");

define('master_mens_size' ,"master_mens_size");
define('master_mens_category' ,"master_mens_category");
define('master_womens_size' ,"master_womens_size");
define('master_womens_category' ,"master_womens_category");
define('merchandise_batch' ,"merchandise_batch");
define('merchandise_mapping' ,"merchandise_mapping");
define('master_womens_maincategory' ,"master_womens_maincategory");
define('master_mens_maincategory' ,"master_mens_maincategory");
define('master_womens_onesize' ,"master_womens_onesize");
define('master_asos_colour' ,"master_asos_colour");
define('master_mens_onesize' ,"master_mens_onesize");

/*shopify ends*/

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* UsTrendy Variables */

define('USTRENDY_LOGINURL' ,"https://www.ustrendy.com/udropship/vendor/");
define('USTRENDY_USERNAME' ,"sales@trendtwo.com");
define('USTRENDY_PASSWORD' ,"trendtwo123");
define('USTRENDY_PRODUCTLISTINGURL' ,"https://www.ustrendy.com/udprod/vendor/products/");
define('USTRENDY_PRODUCTLISTINGFILE' ,"C:\Arun\wamp\www\people.html");
define('USTRENDY_PRODUCTLISTINGLOCALURL' ,"http://localhost/people.html");
define('USTRENDY_PRODUCTPOSTFORMURL' ,"https://www.ustrendy.com/udprod/vendor/productNew");
define('USTRENDY_PRODUCTPOSTFORMFILE' ,"C:\Arun\wamp\www\people1.html");
define('USTRENDY_PRODUCTPOSTFORMLOCALURL' ,"http://localhost/people1.html");

/* Database Variable */

define('PROPERTY',"properties");

define('CITY',"master_city");
define('COUNTRY',"master_country");
define('STATE',"master_state");

define('PROPERTY_IMAGES',"properties_images");
define('USER',"users");
define('PEOPLE_STORIES',"cms_homepage_people_stories");
define('SLIDER',"cms_slides");
define('WHAT_HAPPENING',"cms_homepage_whats_happening");
define('ROOM_TYPE',"master_room_type");
define('PROPERTY_TYPE',"master_property_type");
define('PROPERTY_VIDEO',"properties_video");

define('PROPERTY_ROOMS',"properties_rooms");
define('PROPERTY_PRICES',"properties_prices");
define('AMENETIES',"master_amenities");
define('AMENETIES_TYPE',"master_amenities_type");


define('PROPERTY_AMENITIES',"properties_amenities");
define('REVIEWS',"properties_reviews");
define('LANGUAGE',"master_language");
define('POLICY',"master_cancellation_policy"); 
define('TAGS',"master_tag"); 
define('PROPERTY_TAGS',"properties_tag");
define('TRENDING_DESTINATION',"guest_trending_destination");
define('PROPERTY_RATING',"properties_rating");
define('DOCUMENT',"user_documents");
define('PROPERTY_BOOKING',"properties_booking");

define('NOTIFICATION',"master_notification");
define('TRANSAC_NOTIFY',"user_transaction_notification");
define('TEMP_PROPERTIES',"temp_properties");
define('EMAIL_TEMPLATE',"master_emailtemplate_manager");
/* UsTrendy Variables */

/* End of file constants.php */
/* Location: ./application/config/constants.php */