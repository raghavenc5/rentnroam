<?php echo $this->load->view('search/header_filter');?>

<script>
						
						</script>
			
			<div id="sub-nav" class="row">
				<div class="centered-content">
					<a href="#" class="col-md-2" style="padding-left: 140px;">
						PHOTOS
					</a>
					<a href="#" class="col-md-1" style="padding-left: 35px;">
						DESCRIPTION
					</a>
					<a href="#" class="col-md-1" style="padding-left: 80px;">
						MAP
					</a>
					<a href="#" class="col-md-1" style="padding-left: 50px;">
						HOST
					</a>
					<a href="#" class="col-md-1">
						REVIEWS
					</a>
					<div class="col-md-6" id="popover" rel="popover" data-popover-content="#bookingPopover">
						<div class="col-md-3 red-background" style="margin-left: 75px;">
							<div id="pricehead">
							<p class="text-left">
								<i class="fa fa-inr"></i>
								<?php
									if(!empty($location))
										{
										$propID = "";
											foreach($location as $opt)
											{
												echo $opt->price;
												$propID = $opt->property_id;
												
											}
										}	
																			
										?>
								
							</p>
							</div>
							<div id="price_head">
							</div>
							<script>
							//assign property id to jscript variable
							var prop_id =  <?php echo $propID;?>
							</script>
						</div>
						<div class="col-md-6 red-background">
							<p class="text-right">
								<span class="white-divider">Per Night</span>
								<i class="fa fa-angle-down"></i>
							</p>
						</div>
					</div>
					<div id="bookingPopover" class="col-md-12">
						<form class="form-horizontal">
							<div class="col-md-4">
								<p>CHECK IN</p>
								<input id="check_in_pop" type="text" class="boot-datepicker datepicker" style="width: 100%;" />
							</div>
							<div class="col-md-4">
								<p>CHECK OUT</p>
								<input id="check_out_pop" class="datepicker" type="text" style="width: 100%;" />
							</div>
							<div class="col-md-4">
								<p>GUESTS</p>
								<div class="styled-select" 
									style="height: 34px;
									width: 65px;
									margin-top: 1px;">
			                        <select class="form-control" onchange="select_guest()" id='guest_select'>
			                        	<option value="0">0</option>
			                            <option value="1">1</option>
			                            <option value="2">2</option>
			                            <option value="3">3</option>
			                        </select>
			                    </div>
							</div>
							<div id="table-container" class="col-md-12">
							<div class="price_hide">
								<table class="table table-bordered">
								 		<?php
										$property_id = '';
										$guestCharge = '';
										$price = '';
										$service_charge = '';
										$tax_fee = '';
										//$title = '';
										if(!empty($location))
										{
											foreach($location as $opt)
											{
												$property_id = $opt->property_id;
												$guestCharge = $opt->guest_charge;
												$price1			 = $opt->price;
												$service_charge =$opt->service_fee;
												$tax_fee = $opt->tax_fee;
												
										?>
										<tr>

											<td><i class="fa fa-inr"></i> <?php echo $opt->price; ?> x 5 nights</td>
											<td><i class="fa fa-inr"></i><?php $pricetotal = $opt->price *5;
											echo $pricetotal; 
											?> </td>
										</tr>
										<tr>
											<td>Service Fee + Taxes</td>
											<td><i class="fa fa-inr"></i><?php  $extra=$opt->service_fee+$opt->tax_fee;
											echo $extra;?> </td>
										</tr>
										<tr>
											<td>Total </td>
											<td><i class="fa fa-inr"></i><?php echo $pricetotal+$extra; ?></td>
										</tr>
										<?php 
											}
										}
										?>
								</table>
							</div>
							<div class="price_show">
							</div>	
							</div>
							<div id="popover-bottom-text" class="col-md-12">
								<h2>REQUEST TO BOOK</h2>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- end header -->
		
		<div id="overview-hero-wrapper" data-scroll="photos">
			<ul class="overview-hero-slider">
			<ul class="bxslider">
			<?php
			if(!empty($property_video))
			{
				foreach($property_video as $video)
				{
					print $video->youtube_video_id;

			?>
			<li>
			    <iframe src="https://www.youtube.com/embed/<?php echo $video->youtube_video_id; ?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</li>
		
			<?php
				}
			}
			
			?>
			
			<?php
				if(!empty($property_image))
				{
					foreach($property_image as $image)
					{
						$property_image_path = base_url().'/public/uploads/property_image/';
						$property_image = $image->images;
					if($property_image!='')
					{
					 $image = $property_image_path.$property_image;
					}
					else
						$image='';
			?>
			
			<li><img src="<?php echo $image; ?>" /></li>
				<?php
							}
						}				
				?>
			</ul>
			</ul><!-- end overview-hero-slider -->
			<div class="overview-hero-content">

			<?php 
			$visit = '';
			
			
			if(!empty($last_visit))
							{
								foreach($last_visit as $text)
								{
									$visit =  $text->booking_upto;
									//$member_since = $opt->created_on;
										  $visit = date('d F', strtotime($visit));
										  //echo $visit;
								}
							}		
			
			?>
			<?php
				if(!empty($last_visit))
				{
				?>
				<span class="visited">You visited this property last <?php echo $visit;?></span><!-- end visited -->
				<?php 
				}

				?>
				<!-- <span class="visited slider-count">
					<span id="currentSlide"></span> 
					| 
					<span id="totalSlide"></span>
				</span> --><!-- end counter -->
				<div class="slider-price">
				<?php if(!empty($location))
							{
								foreach($location as $text)
								{
				?>
					<span><i class="fa fa-inr"></i>
							<?php echo $text->price;
								}
							}	
							 ?></span>
					<span class="small">*per night</span><!-- end small -->
				</div><!-- end slider-price -->
				
				<div class="slider-price-1">
				</div><!-- end slider-price-1 -->
			</div><!-- end overview-hero-content -->
		</div><!-- end overview-hero-wrapper -->
		<div class="main-content">
			<div class="yellow-section">
				<div class="centered-content group">
					<div class="basic-room-info equal-heights">
						<?php
						
							//$title = '';
							if(!empty($location))
							{
								foreach($location as $text)
								{
																
							?>	
						<h2>
							<?php echo $text->property_title; ?></h2>
						<h3><?php echo $text->area; ?>, <?php echo $text->state_name; ?></h3>
						
						<div class="group">
							<ul class="info-icons">
								<li class="map"><a href="#" data-scroll="map">Map</a></li><!-- end map -->
								<li class="smiley"><a href="#" data-scroll="reviews">Map</a></li><!-- end smiley -->
								<?php 
								$userDataFromSession = $this->session->userdata('user');
                                if ($userDataFromSession) {
								$uid = $userDataFromSession['user_id'];								
								?>
								<script>
								var uid = <?php echo $uid;?>;
								var pid = <?php echo $propID;?>;
								
								</script>
								<li class="<?php $clas1 = "fav"; $clas2 = "addwish"; if($wish_check == true) echo $clas2; else echo $clas1; ?>"><a href="#" onclick = "post_wishlist(uid, pid);">Map</a></li><!-- end fav -->
								<?php }
								else
								{
								?>
								<li class="fav"><a href="javascript:void(0)" onclick = "load_login_popup();">Map</a></li><!-- end fav -->
								<?php 								
								}
								?>
							</ul><!-- end info-icons -->
							
							
							
							<span class="reviews"><?php if(!empty($review_count)){ echo $review_count;} else { $c = 0; echo $c;}?> reviews</span>
						</div><!-- end group -->
						<ul class="room-info">
							<li class="guests"><?php echo $text->guest_allow; ?> Guests</li>
							<li class="rooms"><?php echo $text->bedrooms; ?> Rooms</li>
							<li class="beds"><?php echo $text->bed; ?> Beds</li>
							<?php	


								} 
							}
						?>
						</ul><!-- end room-info -->
					</div><!-- end basic-room-info -->
					<div class="basic-host-info equal-heights">
						<?php
							//$title = '';
							if(!empty($user_info))
							{
								foreach($user_info as $user)
								{	
											$image = '';
											$user_image_path=  base_url().'/public/uploads/user_image/';
											$user_image = $user->profile_pic;
											
											if($user_image!='')
											{
												$image = $user_image_path.$user_image;
											}
											else
										 	$image=base_url().'/public/uploads/user_image/no-image.png';
																
						?>
						<!--<img src="<?php echo base_url()?>public/overview_temp/images/host.png" alt="host" />-->
						<img src="<?php echo $image; ?>" alt="host" />
						<span class="hosted-by">Hosted by</span><!-- end hostedby -->
						<span class="host-name"><?php echo $user->first_name;
													  echo "\n";
													  echo $user->last_name;?></span><!-- end host-name -->
						<?php	
								} 
							}
						?>							  
						<a href="#" class="btn-pink">Know more</a><!-- end btn-pink -->
						<a href="#" class="btn-pink">Contact Host </a><!-- end btn-pink -->
					</div><!-- end basic-host-info -->
					<div class="booking-section equal-heights">
						<form class="check-in-out" >
							<ul>
								<li>
									<label>Check in</label>
									<input id="check_in_ov"  type="text" class="boot-datepicker datepicker" style="width: 100%;" />
								</li>
								<li>
									<label>Check out</label>
									<input id="check_out_ov"  class="datepicker" type="text" style="width: 100%;" />
								</li>
								<li>
									<label>Guest</label>
									<div class="styled-select" 
										style="width: 65px;
										margin-top: 1px;">
										<select id='guest_select1' onchange="select_guest1()">
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div><!-- end styled-select -->
								</li>
							</ul>
							
							
						</form><!-- end check-in-out -->
						<div class="price_hide1">
						<table class="price-calculation">
						<?php
							//$title = '';
							if(!empty($location))
							{
								foreach($location as $opt)
								{
																
							?>
							<tr>
								<td><i class="fa fa-inr"></i> <?php echo $opt->price; ?> x 5 nights</td>
								<td><i class="fa fa-inr"></i><?php $pricetotal = $opt->price *5;
								echo $pricetotal;
								?> </td>
							</tr>
							<tr>
								<td>Service Fee + Taxes</td>
								<td><i class="fa fa-inr"></i><?php  $extra=$opt->service_fee+$opt->tax_fee;
								echo $extra;?> </td>
							</tr>
							<tr>
								<td>Total</td>
								<td><i class="fa fa-inr"></i><?php echo $pricetotal+$extra; ?></td>
							</tr>
							<?php 
								}
							}
							?>
						</table><!-- end price-calculation -->
						</div>
						<div class="price_show1">

						</div>


						<!--<table class="price-calculation-selection">
						
							
														
							
							<tr>
								<td><i class="fa fa-inr"></i> 5000 x 5 nights</td>
								<td><i class="fa fa-inr"></i> 25000 </td>
							</tr>
							<tr>
								<td>Service Fee + Taxes</td>
								<td><i class="fa fa-inr"></i> 2345</td>
							</tr>
							<tr>
								<td>Total</td>
								<td><i class="fa fa-inr"></i>4799</td>
							</tr>
							
						</table> end price-calculation-selection -->

						<div class="booking-footer">
							<a href="#">Request to Book</a>
						</div><!-- end booking-footer -->
					</div><!-- end booking-section -->
				</div><!-- end centered-content -->
			</div><!-- end yellow-section -->
			<div class="centered-content" data-scroll="description">
				<h2>Description</h2>
				<p>
					<?php
							//$title = '';
							if(!empty($location))
							{
								foreach($location as $text)
								{
																
							?>
					<div class="comment more">			
					<?php echo $text->description; ?>
					</div>
				</p>
				<br>
				
				
				
				<div class="grid-row">
					<div class="space-cell equal-heights2">
						<h2>Space</h2>
						<table>
							<tr>
								<td>Property type:</td>
								<td><?php echo $text->property_type; ?></td>
							</tr>
							<tr>
								<td>Room type:</td>
								<td><?php echo $text->property_type; ?></td>
							</tr>
							<tr>
								<td>Accomodates:</td>
								<td><?php echo $text->guest_allow; ?></td>
							</tr>
							<tr>
								<td>Bedrooms:</td>
								<td><?php echo $text->bedrooms; ?></td>
							</tr>
							<tr>
								<td>Bathrooms:</td>
								<td><?php echo $text->bathrooms; ?></td>
							</tr>
							<tr>
								<td>Beds:</td>
								<td><?php echo $text->bed; ?></td>
							</tr>
						</table>
						<?php 
							}
						}
						?>
					</div><!-- end space-cell -->
					<div class="amenities-cell equal-heights2">
						<h2>Amenities</h2>
						<div class="clearfix"></div>
						<!-- Paste removed code in case -->
						<!-- Paste removed code in case -->
						<?php
						
						if(!empty($amenities_))
						{
							$common = '';
							$extra = '';
							$feature = '';
							$safety = '';
							
							foreach($amenities_ as $opt) 
							{				
									    if($opt['amenities_type_name'] == 'COMMON') {											
										$common = 'COMMON';
											//$commm = $opt['amenities_type_name'];
										}
										if($opt['amenities_type_name'] == 'EXTRA') {											
										$extra = 'EXTRA';
										}
										if($opt['amenities_type_name'] == 'FEATURE') {											
											$feature = 'FEATURE';
										}
										if($opt['amenities_type_name'] == 'SAFETY') {											
											$safety = 'SAFETY';
										}

										
							}
							
						}
						

						
						?>
						<?php
						if(!empty($amenities_))
						{

							echo '<table>';
							echo '<th>';
							echo $common;
							echo '</th>';				
							foreach($amenities_ as $opt) 
							{				
									  
								if($opt['amenities_type_name'] == 'COMMON') 
								{
									
									echo '<tr>';
									echo '<td>';
									echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$opt['images'].'></span>';
									echo '<span>'.$opt['amenities_subtype'].'</span>';											
									echo '</td>';
									echo '</tr>';
									
								}
							}
							echo '</table>';
							//echo '<a class="more_common_subtype" href="#">more</a>';
						}
						?>
						
						
						<?php
						if(!empty($amenities_))
						{
										

											echo '<table>';
											echo '<th>';
											echo $extra;
											echo '</th>';
						foreach($amenities_ as $option) {
										if($option['amenities_type_name'] == 'EXTRA') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$option['images'].'></span>';
											echo '<span>'.$option['amenities_subtype'].'</span>';
											echo '</tr>';
											echo '</td>';											
										}
									}
										echo '</table>';
						
						}
						?>	
						<?php 
						if(!empty($amenities_))
						{			

											echo '<table>';
											echo '<th>';
											echo $feature;
											echo '</th>';
										foreach($amenities_ as $option) {

										if($option['amenities_type_name'] == 'FEATURE') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$option['images'].'></span>';
											echo '<span>'.$option['amenities_subtype'].'</span>';
											echo '</tr>';
											echo '</td>';
											
										}
									}
						}
						?>
						<?php if(!empty($amenities_))
						{			
											echo '</table>';
											
											echo '<table>';
											echo '<th>';
											echo $safety;
											echo '</th>';
									foreach($amenities_ as $option) {

										if($option['amenities_type_name'] == 'SAFETY') {
											
											echo '<tr>';
											echo '<td>';
											echo '<span class="icon"><img src='.base_url().'public/images/amenities/'.$option['images'].'></span>';
											echo '<span>'.$option['amenities_subtype'].'</span>';
											echo '</tr>';
											echo '</td>';
											
										}
									}
								echo '</table>';
						}
						?>
					</div><!-- end amenities-cell -->
				</div><!-- end grid-row -->
				<div class="grid-row">
					<div class="timings-cell equal-heights3">
					<?php if(!empty($location)){
								foreach($location as $opt)
								{

									
						?>
						<h2>Timings</h2>
						<table>
							<tr>
								<td>Check in:</td>
								<td><?php echo $opt->check_in_time; ?></td>
							</tr>
							<tr>
								<td>Check out:</td>
								<td><?php echo $opt->check_out_time; ?></td>
							</tr>
						</table>
					</div><!-- end timings-cell -->
					<div class="price-cell equal-heights3">
						<h2>Price</h2>
						<table>
							<tr>
								<td>One Extra Person:</td>
								<td><i class="fa fa-inr"></i><?php echo $opt->guest_charge; ?> / night after the first guest</td>
							</tr>
							<tr>
								<td>Security Deposit:</td>
								<td><i class="fa fa-inr"></i> <?php echo $opt->security_charge; ?></td>
							</tr>
							<tr>
								<td>Cleaning fee:</td>
								<td><i class="fa fa-inr"></i> <?php echo $opt->clean_charge; ?> /month</td>
							</tr>
							<?php 
								}
							}	
							?>
							<tr>
							<?php if(!empty($seasonal_price))
							{
							?>
								<td>Weekly Price:</td>
								<td><i class="fa fa-inr"></i> <?php echo $seasonal_price['season1weekly']; ?> /week</td>
							</tr>
							<tr>
								<td>Monthly Price:</td>
								<td><i class="fa fa-inr"></i> <?php echo $seasonal_price['season1monthly']; ?> /month</td>
							</tr>
						<?php
								
							}
							?>
						</table>
					</div><!-- end price-cell -->
					<div class="cancellation-cell equal-heights3">
						<h2>CANCELLATION</h2>
						<?php if(!empty($location)){
								foreach($location as $opt)
								{

									
						?>
						<h3><?php echo $opt->policy; ?></h3>
						<p>
							<?php echo $opt->policy_description;?>
							
						</p>
					</div><!-- end cancellation-cell -->
				</div><!-- end grid-row -->
				<h2 style="padding-top: 24px;">House Rules</h2>
				<p>
					<span class="upper"><?php echo $opt->min_night_stay; ?> NIGHTS MINIMUM STAY</span><br />
					<div class="comment more">	
					<?php echo $opt->house_rule; ?>
					</div>
				</p>
				<?php 
					}

					}
					?>
			</div><!-- end centered-content -->
			<div id="map-wrapper" data-scroll="map"></div><!-- end map-wrapper -->
			<div class="gray-section" data-scroll="host">
				<div class="centered-content group">
					<h2>ABOUT THE HOST</h2>
					<div class="about-host">
						<?php 
									if(!empty($user_info))
									{						
									foreach($user_info as $opt)
										{
											$image = '';
											$user_image_path=  base_url().'/public/uploads/user_image/';
											$user_image = $opt->profile_pic;
											
											if($user_image!='')
											{
												$image = $user_image_path.$user_image;
											}
											else
										 	$image=base_url().'/public/uploads/user_image/no-image.png';
					
											?>
						<img src="<?php echo $image; ?>" alt="host" class="host-photo" />
						<div class="host-details">
			
							<h3> <?php
										  echo $opt->first_name;
										  echo "\n";
										  echo $opt->last_name; 
										}
								   }
								  ?>
							</h3>
							<span class="location"><?php
										if(!empty($location))
										{						
											foreach($location as $opt)
											{ 
											echo $opt->address_line1; ?>, 

											<?php echo $opt->state_name; 
											}
										} ?> </span><!-- end location -->
							<span class="member-since">Member since, 
							     <?php 
									if(!empty($user_info))
									{						
									foreach($user_info as $opt)
										{
										  $member_since = $opt->created_on;
										  $memberDate = date('F Y', strtotime($member_since));
										  echo $memberDate;
										}
								   }
								  ?>
								  </span><!-- end member-since -->
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
							<?php if(!empty($user_info)){ foreach($user_info as $user) $txt = $user->user_details;
								echo $txt;
								} else echo "no user details"; ?>
							</p>
							<a href="#" class="btn-pink">Contact</a><!-- end btn-pink -->
							<!--
							<a href="#" class="fb"></a><!-- end fb -->
							<!--<span class="check-friends">Check your friends connection</span>--><!-- end check-friends -->
						</div><!-- end host-contact -->
					</div><!-- end about-host -->
				</div><!-- end centered-content -->
			</div><!-- end gray-section -->
			<div class="centered-content" data-scroll="reviews">
				<div class="reviews-header">
					<h2>REVIEWS </h2>
					<!-- 
					<ul class="emoticons">
						<li><img src="<?php echo base_url()?>public/images/emoticons/excelent.png" alt="excelent" /></li>
						<li><img src="<?php echo base_url()?>public/images/emoticons/happy.png" alt="happy" /></li>
						<li><img src="<?php echo base_url()?>public/images/emoticons/not-happy.png" alt="not-happy" /></li>
						<li><img src="<?php echo base_url()?>public/images/emoticons/sad.png" alt="sad" /></li>
						<li><img src="<?php echo base_url()?>public/images/emoticons/angry.png" alt="angry" /></li>
					</ul>
					<span class="chosen-emotion">Excelent</span>
					 -->
					<!-- end chosen-emotion -->
				<!--	<a href="#" class="view-all-reviews">View all reviews</a>end view-all-reviews -->
				</div><!-- end reviews-header -->
				<?php 	
				if(!empty($total))
				{
					if($total != 0)
					{
				?>
				<!-- Reviews Summary Panel -->
				<div id="reviewPanel" class="col-md-12">
					<div class="col-md-7 col-padding-no">
						<div id="averageContainer" class="col-md-4 col-padding-no matchHeight">
						<?php 
							$img_smiley = '';
							  if(!empty($total))
							 	{
							 		if($total > 0 & $total <= 1.5 )
							 		{
							 			$img_smiley = "excelent.png";
							 		}
							 		else if($total > 1.5 & $total <= 2.5 )
							 		{
							 			$img_smiley = "happy.png";
							 		}

							 		else if($total > 2.5 & $total <= 3.5 )
							 		{
							 			$img_smiley = "not-happy.png";
							 		}
							 		else if($total > 3.5 & $total <= 4.5 )
							 		{
							 			$img_smiley = "sad.png";
							 		}
							 		else if($total > 4.5 & $total <= 5.5 )
							 		{
							 			$img_smiley = "angry.png";
							 		}
							 		else
							 		{
							 			$img_smiley ="no-review.jpg";
							 		}

							 	}
							  else
							    {
							    	$img_smiley = "no-review.jpg";
							    }		
						?>
							<img id="averageRating" src="<?php echo base_url()?>public/images/emoticons/<?php echo $img_smiley;?>" alt="Average rating">
								<?php 
									if(!empty($review_count))
									{ 
									?>	
									<p id="average-info">average rating</p>
									<p>based on <?php echo $review_count;?> reviews</p>
									<?php
									} 
									else 
									{ 
									echo "No Reviews"; 
										
									}
								?>
						</div>
						<div class="col-md-8 col-padding-no matchHeight">
							<table>
								<tbody>
									<tr>
										<td>
											<img src="<?php echo base_url()?>public/images/emoticons/excelent.png" alt="excelent" />
										</td>
										<td>
											<a href="javascript:void(0)" onclick = "getReviewbySmiley(1);">
											<div class="col-md-11 col-padding-no">
	                                            <div class="progress">
	                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $smiley1_percent;?>%;">
	                                                    <span class="sr-only"><?php echo $smiley1?> Reviews</span>
	                                                </div>
	                                            </div>
											</div>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<img src="<?php echo base_url()?>public/images/emoticons/happy.png" alt="happy" />
										</td>
										<td>
											<a href="javascript:void(0)" onclick = "getReviewbySmiley(2);">
											<div class="col-md-11 col-padding-no">
	                                            <div class="progress">
	                                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $smiley2_percent;?>%;">
	                                                    <span class="sr-only"><?php echo $smiley2?> Reviews</span>
	                                                </div>
	                                            </div>
											</div>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<img src="<?php echo base_url()?>public/images/emoticons/not-happy.png" alt="not-happy" />
										</td>
										<td>
											<a href="javascript:void(0)" onclick = "getReviewbySmiley(3);">
											<div class="col-md-11 col-padding-no">
	                                            <div class="progress">
	                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $smiley3_percent;?>%;">
	                                                    <span class="sr-only"><?php echo $smiley3?> Reviews</span>
	                                                </div>
	                                            </div>
											</div>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<img src="<?php echo base_url()?>public/images/emoticons/sad.png" alt="sad" />
										</td>
										<td>
											<a href="javascript:void(0)" onclick = "getReviewbySmiley(4);">
											<div class="col-md-11 col-padding-no">
	                                            <div class="progress">
	                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $smiley4_percent;?>%;">
	                                                    <span class="sr-only"><?php echo $smiley4?> Reviews</span>
	                                                </div>
	                                            </div>
											</div>
											</a>
										</td>
									</tr>
									<tr>
										<td>
											<img src="<?php echo base_url()?>public/images/emoticons/angry.png" alt="angry" />
										</td>
										<td>
											<a href="javascript:void(0)" onclick = "getReviewbySmiley(5);">
											<div class="col-md-11 col-padding-no">
	                                            <div class="progress">
	                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $smiley5_percent;?>%;">
	                                                    <span class="sr-only"><?php echo $smiley5?> Reviews</span>
	                                                </div>
	                                            </div>
											</div>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="loading">
					<img src="<?php echo base_url()?>public/images/loader.gif" class="ajax-loader">
					</div>
					<?php 

					$userDataFromSession = $this->session->userdata('user');
					//print_r($userDataFromSession);					
					//$uid = $userDataFromSession['user_id'];
					//print $uid;
					//echo "book count ".$checkbook;
										
					if (count($userDataFromSession) >= 2)
					{

						
					 	if($checkbook > 0)
					 	{
					 	?>
					 	<div class="col-md-5 col-padding-no text-center">
								<a id="writeReview" href="#" class="btn-pink" data-toggle="modal" data-target="#writeReviewModal">
									Write Review
								</a>
						</div>
					 	<?php	
					 	}
					 	else
					 	{	

					 ?>	
							<div class="col-md-5 col-padding-no text-center">
								
							</div>
					
					<?php 
						}
					}
					
				    ?>


				</div>
				<div class="clearfix"></div>
				<!-- Reviews Summary Panel -->


				<div id="review_main">
				<ul class="reviews">
						<?php
						if(!empty($property_review))
						{
							foreach($property_review as $reviews)
							{
								$image = '';
								$user_image_path=  base_url().'/public/uploads/user_image/';
								$user_image = $reviews->profile_pic;
								
								if($user_image!='')
								{
									$image = $user_image_path.$user_image;
								}
								else
								$image=base_url().'/public/uploads/user_image/no-image.png';
							

							$time=strtotime($reviews->created_on);
							$month=date("F",$time);
							$year=date("Y",$time);
				?>
					<li>
						<div class="photo-name">
							<img src="<?php echo $image; ?>" alt="sam" />
							<span><?php echo $reviews->user_name; ?></span>
						</div><!-- end photo-name -->
						<div class="review-text-content">
							<div class="date-general">
								<span><?php echo $month; ?> <?php echo $year; ?></span>
								<img src="<?php echo base_url()?>public/images/emoticons/<?php echo $reviews->smiley_icon;?>" alt="excelent" class="my-emotion" />
							</div><!-- end date-general -->
							<p>
							<div class = "comment more">
							<?php echo $reviews->review_message;?>
							</div>	
							</p>
						</div><!-- end review-text-content -->
					</li>
						<?php
							}
						}
						else
						{
						?>
						<div>No Reviews</div>
						<?php
						}
						?>
				</ul><!-- end reviews -->
				</div>
				
				<div id="review_on_click">
				
				</div>
				<?php 
				}
				else{?>
				echo "<div>No Reviews</div>";
				<?php
				}
				}
				?>
				
			</div><!-- end centered-content -->
		</div><!-- end main-content -->
	</div><!-- end inner_container -->



