<?php
$title = 'Listing | Information';
include('subheader.php');
?>
        <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
						<?php 	
								//left bar
								$text3 = $text2 = $text4 = $text6 = $text1 = "dum-text";
								$text5 = "active-menu";
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
                            <form class="form-horizontal" method="POST" action="<?php base_url()?>host/property_listing_info">
                                <h2>OVERVIEW</h2>
                                <h3>A title and summary displayed on your public listing page</h3>
                                <hr/>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>PROPERTY TYPE</p>
                                    </div>
                                    <span class="col-md-6 styled-select">
                                     <?php 
                                            $baseUrl = 'http://104.215.198.240/rentnroam/host/extractPropertyType';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                       echo  '<select name="property_type_id" class="form-control">';    
                                       foreach($jsonDataObject as $common)
                                       {
                                           echo  '<option value='.$common->property_type_id.'>'.$common->property_type.'</option>';                                            
                                        
                                       } 
                                       echo '</select>';                                      
                                       
                                      ?>   
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>ROOM TYPE</p>
                                    </div>
                                    <span class="col-md-6 styled-select">
                                        <?php 
                                            $baseUrl = 'http://104.215.198.240/rentnroam/host/extractRoomType';                    
                                            $jsonData = file_get_contents($baseUrl); 
                                            $jsonDataObject = json_decode($jsonData);
                                            
                                            echo  '<select name="room_type_id" class="form-control">';    
                                            foreach($jsonDataObject as $common)
                                            {
                                                echo  '<option value='.$common->room_type_id.'>'.$common->roomtype.'</option>';                                            
                                        
                                            } 
                                            echo '</select>';                                      
                                       
                                      ?>  
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>GUESTS</p>
                                    </div>
                                    <span class="col-md-6 styled-select">
                                        <select name="guest" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>BEDROOMS</p>
                                    </div>
                                    <span class="col-md-6 styled-select">
                                        <select name="bedrooms" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>BEDS</p>
                                    </div>
                                    <span class="col-md-6 styled-select">
                                        <select name="beds" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>BATHROOMS</p>
                                    </div>
                                    <span  class="col-md-6 styled-select">
                                        <select name="bathrooms" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </span>
                                </div>
                                <hr class="selectcontainer-divider"/>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>CHECK IN TIME</p>
                                    </div>
                                    <span class="col-md-6 styled-input col-padding-no">
                                        <div class="input-group">
                                            <input type="text" name="check_in" class="form-control" placeholder="12:00">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </span>
                                </div>
                                <div class="selectcontainer-divider"></div>
                                <div class="select-container">
                                    <div class="col-md-6">
                                        <p>CHECK OUT TIME</p>
                                    </div>
                                    <span class="col-md-6 styled-input col-padding-no">
                                        <div class="input-group">
                                            <input type="text" name="check_out" class="form-control" placeholder="12:00">
											<input type="hidden" name="user_id" value="2" class="form-control" >
											<input type="hidden" name="property_id" value="6" class="form-control" >
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">
                                                    <i class="fa fa-clock-o"></i>
                                                </button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 col-md-offset-6 col-padding-no">
                                    <input class="button-pink btn btn-default pull-left" type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include_once('footer.php');  ?>