<?php
// o/p the header
echo $header;
?>

<?php
$propertyId = $propertyDetails->property_id;
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,300'>
<style>
    .help-block {
        color: #EA1B64 !important;
        font-weight: bold !important;
    }
    .help-block-alt {
        color: #3c763d !important;
        font-weight: bold !important;
    }
    .footer h5 {
        font-weight: 500;
        color: #c2185b !important;
    }
</style>
<div class="container" style="padding-top: 180px;">
	<div class="row">
		<div class="col-md-12">
			<div class="global_error_handler alert alert-danger" style="display:none;">
				<strong>You have some form errors. Please check below</strong>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="global_success_handler alert alert-success" style="display:none;">
				<strong>All forms have been submitted successfully</strong>
			</div>
		</div>
	</div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="active">
                        <a href="#overview" data-toggle="tab" id="overview_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(1, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Property Overview
                        </a>
                    </li>
                    
                    <?php
                    if ($childPropertyDetails) {
                    ?>
                    
                    <li>
                        <a href="#manageRooms" data-toggle="tab" id="manageRooms_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(8, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Manage Rooms
                        </a>
                    </li>
                    
                    <?php
                    }
                    ?>
                    
                    <li>
                        <a href="#photos" data-toggle="tab" id="photos_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(2, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Property Photo
                        </a>
                    </li>
                    <li>
                        <a href="#pricing" data-toggle="tab" id="pricing_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(3, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Pricing
                        </a>
                    </li>
                    <li>
                        <a href="#amenities" data-toggle="tab" id="amenities_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(4, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Amenities
                        </a>
                    </li>
                    <li>
                        <a href="#listing" data-toggle="tab" id="listing_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(5, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Listing
                        </a>
                    </li>
                    <li>
                        <a href="#location" data-toggle="tab" id="location_tab">
                            <p class="icon-check text-right"><i class="fa fa-check" style="<?php echo ($tabs && in_array(6, $tabs)) ? 'color: #55a018;' : ''; ?>"></i></p>
                            Location
                        </a>
                    </li>
                    <li id="saveTab">
                        <a href="javascript:void(0);" id="save_all" class="button-pink btn btn-default no-margin-top" style="margin-bottom:2px">SUBMIT</a>
                        <?php
                        if ($propertyDetails->parent_id) {
                        ?>
                        <a href='<?php echo site_url("/host/propertylisting/$propertyDetails->parent_id"); ?>' class="button-pink btn btn-default no-margin-top">Back</a>
                        <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 bk-clr-f8c015 col-padding-no"> <!-- Tab panes -->
                <div class="tab-content">
                    <!-- overview tab starts -->
                    <div class="tab-pane frm-container active" id="overview">
                        <div class="header-row">
                            <p class="header-text">
                                COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                <span class="pull-right">
                                    <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                    <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                </span>
                            </p>
                        </div>
                        <div class="frm-body col-md-9 col-padding-no">
                            <form id="overview_form" name="overview_form" action="<?php echo base_url(); ?>host/saveOverview" method="post">
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="errorHandler alert alert-danger" style="display: none;">
                                            <strong>You have some form errors. Please check below</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(1, $tabs)) ? '' : 'display:none;'; ?>">
                                            <strong>Overview has been submitted successfully</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
                                    </div>
                                </div>
                                <h2 id="overview_error">OVERVIEW</h2>
                                <h3>A title and summary displayed on your public listing page</h3>
                                <p class="frm-label">
                                    TITLE
                                </p>
                                <input type="text" name="title"  class="form-control input-lg"  id="title" value="<?php echo (isset($propertyDetails->property_title) && $propertyDetails->property_title) ? filterDbOutput($propertyDetails->property_title) : ''; ?>"/>
                                <p class="frm-label">
                                    description
                                </p>
                                 <textarea class="form-control input-lg" type="text"  name='description' id="description" rows="5"><?php echo (isset($propertyDetails->description) && $propertyDetails->description) ? filterDbOutput($propertyDetails->description) : ''; ?></textarea>
                                <p class="frm-label">
                                    NEIGHBORHOOD HIGHLIGHTS
                                </p>
                                <textarea class="form-control input-lg" name='neighbourhood' id="neighbourhood" rows="5"><?php echo (isset($propertyDetails->neighbourhood_highlight) && $propertyDetails->neighbourhood_highlight) ? filterDbOutput($propertyDetails->neighbourhood_highlight) : ''; ?></textarea>
                                <hr/>
                                <p class="frm-label">
                                    HOUSE RULES <span>(IF ANY)</span>
                                </p>
                                <textarea class="form-control input-lg" name='house_rules' id="house_rules" rows="5"><?php echo (isset($propertyDetails->house_rule) && $propertyDetails->house_rule) ? filterDbOutput($propertyDetails->house_rule) : ''; ?></textarea>
                                
                                
                                <hr/>
                                <div class="select-container">
                                    <p class="col-md-6" style="padding-top: 0px;">Minimum night stay</p>
                                    <div class="col-md-6 styled-select styled-select-short">
                                        
                                        <?php
										$minNightStay = (isset($propertyDetails->min_night_stay) && $propertyDetails->min_night_stay) ? $propertyDetails->min_night_stay : 1;
										?>
										
                                        <select class="form-control" name="min_night" id="min_night">
                                            <option value="1" <?php echo (1 == $minNightStay) ? 'selected' : ''; ?>>1</option>
                                            <option value="2" <?php echo (2 == $minNightStay) ? 'selected' : ''; ?>>2</option>
                                            <option value="3" <?php echo (3 == $minNightStay) ? 'selected' : ''; ?>>3</option>
                                            <option value="4" <?php echo (4 == $minNightStay) ? 'selected' : ''; ?>>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name='property_id' value="<?php echo $propertyId; ?>" >
                                <input type="hidden" name="overview_is_submitted" class="is_submitted" id="overview_is_submitted" value=""/>
                                <input type="hidden" name="overview_is_visited" class="is_visited" id="overview_is_visited" value="1"/>
                                 <input type="submit" class="button-pink btn btn-default pull-left" name='submit' id="save_overview" value="SAVE">
                            </form>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- overview tab ends -->
                    

                    <!-- manage rooms tab starts -->
                    <div class="tab-pane" id="manageRooms">
                       <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                           <div class="frm-body col-md-9 col-padding-no">
                               <!--<form id="manageRooms">-->
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="errorHandler alert alert-danger" style="display:none;">
                                                <strong>You have some form errors. Please check below</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(8, $tabs)) ? '' : 'display:none;'; ?>">
                                                <strong>All room details have been submitted successfully</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
                                        </div>
                                    </div>
                                    <h2>ADD A ROOM OR TWO!</h2>
                                    <h3>Lorem ipsum dollar sit amet. Lorem ipsum dollar sit amet. Lorem ipsum dollar sit amet.</h3>
                                    <br/>
                                    <!-- add textbox and buttons here -->
                                    <table id="addRooms" class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <img id="addRoomsBtn" src="<?php echo base_url()?>public/images/details_open.png" alt="Add More">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            if ($childPropertyDetails) {
                                                foreach ($childPropertyDetails as $key => $thisChildProperty) {
                                            ?>
                                            
                                            <tr>
                                                <form name="manage_room_form" class="manage_room_forms" action="<?php echo site_url('/host/saveRoomDetails'); ?>" method="post">
                                                    <td>
                                                        <input type="text" class="form-control input-lg txtRoom room_names" placeholder="Room Name" name="room_name" value="<?php echo $thisChildProperty->property_title ? $thisChildProperty->property_title : ''; ?>"/>                                                                                <span class="help-block room_name_errors" style="display: none;">Please enter room name</span>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-6 styled-select styled-select-short">
                                                            <select class="form-control room_types" name="room_type">
                                                                <option value="">-Select One-</option>
                                                                <option value="1" <?php echo ($thisChildProperty->room_type_id == 1) ? 'selected' : ''; ?>>Private</option>
                                                                <option value="2" <?php echo ($thisChildProperty->room_type_id == 2) ? 'selected' : ''; ?>>Shared</option>
                                                                <option value="3" <?php echo ($thisChildProperty->room_type_id == 3) ? 'selected' : ''; ?>>Entire Home Apartment</option>
                                                            </select>
                                                        </div>
                                                        <span class="help-block room_type_errors" style="display: none;">Please select room type</span>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-6 styled-select styled-select-short">
                                                            <select class="form-control guest_allowed" name="guest_allowed">
                                                                <option value="">-select One-</option>
                                                                <option value="1" <?php echo ($thisChildProperty->guest_allow == '1') ? 'selected' : ''; ?>>1</option>
                                                                <option value="2" <?php echo ($thisChildProperty->guest_allow == '2') ? 'selected' : ''; ?>>2</option>
                                                                <option value="3" <?php echo ($thisChildProperty->guest_allow == '3') ? 'selected' : ''; ?>>3</option>
                                                                <option value="4" <?php echo ($thisChildProperty->guest_allow == '4') ? 'selected' : ''; ?>>4</option>
                                                                <option value="5" <?php echo ($thisChildProperty->guest_allow == '5') ? 'selected' : ''; ?>>5</option>
                                                                <option value="6" <?php echo ($thisChildProperty->guest_allow == '6') ? 'selected' : ''; ?>>6</option>
                                                                <option value="7" <?php echo ($thisChildProperty->guest_allow == '7') ? 'selected' : ''; ?>>7</option>
                                                                <option value="8" <?php echo ($thisChildProperty->guest_allow == '8') ? 'selected' : ''; ?>>8</option>
                                                                <option value="9" <?php echo ($thisChildProperty->guest_allow == '9') ? 'selected' : ''; ?>>9</option>
                                                                <option value="10+" <?php echo ($thisChildProperty->guest_allow == '10+') ? 'selected' : ''; ?>>10+</option>
                                                            </select>
                                                        </div>
                                                        <span class="help-block guest_allowed_errors" style="display: none;">Please select guest allowed</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="button-pink btn btn-default pull-left manage_room_button">Add</a>
                                                        
                                                        <input type="hidden" name="property_id" class="property_ids"  value="<?php echo $thisChildProperty->property_id; ?>"/>
                                                        <input type="hidden" value="" name="is_room_data_submitted" class="room_data_submitted"/>
                                                        <input type="hidden" value="" name="is_room_data_visited" class="room_data_visited"/>
                                                    </td>
                                                    <td><a href="<?php echo site_url("/host/propertylisting/$thisChildProperty->property_id"); ?>" class="button-pink btn btn-default pull-left edit_this_room">Edit</a></td>
                                                    <td class="remove">
                                                        <img class="removeRoomsBtn remove_this_room" src="<?php echo base_url()?>public/images/closex.png" alt="Remove">
                                                    </td>
                                                    <td>
                                                        <span class="help-block save-error" style="display:none;"></span>
                                                        <span class="help-block delete-error" style="display:none;"></span>
                                                        <span class="help-block-alt save-success" style="display:none;"></span>
                                                    </td>
                                                </form>
                                            </tr>
                                            
                                            
                                            <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><a href="javascript:void(0);" class="button-pink btn btn-default pull-left add_all_rooms">Save All</a></th>
                                                <th style="padding-left: 10px;"><img class="removeRoomsBtn remove_all_rooms" src="<?php echo base_url()?>public/images/closex.png" alt="Remove_All"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <!--</form>-->
                                <input type="hidden" id="parent_property_id" name="parent_property_id" value="<?php echo $propertyId; ?>"/>
                                <input type="hidden" id="property_type_id" name="property_type_id" value="<?php echo $propertyDetails->property_type_id; ?>"/>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $propertyDetails->user_id; ?>"/>
                                <input type="hidden" name="manageRooms_is_submitted" class="is_submitted" id="manageRooms_is_submitted" value=""/>
                                <input type="hidden" name="manageRooms_is_visited" class="is_visited" id="manageRooms_is_visited" value=""/>
                            </div>
                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <!-- manage rooms tab ends -->

                    <!-- property photo and video tab starts -->
                    <div class="tab-pane" id="photos">
                       <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                           <div class="frm-body col-md-9 col-padding-no">
                               <form id="fileupload">
                                    <br/>
                                    <div style="padding-left:0px;" class="col-md-12">
                                        <div class="errorHandler alert alert-danger" style="display:none;">
                                            <strong>Photo uploading failed completely. Please check below.</strong>
                                        </div>
                                    </div>
                                    <div style="padding-left:0px;" class="col-md-12">
                                        <div class="errorHandlerAlt alert alert-danger" style="display:none;">
                                            <strong>Photo and/or video uploading could not be started. Please check below.</strong>
                                        </div>
                                    </div>
                                    <div style="padding-left:0px;" class="col-md-12">
                                        <div class="warningHandler alert alert-warning" style="display:none;">
                                            <strong>Some photos could not be uploaded. Please check below.</strong>
                                        </div>
                                    </div>
                                    <div style="padding-left:0px;" class="col-md-12">
                                        <div class="warningHandlerAlt alert alert-warning" style="display:none;">
                                            <strong>You already have photos uploaded for this property; if you want to upload some more photos still, then add those following the below instructions.</strong>
                                        </div>
                                    </div>
                                    <div style="padding-left:0px;"  class="col-md-12">
                                        <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(2, $tabs)) ? '' : 'display:none;'; ?>">
                                            <strong>All photos have been uploaded successfully</strong>
                                        </div>
                                    </div>                                    
                                    <h2>ADD A PHOTO OR TWO!</h2>
                                    <h3>Upload min 1 and max 24. Only .JPEG images. Max 5 MB in size. No special characters in filename please</h3>
                                    <br/>
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <span class="button-pink btn btn-default pull-left fileinput-button" style="margin: 0;">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>ADD A PHOTO</span>
                                                <input type="file" id="files" name="files[]" multiple>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p class="frm-label">
                                        photo
                                    </p>
                                    <!-- The table listing the files available for upload/download -->
                                    <ul class="files" style="padding-left:0px;"></ul>
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <h3 class="h3-imp">Do you have a video? Simply enter your video URL.</h3>
                                    <input type="text" name="video_id" id="video_id" class="form-control"  placeholder="enter your video URL" value="<?php echo isset($propertyDetails->property_video) ? 'https://www.youtube.com/watch?v=' . $propertyDetails->property_video : ''; ?>"/>
                                    <span class="help-block" id="no_video_error" style="display:none;">Please enter video id</span>
                                    <span class="help-block" id="wrong_video_id_error" style="display:none;">No such video exists on YouTube</span>
                                    <br/>
                                    <div style="width:100%; " id="video_preview"><?php echo ($propertyDetails->property_video) ? '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' . filterDbOutput($propertyDetails->property_video) .'" frameborder="0" allowfullscreen></iframe>' : ''; ?></div>
                                    <input type="hidden" name='property_id' value="<?php echo $propertyId; ?>"/>
                                    <input type="hidden" name="photos_is_submitted" class="is_submitted" id="photos_is_submitted" value=""/>
                                    <input type="hidden" name="photos_is_visited" class="is_visited" id="photos_is_visited" value=""/>
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <button type="submit" class="start" style="display:none">
                                                <i class="glyphicon glyphicon-upload"></i>
                                                <span>Add</span>
                                            </button>
                                            <a href="javascript:void(0);" id="add_photo" class="button-pink btn btn-default pull-left">Add</a>
                                            <div class="clearfix"></div>
                                            <span class="help-block" id="no_images_error" style="display:none;">Please select atleast one image</span>
                                            <span class="help-block" id="max_file_count_error" style="display:none;">Maximum upload count of 8 exeded</span>
                                            <span class="help-block" id="null_property_id_error" style="display:none;">Property ID does not exist</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>
                        </div>
                        <!-- The blueimp Gallery widget -->
                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>                        
                    </div>
                    <!-- property photo and video tab ends -->
                    
                    <!-- pricing tab starts -->                    
                    <div class="tab-pane" id="pricing">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-9 col-padding-no">
                                <form id="pricing_form" name="pricing_form" action="<?php echo base_url(); ?>host/addPricing" method="post">
                                    <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="errorHandler alert alert-danger" style="display:none;">
                                                <strong>You have some form errors. Please check below</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(3, $tabs)) ? '' : 'display:none;'; ?>">
                                                <strong>Pricings saved successfully</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-12">
											<div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
										</div>
									</div>
                                    
                                    <?php
									$propertyPricesRelation = (isset($propertyDetails->property_prices_relation) && $propertyDetails->property_prices_relation) ? explode(';', $propertyDetails->property_prices_relation) : array();
                                    $propertyPrices = (isset($propertyDetails->property_prices) && $propertyDetails->property_prices) ? explode(';', $propertyDetails->property_prices) : array();
									?>
                                    
                                    <div class="col-md-6 col-padding-no" id="pricing_error"><h2 class="no-margin-top">PRICING</h2></div>
                                    <div class="col-md-6 col-padding-no">
                                        <div class="select-container pull-right no-margin-top">
                                            <div class="col-md-6 styled-select styled-select-short">
                                                <select class="form-control">
                                                    <option value="1">INR</option>
                                                    <option value="2">RNR</option>
                                                    <option value="3">PNR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <h3>The base price and default currency for your listing.</h3>
                                    <hr/>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 col-padding-no">
                                        <table class="table borderless">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    
                                                    <?php
                                                    foreach ($seasonTypes as $key1 => $thisSeasonType) {
                                                        if (2 < $thisSeasonType->id) {
                                                            continue;
                                                        }
                                                    ?>
                                                    
                                                    <th class="<?php echo (0 == $key1) ? 'pull-left' : ''; ?>"><?php echo $thisSeasonType->season_type; ?></th>
                                                    
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $count = 0;
                                                foreach ($periodTypes as $key2 => $thisPeriodType) {
                                                ?>
                                                
                                                <tr>
                                                    <th scope="row" class="pull-left"><?php echo $thisPeriodType->period; ?></th>
                                                    
                                                    <?php
                                                    foreach ($seasonTypes as $key3 => $thisSeasonType) {
                                                        $thisPrice = '';
                                                        $disabledPrice = '';
                                                    
                                                        $needle = "$thisPeriodType->id,$thisSeasonType->id";
                                                        if (in_array($needle, $propertyPricesRelation)) {
                                                            $priceKey = array_search($needle, $propertyPricesRelation);
                                                            $thisPrice = $propertyPrices[$priceKey];
                                                        }
                                                        
                                                        if (2 < $thisSeasonType->id) {
                                                            continue;
                                                        }
                                                    ?>
                                                    
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                            <input type="text" id="<?php echo $thisSeasonType->season_type . '_' . $thisPeriodType->period; ?>" name="price[<?php echo $count++; ?>]" class="form-control prices" placeholder="2499" aria-describedby="basic-addon1" value="<?php echo $thisPrice; ?>" <?php echo $disabledPrice; ?>>
                                                            <input type="hidden" name="master_price_period_id[]" value="<?php echo $thisPeriodType->id; ?>"/>
                                                            <input type="hidden" name="master_price_seasontype_id[]" value="<?php echo $thisSeasonType->id; ?>"/>
                                                        </div><div><p id="sd1"></p></div>
                                                    </td>
                                                    
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </tr>
                                                
                                                <?php
                                                }
                                                ?>
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <h2>ADDITIONAL CHARGES</h2>
                                    <div class="col-md-12 col-padding-no checkbox-container additional-charges">
                                        <div class="amenities-checkbox">
                                            <input id="check1" type="checkbox" value="check1" <?php echo (isset($propertyDetails->clean_charge) && $propertyDetails->clean_charge) ? 'checked' : ''; ?>>
                                            <label for="check1" data-toggle="collapse" data-target="#addCleaning" aria-expanded="false" aria-controls="addCleaning">Cleaning fee</label>
                                        </div>
                                        <div id="addCleaning" class="collapse <?php echo (isset($propertyDetails->clean_charge) && $propertyDetails->clean_charge) ? 'in' : ''; ?>">
                                            <div class="input-group ele-inline">
                                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                <input type="text" name="clean_charge" id="clean_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1" value="<?php echo (isset($propertyDetails->clean_charge) && $propertyDetails->clean_charge) ? $propertyDetails->clean_charge : ''; ?>">
                                            </div>
                                            <!--<div><p id="clean_charge"></p></div>
                                            <p class="ele-inline aft-text">For each guest after</p>
                                            <div class="ele-inline">
                                                <div class="select-container no-margin-top">
                                                    <div class="styled-select styled-select-guest">
                                                        <select class="form-control">
                                                            <option value="1">INR</option>
                                                            <option value="2">RNR</option>
                                                            <option value="3">PNR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="amenities-checkbox">
                                            <input id="check2" type="checkbox" value="check2" <?php echo (isset($propertyDetails->guest_charge) && $propertyDetails->guest_charge) ? 'checked' : ''; ?>>
                                            <label for="check2" data-toggle="collapse" data-target="#addGuest" aria-expanded="false" aria-controls="addGuest">Additional Guest</label>
                                        </div>
                                        <div id="addGuest" class="collapse <?php echo (isset($propertyDetails->guest_charge) && $propertyDetails->guest_charge) ? 'in' : ''; ?>">
                                            <div class="input-group ele-inline">
                                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                <input type="text" name="guest_charge" id="guest_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1" value="<?php echo (isset($propertyDetails->guest_charge) && $propertyDetails->guest_charge) ? $propertyDetails->guest_charge : ''; ?>">
                                            </div>
                                            <p>For each guest after</p>
                                            <div class="styled-select styled-select-short">
                                                <select class="form-control" name="min_night" id="min_night">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
<!--                                            <div><p id="guest_charge"></p></div>
                                            <p class="ele-inline aft-text">For each guest after</p>
                                            <div class="ele-inline">
                                                <div class="select-container no-margin-top">
                                                    <div class="styled-select styled-select-guest">
                                                        <select class="form-control">
                                                            <option value="1">INR</option>
                                                            <option value="2">RNR</option>
                                                            <option value="3">PNR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="clearfix"></div>
                                            <p class="text-desc-chrg">This fee will apply for each additional guest, for each night of the reservation.</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="amenities-checkbox">
                                            <input id="check3" type="checkbox" value="check3" <?php echo (isset($propertyDetails->security_charge) && $propertyDetails->security_charge) ? 'checked' : ''; ?>>
                                            <label for="check3" data-toggle="collapse" data-target="#addSec" aria-expanded="false" aria-controls="addSec">Security Deposit</label>
                                        </div>
                                        <div id="addSec" class="collapse <?php echo (isset($propertyDetails->security_charge) && $propertyDetails->security_charge) ? 'in' : ''; ?>">
                                            <div class="input-group ele-inline">
                                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                <input type="text" name="security_charge" id="security_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1" value="<?php echo (isset($propertyDetails->security_charge) && $propertyDetails->security_charge) ? $propertyDetails->security_charge : ''; ?>">
                                            </div>
<!--                                            <div><p id="security_charge"></p></div>
                                            <p class="ele-inline aft-text">For each guest after</p>
                                            <div class="ele-inline">
                                                <div class="select-container no-margin-top">
                                                    <div class="styled-select styled-select-guest">
                                                        <select class="form-control">
                                                            <option value="1">INR</option>
                                                            <option value="2">RNR</option>
                                                            <option value="3">PNR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    <input type="hidden" name='property_id' value="<?php echo $propertyId; ?>"/>
                                    <input type="hidden" name="pricing_is_submitted" class="is_submitted" id="pricing_is_submitted" value=""/>
                                    <input type="hidden" name="pricing_is_visited" class="is_visited" id="pricing_is_visited" value=""/>
                                    <input class="button-pink btn btn-default pull-left" id="save_pricing" type="submit" value="Save">
                                </form>
                            </div>
                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pricing tab ends -->
                    
                    <!-- amenities tab starts -->                    
                    <div class="tab-pane" id="amenities">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-9 col-padding-no">
                                <form class="form-horizontal" id="amenities_form" name="amenities_form" action="<?php echo base_url(); ?>host/addAmenities" method="post">
                                    <div class="col-md-12" style="padding-left: 0px;">
                                        <div class="errorHandler alert alert-danger" style="display:none;">
                                            <strong>Please select atleast two amenities</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-left: 0px;">
                                        <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(4, $tabs)) ? '' : 'display:none;'; ?>">
                                            <strong>Amenities saved successfully</strong>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-12" style="padding-left: 0px;">
											<div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
										</div>
									</div>
                                    <h2 id="amenities_error">AMENITIES</h2>
                                    <hr/>
                                    
                                    <?php
									$amenitiesList = (isset($propertyDetails->property_amenities) && $propertyDetails->property_amenities) ? ((false !== strpos($propertyDetails->property_amenities, ';')) ? explode(';', $propertyDetails->property_amenities) : array($propertyDetails->property_amenities)) : array();
									?>
                                    
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                <h4 class="panel-title" id="common_amenities_errors_before">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Common
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in amenityCategories" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body col-padding-no">
                                                    <div class="col-md-4 col-xs-12 checkbox-container">
                                                        <div class="amenities-checkbox">
                                                            <?php
                                                            $count = 0;
                                                            
                                                            foreach ($amenities as $key => $thisAmenity):
                                                                if (1 == $thisAmenity->amenities_type):
                                                                    $count++;
                                                            ?>
                                                            <input id="common_amenities_check_<?php echo $key; ?>" name="common_amenities[]" type="checkbox" class="common amenities" value="<?php echo $thisAmenity->amenities_id; ?>" <?php echo in_array($thisAmenity->amenities_id, $amenitiesList) ? 'checked' : ''; ?>>
                                                            <label for="common_amenities_check_<?php echo $key; ?>"><?php echo $thisAmenity->amenities_subtype; ?></label>
                                                            <?php 
                                                                endif;
                                                            endforeach;
                                                            
                                                            if (0 == $count):
                                                            ?>
                                                            No common amenities found
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                <h4 class="panel-title" id="feature_amenities_errors_before">
                                                    <a role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                        features
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse amenityCategories" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body col-padding-no">
                                                    <div class="col-md-4 col-xs-12 checkbox-container">
                                                        <div class="amenities-checkbox">
                                                            <?php
                                                            $count = 0;
                                                            
                                                            foreach ($amenities as $key => $thisAmenity):
                                                                if (2 == $thisAmenity->amenities_type):
                                                                    $count++;
                                                            ?>
                                                            <input id="feature_amenities_check_<?php echo $key; ?>" name="feature_amenities[]" type="checkbox" class="feature amenities" value="<?php echo $thisAmenity->amenities_id; ?>" <?php echo in_array($thisAmenity->amenities_id, $amenitiesList) ? 'checked' : ''; ?>>
                                                            <label for="feature_amenities_check_<?php echo $key; ?>"><?php echo $thisAmenity->amenities_subtype; ?></label>
                                                            <?php 
                                                                endif;
                                                            endforeach;
                                                            
                                                            if (0 == $count):
                                                            ?>
                                                            No featured amenities found
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                <h4 class="panel-title" id="extra_amenities_errors_before">
                                                    <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                                                        extras
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse amenityCategories" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body col-padding-no">
                                                    <div class="col-md-4 col-xs-12 checkbox-container">
                                                        <div class="amenities-checkbox">
                                                            <?php
                                                            $count = 0;
                                                            
                                                            foreach ($amenities as $key => $thisAmenity):
                                                                if (3 == $thisAmenity->amenities_type):
                                                                    $count++;
                                                            ?>
                                                            <input id="extra_amenities_check_<?php echo $key; ?>" name="extra_amenities[]" type="checkbox" class="extra amenities" value="<?php echo $thisAmenity->amenities_id; ?>" <?php echo in_array($thisAmenity->amenities_id, $amenitiesList) ? 'checked' : ''; ?>>
                                                            <label for="extra_amenities_check_<?php echo $key; ?>"><?php echo $thisAmenity->amenities_subtype; ?></label>
                                                            <?php 
                                                                endif;
                                                            endforeach;
                                                            
                                                            if (0 == $count):
                                                            ?>
                                                            No extra amenities found
                                                            <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                <h4 class="panel-title" id="safety_amenities_errors_before">
                                                    <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
                                                        safety
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse amenityCategories" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body col-padding-no">
                                                    <div class="col-md-4 col-xs-12 checkbox-container">
                                                        <div class="amenities-checkbox">
                                                            <?php
                                                            $count = 0;
                                                            
                                                            foreach ($amenities as $key => $thisAmenity):
                                                                if (4 == $thisAmenity->amenities_type):
                                                                    $count++;
                                                            ?>
                                                            <input id="safety_amenities_check_<?php echo $key; ?>" name="safety_amenities[]" type="checkbox" class="safety amenities" value="<?php echo $thisAmenity->amenities_id; ?>" <?php echo in_array($thisAmenity->amenities_id, $amenitiesList) ? 'checked' : ''; ?>>
                                                            <label for="safety_amenities_check_<?php echo $key; ?>"><?php echo $thisAmenity->amenities_subtype; ?></label>
                                                            <?php 
                                                                endif;
                                                            endforeach;
                                                            
                                                            if (0 == $count):
                                                            ?>
                                                            No safety amenities found
                                                            <?php
                                                            endif;
                                                            
                                                            unset($count);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <input type="hidden" name="amenities_is_submitted" class="is_submitted" id="amenities_is_submitted" value=""/>
                                    <input type="hidden" name="amenities_is_visited" class="is_visited" id="amenities_is_visited" value=""/>
                                    <input type="hidden" name='property_id' value="<?php echo $propertyId; ?>"/>
                                    <input class="button-pink btn btn-default pull-left" id="save_amenities" type="submit" value="Save">
                                </form>
                            </div>
                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <!-- amenities tab ends -->
                    
                    <!-- listing tab starts -->                    
                    <div class="tab-pane" id="listing">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-9 col-padding-no">
                                <form class="form-horizontal" id="listing_form" name="listing_form" action="<?php echo base_url()?>host/addListing" method="post">
                                    <div class="col-md-12" style="padding-left:0px;">
                                        <div class="errorHandler alert alert-danger" style="display: none;">
                                            <strong>You have some form errors. Please check below</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-left:0px;">
                                        <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(5, $tabs)) ? '' : 'display:none;'; ?>">
                                            <strong>Listings saved successfully</strong>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-12" style="padding-left: 0px;">
											<div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
										</div>
									</div>
                                    <h2 id="listing_error">LISTING INFORMATION</h2>
                                    <hr/>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>PROPERTY TYPE</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select id="property_type_id" name="listing[property_type_id]" class="form-control">
                                                <?php
                                                foreach ($propertyTypes as $thisPropertyType):
                                                ?>
                                                <option value="<?php echo $thisPropertyType->property_type_id; ?>" <?php echo ((isset($propertyDetails->property_type_id) && $propertyDetails->property_type_id) && $propertyDetails->property_type_id == $thisPropertyType->property_type_id) ? 'selected' : ''; ?>><?php echo $thisPropertyType->property_type; ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>ROOM TYPE</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select id="room_type_id" name="listing[room_type_id]" class="form-control">
                                                <?php
                                                foreach ($roomTypes as $thisroomType):
                                                ?>
                                                <option value="<?php echo $thisroomType->room_type_id; ?>" <?php echo (isset($propertyDetails->room_type_id) && $propertyDetails->room_type_id == $thisroomType->room_type_id) ? 'selected' : ''; ?>><?php echo $thisroomType->roomtype; ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>GUESTS</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select name="listing[guest_allow]"  class="form-control">
                                                <option value="1" <?php echo ((isset($propertyDetails->guest_allow) && $propertyDetails->guest_allow) && 1 == $propertyDetails->guest_allow) ? 'selected' : ''; ?>>1</option>
                                                <option value="2" <?php echo ((isset($propertyDetails->guest_allow) && $propertyDetails->guest_allow) && 2 == $propertyDetails->guest_allow) ? 'selected' : ''; ?>>2</option>
                                                <option value="3" <?php echo ((isset($propertyDetails->guest_allow) && $propertyDetails->guest_allow) && 3 == $propertyDetails->guest_allow) ? 'selected' : ''; ?>>3</option>
                                                <option value="4" <?php echo ((isset($propertyDetails->guest_allow) && $propertyDetails->guest_allow) && 4 == $propertyDetails->guest_allow) ? 'selected' : ''; ?>>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>BEDROOMS</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select name="listing[bedrooms]" class="form-control">
                                                <option value="1" <?php echo ((isset($propertyDetails->bedrooms) && $propertyDetails->bedrooms) && 1 == $propertyDetails->bedrooms) ? 'selected' : ''; ?>>1</option>
                                                <option value="2" <?php echo ((isset($propertyDetails->bedrooms) && $propertyDetails->bedrooms) && 2 == $propertyDetails->bedrooms) ? 'selected' : ''; ?>>2</option>
                                                <option value="3" <?php echo ((isset($propertyDetails->bedrooms) && $propertyDetails->bedrooms) && 3 == $propertyDetails->bedrooms) ? 'selected' : ''; ?>>3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>BEDS</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select name="listing[bed]" class="form-control">
                                                <option value="1" <?php echo ((isset($propertyDetails->bed) && $propertyDetails->bed) && 1 == $propertyDetails->bed) ? 'selected' : ''; ?>>1</option>
                                                <option value="2" <?php echo ((isset($propertyDetails->bed) && $propertyDetails->bed) && 2 == $propertyDetails->bed) ? 'selected' : ''; ?>>2</option>
                                                <option value="3" <?php echo ((isset($propertyDetails->bed) && $propertyDetails->bed) && 3 == $propertyDetails->bed) ? 'selected' : ''; ?>>3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p>BATHROOMS</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select name="listing[bathrooms]" class="form-control">
                                                <option value="1" <?php echo ((isset($propertyDetails->bathrooms) && $propertyDetails->bathrooms) && 1 == $propertyDetails->bathrooms) ? 'selected' : ''; ?>>1</option>
                                                <option value="2" <?php echo ((isset($propertyDetails->bathrooms) && $propertyDetails->bathrooms) && 2 == $propertyDetails->bathrooms) ? 'selected' : ''; ?>>2</option>
                                                <option value="3" <?php echo ((isset($propertyDetails->bathrooms) && $propertyDetails->bathrooms) && 3 == $propertyDetails->bathrooms) ? 'selected' : ''; ?>>3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="select-container">

                                        <div class="col-md-6 col-padding-no">
                                            <p>CANCELLATION POLICY</p>
                                        </div>
                                        <div class="col-md-6 styled-select col-padding-no">
                                            <select id="cancellation_policy_id" name="listing[cancellation_policy_id]" class="form-control">
                                                <?php
                                                foreach ($policies as $thisPolicy):
                                                ?>
                                                <option value="<?php echo $thisPolicy->id; ?>" <?php echo (isset($propertyDetails->cancellation_policy_id) && $propertyDetails->cancellation_policy_id == $thisPolicy->id) ? 'selected' : ''; ?>><?php echo $thisPolicy->policy; ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="select-container" id="tags_container">

                                        <div class="col-md-6 col-padding-no">
                                            <p>TAGS</p>
                                        </div>