<?php echo $this->load->view('search/footer_filter');?>
<!-- Modal -->
<div class="modal fade" id="writeReviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<?php 
						$userDataFromSession = $this->session->userdata('user');
						$image = '';
						$user_image_path=  base_url().'/public/uploads/user_image/';
						$user_image = $userDataFromSession['profile_pic'];
						$user_id = $userDataFromSession['user_id'];
						//print_r($userDataFromSession);
						
						if($user_image!='')
						{
							$image = $user_image_path.$user_image;
						}
						else
					 	$image=base_url().'/public/uploads/user_image/no-image.png';
						?>
	<div class="modal-dialog" role="document">
	<form id="formReviewWrite" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Write Review</h4> <p id="smileyerror" style="color:red"></p>
			</div>
			
			<div class="modal-body">
				<div class="media">
					<div class="media-left">
					
						<a href="#">
							<img class="media-object" alt="Image Error" src="<?php echo $image;?>">
						</a>
						<p><?php 
							
							echo $userDataFromSession['first_name'].' '.$userDataFromSession['last_name'];
						?></p>
					</div>
					<div class="media-body">
						
						<h4 class="media-heading">
							<span id="monthYear"><?php $today = date("F j, Y"); 
							echo $today; ?></span>
							
							<span>
							<div id="sites">
								
									<input type="radio" name="rating" id="s1" value="1" /><label for="s1"><img src="<?php echo base_url()?>public/images/emoticons/excelent.png" alt="excelent" /></label></li>
									<input type="radio" name="rating" id="s2" value="2" /><label for="s2"><img src="<?php echo base_url()?>public/images/emoticons/happy.png" alt="happy" /></label>
									<input type="radio" name="rating" id="s3" value="3" /><label for="s3"><img src="<?php echo base_url()?>public/images/emoticons/not-happy.png" alt="not-happy" /></label>
									<input type="radio" name="rating" id="s4" value="4" /><label for="s4"><img src="<?php echo base_url()?>public/images/emoticons/sad.png" alt="sad" /></label>
									<input type="radio" name="rating" id="s5" value="5" /><label for="s5"><img src="<?php echo base_url()?>public/images/emoticons/angry.png" alt="angry" /></label>
								
							</div>	
								
								
								<!-- <img src="<?php echo base_url()?>public/images/emoticons/excelent.png" alt="..."> -->
							</span>
						</h4>
						<div id="reviewerror"></div>
						<textarea class="form-control"  name="review" placeholder="Write Your Review Here" rows="4"></textarea>
						<input type="hidden" name="property_id" value="<?php echo $property_id;?>">
						<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<input type="button" id="saveReviewWrite" value="Save" class="btn btn-primary">
			</div>
		</div>
		</form>
	</div>
