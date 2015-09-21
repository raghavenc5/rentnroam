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
            <div class="custom-input-group">
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

                <div class="custom-input-group">
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

                <div class="custom-input-group">
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