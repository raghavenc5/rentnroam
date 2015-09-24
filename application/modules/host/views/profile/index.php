<?php
// o/p the header
echo $header;
?>

<style>
    .help-block {
        color: #EA1B64 !important;
        font-weight: bold !important;
    }
</style>

<?php
$socialMediaVerification = '';
if ($this->session->flashdata('sm_verification')) {
    $socialMediaVerification = $this->session->flashdata('sm_verification');
}
?>

<div class="container" style="padding-top: 165px;">
    <div class="row">
        <div class="col-md-12">
            <div class="super_global_error_handler alert alert-danger" style="display:none;">
                <strong>You have some form errors. Please check below</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="super_global_error_handler alert alert-danger" style="display:none;">
                <strong>You have some form errors. Please check below</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="super_global_success_handler alert alert-success" style="display:none;">
                <strong>All forms have been submitted successfully</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul id="tabContainer" class="nav nav-tabs tabs-left">
                    <li class="active">
                        <a href="#profile" data-toggle="tab" id="profile_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Edit profile
                        </a>
                    </li>
                    <li>
                        <a href="#Photo" data-toggle="tab" id="Photo_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            profile Photo
                        </a>
                    </li>
                    <li>
                        <a href="#verify" data-toggle="tab" id="verify_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            verify
                        </a>
                    </li>
                    <li>
                        <a href="#review" data-toggle="tab" id="review_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Reviews
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 bk-clr-f8c015 col-padding-no"><!-- Tab panes -->
                <div class="tab-content">

                    <!-- edit profile tab starts -->
                    <div class="tab-pane frm-container active" id="profile">
                        <div class="header-row">
                            <p class="header-text">
                                FILL IN YOUR DETAILS
                                <span class="pull-right">
                                    <img src="<?php echo base_url(); ?>public/images/view.png" alt="help">
                                    <img src="<?php echo base_url(); ?>public/images/tips.png" alt="help">
                                </span>
                            </p>
                        </div>
                        <div class="frm-body col-md-12 col-padding-no">
                            <form class="form-horizontal" name="edit_profile_form" id="edit_profile_form" method="post" action="<?php echo site_url('/host/profile/updateHostProfile'); ?>">
                                <div class="alert alert-danger" id="client_side_global_error" style="display:none"><strong>You have some form errors. Please check below</strong></div>
                                <div class="alert alert-danger" id="server_side_error_500" style="display:none"></div>
                                <div class="alert alert-warning" id="server_side_error_300" style="display:none"></div>
                                <div class="alert alert-success" id="server_side_status_200" style="display:none"><strong>Host profile saved successfully</strong></div>
                                <h3><img src="<?php echo base_url(); ?>public/images/icon-01.png" width="25"> let's start with the basics</h3>
                                <div class="col-md-7 col-padding-no">
                                    <input type="text" name="profile_data[users][first_name]" id="first_name" class="form-control input-lg" placeholder="first name" value="<?php echo $profileData->first_name ? filterDbOutput($profileData->first_name) : ''; ?>">
                                    <input type="text" name="profile_data[users][last_name]" id="last_name" class="form-control input-lg" placeholder="last name" value="<?php echo $profileData->last_name ? filterDbOutput($profileData->last_name) : ''; ?>">
                                    <p class="frm-label">
                                        gender
                                        <input type="radio" class="gender" name="profile_data[users][gender]" value="male" <?php echo ('female' != $profileData->gender) ? 'checked' : ''; ?>> Male
                                        <input type="radio" class="gender" name="profile_data[users][gender]" value="female" <?php echo ('female' == $profileData->gender) ? 'checked' : ''; ?>> Female
                                    </p>
                                    <p class="frm-label birth">
                                        birth date
                                    </p>

                                    <?php
                                    list($birthYear, $birthMonth, $birthDate) = $profileData->birth_date ? explode('-', $profileData->birth_date) : array();
                                    ?>

                                    <div class="col-md-4 styled-select styled-select-short">
                                        
                                        <?php
                                        $monthArray = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'July', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
                                        ?>

                                        <select class="form-control" class="dob" name="profile_data[users][birth_month]">
                                            
                                            <?php
                                            foreach ($monthArray as $key => $value) {
                                            ?>

                                            <option value="<?php echo $key; ?>" <?php echo ($key == $birthMonth) ? 'selected' : ''; ?>><?php echo $value; ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4 styled-select styled-select-short">
                                        <select class="form-control" class="dob" name="profile_data[users][birth_date]">

                                            <?php
                                            for ($i = 1; $i <= 31; $i++ ) {
                                                $monthIndex = (10 <= $i) ? $i : "0$i";
                                            ?>

                                            <option value="<?php echo $monthIndex; ?>" <?php echo ($monthIndex == $birthDate) ? 'selected' : ''; ?>><?php echo $i; ?></option>

                                            <?php
                                            }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-4 styled-select styled-select-short year">
                                        <select class="form-control" class="dob" name="profile_data[users][birth_year]">
                                            
                                            <?php
                                            for ($i = 1969; $i <= getdate()['year']; $i++ ) {
                                            ?>

                                            <option value="<?php echo $i; ?>" <?php echo ($i == $birthYear) ? 'selected' : ''; ?>><?php echo $i; ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <hr/>
                                <h3><img src="<?php echo base_url(); ?>public/images/icon-01.png" width="25"> numbers & letters to reach you with</h3>
                                <div class="col-md-8 col-padding-no">
                                    <div class="custom-input-group" >
                                        <input type="text" name="profile_data[users][email]" class="form-control email" placeholder="email address" value="<?php echo $profileData->email; ?>">
                                        <p>

                                            <?php
                                            if ($profileData->is_email_verified) {
                                            ?>
                                            verified
                                            <i class="fa fa-check"></i>
                                            <?php
                                            } else {
                                            ?>
                                            Not Verified
                                            <i class="fa fa-times"></i>
                                            <?php
                                            }
                                            ?>

                                            <!-- <span class="pull-right">
                                                <img src="<?php echo base_url(); ?>public/images/closex.png">
                                            </span> -->
                                        </p>
                                    </div>

                                    <div>
                                        
                                        <?php
                                        $otherEmails = $profileData->user_other_email ? (false !== strpos($profileData->user_other_email, ';') ? explode(';', $profileData->user_other_email) : array($profileData->user_other_email)) : array();

                                        if ($otherEmails) {
                                            foreach ($otherEmails as $thisOtherEmail) {
                                                list($id, $email, $isVerified, $verificationCode) = explode(',', $thisOtherEmail);
                                        ?>

                                        <div class="custom-input-group" >
                                            <input type="hidden" name="profile_data[users_email][is_verified][]" value="<?php echo $isVerified; ?>"/>
                                            <input type="hidden" name="profile_data[users_email][verification_code][]" value="<?php echo $verificationCode; ?>"/>
                                            <input type="text" name="profile_data[users_email][email][]" class="form-control email" placeholder="email address" value="<?php echo $email; ?>">
                                            <p>

                                                <?php
                                                if ($isVerified) {
                                                ?>
                                                verified
                                                <i class="fa fa-check"></i>
                                                <?php
                                                } else {
                                                ?>
                                                Not Verified
                                                <i class="fa fa-times"></i>
                                                <?php
                                                }
                                                ?>

                                                <span class="pull-right">
                                                    <a href="javascript:void(0);" class="email_remover"><img src="<?php echo base_url(); ?>public/images/closex.png"></a>
                                                </span>
                                            </p>
                                        </div>

                                        <?php
                                            }
                                        }
                                        ?>

                                        <div class="col-md-6 col-padding-no pull-left" id="add_another_email_button_container">
                                            <button id="add_another_email" class="button-pink btn btn-default pull-left">Add Another Email</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div>

                                        <?php
                                        $otherContacts = $profileData->user_other_contact ? (false !== strpos($profileData->user_other_contact, ';') ? explode(';', $profileData->user_other_contact) : array($profileData->user_other_contact)) : array();

                                        if ($otherContacts) {
                                            foreach ($otherContacts as $thisOtherContact) {
                                                list($id, $prefix, $number, $isVerified, $contactVerificationCode) = explode(',', $thisOtherContact);
                                        ?>

                                        <div class="custom-input-group" >
                                            <input type="hidden" name="profile_data[users_contact][is_verified][]" value="<?php echo $isVerified; ?>"/>
                                            <input type="hidden" name="profile_data[users_contact][contact_verification_code][]" value="<?php echo $contactVerificationCode; ?>"/>
                                            <input type="text" name="profile_data[users_contact][prefix][]" class="form-control stdCode prefix" placeholder="Prefix" value="<?php echo $prefix; ?>">
                                            <input type="text" name="profile_data[users_contact][number][]" class="form-control stdCodeMobile number" placeholder="Number" value="<?php echo $number; ?>">
                                            <p>

                                                <?php
                                                if ($isVerified) {
                                                ?>
                                                verified
                                                <i class="fa fa-check"></i>
                                                <?php
                                                } else {
                                                ?>
                                                Not Verified
                                                <i class="fa fa-times"></i>
                                                <?php
                                                }
                                                ?>

                                                <span class="pull-right">
                                                    <a href="javascript:void(0);" class="contact_remover"><img src="<?php echo base_url(); ?>public/images/closex.png"></a>
                                                </span>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>

                                        <?php
                                            }
                                        }
                                        ?>

                                        <div class="col-md-6 col-padding-no pull-left" id="add_another_contact_button_container">
                                            <button id="add_another_contact" class="button-pink btn btn-default pull-left">Add Another Contact</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="custom-input-group">
                                        <input type="hidden" name="profile_data[users][is_emergency_contact_verified]" value="<?php echo $profileData->is_emergency_contact_verified; ?>"/>
                                        <input type="text" name="profile_data[users][user_emergency_contact_prefix]" class="form-control stdCode" placeholder="Prefix" value="<?php echo $profileData->user_emergency_contact_prefix; ?>">
                                        <input type="text" name="profile_data[users][user_emergency_contact_no]" class="form-control stdCodeMobile" placeholder="Number" value="<?php echo $profileData->user_emergency_contact_no; ?>">
                                        <p style="border: none;">optional
                                        </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <input type="text" name="profile_data[users][address_line_1]" id="address_line_1" class="form-control input-lg" placeholder="adress line 1" value="<?php echo $profileData->address_line_1; ?>">
                                    <input type="text" name="profile_data[users][address_line_2]" class="form-control input-lg" placeholder="adress line 2" value="<?php echo $profileData->address_line_2; ?>">
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 styled-select mrgnRght">
                                        <select class="form-control" name="profile_data[users][country_id]" id="country_dropdown" onchange="selectState(this.options[this.selectedIndex].value)">
                                            <option value="">-Select country-</option>

                                            <?php
                                            foreach ($countries as $thisCountry) {
                                            ?>
                                            <option value="<?php echo $thisCountry->country_id; ?>" <?php echo ($thisCountry->country_id == $profileData->country_id) ? 'selected' : ''; ?>><?php echo $thisCountry->country_name; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6 styled-select">
                                        <select class="form-control" id="state_dropdown" name="profile_data[users][state_id]" onchange="selectCity(this.options[this.selectedIndex].value)">
                                            <option value="">-Select state-</option>

                                            <?php
                                            if ($states) {
                                                foreach ($states as $thisState) {
                                            ?>

                                            <option value="<?php echo $thisState->id; ?>" <?php echo ($thisState->id == $profileData->state_id) ? 'selected' : ''; ?>><?php echo $thisState->state_name; ?></option>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 styled-select mrgnRght">
                                        <select class="form-control" id="city_dropdown" name="profile_data[users][city_id]">
                                            <option value="">-Select city-</option>

                                            <?php
                                            if ($cities) {
                                                foreach ($cities as $thisCity) {
                                            ?>

                                            <option value="<?php echo $thisCity->id; ?>" <?php echo ($thisCity->id == $profileData->city_id) ? 'selected' : ''; ?>><?php echo $thisCity->city_name; ?></option>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6 col-padding-no zipcode">
                                        <input type="text" name="profile_data[users][zip]" id="zip" class="form-control" placeholder="ZIP CODE" value="<?php echo $profileData->zip ? filterDbOutput($profileData->zip) : ''; ?>">
                                    </div>
                                    <div class="clearfix" id="location_error_before"></div>
                                </div>
                                <hr/>
                                <h3><img src="<?php echo base_url(); ?>public/images/info.png" width="25"> paint us a picture of you (well, not literally!)</h3>
                                <div class="col-md-8 col-padding-no">
                                    <p class="frm-label">
                                        tell us who you are!
                                    </p>
                                    <input type="text" name="profile_data[users][school]" class="form-control input-lg" placeholder="my school" value="<?php echo $profileData->school ? filterDbOutput($profileData->school) : ''; ?>">
                                    <input type="text" name="profile_data[users][college]" class="form-control input-lg" placeholder="my college" value="<?php echo $profileData->college ? filterDbOutput($profileData->college) : ''; ?>">
                                    <input type="text" name="profile_data[users][work]" id="work" class="form-control input-lg" placeholder="my work" value="<?php echo $profileData->work ? filterDbOutput($profileData->work) : ''; ?>">
                                    <input type="text" name="profile_data[users][hobbies]" class="form-control input-lg" placeholder="my hobbies" value="<?php echo $profileData->hobbies ? filterDbOutput($profileData->hobbies) : ''; ?>">
                                    <textarea name="profile_data[users][about]" id="about" class="form-control input-lg" rows="5" placeholder="about me..." style="margin-bottom: 0px;"><?php echo $profileData->about ? filterDbOutput($profileData->about) : ''; ?></textarea>
                                    <div class="col-md-6 styled-select language">
                                        <select class="form-control" id="language" name="profile_data[users][languages][]" multiple>
                                            <option value="">-Select language-</option>

                                            <?php
                                            $hostLanguages = $profileData->languages ? (false !== strpos($profileData->languages, ',') ? explode(',', $profileData->languages) : array($profileData->languages)) : array();
                                            foreach ($languages as $thisLanguage) {
                                            ?>
                                            <option value="<?php echo $thisLanguage->id; ?>" <?php echo in_array($thisLanguage->id, $hostLanguages) ? 'selected' : ''; ?>><?php echo $thisLanguage->language?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <input type="hidden" name="profile_data[users][user_id]" value="<?php echo $profileData->user_id; ?>"/>
                                    <input type="hidden" name="profile_is_visited" id="profile_is_visited" class="is_visited" value="1"/>
                                    <input type="hidden" name="profile_is_submitted" id="profile_is_submitted" class="is_submitted" value=""/>
                                    <input class="basicSubmit button-pink btn btn-default pull-left col-md-6" type="submit" value="SAVE">
                                    <div class="clearfix" id="language_error_before"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- edit profile tab ends -->

                    <!-- profile photo tab starts -->
                    <div class="tab-pane" id="Photo">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    UPLOAD PHOTO
                                    <span class="pull-right">
                                        <img src="<?php echo base_url(); ?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url(); ?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-12 col-padding-no" style="margin-left: -30px;">
                                <form id="imageUploader" class="form-horizontal" method="post" action="<?php echo site_url('/host/profile/uploadHostProfilePhoto'); ?>" enctype="multipart/form-data">
                                    <div class="alert alert-danger" id="profile_pic_client_side_global_error" style="display:none"><strong>You have some form errors. Please check below</strong></div>
                                    <div class="alert alert-danger" id="profile_pic_server_side_error_500" style="display:none"></div>
                                    <div class="alert alert-warning" id="profile_pic_server_side_error_300" style="display:none"></div>
                                    <div class="alert alert-success" id="profile_pic_server_side_status_200" style="display:none"><strong>Host profile photo saved successfully</strong></div>
                                    <div id="imageEditor" class="col-md-5 col-padding-no">
                                        <div class="image-editor">
                                            <!-- <input type="file" class="cropit-image-input"> -->
                                            <div class="cropit-image-preview-container">
                                                <div class="cropit-image-preview">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </div>
                                            </div>
                                            <div class="zoomContainer">
                                                <i class="fa fa-minus"></i>
                                                <input type="range" class="cropit-image-zoom-input">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="fileUpload btn btn-default button-pink button-pink-margin pull-left">
                                                <span><i class="fa fa-camera pull-left"></i></i>TAKE PHOTO</span>
                                                <input type="file" id="host_profile_pic_uploader" class="upload cropit-image-input">
                                            </div>
                                            <input type="hidden" name="image-data" id="image-data" class="hidden-image-data" />
                                            <input type="hidden" name="host_id" id="host_id" value="<?php echo $userData['user_id']; ?>"/>
                                            <input type="hidden" name="Photo_is_visited" id="Photo_is_visited" class="is_visited" value=""/>
                                            <input type="hidden" name="Photo_is_submitted" id="Photo_is_submitted" class="is_submitted" value=""/>
                                            <button id="captureImage" class="button-pink btn btn-default" type="submit">
                                                <i class="fa fa-plus-circle pull-left"></i>
                                                UPLOAD PHOTO
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-padding-no" style="padding-left: 20px;">
                                        <p class="photo-text">
                                            Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitNeque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velitNeque porro quisquam est qui porro
                                        </p>
                                        <div class="instructionContainer">
                                            <p>INSTRUCTIONS</p>
                                            <ol>
                                                <li>Neque porro quisquam est</li>
                                                <li>Neque porro quisquam est</li>
                                                <li>Neque porro quisquam est</li>
                                                <li>Neque porro quisquam est</li>
                                            </ol>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- profile photo tab ends -->

                    <!-- verify tab starts -->
                    <div class="tab-pane" id="verify"></div>
                    <!-- verify tab ends -->

                    <!-- reviews tab starts -->
                    <div class="tab-pane" id="review">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    REVIEWS
                                    <span class="pull-right">
                                        <img src="<?php echo base_url(); ?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url(); ?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-12 col-padding-no">
                                <div id="horizontalTab">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active col-md-6 text-center col-padding-no">
                                            <a href="#aboutYou" aria-controls="aboutYou" role="tab" data-toggle="tab">reviews about you</a>
                                        </li>
                                        <li role="presentation" class="col-md-6 text-center col-padding-no">
                                            <a href="#byYou" aria-controls="byYou" role="tab" data-toggle="tab">reviews by you</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="aboutYou">
                                            <?php
                                            if ($hostPropertyReviews) {
                                            ?>
                                            <ul class="reviews">
                                            <?php
                                                foreach ($hostPropertyReviews as $thisHostPropertyReview) {
                                                    $reviewerProfilePicUrl = (strstr($thisHostPropertyReview->profile_pic, 'https://')) ? $thisHostPropertyReview->profile_pic : base_url() . '/public/uploads/user_image/' . $thisHostPropertyReview->profile_pic;
                                            ?>
                                            <li>
                                                <div class="photo-name">
                                                    <img src="<?php echo $reviewerProfilePicUrl; ?>" alt="<?php echo filterDbOutput($thisHostPropertyReview->user_full_name); ?>">
                                                    <span><?php echo filterDbOutput($thisHostPropertyReview->user_full_name); ?></span>
                                                </div><!-- end photo-name -->
                                                <div class="review-text-content">
                                                    <div class="date-general">
                                                        <span><?php echo $thisHostPropertyReview->comment_date; ?></span>
                                                        <img src="<?php echo base_url() . 'public/images/emoticons/' . $thisHostPropertyReview->smiley_image; ?>" alt="<?php echo $thisHostPropertyReview->smiley_type; ?>" class="my-emotion">
                                                    </div><!-- end date-general -->
                                                    <p><?php echo filterDbOutput($thisHostPropertyReview->property_location); ?></p>
                                                    <p><?php echo filterDbOutput($thisHostPropertyReview->rating); ?></p>
                                                </div><!-- end review-text-content -->
                                            </li>
                                            <?php
                                                }
                                            ?>
                                            </ul>
                                            <?php
                                            } else {
                                            ?>
                                            <p style="text-align:center; ">No reviews have been added for any of your properties yet</p>
                                            <?php
                                            }
                                            ?>                                         
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="byYou">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- write review modal -->
                    <div class="modal fade" id="write_review" tabindex="-1" role="dialog" aria-labelledby="write_review_modal_label">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form id="write_review_form" name="write_review_form" action="<?php echo site_url('/host/profile/savePropertyReview'); ?>" method="post">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="write_review_modal_label">Write A Review</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" id="review_client_side_global_error" style="display:none"><strong>You have some form errors. Please check below</strong></div>
                                        <div class="alert alert-danger" id="review_server_side_error_500" style="display:none"></div>
                                        <div class="alert alert-warning" id="review_server_side_error_300" style="display:none"></div>
                                        <div class="alert alert-success" id="review_server_side_status_200" style="display:none"><strong>Review saved successfully</strong></div>
                                        <div class="row">
                                            <div class="col-md-2" style="font-weight:bold; text-transform:capitalize;">Rate It</div>
                                            <div class="col-md-4">
                                                <?php
                                                $smileyList = "";
                                                if ($smileys) {
                                                    foreach ($smileys as $thisSmiley) {
                                                        $smileyList .= $smileyList ? "&nbsp;&nbsp<a href='javascript:void(0);' id='smiley_$thisSmiley->smiley_id' class='rating_smileys'><img src='" . base_url() . "public/images/emoticons/$thisSmiley->smiley_image' title='$thisSmiley->smiley_type'/></a>" : "<a href='javascript:void(0);' id='smiley_$thisSmiley->smiley_id' class='rating_smileys'><img src='" . base_url() . "public/images/emoticons/$thisSmiley->smiley_image' title='$thisSmiley->smiley_type'/></a>";
                                                    }
                                                }
                                                echo $smileyList;
                                                ?>
                                            </div>
                                            <div class="col-md-4" id="smiley_error"></div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea name="review_data[rating]" id="rating" class="form-control input-lg" rows="5" placeholder="review..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="review_data[property_id]" id="reviewed_property_id" value="">
                                        <input type="hidden" name="review_data[user_id]" value="<?php echo $userData['user_id']; ?>">
                                        <input type="hidden" name="review_data[smiley_id]" id="reviewed_smiley_id" value="">
                                        <input type="hidden" name="review_is_clicked" id="review_is_clicked" class="is_clicked" value=""/>
                                        <input type="hidden" name="review_is_visited" id="review_is_visited" class="is_visited" value=""/>
                                        <input type="hidden" name="review_is_submitted" id="review_is_submitted" class="is_submitted" value=""/>
                                        <button type="button" class="button-pink btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="button" id="submit_review_button" class="button-pink btn btn-default pull-left">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- write review modal -->

                    <!-- reviews tab ends -->

                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <a href="javascript:void(0);" id="save_all" class="button-pink btn btn-default no-margin-top">Save All</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var verifyStatus = '<?php echo $socialMediaVerification; ?>';
        if (verifyStatus) {
            $.ajax({
                url: base_url + "host/profile",
                method: "post",
                dataType: "html",
                data: {"mode": "load_verify_panel"},
                success: function(response) {
                    $("#verify").empty().html(response);
                    $('#verify_tab').trigger('click');
                }
            });
        }
    });
</script>

<?php
// o/p the footer
echo $footer;
?>