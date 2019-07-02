<?php
$tanaaeg = new DateTime('today');
$tanadate = substr($tanaaeg->format('Y-m-d H:i:s'), 0,10);
$hommedate = date('Y-m-d', strtotime("+1 day", strtotime($tanadate)));
$juubeldate = date('Y-m-d', strtotime("+1 month", strtotime($tanadate)));

$isikud = $wpdb->prefix . 'isikud';

$retrieve_data2 = $wpdb->get_results("SELECT * FROM $isikud");

$grupid = array();

$aasta = substr($tanadate, 0, 4);
$tana_kuupaev = substr($tanadate, 5, 5);
$homme_kuupaev = substr($hommedate, 5, 5);
$juubel_kuupaev = substr($juubeldate, 5, 5); 

foreach ($retrieve_data2 as $retrieved_data){
	$kuupaev = $retrieved_data->kuupaev;
	$eesnimi = $retrieved_data->eesnimi;
	$perenimi = $retrieved_data->perenimi;
	$email = $retrieved_data->email;
	$aktiivne = $retrieved_data->aktiivne;
	$grupi_id = $retrieved_data->grupi_id;
	
	$sunni_kuupaev = substr($kuupaev, 5, 5);
	$sunni_aasta = substr($kuupaev, 0, 4);
	
	if($tana_kuupaev == $sunni_kuupaev && $aktiivne == 'Jah'){
		if (!in_array($grupp . $grupi_id, $grupid)){
			$grupp . $grupi_id = array();
			$grupid[] = $grupp . $grupi_id;
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saaja = $saajad[0];
			$grupp . $grupi_id[] = array('uldmeil'=>$saaja);
			$tana . $grupi_id = array();
			$grupp . $grupi_id[] = $tana . $grupi_id;
			
		}
		else if (!in_array($tana . $grupi_id, $grupp . $grupi_id)){
			$tana . $grupi_id = array();
			$grupp . $grupi_id[] = $tana . $grupi_id;
		}
		
		$lisatav = array( $eesnimi . ' ' . $perenimi, $email);
		$tana[] = $lisatav;
	}
	else if($homme_kuupaev == $sunni_kuupaev && $aktiivne == 'Jah'){
		if (!in_array($grupp . $grupi_id, $grupid)){
			$grupp . $grupi_id = array();
			$grupid[] = $grupp . $grupi_id;
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid WHERE id=$grupi_id");
			$saaja = $saajad[0];
			$grupp . $grupi_id[] = array('uldmeil'=>$saaja);
			$homme . $grupi_id = array();
			$grupp . $grupi_id[] = $homme . $grupi_id;
		}
		else if (!in_array($homme . $grupi_id, $grupp . $grupi_id)){
			$homme . $grupi_id = array();
			$grupp . $grupi_id[] = $homme . $grupi_id;
		}

		$lisatav = array( $eesnimi . ' ' . $perenimi, $email);
		$homme[] = $lisatav;
	}
	else if($juubel_kuupaev == $sunni_kuupaev && (intval($aasta) - intval($kp_aasta))%5 == 0 && $aktiivne == 'Jah'){
		if (!in_array($grupp . $grupi_id, $grupid)){
			$grupp . $grupi_id = array();
			$grupid[] = $grupp . $grupi_id;
			$saajad = $wpdb->get_results("SELECT uldmeil from $grupid_tabel WHERE id=$grupi_id");
			$saaja = $saajad[0];
			$grupp . $grupi_id[] = array('uldmeil'=>$saaja);
			$juubel . $grupi_id = array();
			$grupp . $grupi_id[] = $juubel . $grupi_id;
		}
		else if (!in_array($tana . $grupi_id, $grupp . $grupi_id)){
			$juubel . $grupi_id = array();
			$grupp . $grupi_id[] = $juubel . $grupi_id;
		}
		
		$lisatav = array( $eesnimi . ' ' . $perenimi, $email);
		$juubel[] = $lisatav;	
	}
	/*foreach($grupid as $grupp){
		foreach($grupp as $alam){
			foreach($alam as $lisatud){
				echo 'Grupp: ' . $grupp . ' Lisatud: ' . $lisatud;
			}
		}
	}*/
}
?>