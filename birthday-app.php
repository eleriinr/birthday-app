<?php
/**
* Plugin Name: Birthday-app
* Description: Sünnipäevaplugin
* Version: 1.0
* Author: Eleriin Rein
**/

function sunnipaev() {
	$time = date("Y/m/d");
	
	printf("Today is " . $time . "<br>");
}

add_action( 'admin_notices', 'sunnipaev' );
?>