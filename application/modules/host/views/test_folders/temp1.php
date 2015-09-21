



<?php $this->load->view("subheader");?>
		<?php /* get property id from session */
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
                                    Property Overview
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
                            <div class="tab-pane" id="Photo" tabindex="1">
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
                                        <form id='submitPhoto' method="POST" enctype="multipart/form-data">
                                            <h2>ADD A PHOTO OR TWO!</h2>
                                            <h3>Upload min 1 and max 24. Max 5 MB in size. No special characters in filename please</h3>
                                            <!-- <button type="submit" class="button-pink button-pink-margin btn btn-default pull-left">
                                                <i class="fa fa-plus-circle"></i>
                                                &nbsp;&nbsp;&nbsp;ADD A PHOTO
                                            </button> -->
                                            <div class="fileUpload btn btn-default button-pink button-pink-margin pull-left">
                                                <span><i class="fa fa-plus-circle"></i> ADD A PHOTO</span>
                                                <input  name="userfile[]" id="files" type="file"  multiple>
                                            </div>
											 <script type="text/javascript">
                                            window.onload = function(){
                                                
                                            //Check File API support
                                            if(window.File && window.FileList && window.FileReader)
                                            {
                                                var filesInput = document.getElementById("files");
                                                
                                                filesInput.addEventListener("change", function(event){
                                                    
                                                    var files = event.target.files; //FileList object
                                                    var output = document.getElementById("result");
                                                    
                                                    for(var i = 0; i< files.length; i++)
                                                    {
                                                        var file = files[i];
                                                        
                                                        //Only pics
                                                        if(!file.type.match('image'))
                                                          continue;
                                                        
                                                        var picReader = new FileReader();
                                                        
                                                        picReader.addEventListener("load",function(event){
                                                            
                                                            var picFile = event.target;
                                                            
                                                            var div = document.createElement("div");
                                                            
                                                          div.innerHTML = "<div class='col-md-4 photo-container col-padding-no'> <img class='thumbnail'  src='" + picFile.result + "'" +
                                                                    "title='" + picFile.name + "'/><br><textarea  name='caption[]'  placeholder='Caption here' class='form-control photo-desc' rows='3'></textarea> </div>";		

																output.insertBefore(div,null);    
																/*
																var test = "<a href='#' class='remove_pict'>X</a>";
																div.children[1].addEventListener("click", function(event){
																		div.parentNode.removeChild(div);
																});*/          
																										
                                                        });
                                                        
                                                         //Read the image
                                                        picReader.readAsDataURL(file);
                                                    }                               
                                                   
                                                });
                                            }
                                            else
                                            {
                                                console.log("Your browser does not support File API");
                                            }
											
                                        }
                                        </script>
										
                                            <div class="clearfix"></div>
                                            <p class="frm-label">
                                                photo
                                            </p>
                                            <div id="photoContainer" class="col-md-12 col-padding-no">
                                                
                                                
                                                    <output id="result">
                                             
                                              
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
                                            <h3 class="h3-imp">Do you have a video? Simply enter the YouTube video ID.
                                                <br/>eg, Video ID is a657676876 for
                                                <br/>https://www.youtube.com/watch?v=a657676876
                                            </h3>
                                            <input type="text" name="videoId" class="form-control"  placeholder="Enter your YouTube Video ID">
											<input type="hidden" name='property_id' value="<?php echo $propId;?>" >
                                        <input type="submit" id="savePhotos" name="submit" class="button-pink btn btn-default pull-left" value='Add'>
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
                            <div class="tab-pane" id="Pricing" tabindex="1">
                                <div class="frm-container" id="pricing" tabindex="1">
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
                                                                    <input type="text" id="season1Daily" required name="season1_daily" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
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
                                                                    <input type="text" id="season1Weekly" required name="season1_weekly" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
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
													
													<input type="hidden" name='property_id' value="<?php echo $propId;?>" >
                                                    <input type="hidden" name='user_id' value="2" >
													<label for="check1" data-toggle="collapse" data-target="#addCleaning" aria-expanded="false" aria-controls="addCleaning">Cleaning fee</label>
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
                            <div class="tab-pane" id="Amenities" tabindex="1">
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
                            <div class="tab-pane" id="Listing" tabindex="1">
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
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>ROOM TYPE</p>
                                                </div>
                                                <div class="col-md-6 styled-select col-padding-no">
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
                                            <hr class="selectcontainer-divider"/>
                                            <div class="select-container">
                                                <div class="col-md-6 col-padding-no">
                                                    <p>CHECK IN TIME</p>
                                                </div>
                                                <div class="col-md-6 styled-input col-padding-no">
                                                    <div class="input-group">
                                                        <input type="time" id="check_in"  name="check_in"  class="form-control" placeholder="12:00">
													<!--	<script type="text/javascript" src="<?php echo base_url()?>public/plug_in/time/ng_all.js"></script>
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
                                                       <!-- <span class="input-group-btn">
                                                            <button class="btn btn-default clock-pad" type="button">
                                                                <img src="<?php echo base_url()?>public/images/checkin.png" alt="help">
                                                            </button>
                                                        </span>-->
														 <input type="hidden" name="user_id" value="2" class="form-control" >
                                                            <input type="hidden" name="property_id" value="<?php echo $propId;?>" class="form-control" >
                                                    </div><!-- /input-group -->
                                                </div>
                                            </div>
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
                                            <input type="text" name="address_line1" class="form-control input-lg" placeholder="ADDRESS LINE 1">
                                            <input type="text" name="address_line2" class="form-control input-lg margin-top-30" placeholder="ADDRESS LINE 2">
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
                                                 
                                                        <input id="address" class="form-control" name="area" type="textbox" placeholder="Area">
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-padding-no">
                                                <input type="text" name="zip" class="form-control input-lg margin-top-30" placeholder="ZIP CODE">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
											
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
									    <script>
										var geocoder;
										var map;
										function initialize() {
										  geocoder = new google.maps.Geocoder();
										  var latlng = new google.maps.LatLng(-34.397, 150.644);
										  var mapOptions = {
											zoom: 8,
											center: latlng
										  }
										  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
										}

										function codeAddress() {
										  var address = document.getElementById('address').value;
										  var city = document.getElementById('city_dropdown').value;
										  geocoder.geocode( { address+', '+city: address}, function(results, status) {
											if (status == google.maps.GeocoderStatus.OK) {
											  map.setCenter(results[0].geometry.location);
											  var marker = new google.maps.Marker({
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
                                    <div class="map-container">
                                      
										<div style="width: 50%; height: 50%" id="map-canvas"></div>
										
										<input class="button-pink btn btn-default pull-left no-margin-top" type="submit" value="SUBMIT">
												</div>
												
									 </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

<?php $this->load->view('footer');?>


      