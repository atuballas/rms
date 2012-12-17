<?php
global $active, $inactive, $evicted, $occupied, $vacant, $reserved, $urepair;
?>
<div id="rightbar-level1">
	<div class="titlebar">
		Dashboard Information
	</div>
</div>
<div id="rightbar-level2">
	<div class="bodybar">
		<div id="dashboard-userblock" class="dashboard-block">
			<div class="dashboard-block-head">
				<div>
					<img class="users" />
				</div>
				<div class="dashboard-block-head-text">
					BOARDERS INFORMATION
				</div>
			</div>
			<div class="cb dashboard-block-body">
				<table width="100%">
					<tr>
						<td class="dashboard-block-body-info">Active</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $active );?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="dashboard-block-body-info">Inactive</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $inactive );?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="dashboard-block-body-info">Evicted</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $evicted );?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div id="dashboard-roomblock" class="dashboard-block">
			<div class="dashboard-block-head">
				<div>
					<img class="room" />
				</div>
				<div class="dashboard-block-head-text">
					ROOM INFORMATION
				</div>
			</div>
			<div class="cb dashboard-block-body">
				<table width="100%">
					<tr>
						<td class="dashboard-block-body-info">Occupied</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $occupied );?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="dashboard-block-body-info">Reserved</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $reserved );?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="dashboard-block-body-info">Vacant</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $vacant );?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="dashboard-block-body-info">Under Repair</td>
						<td>
							<div class="dashboard-block-body-count">
								<?php echo count( $urepair );?>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="cb"></div>
		<div id="chartdiv" style="height:300px;width:540px;margin:40px 0 0 15px;"></div> 
	</div>
</div>