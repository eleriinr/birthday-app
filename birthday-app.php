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
	add_submenu_page( 'sunnipaevaplgin', 'Lisa inimene', 'Lisa inimene', 'manage_options', 'lisainimene', 'lisainimene_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Lisa grupp', 'Lisa grupp', 'manage_options', 'lisagrupp', 'lisagrupp_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Inimesed', 'Inimesed', 'manage_options', 'inimesed', 'inimesed_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Muuda inimene', 'Muuda inimene', 'manage_options', 'muudainimene', 'muudainimene_init' );
	add_submenu_page( 'sunnipaevaplgin', 'Muuda grupp', 'Muuda grupp', 'manage_options', 'muudagrupp', 'muudagrupp_init' );
}
function test_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/index.php'); 
}
function lisainimene_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/lisainimene.php'); 
}
function lisagrupp_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/lisagrupp.php'); 
} 
function inimesed_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/inimesed.php'); 
}
function muudainimene_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/muudainimene.php'); 
}
function muudagrupp_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include ('../wp-content/plugins/birthday-app/php/url_function.php');
	include('../wp-content/plugins/birthday-app/php/muudagrupp.php'); 
}
?>