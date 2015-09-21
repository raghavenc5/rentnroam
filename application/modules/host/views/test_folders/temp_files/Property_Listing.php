<?php
$title = 'Host Property Listing';
include('subheader.php');
?>  
		
        <div  class="container" style="padding-top: 180px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2"> <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active">
                                <a href="#Overview" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Property Overview
                                </a>
                            </li>
                            <li>
                                <a href="#Photo" data-toggle="tab">
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
                            <li>
                                <a href="#Calendar" data-toggle="tab">
                                    <p class="icon-check text-right"><i class="fa fa-check"></i></p>
                                    Calendar
                                </a>
                            </li>
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
                                <div class="frm-body col-md-9 col-padding-no" >
										<form ng-submit="submitForm()" ng-controller="FormController" novalidate>
										
                                   <!-- <form method="POST" class="form-horizontal" action="<?php echo base_url();?>host/property_overview">-->
                                        <h2>OVERVIEW</h2>
                                        <h3>A title and summary displayed on your public listing page</h3>
										<?php echo "<p style='color:red'>".form_error('title')."</p>"; ?>
										
                                        <p class="frm-label">
                                            TITLE 
                                        </p>
                                        <input type="text" required name="title" ng-model="formData.title" ng-class="{'error' : errorName}" class="form-control input-lg" value="<?php echo set_value('title'); ?>">
                                        <?php echo "<p style='color:red'>".form_error('description')."</p>"; ?> 
										<p class="frm-label">
                                            description 
                                        </p>
                                        <textarea class="form-control input-lg" ng-model="formData.description" ng-class="{'error' : errorName}" name='description' required rows="5"></textarea>
										  <?php echo "<p style='color:red'>".form_error('neighbourhood')."</p>"; ?> 
                                        <p class="frm-label">
                                            NEIGHBERHOOD HIGHLIGHTS  
                                        </p>
                                        <textarea class="form-control input-lg" required ng-model="formData.neighbourhood" ng-class="{'error' : errorName}" name='neighbourhood' value="<?php echo set_value('neighbourhood'); ?>" rows="5"></textarea>
                                        <hr/>
                                        <p class="frm-label">
                                            HOUSE RULES <span>(IF ANY)</span> 
                                        </p>
                                        <textarea class="form-control input-lg" ng-model="formData.house_rules" ng-class="{'error' : errorName}" name='house_rules' rows="5"></textarea>
                                        <hr/>
										<input type="text" name='user_id' placeholder="user_id(temp field) give 2" value="2" ng-model="formData.user_id"  >
										<input type="text" name='property_id' placeholder="property_id(temp field) give 6 " ng-model="formData.property_id" ng-class="{'error' : errorName}" value="6" >
                                        <div class="select-container">
                                            <p class="col-md-6">Minimum night stay</p>
                                            <span class="col-md-6">
                                                <select name="min_night" ng-model="formData.min_night" ng-class="{'error' : errorName}" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
													<option value="4">4</option>
                                                </select>
                                            </span>
                                        </div>
										<div ><h2 style="color:green" ng-class="{'submissionMessage' : submission}" ng-bind="submissionMessage"></h2></div>
										
										<!--<button ng-click='OverviewSave();' class="button-pink btn btn-default pull-left">Save</button>-->
                                        <input class="button-pink btn btn-default pull-left"  type="submit" value="Send!" name="submit"> 
                                    </form>
										      <script>
														
														// creating Angular Module
											  var websiteApp = angular.module('websiteApp', []);
											  // create angular controller and pass in $scope and $http
											  websiteApp.controller('FormController',function($scope, $http) {
											  // creating a blank object to hold our form information.
											  //$scope will allow this to pass between controller and view
											  $scope.formData = {};
											  // submission message doesn't show when page loads
											  $scope.submission = false;
											  // Updated code thanks to Yotam
											  var param = function(data) {
													var returnString = '';
													for (d in data){
														if (data.hasOwnProperty(d))
														   returnString += d + '=' + data[d] + '&';
													}
													// Remove last ampersand and return
													return returnString.slice( 0, returnString.length - 1 );
											  };
											  $scope.submitForm = function() {
												$http({
												method : 'POST',
												url : 'http://104.215.198.240/rentnroam/host/property_overview',
												data : param($scope.formData), // pass in data as strings
												headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
											  })
											  /*
												 // if there are items in our errors array, return those errors
											  $data['success'] = false;
											  $data['errors'] = $errors;
											  $data['messageError'] = 'Please check the fields in red';
											   */
												.success(function(data) {
												  if (!data.success) {
												   // if not successful, bind errors to error variables
												   $scope.errorName = data.error;
												   $scope.errorMessage = data.message;
													$scope.submissionMessage = data.message;
												   $scope.submission = true; //shows the error message
												
												  } else {
												  // if successful, bind success message to message
												   $scope.submissionMessage = data.message;
												   $scope.formData = {}; // form fields are emptied with this line
												   $scope.submission = true; //shows the success message
												  }
												 });
											   };
											});
										</script>
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
                            <div class="tab-pane" id="Photo">
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
                                        <?php echo form_open_multipart('host/doupload');?>
                                            <h2>ADD A PHOTO OR TWO!</h2>
                                            <h3>Upload min 1 and max 24. Max 5 MB in size. No special characters in filename please</h3>
                                            <div class="button-pink button-pink-margin btn btn-default pull-left"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp; <input id="files" name="userfile[]" type="file" required /> </div>
                                            <div class="clearfix">
										
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
															
															div.innerHTML = "<div class='col-md-5 photo-container'> <img class='thumbnail' src='" + picFile.result + "'" +
																	"title='" + picFile.name + "'/><br><textarea  name='caption[]' placeholder='Caption here' class='form-control photo-desc' rows='3'></textarea> </div>";
															
															output.insertBefore(div,null);            
														
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
											</div>
                                            <p class="frm-label">
                                                photo
                                            </p>
                                        
                                             <div class="clearfix">
												<output id="result">
											</div>
                                            <hr/>
                                            <h3 class="h3-imp">Do you have a video? Simply enter the YouTube video ID.
                                                <br/>eg, Video ID is a657676876 for
                                                <br/>https://www.youtube.com/watch?v=a657676876
                                            </h3>
                                                 <input type="text" name="videoId" class="form-control" placeholder="Enter your YouTube Video ID">
												<input type="hidden" name="property_id" value="6">
											<button type="submit" value="submit" class="button-pink button-pink-margin btn btn-default pull-left">
												SAVE</button>   
									<?php echo form_close() ?>
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
                            <div class="tab-pane" id="Pricing">
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
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url()?>host/PreSeasonalPricing">
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
                                                <th>Base Price</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Daily</th>
                                                <td>
                                                    <div class="input-group">
														<?php echo "<p style='color:red'>".form_error('season1_daily')."</p>"; ?>
														
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" required name="season1_daily" value="<?php echo set_value('season1_daily'); ?>"class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Weekly</th>
                                                <td>
                                                    <div class="input-group">
															<?php echo "<p style='color:red'>".form_error('season1_weekly')."</p>"; ?>
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" required name="season1_weekly" value="<?php echo set_value('season1_weekly'); ?>" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Monthly</th>
                                                <td>
                                                    <div class="input-group">
														<?php echo "<p style='color:red'>".form_error('season1_monthly')."</p>"; ?>
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" required name="season1_monthly" value="<?php echo set_value('season1_monthly'); ?>" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                            <tr>
                                                <th scope="row">Weekend</th>
                                                <td>
                                                    <div class="input-group">
														<?php echo "<p style='color:red'>".form_error('season1_monthly')."</p>"; ?>
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" required name="season1_weekend" value="<?php echo set_value('season1_weekend'); ?>" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
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
                                                <input class="button-pink btn btn-default pull-right" type="submit" value="SET CUSTOM PRICE">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr />
                                            <h2>ADDITIONAL CHARGES</h2>
                                           <div class="col-md-12 col-padding-no checkbox-container additional-charges">
                                    <div class="amenities-checkbox">
                                        <input id="check1" type="checkbox" value="check1">
                                        <label for="check1">Cleaning fee</label>
                                    </div>
                                    <div class="amenities-checkbox">
                                        <input id="check2" type="checkbox" value="check2">
                                        <label for="check2">Additional Guest</label>
                                    </div>
                                    <div class="input-group ele-inline">
                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                        <input type="text" name="guest_charge" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
										<input type="hidden" name="user_id" value="2" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
										<input type="hidden" name="property_id" value="6" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                    </div>
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
                                    <div class="clearfix"></div>
                                    <div class="amenities-checkbox">
                                        <input id="check3" type="checkbox" value="check3">
                                        <label for="check3">Security Deposit</label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <input class="button-pink btn btn-default pull-left" type="submit" value="Save">
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
                                                <p><img src="">RESERVATIONS</p>
                                                <p><img src="">AVAILABLE<a class="pull-right">View calendar sync instructions</a></p>
                                                <p><img src="">BLOCKED<a class="pull-right">Calendar last updated today</a></p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
                                            <div class="col-md-6 col-padding-no instant-booking">
                                                <p>Instant Booking ?</p>
                                            </div>
                                            <div class="col-md-6 col-padding-no instant-booking">
                                                <span><input type="checkbox"> YES<span>
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
                                        <form class="form-horizontal" method="post" action="<?php base_url()?>host/property_amenities">
                                            <h2>AMENITIES</h2>
                                            <h3>Sed lorem ipsum dollar sit amet.Sed lorem ipsum dollar sit amet</h3>
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
                                
															<input name="property_id"  type="hidden" value="6">  
                                                        </div>
                                                    </div>
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
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr/>
                                            <input class="button-pink btn btn-default pull-left" type="submit" value="Save">
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
													<?php echo "<p style='color:red'>".form_error('check_in')."</p>"; ?>
													<span class="col-md-6 styled-input col-padding-no">
														<div class="input-group">														
														
															<input type="text" required value="<?php echo set_value('check_in'); ?>" name="check_in" class="form-control" placeholder="12:00">
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
														<?php echo "<p style='color:red'>".form_error('check_out')."</p>"; ?>
													<span class="col-md-6 styled-input col-padding-no">
														<div class="input-group">
														
															<input type="text" required value="<?php echo set_value('check_out'); ?>" name="check_out" class="form-control" placeholder="12:00">
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
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url()?>host/property_address">
                                            <h2>ADDRESS</h2>
												<h3>A title and summary displayed on your public listing page</h3>
												<hr/>
												<input type="text" required name="address_line1" class="form-control input-lg" placeholder="ADDRESS LINE 1">
												<input type="text" required name="address_line2" class="form-control input-lg margin-top-30" placeholder="ADDRESS LINE 2">
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
                                    <div class="clearfix"></div>
                                    <div class="map-container">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1889.0463838040423!2d73.4085417!3d18.7493929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be8010e72f046e7%3A0xb297152aff62735a!2sLonavala!5e0!3m2!1sen!2sin!4v1435728774026" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
<?php include('footer.php');  ?>