<div id="rightbar-level1">
	<div class="titlebar">
		Amenities Information
	</div>
</div>
<div id="rightbar-level2">
	<div class="bodybar">
		<div id="amenities-data">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-add" onclick="showAddAmenitiesInterface();">
					<div class="boarders-controls-add-level1">
						<!--<img src="<?php echo FULLURL;?>images/add.png">-->
					</div>
					<div class="boarders-controls-level2">
						<div></div>
						Add Amenity
					</div>
				</div>
			</div>
			<div class="boarders-controls-disabled block-controls" id="edit-selection-button">
				<div id="boarders-controls-add" onclick="">
					<div class="boarders-controls-add-level1">
						
					</div>
					<div class="boarders-controls-level2">Edit Selected</div>
				</div>
			</div>
			<div class="boarders-controls-disabled block-controls" id="delete-selection-button">
				<div id="boarders-controls-add" onclick="">
					<div class="boarders-controls-add-level1">
						
					</div>
					<div class="boarders-controls-level2">Delete Selected</div>
				</div>
			</div>
			<div class="boarders-controls-disabled block-controls" id="clear-selection-button">
				<div id="boarders-controls-add" onclick="clearRowSelection();">
					<div class="boarders-controls-add-level1">
						
					</div>
					<div class="boarders-controls-level2">Clear Selection</div>
				</div>
			</div>
			<div class="block-controls search-input">
				<div id="boarders-controls-add">
					<input type="text" name="amenities_search" id="search" value="Search amenity..." defvalue="Search amenity...">
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body" class="block-body">
				<table width="100%">
					<thead>
						<tr>
							<td>Amenities</td>
							<td>Description</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody class="data-field">
						<tr>
							<td colspan="3" class="data-loading" align="center" valign="middle">
								<div class="data-loading-level1">
									<img src="<?php echo FULLURL;?>images/loader.gif">
								</div>	
								<div class="data-loading-level2">Loading...</div>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<tbody>
						<tr>
							<td align="right" id="data-pagination"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="amenities-add">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-return" onclick="showAmenitiesData();">
					<div class="boarders-controls-level1">
					</div>
					<div class="boarders-controls-level2">Return</div>
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body-addinterface" class="block-body">
				<form method="POST" id="add-amenity-form">
					<table>
						<tbody>
							<tr>
								<td colspan="2" id="form-error" align="center"></td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Amenity Name</td>
								<td>
									<input type="text" name="amenity_name" id="amenity_name">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Description</td>
								<td>
									<textarea name="amenity_description" id="amenity_description"></textarea>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Status</td>
								<td>
									<select name="amenity_status" id="amenity_status">
										<option value=""></option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="ajaxcall" value="<?php echo base64_encode( mt_rand(00000000,99999999) );?>">
									<input type="hidden" name="ajaxproc" value="addamenity">
									<input type="hidden" name="serverproc" value="addamenity">
									<button onclick="addAmenity();" type="button">
										 Add Amenity
									</button>
									<button>
										 Cancel
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="addamenity-loader" >
	<div class="lightbox-content">
		<img src="<?php echo FULLURL;?>images/loader.gif"><br>
		Please wait
	</div>
</div>