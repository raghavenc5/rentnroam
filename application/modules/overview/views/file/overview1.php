								

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>RentNRoam | Overview</title>
<link rel="shortcut icon" href="<?php echo base_url()?>public/temp_overview/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url()?>public/temp_overview/favicon.ico" type="image/x-icon">
<meta name="description" content="">
<meta name="author" content="">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<link rel="stylesheet" href="<?php echo base_url()?>public/temp_overview/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>public/temp_overview/css/jquery.bxslider.css" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url()?>public/temp_overview/css/default.css" type="text/css" />	
</head>
	<?php
									
                                    // Base URL for the service
                                    $baseUrl = 'http://104.215.198.240/rentnroam/overview/OverviewProperty/property_id/29';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    ?>
<body id="inner-page">	
<div id="container">
	<div id="inner_container">
		<div id="header">
			<div class="centered-content">
				<a href="#" class="logo">
					<img src="<?php echo base_url()?>public/temp_overview/images/logo-houses.png" alt="logo-houses" class="logo-houses" />
					<img src="<?php echo base_url()?>public/temp_overview/images/logo-text.png" alt="logo-text" class="logo-text" />
				</a>
				<form class="header-search">
					<input type="text" value="Lonavala" />
					<input type="submit" />
				</form><!-- end header-search -->
				<select class="filters">
					<option>Filters</option>
					<option>Filters</option>
					<option>Filters</option>
				</select><!-- end filters -->
				<div class="nav">
					<ul>
						<li class="signup"><a href="#">Sign up</a></li>
						<li class="login"><a href="#">Login</a></li>
						<li class="help"><a href="#">Help</a></li>
						<li class="host"><a href="#">Become a host</a></li>
					</ul>
				</div><!-- end nav -->
				<span class="nav-trigger">Menu</span><!-- end nav-trigger -->
			</div><!-- end centered-content -->
		</div><!-- end header -->
		<div id="overview-hero-wrapper">
			<ul class="overview-hero-slider">
				<!-- <li><img src="http://localhost/rent_n_roam/trunk/rentnroam/public/temp_overview/css/img/mid-section-bg.jpg"></li> -->
				<?php  foreach($jsonDataObject->images as $option)
					{
						echo  '<li><img src='.$option->image.'></li>';
					}	

				?>
				
			</ul><!-- end overview-hero-slider -->
			<div class="overview-hero-content">
				<span class="visited">You visited this property last Dec 13</span><!-- end visited -->
				<div class="slider-price">
					<span>₹<?php $price = $jsonDataObject->prices->seasonalPrices->dailyPrice;
					$trimmed = str_replace('Rs ', '', $price);
					echo $trimmed; ?></span>
					<span class="small">*per night</span><!-- end small -->
				</div><!-- end slider-price -->
			</div><!-- end overview-hero-content -->
		</div><!-- end overview-hero-wrapper -->
		<div class="main-content">
			<div class="yellow-section">
				<div class="centered-content group">
					<div class="basic-room-info equal-heights">
						<h2><?php echo $jsonDataObject->title; ?></h2>
						<h3><?php echo $jsonDataObject->area; ?>, <?php echo $jsonDataObject->city; ?>, <?php echo $jsonDataObject->state; ?></h3>
						<div class="group">
							<ul class="info-icons">
								<li class="map"><a href="#">Map</a></li><!-- end map -->
								<li class="smiley"><a href="#">Map</a></li><!-- end smiley -->
								<li class="fav"><a href="#">Map</a></li><!-- end fav -->
							</ul><!-- end info-icons -->
							<span class="reviews">124 reviews</span>
						</div><!-- end group -->
						<ul class="room-info">
							<li class="guests"><?php echo $jsonDataObject->space->accommodates; ?> Guests</li>
							<li class="rooms"><?php echo $jsonDataObject->space->bedrooms; ?> Rooms</li>
							<li class="beds"><?php echo $jsonDataObject->space->bed; ?> Beds</li>
						</ul><!-- end room-info -->
					</div><!-- end basic-room-info -->
					<div class="basic-host-info equal-heights">
				
						<img src="<?php echo $jsonDataObject->hostProfilePic; ?>" alt="host" />
						<span class="hosted-by">Hosted by</span><!-- end hostedby -->
						
						            <?php
						            echo '<span class="host-name">';
                                    
                                    //foreach($jsonDataObject as $option){
                                    echo $jsonDataObject->hostName;  
                                            //echo '<input class="form-control custom-radio" type="radio" name="property_type" value=' . $option->property_type . '>' . $option->property_type;
                                	//	}
                                    echo "</span>";        
                                  
                                    ?>  		

						<!-- end host-name -->
						<a href="#" class="btn-pink">Know more</a><!-- end btn-pink -->
						<a href="#" class="btn-pink">Contact Host </a><!-- end btn-pink -->
					</div><!-- end basic-host-info -->
					<div class="booking-section equal-heights">
						<form class="check-in-out">
							<ul>
								<li>
									<label>Check in</label>
									<input type="text" value="28-03-15" class="datepicker" />
								</li>
								<li>
									<label>Check out</label>
									<input type="text" value="28-03-15" class="datepicker" />
								</li>
								<li>
									<label>Guest</label>
									<div class="styled-select">
										<select>
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
									</div><!-- end styled-select -->
								</li>
							</ul>
						</form><!-- end check-in-out -->
						<table class="price-calculation">
							<tr>
								<td>₹ 4550 x 5 nights</td>
								<td>₹ 28569</td>
							</tr>
							<tr>
								<td>Service Fee + Taxes</td>
								<td>₹ 2228</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>₹ 30797</td>
							</tr>
						</table><!-- end price-calculation -->
						<div class="booking-footer">
							<a href="#">Request to Book</a>
						</div><!-- end booking-footer -->
					</div><!-- end booking-section -->
				</div><!-- end centered-content -->
			</div><!-- end yellow-section -->
			<div class="centered-content">
				<h2>Description</h2>
				<p>
					<?php echo $jsonDataObject->policy->description; ?><a href="#">more +</a>
				</p>
				<div class="grid-row">
					<div class="space-cell equal-heights2">
						<h2>Space</h2>
						<table>
							<tr>
								<td>Property type:</td>
								<td><?php echo $jsonDataObject->space->propertyType; ?></td>
							</tr>
							<tr>
								<td>Accommodates:</td>
								<td><?php echo $jsonDataObject->space->accommodates; ?></td>
							</tr>
							<tr>
								<td>Bedrooms:</td>
								<td><?php echo $jsonDataObject->space->bedrooms; ?></td>
							</tr>
							<tr>
								<td>Bathrooms:</td>
								<td><?php echo $jsonDataObject->space->bathrooms; ?></td>
							</tr>
							<tr>
								<td>Beds:</td>
								<td><?php echo $jsonDataObject->space->bed; ?></td>
							</tr>
						</table>
					</div><!-- end space-cell -->
					<div class="amenities-cell equal-heights2">
						<div>
							<h2>Amenities</h2>
							<?php echo '<a href="#" class="more">more +</a>'; ?>
						</div>
						<div style="clear:both;"></div>
						<div class="amenities common">
							
							<table>
							<th> COMMON</th>						
							<?php foreach($jsonDataObject->amenities as $option)
								 {
								  echo '<tr>';
                                  if($option->rnr_amenities_type == 'COMMON')
                                  {
                                  	echo '<td>'.$option->rnr_amenities_subtype.'</td>';
                                  	echo '<td><img src='.$option->image_path.'></td>';
                                  }
                                  echo '</tr>';
                              }
							?>
							</table>
						</div>

						<div class="amenities feature">
							
								<table>
								<th>FEATURES</th>
							<?php foreach($jsonDataObject->amenities as $option)
                                 {	
                                  echo '<tr>';
                                  if($option->rnr_amenities_type == 'FEATURES')
                                  {
                                  	echo '<td>'.$option->rnr_amenities_subtype.'</td>';
                                  	echo '<td><img src='.$option->image_path.'></td>';
                                  }
                                  echo '</tr>';
                              }
							?>
							</table>
						</div>
						<div class="amenities extra">
							
								<table>
								<th>EXTRAS</th>
							<?php foreach($jsonDataObject->amenities as $option)
								  {	
                                  echo '<tr>';
                                  if($option->rnr_amenities_type == 'EXTRAS')
                                  {
                                  	echo '<td>'.$option->rnr_amenities_subtype.'</td>';
                                  	echo '<td><img src='.$option->image_path.'></td>';
                                  }
                                  echo '</tr>';
                              	}
							?>
							</table>
						</div>
						
						
					</div><!-- end amenities-cell -->
				</div><!-- end grid-row -->
				<div class="grid-row">
					<div class="timings-cell equal-heights3">
						<h2>Timings</h2>
						<table>
							<tr>
								<td>Check in:</td>
								<td><?php echo $jsonDataObject->checkTime->checkIn; ?></td>
							</tr>
							<tr>
								<td>Check out:</td>
								<td><?php echo $jsonDataObject->checkTime->checkOut; ?></td>
							</tr>
						</table>
					</div><!-- end timings-cell -->
					<div class="price-cell equal-heights3">
						<h2>Price</h2>
						<table>
							<tr>
								<td>One Extra Person:</td>
								<td>₹  <?php 
								$guestPrice = $jsonDataObject->prices->guest_charge; 
								$trimmed1 = str_replace('Rs ', '', $guestPrice);
								echo $trimmed1;	
								?> / night after the first guest</td>
							</tr>
							<tr>
								<td>Security Deposit:</td>
								<td>₹ <?php $securityPrice = $jsonDataObject->prices->security_deposit;
									  $trimmed2 = str_replace('Rs ', '', $securityPrice);
									  echo $trimmed2;		
								 ?></td>
							</tr>
							<tr>
								<td>Weekly Price:</td>
								<td>₹ <?php $weeklyPrice1 = $jsonDataObject->prices->seasonalPrices->weeklyPrice;
											$trimmed3 = str_replace('Rs ', '', $weeklyPrice1);
									  		echo $trimmed3;
								 ?> /week</td>
							</tr>
							<tr>
								<td>Monthly Price:</td>
								<td>₹ <?php $monthlyPrice1 = $jsonDataObject->prices->seasonalPrices->monthlyPrice;
										    $trimmed4 = str_replace('Rs ', '', $monthlyPrice1);
									  		echo $trimmed4;	
								 ?> /month</td>
							</tr>
						</table>
					</div><!-- end price-cell -->
					<div class="cancellation-cell equal-heights3">
						<h2>CANCELLATION</h2>
						<h3><?php echo $jsonDataObject->policy->cancellation_policy; ?></h3>
						<p>
							<?php echo $jsonDataObject->policy->houseRule; ?>
						</p>
					</div><!-- end cancellation-cell -->
				</div><!-- end grid-row -->
				<h2>House Rules</h2>
				<p>
					<span class="upper"><?php echo $jsonDataObject->policy->min_night_stay; ?> nights minimum stay.</span><br />
					<?php echo $jsonDataObject->policy->houseRule; ?>
Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</p>
			</div><!-- end centered-content -->
			<div id="map-wrapper"></div><!-- end map-wrapper -->
			<div class="gray-section">
				<div class="centered-content group">
					<h2>ABOUT THE HOST</h2>
					<div class="about-host">
						<img src="<?php echo $jsonDataObject->hostProfilePic; ?>" alt="host" class="host-photo" />
						<div class="host-details">
							<h3><?php echo $jsonDataObject->hostName; ?></h3>
							<span class="location"><?php echo $jsonDataObject->area; ?>, <?php echo $jsonDataObject->state; ?></span><!-- end location -->
							<span class="member-since">Member since, <?php $datee = $jsonDataObject->created;
																			echo date("M jS, Y", strtotime($datee)); ?></span><!-- end member-since -->
							<a href="#" class="btn-pink">View FULL PROFILE</a><!-- end btn-pink -->
							<div class="progress-circles">
								<div class="circle1">
									<strong></strong>
									<span>Response rate</span>
								</div><!-- end circle -->
								<div class="circle2">
									<strong></strong>
									<span>Response time</span>
								</div><!-- end circle -->
							</div><!-- end progress-circles -->
						</div><!-- end host-details -->
						<div class="host-contact">
							<p>
								Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. 
							</p>
							<p>
								Perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam.
							</p>
							<a href="#" class="btn-pink">Contact</a><!-- end btn-pink -->
							<a href="#" class="fb"></a><!-- end fb -->
							<span class="check-friends">Check your friends connection</span><!-- end check-friends -->
						</div><!-- end host-contact -->
					</div><!-- end about-host -->
				</div><!-- end centered-content -->
			</div><!-- end gray-section -->
			<div class="centered-content">
				<div class="reviews-header">
					<h2>REVIEWS - 12</h2>
					<ul class="emoticons">
						<li><img src="<?php echo base_url()?>public/temp_overview/images/emoticons/excelent.png" alt="excelent" /></li>
						<li><img src="<?php echo base_url()?>public/temp_overview/images/emoticons/happy.png" alt="happy" /></li>
						<li><img src="<?php echo base_url()?>public/temp_overview/images/emoticons/not-happy.png" alt="not-happy" /></li>
						<li><img src="<?php echo base_url()?>public/temp_overview/images/emoticons/sad.png" alt="sad" /></li>
						<li><img src="<?php echo base_url()?>public/temp_overview/images/emoticons/angry.png" alt="angry" /></li>
					</ul><!-- end emoticons -->
					<span class="chosen-emotion">Excelent</span><!-- end chosen-emotion -->
					<a href="#" class="view-all-reviews">View all reviews</a><!-- end view-all-reviews -->
				</div><!-- end reviews-header -->
				<ul class="reviews">
				<?php
				$baseUrl1 = 'http://localhost/rnr_production_new/trunk/rentnroam/overview/reviews/property_id/8';

			$jsonData1 = file_get_contents($baseUrl1); 
			$jsonDataObject1 = json_decode($jsonData1);
			foreach($jsonDataObject1 as $reviews)
			{
			$user_image_path=  "http://localhost/rnr_production_new/trunk/rentnroam/uploads/user_image/";	
						$user_image = $reviews->profile_pic;
						if($user_image!='')
						{
							$image = $user_image_path.$user_image;
						}
					else
					 $image='';
				 $time=strtotime($reviews->date_time);
					$month=date("F",$time);
					$year=date("Y",$time);
				?>
					<li>
						<div class="photo-name">

							<img src="<?php echo base_url()?>public/temp_overview/images/sam.png" alt="sam" />
							<span>Sam</span>
=======
							<img src="<?php echo $image; ?>" alt="sam" />
							<span><?php echo $reviews->user_name; ?></span>
>>>>>>> .r42
						</div><!-- end photo-name -->
						<div class="review-text-content">
							<div class="date-general">
								<span><?php echo $month; ?> <?php echo $year; ?></span>
								<img src="<?php echo base_url()?>public/temp_overview/images/emoticons/excelent-big.png" alt="excelent" class="my-emotion" />
							</div><!-- end date-general -->
							<p>
								<?php echo $reviews->article_texts;?>
							</p>
						</div><!-- end review-text-content -->
					</li>

					<li>
						<div class="photo-name">
							<img src="<?php echo base_url()?>public/temp_overview/images/sam.png" alt="sam" />
							<span>Sam</span>
						</div><!-- end photo-name -->
						<div class="review-text-content">
							<div class="date-general">
								<span>January 2015</span>
								<img src="<?php echo base_url()?>public/temp_overview/images/emoticons/excelent-big.png" alt="excelent" class="my-emotion" />
							</div><!-- end date-general -->
							<p>
								Sed ut perspiciatis unde omnis iste natus error siteritatis et quasi architecto beatae vitae dicta sunt exipsam. 
							</p>
							<p>
								Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.
							</p>
						</div><!-- end review-text-content -->
					</li>
					<li>
						<div class="photo-name">
							<img src="<?php echo base_url()?>public/temp_overview/images/sam.png" alt="sam" />
							<span>Sam</span>
						</div><!-- end photo-name -->
						<div class="review-text-content">
							<div class="date-general">
								<span>January 2015</span>
								<img src="<?php echo base_url()?>public/temp_overview/images/emoticons/excelent-big.png" alt="excelent" class="my-emotion" />
							</div><!-- end date-general -->
							<p>
								suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.
							</p>
						</div><!-- end review-text-content -->
					</li>
					<li>
						<div class="photo-name">
							<img src="<?php echo base_url()?>public/temp_overview/images/sam.png" alt="sam" />
							<span>Sam</span>
						</div><!-- end photo-name -->
						<div class="review-text-content">
							<div class="date-general">
								<span>January 2015</span>
								<img src="<?php echo base_url()?>public/temp_overview/images/emoticons/excelent-big.png" alt="excelent" class="my-emotion" />
							</div><!-- end date-general -->
							<p>
								Magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.
							</p>
						</div><!-- end review-text-content -->
					</li>
=======
					<?php
			}
					?>
