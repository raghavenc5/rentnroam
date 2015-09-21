

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">
<link rel="shortcut icon" href="<?php echo base_url()?>public/images/favicon.png">
<title>Blank page</title>

<!--Core CSS -->
<link href="<?php echo base_url()?>public/bs3/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="css/bootstrap-reset.css" rel="stylesheet">-->
<link href="<?php echo base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="<?php echo base_url()?>public/css/style.css" rel="stylesheet">
<link href="<?php echo base_url()?>public/css/style-responsive.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery-ui.min.css">

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="container" > 
  <!--header start-->
  <header class="header fixed-top clearfix"> 
      <div class="container-fluid">
      <div class="row">
    <!--logo start-->
    <div class="brand"> <a href="#" class="logo"> <img src="<?php echo base_url()?>public/images/logo.png" alt=""> </a> 
      <!--
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
--> 
    </div>
    <!--logo end-->
    
    <div class="top-nav clearfix"> 
      <!--search & user info start-->
      <ul class="nav pull-left top-menu">
        <li>
          <div class="search-outer">
            <input type="text" class="form-control search" placeholder=" Search">
          </div>
        </li>
        <!-- user login dropdown start--> 
        
        <!-- user login dropdown end -->
        <li> 
          <!--
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
--> 
        </li>
      </ul>
      <!--search & user info end-->
      <div class="right-outer">
        <div class="nav notify-row pull-right" id="top_menu"> 
          <!--  notification start -->
          <ul class="nav pull-right top-menu">
            
            <!-- user login dropdown start-->
            <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <div class="avtaar-outer"> <img alt="" src="<?php echo base_url()?>public/images/avatar1_small.jpg"> </div>
              <span class="username">Welcome, Sidz</span> <i class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
              </ul>
            </li>
            <!-- user login dropdown end --> 
            <!--
        <li class="no-radius">
            
        </li>
-->
          </ul>
          <ul class="nav top-menu pull-right">
            <!-- settings start -->
            <li class="dropdown">
              <ul class="dropdown-menu extended tasks-bar">
                <li>
                  <p class="">You have 8 pending tasks</p>
                </li>
                <li> <a href="#">
                  <div class="task-info clearfix">
                    <div class="desc pull-left">
                      <h5>Target Sell</h5>
                      <p>25% , Deadline  12 June’13</p>
                    </div>
                    <span class="notification-pie-chart pull-right" data-percent="45"> <span class="percent"></span> </span> </div>
                  </a> </li>
                <li> <a href="#">
                  <div class="task-info clearfix">
                    <div class="desc pull-left">
                      <h5>Product Delivery</h5>
                      <p>45% , Deadline  12 June’13</p>
                    </div>
                    <span class="notification-pie-chart pull-right" data-percent="78"> <span class="percent"></span> </span> </div>
                  </a> </li>
                <li> <a href="#">
                  <div class="task-info clearfix">
                    <div class="desc pull-left">
                      <h5>Payment collection</h5>
                      <p>87% , Deadline  12 June’13</p>
                    </div>
                    <span class="notification-pie-chart pull-right" data-percent="60"> <span class="percent"></span> </span> </div>
                  </a> </li>
                <li> <a href="#">
                  <div class="task-info clearfix">
                    <div class="desc pull-left">
                      <h5>Target Sell</h5>
                      <p>33% , Deadline  12 June’13</p>
                    </div>
                    <span class="notification-pie-chart pull-right" data-percent="90"> <span class="percent"></span> </span> </div>
                  </a> </li>
                <li class="external"> <a href="#">See All Tasks</a> </li>
              </ul>
            </li>
            <!-- settings end --> 
            <!-- inbox dropdown start-->
            <li id="header_inbox_bar" class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-envelope-o"></i> <span class="badge bg-important">4</span> </a>
              <ul class="dropdown-menu extended inbox">
                <li>
                  <p class="red">You have 4 Mails</p>
                </li>
                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url()?>public/images/avatar-mini.jpg"></span> <span class="subject"> <span class="from">Jonathan Smith</span> <span class="time">Just now</span> </span> <span class="message"> Hello, this is an example msg. </span> </a> </li>
                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url()?>public/images/avatar-mini-2.jpg"></span> <span class="subject"> <span class="from">Jane Doe</span> <span class="time">2 min ago</span> </span> <span class="message"> Nice admin template </span> </a> </li>
                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url()?>public/images/avatar-mini-3.jpg"></span> <span class="subject"> <span class="from">Tasi sam</span> <span class="time">2 days ago</span> </span> <span class="message"> This is an example msg. </span> </a> </li>
                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url()?>public/images/avatar-mini.jpg"></span> <span class="subject"> <span class="from">Mr. Perfect</span> <span class="time">2 hour ago</span> </span> <span class="message"> Hi there, its a test </span> </a> </li>
                <li> <a href="#">See all messages</a> </li>
              </ul>
            </li>
            <!-- inbox dropdown end --> 
            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-bell-o"></i> <span class="badge bg-warning">3</span> </a>
              <ul class="dropdown-menu extended notification">
                <li>
                  <p>Notifications</p>
                </li>
                <li>
                  <div class="alert alert-info clearfix"> <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                    <div class="noti-info"> <a href="#"> Server #1 overloaded.</a> </div>
                  </div>
                </li>
                <li>
                  <div class="alert alert-danger clearfix"> <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                    <div class="noti-info"> <a href="#"> Server #2 overloaded.</a> </div>
                  </div>
                </li>
                <li>
                  <div class="alert alert-success clearfix"> <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                    <div class="noti-info"> <a href="#"> Server #3 overloaded.</a> </div>
                  </div>
                </li>
              </ul>
            </li>
            <!-- notification dropdown end -->
          </ul>
          
          <!--  notification end --> 
        </div>
      </div>
      <div class="help"> <img src="<?php echo base_url()?>public/images/hepl-icon.png" alt=" help"> <span>HELP</span> </div>
      <div class="how-it-outer"> <img src="<?php echo base_url()?>public/images/how-it.png" alt=" "> </div>
    </div>
          </div>
          </div>
  </header>
  <!--header end--> 
