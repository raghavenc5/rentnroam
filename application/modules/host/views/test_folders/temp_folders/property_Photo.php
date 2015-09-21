<?php
$title = 'Listing | Photos';
include('subheader.php');
?>  
        <div class="container" style="background-color: #ffffff;">
            <div class="content-box">
                <div id="frm-container" class="row">
						<?php 	
								//left bar
								$text3 = $text4 = $text5 = $text6 = $text1 = "dum-text";
								$text2 = "active-menu";
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
                           
                            <?php //echo $error;?>
							<?php //echo $error;?>

								<?php echo form_open_multipart('host/do_upload');?>
                                
                                <h2>ADD A PHOTO OR TWO!</h2>
                                <h3>Upload min 1 and max 24. Max 5 MB in size. No special characters in filename please</h3>
                             
							   <!-- <button type="submit"  value="upload" class="button-pink button-pink-margin btn btn-default pull-left">-->
									<script>
									var loadFile = function(event) {
									var output = document.getElementById('output');
									output.src = URL.createObjectURL(event.target.files[0]);
									  };
									</script>
                                <div class="button-pink btn btn-default pull-left">                         
                                
									<input type="file" name="userfile" accept="image/*" onchange="loadFile(event)"/>
								</div>	
								<input type="hidden" name="property_id" value="6" />
                               <!-- <input type="text" name="caption" value="caption"/> -->
                                <div class="clearfix" > </div>
                                <p class="frm-label">
                                    photo
                                </p>
                                <div class="col-md-5 photo-container">
								
                                    <img id="output">
                                    <textarea  name="caption" placeholder="photo caption here"class="form-control photo-desc" rows="3"></textarea>
									
                                </div>
								<script>
									  var loadFile = function(event) {
										var reader = new FileReader();
										reader.onload = function(){
										  var output = document.getElementById('output');
										  output.src = reader.result;
										};
										reader.readAsDataURL(event.target.files[0]);
									  };
									</script>
                            
                                <div class="clearfix"></div>
								    <button type="submit" class="button-pink button-pink-margin btn btn-default pull-left">Upload</button> 
                                <hr/>
                                  
                            </form>
                            <br/>
							<br/>



                            <form  method="POST" action="<?php base_url() ?>host/propertyYouTubeVideo"  >
                            <h3 class="h3-imp">Do you have a video? Simply enter the YouTube video ID.
                                    <br/>eg, Video ID is a657676876 for
                                    <br/>https://www.youtube.com/watch?v=a657676876
                                </h3>
                                <input type="text" name="videoId" class="form-control" placeholder="Enter your YouTube Video ID">
								<input type="hidden" name="property_id" value="6">
                             <button type="submit" class="button-pink button-pink-margin btn btn-default pull-left">
                             ADD</button>   
                             </form>   
                              </div>
                            <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php include_once('footer.php');  ?>

