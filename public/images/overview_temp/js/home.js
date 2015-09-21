(function() {

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

}) ();