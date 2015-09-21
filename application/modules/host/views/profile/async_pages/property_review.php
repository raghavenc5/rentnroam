<div id="visitedByYou" class="col-md-6 col-padding-no">
    <h3>You recently Visited:</h3>
    <h2>Gharonda Villa, Baga, Goa</h2>
    <h4>on 21st Jan, 2015</h4>
</div>
<div class="col-md-6 col-padding-no">
    <button type="button" class="button-pink btn btn-default pull-left margin-top-30 write_review_button" id="review_property_9">
        WRITE A REVIEW
    </button>
</div>
<div class="clearfix"></div>
<hr style="height: 1px; background-color: #fff;" />
<?php
if ($hostOwnReviews) {
?>
<ul class="reviews">
<?php
    foreach ($hostOwnReviews as $thisHostOwnReview) {
        $reviewerProfilePicUrl = (strstr($thisHostOwnReview->profile_pic, 'https://')) ? $thisHostOwnReview->profile_pic : base_url() . '/public/uploads/user_image/' . $thisHostOwnReview->profile_pic;
?>
<li>
    <div class="photo-name">
        <img src="<?php echo $reviewerProfilePicUrl; ?>" alt="<?php echo filterDbOutput($thisHostOwnReview->user_full_name); ?>">
        <span><?php echo filterDbOutput($thisHostOwnReview->user_full_name); ?></span>
    </div><!-- end photo-name -->
    <div class="review-text-content">
        <div class="date-general">
            <span><?php echo $thisHostOwnReview->comment_date; ?></span>
            <img src="<?php echo base_url() . 'public/images/emoticons/' . $thisHostOwnReview->smiley_image; ?>" alt="<?php echo $thisHostOwnReview->smiley_type; ?>" class="my-emotion">
        </div><!-- end date-general -->
        <p><?php echo filterDbOutput($thisHostOwnReview->property_location); ?></p>
        <p><?php echo filterDbOutput($thisHostOwnReview->rating); ?></p>
    </div><!-- end review-text-content -->
</li>
<?php
    }
?>
</ul>
<?php
} else {
?>
<p style="text-align:center; ">You have not posted any reviews yet</p>
<?php
}
?>