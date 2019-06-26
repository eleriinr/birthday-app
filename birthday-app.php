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
function create_birthday_database(){
	global $wpdb;
	
	$table_name1 = $wpdb->prefix . 'grupid';
	$table_name2 = $wpdb->prefix . 'isikud';
	
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql1 = "CREATE TABLE $table_name1 (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			nimi varchar(40) NOT NULL,
			struktuuri_id varchar(20) NOT NULL,
			uldmeil varchar(40) NOT NULL,
			aktiivne varchar(3) NOT NULL,
			PRIMARY KEY  (id)
	) $charset_collate;";
	
	$sql2 = "CREATE TABLE $table_name2 (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			eesnimi varchar(30) NOT NULL,
			perenimi varchar(30) NOT NULL,
			kuupaev date NOT NULL,
			email varchar(40) NOT NULL,
			saaja_email varchar(40),
			grupi_id mediumint(9) NOT NULL,
			aktiivne varchar(3) NOT NULL,
			PRIMARY KEY  (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql1 );
	dbDelta( $sql2 );
}
function grupp_lisa($nimi, $struktuuri_id, $uldmeil, $aktiivne){
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$wpdb->insert(
			$table_name,
			array(
					'nimi' => $nimi,
					'struktuuri_id' => $struktuuri_id,
					'uldmeil' => $uldmeil,
					'aktiivne' => $aktiivne,
			)
	);
}
function isik_lisa($eesnimi, $perenimi, $kuupaev, $email, $saaja_email, $grupi_id, $aktiivne){
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'isikud';
	
	$wpdb->insert(
			$table_name,
			array(
					'eesnimi' => $eesnimi,
					'perenimi' => $perenimi,
					'kuupaev' => $kuupaev,
					'email' => $email,
					'saaja_email' => $saaja_email,
					'grupi_id' => $grupi_id,
					'aktiivne' => $aktiivne,
			)
	);
}
function grupp_kustuta(){
	require_once( '../../../wp-load.php' );
	
	if (!empty($_POST['id'])){
		global $wpdb;
		
		$table = prefix . 'grupid';
		$id = $_POST['id'];
		$wpdb->delete( $table, array( 'id' => $id ) );
	}
}
function isik_kustuta(){
	require_once( '../../../wp-load.php' );
	
	if (!empty($_POST['id'])){
		global $wpdb;
		
		$table = prefix . 'isikud';
		$id = $_POST['id'];
		$wpdb->delete( $table, array( 'id' => $id ) );
	}
}

function ajax_group_form(){
	global $wpdb;
	
	$wpdb->insert(
			'grupid',
			array(
					'nimi' => $nimi,
					'struktuuri_id' => $struktuuri_id,
					'uldmeil' => $uldmeil,
					'aktiivne' => $aktiivne,
			)
	);
	
	exit();
}

add_action( 'wp_ajax_ajax_form', 'ajax_group_form' );
add_action( 'wp_ajax_nopriv_ajax_form', 'ajax_group_form' );

?>