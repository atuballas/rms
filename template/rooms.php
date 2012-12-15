<div id="rightbar-level1">
	<div class="titlebar">
		Rooms Information
	</div>
</div>
<div id="rightbar-level2">
	<div class="bodybar">
		<div id="rooms-data">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-add" onclick="showAddRoomsInterface();">
					<div class="boarders-controls-add-level1">
						<img src="<?php echo FULLURL;?>images/add.png">
					</div>
					<div class="boarders-controls-level2">Add a Room</div>
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body" class="block-body">
				<table width="100%">
					<thead>
						<tr>
							<td>Room #</td>
							<td>Room Description</td>
							<td>Room Rate</td>
							<td>Maximum Occupants</td>
							<td>Amenities</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody class="data-field">
						<tr>
							<td colspan="6" class="data-loading" align="center" valign="middle">
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
		<div id="rooms-add">
			<div class="boarders-controls block-controls">
				<div id="boarders-controls-return" onclick="showRoomsData();">
					<div class="boarders-controls-level1">
						<img src="<?php echo FULLURL;?>images/back.png">
					</div>
					<div class="boarders-controls-level2">Return</div>
				</div>
			</div>
			<div class="cb"></div>
			<div id="boarders-body-addinterface" class="block-body">
				<form method="POST" id="add-room-form">
					<table>
						<tbody>
							<tr>
								<td colspan="2" id="form-error" align="center"></td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Room #</td>
								<td>
									<input type="text" name="room_no" id="room_no">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Room Description</td>
								<td>
									<textarea name="room_description" id="room_description"></textarea>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Room Rate</td>
								<td>
									<input type="text" name="room_rate" id="room_rate">
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Maximum Occupants</td>
								<td>
									<select name="max_occupants" id="max_occupants">
										<option value=""></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Room Amenities</td>
								<td>
									<textarea name="room_amenities" id="room_amenities"></textarea>
								</td>
							</tr>
							<tr>
								<td class="table-td-field-info"><span class="input-note">*</span>Status</td>
								<td>
									<select name="room_status" id="room_status">
										<option value=""></option>
										<option value="occupied">Occupied</option>
										<option value="vacant">Vacant</option>
										<option value="repair">Under Repair</option>
										<option value="construction">Under Construction</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="hidden" name="ajaxcall" value="<?php echo base64_encode( mt_rand(00000000,99999999) );?>">
									<input type="hidden" name="ajaxproc" value="addroom">
									<input type="hidden" name="serverproc" value="addroom">
									<button onclick="addRoom();" type="button">
										 Add Room
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
<div id="addroom-loader" >
	<div class="lightbox-content">
		<img src="<?php echo FULLURL;?>images/loader.gif"><br>
		Please wait
	</div>
</div>