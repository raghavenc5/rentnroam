<?php
// o/p the header
echo $header;
?>

<div class="container" style="padding-top: 90px;">
    <div class="row">
        <div class="content-box">
            <h1>
            	Properties

            	<a href="<?php echo site_url('/host/createproperty'); ?>" class="btn btn-primary pull-right">Create New Property</a>
        	</h1>
            <hr/>
        </div>
    </div>
    <div class="row">
		<div class="col-md-12">
	
			<?php
			if ($this->session->flashdata('fatalError')) {
			?>
			
				<div class="alert alert-danger"><strong><?php echo $this->session->flashdata('fatalError'); ?></strong></div>

			<?php
			} elseif ($this->session->flashdata('success')) {
			?>
			
				<div class="alert alert-success"><strong><?php echo $this->session->flashdata('success'); ?></strong></div>

			<?php
			} else {
				//
			}
			?>
			
		</div>
	</div>
	<form name="property_search_form" id="property_search_form" method="post" action="<?php echo site_url('/host/properties'); ?>">
		<div class="row">
			<div class="col-md-2">
				<select class="form-control" name="property_search_data[country_id]" onchange="selectState(this.options[this.selectedIndex].value)">
					<option value="" selected>Select country</option>
					<?php
					foreach ($countries as $key => $thisCountry) {
					?>
					<option value="<?php echo $thisCountry->country_id; ?>" <?php echo ($propertySearchData && ($thisCountry->country_id == $propertySearchData['country_id'])) ? 'selected' : ''; ?>><?php echo $thisCountry->country_name; ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="state_dropdown" name="property_search_data[state_id]" onchange="selectCity(this.options[this.selectedIndex].value)">
					<option value="" selected>Select state</option>
					<?php
					foreach ($states as $key => $thisState) {
					?>
					<option value="<?php echo $thisState->id; ?>" <?php echo ($propertySearchData && ($thisState->id == $propertySearchData['state_id'])) ? 'selected' : ''; ?>><?php echo $thisState->state_name; ?></option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="city_dropdown" name="property_search_data[city_id]">
					<option value="" selected>Select city</option>
					<?php
					foreach ($cities as $key => $thisCity) {
					?>
					<option value="<?php echo $thisCity->id; ?>" <?php echo ($propertySearchData && ($thisCity->id == $propertySearchData['city_id'])) ? 'selected' : ''; ?>><?php echo $thisCity->city_name; ?></option>
					<?php
					}
					?>
				</select>
			</div>
            <div class="col-md-2">
                <select class="form-control" id="room_type" name="property_search_data[room_type_id]">
					<option value="" selected>Select room type</option>
					<?php
					foreach ($roomTypes as $key => $thisRoomType) {
					?>
					<option value="<?php echo $thisRoomType->room_type_id; ?>" <?php echo ($propertySearchData && ($thisRoomType->room_type_id == $propertySearchData['room_type_id'])) ? 'selected' : ''; ?>><?php echo $thisRoomType->roomtype; ?></option>
					<?php
					}
					?>
				</select>
            </div>
			<div class="col-md-2">
				<button type="submit" name="search_property_button" id="search_property_button" class="btn btn-primary">Search</button>

				<?php
				if ($propertySearchData) {
				?>
				<a href="<?php echo base_url('host/exitsearch') . '/?referer=' . base64_encode(current_url()); ?>" class="btn btn-primary">Clear</a>
				<?php
				}
				?>

			</div>
		</div>
	</form>
    <div class="row">
    	<div class="col-md-12 table-responsive">
    		<table class="table table-striped">
    			<thead>
    				<tr>
    					<td>
    						<input type="checkbox" name="bulk_record_selector" id="bulk_record_selector"/>
    					</td>
    					<td>
    						<?php
    						$sortUrl = base_url() . 'host/properties/';
    						$sortUrl .= (! $currentPage) ? '0/' : "$currentPage/";
    						$sortUrl .= "$sortKey/";
    						$sortUrl .= ('desc' == $sortDirection) ? "asc" : "desc";
    						?>
    						<a href="<?php echo $sortUrl; ?>" title="Click to sort records by ID"><strong>ID</strong></a>
						</td>
    					<td><strong>Image</strong></td>
    					<td><strong>Title</strong></td>
                        <td><strong>Room Type</strong></td>
    					<td><strong>Address</strong></td>
    					<td><strong>Created On</strong></td>
    					<td><strong>Options</strong></td>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
    				if ($propertySearchData && ! $properties):
					?>
					<tr>
						<td colspan="8" align="center"><strong>Your search yielded no result</strong></td>
					</tr>
					<?php
					elseif (! $properties):
					?>
					<tr>
						<td colspan="8" align="center"><strong>You have not added any property yet. You can do so <a href="<?php echo site_url('host/createproperty'); ?>">here</a></strong></td>
					</tr>
					<?php
					else:
						foreach ($properties as $key => $thisProperty):
					?>
					<tr>
						<td>
							<input type="checkbox" name="record_selectors[]" id="record_selector_<?php echo $key; ?>" class="record_selectors" value="<?php echo $thisProperty->property_id; ?>"/>
						</td>
						<td><?php echo $thisProperty->property_id; ?></td>
						<td>
							<?php
							$imageUrl = ($thisProperty->property_image) ? base_url() . "public/uploads/property_image/$thisProperty->property_image" : base_url() . "public/images/noimage.jpg"
							?>
							<image height="100" width="100" alt="property_<?php echo $key; ?>_thumb_image" src="<?php echo $imageUrl; ?>"/>
						</td>
						<td><?php echo $thisProperty->property_title ? filterDbOutput($thisProperty->property_title) : 'Not Provided'; ?></td>
                        <td><?php echo $thisProperty->roomtype ? filterDbOutput($thisProperty->roomtype) : 'Not Provided'; ?></td>
						<td><?php echo $thisProperty->property_address ? filterDbOutput($thisProperty->property_address) : 'Not Prvided'; ?></td>
						<td><?php echo $thisProperty->property_created_on; ?></td>
						<td>
							<a href="<?php echo site_url('/host/propertydetails/' . $thisProperty->property_id . '/?referer=' . base64_encode(current_url())); ?>" class="btn btn-primary">View</a>
							&nbsp;&nbsp;
							<a href="<?php echo site_url('/host/editproperty/' . $thisProperty->property_id . '/?referer=' . base64_encode(current_url())); ?>" class="btn btn-primary">Edit</a>
							&nbsp;&nbsp;
							<a href="<?php echo site_url('/host/deleteproperty/' . $thisProperty->property_id . '/?cpi=' . $currentPage . '&trc=' . count($properties) . '&drc=1&referer=' . base64_encode(current_url())); ?>" class="btn btn-primary">Delete</a>
						</td>
					</tr>
					<?php
						endforeach;
					endif;
    				?>
    			</tbody>
    			<tfoot>
    				<tr>
    					<td colspan="8" align="center">&nbsp;</td>
    				</tr>
    			</tfoot>
    		</table>
    		<table class="table table-striped">
    			<tr>
    				<td>
    					<select name="bulk_operator" id="bulk_operator" class="form-control" style="width:20%">
    						<option value="">-select-</option>
    						<option value="delete">Bulk Delete</option>
    					</select>
    				</td>
    				<td align="center">
    					<?php echo $pageLinks; ?>
    				</td>
    			</tr>
    		</table>
    	</div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".pagination li a").click(function(e) {
			e.preventDefault();

			var sortKey = "<?php echo $sortKey; ?>";
			var sortDirection = "<?php echo $sortDirection; ?>";
			var currentUrl = $(this).attr("href");

			var pageSegments = currentUrl.split("/");
			var lastPageSegment = pageSegments[pageSegments.length - 1];

			if ("" == lastPageSegment) {
				currentUrl += "0/" + sortKey + "/" + sortDirection;
			} else {
				currentUrl += "/" + sortKey + "/" + sortDirection;
			}

			window.location = currentUrl;
		});

		$("#bulk_record_selector").change(function() {
			if ($(this).prop("checked")) {
				$(".record_selectors").prop("checked", true);
			} else {
				$(".record_selectors").prop("checked", false);
			}
		});

		$("#bulk_operator").change(function() {
			if ("delete" === $(this).val()) {
				var propertyList = [];

				$(".record_selectors").each(function() {
					if ($(this).prop("checked")) {
						propertyList.push($(this).val());
					}
				});

				if (0 === propertyList.length) {
					alert("Please select atleast one property");
					$("#bulk_operator").val("");
				} else {
					if (confirm("Sure to delete the selected properties?")) {
						var url = "<?php echo site_url('/host/deleteproperties/?cpi=' . $currentPage . '&trc=' . count($properties) . '&drc=" + propertyList.length + "&referer=' . base64_encode(current_url())); ?>";

						$.ajax({
							url: url,
							method: "post",
							dataType: "json",
							data: {propertyList: propertyList.join(",")},
							success: function(response) {
								window.location = response.referer;
							}
						});
					} else {
						$("#bulk_operator").val("");
					}
				}
			}
		});
	});
</script>

<?php
// o/p the footer
echo $footer;
?>
