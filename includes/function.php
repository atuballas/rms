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
						0,
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
	
	$query = '
					SELECT
						*
					FROM
						rms_boarders
					ORDER BY
						id
					DESC
					LIMIT '.DATADISPLAYLIMIT.'
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
?>