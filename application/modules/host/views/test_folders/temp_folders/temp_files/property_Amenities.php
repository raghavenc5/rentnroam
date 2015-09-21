<?php
$title = 'Listing | Amenities';
include('subheader.php');
?> 
        <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
						<?php 	
								//left bar
								$text3 = $text2 = $text5 = $text6 = $text1 = "dum-text";
								$text4 = "active-menu";
								include('left.php');
						?>
                    <div class="col-md-10 frm-container">
                        <div class="header-row">
                            <p class="header-text">
                                COMPLETE <strong>2 STEPS</strong> TO VISIT YOUR SPACE
                                <span class="pull-right">
                                    <img src="<?php echo base_url()?>public/images/home.png" alt=" help">
                                    |
                                    <img src="<?php echo base_url()?>public/images/home.png" alt=" help">
                                </span>
                            </p>
                        </div>
                        <div class="frm-body col-md-9">
                            <form class="form-horizontal" method="post" action="<?php base_url()?>host/property_amenities">
                                <h2>AMENITIES</h2>
                                <h3>Sed lorem ipsum dollar sit amet.Sed lorem ipsum dollar sit amet</h3>
                                <hr/>
                                <p class="frm-label">
                                    COMMON
                                </p>
                                <?php 
                                     // Base URL for the service
                                    $baseUrl = 'http://104.215.198.240/rentnroam/host/extractAmenities';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    echo '<div class="col-md-4 col-xs-12 checkbox-container">';
                                    echo '<div class="amenities-checkbox">';
                                    $count =0;
                                    foreach($jsonDataObject->common as $common)
                                    {
                                        echo '<input id="common_check'.$count.'" name="amenities[]"  type="checkbox" value="'.$common->amenities_id.'">
                                        <label for="common_check'.$count.'">'.$common->amenities_subtype.'</label>'.PHP_EOL;
                                        //echo "\r\n";
                                        $count++;
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                ?>
                                
                                <input name="property_id"  type="hidden" value="6"> 
                                
                                <div class="clearfix"></div>
                                <hr/>
                                <p class="frm-label">
                                    EXTRAS
                                </p>
                                <?php 
                                     // Base URL for the service
                                    $baseUrl = 'http://104.215.198.240/rentnroam/host/extractAmenities';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    echo '<div class="col-md-4 col-xs-12 checkbox-container">';
                                    echo '<div class="amenities-checkbox">';
                                    $count =0;
                                    foreach($jsonDataObject->extra as $common)
                                    {
                                        echo '<input id="extra_check'.$count.'" name="amenities[]"  type="checkbox" value="'.$common->amenities_id.'">
                                        <label for="extra_check'.$count.'">'.$common->amenities_subtype.'</label>'.PHP_EOL;
                                        //echo "\r\n";
                                        $count++;
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                ?>
                                <div class="clearfix"></div>
                                <hr/>
                                <p class="frm-label">
                                    FEATURES
                                </p>
                                 <?php 
                                     // Base URL for the service
                                    $baseUrl = 'http://104.215.198.240/rentnroam/host/extractAmenities';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    echo '<div class="col-md-4 col-xs-12 checkbox-container">';
                                    echo '<div class="amenities-checkbox">';
                                    $count =0;
                                    foreach($jsonDataObject->feature as $common)
                                    {
                                        echo '<input id="feature_check'.$count.'" name="amenities[]"  type="checkbox" value="'.$common->amenities_id.'">
                                        <label for="feature_check'.$count.'">'.$common->amenities_subtype.'</label>'.PHP_EOL;
                                        //echo "\r\n";
                                        $count++;
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                ?>
                                <div class="clearfix"></div>
                                <hr/>
                                <p class="frm-label">
                                    SAFETY
                                </p>
                                 <?php 
                                     // Base URL for the service
                                    $baseUrl = 'http://104.215.198.240/rentnroam/host/extractAmenities';                    
                                    $jsonData = file_get_contents($baseUrl); 
                                    $jsonDataObject = json_decode($jsonData);
                                    echo '<div class="col-md-4 col-xs-12 checkbox-container">';
                                    echo '<div class="amenities-checkbox">';
                                    $count =0;
                                    foreach($jsonDataObject->safety as $common)
                                    {
                                        echo '<input id="safety_check'.$count.'" name="amenities[]" type="checkbox" value="'.$common->amenities_id.'">
                                        <label for="safety_check'.$count.'">'.$common->amenities_subtype.'</label>'.PHP_EOL;
                                        //echo "\r\n";
                                        $count++;
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                ?>
                                <div class="clearfix"></div>
                                <hr/>
                                <input class="button-pink btn btn-default pull-left" type="submit" value="Save">
                            </form>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>



<?php include_once('footer.php');  ?>