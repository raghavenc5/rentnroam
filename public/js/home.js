$(document).ready(function(){

	var closeX = $('span.closex'),
		appSection = $('div.app-section'),
		heroContent = $('div.hero-content'),
		bxPager = $('#hero-wrapper .bx-wrapper .bx-pager'),
		navTrigger = $('span.nav-trigger'),
		navigation = $('div.nav'),
		downArrow = $('span.down-arrow'),
		recommededRnr = $('div#rnr-recommeded'),
		logoText = $('img.logo-text'),
		logoHouses = $('img.logo-houses');

	// Adding Functionality To The X button
	closeX.on('click', function() {
		appSection.fadeOut(300);
		heroContent.animate({ 'bottom': 46 });
		$('#hero-wrapper .bx-wrapper .bx-pager').animate({ 'bottom': 34 });
	});

	// Responsive Navigation Control
	navTrigger.on('click', function() {
		navigation.slideToggle(300);
	});

	// Adding Scroll Animation on Down-Arrow Click
	downArrow.on('click', function() {
		$('html, body').animate({
			scrollTop: recommededRnr.offset().top
		}, 800);
	});

	// Changing the Logo on Scroll Event
	$(document).on( 'scroll', function(){
		if ( $(window).scrollTop() > 780 ) {
			/*logoText.addClass('logo-text-scroll');
			logoHouses.addClass('logo-houses-small');*/
			$("#sub-nav").css("display", "block");
			$("#filter-dropdown").css("margin-top","128px");
		} else {
			/*logoText.removeClass('logo-text-scroll');
			logoHouses.removeClass('logo-houses-small');*/
			$("#sub-nav").css("display", "none");
			$(".popover").removeClass("in");
			$("#filter-dropdown").css("margin-top","77px");
		}
	});


	//datepicker functionality
	$(".boot-datepicker").mousedown(function(){
		$(".datepicker").val('');
		$(".datepicker td").removeClass('active');
	});

	$("#check_out").focus(function(){
		$(".datepicker").val('');
		$(".datepicker td").removeClass('active');
		$("#check_in").focus();
	});

	$('.boot-datepicker').datepicker({
		format: 'dd-mm-yyyy',
		viewMode: "days", 
		minViewMode: "days",
		multidate: 2,
		keyboardNavigation: false
	}).on('changeDate', function(e){
		if(e.dates.length > 1) {
			/*$(".datepicker").val("");*/
			var checkIn = new Date(e.dates[0]);
			var checkOut = new Date(e.dates[1]);
			checkIn = convertToDate(checkIn);
			checkOut = convertToDate(checkOut);
			$(this).datepicker('clearDates');
			console.log(checkIn+": "+checkOut);
			$("#check_in").val(checkIn);
			$("#check_out").val(checkOut);
			$(".datepicker-dropdown").hide();
		}
	});

	/* Converting dates to dd-mm-yyyy format */
	function convertToDate(dateVar) {
		var dd = dateVar.getDate();
		var mm = dateVar.getMonth() + 1; //January is 0!

		var yyyy = dateVar.getFullYear();
		if(dd<10) {
			dd='0'+dd
		} 
		if(mm<10) {
			mm='0'+mm
		} 
		var dateVar = dd+'-'+mm+'-'+yyyy;
		return dateVar;
	}

	$("#guestDropdown").click(function(){
		$(this).toggleClass('open');
	});

	$('#guestDropdown .dropdown-menu > li > a').click(function(event){
		event.preventDefault();
		$('#guestDropdown > a').text($(this).text());
		$("#guest").val($(this).text());
	});

	/* slider counting and monitoring */
	/*slider = $('ul.hero-slider-trending').bxSlider({
        auto: false,
        touchEnabled: true,
        pager: true,
        controls: true,
        onSlideAfter:  function() {
	        $("#currentSlide").text(slider.getCurrentSlide() + 1);
	    }
    });
    $("#currentSlide").text(slider.getCurrentSlide() + 1);
    $("#totalSlide").text(slider.getSlideCount());*/

});