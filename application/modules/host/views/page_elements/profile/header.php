<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/favicon.png">
        <title><?php echo $title; ?></title>
        <!-- Font -->
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!--Core CSS -->
        <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="<?php echo base_url(); ?>public/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/css/dashboard.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/css/style-responsive.css" rel="stylesheet" />
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script>
            var base_url = "<?php echo base_url(); ?>";
        </script>
    </head>
    <body style="background-color: #ffffff;">
        <section id="container">
            <!--header start-->
            <header class="header fixed-top clearfix">
                <div class="container-fluid">
                    <div class="row">
                        <!--logo start-->
                        <div class="brand">
                            <a href="#" class="logo"> <img src="<?php echo base_url(); ?>public/images/logo.png" alt=""> </a> 
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
                                            <?php
                                            $userDataFromSession = $this->session->userdata('user');
                                            if ($userDataFromSession) {
                                                $userName = $userDataFromSession['first_name'] . ' ' . $userDataFromSession['last_name'];
                                                $profilePic = $userDataFromSession['profile_pic'] ? $userDataFromSession['profile_pic'] : 'icon-01.png';
                                                $profilePicUrl = (strstr($profilePic, 'https://')) ? $profilePic : base_url() . '/public/uploads/user_image/' . $profilePic;
                                            ?>
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <div class="avtaar-outer"> <img alt="" src="<?php echo $profilePicUrl; ?>"> </div>
                                                <span class="username">Welcome, <?php echo $userName; ?></span> <i class="fa fa-angle-down"></i> 
                                            </a>
                                            <ul class="dropdown-menu extended logout">
                                                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                                                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                                <?php
                                                if ('googleplus' == $userDataFromSession['user_source']):
                                                ?>
                                                <li><a href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo site_url("/home/logout/$userDataFromSession[user_source]"); ?>'><i class="fa fa-key"></i> Log Out</a></li>
                                                <?php
                                                elseif ('facebook' == $userDataFromSession['user_source']):
                                                ?>
                                                <li><a href='<?php echo $fbLogoutUrl; ?>'><i class="fa fa-key"></i> Log Out</a></li>
                                                <?php
                                                else:
                                                ?>
                                                <li><a href="<?php echo site_url('/home/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                                                <?php
                                                endif;
                                                ?>
                                            </ul>
                                            <?php
                                            } else {
                                            ?>
                                            <li class="signup"><a href="javascript:void(0)" onclick = "load_registration_popup();">Sign up</a></li>
                                            <li class="login"><a href="javascript:void(0)" onclick = "load_login_popup();">Login</a></li>
                                            <?php
                                            }                                            
                                            ?>
                                        </li>
                                        <!-- user login dropdown end -->
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
                                                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url(); ?>public/images/avatar-mini.jpg"></span> <span class="subject"> <span class="from">Jonathan Smith</span> <span class="time">Just now</span> </span> <span class="message"> Hello, this is an example msg. </span> </a> </li>
                                                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url(); ?>public/images/avatar-mini-2.jpg"></span> <span class="subject"> <span class="from">Jane Doe</span> <span class="time">2 min ago</span> </span> <span class="message"> Nice admin template </span> </a> </li>
                                                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url(); ?>public/images/avatar-mini-3.jpg"></span> <span class="subject"> <span class="from">Tasi sam</span> <span class="time">2 days ago</span> </span> <span class="message"> This is an example msg. </span> </a> </li>
                                                <li> <a href="#"> <span class="photo"><img alt="avatar" src="<?php echo base_url(); ?>public/images/avatar-mini.jpg"></span> <span class="subject"> <span class="from">Mr. Perfect</span> <span class="time">2 hour ago</span> </span> <span class="message"> Hi there, its a test </span> </a> </li>
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
                            <div class="help pull-right"> <img src="<?php echo base_url(); ?>public/images/hepl-icon.png" alt=" help"> <span>HELP</span> </div>
                            <div class="how-it-outer pull-right"> <img src="<?php echo base_url(); ?>public/images/how-it.png" alt=" "> </div>
                        </div>
                    </div>
                    <div class="row" id="sub-nav">
                        <div class="centered-content">
                            <div class="col-md-1">
                                <p><a href="#">overview</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">my bookings</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">my trips</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">favourites</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">credits</a></p>
                            </div>
                            <div class="col-md-1 active">
                                <p><a href="#">profile</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">account</a></p>
                            </div>
                            <div class="col-md-1">
                                <p><a href="#">invite friends</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!--header end--> 
        </section>
        <!--sidebar end-->