<?php
// o/p the header
echo $header;
?>

<div class="container" style="padding-top: 180px;">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul id="tabContainer" class="nav nav-tabs tabs-left tripsTabContainer">
                    <li class="active">
                        <a href="#past" data-toggle="tab" id="past_trips_tab">
                            <h1><?php echo $pastTripCount; ?></h1>
                            <p>past trips</p>
                        </a>
                    </li>
                    <li>
                        <a href="#past" data-toggle="tab" id="upcoming_trips_tab">
                            <h1 style="margin-top: -30px;"><?php echo $upcomingTripCount; ?></h1>
                            upcoming trips
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 bk-clr-f8c015 col-padding-no"><!-- Tab panes -->
                <div class="tab-content" style="margin-right: -103px;">
                    <div class="tab-pane frm-container active" id="past">
                        <div class="frm-body col-md-12 col-padding-no">

                            <?php
                            if (! $pastTrips) {
                            ?>

                            <div class="frm-body col-md-12 col-padding-no">
                            <div class="col-md-3 col-padding-no"></div>
                                <div class="col-md-9 col-padding-no pull-left">
                                    <p>No Past Trips Found</p>
                                </div>
                            </div>

                            <?php
                            } else {
                                foreach ($pastTrips as $key => $thisPastTrip) {
                            ?>

                            <div class="col-md-3 col-padding-no tripDate">
                                <h1><?php echo $bookingDate = explode(' ', $thisPastTrip->booking_from)[0]; ?></h1>
                                <h3><?php echo str_replace($bookingDate, '', $thisPastTrip->booking_from)?></h3>
                            </div>
                            <div class="col-md-9 col-padding-no infoActionContainer">
                                <div class="col-md-8 col-padding-no tripInfo">
                                    <h4><?php echo $thisPastTrip->location; ?></h4>
                                    <p><?php echo $thisPastTrip->property_title; ?>, <?php echo $thisPastTrip->bedrooms; ?> Bedrooms apt</p>
                                    <p>host: <?php echo $thisPastTrip->host_name; ?></p>
                                    <p>no of guests: <?php echo $thisPastTrip->guest_allow; ?></p>
                                    <p class="tripStatus">Visited</p>
                                </div>
                                <div class="col-md-4 col-padding-no tripAction">
                                    <a href="<?php echo site_url("/host/trips/messages/$thisPastTrip->property_id"); ?>" class="view_message_button">message history</a><br/>
                                    <a href="#">view receipt</a><br/>
                                    <a href="#" class="write_review_button" id="review_property_<?php echo $thisPastTrip->property_id; ?>">write review</a><br/>
                                    <a href="<?php echo site_url("/host/trips/viewReviews/$thisPastTrip->property_id"); ?>" class="view_review_button">view review</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <?php
                                }
                            }
                            ?>

                        </div>

                        <?php
                        if ($pageLinks) {
                        ?>

                        <div class="frm-body col-md-12 col-padding-no">
                            <div class="col-md-3 col-padding-no"></div>
                            <div class="col-md-9 col-padding-no pull-left">

                                <?php
                                echo $pageLinks;
                                ?>

                            </div>
                        </div>

                        <?php
                        }
                        ?>
                        
                    </div>
                    <input type="hidden" name="last_past_trip_url" id="last_past_trip_url" value="<?php echo base_url(); ?>host/trips/index">
                    <input type="hidden" name="last_upcoming_trip_url" id="last_upcoming_trip_url" value="<?php echo base_url(); ?>host/trips/upcomingTrips">
                    <input type="hidden" name="source_tab" id="source_tab" value="past_trips_tab">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- write review modal -->
