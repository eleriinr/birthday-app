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
function grupp_lisa(){
	global $wpdb;
	
	$nimi = $_POST['nimi'];
	$struktuuri_id = $_POST['struktuuri_id'];
	$uldmeil = $_POST['uldmeil'];
	$aktiivne = $_POST['aktiivne'];
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$wpdb->insert(
			$table_name,
			array(
				'nimi' => $nimi,
				'struktuuri_id' => $struktuuri_id,
				'uldmeil' => $uldmeil,
				'aktiivne' => $aktiivne
			)
	);
	wp_die();
}

add_action( 'wp_ajax_grupp_lisa', 'grupp_lisa' );

function isik_lisa(){
	global $wpdb;
	
	$eesnimi = $_POST['eesnimi'];
	$perenimi = $_POST['perenimi'];
	$kuupaev = $_POST['kuupaev'];
	$email = $_POST['email'];
	$saaja_email = $_POST['saaja_email'];
	$grupi_id = $_POST['grupi_id'];
	$aktiivne = $_POST['aktiivne'];
	
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
				'aktiivne' => $aktiivne
			)
	);
	wp_die();
}
	
	add_action( 'wp_ajax_isik_lisa', 'isik_lisa' );
	
function grupp_muuda(){
	global $wpdb;
	
	$nimi = $_POST['nimi'];
	$struktuuri_id = $_POST['struktuuri_id'];
	$uldmeil = $_POST['uldmeil'];
	
	$id = $_POST['id'];
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$wpdb->update(
			$table_name,
			array(
				'nimi' => $nimi,
				'struktuuri_id' => $struktuuri_id,
				'uldmeil' => $uldmeil
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_grupp_muuda', 'grupp_muuda' );

function grupp_muuda_aktiivsust(){
	
	global $wpdb;

	$aktiivne = $_POST['aktiivne'];
	
	$id = $_POST['id'];
	
	$table_name = $wpdb->prefix . 'grupid';
	
	$wpdb->update(
			$table_name,
			array(
				'aktiivne' => $aktiivne
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_grupp_muuda_aktiivsust', 'grupp_muuda_aktiivsust' );

function isik_muuda_aktiivsust(){
	global $wpdb;

	$aktiivne = $_POST['aktiivne'];
	
	$id = $_POST['id'];
	
	$table_name = $wpdb->prefix . 'isikud';
	
	$wpdb->update(
			$table_name,
			array(
				'aktiivne' => $aktiivne
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_isik_muuda_aktiivsust', 'isik_muuda_aktiivsust' );

function isik_muuda(){
	global $wpdb;
	
	$eesnimi = $_POST['eesnimi'];
	$perenimi = $_POST['perenimi'];
	$kuupaev = $_POST['kuupaev'];
	$email = $_POST['email'];
	$saaja_email = $_POST['saaja_email'];
	$grupi_id = $_POST['grupi_id'];
	
	$id = $_POST['id'];
				
	$table_name = $wpdb->prefix . 'isikud';
	
	$wpdb->update(
			$table_name,
			array(
				'eesnimi' => $eesnimi,
				'perenimi' => $perenimi,
				'kuupaev' => $kuupaev,
				'email' => $email,
				'saaja_email' => $saaja_email,
				'grupi_id' => $grupi_id
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_isik_muuda', 'isik_muuda' );

function isik_kustuta(){

	if (!empty($_POST['id'])){
		
		global $wpdb;
		
		$table = $wpdb->prefix . 'isikud';
		$id = $_POST['id'];
		$wpdb->delete( $table, array( 'id' => $id ) );
	}
	wp_die();
}

add_action( 'wp_ajax_isik_kustuta', 'isik_kustuta' );

function grupp_kustuta(){
	
	if (!empty($_POST['id'])){
		
		global $wpdb;
		
		$table = $wpdb->prefix . 'grupid';
		$id = $_POST['id'];
		$wpdb->delete( $table, array( 'id' => $id ) );
	}
	wp_die();
}

add_action( 'wp_ajax_grupp_kustuta', 'grupp_kustuta' );

// show wp_mail() errors
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function onMailError( $wp_error ) {
    echo "<p>";
    print_r($wp_error);
    echo "</p>";
}    
function mailer_config(PHPMailer $mailer){
  $mailer->IsSMTP();
  $mailer->Host = "mailhost.ut.ee"; // your SMTP server
  $mailer->Port = 25;
  $mailer->SMTPDebug = 2; // write 0 if you don't want to see client/server communication in page
  $mailer->CharSet  = "utf-8";
}
add_action( 'phpmailer_init', 'mailer_config', 10, 1);
?>