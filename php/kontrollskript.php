<?php
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . $folder . '/wp-load.php');

$todays_date = new DateTime('today');
$todays_date = substr($todays_date->format('Y-m-d'), 0,10);
$today = substr($todays_date, 5, 5);

$tomorrow = date('Y-m-d', strtotime("+1 day", strtotime($todays_date)));
$tomorrow = substr($tomorrow, 5, 5);

$jubilee = date('Y-m-d', strtotime("+1 month", strtotime($todays_date)));
$jubilee = substr($jubilee, 5, 5);
$current_year = substr($todays_date, 0, 4);

global $wpdb;
$people = $wpdb->prefix . 'people';
$groups = $wpdb->prefix . 'groups';
$peoples_data = $wpdb->get_results("SELECT * FROM $people");
$inactive_groups = $wpdb->get_results("SELECT id FROM $groups WHERE element_activity='No'");
$group = array();
$recipients = array();
$inactive = array();

foreach($inactive_groups as $groupx){
	$inactive[] = $groupx->id;
}

foreach ($peoples_data as $data){
	$group_id = $data->group_id;
	if(!in_array($group_id, $inactive)){
		$birthday = $data->birthday;
		$formatted_date = date('d.m.Y', strtotime($birthday));
		$first_name = $data->first_name;
		$last_name = $data->last_name;
		$email = $data->email;
		$recipients_email = $data->recipients_email;
		$active = $data->element_activity;
				
		$persons_group = $wpdb->get_results("SELECT group_email, str_id from $groups WHERE id=$group_id");
		$persons_group = $persons_group[0];	
		$group_email = $persons_group->group_email;
		$str_id = $persons_group->str_id;
		$group_name = 'group' . $group_id;
		$name = $first_name . ' ' . $last_name;
		$today_ = 'Today_' . $group_id;
		$tomorrow_ = 'Tomorrow_' . $group_id;
		$jubilee_ = 'Jubilee_' . $group_id;
		
		$birth_date = substr($birthday, 5, 5);
		$birth_year = substr($birthday, 0, 4);
		
		$info = array(
						'name' => $name,
						'email' => $email,
						'str_id' => $str_id,
						'birthday' => $formatted_date
		);
		
		//Birthday today
		if($today == $birth_date){
			if($active == 'Yes'){
				$group = general_email($today_, $group_name, $group_email, $group, $info);
			}
			if($recipients_email != ''){
				$recipients = private_email('Today_', $recipients_email, $recipients, $info);
			}
		}
		//Birthday tomorrow
		else if($tomorrow == $birth_date){
			if($active == 'Yes'){
				$group = general_email($tomorrow_, $group_name, $group_email, $group, $info);
			}
			if($recipients_email != ''){
				$recipients = private_email('Tomorrow_', $recipients_email, $recipients, $info);
			}
		}
		//Jubilee in a month
		else if($jubilee == $birth_date && (intval($current_year) - intval($birth_year)) % 5 == 0){
			if($active == 'Yes'){
				$group = general_email($jubilee_, $group_name, $group_email, $group, $info);
			}
			if($recipients_email != ''){
				$recipients = private_email('Jubilee_', $recipients_email, $recipients, $info);
			}
		}
	}
}
function general_email($day, $group_name, $group_email, $group, $info){
	if (!array_key_exists($group_name, $group)){
		$group[$group_name]['email'] = $group_email;
	}
	$nr = 1;
	if(array_key_exists($day, $group[$group_name])){
		$nr = count($group[$group_name][$day]) + 1;
	}
	
	$group[$group_name][$day]['person_' . $nr] = $info;
	return $group;
}
function private_email($day, $recipients_email, $recipients, $info){
	$recipient_array = array();
	
	if (strpos($recipients_email, ',') == false) {
		$recipient_array[] = $recipients_email;
	} 
	else { 
		$array = explode(",", $recipients_email);
		foreach($array as $email){
			$recipient_array[] = trim($email);
		}
	}
	
	foreach($recipient_array as $recipient){
		$nr = 1;
		if(array_key_exists($recipient, $recipients) && array_key_exists($day, $recipients[$recipient])){
			$nr = count($recipients[$recipient][$day]) + 1;
		}
		
		$recipients[$recipient][$day]['person_' . $nr] =  $info;
	}
	return $recipients;
}


require 'class.phpmailer.php';

$mail = new PHPMailer;
$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mailhost.ut.ee';                 // Specify main and backup server
$mail->Port = 25;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->From = 'olen.meeldetuletus@ut.ee';
$mail->FromName = 'Meeldetuletus';
$mail->IsHTML(true);                                  // Set email format to HTML
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Sünnipäev';

foreach(array_keys($group) as $group_name){
	$message = "";
	$message = $message . '<br>Lp. <a href="mailto:' . $group[$group_name]['email'] . '">' . $group[$group_name]['email'] . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($group[$group_name]) as $day){
		if($day != 'email'){
			if(substr($day, 0, 6) == 'Today_'){
				$message = $message . 'Täna: ';
			}
			else if(substr($day, 0, 9) == 'Tomorrow_'){
				$message = $message . 'Homme: ';
			}
			else{
			$message = $message . 'Juubel tulekul: ';
			}
			foreach($group[$group_name][$day] as $person){
				$message = $message . $person['name'] . ' (' . $person['birthday'] . '), email: <a href="mailto:' . $person['email'] . '">' . $person['email'] . '</a><br>';	
			}
		}
	}
	
	$mail->AddAddress($group[$group_name]['email']);  
	$mail->Body    = $message;
	$mail->AltBody = $message;
	if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}

foreach(array_keys($recipients) as $recipient){
	$message = "";
	$message = $message . '<br>Lp. <a href="mailto:' . $recipient . '">' . $recipient . '</a>!<br>Ära unusta sünnipäevi!<br><br>';
	foreach(array_keys($recipients[$recipient]) as $day) {
		if(substr($day, 0, 6) == 'Today_'){
			$message = $message . 'Täna: ';
		}
		else if(substr($day, 0, 9) == 'Tomorrow_'){
			$message = $message . 'Homme: ';
		}
		else{
			$message = $message . 'Juubel tulekul: ';
		}
		foreach($recipients[$recipient][$day] as $person){
			$message = $message . $person['name'] . ' (' . $person['birthday'] . '), Osakond: ' . $person['str_id'] . ', email: <a href="mailto:' . $person['email'] . '">' . $person['email'] . '</a><br>';	
		}
	}
	$mail->AddAddress($recipient);  
	$mail->Body    = $message;
	$mail->AltBody = $message;

	if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}
?>