</div>
<?php
if(!empty($location))
{
	foreach($location as $row)
	{
?>
<input type="hidden" name="lat" id="lat" value="<?php echo $row->latitude; ?>">
<input type="hidden" name="long" id="long" value="<?php echo $row->longitude; ?>">
	<?php
	}
}
?>
<script src="<?php echo base_url()?>public/js/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url()?>public/js/bootstrap-datepicker.js"></script>  
<script src="<?php echo base_url()?>public/js/jquery.fitvids.js"></script>
<script src="<?php echo base_url()?>public/js/jquery.bxslider.js"></script>
<script src="<?php echo base_url()?>public/js/jquery-ui.js"></script> 
<script src="<?php echo base_url()?>public/js/bootstrap.min.js"></script>




					<script type="text/javascript">
							
						function load_login_popup()
						{
							$.post(BASE_URL+'overview/load_login_popup',
						      {},
						      function(data)
						      {
						        $('#modal_placeholder').html(data);     
						        $('#modal_placeholder').modal('show');
						      });	  
						}
						
						function load_registration_popup()
						{
							$.post(BASE_URL+'overview/load_registration_popup',
						      {},
						      function(data)
						      {
						        $('#modal_placeholder').html(data);     
						        $('#modal_placeholder').modal('show');
						      });	  
						}

				/***
				  * Function to validte the email-id
				  **/ 
			
				function validate_email(email_id)
					{
					  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
					  if(reg.test(email_id) == false)
					    return false;
					  else
					    return true;    
					}
					/***
					 * Function to add the error class to the input fields parent
					 **/
					 function add_error_class(input_id,error_text)
					 {  
					  $('#'+input_id).parent().addClass('error');
					  if (error_text == undefined) 
					    error_text = 'Required field : Please enter value.';
					  $('#error_'+input_id).remove();
					  var error_html = '<div id="error_'+input_id+'" class="validationError">'+error_text+'</div>';
					  $('#'+input_id).parent().append(error_html);
					  $('.validationError').on('click',function()
						{
							var id = this.id;
					    $('#'+id).parent().removeClass('error');  
					    $('#'+id).parent().find('.validationError').fadeOut(1000);
					    $('#validation_error').fadeOut(2000);
						});
					 }
					 /***
					 * Function to add the error class to the input fields parent
					 **/
					 function remove_error_class(input_id)
					 {
					  $('#'+input_id).parent().removeClass('error');  
					  $('#'+input_id).parent().find('.validationError').fadeOut(1000);
					  //Hide the error message
					  $('#validation_error').fadeOut(2000);
					 }
					/****
					 * Function to check the login creds
					 **/
					function check_login()
					{  
					 var email_id = $('#email_id').val();
					 var password = $('#password').val();
					 var error_flag = 0; 
					 //Check the validation
					 if (email_id == '')
					 {
					  add_error_class('email_id','Please enter the <strong>Email-Id</strong>.');
					  error_flag = 1; 
					 }
					 else if(email_id != '' && validate_email(email_id) == false)
					 {
					  add_error_class('email_id','Please enter the valid <strong>Email-Id</strong>.');
					  error_flag = 1; 
					 }
					 if (password == '')
					 {
					  add_error_class('password','Please enter the <strong>Password</strong>.');
					  error_flag = 1; 
					 }
					 
					 if(error_flag != 1) 
					 {
					  $.post(BASE_URL+'home/doLogin',
					  {
							'email_id' : email_id,
							'password' : password
					  },
					  function(data)
					  {
					    error_msg = '';
					    if (data == 'error') {
					      error_msg = "Login failed. Please try again.";
					      $('#validation_error_text').html(error_msg);
					      $('#validation_error').show();
					    }
					    else if(data == 'loginSuccess') {     
					      //window.location.reload(); //Refersh The page to set the session and update the task accordigly
								$('#modal_placeholder').modal('hide');
							 window.location = BASE_URL;
					    }
					  });
					 }
					}//end of the function
					/***
					 * Function to register
					 **/
					function sign_up()
					{
					  var first_name = $('#first_name').val();
						var last_name = $('#last_name').val();
					  var reg_email_id  = $('#reg_email_id').val();
					  var reg_password  = $('#reg_password').val();
						var phone_number = $('#phone_number').val();
					  var confirm_password = $('#confirm_password').val();
					  var error_flag = 0; 
					  
					  if(first_name == '')
					  {
					    add_error_class('first_name','Please enter the  <strong>First name </strong>.');
					    error_flag = 1; 
					  }
					  if(last_name == '')
					  {
					    add_error_class('last_name','Please enter the  <strong>Last name </strong>.');
					    error_flag = 1; 
					  }
					  if(reg_email_id == '')
					  {
					    add_error_class('reg_email_id','Please enter the  <strong>Email-Id</strong>.');
					    error_flag = 1; 
					  }
						else if(reg_email_id != '' && validate_email(reg_email_id) == false)
					  {
					    add_error_class('reg_email_id','Please enter the <strong> valid Email-Id </strong>.');
					    error_flag = 1; 
					  }
					  
					  if(reg_password == '') 
						{
					    add_error_class('reg_password','Please enter the  <strong>Password</strong>.');
					    error_flag = 1;   
					  }
						if(confirm_password == '') 
						{
					    add_error_class('confirm_password','Please enter the  <strong>Password</strong>.');
					    error_flag = 1;   
					  }
						if(reg_password != confirm_password )
					    {
					      add_error_class('reg_password','Please enter the  <strong>  Password </strong>.');
					       add_error_class('confirm_password','Please retype the  <strong> Password </strong>.');
					      error_flag = 1;
					    }
					  
					  if(error_flag != 1)
					  {
					  $.post(BASE_URL+'overview/signupUser',
					  {
					    'first_name':first_name,
							'last_name':last_name,
					    'reg_email_id' : reg_email_id,  
					    'password' : reg_password
					  },
					  function(data)
					  {
					    error_msg = '';
					    if (data == 'duplicate_error') {
					      error_msg = "Email-Id already present.";
					      $('#reg_validation_error_text').html(error_msg);
					      $('#reg_validation_error').show();
					    }
					    else if(data == 'success') {
					     
					     $('#modal_placeholder').modal('hide');
							 window.location = BASE_URL;
					    }
					  });
					 }
					}

		</script>





