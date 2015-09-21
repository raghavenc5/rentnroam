		<div class="clearfix"></div>
				<div class="col-md-12 mrgnleft100">
					<ul class="offers-grid filters-user-property">
					<?php
					if(!empty($property))
						{
							foreach($property as $row)
							{
								$property_id = $row->property_id;
								$reviews = $this->search_model->getReviewscount($property_id);
					?>
						<li class="col-md-6 no-side-margin no-right-padding" onclick="view_property_details(<?php echo $row->property_id;?>);">
							<div class="col-md-12 no-side-margin no-right-padding">
								<div class="half-height property-height">
									<img src="http://104.215.198.240/rentnroam/public/images/hot-offers/delhi.png" alt="delhi">
									<div class="info-box">
										<span class="price"><i class="fa fa-inr"></i><?php echo $row->price; ?></span>
									</div><!-- end info-box -->
									<?php
									$rnr_recomm = $row->rnr_recommended;
									if($rnr_recomm == 1)
									{
									?>
									<div class="certificate-box">
										<span class="text-center">
											<img src="<?php echo base_url()?>public/css/img/rnr-banner.png">
										</span>
									</div><!-- end certificate-box -->
									<?php
									}
									?>
								</div><!-- end half-height -->
							</div>
						</li>
						<div class="col-md-3 no-side-margin property-desc text-center property-height">
							<p class="text-left">
								<img class="cust_rating" alt="Emoticon" src="<?php echo base_url()?>public/images/emoticons/excelent.png">
							</p>
							<?php
							$user_image_path=  "http://104.215.198.240/rentnroam/uploads/user_image/";	
							$user_image = $row->profile_pic;
						if($user_image!='')
						{
							$image = $user_image_path.$user_image;
						}
					else
					 $image='';
							?>
							<img src="<?php echo $image; ?>" class="img-circle property-host-img">
							<p class="text-imp"><?php echo $row->property_title; ?>,</p>
							<p class="text-sub-imp"><?php echo $row->address_line1; ?></p>
							<p><?php echo $row->roomtype; ?></p>
							<div class="property-desc-footer">
								<p class="text-left">
									<span class="text-left"><input type="checkbox"> Compare</span>
									<span class="pull-right">
										<i class="fa fa-map-marker"></i>
										<img alt="wishlist" src="<?php echo base_url()?>public/css/img/heart-icon.png">
										<span><?php echo $reviews->tot_review; ?> Reviews</span>
									</span>
								</p>
							</div>
						</div>
						<!-- <div class="clearfix"></div> -->
							<?php
							}
						}
						else
						{
						?>
						<div>No Properties Found.</div>
						<?php
						}
						?>
					</ul>
				</div>
				<script type = "text/javascript">
				function view_property_details(property_id)
				{
					/*$.post(BASE_URL+'overview/overview',
					{
					'property_id' : property_id
					},
					 function(data)
							{*/
								//$('#overview_view').html(data);   
								//window.location.href="http://java67.blogspot.com"; 
								window.location = BASE_URL+'overview/index/'+property_id;
							//});
				}
				</script>