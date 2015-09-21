function getEventDate(event)
{
    var date = new Date(event.start);
    
    var d = parseInt(date.getDate());
    d = (d <= 9) ? "0" + d : d;
    
    var m = parseInt(date.getMonth()) + 1;
    m = (m <= 9) ? "0" + m : m;
    
    var y = date.getFullYear();
    
    var formattedDate = y + "-" + m + "-" + d;
    
    return formattedDate;
}

var Calendar = function () {
    //function to initiate Full CAlendar
    var runCalendar = function () {
        var $modal = $('#event-management');        
        var dateSelector = $("#date_selector");
        
        /* initialize the calendar
				 -----------------------------------------------------------------*/
        var date = new Date(dateSelector.val());
        var d = date.getDate();
        var m = (date.getMonth() + 1);
        var y = date.getFullYear();
        var form = '';
        
        var calendar = $('#calendar').fullCalendar({
            events: $.post(
                base_url + "host/fetchCalendarEventData/",
                {
                    "property_id": $("#post_approval_calendar_property_id").val(),
                    "selected_date": dateSelector.val()
                },
                function(response){
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('addEventSource', response.event_data);         
                    $('#calendar').fullCalendar('rerenderEvents');
                },
                'json'
            ),
            eventRender: function(event, element) {
                element.removeClass();
                element.empty().html('<span style="position: absolute; top:40px; right:0px; cursor:pointer;"><i class="fa fa-inr"></i> ' + event.price + '</span>');
                
                $('.fc-day[data-date="' + getEventDate(event) + '"]').css("background-color", event.background_color);
            },
            editable: false,            
        });
        
        $("#calendar").fullCalendar('gotoDate', new Date(dateSelector.val()));
        
        dateSelector.change(function() {
            var date = new Date(dateSelector.val());
            $.post(
                base_url + "host/fetchCalendarEventData/",
                {
                    "property_id": $("#post_approval_calendar_property_id").val(),
                    "selected_date": dateSelector.val()
                },
                function(response){
                    $('#calendar').fullCalendar('removeEvents');
                    $('#calendar').fullCalendar('addEventSource', response.event_data);         
                    $('#calendar').fullCalendar('rerenderEvents');
                },
                'json'
            );
            calendar.fullCalendar('gotoDate', date);
        });
    };
    
    return {
        init: function () {
            runCalendar();
        }
    };
}();