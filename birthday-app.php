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
	add_submenu_page( 'sunnipaevaplgin', 'Lisa isik', 'Lisa isik', 'manage_options', 'lisaisik', 'lisaisik_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Lisa grupp', 'Lisa grupp', 'manage_options', 'lisagrupp', 'lisagrupp_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Isikud', 'Isikud', 'manage_options', 'isikud', 'isikud_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Muuda isik', 'Muuda isik', 'manage_options', 'muudaisik', 'muudaisik_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Muuda grupp', 'Muuda grupp', 'manage_options', 'muudagrupp', 'muudagrupp_init' );
}
function test_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/index.php'); 
}
function lisaisik_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/lisaisik.php'); 
}
function lisagrupp_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/lisagrupp.php'); 
} 
function isikud_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/isikud.php'); 
}
function muudaisik_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/muudaisik.php'); 
}
function muudagrupp_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/muudagrupp.php'); 
}
?>