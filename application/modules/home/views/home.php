<?php echo $this->load->view('header_home');?>
<div id="hero-wrapper">
	<ul class="hero-slider">
	<?php
		if(!empty($slider_images))
		{
			foreach($slider_images as $row)
			{
				$slider_image_path = base_url().'/public/uploads/home/slider_image/';
				$slider_image = $row->slider_image;
				if($slider_image!='')
				{
				 $image = $slider_image_path.$slider_image;
				}
				else
					$image='';
				?>
				
				<li><img src="<?php echo $image ?>"></li>
	<?php
			}
		}
	?>
	</ul><!-- end hero-slider -->
	<div class="hero-content">
		<h1>Where will you roam next?</h1>
			<form class="planner"  method="post" action="<?php echo  base_url()?>search/searchresult">
				<input type="text" id="autocomplete_city" placeholder="City" name="autocomplete_city" required/>
			    <input type="text" id="check_in" name="check_in" class="boot-datepicker datepicker" placeholder="check in" />
			    <input type="text" id="check_out" name="check_out" class="datepicker" placeholder="check out" />
				<div id="guestDropdown" class="dropdown">
					<a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Guests
					</a>
					<input type="hidden" id="guest" name="guest" value="">
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">1 Guests</a></li>
						<li><a href="#">2 Guests</a></li>
						<li><a href="#">3 Guests</a></li>
						<li><a href="#">4 Guests</a></li>
						<li><a href="#">5 Guests</a></li>
						<li><a href="#">6 Guests</a></li>
						<li><a href="#">7 Guests</a></li>
						<li><a href="#">8 Guests</a></li>
						<li><a href="#">9 Guests</a></li>
						<li><a href="#">10+ Guests</a></li>
					</ul>
				</div>
				<input type="submit" value=""  />
			</form><!-- end planner -->
	</div><!-- end hero-content -->
	<div class="app-section" id="app_section">
		<span>Download the RentnRoam app for free today. Send me a link to download the app</span>
		<form>
			<input type="text" id="mobile_number" name ="mobile_number" placeholder="Enter mobile number" value=""/>
			<input type="button" value="" onclick="add_number();" />
		</form>
		<span class="closex"></span><!-- end closex -->
	</div><!-- end app-section -->