</section>
<!--sidebar end-->
<div class="container">
  <div class="row">
    <div class="content-box">
      <h1>Got a spare room or an entire house?</h1>
      <h4>Rent and Roam lets you make money renting out your place.</h4>
    </div>
  </div>
</div>

<!---<form name ="userinput" action="index.php/form_reader/save_userinput" method="post"> -->
<form class="form-horizontal" method="post" action="<?php echo base_url();?>host/createProperty"> 
<div class="sec-01">
  <div class="container">
    <div class="row bor-bottom padding-bot-20">
      <h3 class="heading-small">Property Type</h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      	<div class="form-group relative-pos"> <!--- <img class="cup-img" src="<?php echo base_url()?>public/images/cup.png" alt="cup" > --->
              <!--<input type="text" placeholder="Property Type" >-->
           
		<!--- <select id="exampleInputEmail2" name="property_type_id" class="form-control cup">	--->
		<?php

			// Base URL for the service
			$baseUrl = 'http://localhost/rent_n_roam/trunk/rentnroam/host/extractPropertyType';

			//echo '';

			$jsonData = file_get_contents($baseUrl); 
			$jsonDataObject = json_decode($jsonData);

			foreach($jsonDataObject as $option){
				if($option->element_type == "button")
				{
					//echo '<input class="form-control custom-radio" type="radio" name="property_type" value=' . $option->property_type . '>' . $option->property_type;
					echo '<div id="' . $option->property_type . '" class="col-md-2 col-xs-12 col-sm-12 custom-radio">' . $option->property_type . '<img class="pull-right" alt="Image Error" src='. $option->image_path .'></i></div>';
				}
			}

			echo '<div class="col-md-2">';
			echo '<select id="other_property_type" name="property_type_id" class="form-control cup">';
			echo '<option value="">Other</option>';
			foreach($jsonDataObject as $option){
				if($option->element_type == "option")
				{
					echo '<option value=' . $option->property_type . '>' . $option->property_type . '</option>';
				}
			}
			echo '</select>
			<input id="property_type_value" type="hidden" value="">
			</div>';
	
			//echo '';

			//curl_close($curl);

		?>	
		<!--- </select> --->
		 </div>
       </div>
      <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      	<div class="form-group relative-pos"> <img class="cup-img" src="images/building.png" alt="cup" >
              <input type="email" placeholder="Apartment" id="exampleInputEmail2" class="form-control cup">
            </div>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      	<div class="form-group relative-pos"> <img class="cup-img" src="images/home.png" alt="cup" >
              <input type="email" placeholder="House" id="exampleInputEmail2" class="form-control cup">
            </div>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      	 
              <select class="form-control m-bot15">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
            </div> -->
       </div>
       <div class="row bor-bottom padding-top-10">
      <h3 class="heading-small">Room Type</h3>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
      	<div class="form-group relative-pos"> <!--- <img class="cup-img" src="<?php echo base_url()?>public/images/home.png" alt="cup" > --->
             <!-- <input type="text" placeholder="Room Type" id="exampleInputEmail2" name="room_type_id" class="form-control cup"> -->
		
		<?php

			// Base URL for the service
			$baseUrl = 'http://localhost/rent_n_roam/trunk/rentnroam/host/extractRoomType';

			//echo '';

			$jsonData = file_get_contents($baseUrl); 
			$jsonDataObject = json_decode($jsonData);

			foreach($jsonDataObject as $option){
					//echo '<input class="form-control custom-radio" type="radio" name="property_type" value=' . $option->property_type . '>' . $option->property_type;
					echo '<div id="' . $option->roomtype . '" class="col-md-2 col-xs-12 col-sm-12 custom-radio-room"  data-toggle="tooltip" data-placement="bottom" title="' . $option->title . '">' . $option->roomtype . '<img class="pull-right" alt="Image Error" src='. $option->image_path .'></div>';
			}

		?>	
            </div>
       </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      <!--	<div class="form-group relative-pos"> <img class="cup-img" src="images/door.png" alt="cup" >
              <input type="email" placeholder="Private Room" id="exampleInputEmail2" class="form-control cup">
            </div> -->
       </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      	<!--<div class="form-group relative-pos"> <img class="cup-img" src="images/bed.png" alt="cup" >
              <input type="email" placeholder="Shared Room" id="exampleInputEmail2" class="form-control cup">
            </div>-->
       </div>
       <div class="clearfix"></div>
	   <!--
       <h4 class="position-center private-room padding-bot-20" id="demo2"> You’re renting a private room within a home. <script>
			function myFunction()
			{
				var x1 = document.getElementById("po1").options[po1.selectedIndex].innerHTML;
				document.getElementById("demo2").innerHTML="You are renting " + x1 +" room";
			}
		</script>
		
		</h4> -->
		</div>
       
       <div class="row bor-bottom padding-bot-20">
     
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
      <h3 class="heading-small">City</h3>
      	<div class="form-group relative-pos"> <img class="cup-img" src="<?php echo base_url()?>public/images/loc.png" alt="cup" >
             <!--  <input type="text" placeholder="City" id="exampleInputEmail2" name="city" class="form-control cup"> -->
			 <input type="text" class="cities typeahead form-control" id="citiesInput" />
			 
			   <input type="hidden" placeholder="City" name="user_id" value="1">
            </div>
       </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
          <h3 class="heading-small">No. of Guests</h3>
              <select name="accommodates" class="form-control m-bot15">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
            </div>
       </div>
      <!-- <a href="#" class="button-pink btn btn-default"> Continue</a> -->
	   <input class="button-pink btn btn-default" type="submit" value="Continue" />
      
    </div>
  </div>
  </form>
  <div class="sec-02 padding-bot-20">
  		<div class="container">
        	<div class="row padding-top-10">
            <div class="big-text-outer">
            	<h1 class=" jumbo-txt  text-center">A Safe & Pleasurable Journey! </h1>
                <p class="position-center text-center font-16" > Your trip ought to be filled with the peace of mind that you seek, that’s what we believe. We want to help make this a trip where all you need to focus on is the journey at hand. </p>
               </div>
            </div>
        </div>
  </div>
  <div class="sec-02 padding-top-10 ">
  	<div class="container">
    	<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            	<div class="box-img-outer">
                	<img src="<?php echo base_url()?>public/images/icon-01.png" alt=" ">
                    <h2 class="round-text-heading">Indian<br />Hospitality</h2>
                    <h4 class="color-pink"><a href="#">Know more</a></h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            	<div class="box-img-outer">
                	<img src="<?php echo base_url()?>public/images/shield.png" alt=" ">
                    <h2 class="round-text-heading">Rentnroam <br />Benefits</h2>
                    <h4 class="color-pink"><a href="#">Know more</a></h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            	<div class="box-img-outer">
                	<img src="<?php echo base_url()?>public/images/pad.png" alt=" ">
                    <h2 class="round-text-heading">Rentnroam <br />Guarantee</h2>
                    <h4 class="color-pink"><a href="#">Know more</a></h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            	<div class="box-img-outer">
                	<img src="<?php echo base_url()?>public/images/thumb.png" alt=" ">
                    <h2 class="round-text-heading">Home <br />Safety</h2>
                    <h4 class="color-pink"><a href="#">Know more</a></h4>
                </div>
            </div>
        </div>
    </div>
  </div>
