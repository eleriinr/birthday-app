<?php
//defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );
/**
* Plugin Name: Birthday-app
* Description: Sünnipäevaplugin
* Version: 1.0
* Author: Eleriin Rein
**/
function test_plugin_setup_menu(){
    add_menu_page( 'Sünnipäevaplugin', 'Sünnipäevaplugin', 'manage_options', 'sunnipaevaplugin', 'test_init' );
	add_submenu_page( '', 'Lisa grupp', 'Lisa grupp', 'manage_options', 'lisagrupp', 'lisagrupp_init' );
	add_submenu_page( '', 'Isikud', 'Isikud', 'manage_options', 'isikud_1', 'isikud_init' );
	add_submenu_page( '', 'Lisaisik', 'Lisaisik', 'manage_options', 'lisaisik_1', 'lisaisik_init' );
	add_submenu_page( '', 'Muuda grupp', 'Muuda grupp', 'manage_options', 'muudagrupp_1', 'muudagrupp_init');
	add_submenu_page( '', 'Muuda isik', 'Muuda isik', 'manage_options', 'muudaisik_1', 'muudaisik_init' );
}
 add_action('admin_menu', 'test_plugin_setup_menu');
 
 function add_urls_new_group(){
	global $wpdb;
	$id = $wpdb->get_results("SELECT MAX(id) as id FROM groups");
	$id = $id[0];
	$url = 'isikud_' . $id;
	$url2 = 'lisaisik_' . $id;
	$url3 = 'muudagrupp_' . $id;
	add_submenu_page( '', 'Isikud', 'Isikud', 'manage_options', $url, 'isikud_init' );
	add_submenu_page( '', 'Lisaisik', 'Lisaisik', 'manage_options', $url2, 'lisaisik_init' );
	add_submenu_page( '', 'Muuda grupp', 'Muuda grupp', 'manage_options', $url3, 'muudagrupp_init');
 }
 add_action('test_plugin_setup_menu', 'add_urls_new_group');
 
 function add_urls_new_person(){
	global $wpdb;
	$id = $wpdb->get_results("SELECT MAX(id) as id FROM people");
	$id = $id[0];
	$url = 'muudaisik_' . $id;
	add_submenu_page( '', 'Muuda isik', 'Muuda isik', 'manage_options', $url, 'muudaisik_init' );
 }
 add_action('test_plugin_setup_menu', 'add_urls_new_person');
 
function test_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/index.php'); 
}
function lisaisik_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/lisaisik.php'); 
}
function lisagrupp_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/lisagrupp.php'); 
} 
function isikud_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/isikud.php'); 
}
function muudaisik_init(){
	include ('../wp-content/plugins/birthday-app/php/header.php');
	include('../wp-content/plugins/birthday-app/php/muudaisik.php'); 
}
function muudagrupp_init(){
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
			group_email varchar(40) NOT NULL,
			element_activity varchar(3) NOT NULL,
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
			element_activity varchar(3) NOT NULL,
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
	if ($table == $wpdb->prefix . "groups"){
		do_action('add_urls_new_group');
	}
	else if ($table == $wpdb->prefix . "people"){
		do_action('add_urls_new_person');
	}
	
	wp_die();
}

add_action( 'wp_ajax_add_element', 'add_element' );

function edit_element(){
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

add_action( 'wp_ajax_edit_element', 'edit_element' );

function edit_activity(){
	
	global $wpdb;

	$active = $_POST['active'];
	$table = $_POST['table'];	
	$id = $_POST['id'];
	
	$table = $wpdb->prefix . $table;
	
	$wpdb->update(
			$table,
			array(
				'element_activity' => $active
			),
			array(
				'id' => $id
			)
	);
	wp_die();
}

add_action( 'wp_ajax_edit_activity', 'edit_activity' );

function delete_element(){

	if (!empty($_POST['id'])){
		
		global $wpdb;
		
		$table = $_POST['table'];
		$table = $wpdb->prefix . $table;
		$id = $_POST['id'];
		$wpdb->delete( $table, array( 'id' => $id ) );
	}
	wp_die();
}

add_action( 'wp_ajax_delete_element', 'delete_element' );

function access_peoples_table(){
	$group_id = $_POST['id'];
	$url = 'admin.php?page=isikud_' . $group_id;
	wp_redirect(admin_url($url));
	die();
}

add_action( 'admin_post_access_peoples_table', 'access_peoples_table' );

function add_person(){
	$group_id = $_POST['id'];
	$url = 'admin.php?page=lisaisik_' . $group_id;
	wp_redirect(admin_url($url));
	die();
}

add_action( 'admin_post_add_person', 'add_person');

function edit_person(){
	$group_id = $_POST['id'];
	$url = 'admin.php?page=muudaisik_' . $group_id;
	wp_redirect(admin_url($url));
	die();
}

add_action( 'admin_post_edit_person', 'edit_person');

function edit_group(){
	$group_id = $_POST['id'];
	$url = 'admin.php?page=muudagrupp_' . $group_id;
	wp_redirect(admin_url($url));
	die();
}

add_action( 'admin_post_edit_group', 'edit_group');
function onMailError( $wp_error ) {
    echo "<p>";
    print_r($wp_error);
    echo "</p>";
}
add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
function mailer_config(PHPMailer $mailer){
  $mailer->IsSMTP();
  $mailer->Host = "mailhost.ut.ee"; // your SMTP server
  $mailer->Port = 25;
  $mailer->SMTPDebug = 2; // write 0 if you don't want to see client/server communication in page
  $mailer->CharSet  = "utf-8";
}
add_action( 'phpmailer_init', 'mailer_config', 10, 1);
?>