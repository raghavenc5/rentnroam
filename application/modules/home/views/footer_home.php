<div class="modal fade registrationModal" id="modal_placeholder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	
</div>
<div id="footer">
		<div class="centered-content">
			<ul class="footer-cols" >
				<li style="padding-top:25px;">
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
						<li><a href="<?php echo base_url(); ?>home/hotOffer">Hot Offers</a></li>
						<li><a href="<?php echo base_url(); ?>home/trendingDestination">Trending Destinations</a></li>
						<li><a href="<?php echo base_url(); ?>home/rnrRecommend">RNR Recomended</a></li>
						<li><a href="<?php echo base_url(); ?>home/eventHappenings">Events &amp; Happenings</a></li>
					</ul>
				</li>
				<li >
					<h4>EXPERIENCE</h4>
					<ul>
						<li><a href="<?php echo base_url(); ?>home/peopleStories">People Stories</a></li>
						<li><a href="javascript:void(0);">Travelogue</a></li>
						<li><a href="javascript:void(0);">Press Coverage</a></li>
					</ul>
					<h4>COMPANY</h4>
					<ul>
						<li><a href="javascript:void(0);">About Us</a></li>
						<li><a href="javascript:void(0);">Brand Promise</a></li>
						<li><a href="javascript:void(0);">Jobs</a></li>
						<li><a href="javascript:void(0);">Media</a></li>
						<li><a href="javascript:void(0);">Affiliates</a></li>
						<li><a href="javascript:void(0);">Partners</a></li>
					</ul>
				</li>
				<li>
					<h4>HOSTING</h4>
					<ul>
						<li><a href="javascript:void(0);">How it works</a></li>
						<li><a href="javascript:void(0);">Indian Hospitality</a></li>
						<li><a href="javascript:void(0);">Home Safety</a></li>
						<li><a href="javascript:void(0);">roamNrent guarantee</a></li>
						<li><a href="javascript:void(0);">Benefits</a></li>
					</ul>
					<h4>POLICIES</h4>
					<ul>
						<li><a href="javascript:void(0);">Reservation</a></li>
						<li><a href="javascript:void(0);">Cancellation</a></li>
						<li><a href="javascript:void(0);">Terms &amp; use</a></li>
						<li><a href="javascript:void(0);">Privacy Policy</a></li>
						<li><a href="javascript:void(0);">Legal</a></li>
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
				  <select id="currency" name="currency" onclick="save_currency();">
					<option value="">Select Your Currency</option>
				    <option value="INR">INR</option>
				    <option value="$USD">$USD</option>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>  
<script src="<?php echo base_url()?>public/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>public/js/home.js"></script>   
<!-- BX Slider  -->
<script src="<?php echo base_url()?>public/js/jquery.bxslider.min.js"></script>   
<script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap3-typeahead.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){						
	$('ul.hero-slider').bxSlider({
		auto: false,
		touchEnabled: false,
		pager: true
	});
});		
</script>  

<!-- Datepicker -->
<!-- <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>  -->
  <script>
  $(function() {
    /*$('.datepicker').datepicker(
		{
			minDate: 0,
			dateFormat: 'dd-mm-yy' 
		}
		);*/
			var cities = ['Delhi','Mumbai,Maharashtra','Bangalore,Karnataka','Chennai,Tamilnadu','Kolkata,West Bengal'];

		$('#autocomplete_city').typeahead({
			source: cities
		});

		$('.registrationModal').on('show.bs.modal', function (e) {
			$("#header").css("z-index", "1");
		});
		$('.registrationModal').on('hide.bs.modal', function (e) {
			$("#header").css("z-index", "9999");
		});
  });
	
  </script>

<!-- Equal Heights Plugin -->
<script type="text/javascript" src="<?php echo base_url()?>public/js/jquery.matchHeight.js"></script>
<script type="text/javascript">
    (function() {

        $(function() {            
            $('ul.three-cols-grid > li').matchHeight();
            $('ul.footer-cols > li').matchHeight();
        });

    })();
		function save_currency()
		{
			var currency = $("#currency option:selected").val();
			$.post(BASE_URL+'home/doCurrencysave',
			{
				'currency' : currency
			},
			function(data)
			{
			
			});
		}
</script>

<script type="text/javascript">
function load_login_popup()
{
	$.post(BASE_URL+'home/load_login_popup',
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
	$.post(BASE_URL+'home/load_registration_popup',
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

</body>
</html>