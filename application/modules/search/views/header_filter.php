<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RentNRoam | Search</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="description" content="">
<meta name="author" content="">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script type="text/javascript">
	var BASE_URL = '<?php echo base_url().index_page();?>';
</script>
<link rel="stylesheet" href="<?php echo base_url()?>public/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery.bxslider.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/css/filter.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url()?>public/js/date.js"></script>
<style type="text/css">
/*#overview-hero-wrapper .bx-wrapper .bx-pager {
	padding-left: 200px;
}*/

/* RAIKUMR */
.comment {
	width: 100%;
}
a.morelink {
	text-decoration:none;
	color:#D80000;
	outline: none;
}
.morecontent span {
	display: none;
}

/*ajax call text to add more funcitnality*/
.comment1 {
	width: 100%;
}
a.morelink1 {
	text-decoration:none;
	color:#D80000;
	outline: none;
}
.morecontent1 span {
	display: none;
}

.input_hidden {
    position: absolute;
    left: -9999px;
}

.selected {
    background-color: #F7BE81;
}

#sites label {
    display: inline-block;
    cursor: pointer;
}


#sites label:hover {
    background-color: #E1F5A9;
}

#sites label img {
    padding: 3px;
    
}
.slider-price {
	width: 393px;
}
.slider-price .small {
	float: right;
	font-size: 15px !important;
    padding-top: 7px;
}
.slider-count {
	left: 65% !important;
}
.bx-pager-item {
	margin-left: 10px;
}


/* Hide all the children of the 'loading' element */
.loading  {
    display: none;  
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:1000;
    /*background-color:grey;*/
    opacity: .8;
}