<script>
$(document).ready(function(){
$('#sites input:radio').addClass('input_hidden');
$('#sites label').click(function() {
    $(this).addClass('selected').siblings().removeClass('selected');
});



});
</script> 

<!-- BX Slider  -->
<script src="<?php echo base_url()?>public/js/jquery.bxslider.min.js"></script>   
<script type="text/javascript">
$(document).ready(function(){
    
    slider = $('ul.overview-hero-slider').bxSlider({
        auto: false,
        touchEnabled: true,
        pager: true,
        onSlideAfter:  function() {
	        $("#currentSlide").text(slider.getCurrentSlide() + 1);
	    }
    });
    $("#currentSlide").text(slider.getCurrentSlide() + 1);
    $("#totalSlide").text(slider.getSlideCount());

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [200, 300],
        slide: function(event, ui) {
            $("#min-value").text(ui.values[0]);
            $("#max-value").text(ui.values[1]);
        }
    });
    $("#min-value").text($("#slider-range").slider("values", 0));
    $("#max-value").text($("#slider-range").slider("values", 1));

    $("#btn-filter").click(function(){
        var currentState = $(this).find("i").attr("class");
        if($(this).find("i").hasClass("fa-chevron-down")){
            $("#filter-dropdown.results").css("display", "none");
        	$('html, body').animate({scrollTop: '0px'}, 300);
            $("#filter-dropdown").css("display", "block");
            $(this).find("i").removeClass("fa-chevron-down");
            $(this).find("i").addClass("fa-chevron-up");
        }else {
            $("#filter-dropdown").css("display", "none");
            $(this).find("i").addClass("fa-chevron-down");
            $(this).find("i").removeClass("fa-chevron-up");
        }
    });

    $('i[data-toggle="collapse"]').click(function(){
        $(this).toggleClass("fa-chevron-down fa-chevron-up");
    });

    $("#applyFilters").click(function(){
        $("#filter-dropdown").css("display", "none");
        $("#btn-filter").find("i").addClass("fa-chevron-down");
        $("#btn-filter").find("i").removeClass("fa-chevron-up");
        $("#filter-dropdown.results").css("display", "block");
    });

    $("#closeFilter").click(function(){
        $("#filter-dropdown").css("display", "none");
        $("#btn-filter").find("i").addClass("fa-chevron-down");
        $("#btn-filter").find("i").removeClass("fa-chevron-up");
    });

	$('#popover').popover({
	    html: 'true',
	    placement: 'bottom',
	    content : function() {
	        /*$(".datepicker").datepicker();*/

		    $('.boot-datepicker').datepicker({
		        format: 'dd-mm-yyyy',
		        viewMode: "days",
		        minViewMode: "days",
		        multidate: 2,
		        keyboardNavigation: false
		    }).on('changeDate', function(e) {
		        if (e.dates.length > 1) {
		            $(".datepicker").val("");
		            var checkIn = new Date(e.dates[0]);
		            var checkOut = new Date(e.dates[1]);
		            checkIn = convertToDate(checkIn);
		            checkOut = convertToDate(checkOut);
		            $(this).datepicker('clearDates');
		            $("#check_in_pop").val(checkIn);
		            $("#check_out_pop").val(checkOut);
		            $(".datepicker-dropdown").hide();
		        }
		    });
	        return $('#bookingPopover').html();
	    }
    });
  
    $("body").on('click', "#check_in_pop", function(){
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
    });

    $("#sub-nav .centered-content > a").click(function(event) {
    	event.preventDefault();
    	var scrollTo = $.trim($(this).text().toLowerCase());
	    $('html,body').animate({/*
			scrollTop: $(".div").data( "scroll" ).offset().top*/
			scrollTop: $('div[data-scroll="'+scrollTo+'"]').offset().top - 80
		},'slow');
	});

	$(".info-icons > li > a").click(function(event) {
    	event.preventDefault();
		console.log($(this).attr('data-scroll'));
    	var scrollTo = $.trim($(this).attr('data-scroll').toLowerCase());
		console.log(scrollTo);
	    $('html,body').animate({/*
			scrollTop: $(".div").data( "scroll" ).offset().top*/
			scrollTop: $('div[data-scroll="'+scrollTo+'"]').offset().top - 80
		},'slow');
	});
	
	//user options dropdown
	$("body").on('focus', '#userOptionsDropdown', function(){
		console.log($(this).closest('div.dropdown.open'));
		$(this).closest('div.dropdown').toggleClass('open');
	});




});		
</script>

