$(document).ready(function() {
    
    /**
     * ajax pagination
     */
    $('#booking-tab-pane').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // display overlay
        $('#overlay').show();
        
        // determine update target
        var update = '';
        if (-1 < $(this).attr('href').indexOf('fetchViewedMessagesAsync')) {
            update = '#viewed_messages_container';
        } else if (-1 < $(this).attr('href').indexOf('fetchPendingMessagesAsync')) {
            update = '#pending_messages_container';
        } else {
            //
        }
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response) {
                // remove overlay
                $('#overlay').hide();
                
                // print response
                $(update).empty().html(response);
            }
        });
    });
    
    /**
     * tab change
     */
    $('.bookingsTabContainer a[data-toggle="tab"]').off().on('shown.bs.tab', function (e) {
        // display overlay
        $('#overlay').show();
        
        // get first property id (either the first child property id or this property itself)
        var firstPropertyId = $(this).closest('a').data('first-property-id');
        
        // make ajax call
        $.ajax({
            url: base_url + 'host/bookings/indexAsync/' + firstPropertyId,
            method: 'get',
            dataType: 'html',
            success: function(response) {
                // remove overlay
                $('#overlay').hide();
                
                // print response
                $('#my_bookings').empty().html(response);
                
                $('html,body').animate({
                    scrollTop: $('body').offset().top},
                'slow');
            }
        });
    });
    
    /**
     * child property selection
     */
    $('.childProperties').off().on('click',function(e) {
        // display overlay
        $('#overlay').show();
        
        // get property id
        var propertyId = $(this).data('property-id');
        
        // highlight
        $('.childProperties').removeClass('open');
        $(this).addClass('open');
        
        // make ajax call
        $.ajax({
            url: base_url + 'host/bookings/indexAsync/' + propertyId,
            method: 'get',
            dataType: 'html',
            success: function(response) {
                // remove overlay
                $('#overlay').hide();
                
                // print response
                $('#my_bookings').empty().html(response);
                
                $('html,body').animate({
                    scrollTop: $('body').offset().top},
                'slow');
            }
        });
    });
    
    /**
     * open view all viewed messages modal
     */
    $('#booking-tab-pane').on('click', '#view_all_viewed_messages', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){
                // populate modal body
                $('#all_viewed_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_viewed_messages_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#all_viewed_messages_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#all_viewed_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_viewed_messages_modal').modal();
            }
        });
    });
    
    /**
     * open view all pending messages modal
     */
    $('#booking-tab-pane').on('click', '#view_all_pending_messages', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#all_pending_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_pending_messages_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#all_pending_messages_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#all_pending_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_pending_messages_modal').modal();
            }
        });
    });
    
    /**
     * open view upcoming bookings modal
     */
    $('#booking-tab-pane').on('click', '#view_all_upcoming_bookings', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){
                
                // populate modal body
                $('#upcoming_bookings_modal .modal-body').empty().html(response);
                
                // display modal
                $('#upcoming_bookings_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#upcoming_bookings_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#upcoming_bookings_modal .modal-body').empty().html(response);
                
                // display modal
                $('#upcoming_bookings_modal').modal();
            }
        });
    });
    
    /**
     * open view past bookings modal
     */
    $('#booking-tab-pane').on('click', '#view_all_past_bookings', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){
                
                // populate modal body
                $('#past_bookings_modal .modal-body').empty().html(response);
                
                // display modal
                $('#past_bookings_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#past_bookings_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#past_bookings_modal .modal-body').empty().html(response);
                
                // display modal
                $('#past_bookings_modal').modal();
            }
        });
    });
    
    /**
     * open view reviews modal
     */
    $('#booking-tab-pane').on('click', '#view_all_reviews', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){
                
                // populate modal body
                $('#reviews_modal .modal-body').empty().html(response);
                
                // display modal
                $('#reviews_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#reviews_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#reviews_modal .modal-body').empty().html(response);
                
                // display modal
                $('#reviews_modal').modal();
            }
        });
    });
});


