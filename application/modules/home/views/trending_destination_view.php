<?php echo $this->load->view('header_home');?>
<div id="hero-wrapper">
	<ul class="hero-slider-trending">
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
	</ul>
	<div class="overview-hero-content">
		<span class="visited slider-count">
			<span id="currentSlide"></span> &nbsp;|&nbsp; 
			<span id="totalSlide"></span>
		</span><!-- end counter -->
		<div class="slider-img-info">
			<div id="topTrending">
				<p id="topDestination">250+ properties in ladakh</p>
				<p id="topDestinationCount">250+ properties in ladakh</p>
			</div>
			<span>CHECK NOW</span>
		</div><!-- end slider-price -->
	</div><!-- end overview-hero-content -->
</div>
<!-- end hero-wrapper -->
<div class="main-content">
	<div class="centered-content" id="trending-destinations">
		<div class="row no-side-margin">
			<div class="col-md-12 text-center">
				<p class="hero-text">
					India does not have a shortage of mind-blowing sights and activities. From historical forts and stupas to pristine beaches all the way to scenic, snow-covered peaks, it’s all happening here.
				</p>
				<hr/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-left">
				<img src="<?php echo base_url().'/public/css/img/map-icon.png'; ?>">
				<a id="linkTrending" href="#">20+ Trending Destinations</a>
			</div>
		</div>
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
					<a href="javascript:void(0);"><?php echo $destination->title; ?></a>
				</div>
				<!-- end text-overlay -->
			</li>
			<!-- end madhya-pradesh -->
			<?php
				}
				}
				?>
		</ul>
		<!-- end destinations-grid -->
		<h2 class="load-more-caption">
			<a href="#">load more...</a>
		</h2>
	</div>
	<!-- end centered-content -->
</div>
<?php echo $this->load->view('footer_home');?>