<!-- Equal Heights Plugin -->
<!--<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.matchHeight.js"></script>-->
<script type="text/javascript">
  
	$('.bxslider').bxSlider({
  video: true,
  useCSS: false
});

</script>  

<!-- Google Map API -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
		var latitude=parseInt(document.getElementById('lat').value);
		var longitude=parseInt(document.getElementById('long').value);
    var mapCanvas = document.getElementById('map-wrapper');
    var myLatlng = new google.maps.LatLng(latitude,longitude);

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
<?php
								$number = '';
								$time_txt = '';
								
								$sum = '';
								if(!empty($response_time))
									{	
									$sum = 0;					
									foreach($response_time as $opt)
										{
										  $sent = $opt->sent_on;
										  $to_time = strtotime($sent);
										  $response = $opt->response_time;
										  $from_time = strtotime($response);
										  $time = round(abs($to_time - $from_time) / 60,2);
										  $sum +=$time;
										}

								   }

								if(!empty($response_count))
								{	
									
									$avg = $sum/$response_count;
									if(60 > $avg)
									{
										$number = number_format($avg, 2, '.', '');
										$time_txt = "min";
										//echo "average time in minute:- ".$min." minute";
									}				
									else
									{
										$avg_hr = $avg/60;
										$number = number_format($avg_hr, 1, '.', '');
										if($number > 2)
										{
											$time_txt = "hours";
										}	
										else{
											$time_txt = "hour";
										}
										
										//echo $hr.' hour';
									}
								
							   	}   
