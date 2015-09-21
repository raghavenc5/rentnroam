<?php
$this->load->view('header');
?>
<div class="container">
    <div class="row">
        <div class="content-box">
            <h1>Register</h1>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($gpAuthUrl)):
                    ?>
                    <a href="<?php echo $gpAuthUrl; ?>" class="btn btn-primary">Register with google plus</a>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (isset($fbLoginUrl)):
                    ?>
                    &nbsp;&nbsp;
                    <a href="<?php echo $fbLoginUrl; ?>" class="btn btn-primary">Register with facebook</a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('footer');
?>