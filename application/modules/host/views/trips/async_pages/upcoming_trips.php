<div class="frm-body col-md-12 col-padding-no">

    <?php
    if (! $upcomingTrips) {
    ?>

    <div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-3 col-padding-no"></div>
        <div class="col-md-9 col-padding-no pull-left">
            <p>No Upcoming Trips Found</p>
        </div>
    </div>

    <?php
    } else {
        foreach ($upcomingTrips as $key => $thisUpcomingTrip) {
    ?>

    <div class="col-md-3 col-padding-no tripDate">
        <h1><?php echo $bookingDate = explode(' ', $thisUpcomingTrip->booking_from)[0]; ?></h1>
        <h3><?php echo str_replace($bookingDate, '', $thisUpcomingTrip->booking_from)?></h3>
    </div>
    <div class="col-md-9 col-padding-no infoActionContainer">
        <div class="col-md-8 col-padding-no tripInfo">
            <h4><?php echo $thisUpcomingTrip->location; ?></h4>
            <p><?php echo $thisUpcomingTrip->property_title; ?>, <?php echo $thisUpcomingTrip->bedrooms; ?> Bedrooms apt</p>
            <p>host: <?php echo $thisUpcomingTrip->host_name; ?></p>
            <p>no of guests: <?php echo $thisUpcomingTrip->guest_allow; ?></p>
            <p class="tripStatus">Not Visited</p>
        </div>
        <div class="col-md-4 col-padding-no tripAction">
            <a href="<?php echo site_url("/host/trips/messages/$thisUpcomingTrip->property_id"); ?>" class="view_message_button">message history</a><br/>
            <a href="#">view receipt</a><br/>
            <a href="#" class="write_review_button" id="review_property_<?php echo $thisUpcomingTrip->property_id; ?>">write review</a><br/>
            <a href="<?php echo site_url("/host/trips/viewReviews/$thisUpcomingTrip->property_id"); ?>" class="view_review_button">view review</a>
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