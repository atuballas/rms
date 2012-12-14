<?php
include( 'includes/configuration.php' );
include( 'includes/function.php' );

/************************************************************************************
Ajax calls, please place below here
************************************************************************************/
if( isset( $_POST['ajaxcall'] ) && ! empty( $_POST['ajaxcall'] ) ){
	if( isset( $_POST['ajaxproc'] ) && ! empty( $_POST['ajaxproc'] ) ){
		switch( $_POST['ajaxproc'] ){
			case 'addboarder':
				print_r( $_POST );
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

renderPage();
?>