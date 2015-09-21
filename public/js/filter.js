$(document).ready(function() {

    /*$('.datepicker').datepicker();*/
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
        max: 10000,
        values: [500, 5000],
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
            $("#filter-dropdown").css("display", "block");
            $(this).find("i").removeClass("fa-chevron-down");
            $(this).find("i").addClass("fa-chevron-up");
            $("html, body").animate({ scrollTop: 0 });
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

    $("#btn-dropdown").click(function(event){
        event.preventDefault();
    });

    //datepicker functionality
    $(".boot-datepicker").mousedown(function(){
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
    });

    $("#checkOutDate").focus(function(){
        $(".datepicker").val('');
        $(".datepicker td").removeClass('active');
        $("#checkInDate").focus();
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
            $("#checkInDate").val(checkIn);
            $("#checkOutDate").val(checkOut);
            $(".datepicker-dropdown").hide();
            event.stopImmediatePropagation();
        }
        return false;
    });

    $('body').on('focus', '#checkInDate',function(event){
        $("#btn-dropdown").attr('data-toggle', 'false');
    });

    $('body').on('focusout', '#checkInDate',function(event){
        $("#btn-dropdown").attr('data-toggle', 'dropdown');
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

    /* dropdown form toggle functionality */
    $("body").on('click', ".dropdown-menu", function(event){
        event.stopImmediatePropagation();
        $(".header-search").addClass('open');
    });

    /* room type toggle effect */

    $('.circle-room-type').click(function(){
        $('.circle-room-type').removeClass('active');
        $(this).addClass('active');
    });

    /* clear form data */
    $('#clearFilter').click(function(){
        /* clear all checkboxes and radio buttons */
        $('.filter-container > form input').removeAttr("checked");
        /* clear each checkbox */
        $(".filter-container > form select").each(function(){
            $(this).val($(this).find('option:first').val());
        });
        /* changing slider values */
        console.log($("#slider-range"));
        $("#slider-range").slider('values',0,0);
        $("#slider-range").slider('values',1,9999999999999999999999999999999999);
        $("#min-value").text($("#slider-range").slider("values", 0));
        $("#max-value").text($("#slider-range").slider("values", 1));
    });

});