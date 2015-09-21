$(document).ready(function(){
	$('.image-editor').cropit({imageBackground: true, smallImage: 'allow'});
	$('#imageUploader').submit(function() {
		var imageData = $('.image-editor').cropit('export');
		$('.hidden-image-data').val(imageData);
		window.open(imageData);
		var formValue = $(this).serialize();
		return false;
	});

	$("#mobileCode").on('shown.bs.collapse', function () {
		$('input[aria-controls="mobileCode"]').attr("disabled", "disabled");
	});

	$('.profileCompleteness').circleProgress({
		    value: 0.60,
		    fill: { color: '#adce48' },
		    size: 150,
		    lineCap: 'round',
		    reverse: true
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
	});

	$('.listingCompleteness').circleProgress({
		    value: 1,
		    fill: { color: '#f8c015' },
		    size: 150,
		    lineCap: 'round',
		    reverse: true
		}).on('circle-animation-progress', function(event, progress, stepValue) {
		    $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
	});

	$(".bookingsTabContainer > li").click(function(){
		$(".bookingsTabContainer > li").height(150);
		$(".bookingsTabContainer > li > .collapse").removeClass("in");
		$(this).find(".collapse").addClass("in");
		var newHeight = ($(this).height()) + ($(this).find(".collapse").height());
		$(this).height(newHeight + 30);
	});
    $(".bookingsTabContainer > li.active").click();

	/* review slider page */
    var speed = 500;
    var slides = $('.slide');
    var container = $('#slides ul');
    var elm = container.find(':first-child').prop("tagName");
    var item_width = container.width();
    var previous = 'prev'; //id of previous button
    var next = 'next'; //id of next button
    slides.width(item_width); //set the slides to the correct pixel width
    container.parent().width(item_width);
    container.width(slides.length * item_width); //set the slides container to the correct total width
    container.find(elm + ':first').before(container.find(elm + ':last'));
    resetSlides();
    
    $('#buttons a').click(function (e) {
        if (container.is(':animated')) {
            return false;
        }
        if (e.target.id == previous) {
            container.stop().animate({
                'left': 0
            }, 500, function () {
                container.find(elm + ':first').before(container.find(elm + ':last'));
                resetSlides();
            });
        }
        
        if (e.target.id == next) {
            container.stop().animate({
                'left': item_width * -2
            }, 500, function () {
                container.find(elm + ':last').after(container.find(elm + ':first'));
                resetSlides();
            });
        }         
        return false;
    });
    
    function resetSlides() {
        container.css({
            'left': -1 * item_width
        });
    }
});

function rotate() {
    $('#next').click();
}