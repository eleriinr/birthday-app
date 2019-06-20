<?php
//defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );
/**
* Plugin Name: Birthday-app
* Description: Sünnipäevaplugin
* Version: 1.0
* Author: Eleriin Rein
**/
 add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Sünnipäevaplugin', 'Sünnipäevaplugin', 'manage_options', 'sunnipaevaplugin', 'test_init' );
}
 
function test_init(){
	echo file_get_contents("C://xampp/htdocs/test/wp-content/plugins/birthday-app/php/header.php");
	echo file_get_contents("C://xampp/htdocs/test/wp-content/plugins/birthday-app/php/index.php"); 
}
?>