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
        <!-- <link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery-ui.min.css"> -->
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body ng-app="rnr" style="background-color: #ffffff;">
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix">
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




        <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
                    <div class="col-md-2">
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">PROPERTY OVERVIEW</p>
                        </div>
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">PROPERTY PHOTO</p>
                        </div>
                        <div class="menu active-menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">CALENDAR</p>
                        </div>
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">PRICING</p>
                        </div>
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">AMENITIES</p>
                        </div>
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">LISTING</p>
                        </div>
                        <div class="menu">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            <p class="text-center">LOCATION</p>
                        </div>
                    </div>
                    <div class="col-md-10 frm-container">
                        <div class="header-row">
                            <p class="header-text">
                                COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                <span class="pull-right">
                                    <img src="<?php echo base_url()?>public/images/home.png" alt=" help">
                                    |
                                    <img src="<?php echo base_url()?>public/images/home.png" alt=" help">
                                </span>
                            </p>
                        </div>
                        <div class="frm-body col-md-9">
                            <form class="form-horizontal" ng-controller="frmCalendarController">
                                <h3>A title and summary displayed on your public listing page</h3>
                                <div class="select-container col-md-6 col-padding-no no-margin-left no-margin-top">
                                    <div class="styled-select pink-styled-select no-margin-left">
                                        <select class="form-control month-dropdown">
                                            <option value="1">APRIL 2015</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-padding-no">
                                    <p class="pull-right calendar-setting"><i class="fa fa-cog"></i> SETTINGS</p>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 calendar-container">
                                    <div>
                                        <!-- SPACE FOR CALENDAR -->
                                    </div>
                                    <p><img src="">RESERVATIONS</p>
                                    <p><img src="">AVAILABLE<a class="pull-right">View calendar sync instructions</a></p>
                                    <p><img src="">BLOCKED<a class="pull-right">Calendar last updated today</a></p>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
                                <div class="col-md-6 col-padding-no instant-booking">
                                    <p>Instant Booking ?</p>
                                </div>
                                <div class="col-md-6 col-padding-no instant-booking">
                                    <span><input type="checkbox"> YES<span>
                                </div>
                                <!-- Remove these save buttons they are just to check modal code -->
                                <div class="clearfix"></div>
                                <p>Note: Remove these save buttons they are just to check modal code</p>
                                <input 
                                    class="button-pink btn btn-default pull-left" 
                                    type="button" 
                                    value="Save"
                                    data-toggle="modal" data-target="#requestModal">
                                <input 
                                    class="button-pink btn btn-default pull-right" 
                                    type="button" 
                                    value="Save"
                                    data-toggle="modal" data-target="#bookingModal">
                            </form>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="requestModal" class="modal fade calendar-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <input type="text" class="form-control" value="30-04-15">
                            <span>to</span>
                            <input type="text" class="form-control" value="30-04-15">
                            <input class="btn-avbl btn btn-default pull-left margin-top-30 avbl-active" type="button" value="AVAILABLE">
                            <input class="btn-avbl btn btn-default pull-right margin-top-30" type="button" value="NOT AVAILABLE">
                            <!-- <input type="text" class="form-control margin-top-30">  -->
                            <div class="input-group margin-top-30">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                <input type="text" class="form-control" placeholder="2300" aria-describedby="basic-addon1">
                            </div>

                            <span class="margin-top-30">per night</span>
                            <textarea placeholder="Notes..." class="form-control clearfix margin-top-30" rows="3"></textarea>
                            <input class="button-pink btn btn-default pull-left margin-top-30" type="submit" value="CANCEL">
                            <input class="button-pink btn btn-default pull-right margin-top-30" type="submit" value="SAVE">
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="bookingModal" class="modal fade calendar-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <p class="modal-label margin-top-30">same-day requests</p>
                            <select class="form-control">
                                <option>I don't want same day requests</option>
                            </select>
                            <p class="modal-label margin-top-30">preparation time</p>
                            <select class="form-control">
                                <option>I don't want same day requests</option>
                            </select>
                            <p class="modal-label margin-top-30">distant requests</p>
                            <select class="form-control">
                                <option>I don't want same day requests</option>
                            </select>
                            <div class="clearfix margin-top-30"></div>
                            <div class="col-md-6 col-padding-no">
                                <p class="modal-label">Minimum stay</p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="2" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">Nights</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-padding-no">
                                <p class="modal-label">Maximum stay</p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="5" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">Nights</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <input class="button-pink btn btn-default pull-left margin-top-30" type="submit" value="SAVE">
                            <p class="margin-top-30 req-info-text"><a href="#">Add a requirement for seasons or weekends</a></p>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



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
                                <li>
                                    <p>Join Us on</p>
                                </li>
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
        <script src="<?php echo base_url()?>public/bs3/js/bootstrap.js"></script>
        <script src="<?php echo base_url()?>public/bs3/js/calendarScript.js"></script>
    </body>
</html>