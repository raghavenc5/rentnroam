<div class="frm-container">
    <div class="header-row">
        <p class="header-text">
            VERIFICATIONS
            <span class="pull-right">
                <img src="<?php echo base_url(); ?>public/images/view.png" alt="help">
                <img src="<?php echo base_url(); ?>public/images/tips.png" alt="help">
            </span>
        </p>
    </div>
    <div class="frm-body col-md-12 col-padding-no">
        <form class="form-horizontal">
            <div class="alert alert-danger" id="verify_client_side_global_error" style="display:none"><strong>You have some form errors. Please check below</strong></div>
            <div class="alert alert-danger" id="verify_server_side_error_500" style="display:none"></div>
            <div class="alert alert-warning" id="verify_server_side_error_300" style="display:none"></div>
            <div class="alert alert-success" id="verify_server_side_status_200" style="display:none"><strong></strong></div>
            <h3>your current verifications</h3>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-envelope-o"></i>
            </div>
            <div class="col-md-10 col-padding-no">
                <h4>email address</h4>
                <p>A confirmed email is important to allow us to securely communicate with you.</p>
                <p>
                    <span class="docName"><?php echo $profileData->email; ?></span>
                    &nbsp;&nbsp;&nbsp;
                    <span class="docStatus">
                        <i class="fa fa-minus"></i>

                        <?php
                        if ($profileData->is_email_verified) {
                        ?>

                        Verified
                        <i class="fa fa-check"></i>

                        <?php
                        } else {
                        ?>

                        Not Verified
                        <i class="fa fa-times"></i>
                        &nbsp;&nbsp;     
                        <a class="button-pink btn btn-default verify_email_button" href='<?php echo site_url("/host/profile/sendVerificationEmail/primary/$profileData->user_id"); ?>'>VERIFY NOW</a>
                        <span class="email_verification_send_success" style="display:none">Verification email sent successfully</span>

                        <?php
                        }
                        ?>

                    </span>
                </p>

                <?php
                $otherEmails = $profileData->user_other_email ? (false !== strpos($profileData->user_other_email, ';') ? explode(';', $profileData->user_other_email) : array($profileData->user_other_email)) : array();
                if ($otherEmails) {
                    foreach ($otherEmails as $thisOtherEmail) {
                        list($id, $email, $isVerified) = explode(',', $thisOtherEmail);
                ?>

                <p>                                            
                    <span class="docName"><?php echo $email; ?></span>
                    &nbsp;&nbsp;&nbsp;
                    <span class="docStatus">
                        <i class="fa fa-minus"></i>

                        <?php
                        if ($isVerified) {
                        ?>

                        Verified
                        <i class="fa fa-check"></i>

                        <?php
                        } else {
                        ?>

                        Not Verified
                        <i class="fa fa-times"></i>
                        &nbsp;&nbsp;
                        <a class="button-pink btn btn-default verify_email_button" href='<?php echo site_url("/host/profile/sendVerificationEmail/secondary/$id"); ?>'>VERIFY NOW</a>
                        <span class="email_verification_send_success" style="display:none">Verification email sent successfully</span>

                        <?php
                        }
                        ?>

                    </span>
                </p>

                <?php
                    }
                }
                ?>
                
            </div>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-check fa-2x"></i>
            </div>
            <hr/>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="col-md-10 col-padding-no">
                <h4>identification</h4>
                <div class="styled-select">
                    <select class="form-control">
                        <option value="1">DRIVING LICENSE</option>
                        <option value="2">1</option>
                        <option value="3">2</option>
                    </select>
                </div>
                <input class="button-pink btn btn-default documents" type="submit" value="UPLOAD">
                <div class="clearfix"></div>
                <p class="docIdentifier">
                    <span class="docName">passport</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        Done
                        <i class="fa fa-check pull-right"></i>
                    </span>
                </p>
                <p class="docIdentifier">
                    <span class="docName">aadhar card</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        Done
                        <i class="fa fa-check pull-right"></i>
                    </span>
                </p>
                <p class="docIdentifier">
                    <span class="docName">pan card</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        Done
                        <i class="fa fa-check pull-right"></i>
                    </span>
                </p>
            </div>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-check fa-2x"></i>
            </div>
            <hr/>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-phone"></i>
            </div>
            <div class="col-md-10 col-padding-no">
                <h4>phone number</h4>
                <p>Rest assured, your number is only shared with another RNR member once you have confirmed booking.</p>
                <div class="custom-input-group">
                    <input type="text" class="form-control stdCode" placeholder="0832">
                    <input type="text" class="form-control stdCodeMobile" placeholder="9823777290">
                </div>
                <input class="button-pink btn btn-default verifyMobile" type="button" value="VERIFY NOW" data-toggle="collapse" data-target="#mobileCode" aria-expanded="false" aria-controls="mobileCode">
                <div id="mobileCode" class="collapse">
                    <input type="text" class="form-control input-lg" placeholder="enter code" style="width: 240px;float: left;">
                    <input class="button-pink btn btn-default verifyMobile" type="button" value="SUBMIT">
                </div>
            </div>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-check fa-2x"></i>
            </div>
            <hr/>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-weixin"></i>
            </div>
            <div class="col-md-10 col-padding-no" style="padding-bottom: 30px;">
                <h4>social accounts</h4>
                <p>Rest assured, your number is only shared with another RNR member once you have confirmed booking.</p>
                <p class="docIdentifier">
                    <span class="docName">facebook</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        Done
                        <i class="fa fa-check pull-right"></i>
                    </span>
                </p>
                <p class="docIdentifier">
                    <span class="docName">twitter</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        <a href="#">connect</a>
                    </span>
                </p>
                <p class="docIdentifier">
                    <span class="docName">google+</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        <a href="#">connect</a>
                    </span>
                </p>
                <p class="docIdentifier">
                    <span class="docName">linkedin</span>
                    <span class="docStatus pull-right">
                        <i class="fa fa-minus"></i>
                        Done
                        <i class="fa fa-check pull-right"></i>
                    </span>
                </p>
            </div>
            <div class="col-md-1 col-padding-no">
                <i class="fa fa-check fa-2x"></i>
            </div>
        </form>
    </div>
</div>