</div><!-- end hero-wrapper -->
<div class="main-content">
	<div class="centered-content" id="hot-offers">
	<h2>Hot Offers</h2>
	<p>
		Spontaneity is the mark of a true explorer. See what our offers can<br /> do for the adventurer in you. <a href="<?php echo base_url(); ?>home/hotOffer">VIEW ALL</a>
	</p>
	<?php
	if(!empty($hot_offer))
	{
		$city = array();
		$price = array();
		foreach($hot_offer as $row)
		{
			//$image = array();
			// add each row returned into an array
			$city[] = $row->city_name;
			$price[] = $row->price;
			$hot_offer_image[] = $row->images;
			//print_r($hot_offer_image);
		}
	}
	?>
				<ul class="offers-grid">
					<li>
						<div class="full-height">
							<img src="<?php echo base_url()?>public/uploads/property_image/<?php echo $hot_offer_image[0]; ?>" alt="mumbai" />
							<div class="info-box">
								<span class="name"><?php echo $city[0]; ?></span>
								<span class="price">₹<?php echo $price[0]; ?></span>
							</div><!-- end info-box -->
						</div><!-- end full-height -->
					</li>
					<li>
						<div class="half-height">
							<img src="<?php echo base_url()?>public/uploads/property_image/<?php echo $hot_offer_image[1]; ?>" alt="delhi" />
							<div class="info-box">
								<span class="name"><?php echo $city[1]; ?></span>
								<span class="price">₹<?php echo $price[1]; ?></span>
							</div><!-- end info-box -->
						</div><!-- end half-height -->
						<div class="half-height">
							<img src="<?php echo base_url()?>public/uploads/property_image/<?php echo $hot_offer_image[2]; ?>" alt="mumbai2" />
							<div class="info-box">
								<span class="name"><?php echo $city[2]; ?></span>
								<span class="price">₹<?php echo $price[2]; ?></span>
							</div><!-- end info-box -->
						</div><!-- end half-height -->
					</li>
					<li>
						<div class="half-height">
							<img src="<?php echo base_url()?>public/uploads/property_image/<?php echo $hot_offer_image[3]; ?>" alt="simla" />
							<div class="info-box">
								<span class="name"><?php echo $city[3]; ?></span>
								<span class="price">₹<?php echo $price[3]; ?></span>
							</div><!-- end info-box -->
						</div><!-- end half-height -->
						<div class="half-height">
							<img src="<?php echo base_url()?>public/uploads/property_image/<?php echo $hot_offer_image[4]; ?>" alt="mumbai3" />
							<div class="info-box">
								<span class="name"><?php echo $city[4]; ?></span>
								<span class="price">₹<?php echo $price[4]; ?></span>
							</div><!-- end info-box -->
						</div><!-- end half-height -->
					</li>
				</ul><!-- end offers-grid -->
			</div><!-- end centered-content -->
			<div class="centered-content" id="trending-destinations">
				<h2>Trending Destinations</h2>
				<p>
					India does not have a shortage of mind-blowing sights and activities. From historical forts and stupas to pristine beaches all the way to scenic, snow-covered peaks, it’s all happening here <a href="<?php echo base_url(); ?>home/trendingDestination">See what's trending</a>
				</p>
				<ul class="destinations-grid">
				<?php
				if(!empty($trending_destination))
				{
					foreach($trending_destination as $destination)
					{
						$destination_image_path = base_url().'/public/uploads/home/trending_destination/';
						$destination_image = $destination->image;
						$overlay_image = $destination->overlay_image;
							if($destination_image!='')
							{
								$destination_image = $destination_image_path.$destination_image;
								$overlay_image = $destination_image_path.$overlay_image;
							}
						else
						{
						 $destination_image='';
					 $overlay_image  = '';
						}
				?>
					<li style="background: url('<?php echo $destination_image; ?>');">
						<div class="text-overlay" style="background: url('<?php echo $overlay_image;?>');">
							<a href="javascript:void(0);"><?php echo $destination->city_name; ?></a>
						</div><!-- end text-overlay -->
					</li><!-- end madhya-pradesh -->
					<?php
					}
				}
					?>
				</ul><!-- end destinations-grid -->
			</div><!-- end centered-content -->
				<?php
					if(!empty($upcoming_festival))
					{
						foreach($upcoming_festival as $event)
						{
							$event_image_path = base_url().'/public/uploads/home/what_happening/';							
							$event_image = $event->image;
							if($event_image!='')
							{
								$event_image = $event_image_path.$event_image;
							}
						else
						 $event_image='';
						}
					}
					$dateValue = $event->date;
					$time=strtotime($dateValue);
					$month=date("F",$time);
					$year=date("y",$time);
					$date=date("d",$time);
				?>
			<div id="happening" class="centered-content group">
				<img src="<?php echo $event_image?>" alt="grapes-bottle" class="left-overflow-image" />
				<div class="happening-text">
					<h2>What’s Happening?</h2>
					<p style="width:100%;">
							<?php echo $event->description; ?><a href="<?php echo base_url(); ?>home/eventHappenings">view all</a>
					</p>
					<div class="pink-separator"></div><!-- end pink-separator -->
					<div class="banners">
						<div class="date-banner">
							<span class="large"><?php echo $date; ?>th</span>
							<span><?php echo $month; ?>, <?php echo $year; ?></span>
						</div><!-- end date-banner -->
						<div class="gray-banner">
							<span><?php echo $event->title; ?> <a href="<?php echo base_url(); ?>home/eventHappenings">know more</a></span>
						</div><!-- end gray-banner -->
					</div><!-- end banners -->
				</div><!-- end happening-text -->
			</div><!-- end centered-content -->
			<div id="mid-section">
				<span class="down-arrow"></span><!-- end down-arrow -->
			</div><!-- end mid-section -->
			<div class="centered-content" id="rnr-recommeded">
				<h2>RnR Recommended</h2>
				<p>
					How many of our recommended destinations have you been to? These standout<br /> getaways are designed to satiate the wanderlust in you.<a href="<?php echo base_url(); ?>home/rnrRecommend">view all</a>
				</p>
				<ul class="three-squares-grid">
				<?php
					if(!empty($recommend_property))
					{
					foreach($recommend_property as $property)
					{
						$recommend_property_image_path = base_url().'/public/uploads/property_image/';
							$recommend_property_image = $property->images;
							if($recommend_property_image!='')
							{
								$recommend_property_image = $recommend_property_image_path.$recommend_property_image;
							}
						else
						 $recommend_property_image='';
				?>
					<li>
						<img src="<?php echo $recommend_property_image; ?>" alt="delhi" />
						<span class="rnr-baner"></span><!-- end rnr-baner -->
						<div class="info-box">
							<span class="name"><?php  echo $property->city_name; ?></span>
							<span class="price"><?php  echo $property->price; ?></span>
						</div><!-- end info-box -->
					</li>
					<?php
					}
					}
					?>
					
				</ul><!-- end three-squares-grid -->
			</div><!-- end centered-content -->
			<div class="centered-content">
				<h2>PEOPLE STORIES</h2>
				<p>
					Possibly the best part of travel are the stories we come back with. They come to define us, to help us grow and understand the world a little better. <a href="<?php echo base_url(); ?>home/peopleStories">VIEW ALL</a>
				</p>
				<ul class="stories-grid">
					<li class="two-cols">
						<div class="full-height">
							<img src="<?php echo base_url()?>public/images/stories/rahul-raima.jpg" alt="rahul-raima" />
							<div class="yellow-banner">
								<span class="large">TOP STORIES</span>
								<span>Rahul &amp; Raima <a href="<?php echo base_url(); ?>home/peopleStories">read now</a></span>
							</div><!-- end yellow-banner -->
						</div><!-- end full-height -->
					</li><!-- end two-cols -->
					<li>
						<div class="half-height">
							<img src="<?php echo base_url()?>public/images/stories/beautiful-home.jpg" alt="beautiful-home" />
							<div class="yellow-banner">
								<span>
									Beautiful home
								</span>
								<a href="<?php echo base_url(); ?>home/peopleStories">Read more</a>
							</div><!-- end yellow-banner -->
						</div><!-- end half-height -->
						<div class="half-height">
							<img src="<?php echo base_url()?>public/images/stories/exicting-trip.jpg" alt="exicting-trip" />
							<div class="yellow-banner" id="bottom-banner">
								<span>
									Exicting Trip
								</span>
								<a href="<?php echo base_url(); ?>home/peopleStories">Read more</a>
							</div><!-- end yellow-banner -->
						</div><!-- end half-height -->
					</li>
				</ul><!-- end stories-grid -->
				<ul class="three-cols-grid">
					<li class="featured-blog">
						<div class="image-frame">
							<img src="<?php echo base_url()?>public/images/wanderer.png" alt="wanderer" />
						</div><!-- end image-frame -->
						<h3>The Wanderer Chronicles</h3>
						<p>
							Check out our featured travel blog, created by a travel enthusiast staying in Rent n Roam properties around the country! 
						</p>
						<div class="col-footer">
							<a href="#" class="read-more">Read more</a><!-- end read-more -->
						</div><!-- end col-footer -->
					</li><!-- end featured-blog -->
					<li class="social-networks">
						<ul>
							<li class="twitter">
								<h3>24th Dec</h3>
								<p>
									Mussoorie the beautiful! The winter line, the mist, the haze and of course, the mountains. 
