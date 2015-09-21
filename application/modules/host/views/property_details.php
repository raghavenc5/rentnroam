<?php
// o/p the header
echo $header;
?>

<div class="container" style="padding-top: 180px;">
    <div class="row">
		<div class="col-md-12">
			
            <?php
            if ($siblings) {
                foreach ($siblings as $key => $thisSibling) {
                    $disabled = ($propertyDetails->property_id == $thisSibling) ? 'disabled' : '';
            ?>
            
            <a class="btn btn-primary" href='<?php echo site_url("/host/propertydetails/$thisSibling/?referer=" . base64_encode($referer)); ?>' <?php echo $disabled; ?> <?php echo (0 == $key) ? 'style="margin-left:16px"' : ''; ?>>Room <?php echo ($key + 1); ?></a>
            
            <?php
                }
            }
            ?>
            
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
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Property Overview
                        </a>
                    </li>
                    <li>
                        <a href="#photos" data-toggle="tab" id="photos_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Property Photo
                        </a>
                    </li>
                    
                    <?php
                    if ('Active' == $userData['status'] && 'Active' == $propertyDetails->status) {
                    ?>
                    <li>
                        <a href="#post_approval_calendar" data-toggle="tab" id="postApprovalCalendar_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Calendar
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    
                    <li>
                        <a href="#pricing" data-toggle="tab" id="pricing_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Pricing
                        </a>
                    </li>
                    <li>
                        <a href="#amenities" data-toggle="tab" id="amenities_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Amenities
                        </a>
                    </li>
                    <li>
                        <a href="#listing" data-toggle="tab" id="listing_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Listing
                        </a>
                    </li>
                    <li>
                        <a href="#location" data-toggle="tab" id="location_tab">
                            <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                            Location
                        </a>
                    </li>
                    <li id="saveTab">
                        <a href="<?php echo $referer; ?>" class="button-pink btn btn-default no-margin-top">Back</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 bk-clr-f8c015 col-padding-no"> <!-- Tab panes -->
                <div class="tab-content">
					
                    <!-- overview tab starts -->
                    <div class="tab-pane frm-container active" id="overview">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>OVERVIEW</h2>
                            <h3>A title and summary displayed on your public listing page</h3>
							<table class="table borderless">
								<tbody>
									<tr>
										<th scope="row" class="pull-left">Title</th>
										<td><?php echo $propertyDetails->property_title ? filterDbOutput($propertyDetails->property_title) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Description</th>
										<td><?php echo $propertyDetails->description ? filterDbOutput($propertyDetails->description) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Neighbourhood Highlights</th>
										<td><?php echo $propertyDetails->neighbourhood_highlight ? filterDbOutput($propertyDetails->neighbourhood_highlight) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">House Rules</th>
										<td><?php echo $propertyDetails->house_rule ? filterDbOutput($propertyDetails->house_rule) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Minimun Night Stay</th>
										<td><?php echo $propertyDetails->min_night_stay ? $propertyDetails->min_night_stay : 'Not Provided'; ?></td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- overview tab ends -->

                    <!-- photo tab starts -->
                    <div class="tab-pane frm-container" id="photos">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>Property Photos And Video</h2>
                            <h3>Photos</h3>
                            
                            <?php
                            $propertyImages = array();
                            
                            if ($propertyDetails->property_images) {
								$propertyImages = (false !== strpos($propertyDetails->property_images, ';')) ? explode(';', $propertyDetails->property_images) : array($propertyDetails->property_images);
							}

                            if (! $propertyImages) {
							?>
							<table class="table borderless">
								<tbody>
									<tr><td>No photos have been added yet</td></tr>
								</tbody>
							</table>
							<?php
							} else {
							?>
							<ul class="files" style="padding-left:0px;">
								<?php
								foreach ($propertyImages as $key => $thisPropertyImage) {
									$thisPropertyImageParams = explode(',', $thisPropertyImage);
								?>
								<li style="list-style:none;" class="col-md-4 photo-container col-padding-no"><div><img src="<?php echo base_url() . 'public/uploads/property_image/' . filterDbOutput($thisPropertyImageParams[0]); ?>"/><textarea class="form-control photo-desc" rows="3" disabled><?php echo $thisPropertyImageParams[2] ? filterDbOutput($thisPropertyImageParams[2]) : 'Not Provided'; ?></textarea></div></li>
								<?php
								}
								?>
							</ul>
							<?php
							}
                            ?>

                            <div class="clearfix"></div>
							<h3>Video</h3>

							<?php
							if (! $propertyDetails->property_video) {
							?>
							<table class="table borderless">
								<tbody>
									<tr><td>No video has been added yet</td></tr>
								</tbody>
							</table>
							<?php
							} else {
							?>

							<div style="width:100%">
								<iframe width="560" height="315" src='https://www.youtube.com/embed/<?php echo filterDbOutput($propertyDetails->property_video); ?>' frameborder="0" allowfullscreen></iframe>
                            </div>
							
							<?php
							}
							?>
							
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- photo tab ends -->
                    
                    <!-- post approval calendar tab starts -->
                    <div class="tab-pane frm-container" id="post_approval_calendar">
                        <div class="header-row">
                            <p class="header-text">
                                COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                <span class="pull-right">
                                    <img src="<?php echo base_url()?>public/images/view.png" alt="help">
                                    <img src="<?php echo base_url()?>public/images/tips.png" alt="help">
                                </span>
                            </p>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- start: FULL CALENDAR PANEL -->
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-3 pull-left">
                                                
                                                <?php
                                                $currentYear = date('Y');
                                                $currentMonth = date('m');
                                                $months = array('01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
                                                ?>
                                                
                                                <select name="date_selector" id="date_selector" class="form-control">
                                                    
                                                    <?php
                                                    foreach ($months as $key => $thisMonth) {
                                                        $dateString = "$key/01/$currentYear";
                                                        $dateText = $thisMonth . ' ' . $currentYear;
                                                        $selected = ($key == $currentMonth) ? 'selected' : '';
                                                    ?>
                                                    
                                                    <option value="<?php echo $dateString; ?>" <?php echo $selected; ?>><?php echo $dateText; ?></option>
                                                    
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6">
                                                <a herf="javscript:void(0);" id="settings_gear" class="pull-right"><span class="glyphicon glyphicon-cog"></span> SETTINGS</a>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:50px;">
                                            <div class="col-sm-12">
                                                <div id='calendar'></div>
                                                <input type="hidden" name='property_id' id="post_approval_calendar_property_id" value="<?php echo $propertyDetails->property_id; ?>"/>
                                                <input type="hidden" name="postApprovalCalendar_is_visited" class="is_visited" id="postApprovalCalendar_is_visited" value="1"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><span style="border:1px solid black; background-color:#E5F09D; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;RESERVATIONS</p>
                                                <p><span style="border:1px solid black; background-color:#fff; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;AVAILABLE</p>
                                                <p><span style="border:1px solid black; background-color:#D3DCE3; width:50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;BLOCKED</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="pull-right">
                                                    <a href="javascript:void(0);">View calendar sync instructions</a>
                                                    <br/>
                                                    Calendar last updated today
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: FULL CALENDAR PANEL -->
                            </div>
                        </div>
                        
                        
<!--                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>-->
                    </div>
                    <!-- post approval calendar tab ends -->

                    <!-- pricing tab starts -->
                    <div class="tab-pane frm-container" id="pricing">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>Pricing</h2>
                            <h3>The base price and default currency for your listing.</h3>
							
							<?php
                                $propertyPricesRelation = (isset($propertyDetails->property_prices_relation) && $propertyDetails->property_prices_relation) ? explode(';', $propertyDetails->property_prices_relation) : array();
                                $propertyPrices = (isset($propertyDetails->property_prices) && $propertyDetails->property_prices) ? explode(';', $propertyDetails->property_prices) : array();
                            ?>
                            
                            <table class="table borderless">
                                <thead>
                                    <tr>
                                        <th></th>

                                        <?php
                                        foreach ($seasonTypes as $key1 => $thisSeasonType) {
                                            if (2 < $thisSeasonType->id && ('Inactive' == $userData['status'] || 'Inactive' == $propertyDetails->status)) {
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
                                            $thisPrice = 0.00;

                                            $needle = "$thisPeriodType->id,$thisSeasonType->id";
                                            if (in_array($needle, $propertyPricesRelation)) {
                                                $priceKey = array_search($needle, $propertyPricesRelation);
                                                $thisPrice = $propertyPrices[$priceKey];
                                            }

                                            if (2 < $thisSeasonType->id && ('Inactive' == $userData['status'] || 'Inactive' == $propertyDetails->status)) {
                                                continue;
                                            }
                                        ?>

                                        <td>
                                            <i class="fa fa-inr"></i> <?php echo number_format($thisPrice, 2); ?>
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
							<div class="clearfix"></div>
							<hr />
							<h2>ADDITIONAL CHARGES</h2>
							<table class="table borderless">
								<tbody>
									<tr>
										<th scope="row" class="pull-left">Cleaning Fee</th>
										<td><i class="fa fa-inr"></i> <?php echo $propertyDetails->clean_charge ? number_format($propertyDetails->clean_charge, 2) : '0.00'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Additional Guest</th>
										<td><i class="fa fa-inr"></i> <?php echo $propertyDetails->guest_charge ? number_format($propertyDetails->guest_charge, 2) : '0.00'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Security Deposit</th>
										<td><i class="fa fa-inr"></i> <?php echo $propertyDetails->security_charge ? number_format($propertyDetails->security_charge, 2) : '0.00'; ?></td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- pricing tab ends -->

                    <!-- amenities tab starts -->
                    <div class="tab-pane frm-container" id="amenities">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>AMENITIES</h2>

							<?php
							$amenities = $propertyDetails->property_amenities ? ((false !== strpos($propertyDetails->property_amenities, ';')) ? explode(';', $propertyDetails->property_amenities) : array($propertyDetails->property_amenities)) : array();
							?>
                            
							<table class="table borderless">
								<tbody>

									<?php
									if (! $amenities) {
									?>

									<tr>
										<th scope="row" class="pull-left">Common</th>
										<td>Not Provided</td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">FEATURE</th>
										<td>Not Provided</td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">EXTRA</th>
										<td>Not Provided</td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">SAFETY</th>
										<td>Not Provided</td>
									</tr>
									
									<?php
									} else{
										foreach ($amenities as $key => $value) {
											$amenityParts = explode(':', $value);
									?>

									<tr>
										<th scope="row" class="pull-left"><?php echo $amenityParts[0]; ?></th>
										<td><?php echo $amenityParts[1]; ?></td>
									</tr>
									
									<?php
										}
									}
									?>
								</tbody>
							</table>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- amenities tab ends -->

                    <!-- listing tab starts -->
                    <div class="tab-pane frm-container" id="listing">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>Listing Information</h2>
							<table class="table borderless">
								<tbody>
									<tr>
										<th scope="row" class="pull-left">Property Type</th>
										<td><?php echo $propertyDetails->property_type ? filterDbOutput($propertyDetails->property_type) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Room Type</th>
										<td><?php echo $propertyDetails->roomtype ? filterDbOutput($propertyDetails->roomtype) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Guests</th>
										<td><?php echo $propertyDetails->guest_allow ? filterDbOutput($propertyDetails->guest_allow) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Bedrooms</th>
										<td><?php echo $propertyDetails->bedrooms ? filterDbOutput($propertyDetails->bedrooms) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Beds</th>
										<td><?php echo $propertyDetails->bed ? filterDbOutput($propertyDetails->bed) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Bathrooms</th>
										<td><?php echo $propertyDetails->bathrooms ? filterDbOutput($propertyDetails->bathrooms) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Cancellation Policy</th>
										<td><?php echo $propertyDetails->policy ? filterDbOutput($propertyDetails->policy) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Tags</th>
										<td><?php echo $propertyDetails->property_tags ? filterDbOutput($propertyDetails->property_tags) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Check In</th>
										<td><?php echo $propertyDetails->check_in_time ? filterDbOutput($propertyDetails->check_in_time) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Check Out</th>
										<td><?php echo $propertyDetails->check_out_time ? filterDbOutput($propertyDetails->check_out_time) : 'Not Provided'; ?></td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- listing tab ends -->

                    <!-- location tab starts -->
                    <div class="tab-pane frm-container" id="location">
                        <div class="frm-body col-md-9 col-padding-no">
                            <h2>Address</h2>
							<table class="table borderless">
								<tbody>
									<tr>
										<th scope="row" class="pull-left">Address Line 1</th>
										<td><?php echo $propertyDetails->address_line1 ? filterDbOutput($propertyDetails->address_line1) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Country</th>
										<td><?php echo $propertyDetails->country_name ? filterDbOutput($propertyDetails->country_name) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">State</th>
										<td><?php echo $propertyDetails->state_name ? filterDbOutput($propertyDetails->state_name) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">City</th>
										<td><?php echo $propertyDetails->city_name ? filterDbOutput($propertyDetails->city_name) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Area</th>
										<td><?php echo $propertyDetails->area ? filterDbOutput($propertyDetails->area) : 'Not Provided'; ?></td>
									</tr>
									<tr>
										<th scope="row" class="pull-left">Zip</th>
										<td><?php echo $propertyDetails->zip ? filterDbOutput($propertyDetails->zip) : 'Not Provided'; ?></td>
									</tr>
								</tbody>
							</table>
							<div class="clearfix"></div>
							<div id="map-canvas" style="width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-padding-no">
                            <div class="col-padding-no centered-info">
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                    <!-- location tab ends -->
                                       
                </div>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <a href="<?php echo $referer; ?>" class="button-pink btn btn-default no-margin-top">Back</a>
                </div>
            </div>
            <div class="clearfix"></div>     
        </div>
    </div>
</div>

<script>
var geocoder;
var map;
var marker;
var lat = "<?php echo $propertyDetails->latitude ? $propertyDetails->latitude : 22.572645; ?>";
var lng = "<?php echo $propertyDetails->longitude ? $propertyDetails->longitude : 88.363892; ?>";



function initialize() {
  var myLatlng = new google.maps.LatLng(lat,lng);
  var mapOptions = {
    zoom: 15,
    center: myLatlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  marker = new google.maps.Marker({
      position: myLatlng,
      map: map
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

$('#location_tab').on('shown.bs.tab', function (e) {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(marker.getPosition());
});
</script>

<?php
// o/p the footer
echo $footer;
?>