?>
<SCRIPT>
					//RAIKUMAR
						$(document).ready(function() {
							var showChar = 100;
							var ellipsestext = "...";
							var moretext = "more +";
							var lesstext = "less";
							$('.more').each(function() {
								var content = $(this).html();

								if(content.length > showChar) {

									var c = content.substr(0, showChar);
									var h = content.substr(showChar, content.length - showChar);

									var html ='<p>'+c+'<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>'+'</p>';

									$(this).html(html);
								}

							});

							/*$(".morelink").click(function(){*/
							$('body').on('click', '.morelink', function(){
								if($(this).hasClass("less")) {
									$(this).removeClass("less");
									$(this).html(moretext);
								} else {
									$(this).addClass("less");
									$(this).html(lesstext);
								}
								$(this).parent().prev().toggle();
								$(this).prev().toggle();
								return false;
							});
						});
			</SCRIPT>  

<script>
		


	function getReviewbySmiley(x)
	{		
			$("#review_main").hide();
			$("#review_on_click").empty();
			var url = BASE_URL + "overview/getReviewSmiley/"+x+"/"+prop_id;
			

			$.ajax({
				   type: "GET",
				   url: url,
				   dataType: 'text',
				    // shows the loader element before sending.
			        beforeSend: function () { //$(this).addClass('loading'); 
			        $(".loading").show();
			    	},
			        // hides the loader after completion of request, whether successfull or failor.             
			        complete: function () { //$(this).removeClass('loading'); 
			        $(".loading").hide();
			    	}, 
				   success: function(response) {												
							var x = response;
							x = jQuery.parseJSON(x);
						
							var html_code = "";
							console.log(x);
							for(var i = 0; i < x.length ; i++) {
								
								console.log(x[i]);
								var prof_image="";
								if(x[i].profile_pic === '')
								{
									prof_image = "no-image.png";
								}
								else
								{
									prof_image = x[i].profile_pic;
								}
								//var date = x[i].created_on;
								/*
								// Split timestamp into [ Y, M, D, h, m, s ]
								var t = date.split(/[- :]/);

								// Apply each element to the Date function
								var d = new Date(t[0], t[1], t[2], t[3], t[4], t[5]);
								*/
								var message = x[i].review_message;
								var msg = String(message);


						

								html_code = "<ul class='reviews'><li><div class='photo-name'><img src='"+BASE_URL+"public/uploads/user_image/"+prof_image+"' alt='sam' /><span>"+x[i].user_name+"</span></div><div class='review-text-content'><div class='date-general'><span>"+x[i].date+"</span><img src='"+BASE_URL+"public/images/emoticons/"+x[i].smiley_icon+"'alt='excelent class='my-emotion'/></div><div class='comment1 more1'>"+msg+"</div></div></li></ul>";
								$("#review_on_click").append(html_code);

								
							}

							$("#loaderDiv").hide();	

							var showChar = 85;
								var ellipsestext = "...";
								var moretext = "more +";
								var lesstext = "less";
								$('.more1').each(function() {
									var content = $(this).html();

									if(content.length > showChar) {

										var c = content.substr(0, showChar);
										var h = content.substr(showChar, content.length - showChar);

										var html ='<p>'+c+'<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent1"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink1">'+moretext+'</a></span>'+'</p>';

										$(this).html(html);
									}

								});

								$(".morelink1").click(function(){
								//$('body').on('click', '.morelink', function(){
									if($(this).hasClass("less1")) {
										$(this).removeClass("less1");
										$(this).html(moretext);
									} else {
										$(this).addClass("less1");
										$(this).html(lesstext);
									}
									$(this).parent().prev().toggle();
									$(this).prev().toggle();
									return false;
								});					
				   },
				   error: function(response) {
					
					  // alert(response);
					   console.log(response);
				   }
				 });
		
					  
	}


						

						function select_guest1() {

							  
							//var x = document.getElementById("guest_select").value;
							
							var e = '';
							var diff_date = '';
							if(document.getElementById("guest_select1")){
					           // var t =GetDays();
					           var minutes = 1000*60;
					    		var hours = minutes*60;
					    		var days = hours*24;

					    		var dropdt = document.getElementById("check_in_ov").value;
				                var pickdt = document.getElementById("check_out_ov").value;

					    		var foo_date1 = getDateFromFormat(dropdt, "d-M-y");
					    		var foo_date2 = getDateFromFormat(pickdt, "d-M-y");

					    		diff_date = Math.round((foo_date2 - foo_date1)/days);
					    		if(!dropdt)
					    		{
					    			alert("Check in and out date required...");
					    			$('#guest_select1').prop('selectedIndex',0);
					    			return;
					    		}
					    		
					    		//alert("Diff date is: " + diff_date );
					            e = document.getElementById("guest_select1");
					        }
					        	
					        var x = e.options[e.selectedIndex].value;
					    	//alert(x);
					    	$(".price_hide1").hide();					    	
							$(".price_show1").empty();

							$(".slider-price").hide();	
							//$("#pricehead").hide();	
							//$("#price_head").empty();	
							$(".slider-price-1").empty();	
							//$(".text-right").hide();	
							var guest_price = "<?php echo $guestCharge;?>";
							var price = "<?php echo $price1;?>";
							var t1 = (+guest_price)*(+x);
							var charge = (+price)+(+t1);
							//var tim ='';	
							/*
							var dropdt = new Date(document.getElementById("check_in_ov").value);
				            var pickdt = new Date(document.getElementById("check_out_ov").value);
				            var tim = parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
							*/
							var charge1 = (+charge)*diff_date;
							var tax = "<?php echo $service_charge+$tax_fee;?>";
							var total = (+tax)+(+charge1);
							var html_code = "";
							var html_price = "";
							html_code = "<table class='price-calculation'><tr><td><i class='fa fa-inr'></i> "+charge+" x "+diff_date
							+" nights</td><td><i class='fa fa-inr'></i> "+charge1+" </td>	</tr><tr><td>Service Fee + Taxes</td><td><i class='fa fa-inr'></i>"+tax+"</td></tr><tr><td>Total</td><td><i class='fa fa-inr'></i>"+total+"</td></tr></table>";
							html_price ="<div class='slider-price'><span><i class='fa fa-inr'></i>"+total+"</span><span class='small'>for "+diff_date+" nights</span></div>";
							$(".price_show1").append(html_code);
							//alert(html_price);

							/*var html_headprice = "";
							html_headprice = "<p class='text-left'><i class='fa fa-inr'></i>"+total+"</p>";
							$("#price_head").append(html_headprice);*/
							$(".slider-price-1").append(html_price);																									    
							}
					

					function select_guest() {
							var e = '';
							var diff_date = '';
							if(document.getElementById("guest_select")){
					           // var t =GetDays();
					           var minutes = 1000*60;
					    		var hours = minutes*60;
					    		var days = hours*24;

					    		var dropdt = document.getElementById("check_in_pop").value;
				                var pickdt = document.getElementById("check_out_pop").value;

					    		var foo_date1 = getDateFromFormat(dropdt, "d-M-y");
					    		var foo_date2 = getDateFromFormat(pickdt, "d-M-y");

					    		diff_date = Math.round((foo_date2 - foo_date1)/days);
					    		
					    		
					    		if(!dropdt)
					    		{
					    			alert("Check in and out date required...");
					    			$('#guest_select').prop('selectedIndex',0);
					    			return;
					    		}
					    		//alert("Diff date is: " + diff_date );
					            e = document.getElementById("guest_select");
					        }

							var x = e.options[e.selectedIndex].value;
					    	//alert(x);
					    	$(".price_hide").hide();
					    	//$(".text-right").hide();
					    	$(".slider-price").hide();					    	
							//$(".slider-price-1").empty();

							//$("#pricehead").hide();	
							//$("#price_head").empty();

							$(".price_show").empty();
							var guest_price = "<?php echo $guestCharge;?>";
							var price = "<?php echo $price1;?>";
							var t1 = (+guest_price)*(+x);
							var charge = (+price)+(+t1);
							var charge1 = (+charge)*diff_date;
							var tax = "<?php echo $service_charge+$tax_fee;?>";
							var total = (+tax)+(+charge1);
							var html_code = "";
							var html_price ="";
							html_code = "<table class='table table-bordered'><tr><td><i class='fa fa-inr'></i> "+charge+" x "+diff_date+" nights</td><td><i class='fa fa-inr'></i> "+charge1+" </td>	</tr><tr><td>Service Fee + Taxes</td><td><i class='fa fa-inr'></i>"+tax+"</td></tr><tr><td>Total</td><td><i class='fa fa-inr'></i>"+total+"</td></tr></table>";
							
							html_price ="<div class='slider-price'><span><i class='fa fa-inr'></i>"+total+"</span><span class='small'>for "+diff_date+" nights</span></div>";
							$(".price_show").append(html_code);
							//alert(html_price);
							/*var html_headprice = "";
							html_headprice = "<p class='text-left'><i class='fa fa-inr'></i>"+total+"</p>";
							$("#price_head").append(html_headprice);	
							*/
							$(".slider-price-1").append(html_price);
							//return false;																										    
							}


	
	
						function post_wishlist(uid, pid)
						{
						   //alert(uid+' '+pid);
						   
						  $('.fav').addClass('addwish').removeClass('fav').append("<p>Added..</p>").fadeIn('slow');
							
							var url= BASE_URL + 'overview/wishlist';

							$.ajax({
							  url: url,
							  type: "POST",
							  //dataType: 'text',
							  data: {prop_id: pid,
									user_id: uid},
							  success: function(data){
								  console.log(data);
								  
							  },
							   error: function(response) {								
								  // alert(response);
								   console.log(response);
								  // $('.smiley').addClass('fav').removeClass('smiley');
							   }
							});
									
						}
						
	
