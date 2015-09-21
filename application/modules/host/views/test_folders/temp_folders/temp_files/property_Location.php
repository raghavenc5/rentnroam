<?php 
$title = "Property Location";
include('subheader.php');

?>
      <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
						<?php 		//left bar
								$text3 = $text2 = $text4 = $text5 = $text1 = "dum-text";
								$text6 = "active-menu";
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
                            <form class="form-horizontal" method="POST" action="<?php echo base_url()?>host/property_address">
                                <h2>ADDRESS</h2>
                                <h3>A title and summary displayed on your public listing page</h3>
                                <hr/>
                                <input type="text" name="address_line1" class="form-control input-lg" placeholder="ADDRESS LINE 1">
                                <input type="text" name="address_line2" class="form-control input-lg margin-top-30" placeholder="ADDRESS LINE 2">
                                <div class="select-container col-md-12 col-padding-no">
                                    <div class="col-md-6 styled-select">
                                      <?php  $baseUrl = 'http://104.215.198.240/rentnroam/host/ExtractCountry';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                            
                                            echo  '<select name="country" class="form-control">';    
                                            foreach($jsonDataObject as $common)
                                            {
                                                echo  '<option value='.$common->country_id.'>'.$common->country_name.'</option>';                                                                                  
                                            } 
                                            echo '</select>'; 
											?>
                                    </div>
                                    <div class="col-md-6 styled-select margin-left-30">
                                        <?php  $baseUrl = 'http://104.215.198.240/rentnroam/host/ExtractState';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                            
                                            echo  '<select name="state" class="form-control">';    
                                            foreach($jsonDataObject as $common)
                                            {
                                                echo  '<option value='.$common->state_id.'>'.$common->state_name.'</option>';                                                                                  
                                            } 
                                            echo '</select>'; 
											?>
                                    </div>
                                </div>
                                <div class="select-container col-md-12 col-padding-no">
                                    <div class="col-md-6 styled-select">
                                       <?php 
											 $baseUrl = 'http://104.215.198.240/rentnroam/host/extractMasterCity';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                            
                                            echo  '<select name="city" class="form-control">';    
                                            foreach($jsonDataObject as $common)
                                            {
                                                echo  '<option value='.$common->city_id.'>'.$common->city_name.'</option>';                                            
                                        
                                            } 
                                            echo '</select>'; 
									   ?>
                                    </div>
                                    <div class="col-md-6 styled-select margin-left-30">
                                       <input type="text" name="area" class="form-control input-lg" placeholder="AREA">
                                    </div>
                                </div>
                                <div class="col-md-6 col-padding-no">
                                    <input type="text" name="zip" class="form-control input-lg margin-top-30" placeholder="ZIP CODE">
                                </div>
								  <input type="hidden" name="user_id" value="2" class="form-control input-lg margin-top-30" placeholder="ZIP CODE">
								    <input type="hidden" name="property_id" class="form-control input-lg margin-top-30" placeholder="ZIP CODE">
                                <div class="clearfix"></div>
                                <hr/>
                                <input class="button-pink btn btn-default pull-left no-margin-top" type="submit" value="PIN IT TO MAP">
                            </form>
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="clearfix"></div>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1889.0463838040423!2d73.4085417!3d18.7493929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be8010e72f046e7%3A0xb297152aff62735a!2sLonavala!5e0!3m2!1sen!2sin!4v1435728774026" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:300px;width:100%;"><div id="gmap_canvas" style="height:300px;width:100%;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://wptiger.com" id="get-map-data">http://wptiger.com/</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(40.805478,-73.96522499999998),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(40.805478, -73.96522499999998)});infowindow = new google.maps.InfoWindow({content:"<b>The Breslin</b><br/>2880 Broadway<br/> New York" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include_once('footer.php');  ?>