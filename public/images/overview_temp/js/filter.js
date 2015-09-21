$(document).ready(function() {

    $('.datepicker').datepicker();
    $('div.equal-heights').matchHeight();
    $('div.equal-heights2').matchHeight();
    $('div.equal-heights3').matchHeight();
    $('ul.footer-cols > li').matchHeight();
    
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
            $("html, body").animate({ scrollTop: 0 }, 300);
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
});