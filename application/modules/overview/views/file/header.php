<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RentNRoam | Overview</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="description" content="">
<meta name="author" content="">

<script type="text/javascript">
				var BASE_URL = '<?php echo base_url().index_page();?>';
				
</script>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<!-- Including CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>public/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery.bxslider.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/default.css" type="text/css" />



<style type="text/css">
#overview-hero-wrapper .bx-wrapper .bx-pager {
	padding-left: 525px;
}
.slider-count {
	left: 65% !important;
}
</style>
</head>

<body id="inner-page">
<div id="filter-dropdown" class="col-md-12">
	<div class="filter-container">
		<form class="form-horizontal">
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>ROOM TYPE</h3>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        Entire Place 
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        Private Room
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        Shared Room
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>property TYPE</h3>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        Apartment
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        House
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div id="Apartment" class="custom-radio">
                        Bed & Breakfast
                        <img class="pull-right" alt="Image Error" src="<?php echo base_url()?>public/images/building.png">
                    </div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>price range</h3>
				</div>
				<div class="col-md-9 no-side-margin mod-pad">
					<!-- <input type="range" class="no-side-margin filter-range"> -->
					<!-- <input type="text" id="amount" readonly class="filter-range"> -->
					<div id="slider-range"></div>
					<p>
						<i class="fa fa-inr pull-left"></i><span id="min-value" class="pull-left"></span>
						 <span id="max-value" class="pull-right"></span> <i class="fa fa-inr pull-right"></i> 
					</p>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>Property TYPE</h3>
				</div>
				<div class="col-md-3 no-side-margin">
					<div class="styled-select">
                        <select class="form-control">
                            <option value="1">Bedroom</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div class="styled-select">
                        <select class="form-control">
                            <option value="1">Beds</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
				</div>
				<div class="col-md-3 no-side-margin">
					<div class="styled-select">
                        <select class="form-control">
                            <option value="1">Bathrooms</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>amenities</h3>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check1" type="checkbox" value="check1">
					<label for="check1">Amenities</label>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check2" type="checkbox" value="check2">
					<label for="check2">Amenities</label>
				</div>
				<div class="col-md-2 no-side-margin mod-pad">
					<input id="check3" type="checkbox" value="check3">
					<label for="check3">Amenities</label>
				</div>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseAmenities" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseAmenities" aria-expanded="true">
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>host language</h3>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check1" type="checkbox" value="check1">
					<label for="check1">Amenities</label>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check2" type="checkbox" value="check2">
					<label for="check2">Amenities</label>
				</div>
				<div class="col-md-2 no-side-margin mod-pad">
					<input id="check3" type="checkbox" value="check3">
					<label for="check3">Amenities</label>
				</div>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseLanguage" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseLanguage" aria-expanded="true">
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>area</h3>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check1" type="checkbox" value="check1">
					<label for="check1">Amenities</label>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check2" type="checkbox" value="check2">
					<label for="check2">Amenities</label>
				</div>
				<div class="col-md-2 no-side-margin mod-pad">
					<input id="check3" type="checkbox" value="check3">
					<label for="check3">Amenities</label>
				</div>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseArea" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseArea" aria-expanded="true">
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>tags</h3>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check1" type="checkbox" value="check1">
					<label for="check1">Amenities</label>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check2" type="checkbox" value="check2">
					<label for="check2">Amenities</label>
				</div>
				<div class="col-md-2 no-side-margin mod-pad">
					<input id="check3" type="checkbox" value="check3">
					<label for="check3">Amenities</label>
				</div>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseTags" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseTags" aria-expanded="true">
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>cancellation policy</h3>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check1" type="checkbox" value="check1">
					<label for="check1">Amenities</label>
				</div>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="check2" type="checkbox" value="check2">
					<label for="check2">Amenities</label>
				</div>
				<div class="col-md-2 no-side-margin mod-pad">
					<input id="check3" type="checkbox" value="check3">
					<label for="check3">Amenities</label>
				</div>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapsePolicy" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapsePolicy" aria-expanded="true">
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
						<div class="col-md-4">
							<input id="check1" type="checkbox" value="check1">
							<label for="check1">Amenities</label>
						</div>
						<div class="col-md-4 secondCheck">
							<input id="check2" type="checkbox" value="check2">
							<label for="check2">Amenities</label>
						</div>
						<div class="col-md-4 thirdCheck">
							<input id="check3" type="checkbox" value="check3">
							<label for="check3">Amenities</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-3 no-side-margin mod-pad">
				<a href="#" class="btn-pink" id="applyFilters">APPLY FILTERS</a>
			</div>
			<div class="col-md-3 no-side-margin mod-pad">
				<a href="#" class="btn-pink" id="closeFilter">CANCEL</a>
			</div>
		</form>
	</div>
</div>
<div id="filter-dropdown" class="col-md-12 results">
	<div class="filter-container">
		<div class="searchCriteria btn-pink">room type <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">amenities <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">Area <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">Language <i class="fa fa-times"></i></div>
	</div>
</div>
<div id="container">
	<div id="inner_container">
		<div id="header">
			<div class="centered-content main-nav">
				<a href="#" class="logo">
					<img src="<?php echo base_url()?>public/images/logo-houses.png" alt="logo-houses" class="logo-houses logo-houses-small" />
					<img src="<?php echo base_url()?>public/images/logo-text.png" alt="logo-text" class="logo-text logo-text-scroll" />
				</a>
				<form class="header-search">
					<input type="text" value="Lonavala" />
					<input type="submit" />
				</form><!-- end header-search -->
				<!-- <select class="filters">
					<option>Filters</option>
					<option>Filters</option>
					<option>Filters</option>
				</select> -->
				<div class="btn-group">
					<button id="btn-filter" class="btn btn-default btn-xs" type="button">
						Filter <i class="fa fa-chevron-down"></i>
					</button>
				</div><!-- end filters -->
				<div class="nav">
					<ul>
						  
							 <li>
                                            <?php
                                            $userDataFromSession = $this->session->userdata('user');
                                            if ($userDataFromSession) {
                                                $userName = $userDataFromSession['first_name'] . ' ' . $userDataFromSession['last_name'];
                                                $profilePic = $userDataFromSession['profile_pic'] ? $userDataFromSession['profile_pic'] : 'icon-01.png';
                                                $profilePicUrl = (strstr($profilePic, 'http://')) ? $profilePic : base_url() . '/public/uploads/user_image/' . $profilePic;
                                            ?>
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                <div class="avtaar-outer"> <img alt="" src="<?php echo $profilePicUrl; ?>"> </div>
                                                <span class="username">Welcome, <?php echo $userName; ?></span> <i class="fa fa-angle-down"></i> 
                                            </a>
                                            
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
                                                <li><a href="<?php echo site_url('/overview/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                                                <?php
                                                endif;
                                                ?>
												<?php
                                            } else {
                                            ?>
                                            <li class="signup"><a href="javascript:void(0)" onclick = "load_registration_popup();">Sign up</a></li>
                                            <li class="login"><a href="javascript:void(0)" onclick = "load_login_popup();">Login</a></li>
                                            <?php
                                            }                                            
                                            ?>                                            
                                        
                                            
                                            
						</li>

					
							
					</ul>
				</div><!-- end nav -->