<div class="footer">
	<div class="container">
    	<div class="row">
            <div class="footer-space"></div>
        	<div class="col-lg-7 col-md-7 col-sm-7">
            	<div class="col-sm-4 col-xs-6 ">
                	<div class="footer-box-small">
                    	<h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                        
                        <h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                <div class="footer-box-small">
                    	<h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                        
                        <h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-6">
                <div class="footer-box-small">
                    	<h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                        
                        <h5>See Homes</h5>
                        <ul class="list-unstyled">
                        	<li><a href="#">Alibaug</a></li>
                            <li><a href="#">Panchgani</a></li>
                            <li><a href="#">Mumbai</a></li>
                            <li><a href="#">Lonavala</a></li>
                            <li><a href="#">Mahabaleshwar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="footer-box-big">
                <h1>Contact</h1>  
                <p class="call">Call us on:  +1800 8388 3989<span>|</span>Email us on: support@rnr.com</p>
                <div class="currency-outer">
                    <h1>Set your Currency</h1>
                    <div class="clearfix"></div>
                    <div class="btn-group currnecy-inner">
  <button type="button" class="btn btn-default big-field">$ AUD</button>
  <button type="button" class=" small-field dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-angle-down color-white"></i>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>
                </div>
                <div class="clearfix"></div>
                <ul class="list-inline social-list padding-top-10">
                    <li><p>Join Us on</p></li>
                <li><a href="#"><span class="twitter social-box"><img src="images/social.png"></span></a></li>
                <li><a href="#"><span class="fb social-box"><img src="images/social.png"></span></a></li>
                <li><a href="#"><span class="rss social-box"><img src="images/social.png"></span></a></li>
                <li><a href="#"><span class="g-plus social-box"><img src="images/social.png"></span></a></li>
                    
                </ul>
            </div>
            </div>
        </div>
    </div>
    
</div>

<!--Core js--> 
<script src="<?php echo base_url()?>public/bs3/js/jquery.js"></script> 
<script src="<?php echo base_url()?>public/bs3/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>public/bs3/js/jquery-ui.min.js"></script> 

<!--common script init for all pages--> 
<script src="<?php echo base_url()?>public/bs3/js/scripts.js"></script>
<script>
	$(document).ready(function(){
		
		var Cities = [];
		
		 $.getJSON('http://localhost/rent_n_roam/trunk/rentnroam/host/extractCity', function(data) {
			$.each(data, function(index) {
				Cities.push(data[index].city);
			});
		});
	
		$(".custom-radio-room").tooltip();
		$(".custom-radio").click(function(){
			$("#property_type_value").val($(this).attr('id'));
		});
		$('.cities.typeahead').autocomplete({
			source: Cities
		});
	});
</script>
</body>
</html>
