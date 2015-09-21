<div class="header-row">
    <p class="header-text">
        <?php echo $propertyListingCompletionData->property_title; ?>
    </p>
</div>
<div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-6 col-padding-no pad15" style="background-color: #FFECB4;">
        <div class="col-md-6">
            <h3 class="roomDetails"><?php echo $propertyListingCompletionData->property_type; ?><br/><?php echo $propertyListingCompletionData->guest_allow; ?> guests</h3>
            <a href="<?php echo site_url('/host/editproperty/' . $propertyId  . '/?referer=' . base64_encode(current_url())); ?>" class="button-pink btn btn-default" style="margin-top: 60px; margin-bottom: 0px;">MANAGE LISTING</a>
        </div>
        <div class="col-padding-no col-md-6">
            <div class="listingCompleteness pull-right">
                <p>
                    <?php echo ($propertyListingCompletionData->listing_completeness * 100); ?>%<br/>
                    <span>Listing<br/>completed</span>
                </p>
            </div>
            <a id="updateListingLink" href="<?php echo site_url('/host/editproperty/' . $propertyId  . '/?referer=' . base64_encode(current_url())); ?>">update</a>
        </div>
        <div class="col-md-12 col-padding-no bookingCounter">
            <div class="col-md-6 bk-clr-f8c015">
                <h1><?php echo $upcomingAnPastBookingCount->upcoming_booking_count; ?></h1>
                <h2>upcoming bookings</h2>

                <?php
                if ($upcomingAnPastBookingCount->upcoming_booking_count) {
                ?>

                <a href='<?php echo site_url("/host/bookings/fetchUpcomingBookingsAsync/$propertyId/10"); ?>' id="view_all_upcoming_bookings">view all</a>

                <?php
                }
                ?>                                      

            </div>
            <div class="col-md-6 bk-clr-f8c015">
                <h1><?php echo $upcomingAnPastBookingCount->past_booking_count; ?></h1>
                <h2>completed bookings</h2>

                <?php
                if ($upcomingAnPastBookingCount->upcoming_booking_count) {
                ?>

                <a href='<?php echo site_url("/host/bookings/fetchPastBookingsAsync/$propertyId/10"); ?>' id="view_all_past_bookings">view all</a>

                <?php
                }
                ?>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div id="horizontalTab" class="bookingHorizontalTab">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active col-md-6 text-center col-padding-no">
                    <a href="#messages" aria-controls="aboutYou" role="tab" data-toggle="tab">messages</a>
                </li>
                <li role="presentation" class="col-md-6 text-center col-padding-no">
                    <a href="#pending" aria-controls="byYou" role="tab" data-toggle="tab"><?php echo $pendingMessagesCount; ?> pending requests</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="messages">
                    <div class="notify-table-container">
                        <div id="viewed_messages_container">

                            <?php
                            if (! $viewedMessages) {
                            ?>

                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td align="center">No Messages Found</td>
                                    </tr> 
                                </tbody>
                            </table>

                            <?php
                            } else {
                                $statusClassMap = array(
                                    'inquiry' => 'inquiry',
                                    'accepted' => 'accepted',
                                    'declined' => 'declined',
                                );
                            ?>

                            <table class="table table-condensed">
                                <tbody>

                            <?php
                                foreach ($viewedMessages as $key => $thisViewedMessage) {
                            ?>

                                    <tr>
                                        <th>
                                            <i class="fa fa-stop"></i>
                                        </th>
                                        <td>
                                            <p class="name"><?php echo $thisViewedMessage->sender_full_name; ?></p>
                                            <p class="time"><?php echo $thisViewedMessage->sent_on; ?></p>
                                            <p><?php echo excerptize(filterDbOutput($thisViewedMessage->message));?></p>
                                        </td>
                                        <td class="status">
                                            <p class="<?php echo array_search($thisViewedMessage->status, $statusClassMap); ?>"><?php echo $thisViewedMessage->status; ?></p>
                                        </td>
                                    </tr>

                            <?php
                                }
                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><?php echo $viewMessagesPageLinks; ?></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <?php
                            }
                            ?>

                        </div>

                        <?php
                        if ($viewedMessages) {
                        ?>

                        <div class="col-md-12 col-padding-no">
                            <a href="<?php echo site_url("/host/bookings/fetchViewedMessagesAsync/$propertyId/10"); ?>" id="view_all_viewed_messages" class="text-right view-all">view all</a>
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="pending">
                    <div class="notify-table-container">
                        <div  id="pending_messages_container">

                            <?php
                            if (! $pendingMessages) {
                            ?>

                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td align="center">No Messages Found</td>
                                    </tr> 
                                </tbody>
                            </table>

                            <?php
                            } else {
                            ?>

                            <table class="table table-condensed">
                                <tbody>

                            <?php
                                foreach ($pendingMessages as $key => $thisPendingMessage) {
                            ?>

                                    <tr>
                                        <th>
                                            <i class="fa fa-stop"></i>
                                        </th>
                                        <td>
                                            <p class="name"><?php echo $thisPendingMessage->sender_full_name; ?></p>
                                            <p class="time"><?php echo $thisPendingMessage->sent_on; ?></p>
                                            <p><?php echo excerptize(filterDbOutput($thisPendingMessage->message));?></p>
                                        </td>
                                        <td class="status">
                                            <p class="declined"><?php echo $thisPendingMessage->status; ?></p>
                                        </td>
                                    </tr>

                            <?php
                                }
                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><?php echo $pendingMessagesPageLinks; ?></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <?php
                            }
                            ?>

                        </div>

                        <?php
                        if ($pendingMessages) {
                        ?>

                        <div class="col-md-12 col-padding-no">
                            <a href='<?php echo site_url("/host/bookings/fetchPendingMessagesAsync/$propertyId/10"); ?>' id="view_all_pending_messages" class="text-right view-all">view all</a>
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-12 col-padding-no" style="padding-top: 3%;">
    <div class="col-md-6 col-padding-no">
        <div class="custom-calendar"></div>
        <p>
            <span class="blockedInfo">
                <i class="fa fa-stop"></i>
                blocked
            </span>
            <span class="bookedInfo">
                <i class="fa fa-stop"></i>
                booked
            </span>
            <span class="editCalendar pull-right">
<!--                                        <a href="#">edit calendar</a>-->
            </span>
        </p>
    </div>
    <div id="revenueCalculator" class="col-md-6">
        <h3>last 3 months revenue</h3>
        <table>
            <thead>
                <tr>
                    <th>total earnings till date:</th>
                    <th><i class="fa fa-inr"></i> 3,00,083/-</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">current amount status</td>
                </tr>
                <tr>
                    <td>balance:</td>
                    <td><i class="fa fa-inr"></i> 10,083/-</td>
                </tr>
                <tr>
                    <td>last paid:</td>
                    <td><i class="fa fa-inr"></i> 20,083/-</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">paid on december 4, 2014</th>
                </tr>
            </tfoot>
        </table>
        <div class="clearfix"></div>
        <div class="col-md-12 col-padding-no revenueProgress">
            <div class="col-md-4 revenueMonth">
                november
            </div>
            <div class="col-md-8">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                        <span class="sr-only"><i class="fa fa-inr"></i> 10,083/-</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-padding-no revenueProgress">
            <div class="col-md-4 revenueMonth">
                december
            </div>
            <div class="col-md-8">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                        <span class="sr-only"><i class="fa fa-inr"></i> 7,083/-</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-padding-no revenueProgress">
            <div class="col-md-4 revenueMonth">
                january
            </div>
            <div class="col-md-8">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                        <span class="sr-only"><i class="fa fa-inr"></i> 4,083/-</span>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="view-all-progress">view all</a>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-12 col-padding-no" style="padding-top: 5%;">
    <div class="col-md-6 col-padding-no views-n-rating">
        <h3>user rating and views</h3>
        <div class="col-md-6 col-padding-no text-center rating">

            <?php
            $ratingTextMap = array('1' => 'excellent', '2' => 'happy', '3' => 'not happy', '4' => 'sad', '5' => 'angry');
            $emoticon = ($topRatingAndViews->smiley_icon) ? $topRatingAndViews->smiley_icon : 'no-review.jpg';
            ?>

            <img src="<?php echo base_url() . 'public/images/emoticons/' . $emoticon; ?>">
            <p><?php echo ($topRatingAndViews->rating) ? $ratingTextMap[$topRatingAndViews->rating] : 'Unrated'; ?></p>
        </div>
        <div class="col-md-6 col-padding-no text-center">
            <h1><?php echo $topRatingAndViews->view_count; ?></h1>
            <p>views</p>
        </div>
    </div>
    <div id="review-slider" class="col-md-6">
        <div id="carousel" class="col-padding-no col-md-12">
            <div class="col-md-6 col-padding-no">
                <h3>reviews</h3>
                <?php
                if ($reviews) {
                ?>

                <a href='<?php echo site_url("/host/bookings/fetchReviewsAsync/$propertyId/1"); ?>' id="view_all_reviews" class="view-all-review">view all</a>

                <?php
                }
                ?>
            </div>
            <div class="btn-bar col-md-6 col-padding-no">
                <div id="buttons" class="pull-right">
                    <a id="prev" href="#"><</a>
                    <a id="next" href="#">></a>
                </div>
            </div>
            <div id="slides">
                <ul class="reviews">

                    <?php
                    if (! $reviews) {
                    ?>

                    <li class="slide"><p class="review-text-content">No Reviews Found</p></li>

                    <?php
                    } else {
                        foreach ($reviews as $key => $thisReview) {
                            $profilePicUrl = (! $thisReview->profile_pic) ? base_url() . 'public/uploads/user_image/icon-01.png' : ((strstr($thisReview->profile_pic, 'https://')) ? $thisReview->profile_pic : base_url() . 'public/uploads/user_image/' . $thisReview->profile_pic);
                    ?>

                    <li class="slide">
                        <div class="photo-name">
                            <img src="<?php echo $profilePicUrl; ?>" alt="<?php echo $thisReview->user_full_name; ?>">
                            <span><?php echo $thisReview->user_full_name; ?></span>
                        </div>
                        <div class="review-text-content">
                            <div class="date-general">
                                <span><?php echo $thisReview->commented_on; ?></span>
                                <img src="<?php echo base_url(); ?>public/images/emoticons/<?php echo $thisReview->smiley_icon; ?>" alt="excelent" class="my-emotion">
                            </div>
                            <p>
                                <?php echo nl2br(filterDbOutput(excerptize($thisReview->comment_text, 180))); ?>
                            </p>
                        </div>
                    </li>

                    <?php
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.cropit.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/circle-progress.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>public/js/host/bookings.js"></script>
<script>
$(document).ready(function() {    
    $.ajax({
        url: base_url + 'host/bookings/fetchCalendarData/' + '<?php echo $propertyId; ?>' + '/' + '<?php echo date("Y-m-01"); ?>',
        method: 'get',
        dataType: 'json',
        success: function(response) {
            $('.custom-calendar').Calendar({ 'events': response, 'weekStart': 1 })
            .on('changeDay', function(event){ console.log(event.day.valueOf() +'-'+ event.month.valueOf() +'-'+ event.year.valueOf() ); })
            .on('onEvent', function(event){ console.log(event.day.valueOf() +'-'+ event.month.valueOf() +'-'+ event.year.valueOf() ); })
            .on('onNext', function(event){ console.log(event); })
            .on('onPrev', function(event){ console.log("Prev"); })
            .on('onCurrent', function(event){ console.log("Current"); });
        }
    });

    $('.listingCompleteness').circleProgress({
            value: '<?php echo $propertyListingCompletionData->listing_completeness; ?>',
            fill: { color: '#f8c015' },
            size: 150,
            lineCap: 'round',
            reverse: true
        }).on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
    });
});
</script>