<!--                                        <div class="panel-body styled-select col-padding-no" style="width: 250px;">-->
                                            
                                            <?php
                                            $tagList = (isset($propertyDetails->property_tags) && $propertyDetails->property_tags) ? ((false !== strpos($propertyDetails->property_tags, ';')) ? explode(';', $propertyDetails->property_tags) : array($propertyDetails->property_tags)) : array();
                                            ?>
                                            
                                            <select name="tags[]" multiple class="form-control" style="height:100px !important; width:200px;">
                                                
                                                <?php
                                                foreach ($tags as $key => $thisTag):
                                                ?>
                                                <option value="<?php echo $thisTag->id; ?>" <?php echo (in_array($thisTag->id, $tagList)) ? 'selected' : ''; ?>><?php echo $thisTag->tag; ?></option>
                                                <?php
                                                endforeach;
                                                ?>
                                                
                                            </select>
<!--                                        </div>-->
                                    </div>
                                    <hr class="selectcontainer-divider" style="margin-top: 30px;" />
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p style="padding-top: 10px;">CHECK IN TIME</p>
                                        </div>
                                        <div class="col-md-6 styled-input col-padding-no">
                                            <div class="input-group date" id="check_in" style="width:85%;">
                                                <input type="text" name="listing[check_in_time]" class="form-control" value="<?php echo (isset($propertyDetails->check_in_time) && $propertyDetails->check_in_time) ? $propertyDetails->check_in_time : ''; ?>"/>
                                                <span class="input-group-addon">
                                                    <img src="<?php echo base_url(); ?>public/images/checkin.png">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selectcontainer-divider"></div>
                                    <div class="select-container">
                                        <div class="col-md-6 col-padding-no">
                                            <p style="padding-top: 10px;">CHECK OUT TIME</p>
                                        </div>
                                        <div class="col-md-6 styled-input col-padding-no">
                                            <div class="input-group date" id="check_out" style="width:85%;">
                                                <input type="text" name="listing[check_out_time]" class="form-control" value="<?php echo (isset($propertyDetails->check_out_time) && $propertyDetails->check_out_time) ? $propertyDetails->check_out_time : ''; ?>"/>
                                                <span class="input-group-addon">
                                                    <img src="<?php echo base_url(); ?>public/images/checkin.png">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selectcontainer-divider"></div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 col-md-offset-6 col-padding-no">
                                    <input type="hidden" name="listing_is_submitted" class="is_submitted" id="listing_is_submitted" value=""/>
                                    <input type="hidden" name="listing_is_visited" class="is_visited" id="listing_is_visited" value=""/>
                                    <input type="hidden" name='property_id' value="<?php echo $propertyId; ?>"/>
                                    </div>
                                    <input class="button-pink btn btn-default pull-left" id="save_listing" type="submit" value="Save">
                                </form>
                            </div>
                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <!-- listing tab ends -->
                    
                    <!-- location tab starts -->
                    <div class="tab-pane" id="location">
                        <div class="frm-container">
                            <div class="header-row">
                                <p class="header-text">
                                    COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                    <span class="pull-right">
                                        <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                        <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                    </span>
                                </p>
                            </div>
                            <div class="frm-body col-md-9 col-padding-no">
                                <form class="form-horizontal" id="location_form" name="location_form" action="<?php echo base_url(); ?>host/addLocation" method="post">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-left:0px;">
                                            <div class="errorHandler alert alert-danger" style="display:none;">
                                                <strong>You have some form errors. Please check below</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-left:0px;">
                                            <div class="successHandler alert alert-success" style="<?php echo ($tabs && in_array(6, $tabs)) ? '' : 'display:none;'; ?>">
                                                <strong>Location saved successfully</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-md-12" style="padding-left: 0px;">
											<div class="fatalErrorHandler alert alert-danger" style="display:none;"></div>
										</div>
									</div>
                                    <h2 id="location_error">ADDRESS</h2>
                                    <hr/>
                                    <input type="text" id="address_line1" name="address_line1" class="form-control input-lg" placeholder="ADDRESS LINE 1" value="<?php echo (isset($propertyDetails->address_line1) && $propertyDetails->address_line1) ? $propertyDetails->address_line1 : ''; ?>">
                                    <input type="text" id="address_line2" name="address_line2" class="form-control input-lg margin-top-30" placeholder="ADDRESS LINE 2">
                                    <div class="select-container col-md-12 col-padding-no" style="margin-top: 15px;">
                                        <div class="col-md-6 styled-select">
                                            <select name="country" id="country-list" class="demoInputBox form-control" onchange="selectState(this.options[this.selectedIndex].value)" >
                                               <option value="">Select country</option>
                                               <?php
                                               foreach ($countries as $thisCountry):
                                               ?>
                                               <option value="<?php echo $thisCountry->country_id?>" <?php echo ((isset($propertyDetails->country_id) && $propertyDetails->country_id) && $propertyDetails->country_id == $thisCountry->country_id) ? 'selected' : ''; ?>><?php echo $thisCountry->country_name?></option>
                                               <?php
                                               endforeach;
                                               ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 styled-select margin-left-30">
                                            <select name="state" id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)" class="form-control">
                                               <option value="">Select state</option>
                                               <?php
                                               foreach ($states as $thisState):
                                               ?>
                                               <option value="<?php echo $thisState->id?>" <?php echo ((isset($propertyDetails->state_id) && $propertyDetails->state_id) && $propertyDetails->state_id == $thisState->id) ? 'selected' : ''; ?>><?php echo $thisState->state_name?></option>
                                               <?php
                                               endforeach;
                                               ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-left:0px;">
                                        <div class="col-md-6" style="padding-left:0px;" id="no_country_error"></div>
                                        <div class="col-md-6" style="padding-left:0px;" id="no_state_error"></div>
                                    </div>
                                    <div class="select-container col-md-12 col-padding-no" style="margin-top: 0px;">
                                        <div class="col-md-6 styled-select">
                                            <select name="city" id="city_dropdown" class="form-control">
                                                <option value="">Select city</option>
                                                <?php
											   foreach ($cities as $thisCity):
											   ?>
											   <option value="<?php echo $thisCity->id?>" <?php echo ((isset($propertyDetails->city_id) && $propertyDetails->city_id) && $propertyDetails->city_id == $thisCity->id) ? 'selected' : ''; ?>><?php echo $thisCity->city_name?></option>
											   <?php
											   endforeach;
											   ?>
                                            </select>

                                        </div>
                                        <div class="col-md-6 styled-select margin-left-30">

                                             <input id="area" class="form-control input-lg" name="area" type="text" placeholder="Area" value="<?php echo (isset($propertyDetails->area) && $propertyDetails->area) ? filterDbOutput($propertyDetails->area) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding-left:0px;">
                                        <div class="col-md-6" style="padding-left:0px;" id="no_city_error"></div>
                                        <div class="col-md-6" style="padding-left:0px;" id="no_area_error"></div>
                                    </div>
                                    <div class="col-md-6 col-padding-no">
                                        <input type="text" id="zip" name="zip" class="form-control input-lg margin-top-30" style="width: 250px;margin-top: 15px;" placeholder="ZIP CODE" value="<?php echo (isset($propertyDetails->zip) && $propertyDetails->zip) ? filterDbOutput($propertyDetails->zip) : ''; ?>">
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr/>
                                    <input class="button-pink btn btn-default pull-left no-margin-top" id="pin_to_map" onclick="codeAddress()" type="button" value="PIN IT TO MAP">
                            </div>

                            <div class="col-md-3 col-padding-no">
                                <div class="col-padding-no centered-info">
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="map-container">

								<input onclick="deleteMarkers();" type=button value="Delete Markers">
								<div id="map-canvas" style="width:100%;"></div>
                            </div>
                            <input type="hidden" name="latitude" id="lat" value="<?php echo (isset($propertyDetails->latitude) && $propertyDetails->latitude) ? $propertyDetails->latitude : 22.572645; ?>">
                            <input type="hidden" name="longitude" id="long" value="<?php echo (isset($propertyDetails->longitude) && $propertyDetails->longitude) ? $propertyDetails->longitude : 88.363892; ?>">
                            <input id="property_id" class="form-control" name="property_id" value="<?php echo $propertyId; ?>" type="hidden">
                            <input type="hidden" name="location_is_submitted" id="location_is_submitted" class="is_submitted" value=""/>
                            <input type="hidden" name="location_is_visited" id="location_is_visited" class="is_visited" value=""/>
                            <input class="button-pink btn btn-default pull-left no-margin-top" id="save_location" type="submit" value="SAVE">
                             </form>
                        </div>
                    </div>
                    <!-- location tab ends -->
                    
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <!-- <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <a href="javascript:void(0);" id="save_all" class="button-pink btn btn-default no-margin-top">Save All</a>
                </div>
            </div> -->
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- calendar modal starts -->