</script>
<!-- Circle Progress Bar -->
<script src="<?php echo base_url()?>public/js/circle-progress.js"></script>
<script>
	$('.circle1').circleProgress({
		    value: <?php echo $response_rate_percent;?>,
		    fill: { color: '#adce48' }
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
	});

	$('.circle2').circleProgress({
		    value: 1,
		    fill: { color: '#adce48' }
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').html(String(stepValue)*<?php if(empty($number)) echo 0; 
		    	else echo $number; ?> + '<br /><?php if(empty($time_txt)) echo "inquiry"; else echo $time_txt;?>');
	});


	
</script>
				

<script>
$(document).ready(function() {
	//sub nav on scroll effect
	$(document).on( 'scroll', function(){
		if ( $(window).scrollTop() > 780 ) {
			$("#sub-nav").css("display", "block");
			$("#filter-dropdown").css("margin-top","128px");
		} else {
			$("#sub-nav").css("display", "none");
			$(".popover").removeClass("in");
			$("#filter-dropdown").css("margin-top","77px");
		}
	});

    // Datepicker functionality
    $(".boot-datepicker").mousedown(function() {
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
    });

    $("#check_out_ov").focus(function() {
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
        $("#check_in_ov").focus();
    });

    $('.boot-datepicker').datepicker({
        format: 'dd-mm-yyyy',
        viewMode: "days",
        minViewMode: "days",
        multidate: 2,
        keyboardNavigation: false
    }).on('changeDate', function(e) {
        if (e.dates.length > 1) {
            $(".datepicker").val("");
            var checkIn = new Date(e.dates[0]);
            var checkOut = new Date(e.dates[1]);
            checkIn = convertToDate(checkIn);
            checkOut = convertToDate(checkOut);
            $(this).datepicker('clearDates');
            console.log(checkIn + ": " + checkOut);
            $("#check_in_ov").val(checkIn);
            $("#check_out_ov").val(checkOut);
            $(".datepicker-dropdown").hide();
            e.stopImmediatePropagation();
        }
    });

    $("body").on('focus', '#check_out_pop', function() {
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
        $("#check_in_pop").focus();
    });

    /*$('.boot-datepicker').datepicker({*/
    $("body").on('focus', '.boot-datepicker', function(){
		$(this).datepicker({
				format: 'dd-mm-yyyy',
				viewMode: "days",
				minViewMode: "days",
				multidate: 2,
				keyboardNavigation: false
			}).on('changeDate', function(e) {
			if (e.dates.length > 1) {
				$(".datepicker").val("");
				var checkIn = new Date(e.dates[0]);
				var checkOut = new Date(e.dates[1]);
				checkIn = convertToDate(checkIn);
				checkOut = convertToDate(checkOut);
				$(this).datepicker('clearDates');
				console.log(checkIn+": "+checkOut);
				console.log($("#check_in_pop"));
				$("#check_in_pop").val(checkIn);
				$("#check_out_pop").val(checkOut);
				$(".datepicker-dropdown").hide();
			}
		});
	});

    /* Converting dates to dd-mm-yyyy format */
    function convertToDate(dateVar) {
        var dd = dateVar.getDate();
        var mm = dateVar.getMonth() + 1; //January is 0!

        var yyyy = dateVar.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        var dateVar = dd + '-' + mm + '-' + yyyy;
        return dateVar;
    }


    $("#saveReviewWrite").click(function() {
        //var base_url = window.location.origin;
        //var base_url = <?php echo base_url();?>
        //var url = BASE_URL+'overview/writeReview';

        $.ajax({
            type: "POST",
            url: BASE_URL + 'overview/writeReview',
            contentType: 'application/x-www-form-urlencoded',
            data: $("#formReviewWrite").serialize(),
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status === 400) {
                    //var obj = JSON.parse(response);							
                    //document.getElementById("reviewerror").innerHTML =
                    alert(obj.review + "\n" + obj.rating);
                } else {
                    alert(obj.message);
                    window.location.reload(true);
                }
            },
            error: function(data) {
                console.log(data);
                //alert(data);
            }
        });
    });
});

