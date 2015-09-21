
<div id="filter">
</div>
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
					<li><a href = "mailto:support@rnr.com">Email us on: support@rnr.com</a></li>
				</ul><!-- end contact -->
				<h3>Set your Currency</h3>
				<form class="currency">
				  <select>
					<option value="">Select Your Currency</option>
				    <option value="aud">INR</option>
				    <option value="aud">$USD</option>
				  </select>
				</form><!-- end currency -->
				<div class="group">
					<h3 class="inline">Join Us on</h3>
					<ul class="social">
							<li class="twitter"><a href="https://twitter.com/" target="_blank">twitter</a></li>
						<li class="facebook"><a href="https://www.facebook.com/" target="_blank">facebook</a></li>
						<li class="rss"><a href="#">rss</a></li>
						<li class="google"><a href="https://plus.google.com/" target="_blank">google</a></li>
					</ul><!-- end social -->
				</div><!-- end group -->
			</div><!-- end footer-content -->
		</div><!-- end centered-content -->
	</div><!-- end footer -->
</div><!-- end container -->
<script src="<?php echo base_url()?>public/js/jquery-1.10.1.min.js"></script>
<script src="<?php echo base_url()?>public/js/bootstrap.min.js"></script>
<!-- BX Slider  -->
<script src="<?php echo base_url()?>public/js/jquery.bxslider.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap3-typeahead.js"></script>
<!-- Datepicker -->
<script src="<?php echo base_url()?>public/js/jquery-ui.js"></script>
<script src="<?php echo base_url()?>public/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>public/js/filter.js"></script>   

<!-- Equal Heights Plugin -->
<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.matchHeight.js"></script>
<script type="text/javascript">
    (function() {

        $(function() {
        	$('.property-height').matchHeight();
            $('div.equal-heights').matchHeight();
            $('div.equal-heights2').matchHeight();
            $('div.equal-heights3').matchHeight();
            $('ul.footer-cols > li').matchHeight();
			$('div.matchHeight').matchHeight();
            $('.sub-footer > div').matchHeight();
			var cities = ['Delhi','Mumbai,Maharashtra','Bangalore,Karnataka','Chennai,Tamilnadu','Kolkata,West Bengal'];

		$('#autocomplete_city').typeahead({
			source: cities
        });
				
		});

    })();
</script>  


<!-- Google Map API -->
<!--
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
    var mapCanvas = document.getElementById('map-wrapper');
    var myLatlng = new google.maps.LatLng(18.754887, 73.405371);

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
</script>-->

<!-- Circle Progress Bar -->
<!--
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
</script>-->




</body>
</html>