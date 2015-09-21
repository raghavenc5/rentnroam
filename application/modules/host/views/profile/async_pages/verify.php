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
            <form action="" method="post" name="identity_document_upload_form" id="identity_document_upload_form" enctype="multipart/form-data">

                <?php
                $ids = $documentIds = $statuses = array();

                $userDocuments = $profileData->user_document ? (false !== strpos($profileData->user_document, ';') ? explode(';', $profileData->user_document) : array($profileData->user_document)) : array();

                if ($userDocuments) {
                    foreach ($userDocuments as $thisUserDocument) {
                        $parts = explode(',', $thisUserDocument);
                        $ids[] = $parts[0];
                        $documentIds[] = $parts[1];
                        $statuses[] = $parts[2];
                    }
                }
                ?>

                <div class="styled-select">
                    <select class="form-control" name="identity_document[document_id]">
                        <option value="">-Select one-</option>

                        <?php
                        foreach ($documents as $thisDocument) {
                            if (! in_array($thisDocument->id, $documentIds)) {
                        ?>

                        <option value="<?php echo $thisDocument->id; ?>"><?php echo $thisDocument->document; ?></option>

                        <?php
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="fileUpload btn btn-default button-pink-margin button-pink pull-left" style="margin-left:0px;">
                    <span><i class="fa fa-camera pull-left"></i></i>BROWSE</span>
                    <input type="file" class="upload" id="identity_document_browser" name="userfile">
                </div>
                <div class="clearfix"></div>
                <button id="identity_document_upload_button" class="button-pink btn btn-default" type="submit">
                    <i class="fa fa-plus-circle pull-left"></i>
                    UPLOAD
                </button>
                <span class="help-block" id="identity_document_error" style="display:none;">Please select atleast one file</span>
                <input type="hidden" name="identity_document[user_id]" value="<?php echo $userData['user_id']; ?>" />
                <input type="hidden" name="identity_document[status]" value="0" />
            </form>

            <?php
            foreach ($documents as $thisDocument) {
            ?>

            <p class="docIdentifier">
                <span class="docName"><?php echo $thisDocument->document; ?></span>
                <span class="docStatus pull-right">

                    <?php
                    if (in_array($thisDocument->id, $documentIds)) {
                    ?>

                    <i class="fa fa-minus"></i>
                    Done
                    <i class="fa fa-check pull-right"></i>

                    <?php
                    } else {
                    ?>

                    <i class="fa fa-minus"></i>
                    Pending
                    <i class="fa fa-times pull-right"></i>

                    <?php  
                    }
                    ?>

                    
                </span>
            </p>

            <?php 
            }
            ?>

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
            <p>
                
                <?php
                $contactNumber = (($profileData->user_emergency_contact_prefix) ? $profileData->user_emergency_contact_prefix . '-' : '') . $profileData->user_emergency_contact_no;
                ?>

                <span class="docName"><?php echo $contactNumber; ?></span>
                &nbsp;&nbsp;&nbsp;
                <span class="docStatus">
                    <i class="fa fa-minus"></i>

                    <?php
                    if ($profileData->is_emergency_contact_verified) {
                    ?>

                    Verified
                    <i class="fa fa-check"></i>

                    <?php
                    } else {
                    ?>

                    Not Verified
                    <i class="fa fa-times"></i>
                    &nbsp;&nbsp;     
                    <input class="button-pink btn btn-default verifyMobile" type="button" value="VERIFY NOW" data-toggle="collapse" data-target="#mobileCode" aria-expanded="false" aria-controls="mobileCode">
                    <div id="mobileCode" class="collapse">
                        <input type="text" class="form-control input-lg" placeholder="enter code" style="width: 240px;float: left;">
                        <input class="button-pink btn btn-default verifyMobile" type="button" value="SUBMIT">
                    </div>

                    <?php
                    }
                    ?>

                </span>
            </p>

            <?php
            $otherContacts = $profileData->user_other_contact ? (false !== strpos($profileData->user_other_contact, ';') ? explode(';', $profileData->user_other_contact) : array($profileData->user_other_contact)) : array();

            if ($otherContacts) {
                foreach ($otherContacts as $key => $thisOtherContact) {
                    list($id, $prefix, $number, $isVerified) = explode(',', $thisOtherContact);
                    $contactNumber = (($prefix) ? $prefix. '-' : '') . $number;
            ?>

            <p>
                <span class="docName"><?php echo $contactNumber; ?></span>
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
                    <input class="button-pink btn btn-default verifyMobile" type="button" value="VERIFY NOW" data-toggle="collapse" data-target="#mobileCode_<?php echo $key; ?>" aria-expanded="false" aria-controls="mobileCode">
                    <div id="mobileCode_<?php echo $key; ?>" class="collapse">
                        <input type="text" class="form-control input-lg" placeholder="enter code" style="width: 240px;float: left;">
                        <input class="button-pink btn btn-default verifyMobile" type="button" value="SUBMIT">
                    </div>

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
            <i class="fa fa-weixin"></i>
        </div>
        <div class="col-md-10 col-padding-no" style="padding-bottom: 30px;">
            <h4>social accounts</h4>
            <p>Rest assured, your number is only shared with another RNR member once you have confirmed booking.</p>

            <?php
            $socialMedias = array('facebook', 'google+', 'twitter', 'linkedin');
            $userSocialMedias = $profileData->user_social_media ? (false !== strpos($profileData->user_social_media, ';') ? explode(';', $profileData->user_social_media) : array($profileData->user_social_media)) : array();

            foreach ($socialMedias as $key => $thisSocialMedia) {
            ?>

            <p class="docIdentifier">
                <span class="docName"><?php echo $thisSocialMedia; ?></span>
                <span class="docStatus pull-right">
                    <i class="fa fa-minus"></i>

                    <?php
                    if (in_array($thisSocialMedia, $userSocialMedias)) {
                    ?>

                    Done
                    <i class="fa fa-check pull-right"></i>

                    <?php
                    } else {
                    ?>

                    <a href="<?php echo site_url('/host/profile/verifywithlinkedin'); ?>">connect</a>

                    <?php
                    }
                    ?>

                </span>
            </p>

            <?php
            }
            ?>

        </div>
        <div class="col-md-1 col-padding-no">
            <i class="fa fa-check fa-2x"></i>
        </div>
    </div>
</div>