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
            editable: true,
            eventClick: function (calEvent, jsEvent, view) {
                if (2 != calEvent.status && 3 != calEvent.status) { console.log(calEvent.status);
                    var checked_1 = ('0' == calEvent.status) ? 'checked' : '';
                    var checked_2 = ('1' == calEvent.status) ? 'checked' : '';
                    var form = $("<form></form>");
                    form.append("<div class='row'><div class='col-md-12' style='padding-left:0px;'><div class='fatalErrorHandler alert alert-danger' style='display:none;'><strong>Fatal Error:</strong> Operation failed</div></div></div><div class='row'><div class='col-md-6'><label>From</label><input class='form-control' name='date_range_from' id='date_range_from' type=text value='" + getEventDate(calEvent) + "' /></div><div class='col-md-6'><label>To</label><input class='form-control' name='date_range_to' id='date_range_to' type=text value='" + getEventDate(calEvent) + "' /></div></div><br/><div class='row'><div class='col-md-6'><label>Price</label><input class='form-control' type='text' name='price' id='price' value='" + calEvent.price + "'/></div><div class='col-md-6'><br/><input type='radio' name='availibility' value='0' " + checked_1 + "/>&nbsp;Unavailable<br/><input type='radio' name='availibility' value='1' " + checked_2 + "/>&nbsp;Available</div></div>");
                    form.append("<div class='row'><div class='col-md-12'><input type='hidden' name='property_id' value='" + calEvent.property_id + "'/><input type='hidden' name='selected_date' value='" + dateSelector.val() + "'/><button type='submit' class='button-pink btn btn-default pull-left save-event' id='save_event_button'>Save</button></div></div>");
                    $modal.modal({
                        backdrop: 'static'
                    });                    
                    $modal.find('.modal-body').empty().prepend(form);
                    $modal.find('form #date_range_from').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $modal.find('form #date_range_to').datetimepicker({
                        format: 'YYYY-MM-DD',
                        useCurrent: false,
                        minDate: $modal.find('form #date_range_from').val()
                    });
                    $modal.find("form #date_range_from").on("dp.change", function (e) {
                        $modal.find('form #date_range_to').data("DateTimePicker").minDate(e.date);
                    });
                    $modal.find("form #date_range_to").on("dp.change", function (e) {
                        $modal.find('form #date_range_from').data("DateTimePicker").maxDate(e.date);
                    });
                    $modal.find('form #save_event_button').on('click', function (e) {
                        e.preventDefault();
                        
                        if (0 < $modal.find('.help-block').length) {
                            $modal.find('.help-block').remove();
                        }
                        if ('block' == $modal.find('form .fatalErrorHandler').css('display')) {
                            $modal.find('form .fatalErrorHandler').css('display', 'none');
                        }
                        
                        var errorFlag = false;
                        var formDate = $modal.find('#date_range_from').val();
                        var toDate = $modal.find('#date_range_to').val();
                        var price = $modal.find('#price').val();
                        
                        if (! formDate) {
                            $modal.find('#date_range_from').after('<span class="help-block">From date is required</span>');
                            errorFlag = true;
                        }
                        if (! toDate) {
                            $modal.find('#date_range_to').after('<span class="help-block">To date is required</span>');
                            errorFlag = true;
                        }
                        if (! price) {
                            $modal.find('#price').after('<span class="help-block">Price is required</span>');
                            errorFlag = true;
                        }
                        
                        if (! errorFlag) {
                            //calendar.fullCalendar('updateEvent', calEvent);
                            $.post(
                                base_url + "host/updateCalendarEventData/",
                                $modal.find('form').serialize(),
                                function(response){
                                    if ("500" == response.status) {
                                        $modal.find('form .fatalErrorHandler').css('display', 'block');
                                    } else {
                                        $('#calendar').fullCalendar('removeEvents');
                                        $('#calendar').fullCalendar('addEventSource', response.event_data);         
                                        $('#calendar').fullCalendar('rerenderEvents');
                                        $modal.modal('hide');
                                    }
                                },
                                'json'
                            )
//                            $("#calendar").fullCalendar("destroy");
//                            $("#calendar").html("");
//                            runCalendar();
                        }
                    });
                }
            }
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