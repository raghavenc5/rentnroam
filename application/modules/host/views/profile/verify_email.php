<?php
echo $header;
?>

<div class="container" style="padding-top: 180px;">
	<div class="row">
        <div class="col-md-12">

        <?php
        if (! $verifyStatus) {
    	?>

    	<p><strong>Your verification code didn't work. Please reauest for verification for this email again.</strong></p>

    	<?php
        } else {
    	?>

    	<p><strong>Your email has been verified successfully. If you are logged in, then click <a href="<?php echo site_url('/host/profile'); ?>">Profile</a> to visit your profile page, or elase click <a href="<?php echo site_url('/home/index'); ?>">Login</a></strong></p>

    	<?php
        }
        ?>

            <div class="super_global_error_handler alert alert-danger" style="display:none;">
                
            </div>
        </div>
    </div>
</div>

<?php
echo $footer;
?>
