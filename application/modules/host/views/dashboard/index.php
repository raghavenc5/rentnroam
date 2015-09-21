<?php
// o/p the header
echo $header;
?>

<div class="container" style="padding-top: 180px;">
    <div class="col-md-4 col-padding-no">
        <div class="img-back text-center">

            <?php
            $profilePic = (isset($dashboardData->profile_pic) && $dashboardData->profile_pic) ? $dashboardData->profile_pic : '';
            $profilePicUrl = (! $profilePic) ? base_url() . 'public/images/host-big.png' : ((strstr($profilePic, 'https://')) ? $profilePic : base_url() . '/public/uploads/user_image/' . $profilePic);
            ?>

            <img src="<?php echo $profilePicUrl; ?>" alt="host_profile_picture" class="img-circle">
            <h3><?php (isset($dashboardData->full_name) && $dashboardData->full_name) ? filterDbOutput($dashboardData->full_name) : 'Host Name Not Given'; ?></h3>
            <p><?php (isset($dashboardData->location) && $dashboardData->location) ? filterDbOutput($dashboardData->location) : 'Host\'s Location Not Given'; ?></p>
        </div>
        <div class="col-md-12 col-padding-no verificationCheck">
            <img src="<?php echo base_url(); ?>public/images/rnr-banner.png" alt="RNR">
            <p>rnr verification <br/><?php echo isset($dashboardData->verification_completion_percent) ? $dashboardData->verification_completion_percent : 0; ?>% completed</p>
            <a class="button-pink btn btn-default documents" href="<?php echo site_url('/host/profile'); ?>">complete now</a>
            <hr/>
            <ul>
                <li>
                    <p>
                        <i class="fa fa-check"></i>
                        email address
                        <span class="pull-right"><i class="fa <?php echo isset($dashboardData->email_verification_completion_status) && $dashboardData->email_verification_completion_status ? 'fa-check-circle-o' : 'fa-times-circle-o'; ?>"></i></span>
                    </p>
                </li>
                <li>
                    <p>
                        <i class="fa fa-check"></i>
                        identification
                        <span class="pull-right"><i class="fa <?php echo isset($dashboardData->identity_document_verification_completion_status) && $dashboardData->identity_document_verification_completion_status ? 'fa-check-circle-o' : 'fa-times-circle-o'; ?>"></i></span>
                    </p>
                </li>
                <li>
                    <p>
                        <i class="fa fa-check"></i>
                        phone number
                        <span class="pull-right"><i class="fa <?php echo isset($dashboardData->contact_verification_completion_status) && $dashboardData->contact_verification_completion_status ? 'fa-check-circle-o' : 'fa-times-circle-o'; ?>"></i></span>
                    </p>
                </li>
                <li>
                    <p>
                        <i class="fa fa-check"></i>
                        social accounts
                        <span class="pull-right"><i class="fa <?php echo isset($dashboardData->social_media_verification_completion_status) && $dashboardData->social_media_verification_completion_status ? 'fa-check-circle-o' : 'fa-times-circle-o'; ?>"></i></span>
                    </p>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8 col-padding-no overview-info">
        <div class="col-md-4 text-center" style="padding-bottom: 0px;">
            <div class="profileCompleteness">
                <p>
                    
                    <?php
                        echo isset($dashboardData->profile_completion_percent) ? $dashboardData->profile_completion_percent : 0; 
                    ?>%

                    <br/>
                    <span>profile<br/>completed</span>
                </p>
            </div>
            <a class="button-pink btn btn-default documents" style="margin-bottom: 5px;" href="<?php echo site_url('/host/profile'); ?>">edit profile</a>
            <p class="text-center" style="margin-bottom: 0px;"><?php echo isset($dashboardData->last_updated) ? $dashboardData->last_updated : 'Not Found'?></p>
        </div>
        <div class="col-md-4 credit-info">
            <h1>credits earned</h1>
            <h2>768</h2>
            <input class="button-pink btn btn-default documents" type="submit" value="REDEEM NOW">
        </div>
        <div class="col-md-4 invite-friend">
            <h2>invite friends, earn travel credits</h2>
            <p>Earn up to $100 for everyone you invite.</p>
            <input class="button-pink btn btn-default documents" style="margin-top: 5px;" type="submit" value="invite now">
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-padding-no" style="padding-left: 15px;padding-top: 30px;">
            <div class="col-md-4 col-padding-no notify-header">
                messages
            </div>
            <div class="clearfix"></div>
            <div class="notify-table-container">
                <table class="table table-condensed">
                    
                    <?php
                    if ($messagesData) {
                        foreach ($messagesData as $key => $thisMessageData) {
                    ?>

                    <tr>
                        <th>
                            <i class="fa fa-stop"></i>
                        </th>
                        <td>
                            <p class="name"><?php echo isset($thisMessageData->sender_full_name) ? filterDbOutput($thisMessageData->sender_full_name) : 'Not Found'; ?></p>
                            <p class="time"><?php echo isset($thisMessageData->sent_on) ? $thisMessageData->sent_on: 'Not Given'; ?></p>
                        </td>
                        <td class="address">
                            <p><?php echo isset($thisMessageData->message) ? excerptize($thisMessageData->message) : 'Not Given'; ?></p>
                        </td>
                        <td class="status">
                            <p class="declined"><?php echo $thisMessageData->status ? $thisMessageData->status : 'Not Given'; ?></p>
                        </td>
                    </tr>

                    <?php
                        }
                    } else {
                    ?>

                    <tr>
                        <th>
                            <i class="fa fa-stop"></i>
                        </th>
                        <td colspan="3">
                            <p class="name">No messages were found</p>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>

                </table>
                <div class="col-md-12 col-padding-no">
                    
                    <?php
                    if ($messagesData) {
                    ?>
                    
                    <a href='<?php echo site_url("/host/dashboard/fetchAllMessagesAsync/$userData[user_id]"); ?>' class="text-right view-all" id="view_all_messages">view all</a>
                    
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-padding-no">
                <div class="col-md-4 col-padding-no notify-header">
                    alerts
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="notify-table-container">
                <table class="table table-condensed">
                    <tr>
                        <th>
                            <i class="fa fa-stop"></i>
                        </th>
                        <td class="alerts-text">
                            <p>Please tell us how to pay you.</p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <i class="fa fa-stop"></i>
                        </th>
                        <td class="alerts-text">
                            <p>Please update your Pancard details.</p>
                        </td>
                    </tr>
                </table>
                <div class="col-md-12 col-padding-no">
                    <a class="text-right view-all">view all</a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-padding-no ad-banner">
        <div class="col-md-6 col-padding-no">
            
        </div>
        <div class="col-md-6 col-padding-no">
            <p class="ad-text">whether you're<br/>renting your own place or booking a room<br/>in someone else's property,<br/><span>it's all so easy with rent <i>n</i> roam!</span></p>
            <a class="button-pink btn btn-default documents" href="<?php echo site_url('/host/profile/mybookings'); ?>">see for yourself how simple it is!</a>
        </div>
    </div>

    <div class="col-md-12 col-padding-no">
            <ul class="offers-grid filters-user-property">

                <?php
                $count = 0;
                if ($propertiesData) {
                    foreach ($propertiesData as $key => $thisPropertyData) {
                        $propertyImage = base_url() . 'public/uploads/property_image/';
                        $propertyImage .= ($thisPropertyData->property_images) ? ((false !== strpos($thisPropertyData->property_images, ',')) ? explode(',', $thisPropertyData->property_images)[0] : $thisPropertyData->property_images) : 'mumbai.png';
                ?>

                <li class="col-md-6 no-side-margin">
                    <div class="col-md-12 no-side-margin">
                        <div class="half-height">
                            <img src="<?php echo $propertyImage; ?>" alt="<?php echo $thisPropertyData->property_title ? filterDbOutput($thisPropertyData->property_title) : 'Property_Image'; ?>">
                            <div class="info-box">
                                <span class="price"><i class="fa fa-inr"></i> <?php echo $thisPropertyData->price ? number_format($thisPropertyData->price) : 0.00; ?></span>
                            </div><!-- end info-box -->
                            <div class="certificate-box">
                                <span class="text-center"><img src="<?php echo base_url(); ?>public/images/rnr-banner.png"></span>
                            </div><!-- end certificate-box -->
                        </div><!-- end half-height -->
                    </div>
                </li>
                <div class="col-md-3 no-side-margin property-desc text-center">
                    <p class="text-left">
                        <!-- <i class="fa fa-2x fa-smile-o"></i> -->

                        <?php
                        $emoticon = $thisPropertyData->smiley_icon ? $thisPropertyData->smiley_icon : 'happy.png';
                        ?>

                        <img src="<?php echo base_url() . 'public/images/emoticons/' . $emoticon; ?>" alt="rating" class="my-emotion" style="margin-top:7px;">
                        <a href="#" class="pull-right"><img src="<?php echo base_url(); ?>public/images/closex.png" class="remove-fav-btn"></a>
                    </p>
                    <img src="<?php echo $profilePicUrl; ?>" class="img-circle property-host-img">
                    <p class="text-imp"><?php echo $thisPropertyData->property_title ? filterDbOutput($thisPropertyData->property_title): 'Property Title Not Given';?></p>
                    <p class="text-sub-imp"><?php echo $thisPropertyData->area ? filterDbOutput($thisPropertyData->area): 'Property Area Not Given';?></p>
                    <p><?php echo $thisPropertyData->property_type ? filterDbOutput($thisPropertyData->property_type): 'Property Type Not Given';?></p>
                    <div class="property-desc-footer">
                        <p class="text-left">
                            <span class="text-left"><input type="checkbox"> Compare</span>
                            <span class="pull-right">
                                <a href="javascript:void(0);" class="location_popper"><img src="<?php echo base_url(); ?>public/images/loc.png"></a>
                                <input type="hidden" name="property_lats[]" id="property_lat_<?php echo $key; ?>" class="property_lats" val="<?php echo $thisPropertyData->latitude ? $thisPropertyData->latitude : 0.000000000000000000; ?>">
                                <input type="hidden" name="property_longs[]" id="property_long_<?php echo $key; ?>" class="property_longs" val="<?php echo $thisPropertyData->longitude ? $thisPropertyData->longitude : 0.000000000000000000; ?>">
                                <img class="heart-icon" src="<?php echo base_url(); ?>public/images/heart-icon.png">
                                <span class="reviewCount"><?php echo $thisPropertyData->review_count ? $thisPropertyData->review_count : 0; ?> Reviews</span>
                            </span>
                        </p>
                    </div>
                </div>

                <?php
                        if (0 === (++$count%2)) {
                ?>
                <div class="clearfix"></div>    
                <?php
                        }
                    }
                }
                ?>

            </ul>
    </div>
</div>

<!-- google map modal -->
<div class="modal fade" id="location_modal" tabindex="-1" role="dialog" aria-labelledby="location_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="mapCanvas" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
</div>
<!-- google map modal -->

<!-- view all messages modal starts -->

<div class="modal fade" id="all_messages_modal" tabindex="-1" role="dialog" data-width="500" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">All Messages</h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<!-- view all messages modal ends -->

<script type="text/javascript">
    $(document).ready(function() {
        $('.profileCompleteness').circleProgress({
            value: "<?php echo isset($dashboardData->profile_completion_percent) ? ($dashboardData->profile_completion_percent/100) : 0; ?>",
            fill: { color: '#adce48' },
            size: 150,
            lineCap: 'round',
            reverse: true
        }).on('circle-animation-progress', function(event, progress, stepValue) {
            $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2) + '%');
        });
    });
