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
                <?php echo nl2br(filterDbOutput($thisReview->comment_text, 180)); ?>
            </p>
        </div>
    </li>

    <?php
        }
    }
    ?>

</ul>

<?php echo $reviewPageLinks; ?>