<div class="frm-body col-md-12 col-padding-no">

<?php
if ($propertyReviews) {
    foreach ($propertyReviews as $thisPropertyReview) {
        $reviewerProfilePicUrl = (strstr($thisPropertyReview->profile_pic, 'https://')) ? $thisPropertyReview->profile_pic : base_url() . '/public/uploads/user_image/' . $thisPropertyReview->profile_pic;
?>

<div class="col-md-12 col-padding-no infoActionContainer">
    <div class="col-md-12 col-padding-no tripInfo">
        <img src="<?php echo $reviewerProfilePicUrl; ?>" alt="<?php echo filterDbOutput($thisPropertyReview->user_full_name); ?>">
        <p><?php echo $thisPropertyReview->user_full_name; ?></p>
        <h4><?php echo $thisPropertyReview->comment_date; ?></h4>
        <p><?php echo filterDbOutput($thisPropertyReview->property_location); ?></p>
        <p><img src="<?php echo base_url() . 'public/images/emoticons/' . $thisPropertyReview->smiley_icon; ?>" alt="property_rating" class="my-emotion"></p>
        <p style="word-wrap: break-all;"><?php echo nl2br(filterDbOutput($thisPropertyReview->comment_text)); ?></p>
    </div>
</div>
<div class="clearfix"></div>

<?php
    }
} else {
?>

<div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-12 col-padding-no pull-left">
        <p>No Reviews Found On This Property</p>
    </div>
</div>

<?php
}
?>

</div>



<div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-3 col-padding-no pull-left">
        <button class="btn btn-primary back_from_reading_review">Back</button>
    </div>

    <?php
    if ($pageLinks) {
    ?>

    <div class="col-md-9 col-padding-no">

        <?php
        echo $pageLinks;
        ?>

    </div>

    <?php
    }
    ?>

</div>

