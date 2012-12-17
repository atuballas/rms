<?php
include( 'includes/configuration.php' );
include( 'includes/function.php' );

mysqlConnect();		// Establish DB connection

/************************************************************************************
Ajax calls, please place below here
************************************************************************************/
if( isset( $_POST['ajaxcall'] ) && ! empty( $_POST['ajaxcall'] ) ){
	if( isset( $_POST['ajaxproc'] ) && ! empty( $_POST['ajaxproc'] ) ){
		switch( $_POST['ajaxproc'] ){
			case 'addboarder':
				insertBoarders();
			break;
			case 'getLatestBoarders':
				getLatestBoarders();
			break;
			case 'addroom':
				insertRoom();
			break;
			case 'getLatestRooms':
				getLatestRooms();
			break;
		}
	}else{
		return false;
	}
	exit;
}
/************************************************************************************
Ajax calls, please place above here
************************************************************************************/

/************************************************************************************
Form submission, please place below here
************************************************************************************/
if( isset( $_POST['serverproc'] ) && ! empty( $_POST['serverproc'] ) ){
	switch( $_POST['serverproc'] ){
		
	}
}
/************************************************************************************
Form submission, please place above here
************************************************************************************/
switch( ( ( empty( $_GET['page'] ) ) ? $page = 'dashboard' : $_GET['page'] ) ){
	case 'dashboard':
		$boarders = getAllBoarders();
		$active = array();
		$inactive = array();
		$evicted = array();
		foreach( $boarders as $k=>$b ){
			if( $b['board_status'] == 0 ) $inactive[] = $boarders[$k]; 
			else if( $b['board_status'] == 1 ) $active[] = $boarders[$k]; 
			else $evicted[] = $boarders[$k]; 
		}
		$rooms = getAllRooms();
		$occupied = array();
		$reserved = array();
		$vacant = array();
		$urepair = array();
		foreach( $rooms as $k=>$r ){
			if( $r['status'] == 'occupied' ) $occupied[] = $rooms[$k]; 
			else if( $r['status'] == 'reserved' ) $reserved[] = $rooms[$k]; 
			else if( $r['status'] == 'vacant' ) $vacant[] = $rooms[$k]; 
			else $urepair[] = $rooms[$k]; 
		}
		
		$jan = 0;
		$feb = 0;
		$mar = 0;
		$apr = 0;
		$may = 0;
		$jun = 0;
		$jul = 0;
		$aug = 0;
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		$graph_months = array();
		foreach( $active as $a ){
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Jan' ) $jan += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Feb' ) $feb += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Mar' ) $mar += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Apr' ) $apr += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'May' ) $may += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Jun' ) $jun += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Jul' ) $jul += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Aug' ) $aug += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Sep' ) $sep += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Oct' ) $oct += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Nov' ) $nov += 1;
			if( strftime( '%b', strtotime( $a['checked_in_date'] ) ) == 'Dec' ) $dec += 1;
		}
		$graph_months = json_encode( array( $jan, $feb, $mar, $apr, $may, $jun, $jul, $aug, $sep, $oct, $nov, $dec ) );
	break;
	case 'boarders';
		$available_rooms = getAvailableRooms();
	break;
}

renderPage();
?>