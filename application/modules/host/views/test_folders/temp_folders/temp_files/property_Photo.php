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

								<?php echo form_open_multipart('host/doupload');?>
                                
                                <h2>ADD A PHOTO OR TWO!</h2>
                                <h3>Upload min 1 and max 24. Max 5 MB in size. No special characters in filename please</h3>
                             
							   <!-- <button type="submit"  value="upload" class="button-pink button-pink-margin btn btn-default pull-left">-->
								  <div class="button-pink button-pink-margin btn btn-default pull-left"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp; <input id="files" name="userfile[]" type="file" multiple/> </div>
                               <!-- <input type="text" name="caption" value="caption"/> -->
                                <div class="clearfix" > 
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
								<!--  -->
                               <!-- <div class="col-md-5 photo-container"> -->
                                  
									
                                   <!-- <textarea  name="caption" placeholder="Caption here"class="form-control photo-desc" rows="3"></textarea>-->
                                 <!--</div> --> 
								

                            
                                <div class="clearfix">
								<output src="<?php echo base_url()?>public/images/home.png" id="result">
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
                            <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php include_once('footer.php');  ?>