Waque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.  <a href="#">Read more...</a>
								</p>
							</li><!-- end twitter -->
							<li class="facebook">
								<h3>30th Dec</h3>
								<p>
									This week, Udaipur! Colorful, vibrant and deeply cultural. Friendly people, delicious food and an amazing stay in the middle of the city. Traveling on a budget, but living like a queen with Rent n Roam housing! <a href="#">Read more...</a>
								</p>
								<div class="col-footer">
									<a href="#" class="read-more">More...</a><!-- end read-more -->
								</div><!-- end col-footer -->
							</li><!-- end facebook -->							
						</ul>
					</li><!-- end social-networks -->
					<li class="posts">
						<ul>
						<?php
					if(!empty($people_stories))
					{
					foreach($people_stories as $stories)
					{
						$article = $stories->article_text;
						$story = word_limiter($article, 10);
						$cur_date = date('Y-m-d H:i:s');
					  $time_diff = get_time_diff($stories->created_on,$cur_date);
						$user_image_path = base_url().'/public/uploads/user_image/';		 				
						$user_image = $stories->profile_pic;
						if($user_image!='')
						{
							$image = $user_image_path.$user_image;
						}
					else
					 $image='';
				?>
							<li>
								<img src="<?php echo $image; ?>" alt="geeta" />
								<div class="post-text-content">
									<a href="#" class="byline"><?php echo $stories->user_name; ?>, <?php echo $time_diff; ?></a>
									<p>
										<?php echo $story; ?>  <a href="<?php echo base_url(); ?>home/peopleStories">Read more...</a>
									</p>
								</div><!-- end post-text-content -->
							</li>
					<?php
					}
					}
					?>
						</ul>
						<div class="col-footer">
							<a href="<?php echo base_url(); ?>home/peopleStories" class="read-more">More...</a><!-- end read-more -->
						</div><!-- end col-footer -->
					</li><!-- end posts -->
				</ul><!-- end three-cols-grid -->
			</div><!-- end centered-content -->
		</div><!-- end main-content -->
	</div><!-- end inner_container -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  
	<script type="text/javascript">
	$(document).ready(function() {
		$( this ).on( 'focus', ':input', function(){
	        $( this ).attr( 'autocomplete', 'off' );
	    });
		//For Datepicker
		var date = new Date();
		date.setDate(date.getDate()-1);
		$('#check_in').datepicker({ 
				startDate: date
		});
		
    $("#mobile_number").keydown(function (e) {
			//alert('hi');
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
	function add_number() {
		//$("#mobile_number").attr("placeholder", "Invalid Mobile Number");
		var mobile_number = $('#mobile_number').val();
		var error_flag = 0;
		var pattern = /^\d{10}$/;
		//console.log(mobile_number);
		if (mobile_number == '')
		{
			// var html = '<div class="bootbox">Please Enter Mobile Number.</div>';
			// bootbox.alert(html)
			//alert("Please Enter Mobile Number.");
			$("#mobile_number").attr("placeholder", "Please Enter Mobile Number.");
			error_flag = 1; 
		}
		
     else if (pattern.test(mobile_number)) 
		 {
            //alert("Your mobile number : " + mobile);
            //return true;
        }
				else
				{
					//alert("It is not valid mobile number.input 10 digits number!");
					// var html = '<div class="bootbox">It is not valid mobile number.input 10 digits number!</div>';
					// bootbox.alert(html)
					$("#mobile_number").attr("placeholder", "It is not valid mobile number.input 10 digits number!");
					$('#mobile_number').val('');
					error_flag = 1;
				}
        
        //return false;
		if(error_flag != 1) 
	{
		$.post(BASE_URL+'home/doAppsmobilenostore',
		{
			'mobile_number' : mobile_number
		},
		function(data)
		{
			//alert('Shortly you will receive message from us.');
			var html = '<div class="bootbox">Shortly you will receive message from us.</div>';
			bootbox.alert(html)
			$('#mobile_number').val('');
		});
	}
	}
	
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
	<?php echo $this->load->view('footer_home');?>
