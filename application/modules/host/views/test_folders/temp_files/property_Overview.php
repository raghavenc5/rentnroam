<?php
$title = 'Listing | Overview';
include('subheader.php');
?> 
  <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
                    <?php 		//left bar
								$text3 = $text2 = $text4 = $text5 = $text6 = "dum-text";
								$text1 = "active-menu";
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
                            <form method="POST" class="form-horizontal" action="<?php echo base_url();?>host/property_overview">
                                <h2>OVERVIEW</h2>
                                <h3>A title and summary displayed on your public listing page</h3>
                                <p class="frm-label">
                                    TITLE
                                </p>
                                <input type="text" name="title" class="form-control input-lg">
                                <p class="frm-label">
                                    OVERVIEW
                                </p>
                                <textarea class="form-control input-lg" name='description' rows="5"></textarea>
                                <p class="frm-label">
                                    NEIGHBERHOOD HIGHLIGHTS
                                </p>
                                <textarea class="form-control input-lg" name='neighbourhood' rows="5"></textarea>
                                <hr/>
                                <p class="frm-label">
                                    HOUSE RULES <span>(IF ANY)</span>
                                </p>
                                <textarea class="form-control input-lg" name='house_rules' rows="5"></textarea>
                                <hr/>
                                <input type="hidden" name='user_id' value="2" >
								<input type="hidden" name='property_id' value="6" >
                                <div class="select-container">
                                    <p class="col-md-6">Minimum night stay</p>
                                    <span class="col-md-6">
                                        <select name="min_night" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </span>
                                </div>
                                <input class="button-pink btn btn-default pull-left" type="submit" value="Continue">
                            </form>
                        </div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php include_once('footer.php');  ?>
