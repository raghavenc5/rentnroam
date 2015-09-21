<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
		<!--google map--->
		
		<!---google Map end-->
        <link rel="shortcut icon" href="<?php echo base_url()?>public/images/favicon.png">
        <title><?php echo $title;?></title>
        <!--Core CSS -->
        <link href="<?php echo base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>public/css/jquery-ui.min.css" rel="stylesheet">
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!--    <link href="css/bootstrap-reset.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url()?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url()?>public/css/style-responsive.css" rel="stylesheet" />
         <script>
        var base_url = '<?php echo base_url(); ?>';
        </script>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

         <!--<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
        <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
		
        <!-- <link rel="stylesheet" href="public/css/jquery-ui.min.css"> -->
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body ng-app="rnr" style="background-color: #ffffff;" id="Focus1" tabindex="1">
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix" >
                <div class="container-fluid">
                    <div class="row">
                        <!--logo start-->
                        <div class="brand">
                            <a href="#" class="logo"> <img src="<?php echo base_url()?>public/images/logo.png" alt=""> </a> 
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
                                <div class="nav notify-row" id="top_menu">
                                    <!--  notification start -->
                                    <ul class="nav pull-right top-menu">
                                        <!-- user login dropdown start-->
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <div class="avtaar-outer"> <img alt="" src="<?php echo base_url()?>public/images/avatar1_small.jpg"> </div>
                                                <span class="username">Welcome, Sidz</span> <i class="fa fa-angle-down"></i> 
                                            </a>
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
                                                <li>
                                                    <a href="#">
                                                        <div class="task-info clearfix">
                                                            <div class="desc pull-left">
                                                                <h5>Target Sell</h5>
                                                                <p>25% , Deadline  12 June’13</p>
                                                            </div>
                                                            <span class="notification-pie-chart pull-right" data-percent="45"> <span class="percent"></span> </span> 
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="task-info clearfix">
                                                            <div class="desc pull-left">
                                                                <h5>Product Delivery</h5>
                                                                <p>45% , Deadline  12 June’13</p>
                                                            </div>
                                                            <span class="notification-pie-chart pull-right" data-percent="78"> <span class="percent"></span> </span> 
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="task-info clearfix">
                                                            <div class="desc pull-left">
                                                                <h5>Payment collection</h5>
                                                                <p>87% , Deadline  12 June’13</p>
                                                            </div>
                                                            <span class="notification-pie-chart pull-right" data-percent="60"> <span class="percent"></span> </span> 
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="task-info clearfix">
                                                            <div class="desc pull-left">
                                                                <h5>Target Sell</h5>
                                                                <p>33% , Deadline  12 June’13</p>
                                                            </div>
                                                            <span class="notification-pie-chart pull-right" data-percent="90"> <span class="percent"></span> </span> 
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="external"> <a href="#">See All Tasks</a> </li>
                                            </ul>
                                        </li>
                                        <!-- settings end --> 
                                        <!-- inbox dropdown start-->
                                        <li id="header_inbox_bar" class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-envelope-o"></i> <span class="badge bg-important">4</span> </a>
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
                                        <li id="header_notification_bar" class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="fa fa-bell-o"></i> <span class="badge bg-warning">3</span> </a>
                                            <ul class="dropdown-menu extended notification">
                                                <li>
                                                    <p>Notifications</p>
                                                </li>
                                                <li>
                                                    <div class="alert alert-info clearfix">
                                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                                        <div class="noti-info"> <a href="#"> Server #1 overloaded.</a> </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="alert alert-danger clearfix">
                                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                                        <div class="noti-info"> <a href="#"> Server #2 overloaded.</a> </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="alert alert-success clearfix">
                                                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
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
                            <div class="help pull-right"> <img src="<?php echo base_url()?>public/images/hepl-icon.png" alt=" help"> <span>HELP</span> </div>
                            <div class="how-it-outer pull-right"> <img src="<?php echo base_url()?>public/images/how-it.png" alt=" "> </div>
                        </div>
                    </div>
                    <div class="row" id="sub-nav">
                        <div class="centered-content">
                            <p><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRIVATE BUNGLOW IN PUNE</p>
                        </div>
                    </div>
                </div>
            </header>
            <!--header end--> 
        </section>
        <!--sidebar end-->