<div id="event-management" class="modal fade" tabindex="-1" data-width="300" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
        </button>
        <h4 class="modal-title">Modify Price</h4>
    </div>
    <div class="modal-body"></div>
</div>

<!-- calendar modal ends -->

<script>    
var geocoder;
var map;
var marker;
var markers = [];

function initialize() {
    geocoder = new google.maps.Geocoder();
    
    var latlng = new google.maps.LatLng($("#lat").val(), $("#long").val());
    
    var mapOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
    marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true
    });
    
    google.maps.event.addListener(marker, 'drag', function(event) {console.log(event);
        document.getElementById("lat").value = event.latLng.lat();
        document.getElementById("long").value = event.latLng.lng();
    });
}

function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function addMarker(location) {
    marker.setPosition(location);
    
    map.setCenter(marker.getPosition());
    
    markers.push(marker);
    
    document.getElementById("lat").value = location.lat().toFixed(5);
    document.getElementById("long").value = location.lng().toFixed(5);
}

function clearMarkers() {
    setAllMap(null);
    
    document.getElementById("lat").value = '';
    document.getElementById("long").value = '';
}

function deleteMarkers() {
  clearMarkers();
  
  markers = [];
}

function codeAddress() {
    $('#location_form .help-block').remove();
    $('#location_form .alert').hide();
    
    var errorFlag = false;
    
    var address1 = $('#address_line1').val();
    var address2 = $('#address_line2').val();
    var countryName = $('#country-list').find(':selected').text();
    var stateName = $('#state_dropdown').find(':selected').text();
    var cityName = $('#city_dropdown').find(':selected').text();
    var area = $('#area').val();
    var zip = $('#zip').val();
    
    if (! address1) {
        $('#address_line1').after('<span class="help-block">Please enter address line 1</span>');
        errorFlag = true;
    }
    
    if (! $('#country-list').val()) {
        $('#no_country_error').empty().html('<span class="help-block">Please select a country</span>');
        errorFlag = true;
    }
    
    if (! $('#state_dropdown').val()) {
         $('#no_state_error').empty().html('<span class="help-block">Please select a state</span>');
        errorFlag = true;
    }
    
    if (! $('#city_dropdown').val()) {
        $('#no_city_error').empty().html('<span class="help-block">Please select a city</span>');
        errorFlag = true;
    }
    
    if (! area) {
        $('#no_area_error').empty().html('<span class="help-block">Please enter area</span>');
        errorFlag = true;
    }
    
    if (! zip) {
        $('#zip').after('<span class="help-block">Please enter zip</span>');
        errorFlag = true;
    }
    
    if (! errorFlag) {
        var mockLocation = (! address1) ? '' : $.trim(address1);
        mockLocation += (! address2) ? '' : ((! location) ? $.trim(address2) : (',' + $.trim(address2)));
        mockLocation += (! countryName) ? '' : ((! location) ? $.trim(countryName) : (',' + $.trim(countryName)));
        mockLocation += (! stateName) ? '' : ((! location) ? $.trim(stateName) : (',' + $.trim(stateName)));
        mockLocation += (! cityName) ? '' : ((! location) ? $.trim(cityName) : (',' + $.trim(cityName)));
        mockLocation += (! area) ? '' : ((! location) ? $.trim(area) : (',' + $.trim(area)));
        mockLocation += (! zip) ? '' : ((! location) ? $.trim(zip) : (',' + $.trim(zip)));
        var location = $.trim(zip);
        
        geocoder.geocode({address: location, componentRestrictions: {country: 'IN', postalCode: zip}}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                addMarker(results[0].geometry.location);
            } else {
                $('#pin_to_map').after('<span class="help-block">Google geocode could not find your location at : ' + mockLocation + '</span>');
            }
        });
    } else {
        $('#location_form .errorHandler').show();
        $('html,body').animate({
            scrollTop: $('body').offset().top},
        'slow');
        $("a[href='#location'] .fa-check").css("color", "#e91e63");
    }
}