.ajax-loader {
    position: absolute;
    left: 50%;
    top: 50%;
    margin-left: -32px; /* -1 * image width / 2 */
    margin-top: -32px;  /* -1 * image height / 2 */
    display: block;     
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
				<?php
					if(!empty($room_type))
						{
							foreach($room_type as $row)
							{
				?>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="roomtype_<?php echo $row->room_type_id; ?>" type="checkbox" value="<?php echo $row->room_type_id; ?>" name="roomtype">
					<label for="roomtype_<?php echo $row->room_type_id; ?>"><?php echo $row->roomtype; ?></label>
				</div>
				<?php
							}
						}
				?>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>property TYPE</h3>
				</div>
				<?php
					if(!empty($property_type))
						{
							foreach($property_type as $row)
							{
				?>
			<div class="col-md-3 no-side-margin mod-pad">
					<input id="propertytype_<?php echo $row->property_type_id; ?>" type="checkbox" value="<?php echo $row->property_type_id; ?>" name="propertytype">
					<label for="propertytype_<?php echo $row->property_type_id; ?>"><?php echo $row->property_type; ?></label>
				</div>
				<?php
							}
						}
						?>
				
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>price range</h3>
				</div>
				<div class="col-md-9 no-side-margin mod-pad">
					<!-- <input type="range" class="no-side-margin filter-range"> -->
					 <input type="hidden" id="amount" readonly class="slider-range"> 
					<div id="slider-range"></div>
					<p>
						<i class="fa fa-inr pull-left"></i><span id="min-value" value="" class="pull-left"></span>
						 <span id="max-value" value = "" class="pull-right"></span> <i class="fa fa-inr pull-right"></i> 
					</p>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>property TYPE</h3>
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
				<?php
					if(!empty($amenities))
					{
						$i=0;
						foreach($amenities as $row)
						{
							if($i<=2)
							{
				?>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="amenities_<?php echo $row->amenities_id; ?>" type="checkbox" value="<?php echo $row->amenities_id; ?>" name="amenities">
					<label for="amenities_<?php echo $row->amenities_id; ?>"><?php echo $row->amenities_subtype; ?></label>
				</div>
				<?php
							}
				$i++;
				}
					}
					?>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseAmenities" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseAmenities" aria-expanded="true">
					<?php
					if(!empty($amenities1))
					{
						$i=1;
						foreach($amenities1 as $row)
						{
							if ($i>=4)
    {
							
				?>
						<div class="col-md-4">
							<input id="amenities_<?php echo $row->amenities_id; ?>" type="checkbox" value="<?php echo $row->amenities_id; ?>" name="amenities">
					<label for="amenities_<?php echo $row->amenities_id; ?>"><?php echo $row->amenities_subtype; ?></label>
				</div>
							<?php
		}
				$i++;
				}
					}
					?>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>host language</h3>
				</div>
				<?php
					if(!empty($language))
					{
						$i=0;
						foreach($language as $row)
						{
							if($i<=2)
							{
				?>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="language_<?php echo $row->id; ?>" type="checkbox" value="<?php echo $row->id; ?>" name="language">
					<label for="language_<?php echo $row->id; ?>"><?php echo $row->language; ?></label>
				</div>
				<?php
							}
				$i++;
				}
					}
					?>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseLanguage" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseLanguage" aria-expanded="true">
					<?php
					if(!empty($language))
					{
						$i=1;
						foreach($language as $row)
						{
							if ($i>=4)
    {							
				?>
						<div class="col-md-4">
							<input id="language_<?php echo $row->id; ?>" type="checkbox" value="<?php echo $row->id; ?>" name="language">
					<label for="language_<?php echo $row->id; ?>"><?php echo $row->language; ?></label>
				
						</div>
						<?php
							}
				$i++;
				}
					}
					?>
					</div>
				</div>
			</div>
			<!--<div class="col-md-12 no-side-margin filter-row">
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
			</div>-->
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>tags</h3>
				</div>
					<?php
					if(!empty($tags))
					{
						$i=0;
						foreach($tags as $row)
						{
							if($i<=2)
							{
				?>
				<div class="col-md-3 no-side-margin mod-pad">
					<input id="tag_<?php echo $row->id?>" type="checkbox" value="<?php echo $row->id; ?>" name="tag">
					<label for="tag_<?php echo $row->id?>"><?php echo $row->tag; ?></label>
				</div>
					<?php
							}
				$i++;
				}
					}
					?>
				<div class="col-md-1 no-side-margin mod-pad">
					<i class="fa fa-chevron-down pull-right" data-toggle="collapse" href="#collapseTags" aria-expanded="false" aria-controls="collapseExample"></i>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-9 col-md-offset-3">
					<div class="collapse" id="collapseTags" aria-expanded="true">
						<?php
					if(!empty($tags))
					{
						$i=1;
						foreach($tags as $row)
						{
							if ($i>=4)
    			{							
				?>
						<div class="col-md-4">
							<input id="tag_<?php echo $row->id?>" type="checkbox" value="<?php echo $row->id; ?>" name="tag">
					<label for="tag_<?php echo $row->id?>"><?php echo $row->tag; ?></label>
						</div>
						<?php
							}
				$i++;
				}
					}
					?>
					</div>
				</div>
			</div>
			<div class="col-md-12 no-side-margin filter-row">
				<div class="col-md-3 no-side-margin filter-lbl">
					<h3>cancellation policy</h3>
				</div>
					<?php
					if(!empty($cancellation_policy))
						{
							foreach($cancellation_policy as $row)
							{
				?>
				<div class="col-md-2 no-side-margin mod-pad whiteClr">
			<input type="radio" class="" name="policy" id="policy" value="<?php echo $row->id; ?>"><?php echo $row->policy; ?>
			</div>
				<?php
							}
						}
						?>
			</div>
			<div class="col-md-2 col-md-offset-3 no-side-margin mod-pad">
				<a href="javascript:void(0);" class="btn-pink" id="applyFilters" onclick="search_property();refresh_records();">APPLY FILTERS</a>
			</div>
			<div class="col-md-2 no-side-margin mod-pad">
				<a href="#" class="btn-pink" id="clearFilter">CLEAR</a>
			</div>
			<div class="col-md-2 no-side-margin mod-pad">
				<a href="javascript:void(0);" class="btn-pink" id="closeFilter">CANCEL</a>
			</div>
		</form>
	</div>
</div>
<!---
<div id="filter-dropdown" class="col-md-12 results">
	<div class="filter-container">
		<div class="searchCriteria btn-pink">room type <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">amenities <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">Area <i class="fa fa-times"></i></div>
		<div class="searchCriteria btn-pink">Language <i class="fa fa-times"></i></div>
	</div>
</div>-->
<div id="container" class="fltr-cntn">
	<div id="inner_container">
		<div id="header">
			<div class="centered-content main-nav">
				<a href="#" class="logo">
					<img src="<?php echo base_url()?>public/images/logo-houses.png" alt="logo-houses" class="logo-houses logo-houses-small" />
					<img src="<?php echo base_url()?>public/images/logo-text.png" alt="logo-text" class="logo-text logo-text-scroll" />
				</a>
				<form class="header-search" method="post" action="<?php echo  base_url()?>search/searchresult">
					<input type="text" autocomplete="off" id="autocomplete_city" name= "autocomplete_city" value="<?php echo $city; ?>" />
					<input id="btn-dropdown" type="submit"  class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
					<div id="dropdown-form" class="dropdown-menu">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4 no-padding">
									<div class="form-group">
										<label for="checkinDate">check in</label>
										<input type="text" class="form-control datepicker boot-datepicker" id="checkInDate" placeholder="Check In">
									</div>
								</div>
								<div class="col-md-4 no-padding">
									<div class="form-group">
										<label for="checkOutDate">check out</label>
										<input type="text" class="form-control datepicker" id="checkOutDate" placeholder="Check Out">
									</div>
								</div>
								<div class="col-md-4 no-padding">
									<label>Guest</label>
									<div class="styled-select">
										<select>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
									</div><!-- end styled-select -->
								</div>
								<div id="grey-band" class="col-md-12">
									<p>Room Type</p>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-4 circle-room-type circle-room-type-one no-padding">
									<img src="<?php echo base_url()?>public\images\property_type\home.png"/>
									<p>entire<br/>place</p>
								</div>
								<div class="col-md-4 circle-room-type no-padding">
									<img src="<?php echo base_url()?>public\images\property_type\home.png"/>
									<p>private<br/>room</p>
								</div>
								<div class="col-md-4 circle-room-type no-padding">
									<img src="<?php echo base_url()?>public\images\property_type\home.png"/>
									<p>shared<br/>room</p>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-12 bottom-btn">
									<p>Find a place</p>
								</div>
							</div>
						</div>
					</div>
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
				</div>
				<!-- end filters -->
					<div class="nav">
					<ul>
							 <li>
                                            <?php
                                            $userDataFromSession = $this->session->userdata('user');
                                            if ($userDataFromSession) {
											//print_r($userDataFromSession);
                                                $userName = $userDataFromSession['first_name'] . ' ' . $userDataFromSession['last_name'];
                                               // $profilePic = $userDataFromSession['profile_pic'] ? $userDataFromSession['profile_pic'] : 'icon-01.png';
                                               // $profilePicUrl = (strstr($profilePic, 'http://')) ? $profilePic : base_url() . '/public/uploads/user_image/' . $profilePic;
                                            ?>
                                            <div class="dropdown">
                                            <a id="userOptionsDropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                                               
                                                <span class="username">Welcome, <?php echo $userName; ?></span> <i class="fa fa-angle-down"></i> 
                                            </a>
                                          
                                            	 <ul class="dropdown-menu extended logout">
                                            
                                                <li><a href="<?php echo site_url('/host/profile/dashboard'); ?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
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
                                                <li><a href="<?php echo site_url('/search/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                                                <?php
                                                endif;
                                                ?>
                                                </ul>
                                                </div>
												<?php
                                            } else {
                                            ?>
                                            <li class="signup"><a href="javascript:void(0)" onclick = "load_registration_popup();">Sign up</a></li>
                                            <li class="login"><a href="javascript:void(0)" onclick = "load_login_popup();">Login</a></li>
											
											<?php
                                            }                                            
                                            ?>                                            
                        </li>
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
		

		<script type="text/javascript">
			function refresh_records()
		{
				$.post(BASE_URL+'search/refreshRecord',
			{
				
			},
				function(data)
				{
					$('#update_count').html(data);     
				});
			
		}
		function search_property()
			{
				var autocomplete_city = $('#autocomplete_city').val();
				//var amount = $('#amount').val();
				var min_package = $('#min-value').text();
				var max_package = $('#max-value').text();
				var roomtype = new Array();
				$("input:checkbox[name=roomtype]:checked").each(function()
				{
					roomtype.push($(this).val());		
				});
				var propertytype = new Array();
				$("input:checkbox[name=propertytype]:checked").each(function()
				{
					propertytype.push($(this).val());		
				});
				var bedroom = $("#bedroom option:selected").val();
				var bed = $("#bed option:selected").val();
				var bathroom = $("#bathroom option:selected").val();
				var amenities = new Array();
				$("input:checkbox[name=amenities]:checked").each(function()
				{
					amenities.push($(this).val());		
				});
				var language = new Array();
				$("input:checkbox[name=language]:checked").each(function()
				{
					language.push($(this).val());		
				});
				var tag = new Array();
				$("input:checkbox[name=tag]:checked").each(function()
				{
					tag.push($(this).val());		
				});
				var policy = $("input[name=policy]:checked").val()
				var error_flag = 0;
				var offset = 0;
				var option = 'filter';
				//console.log(amount);
				if(autocomplete_city == '')
				{
					var html = 'Please Enter City Name.';
					alert(html);
					error_flag = 1; 
				}
				if(error_flag != 1) 
				{
					$.post(BASE_URL+'search/searchresult',
					{
						'autocomplete_city' : autocomplete_city,
						'room_type' : roomtype,
						'property_type' : propertytype,
						'bedroom' : bedroom,
						'bed' : bed,
						'bathroom' : bathroom,
						'amenities' : amenities,
						'offset': offset,
						'option': option,
						'language' : language,
						'policy' : policy,
						'max_package' : max_package,
						'min_package': min_package,
						'tag' : tag
					},
						function(data)
						{
							$('#filter').html(data);     
						});
					
				}
			}
			
			//become a host click
			function to_createProperty()
			{
				window.location = BASE_URL+"host/createproperty";  
			}
		
</script>

