<div id="rightbar-level1">
	<div class="titlebar">
		Boarders Information
	</div>
</div>
<div id="rightbar-level2">
	<div class="bodybar">
		<div id="boarders-data">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-add" onclick="showAddBoardersInterface();">
					<div class="boarders-controls-add-level1">
						<img src="<?php echo FULLURL;?>images/add.png">
					</div>
					<div class="boarders-controls-level2">Add a Boarder</div>
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body" class="block-body">
				<table width="100%">
					<thead>
						<tr>
							<td>Name</td>
							<td>Address</td>
							<td>Telephone</td>
							<td>Status</td>
							<td>Profession</td>
							<td>Check-in Date</td>
							<td>Board Type</td>
							<td>Board Status</td>
						</tr>
					</thead>
					<tbody class="data-field">
						<tr>
							<td colspan="8" class="data-loading" align="center" valign="middle">
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
		<div id="boarders-add">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-return" onclick="showBoardersData();">
					<div class="boarders-controls-level1">
						<img src="<?php echo FULLURL;?>images/back.png">
					</div>
					<div class="boarders-controls-level2">Return</div>
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body-addinterface" class="block-body">
				<form method="POST" id="add-boader-form">
					<table>
						<tbody>
							<tr>
								<td colspan="2" id="form-error" align="center"></td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Name</td>
								<td>
									<input type="text" name="name" id="name">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Address</td>
								<td>
									<input type="text" name="address" id="address">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Telephone</td>
								<td>
									<input type="text" name="telephone" id="telephone">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Status</td>
								<td>
									<select name="status" id="status">
										<option value=""></option>
										<option value="single">Single</option>
										<option value="married">Married</option>
										<option value="widowed">Widowed</option>
									</select>
								</td>
							</tr>
							<tr class="table-td-field-info">
								<td><span class="input-note">*</span>Profession</td>
								<td>
									<input type="text" name="profession" id="profession">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Boarding Type</td>
								<td>
									<select name="btype" id="btype">
										<option value=""></option>
										<option value="monthly">Monthly</option>
										<option value="transient">Transient/Daily</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Check-in Date</td>
								<td>
									<input type="text" class="w2em" id="date-1-dd" name="date-1-dd" value="" maxlength="2" /> / 
									<input type="text" class="w2em" id="date-1-mm" name="date-1-mm" value="" maxlength="2" /> / 
									<input type="text" class="w4em highlight-days-67 range-low-2006-08-11 range-high-2020-12-31 split-date" id="date-1" name="date-1" value="" maxlength="4" />
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Room No</td>
								<td>
									<select name="rooms" id="rooms">
										<option value=""></option>
										<option value="1">1</option>
										<option value="2">2</option>
									</select>
								</td>
							</tr>
							<tr>
								<td  colspan="2" id="room-information">
									<table>
										<tr>
											<td colspan="2" align="right"><a onclick="hideRoomInformation();" class="information-hide">Hide</a></td>
										</tr>
										<tr>
											<td>Montly:</td>
											<td>PHP2,500</td>
										</tr>
										<tr>
											<td>Transient:</td>
											<td>PHP2,500/30 days = Amount</td>
										</tr>
										<tr>
											<td>Maximum Occupants:</td>
											<td>2</td>
										</tr>
										<tr>
											<td>Amenities:</td>
											<td>
												Free water and light, 24 hour security camera, electric fan, electric iron
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note"></span>Additional Appliances</td>
								<td>
									<table class="addon-appliances">
										<tr>
											<td><input type="checkbox" name="addon-appliance[]" id="addon-appliance-1" value="television">Television</td>
										</tr>
										<tr>
											<td><input type="checkbox" name="addon-appliance[]" id="addon-appliance-1" value="refrigerator">Refrigerator</td>
										</tr>
										<tr>
											<td><input type="checkbox" name="addon-appliance[]" id="addon-appliance-1" value="radio">Radio</td>
										</tr>
										<tr>
											<td><input type="checkbox" name="addon-appliance[]" id="addon-appliance-1" value="fan">Electric Fan</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="ajaxcall" value="<?php echo base64_encode( mt_rand(00000000,99999999) );?>">
									<input type="hidden" name="ajaxproc" value="addboarder">
									<input type="hidden" name="serverproc" value="addboarder">
									<button onclick="addBoarder();" type="button">
										 Add Boarder
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
<div id="addboarder-loader" >
	<div class="lightbox-content">
		<img src="<?php echo FULLURL;?>images/loader.gif"><br>
		Please wait
	</div>
</div>