</script>
	<script>
	//become a host click
	function load_login_popup_to_createproperty()
	{
		$.post(BASE_URL+'overview/load_login_popup_to_createproperty',
		  {},
		  function(data)
		  {
			$('#modal_placeholder').html(data);     
			$('#modal_placeholder').modal('show');
		  });	  
	}
	</script>
	
	
	<!---Header search functionality(Raikumar)-->

	<script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap3-typeahead.js"></script>

	<script type="text/javascript">
    (function() {

        $(function() {
        	$('.property-height').matchHeight();
            $('div.equal-heights').matchHeight();
            $('div.equal-heights2').matchHeight();
            $('div.equal-heights3').matchHeight();
            $('ul.footer-cols > li').matchHeight();
						var cities = ['Delhi','Mumbai,Maharashtra','Bangalore,Karnataka','Chennai,Tamilnadu','Kolkata,West Bengal'];

		$('#autocomplete_city').typeahead({
			source: cities
        });
				
		});

    })();
	</script> 	

	<script type="text/javascript">
		function load_data()
		{
			var city = $('#city').val();
			var guest = $('#guest').val();
			totalrecords=parseInt(document.getElementById('totalrecords').value);
			check=document.getElementById('hiddenoffset').value;
			setcheck=parseInt(check )+ parseInt('10');
			//console.log(totalrecords);
			if(totalrecords > check )
			{	
				$.post(BASE_URL+'search/searchresult',
				{	'offset' : check,
					'per_page' : 10,
					'autocomplete_city' : city,
					'guest' : guest
		    },	
		      function(data)
		      {		
						$( "#filter" ).append(data);
					});
						$('#hiddenoffset').val(setcheck);
		  }
			else
			{
				alert('NO More Records.');
			}
		}
		function sort()
		{
			var sort_by = $("#sort option:selected").val();
			var city = $('#city').val();
			var guest = $('#guest').val();
			var room_type = $('#room_type').val();
			var property_type = $('#property_type').val();
			var bed = $('#bed').val();
			var bedroom = $('#bedroom').val();
			var bathroom = $('#bathroom').val();
			var min_package = $('#min_package').val();
			var max_package = $('#max_package').val();
			var offset = $('#offset').val();
			var option = 'sort';
				$.post(BASE_URL+'search/searchresult',
				{	'offset' : offset,
					'sort_by' :sort_by,
					'autocomplete_city' : city,
					'guest' : guest,
					'option' : option
		    },	
		      function(data)
		      {		
						$('#filter').html(data);  
					});
		}
		function sort_popularity(value)
		{
			var city = $('#city').val();
				$.post(BASE_URL+'search/searchresultpopular',
				{	
					'autocomplete_city' : city,
					 'smiley_id':value
		    },	
		      function(data)
		      {		
						$('#filter').html(data);  
					});
			
		}
		function show_tag_property(value)
		{
			var city = $('#city').val();
				$.post(BASE_URL+'search/searchresulttags',
				{	
					'autocomplete_city' : city,
					 'tag_id':value
		    },	
		      function(data)
		      {		
						$('#filter').html(data);  
					});
		}
		</script>

		


	<script>
	$(document).ready(function() {
		
	    $("#slider-range").slider({
	        range: true,
	        min: 0,
	        max: 10000,
	        values: [500, 5000],
	        slide: function(event, ui) {
	            $("#min-value").text(ui.values[0]);
	            $("#max-value").text(ui.values[1]);
	        }
	    });
	    $("#min-value").text($("#slider-range").slider("values", 0));
	    $("#max-value").text($("#slider-range").slider("values", 1));

	});
	</script>
		
	

				