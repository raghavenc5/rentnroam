<script>
	

					function load_login_popup()
					{
						$.post(BASE_URL+'search/load_login_popup',
						{
							'gpAuthUrl': "<?php echo $gpAuthUrl; ?>",
							'fbLoginUrl': "<?php echo $fbLoginUrl; ?>",
							'currentUrl': "<?php echo current_url(); ?>",
						},
						function(data)
						{
							$('#modal_placeholder').html(data);     
							$('#modal_placeholder').modal('show');
						});	  
					}
					function load_registration_popup()
					{
						$.post(BASE_URL+'search/load_registration_popup',
						{
							'gpAuthUrl': "<?php echo $gpAuthUrl; ?>",
							'fbLoginUrl': "<?php echo $fbLoginUrl; ?>",
							'currentUrl': "<?php echo current_url(); ?>",
						},
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

</script>
	
<?php 
	$city = $data['city'] = $this->session->userdata('city');
	$data['room_type'] = $room_type;
	$data['property_type'] = $property_type;
	$data['amenities'] = $amenities;
	$data['amenities1'] = $amenities1;
	echo $this->load->view('header_filter',$data);
?>
	</div>
		<div id="overview-hero-wrapper">
			<ul class="overview-hero-slider">
			<?php
		if(!empty($slider_images))
		{
			foreach($slider_images as $row)
			{
				$slider_image_path = base_url().'public/uploads/home/slider_image/';
				$slider_image = $row->slider_image;
				if($slider_image!='')
				{
				 $image = $slider_image_path.$slider_image;
				}
				else
					$image='';
				?>
				<li>
					<img src="<?php echo $image ; ?>" alt="slider image">
				</li>
			<?php
			}
		}
		?>
			</ul><!-- end overview-hero-slider ------>
			<div class="overview-hero-content">
				<span class="visited slider-count">
					<span id="currentSlide"></span> 
					<span id="totalSlide"></span>
				</span><!-- end counter -->
				<div class="slider-img-info">
					<h1>ESCAPE TO <?php echo $city; ?> AT<i class="fa fa-inr"></i>2999*/NIGHT</h1>
					<span>BOOK NOW</span>
				</div><!-- end slider-price -->
			</div><!-- end overview-hero-content -->
		</div><!-- end overview-hero-wrapper -->
		<div class="container">
			<div class="row no-side-margin">
				<div class="col-md-12 text-center">
					<p class="hero-text">
						A gateway from the noise of the city. A breath of fresh air for the adventuring couple. A source of inspiration for the city write. Or Simply an excuse to enjoy the beauty of the nature and the woods. If any of these sound like something that awakens your inner traveler, be sure to give this fully furnished place a chance.
					</p>
					<hr/>
				</div>
			</div>
			<div id="center-override" class="row">
				<div class="col-md-8 sort-desc mrgnleft100">
					<img class="pull-left" alt="map marker" src="<?php echo base_url()?>public/css/img/map-icon.png">
					<div id="update_count">
					<?php	echo $this->load->view('record_data',$data); ?>
					</div>
					<div class="pull-left">
					
						<div class="styled-select">
                            <select class="form-control" id="sort" onchange="sort();">
								<option value="">SORT BY</option>
                                <option value="high_price">High Price</option>
                                <option value="low_price">Low Price</option>
                            </select>
                        </div>
					</div>
				</div>
				<div class="col-md-4 mrgnleft100">
					<p class="ratings pull-right">
						<img class="pull-left filter-rating" alt="map marker" src="<?php echo base_url()?>public/images/emoticons/excelent.png">
						<img class="pull-left filter-rating" alt="map marker" src="<?php echo base_url()?>public/images/emoticons/happy.png">
						<img class="pull-left filter-rating" alt="map marker" src="<?php echo base_url()?>public/images/emoticons/not-happy.png">
						<img class="pull-left filter-rating" alt="map marker" src="<?php echo base_url()?>public/images/emoticons/sad.png">
						<img class="pull-left filter-rating" alt="map marker" src="<?php echo base_url()?>public/images/emoticons/angry.png">
						<!-- <i class="fa fa-smile-o" id="excellent" value="5" onclick="sort_popularity(5);"></i>
						<i class="fa fa-smile-o" id="happy" value="4" onclick="sort_popularity(4);"></i>
						<i class="fa fa-smile-o" id="not_happy" value="3" onclick="sort_popularity(3);"></i>
						<i class="fa fa-smile-o" id="sad" value="2" onclick="sort_popularity(2);"></i>
						<i class="fa fa-smile-o" id="angry" value="1" onclick="sort_popularity(1);"></i> -->
						 Excellent
					</p>
				</div>
		<div id="filter">
				<?php 
				$data['property'] = $property;				
				echo $this->load->view('filter_data',$data);
				?>
				</div>
				<input type="hidden" id="hiddenoffset" name="hiddenoffset" value="10">
					<input type="hidden" id="totalrecords" name="totalrecords" value="<?php echo $total_num_records; ?>">
			</div>
			<?php
			if($total_num_records > 10 )
			{	
		?>
			<div class="row no-side-margin">
				<div class="col-md-12 no-side-margin text-center" onclick="load_data();">
					<h2>LOAD MORE...</h2>
				</div>
			</div>
			<?php
			}
			?>
			<div class="row centered-content">
				<div class="col-md-12 sub-footer">
					<div class="col-md-4 listing-block text-center">
						<img src="<?php echo base_url()?>public/images/wanderer.png" alt="Blog" class="img-circle img-rounded img-sub-footer">
						<h2 class="text-left">The Wanderer Chronicles</h2>
						<p class="text-left">Check out our featured travel blog, created by a travel enthusiast staying in Rent n Roam properties around the country!</p>
						<hr class="full-width" />
						<h2 class="pull-right mrgnbtm20"> <a href="#">Read More</a></h2>
					</div>
					<div class="col-md-4 sub-footer-middle">
						<h2 class="mrgnbtm20">
							<img src="<?php echo base_url()?>public/css/img/facebook.png" alt="FB">
							24th Dec
						</h2>
						<p class="text-left">Check out our featured travel blog, created by a travel enthusiast staying in Rent n Roam properties around the country! Rent n Roam properties around the country! <a href="#">Read More</a></p>
						<hr/>
						<h2 class="mrgnbtm20">
							<img src="<?php echo base_url()?>public/css/img/facebook.png" alt="FB">
							24th Dec
						</h2>
						<p class="text-left">Check out our featured travel blog, created by a travel enthusiast staying in Rent n Roam properties around the country! Rent n Roam properties around the country! <a href="#">Read More</a></p>
						<h2 class="pull-right mrgnbtm20"><a href="#">MORE...</a></h2>
					</div>
					<div class="col-md-4 location-listing">
					<?php
					if(!empty($tags))
					{
						foreach($tags as $row)
						{
							?>
						<div onclick="show_tag_property(<?php echo $row->id; ?>)";><?php echo $row->tag; ?></div>
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="city" name="city" value="<?php echo $this->session->userdata('city'); ?>">
		 <input type="hidden" id="guest" name="guest" value="<?php echo $this->session->userdata('guest'); ?>">
		 <input type="hidden" id="room_type" name="room_type" value="<?php echo $this->session->userdata('room_type'); ?>">
		 <input type="hidden" id="property_type" name="property_type" value="<?php echo $this->session->userdata('property_type'); ?>">
		 <input type="hidden" id="bed" name="bed" value="<?php echo $this->session->userdata('bed'); ?>">
		 <input type="hidden" id="bedroom" name="bedroom" value="<?php echo $this->session->userdata('bedroom'); ?>">
		 <input type="hidden" id="bathroom" name="bathroom" value="<?php echo $this->session->userdata('bathroom'); ?>">
		 <input type="hidden" id="min_package" name="min_package" value="<?php echo $this->session->userdata('min_package');?>">
		 <input type="hidden" id="max_package" name="max_package" value="<?php echo $this->session->userdata('max_package');?>">
		 <input type="hidden" id="offset" name="offset" value="<?php echo $this->session->userdata('offset');?>">

		 
		 
<?php echo $this->load->view('footer_filter');?>



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