<div class="modal fade" id="write_review" tabindex="-1" role="dialog" aria-labelledby="write_review_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="write_review_form" name="write_review_form" action="<?php echo site_url('/host/profile/savePropertyReview'); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="write_review_modal_label">Write A Review</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="review_client_side_global_error" style="display:none"><strong>You have some form errors. Please check below</strong></div>
                    <div class="alert alert-danger" id="review_server_side_error_500" style="display:none"></div>
                    <div class="alert alert-warning" id="review_server_side_error_300" style="display:none"></div>
                    <div class="alert alert-success" id="review_server_side_status_200" style="display:none"><strong>Review saved successfully</strong></div>
                    <div class="row">
                        <div class="col-md-2" style="font-weight:bold; text-transform:capitalize;">Rate It</div>
                        <div class="col-md-4">
                            <?php
                            $smileyList = "";
                            if ($smileys) {
                                foreach ($smileys as $thisSmiley) {
                                    $smileyList .= $smileyList ? "&nbsp;&nbsp<a href='javascript:void(0);' id='smiley_$thisSmiley->smiley_id' class='rating_smileys'><img src='" . base_url() . "public/images/emoticons/$thisSmiley->smiley_icon' title='rating'/></a>" : "<a href='javascript:void(0);' id='smiley_$thisSmiley->smiley_id' class='rating_smileys'><img src='" . base_url() . "public/images/emoticons/$thisSmiley->smiley_icon' title='rating'/></a>";
                                }
                            }
                            echo $smileyList;
                            ?>
                        </div>
                        <div class="col-md-4" id="smiley_error"></div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="review_data[comment_text]" id="rating" class="form-control input-lg" rows="5" placeholder="review..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="review_data[property_id]" id="reviewed_property_id" value="">
                    <input type="hidden" name="review_data[user_id]" value="<?php echo $userData['user_id']; ?>">
                    <input type="hidden" name="review_data[smiley_id]" id="reviewed_smiley_id" value="">
                    <input type="hidden" name="review_data[rating]" id="reviewed_rating_id" value="">
                    <button type="button" class="button-pink btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" id="submit_review_button" class="button-pink btn btn-default pull-left">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- write review modal -->

