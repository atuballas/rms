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
?>