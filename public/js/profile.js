$(document).ready(function(){
	$('.image-editor').cropit({imageBackground: true, smallImage: 'allow'});
	$('#imageUploader').submit(function() {
		var imageData = $('.image-editor').cropit('export');
		$('.hidden-image-data').val(imageData);
		window.open(imageData);
		var formValue = $(this).serialize();
		return false;
	});

	$("a[aria-controls='moreDocs']").click(function () {
		$("a[aria-controls='moreDocs'] i").toggleClass("fa-minus fa-plus");
	});

	$("a[aria-controls='moreSocial']").click(function () {
		$("a[aria-controls='moreSocial'] i").toggleClass("fa-minus fa-plus");
	});

	$("#mobileCode").on('shown.bs.collapse', function () {
		$('input[aria-controls="mobileCode"]').attr("disabled", "disabled");
	});
});