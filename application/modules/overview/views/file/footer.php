<div class="modal fade registrationModal" id="modal_placeholder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	
</div>
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
<!-- Modal -->
<div class="modal fade" id="writeReviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Write Review</h4>
			</div>
			<div class="modal-body">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<img class="media-object" alt="Image Error" src="<?php echo base_url()?>public/images/host.png">
						</a>
						<p>Lorem Ipsum</p>
					</div>
					<div class="media-body">
						<h4 class="media-heading">
							July 2015
							<span>
								<img src="<?php echo base_url()?>public/images/emoticons/excelent.png" alt="...">
							</span>
						</h4>
						<textarea class="form-control" placeholder="Write Your Review Here" rows="4"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
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
<script src="<?php echo base_url()?>public/js/home.js"></script>  
 <script src="<?php echo base_url()?>public/js/jquery.fitvids.js"></script>
  <script src="<?php echo base_url()?>public/js/jquery.bxslider.js"></script>
<script src="<?php echo base_url()?>public/js/jquery-ui.js"></script> 
<script src="<?php echo base_url()?>public/js/bootstrap.min.js"></script>
 
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

    $(document).on('focus','.datepicker', function(){
	    $(this).datepicker();
	});

	$('#popover').popover({
	    html: 'true',
	    placement: 'bottom',
	    content : function() {
	        return $('#bookingPopover').html();
	        $(".datepicker").datepicker();
	    }
    });

});		
</script>  

<!-- Datepicker -->
  <script>
  $(function() {
    /*$('.datepicker').datepicker();*/
  });
  </script>

<!-- Equal Heights Plugin -->
<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.matchHeight.js"></script>
<script type="text/javascript">
    (function() {

        $(function() {            
            $('div.equal-heights').matchHeight();
            $('div.equal-heights2').matchHeight();
            $('div.equal-heights3').matchHeight();
            $('ul.footer-cols > li').matchHeight();
        });

    })();
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

<!-- Circle Progress Bar -->
<script src="<?php echo base_url()?>public/js/circle-progress.js"></script>
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
<script src="<?php echo base_url()?>public/js/home.js"></script>  
</body>
</html>