>>>>>>> .r42
				</ul><!-- end reviews -->
			</div><!-- end centered-content -->
		</div><!-- end main-content -->
	</div><!-- end inner_container -->
	<div id="footer">
		<div class="centered-content">
			<ul class="footer-cols">
				<li>
					<h4>See homes</h4>
					<ul>
						<li><a href="#">Alibaug</a></li>
						<li><a href="#">Panchgani</a></li>
						<li><a href="#">Mumbai</a></li>
						<li><a href="#">Lonavala</a></li>
						<li><a href="#">Mahabaleshwar</a></li>
					</ul>
					<h4>HIGHLIGHTS</h4>
					<ul>
						<li><a href="#">Hot Offers</a></li>
						<li><a href="#">Trending Destinations</a></li>
						<li><a href="#">RNR Recomended</a></li>
						<li><a href="#">Events &amp; Happenings</a></li>
					</ul>
				</li>
				<li>
					<h4>EXPERIENCE</h4>
					<ul>
						<li><a href="#">People Stories</a></li>
						<li><a href="#">Travelogue</a></li>
						<li><a href="#">Press Coverage</a></li>
					</ul>
					<h4>COMPANY</h4>
					<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Brand Promise</a></li>
						<li><a href="#">Jobs</a></li>
						<li><a href="#">Media</a></li>
						<li><a href="#">Affiliates</a></li>
						<li><a href="#">Partners</a></li>
					</ul>
				</li>
				<li>
					<h4>HOSTING</h4>
					<ul>
						<li><a href="#">How it works</a></li>
						<li><a href="#">Indian Hospitality</a></li>
						<li><a href="#">Home Safety</a></li>
						<li><a href="#">roamNrent guarantee</a></li>
						<li><a href="#">Benefits</a></li>
					</ul>
					<h4>POLICIES</h4>
					<ul>
						<li><a href="#">Reservation</a></li>
						<li><a href="#">Cancellation</a></li>
						<li><a href="#">Terms &amp; use</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Legal</a></li>
					</ul>
				</li>
			</ul><!-- end footer-cols -->
			<div class="footer-content">
				<h3>Contact</h3>
				<ul class="contact">
					<li>Call us on:  +1800 8388 3989</li>
					<li>Email us on: support@rnr.com</li>
				</ul><!-- end contact -->
				<h3>Set your Currency</h3>
				<form class="currency">
				  <select>
				    <option value="aud">$AUD</option>
				    <option value="aud">$USD</option>
				  </select>
				</form><!-- end currency -->
				<div class="group">
					<h3 class="inline">Join Us on</h3>
					<ul class="social">
						<li class="twitter"><a href="#">twitter</a></li>
						<li class="facebook"><a href="#">facebook</a></li>
						<li class="rss"><a href="#">rss</a></li>
						<li class="google"><a href="#">google</a></li>
					</ul><!-- end social -->
				</div><!-- end group -->
			</div><!-- end footer-content -->
		</div><!-- end centered-content -->
	</div><!-- end footer -->