<script>
    $(document).ready(function() {
        // ajax pagination on past tab content
        $("#past").on("click", ".pagination li a", function(e) {
            e.preventDefault();
            
            $('#overlay').show();
            
            var url = $(this).attr("href");

            if (-1 < url.indexOf("index")) {
                $("#last_past_trip_url").val(url);
            } else if (-1 < url.indexOf("upcomingTrips")) {
                $("#last_upcoming_trip_url").val(url);
            } else {
                //
            }

            $.ajax({
                url: url,
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    
                    $('#overlay').hide();
                    
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#overlay').show();
            
            var tabId = $(this).attr("id");
            var url = "";

            if ("past_trips_tab" == tabId) {
                url = $("#last_past_trip_url").val();
            } else if ("upcoming_trips_tab" == tabId) {
                url = $("#last_upcoming_trip_url").val();
            } else {
                //
            }

            $("#source_tab").val(tabId);

            $.ajax({
                url: url,
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    
                    $('#overlay').hide();
                    
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        $("#past").on("click", ".view_review_button", function(e) {
            e.preventDefault();
            $('#overlay').show();
            $.ajax({
                url: $(this).attr("href"),
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    $('#overlay').hide();
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        $("#past").on("click", ".back_from_reading_review", function() {
            $('#overlay').show();
            
            var source = $("#source_tab").val();
            var url = "";

            if ("past_trips_tab" == source) {
                url = $("#last_past_trip_url").val();
            } else if ("upcoming_trips_tab" == source) {
                url = $("#last_upcoming_trip_url").val();
            } else {
                //
            }

            $.ajax({
                url: url,
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    
                    $('#overlay').hide();
                    
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        $("#past").on("click", ".view_message_button", function(e) {
            e.preventDefault();
            $('#overlay').show();
            $.ajax({
                url: $(this).attr("href"),
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    $('#overlay').hide();
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        $("#past").on("click", ".back_from_reading_messages", function() {
            $('#overlay').show();
            var source = $("#source_tab").val();
            var url = "";

            if ("past_trips_tab" == source) {
                url = $("#last_past_trip_url").val();
            } else if ("upcoming_trips_tab" == source) {
                url = $("#last_upcoming_trip_url").val();
            } else {
                //
            }

            $.ajax({
                url: url,
                method: "post",
                dataType: "html",
                success: function(response) {
                    if ("500" === response.status) {
                       location.reload(); 
                    } else {
                        $("#past").empty().html(response);
                    }
                    $('#overlay').hide();
                    $('html,body').animate({
                        scrollTop: $('body').offset().top},
                   'slow');
                }
            });
        });

        /**
        * write a review handlers start
        */

        /**
        * on clicking the write review button
        * populate the property id
        * open write review modal
        */
        $("#past").on("click", ".write_review_button", function() {
            var propertyId = $(this).attr("id").split("_")[2];
            $("#reviewed_property_id").val(propertyId);
            $('#write_review').modal();
        });

        /**
        * on clickin one rating smiley
        * populate the smiley id
        */
        $("#write_review").on("click", ".rating_smileys", function() {
            var smileyId = $(this).attr("id").split("_")[1];
            $("#reviewed_smiley_id").val(smileyId);
            $("#reviewed_rating_id").val(smileyId);
        });

        /**
        * validate write review form
        * on successful validation submit form
        * on successfull save reload the panel content
        */
        $("#write_review").on("click", "#submit_review_button", function(e) {
            // prevent default form submit
            e.preventDefault();

            // remove any existing errors
            $("#review_client_side_global_error, #review_server_side_error_500, #review_server_side_error_300, #review_server_side_status_200").hide();

            $("#write_review .help-block").remove();

            // local vars
            var errorFlag = false;
            var rating = $("#rating").val().trim();
            var smiley = $("#reviewed_smiley_id").val();

            // validate review text
            if (! rating) {
                errorFlag = true;
                $("#rating").after("<span class='help-block'>Please enter review text</span>");
            } else if (rating.length < 50) {
                errorFlag = true;
                $("#rating").after("<span class='help-block'>Review must contain atleast 50 characters</span>");
            } else {
                //
            }

            // validate rating smiley
            if (! smiley) {
                errorFlag = true;
                $("#smiley_error").empty().after("<span class='help-block'>Please rate this property</span>");
            }

            if (errorFlag) {
                // show global error
                $("#review_client_side_global_error").show();
                $("a[href='#review'] .fa-check").css("color", "#4285F4");
                $('html,body').animate({
                     scrollTop: $('body').offset().top},
                'slow');
            } else {
                $("#submit_review_button").prop("disabled", true);

                // ajax submit the form
                $.ajax({
                    url: $("#write_review_form").attr("action"),
                    method: "post",
                    dataType: "json",
                    data: $("#write_review_form").serialize(),
                    success: function(response) {
                        if ("500" == response.status) {
                            $("#review_server_side_error_500").empty().html("<strong>" + response.message + "</strong>").show();

                            $('html,body').animate({
                                 scrollTop: $('body').offset().top},
                            'slow');
                        } else if ("400" == response.status) {
                            $("#review_server_side_error_300").empty().html("<strong>" + response.message + "</strong>").show();

                            $('html,body').animate({
                                 scrollTop: $('body').offset().top},
                            'slow');
                        } else if ("200" == response.status) {
                            $("a[href='#review'] .fa-check").css("color", "#55a018");

                            $.ajax({
                                url: base_url + "host/trips/viewReviews/" + $("#reviewed_property_id").val(),
                                method: "post",
                                dataType: "html",
                                data: {"mode": "save_review"},
                                success: function(response) {
                                    $("#past").empty().html(response);
                                    $('#write_review').modal("hide");
                                    $('html,body').animate({
                                        scrollTop: $('body').offset().top},
                                   'slow');
                                }
                            });
                        } else {
                            //
                        }
                    }
                });
            }
        });

        /**
        * write a review handlers start
        */
    });
</script>

<?php
echo $footer;
?>