</script>

<script>
var geocoder;
var map;
var marker;

function initialize(lat, lon) {
    var myLatlng = new google.maps.LatLng(lat,lon);
    var mapOptions = {
        center: myLatlng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });
}

$(".location_popper").click(function() {
    lat = $(this).closest(".property_lats").val() ? $(this).closest(".property_lats").val() : '22.572645';
    lon = $(this).closest(".property_longs").val() ? $(this).closest(".property_longs").val() : '88.363892';

    if (lat && lon) {
        initialize(lat, lon);

        $('#location_modal').modal();
    } else {
        alert("Property was not pinned to map");
    }
});

$('#location_modal').on('shown.bs.modal', function (e) {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(marker.getPosition());
});

$(document).ready(function() {
    /**
     * open view reviews modal
     */
    $('.container').on('click', '#view_all_messages', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){
                
                // populate modal body
                $('#all_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_messages_modal').modal();
            }
        });
    });
    
    /**
     * paginate through modal list
     */
    $('#all_messages_modal .modal-body').off().on('click', '.pagination li a', function(e) {
        // prevent redirection
        e.preventDefault();
        
        // make ajax call
        $.ajax({
            url: $(this).attr('href'),
            method: 'post',
            dataType: 'html',
            success: function(response){                
                // populate modal body
                $('#all_messages_modal .modal-body').empty().html(response);
                
                // display modal
                $('#all_messages_modal').modal();
            }
        });
    });
});
</script>

<?php
// o/p the footer
echo $footer;
?>