google.maps.event.addDomListener(window, 'load', initialize);

$('#location_tab').on('shown.bs.tab', function (e) {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(marker.getPosition());
});
</script>

<script>
	$("#add_photo").click(function(e) {
		var videoId = $("#video_id").val();
		var propertyId = $("#property_id").val();
		var errorFlag = 0;
		var addedFileCount = $(".template-upload").length;
		var erroneousFileAddCount = $(".error").length;
		var uploadableFileCount = (addedFileCount - erroneousFileAddCount);
        
        $('#fileupload .alert').hide();
        
        if ((0 === $(".template-upload").length) || ((0 < $(".template-upload").length) && ($(".template-upload").length === $(".error").length))) {
            if ((0 === $(".template-download").length) || ((0 < $(".template-download").length) && ($(".template-download").length === $(".upload_error").length))) {
                $("#no_images_error").hide().show();
                $("#add_photo").focus();

                errorFlag = 1;
            } else {
                $("#add_photo").focus();

                errorFlag = 2;
            }
		} else {
			$("#no_images_error").hide();
		}

		if (24 < uploadableFileCount) {			
			$("#max_file_count_error").hide().show();
			$("#add_photo").focus();
			
			errorFlag = 1;
		} else {
			$("#max_file_count_error").hide();
		}

		if (! videoId) {
			$("#no_video_error").hide().show();
			$("#video_id").focus();
			
			errorFlag = 1;
		} else {
			$("#no_video_error").hide();
		}

		if (0 === errorFlag) {
			$.ajax({
				url: base_url + "host/checkPhotoUploadParams",
				method: "post",
				dataType: "json",
				data: {
					'video_id': videoId,
					'property_id': propertyId,
				},
				success: function(response) {
					if ("200" == response.status) {
						$("#wrong_video_id_error").empty().hide();
						$("#null_property_id_error").empty().hide();
						$("#fileupload .errorHandler").hide();
                        $('#video_preview').empty().html(response.embedIframe);
                        $('#overlay').show();
						$(".start").trigger("click");
					} else {
						if ("wrong_video_id_error" == response.type) {
							$("#wrong_video_id_error").html(response.message).show();

							$("#video_id").focus();
						} else if ("null_property_id_error" == response.type) {
							$("#null_property_id_error").html(response.message).show();
						} else {
							//
						}

						$("a[href='#photos'] .fa-check").css("color", "#e91e63");

						$("#fileupload .errorHandler").show();
						$('html,body').animate({
						   scrollTop: $('body').offset().top},
						'slow');
					}
				}
			});
		} else if (1 === errorFlag) {
			$("a[href='#photos'] .fa-check").css("color", "#e91e63");			
			$("#fileupload .errorHandlerAlt").show();
			$('html,body').animate({
			   scrollTop: $('body').offset().top},
			'slow');
		} else if (2 === errorFlag) {			
			$("#fileupload .warningHandlerAlt").show();
			$('html,body').animate({
			   scrollTop: $('body').offset().top},
			'slow');
		} else {
            //
        }
	});
    
    $(document).ready(function() {
        var checkedAmenitiesCount = 0;
        
        $('.amenityCategories').each(function() {
            var checkedAmenities = $(this).find('.panel-body > .checkbox-container .amenities:checked').length;
            if(0 < checkedAmenities) {
                checkedAmenitiesCount += checkedAmenities;
                $(this).addClass('in');
            } else {
                $(this).removeClass('in');
            }
        });
        
        if (0 === checkedAmenitiesCount) {
            $('#collapseOne').addClass('in');
        }
        
        $('#set_custom_price_button').click(function(e) {
            e.preventDefault();
            
            $('#postApprovalCalendar_tab').trigger('click');
        });
    });
    
    $(document).ready(function() {
        var checkedAmenitiesCount = 0;
        
        $('.amenityCategories').each(function() {
            var checkedAmenities = $(this).find('.panel-body > .checkbox-container .amenities:checked').length;
            if(0 < checkedAmenities) {
                checkedAmenitiesCount += checkedAmenities;
                $(this).addClass('in');
            } else {
                $(this).removeClass('in');
            }
        });
        
        if (0 === checkedAmenitiesCount) {
            $('#collapseOne').addClass('in');
        }
    });
</script>

<?php
// o/p the footer
echo $footer;
?>
