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
	add_submenu_page( '', 'Lisa isik', 'Lisa isik', 'manage_options', 'lisaisik', 'addperson_init' );
	add_submenu_page( '', 'Lisa grupp', 'Lisa grupp', 'manage_options', 'lisagrupp', 'addgroup_init' );
	add_submenu_page( '', 'Isikud', 'Isikud', 'manage_options', 'isikud', 'people_init' );
	add_submenu_page( '', 'Muuda isik', 'Muuda isik', 'manage_options', 'muudaisik', 'changeperson_init' );
	add_submenu_page( '', 'Muuda grupp', 'Muuda grupp', 'manage_options', 'muudagrupp', 'changegroup_init' );
}
function test_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/index.php'); 
}
function addperson_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/lisaisik.php'); 
}
function addgroup_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/lisagrupp.php'); 
} 
function people_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/isikud.php'); 
}
function changeperson_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/muudaisik.php'); 
}
function changegroup_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/muudagrupp.php'); 
}
function create_birthday_tables(){
	global $wpdb;
	
	$groups = $wpdb->prefix . 'groups';
	$people = $wpdb->prefix . 'people';
	
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql1 = "CREATE TABLE $groups (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name varchar(40) NOT NULL,
			str_id varchar(20) NOT NULL,
			email varchar(40) NOT NULL,
			active varchar(3) NOT NULL,
			PRIMARY KEY  (id)
	) $charset_collate;";
	
	$sql2 = "CREATE TABLE $people (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			first_name varchar(30) NOT NULL,
			last_name varchar(30) NOT NULL,
			birthday date NOT NULL,
			email varchar(40) NOT NULL,
			recipients_email varchar(40),
			comment varchar(140),
			group_id mediumint(9) NOT NULL,
			active varchar(3) NOT NULL,
			PRIMARY KEY  (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql1 );
	dbDelta( $sql2 );
}

register_activation_hook( __FILE__, 'create_birthday_tables' );

function delete_birthday_tables(){
	global $wpdb;
	
	$groups = $wpdb->prefix . 'groups';
	$people = $wpdb->prefix . 'people';
	
	$sql1 = "DROP TABLE IF EXISTS $groups;";
	$sql2 = "DROP TABLE IF EXISTS $people;";
	
	$wpdb->query($sql1);
	$wpdb->query($sql2);
}

register_deactivation_hook( __FILE__, 'delete_birthday_tables' );

function add_element(){
	global $wpdb;
	
	$data = $_POST['data'];
	$table = $_POST['table'];
	
	$table = $wpdb->prefix . $table;
	
	$wpdb->insert(
			$table,
			$data
	);
	wp_die();
}

add_action( 'wp_ajax_add_element', 'add_element' );

function change_element(){
	global $wpdb;
	
	$data = $_POST['data'];
	$id = $_POST['id'];
	$table = $_POST['table'];
			
	$table = $wpdb->prefix . $table;
	
	$wpdb->update(
			$table,
			$data,
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_change_element', 'change_element' );

function change_activity(){
	
	global $wpdb;

	$id = $_POST['id'];
	$active = $_POST['active'];
	$table = $_POST['table'];	
	
	$table = $wpdb->prefix . $table;
	
	$wpdb->update(
			$table,
			array(
				'active' => $active
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_change_activity', 'change_activity' );

function delete_element(){

	if (!empty($_POST['id'])){
		
		global $wpdb;
		
		$table = $_POST['table'];
		$table = $wpdb->prefix . $table;
		$id = $_POST['id'];
		$wpdb->delete( 
					$table, 
					array( 'id' => $id ) 
		);
	}
	wp_die();
}

add_action( 'wp_ajax_delete_element', 'delete_element' );

function mailer_config(PHPMailer $mailer){
  $mailer->IsSMTP();
  $mailer->Host = "mailhost.ut.ee"; // your SMTP server
  $mailer->Port = 25;
  $mailer->SMTPDebug = 2; // write 0 if you don't want to see client/server communication in page
  $mailer->CharSet  = "utf-8";
}

add_action( 'phpmailer_init', 'mailer_config', 10, 1);
?>