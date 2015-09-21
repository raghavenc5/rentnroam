<?php $this->load->view("subheader");?>
        <?php /* get property id from session */
                $base_url = base_url();
                                        $propId='';
                                        
                                            if ($this->session->flashdata('property_id')){ //change!
                                                //echo "<div class='message'>";
                                                $data11 = array();
                                                $data11[] =  $this->session->flashdata('property_id');
                                                //print_r($data11);
                                                foreach ($data11 as $data)
                                                {
                                                 $propId = $data['property_ID'];
                                                                                                                                                 
                                                }
                                                
                                                                                         
                                            }
                                                //echo test for showing property id
                                                if($propId)
                                                {
                                                    echo "Your property ID: ".$propId;
                                                }
                                            ?>
        <div class="container" style="padding-top: 180px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2"> <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active">
                                <a href="#Overview" data-toggle="tab" id="overViewTab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    <!-- Property --> Overview
                                </a>
                            </li>
                            <li>
                                <a href="#Photo" data-toggle="tab" id="PhotoTab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Property Photo
                                </a>
                            </li>
                            <li>
                                <a href="#Pricing" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Pricing
                                </a>
                            </li>
                            <!--<li>
                               <a href="#Calendar" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Calendar
                                </a>
                            </li>-->
                            <li>
                                <a href="#Amenities" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Amenities
                                </a>
                            </li>
                            <li>
                                <a href="#Listing" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Listing
                                </a>
                            </li>
                            <li>
                                <a href="#Location" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Location
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-10 bk-clr-f8c015 col-padding-no"><!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane frm-container active" id="Overview">
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
                                    <form class="form-horizontal" id="formOverview" novalidate="novalidate">
                                        <h2>OVERVIEW</h2>
                                        <h3>A title and summary displayed on your public listing page</h3>
                                        <p class="frm-label">
                                            TITLE
                                        </p>
                                        <input type="text" name="title"  class="form-control input-lg"  id="title" >
                                        <p class="frm-label">
                                            description
                                        </p>
                                         <textarea class="form-control input-lg" type="text"  name='description' id="description" rows="5">  </textarea>
                                        <p class="frm-label">
                                            NEIGHBERHOOD HIGHLIGHTS
                                        </p>
                                        <textarea class="form-control input-lg" name='neighbourhood' id="neighbourhood" rows="5"></textarea>
                                        <hr/>
                                        <p class="frm-label">
                                            HOUSE RULES <span>(IF ANY)</span>
                                        </p>
                                         <textarea class="form-control input-lg" name='house_rules' id="house_rules" rows="5"></textarea>
                                         <input type="hidden" name='user_id' value="2" >
                                        <input type="hidden" name='property_id' value="<?php echo $propId;?>" >
                                        <hr/>
                                        <div class="select-container">
                                            <p class="col-md-6">Minimum night stay</p>
                                            <div class="col-md-6 styled-select styled-select-short">
                                                <select class="form-control" name="min_night" id="min_night">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                         <input type="submit" class="button-pink btn btn-default pull-left" name='submit' id="saveOverview" value="submit">
                                    </form>
                                </div>
                                <div class="col-md-3 col-padding-no">
                                    <div class="col-padding-no centered-info">
                                        <div class="line"></div>
                                   <!--     <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                        <div class="col-md-12">
                                            <p>
                                                Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                ipsum quia dolor sit amet, consectetur, adipisci velit
                                            </p>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Photo" >
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
                                        <form id="myForm" action="<?php base_url()?>host/uploadImages" method="post"  enctype="multipart/form-data">
                                            <h2>ADD A PHOTO OR TWO!</h2>
                                            <h3>Upload min 1 and max 24. Max 5 MB in size. No special characters in filename please</h3>
                                            <!-- <button type="submit" class="button-pink button-pink-margin btn btn-default pull-left">
                                                <i class="fa fa-plus-circle"></i>
                                                &nbsp;&nbsp;&nbsp;ADD A PHOTO
                                            </button> -->
                                            <div class="fileUpload btn btn-default button-pink button-pink-margin pull-left">
                                                <span><i class="fa fa-plus-circle"></i> ADD A PHOTO</span>
                                                <input id="fileInput" type="file" value="Upload button" multiple/>
                                            </div>
                                            
                                        
                                            <div class="clearfix"></div>
                                            <p class="frm-label">
                                                photo
                                            </p>
                                            <div id="photoContain" >
                                             
                                                    <ul id="imagePreviews">
                                                    </ul>

                                                <div style="clear: both;">&nbsp;</div>
                                                
                                                <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='<?php echo base_url()?>public/css/img/bx_loader.gif' width="100" height="100" /><br>Saving..</div>
                                                
                                                   <!-- <output id="result">-->
                                             
                                              
                                            </div>
                                            <!--<div class="clearfix"><pre id="responseY" style="width: 650px;"></pre></div>-->
                                            <hr/>
                                            <h3 class="h3-imp">Do you have a video? Simply enter the YouTube video ID.
                                                <br/>eg, Video ID is a657676876 for
                                                <br/>https://www.youtube.com/watch?v=a657676876
                                            </h3>
                                            <input type="text" name="videoId" id="videoId" class="form-control"  placeholder="Enter your YouTube Video ID">
                                            <input type="hidden" name='property_id' value="28" >
                                        <input type="submit" class="button-pink btn btn-default pull-left" value='Add'>
                                       <!--<input type="submit"/>-->
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                           <!-- <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Pricing">
                                <div class="frm-container" id="pricing">
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
                                        <form class="form-horizontal" id="formPrice">
                                            <div class="col-md-6 col-padding-no"><h2 class="no-margin-top">PRICING</h2></div>
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
                                                            <th class="pull-left">Season 1</th>
                                                            <th>Season 2</th>
                                                            <th>Season 3</th>
                                                            <th>Season 4</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" class="pull-left">Daily</th>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" id="season1Daily" name="season1_daily" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div><div><p id="sd1"></p></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                               </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Weekly</th>
                                                            <td class="pull-left">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" id="season1Weekly" name="season1_weekly" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div><div><p id="sw1"></p></div> 
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input disabled type="text" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Monthly</th>
                                                            <td class="pull-left">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" id="season1Monthly" name="season1_monthly" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div><div><p id="sm1"></p></div>
                                                            </td>
                                                            <td>
                                                              <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Weekend</th>
                                                            <td class="pull-left">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" id="season1Weekend" name="season1_weekend" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div><div><p id="swe1"></p></div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                                    <input type="text" disabled class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            <div class="col-md-7 col-padding-no custom-price-desc">
                                                <p>This price will apply to all reservations that are 28 nights or longer, even if you've set a weekly price. You can also set a different, custom monthly price for specific months.</p>
                                            </div>
                                            <div class="col-md-5 col-padding-no">
                                                <input class="button-pink btn btn-default pull-right" value="SET CUSTOM PRICE">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            <h2>ADDITIONAL CHARGES</h2>
                                            <div class="col-md-12 col-padding-no checkbox-container additional-charges">
                                                <div class="amenities-checkbox">
                                                    <input id="check1" type="checkbox" value="check1">
                                                    
                                                    <input type="hidden" name='property_id' value="20" >
                                                    <input type="hidden" name='user_id' value="2" >
                                                    <label for="check1">Cleaning fee</label>
                                                </div>
                                                <div id="addCleaning" class="collapse">
                                                    <div class="input-group ele-inline">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="clean_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div><div><p id="clean_charge"></p></div>
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
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="text-desc-chrg">This fee will apply for each additional guest, for each night of the reservation.</p>
                                                </div>
                                                <div class="amenities-checkbox">
                                                    <input id="check2" type="checkbox" value="check2">
                                                    <label for="check2" data-toggle="collapse" data-target="#addGuest" aria-expanded="false" aria-controls="addGuest">Additional Guest</label>
                                                </div>
                                                <div id="addGuest" class="collapse">
                                                    <div class="input-group ele-inline">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="guest_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div><div><p id="guest_charge"></p></div>
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
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="text-desc-chrg">This fee will apply for each additional guest, for each night of the reservation.</p>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="amenities-checkbox">
                                                    <input id="check3" type="checkbox" value="check3">
                                                    <label for="check3" data-toggle="collapse" data-target="#addSec" aria-expanded="false" aria-controls="addSec">Security Deposit</label>
                                                </div>
                                                <div id="addSec" class="collapse">
                                                    <div class="input-group ele-inline">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="security_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div><div><p id="security_charge"></p></div>
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
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="text-desc-chrg">This fee will apply for each additional guest, for each night of the reservation.</p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            <input class="button-pink btn btn-default pull-left" id="saveBasePrice" type="submit" value="Save">
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                          <!--  <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Calendar">
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
                                        <form class="form-horizontal">
                                            <h3>A title and summary displayed on your public listing page</h3>
                                            <div class="select-container col-md-6 col-padding-no no-margin-left no-margin-top">
                                                <div class="styled-select pink-styled-select no-margin-left">
                                                    <select class="form-control month-dropdown">
                                                        <option value="1">APRIL 2015</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-padding-no">
                                                <p class="pull-right calendar-setting"><i class="fa fa-cog"></i> SETTINGS</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 calendar-container col-padding-no">
                                                <div>
                                                    <!-- SPACE FOR CALENDAR -->
                                                </div>
                                                <p><span class="currentState" id="reservations"></span> RESERVATIONS</p>
                                                <p><span class="currentState" id="available"></span> AVAILABLE<a class="pull-right">View calendar sync instructions</a></p>
                                                <p><span class="currentState" id="blocked"></span> BLOCKED<a class="pull-right">Calendar last updated today</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
                                            <div class="col-md-6 col-padding-no instant-booking">
                                                <p>Instant Booking ?</p>
                                            </div>
                                            <div class="col-md-6 col-padding-no instant-booking">
                                                <!-- <span><input type="checkbox"> YES<span> -->
                                                <div class="amenities-checkbox" style="width: 90px;background-color: #fff;padding: 0px 15px;">
                                                    <label for="amnt1" style="padding-top: 0px;">YES</label>
                                                    <input id="amnt1" type="checkbox" value="amnt1">
                                                </div>
                                            </div>
                                            <!-- Remove these save buttons they are just to check modal code -->
                                            <div class="clearfix"></div>
                                            <p>Note: Remove these save buttons they are just to check modal code</p>
                                            <input 
                                                class="button-pink btn btn-default pull-left" 
                                                type="button" 
                                                value="Save"
                                                data-toggle="modal" data-target="#requestModal">
                                            <input 
                                                class="button-pink btn btn-default pull-right" 
                                                type="button" 
                                                value="Save"
                                                data-toggle="modal" data-target="#bookingModal">
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                            <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Amenities">
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
                                        <form class="form-horizontal" id="formAmenities">
                                            <h2>AMENITIES</h2>
                                           <!--<h3>Sed lorem ipsum dollar sit amet.Sed lorem ipsum dollar sit amet</h3>-->
                                            <hr/>
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Common
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body col-padding-no">
                                                             <?php 
                                                                 // Base URL for the service
                                                                $baseUrl = $base_url.'host/getAmenities';                    
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
                                
                                                            <input name="property_id"  type="hidden" value="<?php echo $propId;?>"> 
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                                features
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body col-padding-no">
                                                            <?php 
                                                                     // Base URL for the service
                                                                    $baseUrl = $base_url.'host/getAmenities';                    
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
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                                                                extras
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body col-padding-no">
                                                              <?php 
                                                                     // Base URL for the service
                                                                    $baseUrl = $base_url.'host/getAmenities';                    
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
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading col-padding-no" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
                                                                safety
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body col-padding-no">
                                                             <?php 
                                                                     // Base URL for the service
                                                                    $baseUrl = $base_url.'host/getAmenities';                    
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
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <input class="button-pink btn btn-default pull-left" id="saveAmenities" type="submit" value="Save">
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                           <!-- <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Listing">
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
                                        <form class="form-horizontal" id="formInfo">
                                            <h2>LISTING INFORMATION</h2>
                                            <h3></h3>
                                            <hr/>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>PROPERTY TYPE</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                     <?php 
                                                            $baseUrl = $base_url.'host/getPropertytype';                    
                                                            $jsonData = file_get_contents($baseUrl); 
                                                            $jsonDataObject = json_decode($jsonData);
                                                       echo  '<select name="property_type_id" class="form-control">';    
                                                       foreach($jsonDataObject as $common)
                                                       {
                                                           echo  '<option value='.$common->property_type_id.'>'.$common->property_type.'</option>';                                            
                                                        
                                                       } 
                                                       echo '</select>';                                      
                                                       
                                                      ?>  
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>ROOM TYPE</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                    <?php 
                                                            $baseUrl = $base_url.'host/getRoomtype';                    
                                                            $jsonData = file_get_contents($baseUrl); 
                                                            $jsonDataObject = json_decode($jsonData);
                                                            
                                                            echo  '<select name="room_type_id" class="form-control">';    
                                                            foreach($jsonDataObject as $common)
                                                            {
                                                                echo  '<option value='.$common->room_type_id.'>'.$common->roomtype.'</option>';                                            
                                                        
                                                            } 
                                                            echo '</select>';                                      
                                                       
                                                      ?>  
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>GUESTS</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                    <select name="guest"  class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>BEDROOMS</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                    <select name="bedrooms" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>BEDS</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                    <select name="beds" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>BATHROOMS</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
                                                    <select name="bathrooms" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                            
                                                <div class="col-md-6 col-padding-no">
                                                    <p>CANCELLATION POLICY</p>
                                                </div>
                                            <div class="col-md-6 styled-select col-padding-no">
                                                   
                                                    <select name="policy" class="form-control">  
                                                        <?php 
                                                            $baseUrl = $base_url.'host/getCancellationpolicy';                    
                                                            $jsonData = file_get_contents($baseUrl); 
                                                            $jsonDataObject = json_decode($jsonData);
                                                            //echo '<div class="col-md-4 col-xs-12 checkbox-container">';
                                                           // echo '<div class="amenities-checkbox">';
                                                            
                                                             /*foreach($jsonDataObject as $common)
                                                                {
                                                                    echo '<input id="policy_id" name="policy"  type="checkbox" value="'.$common->id.'">
                                                                    <label for="policy">'.$common->policy.'</label>'.PHP_EOL;
                                                                   
                                                                }*/
                                                            
                                                            foreach($jsonDataObject as $common)
                                                            {
                                                                echo  '<option value='.$common->id.'>'.$common->policy.'</option>';                                            
                                                        
                                                            } 
                                                                        
                                                            //echo '</div>';
                                                            //echo '</div>';
                                                      ?>  
                                                     </select>   
                                                         
                                                   
                                                </div>
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                            
                                                <div class="col-md-6 col-padding-no">
                                                    <p>TAGS</p>
                                                </div>
                                                <div class="panel-body col-padding-no">
                                                              <?php 
                                                                     // Base URL for the service
                                                                    $baseUrl = $base_url.'host/getTags';                    
                                                                    $jsonData = file_get_contents($baseUrl); 
                                                                    $jsonDataObject = json_decode($jsonData);
                                                                   
                                                                    $count =0;
                                                                    foreach($jsonDataObject as $common)
                                                                    {
                                                                        echo '<input id="tag_check'.$count.'" name="tag[]"  type="checkbox" value="'.$common->id.'">
                                                                        <label for="extra_check'.$count.'">'.$common->tag.'</label>'.PHP_EOL;
                                                                        //echo "\r\n";
                                                                        $count++;
                                                                    }
                                                                   
                                                                ?>
                                                </div>
                                            </div>
                                            <hr class="selectcontainer-divider"/>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>CHECK IN TIME</p>
                                                </div>
                                                <div class="col-md-6 styled-input col-padding-no">
                                                    <div class="input-group">
                                                        <input type="time" id="check_in"  name="check_in"  class="form-control" placeholder="12:00">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default clock-pad" type="button">
                                                                <img src="<?php echo base_url()?>public/images/checkin.png" alt="help">
                                                            </button>
                                                        </span>
                                                    <!--    <script type="text/javascript" src="<?php echo base_url()?>public/plug_in/time/ng_all.js"></script>
                                                        <script type="text/javascript" src="<?php echo base_url()?>public/plug_in/time/timepicker.js"></script>
                                                        <script type="text/javascript">
                                                        ng.ready( function() {
                                                            var tp = new ng.TimePicker({
                                                                input: 'check_in',  // the input field id
                                                                start: '9:00 am',  // what's the first available hour
                                                                end: '6:00 pm',  // what's the last avaliable hour
                                                                top_hour: 12  // what's the top hour (in the clock face, 0 = midnight)
                                                            });
                                                        });
                                                        </script>-->
                                                       <!-- <span class="input-group-btn">
                                                            <button class="btn btn-default clock-pad" type="button">
                                                                <img src="<?php echo base_url()?>public/images/checkin.png" alt="help">
                                                            </button>
                                                        </span>-->
                                                    </div><!-- /input-group -->
                                                </div>
                                            </div>
                                            <div class="selectcontainer-divider"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>CHECK OUT TIME</p>
                                                </div>
                                                <div class="col-md-6 styled-input col-padding-no">
                                                    <div class="input-group">
                                                        <input name="check_out" id="check_out"  type="time" class="form-control" placeholder="12:00">
                                                       <span class="input-group-btn">
                                                            <button class="btn btn-default clock-pad" type="button">
                                                                <img src="<?php echo base_url()?>public/images/checkin.png" alt="help">
                                                            </button>
                                                        </span>
                                                         
                                                    </div><!-- /input-group -->
                                                </div>
                                                <input type="hidden" name="user_id" value="2" class="form-control" >
                                                            <input type="hidden" name="property_id" value="20" class="form-control" >
                                            </div>
                                            <div class="selectcontainer-divider"></div>
                                            <div class="clearfix"></div>
                                    
                                    
                                            
                                            
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-md-offset-6 col-padding-no">
                                                <input class="button-pink btn btn-default pull-left" id="saveInfo" type="submit" value="Save">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                           <!-- <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Location">
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
                                        <form class="form-horizontal" id="formAddress">
                                                        <h2>ADDRESS</h2>
                                           <!-- <h3>A title and summary displayed on your public listing page</h3>-->
                                            <hr/>
                                            <input type="text" id="address1" name="address_line1" class="form-control input-lg" placeholder="ADDRESS LINE 1">
                                            <input type="text" id="address2" name="address_line2" class="form-control input-lg margin-top-30" placeholder="ADDRESS LINE 2">
                                            <div class="select-container col-md-12 col-padding-no">
                                                <div class="col-md-6 styled-select">
                                                    <select name="country" id="country-list" class="demoInputBox" onchange="selectState(this.options[this.selectedIndex].value)" >
                                                       <option value="-1">Select country</option>
                                                                                <?php
                                                                                foreach($list->result() as $listElement){
                                                                                    ?>
                                                                                    <option value="<?php echo $listElement->country_id?>"><?php echo $listElement->country_name?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                            
                                                    </select>
                                                
                                                </div>
                                                <div class="col-md-6 styled-select margin-left-30">
                                                    <select name="state" id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)" class="form-control">
                                                       <option value="-1">Select state</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="select-container col-md-12 col-padding-no">
                                                <div class="col-md-6 styled-select">
                                                    <select name="city" id="city_dropdown" class="form-control">
                                                        <option value="-1">Select city</option>
                                                    </select>
                                                    
                                                </div>
                                                <?php
                                                            /*}else{
                                                                echo 'No Country Name Found';
                                                            }*/
                                                            ?>
                                                <div class="col-md-6 styled-select margin-left-30">
                                                    
                                                     <input id="area" class="form-control" name="area" type="textbox" placeholder="Area">
                                                     
                                                     <input id="user_id" class="form-control" value="2" name="user_id" type="hidden">
                                                     
                                                     <input id="property_id" class="form-control" name="property_id" value="20" type="hidden">
                                                   
                                                    <!--<select name="area" class="form-control">
                                                        <option value="1">AREA</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-padding-no">
                                                <input type="text" id="zip" name="zip" class="form-control input-lg margin-top-30" placeholder="ZIP CODE">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
                                            <input type="hidden" name="latitude" id="lat">
                                            <input type="hidden" name="longitude" id="log">
                                            <input class="button-pink btn btn-default pull-left no-margin-top" onclick="codeAddress()" type="button" value="PIN IT TO MAP">
                                    </div>
                                    
                                    <div class="col-md-3 col-padding-no">
                                        <div class="col-padding-no centered-info">
                                           <!-- <div class="line"></div>
                                            <img src="<?php echo base_url()?>public/images/info.png" alt="info">
                                            <div class="col-md-12">
                                                <p>
                                                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, 
                                                    consectetur, adipisci velitNeque porro quisquam est qui dolorem 
                                                    ipsum quia dolor sit amet, consectetur, adipisci velit
                                                </p>
                                            </div>-->
                                        </div>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <div class="map-container">
                                    
                                    <input onclick="deleteMarkers();" type=button value="Delete Markers">
                                      <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1889.0463838040423!2d73.4085417!3d18.7493929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be8010e72f046e7%3A0xb297152aff62735a!2sLonavala!5e0!3m2!1sen!2sin!4v1435728774026" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                                          
                                          <div id="map-canvas" style="width:100%;"></div>
                                        
                                        
                                    </div>
                                    <input class="button-pink btn btn-default pull-left no-margin-top" id="saveAddress" type="submit" value="SUBMIT">
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
<!-- Google Map API --> 

                                    <script>
                                        var geocoder;
                                        var map;
                                        var city;
                                        var markers = [];
                                        function initialize() {
                                          geocoder = new google.maps.Geocoder();
                                          var latlng = new google.maps.LatLng(-34.397, 150.644);
                                          var mapOptions = {
                                            zoom: 15,
                                            center: latlng
                                          }
                                           $("#city_dropdown").change(function(e){
                                                city = $(":selected",this).text();
                                            });
                                          map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                                          google.maps.event.addListener(map, 'click', function(event) {
                                            //placeMarker(event.latLng);

                                            addMarker(event.latLng);
                                            // get lat/lon of click
                                            var clickLat = event.latLng.lat();
                                            var clickLon = event.latLng.lng();

                                            // show in input box
                                            document.getElementById("lat").value = clickLat.toFixed(5);
                                            document.getElementById("log").value = clickLon.toFixed(5);

                                          });
                                        }


                                       


                                        // Sets the map on all markers in the array.
                                        function setAllMap(map) {
                                          for (var i = 0; i < markers.length; i++) {
                                            markers[i].setMap(map);
                                          }
                                        }   
                                        // Add a marker to the map and push to the array.
                                        function addMarker(location) {
                                          
                                          var marker = new google.maps.Marker({
                                            position: location,
                                            map: map,
                                            icon:'<?php echo base_url()?>public/images/pinkball.png'
                                          });
                                          var infowindow = new google.maps.InfoWindow({
                                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
                                          });
                                          infowindow.open(map,marker);
                                          markers.push(marker);
                                         
                                         
                                        }
                                        // Removes the markers from the map, but keeps them in the array.
                                        function clearMarkers() {
                                          setAllMap(null);
                                        }
                                        /*
                                        function placeMarker(location) {
                                          var marker = new google.maps.Marker({
                                            position: location,
                                            map: map,
                                          });
                                          var infowindow = new google.maps.InfoWindow({
                                            content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
                                          });
                                          infowindow.open(map,marker);
                                        }*/
                                        
                                        // Deletes all markers in the array by removing references to them.
                                        function deleteMarkers() {
                                          clearMarkers();
                                          markers = [];
                                        }


                                        function codeAddress() {
                                          
                                          //var city_dropdown = document.getElementById('city_dropdown').value;
                                          var address1 = document.getElementById('address1').value;
                                          var address2 = document.getElementById('address2').value;
                                          var area = document.getElementById('area').value;
                                          //var city1 = '';
                                           /* $("#city_dropdown").change(function() {
                                                alert(this.options[this.selectedIndex].value);
                                            });*/ 
                                            
                                            
                                          //var location = address1+', '+address2;
                                          //alert(city_dropdown);
                                          var location = city+', '+area+' '+address2;
                                          geocoder.geocode( { 'address': location}, function(results, status) {
                                            if (status == google.maps.GeocoderStatus.OK) {
                                                alert("Pin your exact location on map");
                                              var center1 = map.setCenter(results[0].geometry.location);
                                              var marker = new google.maps.Marker({
                                                  /*center: center1,
                                                  radius:20000,
                                                  strokeColor:"#0000FF",
                                                  strokeOpacity:0.8,
                                                  strokeWeight:2,
                                                  fillColor:"#0000FF",
                                                  fillOpacity:0.4,*/
                                                  map: map,
                                                  position: results[0].geometry.location
                                              });
                                            } else {
                                              alert('Geocode was not successful for the following reason: ' + status);
                                            }
                                          });
                                        }

                                        google.maps.event.addDomListener(window, 'load', initialize);

                                            </script>
<?php $this->load->view('footer');?>


      
