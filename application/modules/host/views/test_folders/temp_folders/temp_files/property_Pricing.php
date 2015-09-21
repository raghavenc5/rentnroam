<?php 
$title = "Property Pricing";
include('subheader.php');

?>

        <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
						<?php 
								$text1 = $text2 = $text4 = $text5 = $text6 = "dum-text";
								$text3 = "active-menu";
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
                            <form class="form-horizontal" method="POST" action="<?php base_url()?>host/PreSeasonalPricing">
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
                                                <th>Season 1</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Daily</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="season1_daily" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Weekly</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="season1_weekly" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Monthly</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="season1_monthly" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                            <tr>
                                                <th scope="row">Weekend</th>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-inr"></i></span>
                                                        <input type="text" name="season1_weekend" class="form-control" placeholder="2499" aria-describedby="basic-addon1">
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
                                <div class="col-md-5">
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
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once('footer.php');  ?>