<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RentNRoam</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<!-- next line is used with the responsive designs -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
	<script type="text/javascript">
				var BASE_URL = '<?php echo base_url().index_page();?>';
				
			</script>
<link rel="stylesheet" href="<?php echo base_url()?>public/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery.bxslider.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="<?php echo base_url()?>public/css/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url()?>public/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/default.css" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body>	
<div id="container">
	<div id="inner_container">
		<div id="header">
			<div class="centered-content">
				<a href="<?php echo base_url()?>" class="logo">
					<img src="<?php echo base_url()?>public/images/logo-houses.png" alt="logo-houses" class="logo-houses" />
					<img src="<?php echo base_url()?>public/images/logo-text.png" alt="logo-text" class="logo-text" />
				</a>
				<a href="javascript:void(0);" class="how-it-works">How it works</a>
				<div class="nav">
					<ul class="nav pull-right top-menu">
            <?php
            $sessionData = $this->session->userdata('user');
						 
            if (! $sessionData):
            ?>
            <li class="signup"><a href="javascript:void(0)" onclick = "load_registration_popup();">Sign up</a></li>
            <li class="login"><a href="javascript:void(0)" onclick = "load_login_popup();">Login</a></li>
            <?php
            else:
						if ($sessionData) {
						 $userName = $sessionData['first_name'] . ' ' . 
						 $sessionData['last_name'];
						 }
        	?>
					    <span class="username">Welcome, <?php echo $userName; ?></span> <i class="fa fa-angle-down"></i> 
					
        	<li><a href="<?php echo site_url('/host/dashboard'); ?>"><i class=" fa fa-suitcase"></i>Account</a></li>
    		<?php
              if ('googleplus' == $sessionData['user_source']):
            ?>
            <li class="login"><a href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo site_url("/home/logout/$sessionData[user_source]"); ?>'>Log Out</a></li>
            <?php
              else:
            ?>
            <li class="login"><a href="<?php echo $fbLogoutUrl; ?>">Log Out</a></li>
            <?php
              endif;
            endif;
            ?>
						<li class="help"><a href="#">Help</a></li>
						<?php
								$userDataFromSession = $this->session->userdata('user');
								if ($userDataFromSession) {
						?>
						<li class="host"><a href="javascript:void(0)" onclick = "to_createProperty();">Become a host</a></li>
						<?php 
						}
							else{
						?> 
						<li class="host"><a href="javascript:void(0)" onclick = "to_createProperty();">Become a host</a></li>
						<?php 
						}
						?>	
							
					
					</ul>
				</div><!-- end nav -->
				<span class="nav-trigger">Menu</span><!-- end nav-trigger -->
			</div><!-- end centered-content -->
		</div><!-- end header -->
		<script>
		function to_createProperty()
		{
			window.location = BASE_URL+"host/createproperty";
		}
		</script>
