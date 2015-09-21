<!DOCTYPE html>
<html lang="en">
<head>
	<!--
	  Used the free admin theme
		Version Charisma v1.0.0
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title> Rnr Admin </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo base_url()?>public/css/bootstrap-cerulean.css" rel="stylesheet">
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
		
		.center
		{
			text-align: center !important;
		}

		/*Raikumar:- country_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayCountry {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayCountry div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*EDIT/UPDATE pop up dialog form data*/
		#overlayEditCountry {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditCountry div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- state_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayState {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayState div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- state_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditState {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditState div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}


		/*Raikumar:- city_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditCity {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditCity div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}


		/*Raikumar:- roomtype_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditRoomtype {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditRoomtype div {
		     width:300px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- amenitiestype_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditAmenities {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditAmenities div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- amenitiesSubtype_master pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditASubtype {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditASubtype div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}


		/*Raikumar:- Property type edit pop dialog box*/
		/*post pop up dialog form data*/
		#overlayEditPropertytype {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditPropertytype div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		} 

		/*Raikumar:- Property tag edit pop up dialog box*/
		/*post pop up dialog form data*/
		#overlayEditPropertytag {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditPropertytag div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		} 

		/*Raikumar:- Property smiley edit pop up dialog box*/
		/*post pop up dialog form data*/
		#overlayEditPropertysmily {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditPropertysmily div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- Property Policy edit pop up dialog box*/
		/*post pop up dialog form data*/
		#overlayEditPolicy {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditPolicy div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}


		/*Raikumar:- Property Price period edit pop up dialog box*/
		/*post pop up dialog form data*/
		#overlayEditPricePeriod {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditPricePeriod div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}

		/*Raikumar:- Property Price Season type edit pop up dialog box*/
		/*post pop up dialog form data*/
		#overlayEditSeasontype {
		     visibility: hidden;
		     position: absolute;
		     left: 0px;
		     top: 0px;
		     width:100%;
		     height:100%;
		     text-align:center;
		     z-index: 1000;
		}

		#overlayEditSeasontype div {
		     width:400px;
		     margin: 100px auto;
		     background-color: #819FF7;
		     border:1px solid #000;
		     padding:15px;
		     text-align:center;
		}


	</style>
	<style>
		/*master location heading menu bar style (RAIKUMAR)*/ 
		#headsubmenu ul {
		    float: left;
		    width: 100%;
		    padding: 0;
		    margin: 0;
		    list-style-type: none;
		}

		#headsubmenu  a {
		    float: left;
		    width: 10em;
		    text-decoration: none;
		    color: black;
		    /*background-color: purple;*/
		    padding: 0.2em 0.6em;
		    border-right: 1px solid black;
		}

		#headsubmenu  a:hover {
		    background-color: green;
		}

		#headsubmenu li {
		    display: inline;
		}
	</style>
	<style>
	#cityformdiv ul{
		list-style-type: none;
	    margin: 0;
	    padding: 0;
	}
	#cityformdiv li{

    display: inline;

	}
	</style>

		<!-- jQuery -->
	
	<script src="<?php echo base_url()?>public/js/jquery-1.10.1.min.js"></script>
	<link href="<?php echo base_url()?>public/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url()?>public/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url()?>public/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo base_url()?>public/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo base_url()?>public/css/chosen.css' rel='stylesheet'>
	<!--<link href='<?php echo base_url()?>public/css/uniform.default.css' rel='stylesheet'>-->
	<link href='<?php echo base_url()?>public/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>public/css/opa-icons.css' rel='stylesheet'>
	<!--<link href='<?php echo base_url()?>public/css/uploadify.css' rel='stylesheet'>-->
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
   <script>
		 var BASE_URL = '<?php echo base_url();?>';
		 var SITE_URL = '<?php echo base_url().index_page();?>';
	 </script>
	 <?php $base_url  = base_url();?>
	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.ico">
		
</head>

<body>
<!-- Add country pop up dialog box (RAIKUMAR) -->
<div id="overlayCountry" tabindex="-1">
     <div>
          <p>Insert Country</p>
          <p id="dem"></p>
          <form id="submitCountry">
			<table>
	           	<tr><td>Insert Country</td><td>
	            <input type="text" id="country_fid" name="country">            
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='status_fid' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            </td></tr>
	            <tr><td>
	            <input type="submit" id="CountrySubmitButton" value="Send">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="CountryClose">close</a>
     </div>    
</div>
<!--END  Add country pop up dialog box (RAIKUMAR) -->

<!-- Edit country pop up dialog box (RAIKUMAR) -->
<div id="overlayEditCountry" tabindex="-1">
     <div>
          <p>Edit Country</p>
          
          <form id="submitEditCountry">
			<table>
	           	<tr><td>Edit Country</td><td>
	            <input type="text" id="country1_fid" name="country">
	            <input type="hidden" id="countryfid" name="country_id">             
	            </td></tr>
	            <tr><td>Status</td><td>
	            <select id='status1_fid' name='status'><option value="Active">Active</option><option value="Inactive">Inactive</option></select>            
	            </td></tr>
	            <tr><td>
	            <input type="submit" id="CountryEditButton" value="Send">
	           </td></tr>
           </table>
          </form>          
          <a href="#" id="CountryEditClose">close</a>
     </div>    
</div>
<!--END  Edit country pop up dialog box (RAIKUMAR) -->



	<?php
	 if(!isset($no_visible_elements) || !$no_visible_elements)	{ 
	?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo base_url().index_page().'admin/dashboard'?>"> <img alt="Rnr Admin section" src="<?php echo base_url()?>public/images/logo-houses.png" /><span>Rnr Admin</span></a>
				
			
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->session->userdata('user_name');?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url().index_page()?>admin/admin_setting">Admin Setting</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url().index_page()?>admin/login/logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->				
			
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php
	} 
	?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php 
		if(!isset($no_visible_elements) || !$no_visible_elements) { 
		?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>						
						
						<li class="nav-header hidden-tablet">User</li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/user_profile"><i class="icon-user"></i><span class="hidden-tablet"> Users List </span></a></li>
						
						<li class="nav-header hidden-tablet">Property</li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/property_detail/view_booking"><i class="icon-list-alt"></i><span class="hidden-tablet"> Property Booking </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/property_detail/view_properties"><i class="icon-list-alt"></i><span class="hidden-tablet"> Property Management </span></a></li>
						<li class="nav-header hidden-tablet">Master</li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexCountry"><i></i><span class="hidden-tablet"> Master Location </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexRoomtype"><i></i><span class="hidden-tablet"> Master Room Type </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexAmenitiestype"><i></i><span class="hidden-tablet"> Master Amenities </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPropertytype"><i></i><span class="hidden-tablet"> Master Property type </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPropertytag"><i></i><span class="hidden-tablet"> Master Property Tag </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPropertySmiley"><i></i><span class="hidden-tablet"> Master Smiley </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPropertyPolicy"><i></i><span class="hidden-tablet"> Master Policy </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPricePeriod"><i></i><span class="hidden-tablet"> Master Price Period </span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url().index_page()?>admin/master_location/indexPriceSeasontype"><i></i><span class="hidden-tablet"> Master Price Season Type </span></a></li>
						
						</ul>					
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php 
			} 
			?>
