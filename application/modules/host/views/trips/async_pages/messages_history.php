<div class="frm-body col-md-12 col-padding-no">

<?php
if ($messages) {
    foreach ($messages as $thisMessage) {
?>

<div class="col-md-12 col-padding-no infoActionContainer">
    <div class="col-md-12 col-padding-no tripInfo">
        <h4>From: <?php echo $thisMessage->sender_full_name; ?></h4>
        <h4>To: <?php echo $thisMessage->receiver_full_name; ?></h4>
        <p>Sent On: <?php echo $thisMessage->sent_on; ?></p>
        <p style="word-wrap: break-all;"><?php echo nl2br(filterDbOutput($thisMessage->message)); ?></p>
    </div>
</div>
<div class="clearfix"></div>

<?php
    }
} else {
?>

<div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-12 col-padding-no pull-left">
        <p>No Messages Found From This Property</p>
    </div>
</div>

<?php
}
?>

</div>



<div class="frm-body col-md-12 col-padding-no">
    <div class="col-md-3 col-padding-no pull-left">
        <button class="btn btn-primary back_from_reading_messages">Back</button>
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