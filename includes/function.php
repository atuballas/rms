<?php
function renderPage(){
	$page = '';
	if( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) ){
		$page = $_GET['page'];
	}else{
		$page = 'dashboard';
	}
	include( 'template/template.html' );
}

function mysqlConnect(){
	$con = mysql_connect( MYSQLHOST, MYSQLUSER, MYSQLPASS ) or die( 'Mysql Connection Error: ' . mysql_error() );
	if( $con !== false ){
		mysql_select_db( MYSQLDB, $con ) or die( 'Mysql Connection Error: ' . mysql_error() );
	}
}

function mysqlSanitizeString( $string ){
	return mysql_real_escape_string( $string );
}

function insertBoarders(){
	$ckindate = $_POST['date-1'] . '-' . $_POST['date-1-mm'] . '-' . $_POST['date-1-dd'] . ' ' . '00:00:00';
	$addon_appliances = '';
	foreach( $_POST['addon-appliance'] as $ap ){
		$addon_appliances .= $ap . ',';
	}
	$addon_appliances = rtrim( $addon_appliances, ',' );
	
	$bstatus = 0;
	if( strtotime( $ckindate ) <= time() ){
		$bstatus = 1;
	}
	
	$query = 'INSERT
					INTO
						rms_boarders
					(
						name,
						address,
						telephone,
						status,
						profession,
						boarding_type,
						checked_in_date,
						room_number,
						additional_appliances,
						board_status,
						timestamp
					)
					VALUES
					(
						"'.mysqlSanitizeString( $_POST['name'] ).'",
						"'.mysqlSanitizeString( $_POST['address'] ).'",
						"'.mysqlSanitizeString( $_POST['telephone'] ).'",
						"'.mysqlSanitizeString( $_POST['status'] ).'",
						"'.mysqlSanitizeString( $_POST['profession'] ).'",
						"'.mysqlSanitizeString( $_POST['btype'] ).'",
						"'.$ckindate.'",
						"'.mysqlSanitizeString( $_POST['rooms'] ).'",
						"'.$addon_appliances.'",
						"'.$bstatus.'",
						NOW()
					)
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );			   
	if( $query ){
	
		// update room
		$rstatus = 'occupied';
		if( $bstatus == 0 ) $rstatus = 'reserved';
		
		 
		$query = '
						UPDATE
							rms_rooms
						SET
							status="'.$rstatus.'"
						WHERE
							room_no = "'.$_POST['rooms'].'"
		               ';
		$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );			   
		if( $query ){
			$return = array(
										'success' => true,
										'message' => 'db insertion successful'
									 );
			echo json_encode( $return );	
		}else{
			$return = array(
										'success' => false,
										'message' => mysql_error()
									 );
			echo json_encode( $return );	
		}		 
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function insertRoom(){
	$query = '
				INSERT
				INTO
					rms_rooms
				(
					room_no,
					room_description,
					room_rate,
					room_max,
					room_amenities,
					status,
					timestamp
				)
				VALUES
				(
					"'.mysqlSanitizeString( $_POST['room_no'] ).'",
					"'.mysqlSanitizeString( $_POST['room_description'] ).'",
					"'.mysqlSanitizeString( $_POST['room_rate'] ).'",
					"'.mysqlSanitizeString( $_POST['max_occupants'] ).'",
					"'.mysqlSanitizeString( $_POST['room_amenities'] ).'",
					"'.mysqlSanitizeString( $_POST['room_status'] ).'",
					NOW()
				)
	         ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );			   
	if( $query ){
		$return = array(
									'success' => true,
									'message' => 'db insertion successful'
								 );
		echo json_encode( $return );						 
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
		
}

