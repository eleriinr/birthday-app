<?php
global $wpdb;

$isikute_tabel = $wpdb->prefix . 'isikud';

$retrieve_data = $wpdb->get_results("SELECT * FROM $isikute_tabel");
foreach ($retrieve_data as $retrieved_data){
	if($retrieved_data->kuupaev == "2019-06-24"){
		echo $retrieved_data->eesnimi . ' ' . $retrieved_data->perenimi;
	}
}

?>