</div><!-- end container -->

=======
<?php
		$baseUrl = 'http://localhost/rnr_production_new/trunk/rentnroam/overview/location/property_id/8';

			$jsonData = file_get_contents($baseUrl); 
			$jsonDataObject = json_decode($jsonData);
			?>
<input type="hidden" name="lat" id="lat" value="<?php echo $jsonDataObject->location->lat; ?>">
<input type="hidden" name="long" id="long" value="<?php echo $jsonDataObject->location->long; ?>">

>>>>>>> .r42
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>   
<script src="<?php echo base_url()?>public/temp_overview/js/home.js"></script>   
<!-- BX Slider  -->
<script src="<?php echo base_url()?>public/temp_overview/js/jquery.bxslider.min.js"></script>   
<script type="text/javascript">
$(document).ready(function(){						
	$('ul.overview-hero-slider').bxSlider({
		auto: false,
		touchEnabled: true,
		pager: true
	});
});		
</script>  

<!-- Datepicker -->
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
  <script>
  $(function() {
    $('.datepicker').datepicker();
  });
  </script>

<!-- Equal Heights Plugin -->
<script type="text/javascript" src="<?php echo base_url()?>public/temp_overview/js/jquery.matchHeight.js"></script>
<script type="text/javascript">
    (function() {

        $(function() {            
            $('div.equal-heights').matchHeight();
            $('div.equal-heights2').matchHeight();
            $('div.equal-heights3').matchHeight();
            $('ul.footer-cols > li').matchHeight();
        });

    })();
</script>  

<!-- Google Map API -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
		var latitude=document.getElementById('lat').value;
		var longitude=document.getElementById('long').value;
    var mapCanvas = document.getElementById('map-wrapper');

    var myLatlng = new google.maps.LatLng(18.754887, 73.405371);
=======
    var myLatlng = new google.maps.LatLng(latitude,longitude);
>>>>>>> .r42

    var mapOptions = {
      center: myLatlng,
      scrollwheel: false,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)

      var marker = new google.maps.Marker({
	      position: myLatlng,
	      map: map,
	      title: 'RentNRoam'
	  });


  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!-- Circle Progress Bar -->
<script src="<?php echo base_url()?>public/temp_overview/js/circle-progress.js"></script>
<script>
	$('.circle1').circleProgress({
		    value: 0.55,
		    fill: { color: '#adce48' }
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
	});

	$('.circle2').circleProgress({
		    value: 1,
		    fill: { color: '#adce48' }
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').html(String(stepValue)*60 + '<br />min');
	});
</script>

</body>
</html>