function insertAmenity(){
	$query = '
				INSERT
				INTO
					rms_amenities
				(
					name,
					description,
					status,
					timestamp
				)
				VALUES
				(
					"'.mysqlSanitizeString( $_POST['amenity_name'] ).'",
					"'.mysqlSanitizeString( $_POST['amenity_description'] ).'",
					"'.mysqlSanitizeString( $_POST['amenity_status'] ).'",
					NOW()
				)
	         ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );			   
	if( $query ){
		$return = array(
									'success' => true,
									'message' => 'db insertion successful'
								 );
		echo json_encode( $return );						 
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function insertAppliance(){
	$query = '
				INSERT
				INTO
					rms_appliances
				(
					name,
					status,
					timestamp
				)
				VALUES
				(
					"'.mysqlSanitizeString( $_POST['appliance_name'] ).'",
					"'.mysqlSanitizeString( $_POST['appliance_status'] ).'",
					NOW()
				)
	         ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );			   
	if( $query ){
		$return = array(
									'success' => true,
									'message' => 'db insertion successful'
								 );
		echo json_encode( $return );						 
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function getLatestBoarders(){
	$total_boarders = 0;
	$query = '
						SELECT
							COUNT(*) as totalboarders
						FROM
							rms_boarders
	               ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );			   
	if( $query ){
		$row = mysql_fetch_assoc( $query );
		$total_boarders = $row['totalboarders'];
	}
	
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_boarders
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			$return = array(
										'success' => true,
										'message' => 'data fetch successful',
										'total_data' => $total_boarders,
										'data' => $data
									 );
			echo json_encode( $return );	
		}else{
			$return = array(
									'success' => false,
									'message' => 'no data fetched'
								 );
			echo json_encode( $return );		
		}
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function getLatestRooms(){
	$total_rooms = 0;
	$query = '
						SELECT
							COUNT(*) as totalrooms
						FROM
							rms_rooms
	               ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );			   
	if( $query ){
		$row = mysql_fetch_assoc( $query );
		$total_rooms = $row['totalrooms'];
	}
	
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_rooms
					ORDER BY
						id
					ASC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';			   
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			$return = array(
										'success' => true,
										'message' => 'data fetch successful',
										'total_data' => $total_rooms,
										'data' => $data
									 );
			echo json_encode( $return );	
		}else{
			$return = array(
									'success' => false,
									'message' => 'no data fetched'
								 );
			echo json_encode( $return );		
		}
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function getLatestAmenities(){
	$total_amenities = 0;
	$query = '
						SELECT
							COUNT(*) as totalamenities
						FROM
							rms_amenities
	               ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );			   
	if( $query ){
		$row = mysql_fetch_assoc( $query );
		$total_amenities = $row['totalamenities'];
	}
	
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_amenities
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			$return = array(
										'success' => true,
										'message' => 'data fetch successful',
										'total_data' => $total_amenities,
										'data' => $data
									 );
			echo json_encode( $return );	
		}else{
			$return = array(
									'success' => false,
									'message' => 'no data fetched'
								 );
			echo json_encode( $return );		
		}
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function getLatestAppliances(){
	$total_appliances = 0;
	$query = '
						SELECT
							COUNT(*) as totalappliances
						FROM
							rms_amenities
	               ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );			   
	if( $query ){
		$row = mysql_fetch_assoc( $query );
		$total_appliances = $row['totalappliances'];
	}
	
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_appliances
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			$return = array(
										'success' => true,
										'message' => 'data fetch successful',
										'total_data' => $total_appliances,
										'data' => $data
									 );
			echo json_encode( $return );	
		}else{
			$return = array(
									'success' => false,
									'message' => 'no data fetched'
								 );
			echo json_encode( $return );		
		}
	}else{
		$return = array(
									'success' => false,
									'message' => mysql_error()
								 );
		echo json_encode( $return );		
	}
}

function getAvailableRooms(){
	$data = array();
	$query = '
						SELECT
							*
						FROM
							rms_rooms
						WHERE
							status="vacant"
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );
	if( $query ){
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function getAllBoarders(){
	$data = array();
	$query = '
						SELECT
							*
						FROM
							rms_boarders
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );
	if( $query ){
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

function getSearchedBoarders(){
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_boarders
					WHERE
						name REGEXP "'.$_POST['q'].'"
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';		   
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;	
		}
	}else{
		return false;
	}
}

function getSearchedRooms(){
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_rooms
					WHERE
						room_description REGEXP "'.$_POST['q'].'"
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';		   
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;	
		}
	}else{
		return false;
	}
}

function getSearchedAmenities(){
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_amenities
					WHERE
						name REGEXP "'.$_POST['q'].'"
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';		   
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;	
		}
	}else{
		return false;
	}
}

function getSearchedAppliances(){
	$start = $_POST['index'];
	if( $_POST['index'] != 0 ){
		$start = $_POST['index'] * DATADISPLAYLIMIT;
	}
	
	$query = '
					SELECT
						*
					FROM
						rms_appliances
					WHERE
						name REGEXP "'.$_POST['q'].'"
					ORDER BY
						id
					DESC
					LIMIT '.$start.','.DATADISPLAYLIMIT.'
				   ';		   
	$query = mysql_query( $query ) or die( 'Mysql query error: ' . mysql_error() );
	if( $query ){
		$data = array();
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;	
		}
	}else{
		return false;
	}
}

function getAllRooms(){
	$data = array();
	$query = '
						SELECT
							*
						FROM
							rms_rooms
				   ';
	$query = mysql_query( $query ) or die( 'Mysql query error' . mysql_error() );
	if( $query ){
		if( mysql_num_rows( $query ) > 0 ){
			while( $row = mysql_fetch_assoc( $query ) ){
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
?>